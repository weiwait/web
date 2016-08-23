<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    function _initialize(){
		
	}
	
	public function index(){
		$user_id = session('user.id');
		if(!empty($user_id)){
			$this->redirect('Home/User/index');
		}
		
		$this->display('login');
    }
	
	public function login(){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		if(!empty($username) && !empty($password)){
			$sql = "select * from app where phonenumber='$username' and password='$password'";
			$res = M("User","","DB_CONFIG1")->query($sql);
			if(!empty($res)){
				session('user.id',$res[0]['id']);  //设置session
				session('user.appid',$res[0]['id']);  //设置session
				session('user.username',$res[0]['username']);  //设置session
				session('user.phonenumber',$res[0]['phonenumber']);  //设置session
				session('user.headurl',$res[0]['headurl']);  //设置session
				
				$url = U('Home/User/machine_list');
				$this->success('登录成功', $url);
			}else{
				$this->error('用户名或密码不正确');
			}
		}else{
			$this->error('用户名或密码为空');
		}
	}
	
	public function logout(){
		session(null); // 清空当前的session
		$this->redirect('/Home/Index/index');
	}
	
	public function addAction(){    
		header("Content-type:text/html;charset=utf-8");
		if(SendMailer('516147248@qq.com','标题','<a href="#">内容</a>'))
			echo '发送成功！';
			//$this->success('发送成功！');
		else
			echo '发送失败';
			//$this->error('发送失败');
	}
}