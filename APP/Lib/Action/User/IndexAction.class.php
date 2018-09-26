<?php
/**
 * 
 * User/IndexAction.class.php (前台会员中心模块)
 *
 */
if(!defined("ThinkPHP")) exit("Access Denied");
class IndexAction extends BaseAction
{

	function _initialize()
    {	
		parent::_initialize();
		if(!$this->_userid){
			$jumpUrl=U('User/Login/index');
			$this->erroryulia(L('nologin'),$jumpUrl);
			exit;
		}
		$this->dao = M('User');
		$this->assign('bcid',0);
		$user = $this->dao->find($this->_userid);
		$this->assign('vo',$user);
		unset($_POST['status']);
		unset($_POST['groupid']);
		unset($_POST['amount']);
		unset($_POST['point']);
		$_GET =get_safe_replace($_GET);
    }

    public function index()
    {

        $this->display();
    }
	
	public function profile(){	

		if($_POST['dosubmit']){

			
			$_POST['birth'] = strtotime($_POST['birth']);
			$_POST['id']=$this->_userid;
			
			if($_POST['password']) unset($_POST['username']);
			if($_POST['password']) unset($_POST['password']); //如果有密码清除
			
			if(!$this->dao->create($_POST)) {
				$this->erroryulia($this->dao->getError());exit();
			}
			$this->dao->update_time = time();
			$this->dao->last_ip = get_client_ip();
			$result	=	$this->dao->save();
			if(false !== $result) {
				if($_POST['aid']){
					$Attachment =M('Attachment');		
					$aids =  implode(',',$_POST['aid']);
					$data['userid']= $this->_userid;
					$data['catid']= 0;
					$data['status']= '1';
					$Attachment->where("aid in (".$aids.")")->save($data);
				}
				$this->successyulia(L('do_ok'),"","ok");exit();
			}else{
				$this->erroryulia(L('do_error'));exit();
			}
			exit;
		}

		$thinkphp_auth_key = sysmd5(C('ADMIN_ACCESS').$_SERVER['HTTP_USER_AGENT']);
		$thinkphp_auth = authcode('0-1-0-1-jpeg,jpg,png,gif-3-0', 'ENCODE',$thinkphp_auth_key);
		$this->assign('thinkphp_auth',$thinkphp_auth);
        $this->display();
    }

	public function avatar(){	
		
		if($_POST['dosubmit']){
			
			$_POST['id']=$this->_userid;
			if(!$this->dao->create($_POST)) {
				$this->erroryulia($this->dao->getError());exit();
			}
			
			$this->dao->update_time = time();
			$this->dao->last_ip = get_client_ip();
			$result	=	$this->dao->save();
			if(false !== $result) {
				if($_POST['aid']){
				$Attachment =M('Attachment');		
				$aids =  implode(',',$_POST['aid']);
				$data['userid']= $this->_userid;
				$data['catid']= 0;
				$data['status']= '1';
				$Attachment->where("aid in (".$aids.")")->save($data);
				}

				$this->successyulia(L('do_success'),"","ok");exit();
			}else{
				$this->erroryulia(L('do_error'));exit();
			}
			exit;
		}

		$thinkphp_auth_key = sysmd5(C('ADMIN_ACCESS').$_SERVER['HTTP_USER_AGENT']);
		$thinkphp_auth = authcode('0-1-0-1-jpeg,jpg,png,gif-3-0', 'ENCODE',$thinkphp_auth_key);
		$this->assign('thinkphp_auth',$thinkphp_auth);
        $this->display();
    }

	public function password()
    {
		if($_POST['dosubmit']){

			if($_POST['verify'] && md5($_POST['verify']) != $_SESSION['verify']) {
				$this->erroryulia(L('error_verify'));exit();
			}
			if($_POST['password'] != $_POST['repassword']){
				$this->erroryulia(L('password_repassword'));exit();
			}
			$map	=	array();
			$map['password']= array('eq',sysmd5($_POST['oldpassword']));
			$map['id']		=	$this->_userid;
			//检查用户
			if(!$this->dao->where($map)->field('id')->find()) {
				$this->erroryulia(L('error_oldpassword'));exit();
			}else {
				//$this->dao->email = $_POST['email'];
				$this->dao->id = $this->_userid;
				$this->dao->update_time = time();
				$this->dao->password	=	sysmd5($_POST['password']);
				$r = $this->dao->save();
				$jumpUrl=URL('User-Index/password');
				if($r){
					$this->successyulia(L('do_ok'),$jumpUrl,"ok");exit();
				}else{
					$this->erroryulia(L('do_error'),$jumpUrl,"");exit();
				}
			 }
			 exit;
		}
		$this->display();
    }
	
}
?>