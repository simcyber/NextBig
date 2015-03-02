<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    protected function _initialize() {
		include('initialize.php');
    }
    public function index(){
		$this->title=$_SESSION['username']."-首页-NextBig";
		$this->rs=M('nb_ideainfo')->order('time desc')->limit(10)->select();
		$this->display();
    }
	
	public function login(){
		$this->title="login-plus";
		$this->display();
	}
	
	//第三方登录使用百度开放平台社会化登录
	public function so_login(){
		echo '<meta charset="utf-8"> ';
		$p=I('post.',NULL);
		$ids=I('get.',NULL);
		$url="https://openapi.baidu.com/social/oauth/2.0/token?grant_type=authorization_code&code=".$ids['code']."&client_id=百度开放平台&client_secret=百度开放平台&redirect_uri=http%3A%2F%2Fnextbig.net%2FIndex%2Fso_login%2Ftmp%2F1";
		$str=https_request($url);
		$arr=json_decode($str,true);
		$token=$arr['access_token'];
		$url="https://openapi.baidu.com/social/api/2.0/user/info?access_token=".$token;
		$str=https_request($url);
		$arr=json_decode($str,true);
		if($arr['error_code']){
			$this->error("授权错误，请返回重新登录一下~",U('Index/login'));
		}else{
			$is_login=session_userinfo($arr);
			if($is_login){
				sync_userinfo($arr);
				$_SESSION['is_login']=true;
			}
			if(get_goodat()){
			$url="http://".$_SERVER['HTTP_HOST'].U('Index/index');
			header("location:".$url);
			//$this->success("登录成功！",U('Index/index'));
			}else{
			$this->success("登录成功，请补充一下您的擅长信息，好让小伙伴们找到你呀~！",U('Index/goodat'));
			}
		}
	}
	
	public function goodat(){
		$this->title="填写您的擅长领域";
		$this->display();
	}
	
	public function do_goodat(){
		$p=I('post.',NULL);
		$con['uid']=$_SESSION['uid'];
		$p['goodat']=get_tags($p['goodat']);
		M('nb_userinfo')->where($con)->save($p);
		if(strstr($p['goodat'],",")){
			$tmp=explode(",",$p['goodat']);
			foreach($tmp as $k=>$v){
				$c['tagname']=$v;
				$tmp1=M('nb_tags')->where($c)->find();
				if($tmp1){				
				}else{
				M('nb_tags')->add($c);
				}
			}
		}else{
			$c['tagname']=$p['goodat'];
			$tmp1=M('nb_tags')->where($c)->find();
			if($tmp1){				
			}else{
			M('nb_tags')->add($c);
			}
		}
		$this->success("保存成功！",U('Index/index'));
	}
	
	public function msg(){
		$this->title=$_SESSION['username']."-消息列表-NextBig";
		$con['uid']=$_SESSION['uid'];
		$con['ok']=1;
		$this->rs=M('nb_msg')->where($con)->select();
		$this->display();
	}
	
	public function get_more(){
		$ids=I('get.',NULL);
		$p=$ids['page'];
		$start=($p-1)*6+10;
		$end=$start+5;
		
		if($ids['uid']){
			$con['uid']=$ids['uid'];
		}
		$con['isok']=1;
		$links = M('nb_ideainfo');
		$rs=$links->where($con)->order('idea_id desc')->limit($start,$end)->select();
		if($rs){
			$str=idea_tpl();
			foreach($rs as $k=>$v){
				$find=array("IDEA_ID","USERNAME","HEADURL","TIME","TITLE","INFO","TAGS","ZAN","C_URL","COMMENT","MYIDEA","IN_FTYPE","E_D_I_T");
				if($v['url']){
					$v['title']='<a href="'.$v['url'].'" target="_blank" class=""><i class="am-icon-link"></i>'.$v['title'].'</a>';
				}
				$replace = array($v['idea_id'],$v['username'],$v['headurl'],date("Y-m-d H:i",$v['time']),$v['title'],$v['info'],$v['tags'],$v['zan'],U('Idea/view',array('idea_id'=>$v['idea_id'])),$v['c'],U('Index/myidea',array('uid'=>$v['uid'])),get_tag_info($v['infotype']),U('Idea/edit_idea',array('idea_id'=>$v['idea_id'])));
				$out[]=str_replace($find,$replace,$str);
			}
			$out_str['li']=implode("",$out);
		}else{
			$out_str['li']='<li class="am-comment" align="center"><a href="#" class="am-list-item-hd">木有更多了</a> </li>';
		}

		$this->ajaxReturn($out_str,'json');	
	}
	
	public function myidea(){
		$ids=I('get.',NULL);
		if($ids['uid']){
			$con['uid']=$ids['uid'];
		}else{
			$con['uid']=$_SESSION['uid'];
		}
		$userinfo=M('nb_userinfo');
		$this->u=$u=$userinfo->where($con)->find();
		$this->title=$u['username']."-发布的";
		$this->rs=M('nb_ideainfo')->where($con)->order('time desc')->limit(10)->select();
		$this->display();
	}
	
	public function setting(){
		$this->title="设置";
		$con['uid']=$_SESSION['uid'];
		$this->rs=M('nb_userinfo')->where($con)->find();
		$this->display();
	}
	
	public function login_out(){
		session_unset(); 
		session_destroy();
		$this->success("退出成功！",U('Index/index'));
	}
}