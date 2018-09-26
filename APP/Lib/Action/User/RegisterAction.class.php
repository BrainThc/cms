<?php
/**
 * RegisterAction.class.php (前台会员注册模块)
 *
 */
if(!defined("ThinkPHP")) exit("Access Denied");
class RegisterAction extends BaseAction
{
	
	function _initialize()
    {
		parent::_initialize();
		$this->dao = M('User');
		$_GET =get_safe_replace($_GET);

		if(empty($this->member_config['member_register'])){ $this->erroryulia(L('close_reg'));exit();}

    }
    public function index(){

		if( cookie('auth')){

			$forward = $_POST['forward'] ? $_POST['forward'] :$this->forward ;
			$forward = strtolower($forward);
			if(strstr($forward,"login") || strstr($forward,"register") ){
				$forward = URL('Home-Index/index');
			}

			$this->assign('jumpUrl',$forward);
			$this->successyulia(L('login_ok'),$forward,"ok");
			exit;
		}
		$this->assign('bcid',0);
        $this->display();
    }

	public function doreg()
	{
		
		$username = get_safe_replace($_POST['username']);
        $password = get_safe_replace($_POST['password']);
		$email = get_safe_replace($_POST['email']);
        $verifyCode =$_POST['verifyCode'];
        if(empty($username) || empty($password) || empty($email)){
           $this->erroryulia(L('用户名、密码邮箱不能为空'));exit();
        }

		if($this->member_config['member_login_verify'] && md5($verifyCode) != $_SESSION['verify']){
           $this->erroryulia(L('error_verify'));exit();
        }
		$status = $this->member_config['member_registecheck'] ? 0 : 1;
		if($this->member_config['member_emailcheck']){ $status = 1; $groupid=5 ;}
		$groupid = $groupid ? $groupid : 3;
		$data= get_safe_replace($_POST);

		$data['username']= $username;
		$data['email']=$email;
		$data['groupid']=$groupid;
		$data['login_count']=1;
		$data['createtime']=time();
		$data['updatetime']=time();
		$data['last_logintime']=time();
		$data['reg_ip']=get_client_ip();
		$data['status']=$status;
		$authInfo['password'] = $data['password'] = sysmd5($password);
		 
		if($r=$this->dao->create($data)){
			if(false!==$this->dao->add()){
				$authInfo['id'] = $uid = $this->dao->getLastInsID();
				$authInfo['groupid'] = $ru['role_id']=$data['groupid'];
				$ru['user_id']=$uid;
				$roleuser=M('RoleUser');
				$roleuser->add($ru);
				
				//写入地址信息
				$data['userid'] = $uid;
				M('User_address')->add($data);
/*
				if($this->member_config['member_emailcheck']){
					$thinkphp_auth = authcode($uid."-".$username."-".$email, 'ENCODE',$this->sysConfig['ADMIN_ACCESS'],3600*24*3);//3天有效期
					$url = 'http://'.$_SERVER['HTTP_HOST'].URL('User-Login/regcheckemail?code='.$thinkphp_auth);
					$click = "<a href=\"$url\" target=\"_blank\">".L('CLICK_THIS')."</a>";
					$message = str_replace(array('{click}','{url}','{sitename}'),array($click,$url,$this->Config['site_name']),$this->member_config['member_emailchecktpl']);
					$r = sendmail($email,L('USER_REGISTER_CHECKEMAIL').'-'.$this->Config['site_name'],$message,$this->Config);
					$this->assign('send_ok',1);
					$this->assign('username',$username);
					$this->assign('email',$email);
					$this->display('Login:emailcheck');
					exit;
				}
		*/		
				//判断是否审核
				if($data['status'] != 1){
					$this->erroryulia('注册成功！请等待管理员审核..',$this->forward);
					exit;
				}

				$thinkphp_auth_key = sysmd5($this->sysConfig['ADMIN_ACCESS'].$_SERVER['HTTP_USER_AGENT']);
				$thinkphp_auth = authcode($authInfo['id']."-".$authInfo['groupid']."-".$authInfo['password'], 'ENCODE', $thinkphp_auth_key);
				

				$authInfo['username'] = $data['username'];
				$authInfo['email'] = $data['email'];
				cookie('auth',$thinkphp_auth,$cookietime);
				cookie('username',$authInfo['username'],$cookietime);
				cookie('groupid',$authInfo['groupid'],$cookietime);
				cookie('userid',$authInfo['id'],$cookietime);
				cookie('email',$authInfo['email'],$cookietime);

				$forward = $_POST['forward'] ? $_POST['forward'] :$this->forward ;
				$forward = strtolower($forward);
				if(strstr($forward,"login") || strstr($forward,"register") ){
					$forward = URL('Home-Index/index');
				}

				$this->assign('jumpUrl',$forward);
				$this->successyulia(L('reg_ok'),$forward,"ok");exit();
			}else{
				$this->erroryulia(L('reg_error'));exit();
			}
		}else{
			$this->erroryulia($this->dao->getError());exit();
		}
 
	}


	function checkEmail(){
        $email=$_GET['email'];
		$userid=intval($_GET['userid']);
		if(empty($userid)){
			if($this->dao->getByEmail($email)){
				 echo 'false';
			}else{
				echo 'true';
			}
		}else{
			//判断邮箱是否已经使用
			if($this->dao->where("id!={$userid} and email='{$email}'")->find()){
				 echo 'false';
			}else{
				echo 'true';
			}
		}
        exit;
	}

	function checkMobile(){
        $mobile=$_GET['mobile'];
		$userid=intval($_GET['userid']);
		if(empty($userid)){
			if($this->dao->getByMobile($mobile)){
				 echo 'false';
			}else{
				echo 'true';
			}
		}else{
			//判断邮箱是否已经使用
			if($this->dao->where("id!={$userid} and mobile='{$mobile}'")->find()){
				 echo 'false';
			}else{
				echo 'true';
			}
		}
        exit;
	}

	function checkusername(){
		$username=$_GET['username'];
		if($this->dao->getByUsername($username)){
				 echo 'false';
			}else{
				echo 'true';
		}
		exit;
	}
}
?>