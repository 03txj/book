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
			<li><a href="/book/index.php?s=/Admin/extend/seowords.html"><span class="am-icon-user"></span> 后台首页</a></li>
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
		<?php
if($action == 'add'){ $seodb = array( 'title' => '{name}_{name}小说阅读网_新{name}', 'keywords' => '{name},{name}小说阅读网,新{name}', 'description' => '{name}是广大书迷必备的{name}小说阅读网。新{name}本着免费、无弹窗、全文字、更新快的宗旨,为大家提供各类型的免费小说。看小说就到{name}！', ); } ?>
<div class="am-cf am-padding am-padding-bottom-0">
	<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">关键词列表/管理</strong></div>
</div>
<hr>
<?php if($action == null): ?><div class="am-g">
	<div class="am-u-sm-12 am-fr">
		<a class="am-btn am-btn-success am-btn-sm" href="<?php echo U('seowords', array('action' => 'add'));?>">
			<i class="am-icon-plus"></i> 添加关键词
		</a>
	</div>
</div><?php endif; ?>
<div class="am-g">
	<div class="am-u-sm-12">
	<?php if($action == 'add' or $action == 'edit'): ?><form class="am-form" action="/book/index.php?s=/Admin/Extend/seowords" method="post" target="_self">
		<input type="hidden" name="action" value="<?php echo ($action); ?>"/>
		<input type="hidden" name="id" value="<?php echo ($seodb["id"]); ?>">
		<input type="hidden" name="do" value="save">
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					站名
				</div>
				<div class="am-u-sm-8 am-u-md-4">
					<?php if($action == 'add'): ?><textarea name="sitename" cols="30" rows="10" placeholder="每行一个站名，可批量添加，也可只添加单个"></textarea>
					<?php else: ?>
					<input type="text" class="am-input-sm" name="sitename" value="<?php echo ($seodb["sitename"]); ?>"><?php endif; ?>
				</div>
				<div class="am-hide-sm-only am-u-md-6">必填（如爱去小说网），即{name}</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					URL关键词/ename
				</div>
				<div class="am-u-sm-8 am-u-md-4">
					<?php if($action == 'add'): ?><textarea name="ename" cols="30" rows="10" placeholder="每行一个ename，需要与站名一一对应"></textarea>
					<?php else: ?>
					<input type="text" class="am-input-sm" name="ename" value="<?php echo ($seodb["ename"]); ?>"><?php endif; ?>
				</div>
				<div class="am-hide-sm-only am-u-md-6">*必填（如aiquxs）</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					网页标题
				</div>
				<div class="am-u-sm-8 am-u-md-4">
					<input type="text" class="am-input-sm" name="title" value="<?php echo ($seodb["title"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-6">*必填</div>
			</div>
			<div class="am-g am-margin-top">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					网页关键词
				</div>
				<div class="am-u-sm-8 am-u-md-4">
					<input type="text" class="am-input-sm" name="keywords" value="<?php echo ($seodb["keywords"]); ?>">
				</div>
				<div class="am-hide-sm-only am-u-md-6">*必填</div>
			</div>
			<div class="am-g am-margin-top-sm">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					网页描述
				</div>
				<div class="am-u-sm-8 am-u-md-4">
					<textarea name="description" cols="30" rows="10"><?php echo ($seodb["description"]); ?></textarea>
				</div>
				<div class="am-hide-sm-only am-u-md-6">*必填，{name}会被替换为上面的站名</div>
			</div>
			<div class="am-margin">
				<button type="submit" class="am-btn am-btn-primary am-btn-xs">提交保存</button>
			</div>
		</form>
	<?php else: ?>
		<form class="am-form" action="/book/index.php?s=/Admin/Extend/seowords" method="post" target="_self">
		<input type="hidden" name="action">
		<input type="hidden" name="newfid">
			<table class="am-table am-table-striped am-table-hover table-main">
				<thead>
					<tr>
						<th class="table-id am-hide-sm-only">ID</th>
						<th class="table-title">站名</th>
						<th class="table-type am-hide-sm-only">ename</th>
						<th class="table-author am-hide-sm-only">人气</th>
						<th class="table-set">操作</th>
					</tr>
				</thead>
				<?php if(is_array($seowordlist)): foreach($seowordlist as $key=>$vo): ?><tr>
						<td class="am-hide-sm-only"><?php echo ($vo["id"]); ?></td>
						<td><a href="<?php echo U('seowords',array('action'=>'edit','id'=>$vo['id']));?>" target="_blank"><?php echo ($vo["sitename"]); ?></a></td>
						<td class="am-hide-sm-only"><?php echo ($vo["ename"]); ?></td>
						<td class="am-hide-sm-only"><?php echo ($vo["views"]); ?></td>
						<td>
							<div class="am-dropdown" data-am-dropdown>
								<button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle><span class="am-icon-cog"></span> <span class="am-icon-caret-down"></span></button>
								<ul class="am-dropdown-content">
									<li><a href="<?php echo reurl('seoword', $vo);?>" target="_blank">查看</a></li>
									<li><a href="<?php echo U('seowords',array('action'=>'edit','id'=>$vo['id']));?>" target="_blank">编辑</a></li>
									<li><a href="<?php echo U('seowords',array('action'=>'del','id'=>$vo['id']));?>">删除</a></li>
								</ul>
							</div>
						</td>
					</tr><?php endforeach; endif; ?>
			</table>
		</form>
		<div class="am-cf">
			<div class="am-fr">
				<ul class="am-pagination"><?php echo ($pagehtml); ?></ul>
			</div>
		</div><?php endif; ?>
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