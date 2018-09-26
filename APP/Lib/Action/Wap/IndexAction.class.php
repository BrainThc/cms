<?php
/**
 * 
 * IndexAction.class.php (前台首页)
 *
 */
if(!defined("ThinkPHP")) exit("Access Denied");
class IndexAction extends BaseAction
{
    public function index(){
    	
		$this->assign('bcid',0);//顶级栏目 
		$this->assign('ishome','home');
        $this->display();
    }
	
	//动态验证码 默认不开启
	/*
	 public function verify(){
        import("@.ORG.Image");
        Image::buildActiveImageVerify(4,1);
		
    }   
	*/


	  /**
     * 录入
     *
     */
    public function insert(){

    	$forward = $_SERVER["HTTP_REFERER"];
		$verifyCode = get_safe_replace($_POST['verifyCode']);
		$tipsmsg = get_safe_replace($_POST['tipsmsg']);
		if(empty($tipsmsg)){
			$tipsmsg = L('ADD_OK');
		}
		unset($_POST['tipsmsg']);
		if($verifyCode && md5($verifyCode) != $_SESSION['verify']){
			$this->erroryulia(L('error_verify'));
			exit;
        }
        $name = 'Guestbook';
        if($_POST['module']=='Feedback') $name = 'Feedback';
		if($_POST['module']=='Guestbook') $name = 'Guestbook';
		if($_POST['module']=='Comments') $name = 'Comments';
		if($_POST['module']=='Tuikuan') $name = 'Tuikuan';
		
		$model = M($name);
		
		$data = get_safe_replace($_POST);

		
		/**上传图片处理**/
		if($_POST['isfile']=='1'){
			unset($_POST['isfile']);
			//处理上传文件
			import("@.ORG.UploadFile"); 
			$upload = new UploadFile();// 实例化上传类
			$upload->saveRule = uniqid;
			$upload->autoSub = true; 
			$upload->subType = 'date';
			$upload->dateFormat = 'Ym';
			$upload->maxSize  = 30145728 ;// 设置附件上传大小
			$upload->allowExts  = array('gif', 'png', 'jpeg', 'jpg');// 设置附件上传类型
			$upload->savePath = UPLOAD_PATH;// 设置附件上传目录
			if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
			}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
			}
			
			
			foreach($_POST as $k=>$v){
				$data[$k]=get_safe_replace($v);
			}
			if($info){ $data['file']=$info[0]['savepath'].$info[0]['savename']; }
		}
		/**上传图片处理**/

		if(intval(LANG_ID)) $data['lang'] = LANG_ID;
		if(!$data['title']) $data['title'] = str_cut($data['content'],80);
		$data['ip'] = get_client_ip();
		$data['createtime'] = time();
		$data['status'] = 0;
		if($this->_userid){
			$data['userid'] = $this->_userid;
			if(!$data['username']) $data['username'] = $this->_username;
		}
		unset($data['id']);
		if($model->add($data)){
			$this->successyulia($tipsmsg,$forward,"ok");exit;
		}else{
			$this->erroryulia (L('add_error').': '.$model->getDbError(),$forward);exit;
		}
		exit();

    }

    //文件强制下载
    public function down(){
    	$filepath = $_GET['file'];
    	if(!$filepath){
		$module = $module ? $module : MODULE_NAME;
		$id = $id ? $id : intval($_REQUEST['id']);
		$this->dao= M($module);
		$data = $this->dao->where("id=".$id)->find();
		$this->dao->where("id=".$id)->setInc('downs');
		$filepath = $data['file'];
		}
		
		$extend = pathinfo($filepath);  
		$extend = strtolower($extend["extension"]);
		$data['title'] =  $_GET['title'];
		if($data['title'])$filename = $data['title'].'.'.$extend;

		if(strpos($filepath, ':/')) { 
			header("Location: $filepath");
		} else {	
			$filepath = '.'.$filepath;
			if(!$filename) $filename = basename($filepath);
			$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
			if(strpos($useragent, 'msie ') !== false) $filename = rawurlencode($filename);
			$filetype = strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
			$filesize = sprintf("%u", filesize($filepath));
			if(ob_get_length() !== false) @ob_end_clean();
			header('Pragma: public');
			header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
			header('Cache-Control: no-store, no-cache, must-revalidate');
			header('Cache-Control: pre-check=0, post-check=0, max-age=0');
			header('Content-Transfer-Encoding: binary');
			header('Content-Encoding: none');
			header('Content-type: '.$filetype);
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			header('Content-length: '.$filesize);
			readfile($filepath);
		}
		exit;
	}
	
 
}
?>