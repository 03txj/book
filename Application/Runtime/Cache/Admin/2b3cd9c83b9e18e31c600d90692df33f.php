<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>YGBOOK后台管理</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<link rel="stylesheet" href="/book/Public/css/amazeui.min.css"/>
	<link rel="stylesheet" href="/book/Public/css/admin.css">
	<!--[if lt IE 9]>
	<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
	<script src="/js/amazeui.ie8polyfill.min.js"></script>
	<![endif]-->

	<!--[if (gte IE 9)|!(IE)]><!-->
	<script src="/book/Public/js/jquery.min.js"></script>
	<!--<![endif]-->
	<script type="text/javascript">
		function checkdel(){
			if(confirm("是否确定删除?")){
				return true;
			}else{
				return false;
			}
		}
		function gotype(obj){
			var type = obj.value;
			if(type!='all'){
				window.location.href= "<?php echo U('index/article', array('cate' => '__string__'));?>" . replace('__string__', type);
			} else {
				window.location.href= "<?php echo U('index/article');?>";
			}
		}
		function gopick(obj){
			var type = obj.value;
			locationurl = window.location.href.split('.html')[0];
			locationurl = locationurl.split('/picker')[0];
			if(type!='all'){
				window.location.href= locationurl + '/picker/' + type;
			} else {
				window.location.href= locationurl;
			}
		}
		function goorder(obj){
			var type = obj.value;
			locationurl = window.location.href.split('.html')[0];
			locationurl = locationurl.split('/order')[0];
			window.location.href= locationurl + '/order/' + type;
		}
		function editcategory(dir){
			window.location.href= "<?php echo U('extend/category', array('action' => 'edit', 'dir' => '__string__'));?>" . replace('__string__', dir);
		}
		function editpick(name){
			window.location.href= "<?php echo U('index/pick', array('action' => 'edit', 'name' => '__string__'));?>" . replace('__string__', name);
		}
		function testpick(name){
			window.location.href= "<?php echo U('index/pick', array('action' => 'test', 'name' => '__string__'));?>" . replace('__string__', name);
		}
		function editdataarea(did, domain){
			window.location.href= "<?php echo U('extend/dataarea', array('action' => 'edit', 'did' => '__string1__', 'domain' => '__string2__'));?>" . replace('__string1__', did) . replace('__string2__', domain);
		}
		function delline(id){
			if(confirm("删除后需要保存才会生效")){
				$('#area_' + id).hide();
				$('#popen_' + id).val('deleted');
			} else {
				return false;
			}
		}
		function runpick(name){
			var staturl = "<?php echo U('index/pick', array('action' => 'runpick'));?>";
			$.ajax({
				type: 'GET',
				url: staturl,
				data: 'id=' + name,
				dataType: 'json',
				success: function(json){
					alert('采集成功');
				}
			});
		}
		function exportpick(name){
			window.location.href= "<?php echo U('index/pick', array('action' => 'export', 'name' => '__string__'));?>" . replace('__string__', name);
		}
		function addzhanqun(){
			$('#addarea').html($('#addarea').html() + $('#codearea').html());
		}
		function addline(id,codeid){
			$('#'+id).html($('#'+id).html() + $('#'+codeid).html());
		}
		function clearcache(id){
			if(id == 'article'){
				var aid = prompt('请输入文章ID');
				if(!aid){
					alert('输入有误');
					return false;
				}
			}
			if(confirm("确认清除吗？")){
				if(!aid){
					window.location.href= "<?php echo U('extend/cache', array('action' => 'clear', 'id' => '__string__'));?>" . replace('__string__', id);
				} else {
					window.location.href= "<?php echo U('extend/cache', array('action' => 'clear', 'id' => '__string1__', 'aid' => '__string2__'));?>" . replace('__string1__', id) . replace('__string2__', aid);
				}
			} else {
				return false;
			}
		}
	</script>
	<style>
		.am-form select{
			font-size: 1.3rem;
		}
	</style>
</head>
<body>
<header class="am-topbar admin-header">
	<div class="am-topbar-brand">
		<strong>YGBOOK</strong> / <small>后台管理</small>
	</div>

	<button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

	<div class="am-collapse am-topbar-collapse" id="topbar-collapse">
		<ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
			<li><a href="<?php echo C('HOME_URL');?>" target="_blank"><span class="am-icon-home"></span> 网站首页</a></li>
			<li><a href="/book/index.php?s=/Admin/Index/pick.html"><span class="am-icon-user"></span> 后台首页</a></li>
			<li><a href="<?php echo U('logout');?>"><span class="am-icon-sign-out"></span> 退出</a></li>
			<li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
		</ul>
	</div>
</header>

<div class="am-cf admin-main">
	<!-- sidebar start -->
	<div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
		<div class="am-offcanvas-bar admin-offcanvas-bar">
			<ul class="am-list admin-sidebar-list">
				<li><a href="<?php echo U('index/index');?>"<?php echo ($active["index"]); ?>><span class="am-icon-home"></span> 首页</a></li>
				<li><a href="<?php echo U('index/setting');?>"<?php echo ($active["setting"]); ?>><span class="am-icon-cog"></span> 基础设置</a></li>
				<li><a href="<?php echo U('index/article');?>"<?php echo ($active["article"]); ?>><span class="am-icon-table"></span> 文章列表</a></li>
				<li><a href="<?php echo U('index/pick');?>"<?php echo ($active["pick"]); ?>><span class="am-icon-cogs"></span> 采集设置</a></li>
				<li class="admin-parent">
					<a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-sitemap"></span> 更多功能 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
					<ul class="am-list am-collapse admin-sidebar-sub <?php echo ($amin); ?>" id="collapse-nav">
						<li><a href="<?php echo U('extend/category');?>"<?php echo ($active["category"]); ?>><span class="am-icon-list-ol"></span> 栏目设置</a></li>
						<li><a href="<?php echo U('extend/dataarea');?>"<?php echo ($active["dataarea"]); ?>><span class="am-icon-database"></span> 数据区块</a></li>
						<li><a href="<?php echo U('extend/searchlog');?>"<?php echo ($active["searchlog"]); ?>><span class="am-icon-search"></span> 搜索记录</a></li>
						<li><a href="<?php echo U('extend/tags');?>"<?php echo ($active["tags"]); ?>><span class="am-icon-tag"></span> 标签列表</a></li>
						<li><a href="<?php echo U('extend/seowords');?>"<?php echo ($active["seowords"]); ?>><span class="am-icon-cogs"></span> 关键词管理</a></li>
						<li><a href="<?php echo U('extend/advertise');?>"<?php echo ($active["advertise"]); ?>><span class="am-icon-yelp"></span> 广告位管理</a></li>
						<li><a href="<?php echo U('extend/pickers');?>"<?php echo ($active["pickers"]); ?>><span class="am-icon-cube"></span> 节点库</a></li>
					</ul>
				</li>
				<li><a href="<?php echo U('extend/spider');?>"<?php echo ($active["spider"]); ?>><span class="am-icon-bug"></span> 蜘蛛记录</a></li>
				<li><a href="<?php echo U('extend/cache');?>"<?php echo ($active["cache"]); ?>><span class="am-icon-retweet"></span> 缓存管理</a></li>
			</ul>
			<div class="am-panel am-panel-default admin-sidebar-panel">
				<div class="am-panel-bd">
					<p><span class="am-icon-bookmark"></span> 公告</p>
					<p>感谢您使用YGBOOK！</p>
				</div>
			</div>
		</div>
	</div>
	<!-- sidebar end -->

	<!-- content start -->
	<div class="admin-content">
		<div class="am-cf am-padding am-padding-bottom-0">
	<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">采集设置</strong></div>
</div>
<hr>
<script>
$(function(){
	$('textarea').on('click', function(){
		$(this).attr('rows', '10');
	});
	$('textarea').on('blur', function(){
		$(this).attr('rows', '3');
	});
});
</script>
<div class="am-tabs am-margin">
	<?php if($action == 'edit'): ?><div class="am-alert am-alert-warning" data-am-alert>
		<button type="button" class="am-close">&times;</button>
		<p>
			1.小技巧：类名可用“h2:eq(2)”这样的形式。文章页标题、作者、缩略图、完整目录页可采用、“meta[property=og:novel:author]|content”这样的写法。<br>
			2.无需设置或无需采集的项请留空或保持默认。预过滤规则中，如果是固定字符串过滤，如“ABC书屋”，可单独一行只写需过滤字符串，无需以正则形式。<br>
			3.栏目模式介绍：“多栏目匹配”表示目标网站各栏目及栏目分页分别采集，此时需将url中[cate]与目标站一一对应。“单列表匹配”表示采集目标站混合列表页（如最近更新、排行榜等），该模式需采集文章所属栏目标记，和[cate]一一对应入库。
		</p>
	</div>
	<div class="am-tab-panel am-fade am-in am-active">
		<form class="am-form" action="/book/index.php?s=/Admin/Index/pick" method="post" target="_self">
		<input type="hidden" name="action" value="<?php echo ($action); ?>"/>
		<input type="hidden" name="name" value="<?php echo ($name); ?>"/>
		<input type="hidden" name="do" value="save"/>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				是否启用
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<select name="open">
					<option value="yes" <?php echo getsel($pick[$name]['open'], 'yes');?>>启用</option>
					<option value="no" <?php echo getsel($pick[$name]['open'], 'no');?>>停用</option>
				</select>
			</div>
			<div class="am-hide-sm-only am-u-md-4">用于展现给用户，如三七中文</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				突破采集
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<div class="am-u-sm-12 am-u-md-6">
					<select name="breakpick">
						<option value="no" <?php echo getsel($pick[$name]['breakpick'], 'no');?>>不启用</option>
						<option value="yes" <?php echo getsel($pick[$name]['breakpick'], 'yes');?>>启用</option>
					</select>
				</div>
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					代理(慎用)
				</div>
				<div class="am-u-sm-8 am-u-md-4">
					<select name="proxy">
						<option value="no" <?php echo getsel($pick[$name]['proxy'], 'no');?>>不启用</option>
						<option value="yes" <?php echo getsel($pick[$name]['proxy'], 'yes');?>>启用</option>
					</select>
				</div>
			</div>
			<div class="am-hide-sm-only am-u-md-4">无法采集时启用，代理需在其他设置中填写可用代理</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				图片本地化
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<div class="am-u-sm-12 am-u-md-6">
					<select name="piclocal">
						<option value="no" <?php echo getsel($pick[$name]['piclocal'], 'no');?>>不启用</option>
						<option value="yes" <?php echo getsel($pick[$name]['piclocal'], 'yes');?>>启用</option>
					</select>
				</div>
				<div class="am-u-sm-4 am-u-md-2 am-text-right">图片属性</div>
				<div class="am-u-sm-8 am-u-md-4">
					<input type="text" class="am-input-sm" name="picattr" placeholder="如data-src、src" value="<?php echo ($pick["$name"]["picattr"]); ?>">
				</div>
			</div>
			<div class="am-hide-sm-only am-u-md-4">用于解决图片防盗链问题</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				所属栏目
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<select name="cate">
					<option value="multicate" <?php echo getsel($pick[$name]['cate'], 'multicate');?>>多栏目匹配</option>
					<option value="singlelist" <?php echo getsel($pick[$name]['cate'], 'singlelist');?>>单列表匹配</option>
				</select>
			</div>
			<div class="am-hide-sm-only am-u-md-4">采集内容所属栏目</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				目标网站域名
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<div class="am-u-sm-12 am-u-md-6">
					<input type="text" class="am-input-sm" name="domain" value="<?php echo ($pick["$name"]["domain"]); ?>">
				</div>
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					网站编码
				</div>
				<div class="am-u-sm-8 am-u-md-4">
					<select name="charset">
						<option value="UTF-8" <?php echo getsel($pick[$name]['charset'], 'UTF-8');?>>UTF-8</option>
						<option value="GBK" <?php echo getsel($pick[$name]['charset'], 'GBK');?>>GBK/GB2312</option>
					</select>
				</div>
			</div>
			<div class="am-hide-sm-only am-u-md-4">域名结尾去掉“/”</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				URL替换规则
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<textarea name="urlreplace" class="am-input-sm" cols="30" rows="3"><?php echo ($pick["$name"]["urlreplace"]); ?></textarea>
			</div>
			<div class="am-hide-sm-only am-u-md-4">用于解决301重定向问题，如“abc.com###abc.net”，一行一条</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				规则列表页面
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="list_url" value="<?php echo ($pick["$name"]["list_url"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">[page]表示页码,[cate]表示不同分类</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				附加列表页面
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<textarea name="list_url_extra" class="am-input-sm" cols="30" rows="3"><?php echo ($pick["$name"]["list_url_extra"]); ?></textarea>
			</div>
			<div class="am-hide-sm-only am-u-md-4">无法通过规则列表记录的页面，可用[cate]匹配多栏目</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				[cate]对应情况
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<div class="am-margin-top-xs am-cf">
					<div class="am-u-sm-5 am-u-md-4">
						源站[cate]
						<a class="am-btn am-btn-warning am-btn-xs" onclick="addline('addarea','codearea')"><span class="am-icon-plus"></span></a>
					</div>
					<div class="am-u-sm-2 am-u-md-2">
						<span class="am-icon-arrow-right"></span>
					</div>
					<div class="am-u-sm-5 am-u-md-3">
						对应栏目
					</div>
					<div class="am-u-sm-5 am-u-md-3">
						最大页码
					</div>
				</div>
				<?php if(is_array($pick[$name]['list_cate'])): foreach($pick[$name]['list_cate'] as $key=>$vo): ?><div class="am-margin-top-xs am-cf">
					<div class="am-u-sm-5 am-u-md-4">
						<input type="text" class="am-input-sm" width="40%" name="list_cate[]" value="<?php echo ($vo["cate"]); ?>">
					</div>
					<div class="am-u-sm-2 am-u-md-2">
						<span class="am-icon-arrow-right"></span>
					</div>
					<div class="am-u-sm-5 am-u-md-3">
						<select name="list_ocate[]">
							<?php if(is_array($category)): foreach($category as $key2=>$vo2): ?><option value="<?php echo ($key2); ?>" <?php echo getsel($vo['ocate'], $key2);?>><?php if($key2 == 'default'): ?>默认-<?php endif; echo ($vo2["name"]); ?></option><?php endforeach; endif; ?>
						</select>
					</div>
					<div class="am-u-sm-5 am-u-md-3">
						<input type="text" class="am-input-sm" width="40%" name="list_maxpage[]" value="<?php echo ($vo["maxpage"]); ?>">
					</div>
				</div><?php endforeach; endif; ?>
				<div id="codearea">
					<div class="am-margin-top-xs am-cf">
						<div class="am-u-sm-5 am-u-md-4">
							<input type="text" class="am-input-sm" width="40%" name="list_cate[]">
						</div>
						<div class="am-u-sm-2 am-u-md-2">
							<span class="am-icon-arrow-right"></span>
						</div>
						<div class="am-u-sm-5 am-u-md-3">
							<select name="list_ocate[]">
								<?php if(is_array($category)): foreach($category as $key=>$vo): ?><option value="<?php echo ($key); ?>"><?php if($key == 'default'): ?>默认-<?php endif; echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
							</select>
						</div>
						<div class="am-u-sm-5 am-u-md-3">
							<input type="text" class="am-input-sm" width="40%" name="list_maxpage[]">
						</div>
					</div>
				</div>
				<div id="addarea"></div>
			</div>
			<div class="am-hide-sm-only am-u-md-4">仅适用于“多栏目匹配”和“单列表匹配”。<br>1.多栏目匹配：需结合规则列表中[cate]使用，如栏目无对应[cate]，请留空，并填写各栏目最大页数，此时，[规则列表页码]中的最大页不再生效，以此处为准<br>2.单列表匹配：需在文章页面采集所属栏目标记，与此处填写的[cate]值一一对应后才能导入相应栏目。如栏目识别失败，则导入默认栏目<br>
			3.如需删除某行，清空该行cate输入框，保存即可</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				规则列表页码
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="list_page" value="<?php echo ($pick["$name"]["list_page"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">“a|b|c”第a页开始，最多到第c页，每次增加b</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				无缩略图标志
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="nothumb_sign" value="<?php echo ($pick["$name"]["nothumb_sign"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">如“nocover”。包含nocover的图片会替换为系统默认封面图</div>
		</div>
		<hr>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				列表页：源码预过滤规则
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<textarea name="list_selector_prefilter" class="am-input-sm" cols="30" rows="3"><?php echo ($pick["$name"]["list_selector_prefilter"]); ?></textarea>
			</div>
			<div class="am-hide-sm-only am-u-md-4">常规情况下留空。代码处理前先进行替换，一行一条，如“{filter replace='替换后代码'}&lt;div id="ad480"&gt;(.*)&lt;/div&gt;{/filter}”</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				列表页：链接CSS选择器
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="list_selector" value="<?php echo ($pick["$name"]["list_selector"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">如“#list ul a”</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				列表页：标题CSS选择器
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="list_title_selector" value="<?php echo ($pick["$name"]["list_title_selector"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">如“#list ul a h2”</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				列表页：缩略图CSS选择器
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="list_thumb_selector" value="<?php echo ($pick["$name"]["list_thumb_selector"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">如“#list ul a img|src”，若需在文章页采集缩略图，请留空</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				列表页：作者CSS选择器
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="list_author_selector" value="<?php echo ($pick["$name"]["list_author_selector"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">如“#list ul em”，若需在文章页采集作者，请留空</div>
		</div>
		<hr>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				文章页：源码预过滤规则
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<textarea name="view_selector_prefilter" class="am-input-sm" cols="30" rows="3"><?php echo ($pick["$name"]["view_selector_prefilter"]); ?></textarea>
			</div>
			<div class="am-hide-sm-only am-u-md-4">常规情况下留空。代码处理前先进行替换，一行一条，如“{filter replace='替换后代码'}&lt;div id="ad480"&gt;(.*)&lt;/div&gt;{/filter}”</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				文章页：标题CSS选择器
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="viewtitle_selector" value="<?php echo ($pick["$name"]["viewtitle_selector"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">如“h1”、“#content img:eq(0)|title”，可用|分割字段属性</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				文章页：作者CSS选择器
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="viewauthor_selector" value="<?php echo ($pick["$name"]["viewauthor_selector"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">如“#author”、“meta[property=og:novel:author]|content”</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				文章页：分类标记CSS选择器
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="viewcate_selector" value="<?php echo ($pick["$name"]["viewcate_selector"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">仅“单列表匹配”时需要填写。如“.sort”、“meta[property=og:novel:category]|content”</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				文章页：内容CSS选择器
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="view_selector" value="<?php echo ($pick["$name"]["view_selector"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">如“#article .articlebody”，+分割多段内容，|分割过滤内容</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				文章页：缩略图CSS选择器
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="viewthumb_selector" value="<?php echo ($pick["$name"]["viewthumb_selector"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">如“#cimg|src”、“meta[property=og:image]|content”，若已在列表页采集，请留空</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				文章页：完结标志
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="isfull_sign" value="<?php echo ($pick["$name"]["isfull_sign"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">如“已完结”，“class="fulltxt"”</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				文章页：完整目录页CSS选择器
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="viewchapter_selector" value="<?php echo ($pick["$name"]["viewchapter_selector"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">如“h2.seemore a”、“meta[property=og:novel:read_url]|content”。如文章页即目录页，请留空</div>
		</div>
		<hr>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				章节目录页：源码预过滤规则
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<textarea name="chapter_selector_prefilter" class="am-input-sm" cols="30" rows="3"><?php echo ($pick["$name"]["chapter_selector_prefilter"]); ?></textarea>
			</div>
			<div class="am-hide-sm-only am-u-md-4">常规情况下留空。代码处理前先进行替换，一行一条，如“{filter replace='替换后代码'}&lt;div id="ad480"&gt;(.*)&lt;/div&gt;{/filter}”</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				章节目录页：区域CSS选择器
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="chapterarea_selector" value="<?php echo ($pick["$name"]["chapterarea_selector"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">章节区域ID或类名，如“table#chapterlist”</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				章节目录页：采集规则
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="chapter_regx" value="<?php echo ($pick["$name"]["chapter_regx"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">参考参数“[link]、[title]、[string]”，link表示章节链接，title表示章节名，string表示无需采集的任意字符</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				章节目录页：顺序调整
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<select name="chapter_order">
					<option value="yes" <?php echo getsel($pick[$name]['chapter_order'], 'yes');?>>正序</option>
					<option value="no" <?php echo getsel($pick[$name]['chapter_order'], 'no');?>>倒序</option>
				</select>
			</div>
			<div class="am-hide-sm-only am-u-md-4">默认无需改动，如章节顺序反了，请调为倒序</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				章节目录页：顺序调整间隔
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="chapter_ordernum" value="<?php echo ($pick["$name"]["chapter_ordernum"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">如填写3，表示每3章倒序一次。仅在需要时填写</div>
		</div>
		<hr>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				章节内容页：源码预过滤规则
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<textarea name="chaptercont_prefilter" class="am-input-sm" cols="30" rows="3"><?php echo ($pick["$name"]["chaptercont_prefilter"]); ?></textarea>
			</div>
			<div class="am-hide-sm-only am-u-md-4">常规情况下留空。代码处理前先进行替换，一行一条，如“{filter replace='替换后代码'}&lt;div id="ad480"&gt;(.*)&lt;/div&gt;{/filter}”</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				章节内容页：内容CSS选择器
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="chaptercont_selector" value="<?php echo ($pick["$name"]["chaptercont_selector"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">如“#bookcontent”</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				章节内容页：分页标识
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="chaptercont_pagesign" value="<?php echo ($pick["$name"]["chaptercont_pagesign"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">如“点击下一页”，留空则不检测分页</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				章节内容页：分页链接选择器
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="chaptercont_page" value="<?php echo ($pick["$name"]["chaptercont_page"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">如“a#pb_next”</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				章节内容页：段落顺序调整规则（99lib）
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="chaptercont_par" value="<?php echo ($pick["$name"]["chaptercont_par"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">如“meta[name=client]|content”</div>
		</div>
		<div class="am-margin">
			<button type="submit" class="am-btn am-btn-primary am-btn-sm">提交保存</button>
		</div>
		</form>
	</div>
	<?php elseif($action == 'test'): ?>
		<?php if($step == '1'): ?><table class="am-table am-table-striped am-table-hover table-main">
			<thead>
				<tr>
					<th class="table-id">ID</th>
					<th class="table-title">网址</th>
					<th class="table-title">标题</th>
					<th class="table-author">作者</th>
					<th class="table-author am-hide-sm-only">缩略图</th>
				</tr>
			</thead>
			<?php if(is_array($listdata)): foreach($listdata as $k=>$vi): if($k < '10'): ?><tr>
				<td><?php echo $k+1;?></td>
				<td><a href="<?php echo ($vi["url"]); ?>" target="_blank"><?php echo ($vi["url"]); ?></a></td>
				<td><?php echo ($vi['title']); ?></td>
				<td><?php echo ($vi['author']); ?></td>
				<td class="am-hide-sm-only"><?php echo ($vi["thumb"]); ?></td>
			</tr><?php endif; endforeach; endif; ?>
			<tr>
				<td colspan="5" class="am-text-center">省略……</td>
			</tr>
		</table>
		<form class="am-form" action="/book/index.php?s=/Admin/Index/pick" method="post" target="_self">
		<input type="hidden" name="action" value="<?php echo ($action); ?>"/>
		<input type="hidden" name="do" value="test"/>
		<input type="hidden" name="step" value="2"/>
		<input type="hidden" name="name" value="<?php echo ($name); ?>"/>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				当前URL
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="articleurl" value="<?php echo ($listdata["listurl"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">当前采集的列表页url</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				代码预览
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<textarea class="am-input-sm" cols="30" rows="20">
					<?php echo ($listdata["htmlcode"]); ?>
				</textarea>
			</div>
			<div class="am-hide-sm-only am-u-md-4"></div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				目标文章页
			</div>
			<div class="am-u-sm-4 am-u-md-6 am-text-right">
				<input type="text" class="am-input-sm" name="articleurl" value="<?php echo ($listdata["0"]["url"]); ?>">
			</div>
			<div class="am-u-sm-4 am-u-md-4">
				<button type="submit" class="am-btn am-btn-primary am-btn-sm">测试采集文章页</button>
			</div>
		</div>
		</form>
		<?php elseif($step == '2'): ?>
		<div class="am-tab-panel am-fade am-in am-active">
			<form class="am-form" action="/book/index.php?s=/Admin/Index/pick" method="post" target="_self">
			<input type="hidden" name="action" value="<?php echo ($action); ?>"/>
			<input type="hidden" name="do" value="test"/>
			<input type="hidden" name="step" value="3"/>
			<input type="hidden" name="name" value="<?php echo ($name); ?>"/>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					文章网址
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" value="<?php echo ($articledb["url"]); ?>" readonly>
				</div>
				<div class="am-hide-sm-only am-u-md-4"></div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					文章标题
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" value="<?php echo ($articledb["title"]); ?>" readonly>
				</div>
				<div class="am-hide-sm-only am-u-md-4"></div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					文章作者
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" value="<?php echo ($articledb["author"]); ?>" readonly>
				</div>
				<div class="am-hide-sm-only am-u-md-4"></div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					分类标记
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" value="<?php echo ($articledb["cate"]); ?>" readonly>
				</div>
				<div class="am-hide-sm-only am-u-md-4"></div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					文章内容
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<textarea class="am-input-sm" cols="30" rows="3" readonly><?php echo ($articledb["content"]); ?></textarea>
				</div>
				<div class="am-hide-sm-only am-u-md-4"></div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					缩略图
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" value="<?php echo ($articledb["thumb"]); ?>" readonly>
				</div>
				<div class="am-hide-sm-only am-u-md-4"></div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					章节页
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="chapterurl" value="<?php echo ($articledb["chapterurl"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4"></div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					代码预览
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<textarea class="am-input-sm" cols="30" rows="20">
						<?php echo ($articledb["htmlcode"]); ?>
					</textarea>
				</div>
				<div class="am-hide-sm-only am-u-md-4"></div>
			</div>
			<div class="am-g am-margin">
				<button type="submit" class="am-btn am-btn-primary am-btn-sm">测试采集章节页</button>
			</div>
			</form>
		</div>
		<?php elseif($step == '3'): ?>
			<form class="am-form" action="/book/index.php?s=/Admin/Index/pick" method="post" target="_self">
			<input type="hidden" name="action" value="<?php echo ($action); ?>"/>
			<input type="hidden" name="do" value="test"/>
			<input type="hidden" name="step" value="4"/>
			<input type="hidden" name="name" value="<?php echo ($name); ?>"/>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					章节列表
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<textarea class="am-input-sm" cols="30" rows="20">
						<?php echo ($chapterdb); ?>
					</textarea>
				</div>
				<div class="am-hide-sm-only am-u-md-4"></div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					章节内容页
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="chapterurl" value="<?php echo ($curl); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4"></div>
			</div>
			<div class="am-g am-margin">
				<button type="submit" class="am-btn am-btn-primary am-btn-sm">测试采集章节内容页</button>
			</div>
			</form>
		<?php elseif($step == '4'): ?>
			<form class="am-form">
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					章节内容
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<textarea class="am-input-sm" cols="30" rows="20">
						<?php echo ($chaptercont); ?>
					</textarea>
				</div>
				<div class="am-hide-sm-only am-u-md-4"></div>
			</div>
			</form><?php endif; ?>
	<?php elseif($action == 'export'): ?>
	<div class="am-tab-panel am-fade am-in am-active">
		<form class="am-form">
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				<?php echo ($pname); ?>规则导出
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<textarea class="am-input-sm" cols="30" id="exportcode" rows="20"><?php echo ($exportcode); ?></textarea>
			</div>
			<div class="am-hide-sm-only am-u-md-4"></div>
		</div>
		</form>
		<script>$('#exportcode').select();</script>
	</div>
	<?php elseif($action == 'import'): ?>
	<div class="am-tab-panel am-fade am-in am-active">
		<form class="am-form" action="/book/index.php?s=/Admin/Index/pick" method="post" target="_self">
		<input type="hidden" name="action" value="<?php echo ($action); ?>"/>
		<input type="hidden" name="do" value="save"/>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				规则导入
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<textarea class="am-input-sm" name="code" cols="30" rows="20"></textarea>
			</div>
			<div class="am-hide-sm-only am-u-md-4"></div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				导入方式
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<select id="topicker">
					<option value="###">导入为新节点</option>
					<?php if(is_array($pick)): foreach($pick as $key=>$vo): ?><option value="<?php echo ($vo["name"]); ?>">导入为：<?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
				</select>
			</div>
			<div class="am-hide-sm-only am-u-md-4">如果导入为现有节点将会更新该节点的规则</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				采集点名称
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input name="pickname" type="text" class="am-input-sm" id="newpicker" value="">
			</div>
			<div class="am-hide-sm-only am-u-md-4">唯一标识，只支持字母+数字。留空则使用原采集点名称</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				所属栏目
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<select name="cate">
					<option value="multicate">多栏目匹配</option>
					<option value="singlelist">单列表匹配</option>
				</select>
			</div>
			<div class="am-hide-sm-only am-u-md-4"></div>
		</div>
		<div class="am-margin">
			<button type="submit" class="am-btn am-btn-primary am-btn-sm">提交保存</button>
		</div>
		</form>
	</div>
	<script>
		$(function(){
			$('#topicker').on('change', function(){
				if($('#topicker').val() != '###'){
					$('#newpicker').val($('#topicker').val());
				} else {
					$('#newpicker').val('');
					$('#newpicker').focus();
				}
			});
			$('form.am-form').on('submit', function(){
				if($('#topicker').val() != '###'){
					return confirm('您本次导入规则将会覆盖到现有节点【'+$('#topicker').val()+'】，是否继续？');
				}
			});
		});
	</script>
	<?php else: ?>
	<div class="am-alert am-alert-warning" data-am-alert>
		<button type="button" class="am-close">&times;</button>
		<p>
			节点转移功能介绍：用于批量转换该节点的小说到指定节点。一次转换一本，如果指定节点记录中有该小说对应记录，则转换成功。转换过的小说，现有数据将作废，重新从新节点采集。
		</p>
	</div>
	<div class="am-tab-panel am-fade am-in am-active">
		<div class="am-g am-margin-top">
			<div class="am-u-md-2 am-text-right am-hide-sm-only">
				是否启用
			</div>
			<div class="am-u-sm-12 am-u-md-3 am-text-right">
				采集点标识（唯一，字母+数字）
			</div>
			<div class="am-u-md-2 am-hide-sm-only">
				对应栏目
			</div>
			<div class="am-hide-sm-only">
				<a class="am-btn am-btn-secondary am-btn-sm" onclick="addline('addarea','codearea')"><span class="am-icon-plus"></span> 新增</a>
				<a class="am-btn am-btn-warning am-btn-sm" href="<?php echo U('pick', array('action' => 'import'));?>"><span class="am-icon-plus"></span> 导入</a>
			</div>
		</div>
		<form class="am-form" action="/book/index.php?s=/Admin/Index/pick" method="post" target="_self">
		<input type="hidden" name="action" value="save"/>
		<?php $i=0;;?>
		<?php if(is_array($pick)): foreach($pick as $key=>$vo): if($key != 'default'): ?><div id="area_<?php echo ($i); ?>">
				<div class="am-g am-margin-top">
					<div class="am-u-md-2 am-text-right am-hide-sm-only">
						<select name="popen[]" id="popen_<?php echo ($i); ?>">
							<option value="yes" <?php echo getsel($vo['open'], 'yes');?>>启用</option>
							<option value="no" <?php echo getsel($vo['open'], 'no');?>>停用</option>
							<option value="deleted" style="display:none">删除</option>
						</select>
					</div>
					<div class="am-u-sm-4 am-u-md-3 am-text-right">
						<input type="text" class="am-input-sm" name="pname[]" value="<?php echo ($vo["name"]); ?>" readonly>
					</div>
					<div class="am-u-md-2 am-hide-sm-only">
						<select name="pcate[]">
							<option value="multicate" <?php echo getsel($vo['cate'], 'multicate');?>>多栏目匹配</option>
							<option value="singlelist" <?php echo getsel($vo['cate'], 'singlelist');?>>单列表匹配</option>
						</select>
					</div>
					<div class="am-u-sm-4 am-u-md-5">
						<a class="am-btn am-btn-success am-btn-xs am-padding-xs" onclick="editpick('<?php echo ($vo["name"]); ?>')">编辑</a>
						<a class="am-btn am-btn-warning am-btn-xs am-padding-xs" onclick="togglepick('<?php echo ($vo["name"]); ?>')">转移</a>
						<a class="am-btn am-btn-primary am-btn-xs am-padding-xs" onclick="testpick('<?php echo ($vo["name"]); ?>')">测试</a>
						<a class="am-btn am-btn-secondary am-btn-xs am-padding-xs" onclick="runpick('<?php echo ($vo["name"]); ?>')">采集</a>
						<a class="am-btn am-btn-warning am-btn-xs am-padding-xs" onclick="exportpick('<?php echo ($vo["name"]); ?>')">导出</a>
						<a class="am-btn am-btn-danger am-btn-xs am-padding-xs" onclick="delline('<?php echo ($i); ?>')">删除</a>
					</div>
				</div>
			</div>
			<?php $i++;; endif; endforeach; endif; ?>
		<div id="codearea">
			<div class="am-g am-margin-top am-hide-sm-only">
				<div class="am-u-md-2 am-text-right am-hide-sm-only">
					<select name="nopen[]">
						<option value="yes">启用</option>
						<option value="no">停用</option>
					</select>
				</div>
				<div class="am-u-sm-4 am-u-md-3 am-text-right">
					<input type="text" class="am-input-sm" name="nname[]" value="" placeholder="采集点标识，建议英文">
				</div>
				<div class="am-u-sm-4 am-u-md-2">
					<select name="ncate[]">
						<option value="multicate">多栏目匹配</option>
						<option value="singlelist">单列表匹配</option>
					</select>
				</div>
				<div class="am-u-md-5">
				</div>
			</div>
		</div>
		<div id="addarea"></div>
		<div class="am-margin">
			<button type="submit" class="am-btn am-btn-primary am-btn-sm">提交保存</button>
			<button type="button" class="am-btn am-btn-warning am-btn-sm" onclick="batchpick();">批量处理文章信息</button>
			<button type="button" class="am-btn am-btn-secondary am-btn-sm" onclick="multipick();">批量采集新书</button>
		</div>
		</form>
		<hr>
		<h3>指定ID/指定ID范围采集</h3>
		<form action="/book/index.php?s=/Admin/Index/pick" method="post" class="am-form">
		<input type="hidden" name="action" value="signpick"/>
		<div class="am-g am-margin">
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					目标节点
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<select name="sign_pid">
						<?php if(is_array($pick)): foreach($pick as $key=>$vo): ?><option value="<?php echo ($key); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</div>
				<div class="am-hide-sm-only am-u-md-4"></div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					目标站URL格式
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="sign_url" placeholder="http://www.37zw.net/[subid]/[id]/">
				</div>
				<div class="am-hide-sm-only am-u-md-4">仅支持数字id，subid由系统根据id计算</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					起始文章ID
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="sign_ids" placeholder="1-20">
				</div>
				<div class="am-hide-sm-only am-u-md-4">ID范围过大，会导致网站卡死。“1-20”表示采集范围，“1,2,8,1015”表示指定采集</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					指定所属栏目
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<select name="sign_cate">
						<?php if(is_array($category)): foreach($category as $key=>$vo): ?><option value="<?php echo ($key); ?>"><?php if($key == 'default'): ?>默认-<?php endif; echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</div>
				<div class="am-hide-sm-only am-u-md-4">多栏目节点无法对小说智能分类，需要预先指定，单列表节点会自动分类</div>
			</div>
		</div>
		<div class="am-margin">
			<button type="submit" class="am-btn am-btn-primary am-btn-sm">开始采集</button>
		</div>
		</form>
	</div>
	<div class="am-modal am-modal-no-btn" tabindex="-1" id="pid-modal">
		<div class="am-modal-dialog">
			<div class="am-modal-hd">批量转换节点
				<a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
			</div>
			<div class="am-modal-bd">
				<div style="margin: 20px 10px">
					移动<<em></em>>文档到：
					<select name="move-to-pid">
						<option value="no">选择节点</option>
						<?php if(is_array($pick)): foreach($pick as $key=>$vo): ?><option value="<?php echo ($key); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</div>
			</div>
		</div>
	</div>
	<script>
		function togglepick(pid){
			$('#pid-modal em').text(pid);
			$('#pid-modal').modal();
			var toconfirm = function(title, pid2){
				if(confirm(title) === true){
					location.href = "<?php echo U('pick', array('action' => 'multitoggle', 'name' => '__string1__', 'toname' => '__string2__'));?>" . replace('__string1__', pid) . replace('__string2__', pid2);
				}
			}
			$('select[name=move-to-pid]').on('change', function(){
				toconfirm('确认要移动<' + pid + '>节点全部文档到' + $(this).find('option:selected').text() + '？', $(this).val());
			});
		}
		function multipick(){
			var picknum = prompt('请输入要批量采集的次数', '10');
			if(picknum > 100){
				alert('每次最多连续采集100次，采集过于频繁可能造成被源站封IP，或自己服务器资源占用过多导致卡顿的情况！');
			} else {
				location.href = "<?php echo U('pick', array('action' => 'runpick', 'nownum' => '1', 'maxnum' => '__string__'));?>" . replace('__string__', picknum);
			}
		}
		function batchpick(){
			if(confirm('该操作非常耗时和占用服务器资源，请选择人少时操作！') !== true){
				return false;
			} else {
				var oid = prompt('请输入起始采集文章ID，不输入则从未采集过的小说开始');
				location.href = "<?php echo U('pick', array('action' => 'batchpick', 'oid' => '__string__'));?>" . replace('__string__', oid);
			}
		}
	</script><?php endif; ?>
</div>
	</div>
	<!-- content end -->

</div>

<a href="#" class="am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}">
	<span class="am-icon-btn am-icon-th-list"></span>
</a>

<footer>
	<hr>
	<p class="am-padding-left">© <?php echo (date('Y',NOW_TIME)); ?> YGBOOK, Inc. 感谢使用！感谢选择！</p>
</footer>
<script src="/book/Public/js/amazeui.min.js"></script>
</body>
</html>