<?php
/**
 * 
 * User/ShoucangAction.class.php (收藏模块)
 *
 */
if(!defined("ThinkPHP")) exit("Access Denied");
class ShoucangAction extends BaseAction{

	function _initialize(){
			
		parent::_initialize();
		if(!$this->_userid) $this->error(L('nologin'),URL('User-Login/index'));
		$this->dao = M('Shoucang');
    }

    public function index(){
		
		import('@.Action.Adminbase');
		$c=new AdminbaseAction();
		$map['userid']=intval($this->_userid);

		$data=$c->_list(MODULE_NAME,$map);

		$this->assign ( 'page', $data['page'] );
		$this->assign ( 'list', $data['list'] );

        $this->display();
    }
	
	public function insert(){ 
		$data = array();
		$data['pid'] = intval($_GET['pid']);
		$data['userid'] = intval($this->_userid);
		$row = M('Product')->find($data['pid']);
		$id = $this->dao->where($data)->getField('id');
		if($row != null &&  $id == null){ 

			$data['title'] = $row['title'];
			$data['thumb'] = $row['thumb'];
			$data['url'] = $row['url'];
			$data['catid'] = $row['catid'];
			$data['username'] = $this->_username;
			$data['status'] = 1;
			$data['createtime'] = $data['updatetime'] = time();
			$rs = $this->dao->add($data);
			$rs = $rs?1:0;
			echo json_encode($rs);
		}

	}
	
	public function del(){
		$map = array();
		$map['id'] = intval($_GET['id']);
		$map['userid'] = $this->_userid;
		$rs = $this->dao->where($map)->delete();
		if($rs){
			$this->success(L('DO_OK'));
		}else{
			$this->error(L('DO_ERROR'));
		}
	}


	public function deleteall(){ 
		$map = array();
		$map['userid'] = $this->_userid;
		$ids = $_POST['ids'];
		foreach ($ids as $k => $v) {
			if(!$v) unset($ids[$k]);
		}
		$map['id'] = array('in',implode(',', $ids));

		$rs = $this->dao->where($map)->delete();
		if($rs){
			$this->success(L('DO_OK'));
		}else{
			$this->error(L('DO_ERROR'));
		}

	}
	
	
}
?>