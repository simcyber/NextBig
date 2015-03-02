<?php
namespace Home\Controller;
use Think\Controller;
class AddController extends Controller {
    protected function _initialize() {
		include('initialize.php');
    }
    public function add_new_idea(){
		$this->title="发布Idea-NextBig";
		$this->display();
    }
	
	public function post_add_new_idea(){
		$p=I('post.',NULL);
		$r['uid']=$_SESSION['uid'];
		$r['username']=$_SESSION['username'];
		$r['headurl']=$_SESSION['tinyurl'];
		$r['title']=$p['title'];
		$r['tags']=get_tags($p['tags']);
		$r['info']=$p['info'];
		$r['url']=$p['url'];
		$r['infotype']=$p['infotype'];
		$r['time']=time();
		$r['zan']=1;
		M('nb_ideainfo')->add($r);
	}

}