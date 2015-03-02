<?php
namespace Home\Controller;
use Think\Controller;
class ApiController extends Controller {
    protected function _initialize() {
		//include('initialize.php');
    }
	
	public function get_more(){
		$ids=I('get.',NULL);
		$p=$ids['page'];
		$start=($p-1)*6+6;
		$end=$start+5;
		
		if($ids['uid']){
			$con['uid']=$ids['uid'];
		}
		$con['isok']=1;
		$sql="`infotype` !=3";
		$links = M('nb_ideainfo'); // 实例化User对象
		$rs=$links->where($con)->where($sql)->order('idea_id desc')->limit($start,$end)->select();
		if($rs){
			$str=login_idea_tpl();
			foreach($rs as $k=>$v){
				$find=array("IDEA_ID","USERNAME","HEADURL","TIME","TITLE","INFO","TAGS","ZAN","C_URL","COMMENT","MYIDEA");
				if($v['url']){
					$v['title']='<a href="'.$v['url'].'" target="_blank" class=""><i class="am-icon-link"></i>'.$v['title'].'</a>';
				}
				$replace = array($v['idea_id'],$v['username'],$v['headurl'],date("Y-m-d H:i",$v['time']),$v['title'],$v['info'],$v['tags'],$v['zan'],U('Idea/view',array('idea_id'=>$v['idea_id'])),$v['c'],U('Index/myidea',array('uid'=>$v['uid'])));
				$out[]=str_replace($find,$replace,$str);
			}
			$out_str['li']=implode("",$out);
		}else{
			$out_str['li']='<li class="am-comment" align="center"><a href="#" class="am-list-item-hd">木有更多了</a> </li>';
		}

		$this->ajaxReturn($out_str,'json');	
	}
}