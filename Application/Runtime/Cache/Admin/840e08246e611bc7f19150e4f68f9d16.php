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
			<li><a href="/book/index.php?s=/Admin/index/setting.html"><span class="am-icon-user"></span> 后台首页</a></li>
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
	<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">系统设置</strong></div>
</div>
<hr>
<div class="am-tabs am-margin" data-am-tabs>
	<ul class="am-tabs-nav am-nav am-nav-tabs">
		<li class="am-active"><a href="#tab1">基础设置</a></li>
		<li><a href="#tab2">管理员设置</a></li>
		<li><a href="#tab3">友情链接</a></li>
		<li><a href="#tab4">其他设置</a></li>
	</ul>
	<div class="am-tabs-bd">
		<div class="am-tab-panel am-fade am-in am-active" id="tab1">
			<form class="am-form" action="/book/index.php?s=/Admin/Index/setting" method="post" target="_self">
			<input type="hidden" name="action" value="save"/>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					DEBUG
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<select name="debug">
						<option value="0" <?php echo getsel($setting['seo']['debug'], '0');?>>关闭</option>
						<option value="1" <?php echo getsel($setting['seo']['debug'], '1');?>>开启</option>
					</select>
				</div>
				<div class="am-hide-sm-only am-u-md-4">仅在需要查看报错时开启</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					网站目录
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="webdir" placeholder="/" value="<?php echo ($setting["seo"]["weburl"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">根目录“/”、子目录如“/abc/”</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					PC站域名
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="pcdomain" placeholder="www.abc.com" value="<?php echo ($setting["seo"]["pcdomain"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">如“www.abc.com”，该域名和手机域名绑定同一目录即可</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					手机站域名
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="mobiledomain" placeholder="m.abc.com" value="<?php echo ($setting["seo"]["mobiledomain"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">如“m.abc.com”，该域名和PC域名绑定同一目录即可</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					PC站主题
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="pctheme" placeholder="default" value="<?php echo ($setting["seo"]["pctheme"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">如“default”，“biquge”，“bluebiquge”，“singlebiquge”</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					手机站主题
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="waptheme" placeholder="wap" value="<?php echo ($setting["seo"]["waptheme"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">如“wap”，“wapbiquge”</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					网站名称
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="webname" value="<?php echo ($setting["seo"]["webname"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">即{webname}，用于调用</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					禁用移动端自动跳转
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<select name="disjump">
						<option value="0" <?php echo getsel($setting['seo']['disjump'], '0');?>>否</option>
						<option value="1" <?php echo getsel($setting['seo']['disjump'], '1');?>>是</option>
					</select>
				</div>
				<div class="am-hide-sm-only am-u-md-4">禁用后，手机访问PC不再自动跳到手机站，直接访问手机站不受影响</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					图片本地化模式
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<select name="piclocal_type">
						<option value="tolocal" <?php echo getsel($setting['seo']['piclocal_type'], 'tolocal');?>>本地存储[推荐]</option>
						<option value="tocdn" <?php echo getsel($setting['seo']['piclocal_type'], 'tocdn');?>>七牛云存储</option>
					</select>
				</div>
				<div class="am-hide-sm-only am-u-md-4">仅对启用图片本地化的采集点有效</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					Sitemap路径规则
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="sitemap_url" placeholder="sitemap/baidu" value="<?php echo ($setting["seo"]["sitemap_url"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">基本适用于各大搜索引擎</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					阅读量虚拟
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="virtviews" placeholder="3,10" value="<?php echo ($setting["seo"]["virtviews"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">“3,10”表示随机增加3到10之间的点击数。如需固定请填写如“1,1”</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					搜索时间限制
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="number" class="am-input-sm" name="searchlimit" placeholder="30" value="<?php echo ($setting["seo"]["searchlimit"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">N秒内只能搜索一次，0则无限制</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					是否启用广告
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<select name="advertise">
						<option value="0" <?php echo getsel($setting['seo']['advertise'], '0');?>>关闭</option>
						<option value="1" <?php echo getsel($setting['seo']['advertise'], '1');?>>开启</option>
					</select>
				</div>
				<div class="am-hide-sm-only am-u-md-4">仅在开启时才显示广告</div>
			</div>
			<hr>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					TAG标签路径规则
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="tag_url" placeholder="tag/{ename}" value="<?php echo ($setting["seo"]["tag_url"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">{ename}-标签拼音，{id}-标签id</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					TAG标签页标题
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="tagtitle" placeholder="{tagname}_{webname}" value="<?php echo ($setting["seo"]["tagtitle"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{webname}、{tagname}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					TAG标签页关键词
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="tagkw" value="<?php echo ($setting["seo"]["tagkw"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{webname}、{tagname}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					TAG标签页描述
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="tagdes" value="<?php echo ($setting["seo"]["tagdes"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{webname}、{tagname}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					AUTHOR作者路径规则
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="author_url" placeholder="author/{author}" value="<?php echo ($setting["seo"]["author_url"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">{author}-作者名</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					AUTHOR作者页标题
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="authortitle" placeholder="{author}_{webname}" value="<?php echo ($setting["seo"]["authortitle"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{webname}、{author}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					AUTHOR作者页关键词
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="authorkw" value="<?php echo ($setting["seo"]["authorkw"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{webname}、{author}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					AUTHOR作者页描述
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="authordes" value="<?php echo ($setting["seo"]["authordes"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{webname}、{author}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					SEOWORD路径规则
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="seoword_url" placeholder="site/{ename}" value="<?php echo ($setting["seo"]["seoword_url"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">{ename}-标签拼音，{id}-标签id</div>
			</div>
			<hr>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					首页标题
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="indextitle" placeholder="首页标题" value="<?php echo ($setting["seo"]["indextitle"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">不可使用变量</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					首页关键词
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="indexkw" placeholder="首页关键词" value="<?php echo ($setting["seo"]["indexkw"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">不可使用变量</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					首页描述
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="indexdes" placeholder="首页描述" value="<?php echo ($setting["seo"]["indexdes"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">不可使用变量</div>
			</div>
			<hr>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					列表页标题
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="listtitle" placeholder="{cate}_{webname}" value="<?php echo ($setting["seo"]["listtitle"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{cate}、{webname}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					列表页关键词
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="listkw" placeholder="{cate},{webname}" value="<?php echo ($setting["seo"]["listkw"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{cate}、{webname}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					列表页描述
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="listdes" placeholder="{cate}是由{webname}为您提供的..." value="<?php echo ($setting["seo"]["listdes"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{cate}、{webname}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					列表页URL规则
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="listurl" placeholder="{dir}/{ellipsis}page_{page}.html{/ellipsis}" value="<?php echo ($setting["seo"]["listurl"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{dir}、{page}</div>
			</div>
			<hr>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					文章页标题
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="viewtitle" placeholder="{title}_{cate}_{webname}" value="<?php echo ($setting["seo"]["viewtitle"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{cate}、{webname}、{title}、{author}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					文章页关键词
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="viewkw" placeholder="{title},{author},{cate},{webname}" value="<?php echo ($setting["seo"]["viewkw"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{cate}、{webname}、{title}、{author}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					文章页描述
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="viewdes" placeholder="{intro}" value="<?php echo ($setting["seo"]["viewdes"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{cate}、{webname}、{title}、{author}、{intro}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					文章页URL规则
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<div class="am-u-sm-4 am-u-md-4 am-text-right">
						<select class="choseurl">
							<option value="">URL模式</option>
							<option value="{}book/{id}/">book/123/</option>
							<option value="{}xiaoshuo/{id}/">xiaoshuo/123/</option>
							<option value="{dir}/{id}/">xuanhuan(栏目dir)/123/</option>
							<option value="{subid}_{id}/">2_2731/</option>
							<option value="{subid}/{id}/">3/3120/</option>
						</select>
					</div>
					<div class="am-u-sm-8 am-u-md-8">
						<input type="text" class="am-input-sm" name="viewurl" placeholder="{dir}/{id}" value="<?php echo ($setting["seo"]["viewurl"]); ?>">
					</div>
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{dir}、{id}、{subid}、{}。{}表示空。必须包含两个变量且{id}是最后一个变量。如“{}book/{id}/”、“book/{dir}/{id}/”、“{subid}_{id}”。<br />以输入框结果为准，以“/”结尾，还是“.html”结尾，均可自行修改</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					文章ID偏移
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="idrule" placeholder="0" value="<?php echo ($setting["seo"]["idrule"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">对ID进行偏移，请填写正整数，默认0</div>
			</div>
			<hr>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					章节页标题
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="chaptertitle" placeholder="{ctitle}_{title}_{webname}" value="<?php echo ($setting["seo"]["chaptertitle"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{ctitle}、{title}、{author}、{cate}、{webname}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					章节页关键词
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="chapterkw" placeholder="{title},{author},{ctitle},{webname}" value="<?php echo ($setting["seo"]["chapterkw"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{ctitle}、{title}、{author}、{cate}、{webname}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					章节页描述
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="chapterdes" placeholder="" value="<?php echo ($setting["seo"]["chapterdes"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{ctitle}、{title}、{author}、{cate}、{webname}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					章节页URL规则
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<div class="am-u-sm-4 am-u-md-4 am-text-right">
						<select class="choseurl">
							<option value="">URL模式</option>
							<option value="{}book/{id}/{cid}.html">book/123/5.html</option>
							<option value="{}chapter/{id}/{cid}.html">chapter/123/5.html</option>
							<option value="{dir}/{id}/{cid}.html">xuanhuan(栏目dir)/123/5.html</option>
							<option value="{dir}/{id}_{cid}.html">xuanhuan(栏目dir)/123_5.html</option>
							<option value="{subid}_{id}/{cid}.html">2_2731/5.html</option>
							<option value="{subid}/{id}/{cid}.html">3/3120/5.html</option>
						</select>
					</div>
					<div class="am-u-sm-8 am-u-md-8">
						<input type="text" class="am-input-sm" name="chapterurl" placeholder="{dir}/{id}/{cid}.html" value="<?php echo ($setting["seo"]["chapterurl"]); ?>">
					</div>
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{}、{dir}、{id}、{cid}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					章节ID偏移
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="cidrule" placeholder="0" value="<?php echo ($setting["seo"]["cidrule"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">对章节CID进行偏移，请填写正整数，如“1000”</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					章节内容加载模式
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<select name="chapterload">
						<option value="0" <?php echo getsel($setting['seo']['chapterload'], '0');?>>静态加载</option>
						<option value="1" <?php echo getsel($setting['seo']['chapterload'], '1');?>>AJAX动态加载</option>
					</select>
				</div>
				<div class="am-hide-sm-only am-u-md-4">静态加载如果章节有内容，直接显示，没有加载动作。动态加载则每次都要进行请求，然后才加载。</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					章节分页设置
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="chapterlimit" placeholder="0" value="<?php echo ($setting["seo"]["chapterlimit"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">章节分页字数，推荐1500或2000，0或空则不分页（ajax动态加载时不分页）</div>
			</div>
			<hr>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					排行榜页标题
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="toptitle" placeholder="排行榜_{webname}" value="<?php echo ($setting["seo"]["toptitle"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{webname}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					排行榜URL规则
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="topurl" placeholder="top" value="<?php echo ($setting["seo"]["topurl"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">无翻页</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					全本页标题
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="fulltitle" placeholder="全本小说_完本小说_{webname}" value="<?php echo ($setting["seo"]["fulltitle"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{webname}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					全本URL规则
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="fullurl" placeholder="quanben" value="<?php echo ($setting["seo"]["fullurl"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">无翻页</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					书库页标题
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="alltitle" placeholder="书库_{webname}" value="<?php echo ($setting["seo"]["alltitle"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可用{webname}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					书库URL规则
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="allurl" placeholder="shuku{ellipsis}/page_{page}.html{/ellipsis}" value="<?php echo ($setting["seo"]["allurl"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">可翻页，参考列表页url写法</div>
			</div>
			<hr>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					章节内容终极过滤/替换规则
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<textarea class="am-input-sm" cols="30" rows="10" name="core_filter"><?php echo ($setting["seo"]["core_filter"]); ?></textarea>
				</div>
				<div class="am-hide-sm-only am-u-md-4">1.格式如“{filter replace='替换后代码'}&lt;div id="ad480"&gt;(.*)&lt;/div&gt;{/filter}”，支持正则，部分情况下需做转义处理<br>2.每行一条，如果只过滤不替换，可以只填写需过滤的内容<br>3.如启用章节页html缓存，则不会立即生效<br>4.此处替换对所有采集节点中的小说章节都有效</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					章节重采标记
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<textarea class="am-input-sm" cols="30" rows="10" name="repick_sign"><?php echo ($setting["seo"]["repick_sign"]); ?></textarea>
				</div>
				<div class="am-hide-sm-only am-u-md-4">每行一条，含有这些内容的章节，每次访问时都会重新进行采集。如“正在手打中”、“转码失败”</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					IP访问黑名单
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<textarea class="am-input-sm" cols="30" rows="10" name="blackiplist"><?php echo ($setting["seo"]["blackiplist"]); ?></textarea>
				</div>
				<div class="am-hide-sm-only am-u-md-4">ip之间以“|”间隔。ip段请写成“123.123.123.*”的格式。此列表中的IP将无法访问网站任何页面</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					小说黑名单
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<textarea class="am-input-sm" cols="30" rows="10" name="blackbooklist"><?php echo ($setting["seo"]["blackbooklist"]); ?></textarea>
				</div>
				<div class="am-hide-sm-only am-u-md-4">小说名称之间以“|”间隔。名称包含这些关键词的小说将无法访问，不进行采集</div>
			</div>
			<hr>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					图片懒加载lazyload
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<select name="lazyload">
						<option value="0" <?php echo getsel($setting['seo']['lazyload'], '0');?>>关闭</option>
						<option value="1" <?php echo getsel($setting['seo']['lazyload'], '1');?>>仅PC开启</option>
						<option value="2" <?php echo getsel($setting['seo']['lazyload'], '2');?>>全站开启</option>
					</select>
				</div>
				<div class="am-hide-sm-only am-u-md-4"></div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					百度站内搜索
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<select name="znsearch">
						<option value="0" <?php echo getsel($setting['seo']['znsearch'], '0');?>>关闭 - 使用系统自带搜索</option>
						<option value="1" <?php echo getsel($setting['seo']['znsearch'], '1');?>>开启 - 使用百度站内搜索，需配置SID</option>
					</select>
				</div>
				<div class="am-hide-sm-only am-u-md-4"></div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					百度站内搜索SID
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="znsid" value="<?php echo ($setting["seo"]["znsid"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4"></div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					百度主动推送API
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="pushapi" value="<?php echo ($setting["seo"]["pushapi"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">不使用此功能请留空，目前只推送PC链接。<a href="<?php echo U('setting',array('action'=>'showpush'));?>" target="_blank">推送余额</a></div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					统计代码
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<textarea class="am-input-sm" cols="30" rows="10" name="statcode"><?php echo ($setting["seo"]["statcode"]); ?></textarea>
				</div>
				<div class="am-hide-sm-only am-u-md-4"></div>
			</div>
			<div class="am-margin">
				<button type="submit" class="am-btn am-btn-primary am-btn-sm">提交保存</button>
			</div>
			</form>
		</div>
		<div class="am-tab-panel am-fade am-in" id="tab2">
			<form class="am-form" action="/book/index.php?s=/Admin/Index/setting" method="post" target="_self">
			<input type="hidden" name="action" value="admin"/>
			<div class="am-input-group">
				<span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i> 用户名</span>
				<input type="text" name="adminname" class="am-form-field" value="<?php echo ($adminname); ?>">
			</div>
			<div class="am-input-group">
				<span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i> 密　码</span>
				<input type="text" name="password" class="am-form-field" value="">
			</div>
			<div class="am-input-group">
				<button type="submit" class="am-btn am-btn-secondary">修改密码</button>
				tips:用户名不能超过20位，密码只允许字母数字，不能包含符号
			</div>
			</form>
		</div>
		<div class="am-tab-panel am-fade am-in" id="tab3">
			<form class="am-form" action="/book/index.php?s=/Admin/Index/setting" method="post" target="_self">
			<input type="hidden" name="action" value="flink"/>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					PC友情链接
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<textarea class="am-input-sm" cols="30" rows="20" name="flink"><?php echo ($flink); ?></textarea>
				</div>
				<div class="am-hide-sm-only am-u-md-4">一行一个，链接名称和url以“|”分隔</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					WAP友情链接
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<textarea class="am-input-sm" cols="30" rows="20" name="flink_wap"><?php echo ($flink_wap); ?></textarea>
				</div>
				<div class="am-hide-sm-only am-u-md-4">一行一个，链接名称和url以“|”分隔</div>
			</div>
			<div class="am-margin">
				<button type="submit" class="am-btn am-btn-primary am-btn-sm">提交保存</button>
			</div>
			</form>
		</div>
		<div class="am-tab-panel am-fade am-in" id="tab4">
			<form class="am-form" action="/book/index.php?s=/Admin/Index/setting" method="post" target="_self">
			<input type="hidden" name="action" value="extra"/>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					列表页缓存时间
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="listcachetime" placeholder="7200" value="<?php echo ($setting["extra"]["listcachetime"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">单位：秒，建议3600-7200</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					文章页缓存时间
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" placeholder="86400" value="0" readonly>
				</div>
				<div class="am-hide-sm-only am-u-md-4">小说作者简介等是永久保存的</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					章节列表缓存时间
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="chaptercachetime" placeholder="7200" value="<?php echo ($setting["extra"]["chaptercachetime"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">单位：秒，每隔指定时间访问小说时抓取一次最新章节列表</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					超链接过滤白名单
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="wlist_domain" placeholder="qq.com,baidu.com,360.cn" value="<?php echo ($setting["extra"]["wlist_domain"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">以“,”隔开，如“qq.com,baidu.com”</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					静态缓存页面
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<div class="am-form-group">
						<label class="am-checkbox-inline">
							<input type="checkbox" name="html_option[]" value="index" <?php echo getsel('index', $setting['extra']['html_option'], 'checked');?>> 首页
						</label>
						<label class="am-checkbox-inline">
							<input type="checkbox" name="html_option[]" value="list" <?php echo getsel('list', $setting['extra']['html_option'], 'checked');?>> 列表页
						</label>
						<label class="am-checkbox-inline">
							<input type="checkbox" name="html_option[]" value="view" <?php echo getsel('view', $setting['extra']['html_option'], 'checked');?>> 小说页
						</label>
						<label class="am-checkbox-inline">
							<input type="checkbox" name="html_option[]" value="chpater" <?php echo getsel('chpater', $setting['extra']['html_option'], 'checked');?>> 章节页（慎选）
						</label>
					</div>
				</div>
				<div class="am-hide-sm-only am-u-md-4">启用后将提升速度，也会占用更多空间，章节页占用很多空间。章节页缓存24小时，其他页面缓存为1小时</div>
			</div>
			<hr>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					采集代理设置
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" id="proxy_address" class="am-input-sm" name="pick_proxy" placeholder="https://127.0.0.1:8080" value="<?php echo ($setting["extra"]["pick_proxy"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">如“http://127.0.0.1:8080”。<a href="javascript:;" onclick="window.open('http://www.ip181.com/')">查找代理</a>，仅采集点启用代理时有效<a href="javascript:;" onclick="url = '<?php echo U('setting', array('action' => 'test_proxy'));?>' . replace('.html', '')  + '&proxy=' + encodeURIComponent($('#proxy_address').val());window.open(url)" class="am-btn am-btn-sm am-btn-default">测试</a></div>
			</div>
			<hr>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					七牛云存储bucket（空间名）
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="qiniu_bucket" value="<?php echo ($setting["extra"]["qiniu_bucket"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">仅在启用七牛云存储时有效</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					七牛云存储AccessKey
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="qiniu_accesskey" value="<?php echo ($setting["extra"]["qiniu_accesskey"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">仅在启用七牛云存储时有效</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					七牛云存储SecretKey
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="qiniu_secretkey" value="<?php echo ($setting["extra"]["qiniu_secretkey"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">仅在启用七牛云存储时有效</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					七牛云存储域名
				</div>
				<div class="am-u-sm-8 am-u-md-6">
					<input type="text" class="am-input-sm" name="qiniu_domian" value="<?php echo ($setting["extra"]["qiniu_domian"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-4">仅在启用七牛云存储时有效</div>
			</div>
			<div class="am-margin">
				<button type="submit" class="am-btn am-btn-primary am-btn-sm">提交保存</button>
			</div>
			</form>
		</div>
	</div>
</div>
<script>
$(function(){
	$('.choseurl').on('change', function(){
		$(this).parents('.am-u-md-6').find('input[type=text]').val($(this).val());
	});
})
</script>
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