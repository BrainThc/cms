<?php

if(!defined("ThinkPHP")) exit("Access Denied");
class SdkAction extends BaseAction{
	function _initialize(){
		parent::_initialize();
    }
	//SNS登录首页
	public function index(){

	}

	//绑定会员
	public function binding(){
		$id = intval($_GET['id']);
		$type = $_GET['type'];
		if($type){
			if($id){
				//删除绑定
				$map = array();
				$map['id'] = $id;
				$map['uid'] = $this->_userid;
				$rs = M('User_sdk')->where($map)->delete();
				if($rs){
					$this->success('操作成功！');
				}else{
					$this->error('操作失败！');
				}
			}else{
				$this->login($type,$binding = 1);
			}
		}else{
			$this->error('缺少必要参数！');
		}

	}

	//登录地址
	public function login($type = null,$binding = 0){
		if($binding == 0 && $this->_userid) $this->error('您已经登录了！');
		empty($type) && $this->error('参数错误');

		//加载ThinkOauth类并实例化一个对象
		import("@.ThinkSDK.ThinkOauth");
		$sns  = ThinkOauth::getInstance($type);

		//跳转到授权页面
		redirect($sns->getRequestCodeURL());
	}

	//授权回调地址
	public function callback($type = null, $code = null){
		(empty($type) || empty($code)) && $this->error('参数错误');
		
		//加载ThinkOauth类并实例化一个对象
		import("@.ThinkSDK.ThinkOauth");
		$sns  = ThinkOauth::getInstance($type);

		//腾讯微博需传递的额外参数
		$extend = null;
		if($type == 'tencent'){
			$extend = array('openid' => $this->_get('openid'), 'openkey' => $this->_get('openkey'));
		}

		//请妥善保管这里获取到的Token信息，方便以后API调用
		//调用方法，实例化SDK对象的时候直接作为构造函数的第二个参数传入
		//如： $qq = ThinkOauth::getInstance('qq', $token);
		$token = $sns->getAccessToken($code , $extend);

		//获取当前登录用户信息
		if(is_array($token)){
			$user_info = A('Type', 'Event')->$type($token);

			//会员登录查询
			$m = M('User');
			$sdk = M('User_sdk');
			//查找sdk
			$map = $data = array();
			$map['type'] = strtolower($user_info['type']);
			$map['openid'] = $token['openid'];
			$vo = $sdk ->where($map)-> find();
			if($vo['uid']){
				$user = $m->find($vo['uid']);
				if($user){

					session('uid',$user['id']);
					redirect(URL('User-Login/login'));
					exit;
				}else{
					$sdk->delete($vo['id']);
				}

			}

			if($this->_userid){
				$where = array();
				$where['type'] = $map['type'];
				$where['userid'] = $this->_userid;
				$mysdk = $sdk->where($where)->find();
				if($mysdk){
					$this->error('操作错误，请先取消绑定！',U('Index/profile'));
				}
				unset($where); 
				//绑定会员
				$data = $map;
				$data['uid'] = $this->_userid;
				$rs = $sdk->add($data);
				if($rs){
					$this->success('绑定成功！',U('Index/profile'));
				}else{
					$this->error('绑定失败！',U('Index/profile'));
				}
			}else{
				//没有找到会员
				$this->error('您还没有绑定快捷登录,快快去登录绑定吧！！',U('Login/index'));
			}

			

			

		}
	}






}