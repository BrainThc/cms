<?php
/**
 * 
 * Area (联动地区管理)
 *
 */
if(!defined("ThinkPHP")) exit("Access Denied");
class AreaAction extends AdminbaseAction {

	protected $dao;

    function _initialize()
    {	
		parent::_initialize();
		$this->dao=M('Area');
    }

	function index(){

		$_GET['provinceid'] = $provinceid = intval($_GET['provinceid']);
		$_GET['cityid'] = $cityid = intval($_GET['cityid']);
		$_GET['areaid'] = $areaid = intval($_GET['areaid']);
		$data = $map = array();
		$map['parentid'] = 0;
		$data['province'] = $this->dao->where($map)->select();

		if($provinceid){
			$map['parentid'] = $provinceid;
			$data['city'] = $this->dao->where($map)->select();
		}
		if($cityid){
			$map['parentid'] = $cityid;
			$data['area'] = $this->dao->where($map)->select();
		}

		$this->assign($_GET);
		$this->assign('data',$data);
		$this->display();
	}

	function insert(){		
		$data = array();
		$data['parentid'] = intval($_GET['pid']);
		$data['name'] = $_GET['name'];
		$rs = $this->dao->add($data); 
		$rs = $rs?1:0;
		echo json_encode($rs);
	}

	function update(){
		$data = array();
		$data['id'] = intval($_GET['id']);
		$data['name'] = $_GET['name'];
		$rs = $this->dao->save($data); 
		$rs = $rs?1:0;
		echo json_encode($rs);
	}

	function delete(){
		$id = intval($_GET['id']);
		$do = $_GET['do'];
		$map = $ids = array();

		if($do=='province'){
			//获取城市
			$map['parentid'] = $id;
			$ids = $this->dao->where($map)->getField('id',true);
		}
		if($do=='province' || $do=='city'){
			//获取区域
			if($ids){
				$map['parentid'] = array('in',implode(',', $ids));
			}else{
				$map['parentid'] = $id;
			}
			$ids2 = $this->dao->where($map)->getField('id',true);
			$ids = array_merge($ids,$ids2);
		}

		$ids[] = $id;
		$map = array();
		$map['id'] = array('in',implode(',', $ids));
		$rs = $this->dao->where($map)->delete(); 
		$rs = $rs?1:0;
		echo json_encode($rs);
	}
}
?>