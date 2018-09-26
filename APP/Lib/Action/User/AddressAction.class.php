<?php
/**
 * 
 * User/AddressAction.class.php (收获地址模块)
 *
 */
if(!defined("ThinkPHP")) exit("Access Denied");
class AddressAction extends BaseAction{

	function _initialize(){
			
		parent::_initialize();
		$this->dao = M('User_address');
    }

    public function index(){
    	
    	$list = $map = array();
		
		$map['userid'] = $this->_userid;
		
		$list = $this->dao->where($map)->order('id desc')->select();

		if(!$list) redirect(URL('User-Address/add'));

		$this->assign('list',$list);
        $this->display();
    }
	
	public function add(){
		
		$vo = array();
		$this->assign('vo',$vo);
		$this->display('edit');
		
	}
	
	public function edit(){
		
		$vo = array();
		if($id = intval($_GET['id'])){
			$vo = $this->dao->find($id);
		}
		
		if($vo && $vo['userid'] != $this->_userid) $vo = array(); //数据不是自己的 重置
		
		$this->assign('vo',$vo);
		$this->display();
	}
	
	public function update(){
		$id = $_POST['id'] = intval($_POST['id']);
		$_POST['userid'] = $this->_userid;
		$_POST['updatetime'] = time();
		$_POST['isdefalut'] = intval($_POST['isdefalut']);

		if($id){
			$userid = $this->dao->where('id = '.$id)->getField('userid');

			if($userid == $this->_userid){
				$rs = $this->dao->save($_POST);
			}else{
				if(IS_AJAX){ 
					exit(json_encode(2));
				}else{ 
					$this->error(L('DO_EMPTY'));
				}
				
			}
		}else{

			$rs = $this->dao->add($_POST);

			//默认收货地址
			if($_POST['isdefault']==1){ 
				$map = array();
				$map['userid'] = $this->_userid;
				$map['id'] = array('NEQ',$rs);
				$this->dao->where($map)->setField('isdefault',0);
			}
		}


		if(IS_AJAX){ 

			if($rs){
				exit(json_encode(1));
			}else{
				exit(json_encode(0));
			}

		}else{ 

			if($rs){
				$this->success(L('DO_OK'),URL('User-Address/index'));
			}else{
				$this->error(L('DO_ERROR'));
			}
		}
				
		
	}
	
	public function del(){
		$map = array();
		$map['id'] = intval($_GET['id']);
		$map['userid'] = $this->_userid;
		$rs = $this->dao->where($map)->delete();
		if($rs){
			$this->success(L('DO_OK'),URL('User-Address/index'));
		}else{
			$this->error(L('DO_ERROR'));
		}
	}
	
	public function isdefault(){
		$map = array();
		$map['id'] = intval($_GET['id']);
		$userid = $this->dao->where($map)->getField('userid');

		if($userid == $this->_userid){
			$this->dao->where('userid = '.$userid)->setField('isdefault',0);
			$rs = $this->dao->where($map)->setField('isdefault',1);
			if($rs){
				$this->success(L('DO_OK'),URL('User-Address/index'));
			}else{
				$this->error(L('DO_ERROR'));
			}
		}else{
			$this->error(L('DO_EMPTY'));
		}
		
	}

}
?>