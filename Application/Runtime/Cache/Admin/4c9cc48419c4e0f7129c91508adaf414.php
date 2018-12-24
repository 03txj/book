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
			<li><a href="/book/index.php?s=/Admin/index/article.html"><span class="am-icon-user"></span> 后台首页</a></li>
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
		<style type="text/css">
	.admin-content{
		min-height: 750px;
	}
</style>
<div class="am-cf am-padding am-padding-bottom-0">
	<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">文章列表/管理</strong></div>
</div>
<hr>
<?php if($action == null): ?><div class="am-g">
	<div class="am-u-sm-12 am-u-md-8">
		<div class="am-form-group">
			<select data-am-selected="{btnSize: 'sm'}" onchange="gotype(this.options[this.selectedIndex])">
			<option value="all">全部文章</option>
			<?php if(is_array($category)): foreach($category as $key=>$vo): ?><option value="<?php echo ($key); ?>" <?php echo getsel($cate, $key);?>><?php if($key == 'default'): ?>默认-<?php endif; echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
				<option value="nocover" <?php echo getsel($cate, 'nocover');?>>无封面图</option>
				<option value="nocate" <?php echo getsel($cate, 'nocate');?>>无分类</option>
			</select>
			<select data-am-selected="{btnSize: 'sm'}" onchange="gopick(this.options[this.selectedIndex])">
			<option value="all">采集节点</option>
			<?php if(is_array($pick)): foreach($pick as $key=>$vo): ?><option value="<?php echo ($key); ?>" <?php echo getsel($picker, $key);?>><?php echo ($key); ?></option><?php endforeach; endif; ?>
			</select>
			<select data-am-selected="{btnSize: 'sm'}" onchange="goorder(this.options[this.selectedIndex])">
				<option value="id" <?php echo getsel($orderby, 'id');?>>编号(默认)</option>
				<option value="views" <?php echo getsel($orderby, 'views');?>>总人气</option>
				<option value="monthviews" <?php echo getsel($orderby, 'monthviews');?>>月人气</option>
				<option value="weekviews" <?php echo getsel($orderby, 'weekviews');?>>周人气</option>
				<option value="posttime" <?php echo getsel($orderby, 'posttime');?>>发表时间</option>
				<option value="updatetime" <?php echo getsel($orderby, 'updatetime');?>>更新时间</option>
				<option value="full" <?php echo getsel($orderby, 'full');?>>完结</option>
				<option value="original" <?php echo getsel($orderby, 'original');?>>原创</option>
				<option value="push" <?php echo getsel($orderby, 'push');?>>已推送</option>
			</select>
		</div>
	</div>
	<div class="am-u-sm-12 am-u-md-3">
		<form role="search" action="/book/index.php?s=/Admin/Index/article" method="post">
			<div class="am-input-group am-input-group-sm">
				<input type="text" class="am-form-field" name="q" value="<?php echo ($q); ?>" onclick="this.value=''">
				<span class="am-input-group-btn">
					<button class="am-btn am-btn-default" type="submit">搜索</button>
				</span>
			</div>
		</form>
	</div>
	<div class="am-u-sm-12 am-u-md-1">
		<a class="am-btn am-btn-success am-btn-sm" href="<?php echo U('article', array('action' => 'add'));?>">
			<i class="am-icon-plus"></i> 添加文章
		</a>
	</div>
</div><?php endif; ?>
<div class="am-g">
	<div class="am-u-sm-12">
	<?php if($action == 'add' or $action == 'edit'): ?><form class="am-form" action="/book/index.php?s=/Admin/Index/article" method="post" target="_self">
		<input type="hidden" name="action" value="<?php echo ($action); ?>"/>
		<input type="hidden" name="id" value="<?php echo ($articledb["id"]); ?>">
		<input type="hidden" name="do" value="save">
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					源网页地址
				</div>
				<div class="am-u-sm-8 am-u-md-4">
					<?php if($action == 'edit'): ?><input type="text" class="am-input-sm" name="url" value="<?php echo ($articledb["url"]); ?>">
					<?php else: ?>
					<input type="text" name="url" class="am-input-sm"><?php endif; ?>
				</div>
				<div class="am-hide-sm-only am-u-md-6">必填，必须符合采集规则中的网址</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					所属采集点
				</div>
				<div class="am-u-sm-8 am-u-md-4">
					<select name="pid">
					<?php if(is_array($pick)): foreach($pick as $key=>$vo): ?><option value="<?php echo ($key); ?>"<?php if($articledb['pid'] == $vo['name']): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</div>
				<div class="am-hide-sm-only am-u-md-6"></div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					文章标题
				</div>
				<div class="am-u-sm-8 am-u-md-4">
					<input type="text" class="am-input-sm" name="title" value="<?php echo ($articledb["title"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-6">*必填</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					文章分类
				</div>
				<div class="am-u-sm-8 am-u-md-4">
					<select name="cate">
					<?php if(is_array($category)): foreach($category as $key=>$vo): ?><option value="<?php echo ($vo["dir"]); ?>"<?php if($articledb['cate'] == $vo['dir']): ?>selected<?php endif; ?>><?php if($key == 'default'): ?>默认-<?php endif; echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</div>
				<div class="am-hide-sm-only am-u-md-6"></div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					文章作者
				</div>
				<div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
					<input type="text" class="am-input-sm" name="author" value="<?php echo ($articledb["author"]); ?>">
				</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					浏览量
				</div>
				<div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
					<input type="text" class="am-input-sm" name="views" value="<?php echo ($articledb["views"]); ?>">
				</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					周浏览量
				</div>
				<div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
					<input type="text" class="am-input-sm" name="weekviews" value="<?php echo ($articledb["weekviews"]); ?>">
				</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					月浏览量
				</div>
				<div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
					<input type="text" class="am-input-sm" name="monthviews" value="<?php echo ($articledb["monthviews"]); ?>">
				</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					缩略图/封面
				</div>
				<div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
					<input type="text" class="am-input-sm" name="thumb" value="<?php echo ($articledb["thumb"]); ?>">
				</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					完结
				</div>
				<div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
					<select name="full">
						<option value="0" <?php echo getsel($articledb['full'], '0');?>>否</option>
						<option value="1" <?php echo getsel($articledb['full'], '1');?>>是</option>
					</select>
				</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					原创
				</div>
				<div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
					<select name="original">
						<option value="0" <?php echo getsel($articledb['original'], '0');?>>否</option>
						<option value="1" <?php echo getsel($articledb['original'], '1');?>>是</option>
					</select>
				</div>
				<div class="am-hide-sm-only am-u-md-6">原创小说不会自动更新，只能手动添加/编辑/删除章节。节点任选，url不和现有的重复</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					强制更新
				</div>
				<div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
					<select name="update">
						<option value="0" <?php echo getsel($articledb['update'], '0');?>>否</option>
						<option value="1" <?php echo getsel($articledb['update'], '1');?>>是</option>
					</select>
				</div>
			</div>
			<?php if($action == 'edit'): ?><div class="am-g am-margin-top-sm">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					SEO优化/标题
				</div>
				<div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
					<input type="text" class="am-input-sm" placeholder="留空则使用系统设置" name="seotitle" value="<?php echo ($articledb["seotitle"]); ?>">
				</div>
			</div>
			<div class="am-g am-margin-top-sm">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					SEO优化/关键词
				</div>
				<div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
					<input type="text" class="am-input-sm" placeholder="留空则使用系统设置" name="seokeyword" value="<?php echo ($articledb["seokeyword"]); ?>">
				</div>
			</div>
			<div class="am-g am-margin-top-sm">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					SEO优化/描述
				</div>
				<div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
					<input type="text" class="am-input-sm" placeholder="留空则使用系统设置" name="seodescription" value="<?php echo ($articledb["seodescription"]); ?>">
				</div>
			</div>
			<div class="am-g am-margin-top-sm">
				<div class="am-u-sm-12 am-u-md-2 am-text-right admin-form-text">
					内容摘要（内容的简化）
				</div>
				<div class="am-u-sm-12 am-u-md-10">
					<textarea name="description" id="description" cols="30" rows="10"><?php echo ($articledb["description"]); ?></textarea>
				</div>
			</div>
			<div class="am-g am-margin-top-sm">
				<div class="am-u-sm-12 am-u-md-2 am-text-right admin-form-text">
					文章内容/小说介绍
				</div>
				<div class="am-u-sm-12 am-u-md-10">
					<script id="ueditor" name="content" type="text/plain"><?php echo ($articledb["content"]); ?></script>
				</div>
			</div>
			<script type="text/javascript" charset="utf-8" src="/book/Public/ueditor/ueditor.config.js"></script>
			<script type="text/javascript" charset="utf-8" src="/book/Public/ueditor/ueditor.all.min.js"> </script>
			<script type="text/javascript">
				UE.getEditor('ueditor');
			</script><?php endif; ?>
			<div class="am-margin">
				<button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
			</div>
		</form>
	<?php else: ?>
		<form class="am-form" action="/book/index.php?s=/Admin/Index/article" method="post" target="_self">
		<input type="hidden" name="action">
		<input type="hidden" name="newfid">
			<table class="am-table am-table-striped am-table-hover table-main">
				<thead>
					<tr>
						<th class="table-check am-hide-sm-only"><input class="selectall" id="selectall" type="checkbox" /></th>
						<th class="table-id am-hide-sm-only">ID</th>
						<th class="table-title">标题</th>
						<th class="table-type am-hide-sm-only">类别</th>
						<th class="table-author am-hide-sm-only">作者</th>
						<th class="table-author am-hide-sm-only">节点</th>
						<th class="table-author am-hide-sm-only">人气(总/月/周)</th>
						<th class="table-author am-hide-sm-only">推送</th>
						<th class="table-date am-hide-sm-only">入库日期</th>
						<th class="table-set">操作</th>
					</tr>
				</thead>
				<?php if(is_array($articlelist)): foreach($articlelist as $key=>$vo): ?><tr>
						<td class="am-hide-sm-only"><input type="checkbox" name="ids[]" value="<?php echo ($vo["id"]); ?>" /></td>
						<td class="am-hide-sm-only"><?php echo ($vo["id"]); ?></td>
						<td><a href="<?php echo U('article',array('action'=>'edit','id'=>$vo['id']));?>" target="_blank"><?php echo ($vo["title"]); ?></a></td>
						<td class="am-hide-sm-only"><a href="<?php echo U('article',array('cate'=>$vo['cate']));?>"><?php echo ($vo["catename"]); ?></a></td>
						<td class="am-hide-sm-only"><a href="<?php echo reurl('author', $vo);?>" target="_blank"><?php echo ($vo["author"]); ?></a></td>
						<td class="am-hide-sm-only"><a href="<?php echo U('article',array('picker'=>$vo['pid']));?>"><?php echo ($vo["pid"]); ?></a></td>
						<td class="am-hide-sm-only"><?php echo ($vo["views"]); ?>/<?php echo ($vo["monthviews"]); ?>/<?php echo ($vo["weekviews"]); ?></td>
						<td class="am-hide-sm-only"><?php if($vo["push"] > 0): ?><font color=green>已推送</font><?php else: ?>未推送[<a href="<?php echo U('article',array('action'=>'push','id'=>$vo['id']));?>">推</a>]<?php endif; ?></td>
						<td class="am-hide-sm-only"><?php echo ($vo["posttime"]); ?></td>
						<td>
							<div class="am-dropdown" data-am-dropdown>
								<button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle><span class="am-icon-cog"></span> <span class="am-icon-caret-down"></span></button>
								<ul class="am-dropdown-content">
									<li><a href="<?php echo reurl('view', $vo);?>" target="_blank">查看</a></li>
									<li><a href="<?php echo U('article',array('action'=>'edit','id'=>$vo['id']));?>" target="_blank">编辑</a></li>
									<li><a onclick="return confirm('确认删除吗？')" href="<?php echo U('article',array('action'=>'del','id'=>$vo['id']));?>">删除</a></li>
									<li class="am-divider"></li>
									<li><a href="<?php echo U('article',array('action'=> 'settype' ,'type' => 'cfull','id'=>$vo['id']));?>">设为完结</a></li>
									<li><a href="<?php echo U('article',array('action'=> 'settype' ,'type' => 'update','id'=>$vo['id']));?>">强制更新</a></li>
									<li><a href="<?php echo U('article',array('action'=> 'settype' ,'type' => 'original','id'=>$vo['id']));?>">设为原创</a></li>
									<li class="am-divider"></li>
									<li><a href="<?php echo U('extend/chapter',array('action'=>'list','id'=>$vo['id']));?>">章节列表</a></li>
									<li><a href="javascript:;" class="loadpickers" data-aid="<?php echo ($vo["id"]); ?>">转换节点</a></li>
								</ul>
							</div>
						</td>
					</tr><?php endforeach; endif; ?>
			</table>
		</form>
		<div class="am-cf">
			<div class="am-fl">
				<button class="am-btn am-btn-primary selectall">全选</button>
				<div class="am-dropdown am-dropdown-up" data-am-dropdown>
					<button class="am-btn am-btn-danger am-dropdown-toggle" data-am-dropdown-toggle>批量操作 <span class="am-icon-caret-up"></span></button>
					<ul class="am-dropdown-content multi-operation">
						<li><a href="javascript:;" data-action="multi-delete">批量删除</a></li>
						<li><a href="javascript:;" data-action="multi-move">移动栏目</a></li>
					</ul>
				</div>
			</div>
			<div class="am-fr">
				<ul class="am-pagination"><?php echo ($pagehtml); ?></ul>
			</div>
		</div>
		<div class="am-modal am-modal-no-btn" tabindex="-1" id="move-modal">
			<div class="am-modal-dialog">
				<div class="am-modal-hd">批量移动文档
					<a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
				</div>
				<div class="am-modal-bd">
					<div style="margin: 20px 10px">
						移动文档到：
						<select name="move-to-fid">
							<option value="no">选择栏目</option>
							<?php if(is_array($category)): foreach($category as $key=>$vo): ?><option value="<?php echo ($key); ?>"><?php if($key == 'default'): ?>默认-<?php endif; echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="am-modal am-modal-no-btn" tabindex="-1" id="picker-modal">
			<div class="am-modal-dialog">
				<div class="am-modal-hd">节点列表
					<a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
				</div>
				<div class="am-modal-bd am-text-left">
					<div id="picker_area" style="margin: 20px 10px"><ul class="am-list am-list-static am-list-border"></ul></div>
				</div>
			</div>
		</div>
<script>
$(function(){
	$('.am-dropdown-toggle').each(function(){
		var obj = $(this).next('.am-dropdown-content');
		if($(document).height() - $(this).offset().top - 100 < 286){
			$(this).parent('.am-dropdown').addClass('am-dropdown-up');
		}
	});
	$('.selectall').on('click', function(){
		if($(this).attr('id') != 'selectall'){
			$('#selectall').click();
		}
		$('td input[type=checkbox]').attr('checked', $('#selectall').is(':checked'));
		$('td input[type=checkbox]').prop('checked', $('#selectall').is(':checked'));
		$('button.selectall').text($('#selectall').is(':checked') ? '不选' : '全选');
	});
	$('.multi-operation li a').on('click', function(){
		var idnum = $('td input[type=checkbox]:checked').length;
		$('.am-dropdown').dropdown('close');
		if(idnum < 1){
			alert('请选择要操作的文档');
		} else {
			var operation = $(this).data('action') == 'multi-delete' ? '删除' : '移动';
			$('.am-form input[name=action]').val($(this).data('action'));
			var toconfirm = function(title){
				if(confirm(title) === true){
					$('.am-form').submit();
				}
			}
			if($(this).data('action') == 'multi-move'){
				$('#move-modal').modal();
				$('select[name=move-to-fid]').on('change', function(){
					$('.am-form input[name=newfid]').val($(this).val());
					toconfirm('确认要' + operation + '这' + idnum + '个文档到' + $(this).find('option:selected').text() + '？');
				});
			} else {
				toconfirm('确认要' + operation + '这' + idnum + '个文档吗？');
			}
		}
	});
	$('.loadpickers').on('click', function(){
		aid = $(this).data('aid');
		itemhtml = '';
		$.ajax({
			url: "<?php echo U('pick', array('action' => 'picker_list', 'id' => '__string__'));?>" . replace('__string__', aid),
			async: true,
			dataType: 'json',
			success: function(data){
				$('.am-dropdown').dropdown('close');
				if(data.status == 'success'){
					if(data.picker_list.length > 0){
						$.each(data.picker_list, function(i, item){
							itemhtml += '<li><button class="am-btn am-btn-success am-btn-xs am-padding-xs" data-aid="'+aid+'" data-pid="'+item.pid+'">选择</button> '+item.pid+' - '+item.url+'</li>'
						});
						$('#picker-modal').modal();
						$('#picker_area ul').html(itemhtml);
					} else {
						alert('此文章暂无节点');
					}
				}
			}
		});
	});
	$('#picker_area').delegate('li button', 'click', function(){
		pid = $(this).data('pid'), aid = $(this).data('aid');
		if(confirm('确认要移动文档到《'+pid+'》') === true){
			location.href = "<?php echo U('pick', array('action' => 'singletoggle', 'id' => '__string1__', 'toname' => '__string2__'));?>" . replace('__string1__', aid) . replace('__string2__', pid);
		}
	});
})
</script><?php endif; ?>
	</div>
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