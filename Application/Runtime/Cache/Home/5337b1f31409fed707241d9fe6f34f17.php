<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<meta http-equiv="Cache-Control" content="no-transform" />
	<title><?php echo ($TDK["title"]); ?></title>
	<meta name="keywords" content="<?php echo ($TDK["keyword"]); ?>" />
	<meta name="description" content="<?php echo ($TDK["description"]); ?>" />
	<link rel="canonical" href="<?php echo ($TDK["weburl"]); ?>"/>
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
			<div class="l">
				<?php if(is_array($dataarea_list["pc_index_fengtui"])): foreach($dataarea_list["pc_index_fengtui"] as $key=>$v): ?><div class="item">
					<div class="image">
						<a href="<?php echo ($v["rewriteurl"]); ?>" title="<?php echo ($TDK["webname"]); ?> <?php echo ($v["title"]); ?>"><img <?php echo ($comset["src"]); ?>="<?php echo ($v["thumb"]); ?>" alt="<?php echo ($TDK["webname"]); ?> <?php echo ($v["title"]); ?>" width="120" height="150" onerror="this.src='/book/Public/images/nocover.jpg'" /></a>
					</div>
					<dl>
						<dt>
							<span><a href="<?php echo reurl('author', $v);?>" target="_blank" title="<?php echo ($v["author"]); ?>"><?php echo ($v["author"]); ?></a></span>
							<a href="<?php echo ($v["rewriteurl"]); ?>"><?php echo ($v["title"]); ?></a>
						</dt>
						<dd>
							<?php echo ($v["description"]); ?>...
						</dd>
					</dl>
					<div class="clear"></div>
				</div><?php endforeach; endif; ?>
			</div>
			<div class="r">
				<h2>
					人气小说榜
				</h2>
				<ul>
					<?php if(is_array($dataarea_list["pc_index_jingdian"])): foreach($dataarea_list["pc_index_jingdian"] as $key=>$v): ?><li>
						<span class="s1">[<?php echo ($v["catename_short"]); ?>]</span>
						<span class="s2"><a href="<?php echo ($v["rewriteurl"]); ?>" title="<?php echo ($TDK["webname"]); ?> <?php echo ($v["title"]); ?>"><?php echo ($v["title"]); ?></a></span>
						<span class="s5"><a href="<?php echo reurl('author', $v);?>" target="_blank" title="<?php echo ($v["author"]); ?>"><?php echo ($v["author"]); ?></a></span>
					</li><?php endforeach; endif; ?>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		<?php echo ($advcode["index_1"]["code"]); ?>
		<div id="novelslist1" class="novelslist">
			<div class="content">
				<h2><?php echo getcate('xuanhuan');?></h2>
				<ul class="cf">
					<?php if(is_array($dataarea_list["pc_index_xuanhuan"])): foreach($dataarea_list["pc_index_xuanhuan"] as $key=>$v): ?><li><a href="<?php echo ($v["rewriteurl"]); ?>" title="<?php echo ($TDK["webname"]); ?> <?php echo ($v["title"]); ?>"><?php echo ($v["title"]); ?></a> / <a href="<?php echo reurl('author', $v);?>" target="_blank" title="<?php echo ($v["author"]); ?>"><?php echo ($v["author"]); ?></a></li><?php endforeach; endif; ?>
				</ul>
			</div>
			<div class="content">
				<h2><?php echo getcate('xiuzhen');?></h2>
				<ul class="cf">
					<?php if(is_array($dataarea_list["pc_index_xiuzhen"])): foreach($dataarea_list["pc_index_xiuzhen"] as $key=>$v): ?><li><a href="<?php echo ($v["rewriteurl"]); ?>" title="<?php echo ($TDK["webname"]); ?> <?php echo ($v["title"]); ?>"><?php echo ($v["title"]); ?></a> / <a href="<?php echo reurl('author', $v);?>" target="_blank" title="<?php echo ($v["author"]); ?>"><?php echo ($v["author"]); ?></a></li><?php endforeach; endif; ?>
				</ul>
			</div>
			<div class="content border">
				<h2><?php echo getcate('dushi');?></h2>
				<ul class="cf">
					<?php if(is_array($dataarea_list["pc_index_dushi"])): foreach($dataarea_list["pc_index_dushi"] as $key=>$v): ?><li><a href="<?php echo ($v["rewriteurl"]); ?>" title="<?php echo ($TDK["webname"]); ?> <?php echo ($v["title"]); ?>"><?php echo ($v["title"]); ?></a> / <a href="<?php echo reurl('author', $v);?>" target="_blank" title="<?php echo ($v["author"]); ?>"><?php echo ($v["author"]); ?></a></li><?php endforeach; endif; ?>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		<?php echo ($advcode["index_2"]["code"]); ?>
		<div id="novelslist2" class="novelslist">
			<div class="content">
				<h2><?php echo getcate('lishi');?></h2>
				<ul class="cf">
					<?php if(is_array($dataarea_list["pc_index_chuanyue"])): foreach($dataarea_list["pc_index_chuanyue"] as $key=>$v): ?><li><a href="<?php echo ($v["rewriteurl"]); ?>" title="<?php echo ($TDK["webname"]); ?> <?php echo ($v["title"]); ?>"><?php echo ($v["title"]); ?></a> / <a href="<?php echo reurl('author', $v);?>" target="_blank" title="<?php echo ($v["author"]); ?>"><?php echo ($v["author"]); ?></a></li><?php endforeach; endif; ?>
				</ul>
			</div>
			<div class="content">
				<h2><?php echo getcate('wangyou');?></h2>
				<ul class="cf">
					<?php if(is_array($dataarea_list["pc_index_wangyou"])): foreach($dataarea_list["pc_index_wangyou"] as $key=>$v): ?><li><a href="<?php echo ($v["rewriteurl"]); ?>" title="<?php echo ($TDK["webname"]); ?> <?php echo ($v["title"]); ?>"><?php echo ($v["title"]); ?></a> / <a href="<?php echo reurl('author', $v);?>" target="_blank" title="<?php echo ($v["author"]); ?>"><?php echo ($v["author"]); ?></a></li><?php endforeach; endif; ?>
				</ul>
			</div>
			<div class="content border">
				<h2><?php echo getcate('kehuan');?></h2>
				<ul class="cf">
					<?php if(is_array($dataarea_list["pc_index_kehuan"])): foreach($dataarea_list["pc_index_kehuan"] as $key=>$v): ?><li><a href="<?php echo ($v["rewriteurl"]); ?>" title="<?php echo ($TDK["webname"]); ?> <?php echo ($v["title"]); ?>"><?php echo ($v["title"]); ?></a> / <a href="<?php echo reurl('author', $v);?>" target="_blank" title="<?php echo ($v["author"]); ?>"><?php echo ($v["author"]); ?></a></li><?php endforeach; endif; ?>
				</ul>
			</div>
			<div class="clear">
			</div>
		</div>
		<div id="newscontent">
			<div class="l">
				<h2>
					最近更新小说列表
				</h2>
				<ul>
					<?php if(is_array($updatelist)): foreach($updatelist as $key=>$v): ?><li>
						<span class="s1">[<a href="<?php echo ($v['cateurl']); ?>" title="<?php echo ($TDK["webname"]); ?> <?php echo ($v['catename']); ?>"><?php echo ($v['catename']); ?></a>]</span>
						<span class="s2"><a href="<?php echo ($v['rewriteurl']); ?>" title="<?php echo ($TDK["webname"]); ?> <?php echo ($v['title']); ?>"><?php echo ($v['title']); ?></a></span>
						<span class="s3"><a href="<?php echo ($v['lastchapterurl']); ?>" title="<?php echo ($v['title']); ?>最新章节" target="_blank"><?php echo ($v['lastchapter']); ?></a></span>
						<span class="s4"><a href="<?php echo reurl('author', $v);?>" target="_blank" title="<?php echo ($v["author"]); ?>"><?php echo ($v["author"]); ?></a></span>
						<span class="s5"><?php echo ($v['updatetime']); ?></span>
					</li><?php endforeach; endif; ?>
				</ul>
			</div>
			<div class="r">
				<h2>
					最新入库小说
				</h2>
				<ul>
					<?php $i = '0'; ?>
					<?php if(is_array($newestlist)): foreach($newestlist as $key=>$v): $i = $i+1; ?>
					<li>
						<span class="s1">[<a href="<?php echo ($v['cateurl']); ?>" title="<?php echo ($TDK["webname"]); ?> <?php echo ($v['catename']); ?>"><?php echo ($v['catename_short']); ?></a>]</span>
						<span class="s2"><a href="<?php echo ($v['rewriteurl']); ?>" title="<?php echo ($TDK["webname"]); ?> <?php echo ($v['title']); ?>"><?php echo ($v['title']); ?></a></span>
						<span class="s5"><a href="<?php echo reurl('author', $v);?>" target="_blank" title="<?php echo ($v["author"]); ?>"><?php echo ($v["author"]); ?></a></span>
					</li><?php endforeach; endif; ?>
				</ul>
			</div>
			<div class="clear">
			</div>
		</div>
		<?php echo ($advcode["index_3"]["code"]); ?>
	</div>
	<div id="firendlink">
		友情连接：<?php if(is_array($TDK["flink"])): foreach($TDK["flink"] as $key=>$v3): ?><a href="<?php echo ($v3['url']); ?>" target="_blank"><?php echo ($v3['name']); ?></a><?php endforeach; endif; ?>
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