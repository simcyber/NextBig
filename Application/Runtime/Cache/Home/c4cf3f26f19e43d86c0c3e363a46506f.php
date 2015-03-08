<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title><?php echo ($title); ?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  <link rel="alternate icon" type="image/png" href="/nextbbs/Public/i/favicon.png">
  <link rel="stylesheet" href="/nextbbs/Public/css/amazeui.min.css"/>
	<!--[if lt IE 9]>
	<script src="/nextbbs/Public/js/ie9/jquery.min.js"></script>
	<script src="/nextbbs/Public/js/ie9/jquery.min.js"></script>
	<script src="/nextbbs/Public/js/polyfill/rem.min.js"></script>
	<script src="/nextbbs/Public/js/polyfill/respond.min.js"></script>
	<script src="/nextbbs/Public/js/amazeui.legacy.js"></script>
	<![endif]-->

	<!--[if (gte IE 9)|!(IE)]><!-->
	<script src="/nextbbs/Public/js/jquery.min.js"></script>
	<script src="/nextbbs/Public/js/amazeui.min.js"></script>
	<!--<![endif]-->

</head>
<body>
<header class="am-topbar am-topbar-fixed-top">
  <h1 class="am-topbar-brand">
    <a href="#">blog</a>
  </h1>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
          data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span
      class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav">
      <li class="am-active"><a href="#">首页</a></li>
      <li><a href="#">项目</a></li>
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          菜单 <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li class="am-dropdown-header">标题</li>
          <li><a href="#">关于我们</a></li>
          <li><a href="#">关于字体</a></li>
          <li><a href="#">TIPS</a></li>
        </ul>
      </li>
	  <li><a href="<?php echo U('Index/login');?>" class="am-btn am-btn-secondary am-radius">登录</a></li>
	  <li><a href="<?php echo U('Index/reg');?>" class="am-btn am-btn-success am-radius">注册</a></li>
    </ul>

    <form class="am-topbar-form am-topbar-left am-form-inline am-topbar-right" role="search">
      <div class="am-form-group">
        <input type="text" class="am-form-field am-input-sm" placeholder="搜索文章">
      </div>
      <button type="submit" class="am-btn am-btn-default am-btn-sm">搜索</button>
    </form>

  </div>
</header>


<div class="am-g">
  <div class="am-u-lg-4 am-u-md-6 am-u-sm-centered">

    <br>
    <br>
	<div style="text-align: center;">
	<img id="avatar_change" width="30%" src="/nextbbs/Public/img/_<?php echo ($avatar_id); ?>.png" alt="头像" class="am-img-thumbnail am-circle">
	</div>
	
    <form action="<?php echo U('Index/do_set_avatar');?>" method="post" class="am-form">

	<br>
      <label for="nickname">昵称:</label>
      <input type="text" name="nickname" id="nickname" value="<?php echo (session('nickname')); ?>">
	  <input name="avatar" id="avatar" type="text" style="display:none;" value="/nextbbs/Public/img/_<?php echo ($avatar_id); ?>.png">
	  <br>
	  <label for="email">邮箱:</label>
      <input type="email" readonly="readonly" name="email" id="email" value="<?php echo (session('email')); ?>">
	  <br>
      <div class="am-cf">
        <input type="submit" value="设 置" class="am-btn am-btn-primary am-btn-sm am-fl">
      </div>
    </form>
  </div>
</div>
<script>
$("#avatar_change").click(function(){
	$.getJSON("<?php echo U('Index/get_avatar');?>", function(json){
		$("#avatar_change").attr("src",json.url.toString());
		$("#avatar").val(json.url.toString());
	});
});
</script>
<footer data-am-widget="footer" class="am-footer am-footer-default am-topbar-fixed-bottom" data-am-footer="{  }">
  <div class="am-footer-switch">
    <span class="am-footer-ysp" data-rel="mobile" data-am-modal="{target: '#am-switch-mode'}">云适配版</span>
    <span class="am-footer-divider">|</span>
    <a id="godesktop" data-rel="desktop" class="am-footer-desktop"
    href="javascript:">电脑版</a>
  </div>
  <div class="am-footer-miscs ">
    <p>由
      <a href="http://www.yunshipei.com/" title="诺亚方舟" target="_blank" class="">诺亚方舟</a>提供技术支持</p>
    <p>CopyRight©2014 AllMobilize Inc.</p>
    <p>京ICP备13033158</p>
  </div>
  
<div id="am-footer-modal" class="am-modal am-modal-no-btn am-switch-mode-m am-switch-mode-m-default">
  <div class="am-modal-dialog">
    <div class="am-modal-hd am-modal-footer-hd">
      <a href="javascript:void(0)" data-dismiss="modal" class="am-close am-close-spin "
      data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">您正在浏览的是
      <span class="am-switch-mode-owner">云适配</span>
      <span class="am-switch-mode-slogan">为您当前手机订制的移动网站。</span>
    </div>
  </div>
</div>
</footer>


</body>
</html>