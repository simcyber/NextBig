<?php
$this->title="Plus";
$p=I('post.',NULL);
$ids=I('get.',NULL);
if($_SESSION['is_login'] or $p or $ids['tmp']==1){
}else{
	$this->title="NextBig-发现有趣新玩意";
	$sql="`infotype` !=3";
	$this->rs=M('nb_ideainfo')->where($sql)->order('time desc')->limit(6)->select();
	$this->display("Index:login");
	exit;
}