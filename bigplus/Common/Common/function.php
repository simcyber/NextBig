<?php
function session_userinfo($arr){
	foreach($arr as $k=>$v){
		$_SESSION[$k]=$v;
	}
	return true;
}

function php_post($url,$data){
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
 curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 $tmpInfo = curl_exec($ch);
 if (curl_errno($ch)) {
  return curl_error($ch);
 }
 curl_close($ch);
 return $tmpInfo;
}

function https_request($url)
{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($curl);
	if (curl_errno($curl)) {return 'ERROR '.curl_error($curl);}
	curl_close($curl);
	return $data;
}

function cache_img($url){
	$img=https_request($url);
	//指定打开的文件  
	$img_path="Public/wximg/".$_SESSION['uid'];
	if(dir($img_path)){
		deldir($img_path);			
	}
	mkdir($img_path);
	$fp = @ fopen($img_path."/bangding.jpg", 'a');  
	//写入图片到指定的文本  
	fwrite($fp, $img);  
	fclose($fp); 
}

function sync_userinfo($arr){
	$r['social_uid']=$con['social_uid']=$arr['social_uid'];
	$r['media_type']=$con['media_type']=$arr['media_type'];
	$tmp=M('nb_userinfo')->where($con)->find();
	$r['username']=$arr['username'];
	$r['tinyurl']=$arr['tinyurl'];
	$r['lasttimg']=time();
	$r['info']=json_encode($arr);
	if($tmp){
	$_SESSION['uid']=$tmp['uid'];
	M('nb_userinfo')->where($con)->save($r);
	}else{
	$_SESSION['uid']=M('nb_userinfo')->add($r);
	}
	return true;
}

function get_goodat(){
	$con['uid']=$_SESSION['uid'];
	$tmp=M('nb_userinfo')->where($con)->find();
	if($tmp['goodat']){
		$_SESSION['goodat']=explode(",",$tmp['goodat']);
		return true;
	}else{
		return false;
	}
}

function get_tags($info){
	 $tmp=str_replace("，",",",$info);
	 return $tmp;
}

function get_msg_num(){
	$con['uid']=$_SESSION['uid'];
	$con['ok']=1;
	$msg_n=M('nb_msg')->where($con)->count();
	return $msg_n;
}

function add_msg($uid,$title,$msg,$url){
	$r['uid']=$uid;
	$r['title']=$title;
	$r['msg']=$msg;
	$r['url']=$url;
	M('nb_msg')->add($r);
}

function msg_read($mid){
	$con['mid']=$mid;
	$r['ok']=0;
	M('nb_msg')->where($con)->save($r);
}

function idea_tpl(){
	$str='<li class="am-comment" id="cc_IDEA_ID"><a href="MYIDEA"><img src="HEADURL" alt="" class="am-comment-avatar" width="48" height="48"></a>
						<div class="am-comment-main">
							<header class="am-comment-hd">
							<div class="am-comment-meta">
								<a href="#USERNAME" class="am-comment-author" title="USERNAME">USERNAME</a> 发布于 <time datetime="TIME" title="TIME">TIME</time>
							</div>
							</header>
							<div class="am-comment-bd">			
								<blockquote>
									TITLE
								</blockquote>
								<div class="p_info" style="height:4.0rem;line-height:2rem; overflow:hidden;" onClick="show_info(IDEA_ID)" id="show_infoIDEA_ID">
									<span class="am-badge am-badge-secondary">IN_FTYPE</span>
									INFO
									<a href="E_D_I_T" class="am-text-warning"><i class="am-header-icon am-icon-edit"></i>修改</a>
								</div>
								<span class="am-fr am-text-secondary am-text-sm">TAGS</span>
								<hr data-am-widget="divider" style="" class="am-divider am-divider-default" />
								<div class="am-fr">
									<a href="#cc_IDEA_ID" class="am-text-primary am-text-sm" c_type="z" idea_id="IDEA_ID" onClick="add_zan(ZAN,IDEA_ID)"><span id="z_IDEA_ID" class="am-badge am-badge-primary">ZAN</span><i class="am-header-icon am-icon-hand-o-up"></i>赞</a>|
									<a href="C_URL" class="am-text-success am-text-sm"><i class="am-header-icon am-icon-comment-o"></i>我来说两句<small class="am-badge am-badge-success">COMMENT</small></a>
								</div>
							</div>
						</div>
						</li>';
	return $str;	
}


function login_idea_tpl(){
	$str='<li class="am-comment" id="cc_IDEA_ID"><a href="MYIDEA"><img src="HEADURL" alt="" class="am-comment-avatar" width="48" height="48"></a>
						<div class="am-comment-main">
							<header class="am-comment-hd">
							<div class="am-comment-meta">
								<a href="#USERNAME" class="am-comment-author" title="USERNAME">USERNAME</a> 发布于 <time datetime="TIME" title="TIME">TIME</time>
							</div>
							</header>
							<div class="am-comment-bd">			
								<blockquote>
									TITLE
								</blockquote>
								<div class="p_info" style="height:4.0rem;line-height:2rem; overflow:hidden;" onClick="show_info(IDEA_ID)" id="show_infoIDEA_ID">
									INFO
								</div>
								<span class="am-fr am-text-secondary am-text-sm">TAGS</span>
							</div>
						</div>
						</li>';
	return $str;	
}

function get_tag_info($infotype){
	switch($infotype){
		case 1:
			$info="新产品";
			break;
		case 2:
			$info="好文章";
			break;
		case 3:
			$info="新想法";
			break;
		case 6:
			$info="日报";
			break;
		default:
			$info="默认";
			break;
	}
	return $info;
}

function yichuli($link_id){
	$con['link_id']=$link_id;
	$r['post']=1;
	M('nb_rss_links')->where($con)->save($r);
}
