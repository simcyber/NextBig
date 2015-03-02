<?php
namespace Home\Controller;
use Think\Controller;
class IdeaController extends Controller {
    protected function _initialize() {
		include('initialize.php');
    }
    public function view(){
		$ids=I('get.',NULL);
		if($ids['mid']){
			msg_read($ids['mid']);
		}
		$con['idea_id']=$ids['idea_id'];
		$rs=$this->rs=M('nb_ideainfo')->where($con)->find();
		$this->title=$rs['title']."-评论-NextBig";
		$this->c=M('nb_ideacomments')->where($con)->order('time desc')->select();
		$this->display();
    }
	
	public function post_comments(){
		$ids=I('get.',NULL);
		$p=I('post.',NULL);
		$r['idea_id']=$ids['idea_id'];
		$r['info']=$p['info'];
		$r['time']=time();
		$r['username']=$_SESSION['username'];
		$r['headurl']=$_SESSION['tinyurl'];
		$r['uid']=$_SESSION['uid'];
		M('nb_ideacomments')->add($r);
		
		$con['idea_id']=$ids['idea_id'];
		$rs=M('nb_ideainfo')->where($con)->find();
		$cr['c']=$rs['c']+1;
		M('nb_ideainfo')->where($con)->save($cr);
		
		$data['url']="http://".$_SERVER['HTTP_HOST'].U('Idea/view',array('idea_id'=>$ids['idea_id']));
		$title=$_SESSION['username']."-给您发了一条评论";
		$msg=$p['info'];
		$url=U('Idea/view',array('idea_id'=>$ids['idea_id']));
		add_msg($rs['uid'],$title,$msg,$url);
		
		$this->ajaxReturn($data,'json');
	}
	
	public function add_zan(){
		$ids=I('get.',NULL);
		$con['idea_id']=$ids['idea_id'];
		$rs=M('nb_ideainfo')->where($con)->find();
		if(strstr($rs['zaninfo'],$_SESSION['uid'])){
			$out['msg']=$rs['zan']."已赞";
		}else{
			$tmp=explode(",,",$rs['zaninfo']);
			$tmp[]=$_SESSION['uid'];
			$r['zaninfo']=implode(",,",$tmp);
			$r['zan']=$ids['zan'];
			M('nb_ideainfo')->where($con)->save($r);
			$out['msg']=$ids['zan']."已赞";
		}
		$this->ajaxReturn($out,'json');		
	}
	
	public function read_msg(){
		$ids=I('get.',NULL);
		msg_read($ids['mid']);
	}
	
	public function edit_idea(){
		$this->ids=$ids=I('get.',NULL);
		$con['idea_id']=$ids['idea_id'];
		$this->rs=M('nb_ideainfo')->where($con)->find();
		$this->title="修改";
		$this->display();
	}
	
	public function post_edit_idea(){
		$ids=I('get.',NULL);
		$p=I('post.',NULL);
		$con['idea_id']=$ids['idea_id'];
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
		M('nb_ideainfo')->where($con)->save($r);
	}
}