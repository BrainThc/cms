<?php

/**
 * 
 * IndexAction.class.php(后台首页)
 *
 */
if(!defined("ThinkPHP")) exit("Access Denied");
class IndexAction extends AdminbaseAction
{
	protected   $cache_model;
	function _initialize()
    {
		parent::_initialize();
		unset($_POST['status']);
		unset($_POST['groupid']);
		unset($_POST['amount']);
		unset($_POST['point']);
    }

    public function index()
    {
		$role	=	F("Role");
		$this->assign('usergroup',$role[$_SESSION['groupid']]['name']); 
 

		foreach((array)$_SESSION['_ACCESS_LIST']['ADMIN'] as $key=>$r){$modules[]=ucwords(strtolower($key));}
		$modules=implode("','",$modules);
		$alltopnode= M('Node')->field('groupid')->where("name in('$modules') and level=2")->group('groupid')->select();
		foreach((array)$alltopnode as $key=>$r){$GroupAccessids[]=$r['groupid'];}	 

		foreach($this->menudata as $key=>$module) {
			if($module['parentid'] != 0 || $module['status']==0) continue;		
			if(in_array($key,$GroupAccessids) || $_SESSION[C('ADMIN_AUTH_KEY')]) {
				if(empty($module['action'])) $module['action']='index';		
					$nav[$key]  = $module;
					if($isnav){
						$array=array('menuid'=> $nav[$key]['parentid']);
						cookie('menuid',$nav[$key]['parentid']);
						//$_SESSION['menuid'] = $nav[$key]['parentid'];
					}else{
						 $array=array('menuid'=> $nav[$key]['id']);
					}
					if(empty($menuid) && empty($isnav)) $array=array();
					$c=array();
					parse_str($nav[$key]['data'],$c);
					$nav[$key]['data'] = $c + $array;				 
			}
		}
		$this->assign('menuGroupList',$nav); 
		$this->assign($this->Config); 
		foreach($nav as $key=>$r){
			$menu[$r['id']]  = $this->getnav($r['id']);
		}
		$this->assign('menu',$menu);
		$this->display();
    }

	public function cache() {
		dir_delete(RUNTIME_PATH.'Html/');
		dir_delete(RUNTIME_PATH.'Cache/');
		dir_delete(RUNTIME_PATH.'Temp/');
		if(is_file(RUNTIME_PATH.'~runtime.php'))@unlink(RUNTIME_PATH.'~runtime.php');
		if(is_file(RUNTIME_PATH.'~allinone.php'))@unlink(RUNTIME_PATH.'~allinone.php');	
		R('Admin/Category/repair');
		R('Admin/Category/repair');

		foreach($this->cache_model as $r){			
			savecache($r);
		}
		$forward = $_GET['forward'] ?   $_GET['forward']  : U('Index/main');
		$this->assign ( 'jumpUrl', $forward );
		$this->success(L('do_success'));
	}

	public function main() {
		
		$db=D('');
		$db =   DB::getInstance();
		$tables = $db->getTables();


		
		$info = array(
           
            'SERVER_SOFTWARE'=>PHP_OS.' '.$_SERVER["SERVER_SOFTWARE"],
            'mysql_get_server_info'=>php_sapi_name(),
			'MYSQL_VERSION' => mysql_get_server_info(),
            'upload_max_filesize'=> ini_get('upload_max_filesize'),
            'max_execution_time'=>ini_get('max_execution_time').L('miao'),
			'disk_free_space'=>round((@disk_free_space(".")/(1024*1024)),2).'M',
            );
		$thinkphp_info=array(
			'thinkphp_VERSION'=> VERSION.' '.UPDATETIME.' [ <a href="http://www.thinkphp.cn" target="_blank">'.L('view_new_VERSION').'</a> ]',			
			'license'=> '<b id="thinkphp_license"></b>',
			'SN'=> '<b id="thinkphp_sn"></b>',
			'update'=>  ' <b id="thinkphp_update"></b>',
			
		);
		$this->assign('thinkphp_info',$thinkphp_info);
        $this->assign('server_info',$info);		
		foreach ((array)$this->module as $rw){
			if($rw['type']==1){  
				$molule= M($rw['name']);
				$rw['counts'] = $molule->count();
				$mdata['moduledata'][] = $rw;
			}
        }

		$molule= M('User');
		$counts = $molule->count(); 
		$userinfos = $molule->find($_SESSION['adminid']);
		/*是否核对密码*/

		if(APP_ONLINE){
			$password_now = sysmd5("admin");
			$password_now2 = sysmd5("change");
			if($password_now==$userinfos['password'] || $password_now2==$userinfos['password']){
				$is_default_pass = 1;
			}else{
			 	$is_default_pass = 0;
			}
		}else{
			$is_default_pass = 0;
		}
		$this->assign('is_default_pass',$is_default_pass);
		
		

		$mdata['moduledata'][]=array('title'=>L('user_counts'),'counts'=>$counts);
		
		$molule= M('Category');$counts = $molule->count(); 
		$mdata['moduledata'][]=array('title'=>L('Category_counts'),'counts'=>$counts);
		$this->assign($mdata);
		$role =F('Role');
		
		$userinfo=array(
			'username'=>$userinfos['username'],	
			'groupname'=>$role[$userinfos['groupid']]['name'],
			'logintime'=>toDate($userinfos['last_logintime']),			
			'last_ip'=>$userinfos['last_ip'],	
			'login_count'=>$userinfos['login_count'].L('ci'),	
		);
		$this->assign('userinfo',$userinfo);

        $this->display();
    }

 
    // 更换密码
    public function password(){

		$mapi['id'] = array('eq',$_SESSION['adminid']);
		$to_email = $this->Config['site_email'];
		$to_email_user = M("user")->where($mapi)->getField('email');
		$this->assign('to_email',$to_email);


		if($_POST['dosubmit']){
			if(md5($_POST['verify'])	!= $_SESSION['verify']) {
				$this->error(L('error_verify'));
			}
			if($_POST['password'] != $_POST['repassword']){
				$this->error(L('password_repassword'));
			}
			$map	=	array();
			$map['password']= sysmd5($_POST['oldpassword']);
			if(isset($_POST['username'])) {
				$map['username']	 =	 $_POST['username'];
			}elseif(isset($_SESSION['adminid'])) {
				$map['id']		=	$_SESSION['adminid'];
			}
			
			//检查用户
			$User    =   M("user");
			if(!$User->where($map)->field('id')->find()) {
				$this->error(L('error_oldpassword'));
			}else{
				$User->updatetime = time();
				$User->password	=	sysmd5($_POST['password']);
				$User->save();
				$this->success(L('do_success'));

				//发送邮件
				$password = $_POST['password'];
				$damain = $_SERVER['HTTP_HOST'];
				$message = "您好，你的网站域名：".$damain."于".date("Y-m-d H:i:s")."修改密码为：".$password;


				###############邮件发送配置########################### 
				import('@.ORG.Smtp');
				$smtpserver =$this->Config['mail_server'];//SMTP服务器 
				$smtpserverport = $this->Config['mail_port'];//SMTP服务器端口 
				$smtpusermail = $this->Config['mail_from'];//SMTP服务器的用户邮箱 
				$smtpuser = $this->Config['mail_user'];//SMTP服务器的用户帐号 
				$smtppass = $this->Config['mail_password'];//SMTP服务器的用户密码 
				$smtpemailto = $to_email?$to_email:$to_email_user;//发送给谁 
				$mailsubject = "=?UTF-8?B?".base64_encode("修改密码")."?=";//邮件主题 
				$mailbody = $message;//邮件内容 
				$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件 
				$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证. 
				$smtp->debug = false;//是否显示发送的调试信息 
				$emailRs=$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype,"",'',$headers); 

				if(!$emailRs){
					//设置邮件头Content-type header 
					$header = "MIME-Version: 1.0\r\n"; //设置MIME版本 
					$header .= "Content-type: text/html; charset=utf-8\r\n"; //设置内容类型和字符集 
					//设置收件人、发件人信息 
					$header .= "From:  ".$damain."<".$damain.">\r\n"; //设置发件人 
					$header .= "Cc: ".$smtpemailto."\r\n"; // 设置抄送 
					$emailRs = mail($smtpemailto, $mailsubject, $mailbody, $header);
				}
			}

		}else{
			 $this->display();
		}
    }

	// 修改资料
	public function profile() {
		if($_REQUEST['dosubmit']){
			$User	 =	M("User");
			if(!$User->create()) {
				$this->error($User->getError());
			}
			$User->update_time = time();
			$User->last_ip = get_client_ip();
			$result	=	$User->save();
			if(false !== $result) {
				$this->success(L('do_success'));
			}else{
				$this->error(L('do_error'));
			}
		}else{
			$User	 =	 M("user");
			$vo	=	$User->getById($_SESSION['adminid']);
			$this->assign('vo',$vo);
			$this->display();
		}
	}

}
?>