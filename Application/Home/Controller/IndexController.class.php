<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function _initialize(){
		$this->title="NextBig";
	}
    public function index(){
		$g=I('get.');
		if($g){
		$this->tag=urldecode($g['tag']);
		$con['tag']=urldecode($g['tag']);
		}
		$this->rs=M('nb_posts')->where($con)->select();
        $this->display();
    }
	
	public function login(){
		$this->title="登录";
		$this->display();
	}
	
	public function do_reg(){
		$p=I('post.');
		if($p['password']==$p['password1']){
			$con['email']=$p['email'];
			$tmp=M('nb_userinfo')->where($con)->find();
			if($tmp){
				$this->error("这个帐号已经注册了哎~请登录~！",U('Index/login'));
			}else{
				$r['email']=$p['email'];
				$r['password']=encode_password($p['password']);
				$uid=M('nb_userinfo')->where($con)->add($r);
				$_SESSION['uid']=$uid;
				$_SESSION['email']=$p['email'];
				$this->success("注册成功！",U('Index/set_avater',array('uid'=>$uid)));
			}			
		}else{
			$this->error("两次密码不一致！");
		}
	}
	
	public function set_avater(){
		$this->title="设置资料";
		$g=I('get.');
		$this->avatar_id=rand(1,96);
		$this->display();
	}
	
	public function get_avatar(){
		$data['url'] ='http://'.$_SERVER['SERVER_NAME'].__ROOT__."/Public/img/_".rand(1,96).".png";
		$this->ajaxReturn($data);
	}
	
	public function do_set_avatar(){
		$p=I('post.');
		$con['uid']=$_SESSION['uid'];
		$_SESSION['avatar']=$p['avatar'];
		$_SESSION['nickname']=$p['nickname'];
		M('nb_userinfo')->where($con)->save($p);
		$this->success("注册成功！",U('Index/index'));
	}
	
	public function add_posts(){
		$this->title="发布主题";
		$this->rs=M('nb_tags')->where($con)->select();
		$this->display();
	}
	
	public function do_add_post(){
		$p=I('post.');
		$p['uid']=$_SESSION['uid'];
		$p['nickname']=$_SESSION['nickname'];
		$p['time']=time();
		M('nb_posts')->add($p);
		$this->success("发布成功！",U('Index/index'));
	}
}