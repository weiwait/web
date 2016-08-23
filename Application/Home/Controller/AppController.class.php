<?php
namespace Home\Controller;
use Think\Controller;
class AppController extends Controller {
    function _initialize(){
		
	}
	
	public function index(){
		
    }
	
	public function reg(){
		$data = array('status' => '0', 'data' => 'system error');
		$appid = trim($_POST['appid']);
		$username = trim($_POST['username']);
		$password = md5(trim($_POST['password']));
		if(empty($appid) || empty($username) || empty($password)){
			echo json_encode($data);exit;
		}
		$res = M("App","","DB_CONFIG2")->query("update app set username='".$username."',password='".$password."' where appid='".$appid."'");
		if($res){
			$data['status'] = 1;
			$data['data'] = 'ok';
		}
		echo json_encode($data);exit;
    }
}