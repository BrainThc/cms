<?php
/**
 * 
 * Home/LoginAction.class.php (前台会员登陆)
 *
 */
if(!defined("ThinkPHP")) exit("Access Denied");
class LoginAction extends BaseAction
{
	
	function _initialize()
    {
		parent::_initialize();
		$this->dao = M('User');
		$this->assign('bcid',0);
    }
    function index()
    {
		if($this->_userid){		
			
			$forward = $_POST['forward'] ? $_POST['forward'] :$this->forward ;
			$forward = strtolower($forward);
			if(strstr($forward,"login") || strstr($forward,"register") ){
				$forward = URL('Home-Index/index');
			}

			$this->assign('jumpUrl',$forward);
			$this->successyulia(L('login_ok'),$forward,"ok");exit;
		}
		
        $this->display();
    }
 
	function dologin(){
		$username = get_safe_replace($_POST['username']);
        $password = get_safe_replace($_POST['password']);
        $verifyCode = get_safe_replace($_POST['verifyCode']);

        if(empty($username) || empty($password)){
           $this->erroryulia(L('empty_username_empty_password'));exit;
        }
		
		if($verifyCode){
			if($this->member_config['member_login_verify'] && md5($verifyCode) != $_SESSION['verify']){
	           $this->erroryulia(L('error_verify'));exit;
	        }
        }

		 $authInfo = $this->dao->getByUsername($username);
        //使用用户名、密码和状态的方式进行认证
        if(empty($authInfo)) {
            $this->error(L('empty_userid'));
        }else {
            if($authInfo['password'] != sysmd5($_POST['password'])) {
            	$this->erroryulia(L('password_error'));exit;
            }
			if($authInfo['status'] != 1){
				if($authInfo['last_ip']){
					$this->erroryulia(L('ACCOUNT_DISABLE'));exit;
				}else{
					$this->erroryulia('您的帐号未审核请联系管理员..');exit;
				}
			}

			$cookietime =  intval($_REQUEST['cookietime']);
			$this->login($authInfo,$cookietime);
		}
 
	}


	public function login($authInfo=array(),$cookietime=0){
		
		if($userid = session('uid')){
	
			$authInfo = $this->dao->find(intval($userid));
			
			if($authInfo){
				$this->forward = URL('User-Index/index');
				session('uid',null);
			}else{
				$this->forward = URL('User-Login/index');
				$this->erroryulia(L('ACCOUNT_DISABLE'),$this->forward);exit;
			}
			
		}

		$cookietime = $cookietime ? $cookietime : 0;

		$thinkphp_auth_key = sysmd5($this->sysConfig['ADMIN_ACCESS'].$_SERVER['HTTP_USER_AGENT']);
		$thinkphp_auth = authcode($authInfo['id']."-".$authInfo['groupid']."-".$authInfo['password'], 'ENCODE', $thinkphp_auth_key);

		

		cookie('auth',$thinkphp_auth,$cookietime);
		cookie('username',$authInfo['username'],$cookietime);
		cookie('groupid',$authInfo['groupid'],$cookietime);
		cookie('userid',$authInfo['id'],$cookietime);
		cookie('email',$authInfo['email'],$cookietime);

        //保存登录信息
		$dao = M('User');
		$data = array();
		$data['id']	=	$authInfo['id'];
		$data['last_logintime']	=	time();
		$data['last_ip']	=	 get_client_ip();
		$data['login_count']	=	array('exp','login_count+1');
		$dao->save($data);
		
		$forward = $_POST['forward'] ? $_POST['forward'] :$this->forward ;
		$forward = strtolower($forward);
		if(strstr($forward,"login") || strstr($forward,"register") ){
			$forward = URL('User-Index/index');
		}
		
		$this->assign('jumpUrl',$forward);
		$this->successyulia(L('login_ok'),$forward,"ok");exit();
	}

	function getpass(){
		$this->display();
	}
	function getuser(){
		$username = get_safe_replace($_GET['username']);
		$rs = $this->dao->getFieldByUsername($username,'question');
		$rs = $rs?$rs:0;
		exit($rs);
	}
	function resetpass(){
		$data = get_safe_replace($_POST);

		$verifyCode = $data['verifyCode'];
		if($verifyCode && md5($verifyCode) != $_SESSION['verify']){
           $this->error(L('error_verify'));
        }
		$user = $this->dao->getByUsername($data['email']);
		if($user['answer'] == $data['answer']){
			$save = array();
			$save['id'] = $user['id'];
			$save['password'] = sysmd5($data['password']);
			$save['updatetime'] = time();
			$rs = $this->dao->save($save);
			if($rs){
				$this->assign('jumpUrl',URL('Home-Index/index'));
				$this->successyulia(L('DO_OK'),URL('User-Login/index'),"ok");exit();
			}else{
				$this->erroryulia(L('DO_ERROR'));exit();
			}
		}else{
			$this->erroryulia(L('answer_error'));
		}
		
	}
	function repassword(){
		if($_POST['dosubmit']){
			$verifyCode = trim($_POST['verify']);
			if(md5($verifyCode) != $_SESSION['verify']){
			   $this->erroryulia(L('error_verify'));exit();
			}
			if(trim($_POST['repassword'])!=trim($_POST['password'])){
				$this->erroryulia(L('password_repassword'));exit();
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
				$this->assign('jumpUrl',URL('User-login/index'));
				$this->assign('waitSecond',3);
				$this->successyulia(L('do_repassword_success'),URL('User-login/index'),"ok");exit();
			}else{
				$this->erroryulia(L('check_url_error'));exit();
			}
			exit;
		
		}
		$code = str_replace(' ','+',$_REQUEST['code']);
		$this->assign('code',$code);
		$this->display();
	}
 

	function sendmail(){
		$verifyCode = trim($_POST['verifyCode']);
		$username = get_safe_replace($_POST['username']);
		$email = get_safe_replace($_POST['email']);


        if(empty($username) || empty($email)){
           $this->erroryulia(L('empty_username_empty_password'));exit();
        }elseif(md5($verifyCode) != $_SESSION['verify']){
           $this->erroryulia(L('error_verify'));exit();
        }

		$user = M('User');
		//判断邮箱是用户是否正确
		$data =$user->where("username='{$username}' and email='{$email}'")->find();
		if($data){
			$thinkphp_auth = authcode($data['id']."-".$data['username']."-".$data['email'], 'ENCODE',$this->sysConfig['ADMIN_ACCESS'],3600*24*3);//3天有效期
			$username=$data['username'];
			$url =  'http://'.$_SERVER['HTTP_HOST'].URL('User-Login/repassword?code='.$thinkphp_auth);
			$message = str_replace(array('{username}','{url}','{sitename}'),array($username,$url,$this->Config['site_name']),$this->member_config['member_getpwdemaitpl']);

			$r = sendmail($email,L('USER_FORGOT_PASSWORD').'-'.$this->Config['site_name'],$message,$this->Config); 
			if($r){
				$returndata['username'] = $data['username'];
				$returndata['email'] = $data['email'];
				$this->ajaxReturn($returndata,L('USER_EMAIL_ERROR'),1);
			}else{
				$this->ajaxReturn(0,L('SENDMAIL_ERROR'),0);
			}
		}else{
			$this->ajaxReturn(0,L('USER_EMAIL_ERROR'),0);
		}
		//$this->ajaxReturn(1,L('login_ok'),1);
	}


	function emailcheck(){
		 
		if(!$this->_userid && !$this->_username && !$this->_groupid && !$this->_email){
			$this->assign('forward','');
			$jumpUrl=URL('User-Login/index');
			$this->successyulia(L('noogin'),$jumpUrl,"ok");exit;
		}

		if($_REQUEST['resend']){
			$uid=$this->_userid;
			$username = $this->_username;
			$email = $this->_email;
			if($this->member_config['member_emailcheck']){
						$thinkphp_auth = authcode($uid."-".$username."-".$email, 'ENCODE',$this->sysConfig['ADMIN_ACCESS'],3600*24*3);//3天有效期
						$url = 'http://'.$_SERVER['HTTP_HOST'].URL('User-Login/regcheckemail?code='.$thinkphp_auth);
						$click = "<a href=\"$url\" target=\"_blank\">".L('CLICK_THIS')."</a>";
						$message = str_replace(array('{click}','{url}','{sitename}'),array($click,$url,$this->Config['site_name']),$this->member_config['member_emailchecktpl']);
						$r = sendmail($email,L('USER_REGISTER_CHECKEMAIL').'-'.$this->Config['site_name'],$message,$this->Config);
						$this->assign('send_ok',1);
						$this->assign('username',$username);
						$this->assign('email',$email);
						$this->display();
						exit;
			}
		}
		if($this->_groupid==5){
			$this->display();
		}else{
			$this->erroryulia(L('do_empty'));exit();
		}	
	}
	
	function regcheckemail(){
			$code = str_replace(' ','+',$_REQUEST['code']); 
			list($userid,$username, $email) = explode("-", authcode($code, 'DECODE', $this->sysConfig['ADMIN_ACCESS'])); 
			$user = M('User');
			//判断邮箱是用户是否正确
			$data =$user->where("id={$userid} and username='{$username}' and email='{$email}'")->find();
			if($data){
				$user->groupid = 3;
				$user->id = $userid;
				$user->save();
				$ru['role_id']=3;
				$roleuser=M('RoleUser');
				$roleuser->where("user_id=".$userid)->save($ru);
				$this->assign('jumpUrl',URL('User-Login/index'));
				$this->assign('waitSecond',10);
				$this->successyulia(L('do_regcheckemail_success'),URL('User-Login/index'),"ok");exit();
			}else{
				$this->erroryulia(L('check_url_error'));exit();
			}
	}
 

	function logout()
    {
		if($this->_userid) {
			cookie(null,'TP_');
            $this->assign('jumpUrl',URL('Home-Index/index'));
			$this->successyulia(L('loginouted'),URL('Home-Index/index'),"ok");exit();
        }else {
			$this->assign('jumpUrl',$this->forward);
            $this->erroryulia(L('logined'),$this->forward);exit();
        }
    }
}
?>