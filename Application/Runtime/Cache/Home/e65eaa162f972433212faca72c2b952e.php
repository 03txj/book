<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<meta http-equiv="Cache-Control" content="no-transform" />
	<title><?php echo ($TDK["title"]); ?></title>
	<meta name="keywords" content="<?php echo ($TDK["keyword"]); ?>" />
	<meta name="description" content="<?php echo ($TDK["description"]); ?>" />
	<link rel="canonical" href="<?php echo ($TDK["canonicalurl"]); ?>"/>
	<meta name="applicable-device" content="pc">
	<meta http-equiv="mobile-agent" content="format=html5; url=<?php echo ($TDK["canonicalurl_m"]); ?>">
	<link rel="stylesheet" href="/book/Public/<?php echo ($theme); ?>/css/style.css?v<?php echo ($version); ?>" />
	<script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="/book/Public/<?php echo ($theme); ?>/js/header.js?v<?php echo ($version); ?>"></script>
	<script>var znsid = '<?php echo ($comset["znsid"]); ?>';</script>
</head>
<body>
<div id="wrapper">
	<script>login();</script>
<div class="header">
	<div class="header_logo">
		<a href="<?php echo ($TDK["weburl"]); ?>" title="<?php echo ($TDK["webname"]); ?>"><?php echo ($TDK["webname"]); ?></a>
	</div>
	<script>panel();</script>
</div>
<div class="nav">
	<ul>
		<li><a href="<?php echo ($TDK["weburl"]); ?>" title="<?php echo ($TDK["webname"]); ?>"><?php echo ($TDK["webname"]); ?></a></li>
		<li><a href="<?php echo U('/home/index/bookcase');?>">临时书架</a></li>
		<?php if(is_array($category)): foreach($category as $key=>$vo): ?><li><a href="<?php echo ($vo['url']); ?>"><?php echo ($vo['name']); ?></a></li><?php endforeach; endif; ?>
		<li><a href="<?php echo ($catelist["all"]); ?>">小说书库</a></li>
		<li><a href="<?php echo ($catelist["top"]); ?>">排行榜单</a></li>
	</ul>
</div>
	<div id="main">
		<div id="hotcontent">
			<div class="ll">
				<?php if(is_array($hotlist)): foreach($hotlist as $key=>$v): ?><div class="item">
					<div class="image">
						<a href="<?php echo ($v['rewriteurl']); ?>" title="<?php echo ($TDK["webname"]); ?> <?php echo ($TDK["catename"]); ?> <?php echo ($v['title']); ?>"><img <?php echo ($comset["src"]); ?>="<?php echo ($v['thumb']); ?>" alt="<?php echo ($v['title']); ?>" width="120" height="150" onerror="this.src='/book/Public/images/nocover.jpg'" /></a>
					</div>
					<dl>
						<dt><span><a href="<?php echo reurl('author', $v);?>" target="_blank" title="<?php echo ($v["author"]); ?>"><?php echo ($v["author"]); ?></a></span><a href="<?php echo ($v['rewriteurl']); ?>" title="<?php echo ($TDK["webname"]); ?> <?php echo ($TDK["catename"]); ?> <?php echo ($v['title']); ?>"><?php echo ($v['title']); ?></a></dt>
						<dd><?php echo ($v['description']); ?>...</dd>
					</dl>
					<div class="clear"></div>
				</div><?php endforeach; endif; ?>
			</div>
		</div>
		<?php echo ($advcode["list_1"]["code"]); ?>
		<div id="newscontent">
			  <div class="l">
				<h2><?php echo ($TDK["catename"]); ?>最近更新列表</h2>
				<ul>
					<?php if(is_array($articlelist)): foreach($articlelist as $key=>$v): ?><li class="item-cover">
						<a href="<?php echo ($v['rewriteurl']); ?>" title="<?php echo ($TDK["webname"]); ?> <?php echo ($TDK["catename"]); ?> <?php echo ($v['title']); ?>">
							<img <?php echo ($comset["src"]); ?>="<?php echo ($v['thumb']); ?>" alt="<?php echo ($v['title']); ?>" onerror="this.src='/book/Public/images/nocover.jpg'" />
							<h3><?php echo ($v['title']); ?></h3>
						</a>
					</li><?php endforeach; endif; ?>
				</ul>
				<div class="pages">
					<?php echo ($pagehtml); ?>
				</div>
			</div>
			<div class="r">
				<h2>好看的<?php echo ($TDK["catename"]); ?></h2>
				<ul>
					<?php if(is_array($newestlist)): foreach($newestlist as $key=>$v): ?><li>
						<span class="s1">[<a href="<?php echo ($v["cateurl"]); ?>" title="<?php echo ($TDK["webname"]); ?> <?php echo ($TDK["catename"]); ?>"><?php echo ($TDK["catename_short"]); ?></a>]</span>
						<span class="s2"><a href="<?php echo ($v["rewriteurl"]); ?>" title="<?php echo ($TDK["webname"]); ?> <?php echo ($TDK["catename"]); ?> <?php echo ($v["title"]); ?>" target="_blank"><?php echo ($v["title"]); ?></a></span>
						<span class="s5"><a href="<?php echo reurl('author', $v);?>" target="_blank" title="<?php echo ($v["author"]); ?>"><?php echo ($v["author"]); ?></a></span>
					</li><?php endforeach; endif; ?>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		<div class="dvcode"><?php echo ($advcode["list_2"]["code"]); ?></div>
	</div>
	<div class="footer">
	<div class="footer_link"></div>
	<div class="footer_cont">
		<script>footer();</script><?php echo ($statcode); ?>
	</div>
</div>
<?php if($comset["src"] != 'src'): ?><script src="//cdn.bootcss.com/jquery_lazyload/1.9.7/jquery.lazyload.min.js"></script>
<script>
$(function() {
	$('[rel-class=lazyload]').lazyload({effect: "fadeIn"});
});
</script><?php endif; ?>
<?php echo ($advcode["global_footer"]["code"]); ?>
</div>
</body>
</html>