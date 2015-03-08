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
	<div class="am-u-md-10 am-u-md-centered">
		<div class="am-g">
			<div class="am-u-md-8">
				<form action="<?php echo U('Index/do_add_post');?>" method="post" class="am-form">
				<br>
				<label for="nickname">标题:<small style="color:#F00;">(可选)</small></label>
				<input type="text" name="title" id="title" value="">
				<br>
				<label for="nickname">内容:</label>
				<textarea style="font-family:'Microsoft YaHei'; width:100%; height:160px;" name="body"></textarea>
				
				<br>
				<label for="nickname">标签:</label>
					<select name="tag" data-am-selected="{maxHeight: 100}">
					  <option value="默认">默认</option>
					  <?php if(is_array($rs)): $i = 0; $__LIST__ = $rs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["tagname"]); ?>"><?php echo ($vo["tagname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				<br />
				<div class="am-cf">
				<input type="submit" value="发 布" class="am-btn am-btn-primary am-btn-sm am-fr">
				</div>
				</form>
			</div>
			<div class="am-u-md-4">
			<hr>
			<a href="<?php echo U('Index/add_posts');?>" class="am-btn am-btn-secondary">发布话题</a>
			</div>	
		</div>
	</div>
</div>
<footer data-am-widget="footer" class="am-footer am-footer-default am-topbar-fixed-bottom" data-am-footer="{  }">
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