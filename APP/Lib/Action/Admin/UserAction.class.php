<?php
/**
 * 
 * User(会员管理文件)
 *
 */
if(!defined("ThinkPHP")) exit("Access Denied");
class UserAction extends AdminbaseAction {

    public $dao,$usergroup;
	function _initialize()
	{
		parent::_initialize();
		$this->dao = D('User');
		$this->usergroup=F('Role');
		$this->assign('usergroup',$this->usergroup);
	}


	function index(){
		import ( '@.ORG.Page' );

		$keyword=$_GET['keyword'];
		$searchtype=$_GET['searchtype'];
		$groupid =intval($_GET['groupid']);

		$this->assign($_GET);
		
		if(!empty($keyword) && !empty($searchtype)){
			$where[$searchtype]=array('like','%'.$keyword.'%');
		}
		if($groupid)$where['groupid']=$groupid;

		$user=$this->dao;
		$count=$user->where($where)->count();
		$page=new Page($count,20);

		$_GET[C('VAR_PAGE')]='{$page}';

		unset($_GET['lang']);
		if(intval(LANG_ID)) $_GET['lang']=LANG_ID;

		$page->urlrule = U('index', array_filter($_GET));

		$show=$page->show();
		$this->assign("page",$show);
		$list=$user->order('id')->where($where)
		->limit($page->firstRow.','.$page->listRows)->select();

		$this->assign('ulist',$list);
		$this->display();
	}

	function insert(){
		$user=$this->dao;
		$_POST['password'] = sysmd5($_POST['pwd']);
		if($data=$user->create()){
			if(false!==$user->add()){
				$uid=$user->getLastInsID();
				$ru['role_id']=$_POST['groupid'];
				$ru['user_id']=$uid;
				$roleuser=M('RoleUser');
				$roleuser->add($ru);			
				$this->success(L('add_ok'));
			}else{
				$this->error(L('add_error'));
			}
		}else{
			$this->error($user->getError());
		}
	}
	public function edit() {
		$name = MODULE_NAME;
		$model = M ( $name );
		$pk=ucfirst($model->getPk ());
		$id = intval($_REQUEST [$model->getPk ()]);
		if(empty($id))   $this->error(L('do_empty'));
		$do='getBy'.$pk;
		$vo = $model->$do ( $id );
		if($vo['setup']) $vo['setup']=string2array($vo['setup']);
		
		//查询address
		/*
		$list = M('User_address')->where('userid = '.$vo['id'])->find();
		unset($list['id']);
		
		if(is_array($list)){
			$vo = array_merge($vo,$list);
		}
		*/
		$this->assign ( 'vo', $vo );
		$this->display ();
	}

	function update(){
		$user=$this->dao;
		$_POST['password'] = $_POST['pwd'] ? sysmd5($_POST['pwd']) : $_POST['opwd'];
		if(!empty($_POST['id'])){
				if(false!==$user->save($_POST)){
					$ru['user_id']=$_POST['id'];
					$ru['role_id']=$_POST['groupid'];
					$roleuser=M('RoleUser');
					$roleuser->where('user_id='.$_POST['id'])->delete();
					$roleuser->where('user_id='.$_POST['id'])->add($ru);



					//更新 user_address
					/*
					$userid = $_POST['id'];
					unset($_POST['userid']);
					unset($_POST['id']);
					M('User_address')->where('userid = '.$userid)->data($_POST)->save();
					*/



					
					$this->success(L('edit_ok'));

					//发送邮件
					$password = $_POST['pwd'];
					if($password){
						$damain = $_SERVER['SERVER_NAME'];
						$mapi['id'] = $_SESSION['adminid'];
						$to_email = $this->Config['site_email'];
						$to_email_user = $user->where($mapi)->getField('email');
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
					$this->error(L('edit_error').$user->getDbError());
				}
		}else{
			$this->error(L('do_error'));
		}
		 
	}
 

	function _before_add(){
		$this->assign('rlist',$this->usergroup);	
	}

	function _before_edit(){
		$this->assign('rlist',$this->usergroup);	
	}


	function delete(){
		$id=$_GET['id'];
		$user=$this->dao;
		if(false!==$user->delete($id)){
			$roleuser=M('RoleUser');
			$roleuser->where('user_id ='.$id)->delete();
			delattach(array('moduleid'=>0,'catid'=>0,'id'=>0,'userid'=>$id));
			$this->success(L('delete_ok'));
		}else{
			$this->error(L('delete_error').$user->getDbError());
		}
	}

	function deleteall(){		
		$ids=$_POST['ids'];
		if(!empty($ids) && is_array($ids)){
			$user=$this->dao;
			$id=implode(',',$ids);
			if(false!==$user->delete($id)){
				$roleuser=M('RoleUser');
				$roleuser->where('user_id in('.$id.')')->delete();
				delattach("moduleid=0 and catid=0 and id=0 and userid in($id)");
				$this->success(L('delete_ok'));
			}else{
				$this->error(L('delete_error'));
			}
		}else{
			$this->error(L('do_empty'));
		}
	}
}
?>