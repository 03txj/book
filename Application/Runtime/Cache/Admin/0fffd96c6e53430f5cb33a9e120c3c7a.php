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
			<li><a href="/book/index.php?s=/Admin/extend/dataarea.html"><span class="am-icon-user"></span> 后台首页</a></li>
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
		<script>
	function changedomain(obj){
		var type = obj.value;
		if(type){
			window.location.href= "<?php echo U('dataarea', array('domain' => '__string__'));?>" . replace('__string__', type);
		}
	}
</script>
<?php if($nowdomain == 'all' or $nowdomain == 'null'): ?><style>
	.am-tabs .am-btn{
		display: none;
	}
</style><?php endif; ?>
<div class="am-cf am-padding am-padding-bottom-0">
	<div class="am-cf am-form">
		<div class="am-g">
			<div class="am-u-md-8">
				<div class="am-fl"><strong class="am-text-primary am-text-lg">数据区块</strong> / <small><?php echo ($did); ?></small></div>
				<div class="am-fr">
					<select onchange="changedomain(this)">
						<option value="default"<?php if($nowdomain == 'default'): ?>selected<?php endif; ?>>默认站点</option>
						<option value="wap"<?php if($nowdomain == 'wap'): ?>selected<?php endif; ?>>默认手机站</option>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>
<hr>
<div class="am-tabs am-margin">
	<?php if($action == 'edit'): ?><div class="am-alert am-alert-warning" data-am-alert>
		<button type="button" class="am-close">&times;</button>
		<p>无需调用的数据留空即可。</p>
	</div>
	<div class="am-tab-panel am-fade am-in am-active">
		<form class="am-form" action="/book/index.php?s=/Admin/Extend/dataarea" method="post" target="_self">
		<input type="hidden" name="action" value="<?php echo ($action); ?>"/>
		<input type="hidden" name="did" value="<?php echo ($did); ?>"/>
		<input type="hidden" name="do" value="save"/>
		<input type="hidden" name="domain" value="<?php echo ($nowdomain); ?>"/>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				是否启用
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<select name="open">
					<option value="yes"<?php if($dataarea[$did]['open'] == 'yes'): ?>selected<?php endif; ?>>启用</option>
					<option value="no"<?php if($dataarea[$did]['open'] == 'no'): ?>selected<?php endif; ?>>停用</option>
				</select>
			</div>
			<div class="am-hide-sm-only am-u-md-4">是否启用</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				区块ID
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="did" value="<?php echo ($dataarea["$did"]["did"]); ?>" readonly>
			</div>
			<div class="am-hide-sm-only am-u-md-4">唯一标识，不可修改。</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				调用栏目
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<select name="cate">
					<option value="all"<?php if($dataarea[$did]['cate'] == 'all'): ?>selected<?php endif; ?>>全部栏目</option>
					<?php if(is_array($category)): foreach($category as $key=>$vo): ?><option value="<?php echo ($key); ?>"<?php if($dataarea[$did]['cate'] == $key): ?>selected<?php endif; ?>><?php if($key == 'default'): ?>默认-<?php endif; echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
				</select>
			</div>
			<div class="am-hide-sm-only am-u-md-4">多个栏目以“,”分隔，填写栏目dir。默认all，表示全部栏目</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				指定文章id
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="ids" value="<?php echo ($dataarea["$did"]["ids"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">以“,”分隔，此处填写后则栏目无需填写</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				排序依据
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<select name="orderby">
					<option value="id"<?php if($dataarea[$did]['orderby'] == 'id'): ?>selected<?php endif; ?>>文章id</option>
					<option value="views"<?php if($dataarea[$did]['orderby'] == 'views'): ?>selected<?php endif; ?>>总点击</option>
					<option value="weekviews"<?php if($dataarea[$did]['orderby'] == 'weekviews'): ?>selected<?php endif; ?>>周点击</option>
					<option value="monthviews"<?php if($dataarea[$did]['orderby'] == 'monthviews'): ?>selected<?php endif; ?>>月点击</option>
					<option value="updatetime"<?php if($dataarea[$did]['orderby'] == 'updatetime'): ?>selected<?php endif; ?>>更新时间</option>
				</select>
			</div>
			<div class="am-hide-sm-only am-u-md-4">默认id</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				排序方式
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<select name="orderway">
					<option value="desc"<?php if($dataarea[$did]['orderway'] == 'desc'): ?>selected<?php endif; ?>>倒序（从大到小）</option>
					<option value="asc"<?php if($dataarea[$did]['orderway'] == 'asc'): ?>selected<?php endif; ?>>顺序（从小到大）</option>
				</select>
			</div>
			<div class="am-hide-sm-only am-u-md-4">默认倒序</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				必须有缩略图
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<select name="hasthumb">
					<option value="no"<?php if($dataarea[$did]['hasthumb'] == 'no'): ?>selected<?php endif; ?>>否</option>
					<option value="yes"<?php if($dataarea[$did]['hasthumb'] == 'yes'): ?>selected<?php endif; ?>>是</option>
				</select>
			</div>
			<div class="am-hide-sm-only am-u-md-4">默认否</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				必须有简介
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<select name="hasinfo">
					<option value="no"<?php if($dataarea[$did]['hasinfo'] == 'no'): ?>selected<?php endif; ?>>否</option>
					<option value="yes"<?php if($dataarea[$did]['hasinfo'] == 'yes'): ?>selected<?php endif; ?>>是</option>
				</select>
			</div>
			<div class="am-hide-sm-only am-u-md-4">默认否</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				必须是全本
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<select name="isfull">
					<option value="no"<?php if($dataarea[$did]['isfull'] == 'no'): ?>selected<?php endif; ?>>否</option>
					<option value="yes"<?php if($dataarea[$did]['isfull'] == 'yes'): ?>selected<?php endif; ?>>是</option>
				</select>
			</div>
			<div class="am-hide-sm-only am-u-md-4">默认否</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				调用数量
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="number" class="am-input-sm" name="limit" value="<?php echo ($dataarea["$did"]["limit"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">默认10</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				调用简介字数
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="number" class="am-input-sm" name="infolen" value="<?php echo ($dataarea["$did"]["infolen"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">默认40</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				时间格式
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="text" class="am-input-sm" name="dateformat" value="<?php echo ($dataarea["$did"]["dateformat"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">默认“Y-m-d H:i:s”，对应为：年-月-日 时:分:秒。可只用m-d（月-日）等</div>
		</div>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				更新频率
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<input type="number" class="am-input-sm" name="expirehour" value="<?php echo ($dataarea["$did"]["expirehour"]); ?>">
			</div>
			<div class="am-hide-sm-only am-u-md-4">单位：小时，默认5，即5小时后会再次更新</div>
		</div>
		<div class="am-margin">
			<button type="submit" class="am-btn am-btn-primary am-btn-sm">提交保存</button>
		</div>
		<hr>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				区块参考代码
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<textarea class="am-input-sm" cols="30" rows="10" readonly><?php echo ($democode); ?></textarea>
			</div>
			<div class="am-hide-sm-only am-u-md-4">仅供参考，作者、简介等数据再未采集时，可能为空</div>
		</div>
		</form>
	</div>
	<?php elseif($action == 'export'): ?>
	<div class="am-tab-panel am-fade am-in am-active">
		<form class="am-form">
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				<?php echo ($nowdomain); ?>区块导出
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
		<form class="am-form" action="/book/index.php?s=/Admin/Extend/dataarea" method="post" target="_self">
		<input type="hidden" name="action" value="<?php echo ($action); ?>"/>
		<input type="hidden" name="do" value="save"/>
		<input type="hidden" name="domain" value="<?php echo ($nowdomain); ?>"/>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				规则导入(<?php echo ($nowdomain); ?>)
			</div>
			<div class="am-u-sm-8 am-u-md-6">
				<textarea class="am-input-sm" name="code" cols="30" rows="20"></textarea>
			</div>
			<div class="am-hide-sm-only am-u-md-4"></div>
		</div>
		<div class="am-margin">
			<button type="submit" class="am-btn am-btn-primary am-btn-sm">提交保存</button>
		</div>
		</form>
	</div>
	<?php else: ?>
	<div class="am-tab-panel am-fade am-in am-active">
		<div class="am-g am-margin-top">
			<div class="am-u-sm-4 am-u-md-2 am-text-right">
				是否启用
			</div>
			<div class="am-u-sm-8 am-u-md-5 am-text-right">
				区块ID（唯一，英文+字母）
			</div>
			<div class="am-hide-sm-only am-u-md-5">
				<a class="am-btn am-btn-secondary am-btn-sm" onclick="addline('addarea','codearea')"><span class="am-icon-plus"></span> 新增</a>
				<a class="am-btn am-btn-warning am-btn-sm" href="<?php echo U('dataarea', array('action' => 'export', 'domain' => $nowdomain));?>"><span class="am-icon-plus"></span> 导出</a>
				<a class="am-btn am-btn-success am-btn-sm" href="<?php echo U('dataarea', array('action' => 'import', 'domain' => $nowdomain));?>"><span class="am-icon-plus"></span> 导入</a>
			</div>
		</div>
		<form class="am-form" action="/book/index.php?s=/Admin/Extend/dataarea" method="post" target="_self">
		<input type="hidden" name="action" value="save"/>
		<input type="hidden" name="domain" value="<?php echo ($nowdomain); ?>"/>
		<?php $i=0;;?>
		<?php if(is_array($dataarea)): foreach($dataarea as $key=>$vo): if($key != 'default'): ?><div id="area_<?php echo ($i); ?>">
				<div class="am-g am-margin-top">
					<div class="am-u-sm-4 am-u-md-2 am-text-right">
						<select name="copen[]" id="popen_<?php echo ($i); ?>">
							<option value="yes"<?php if($vo['open'] == 'yes'): ?>selected<?php endif; ?>>启用</option>
							<option value="no"<?php if($vo['open'] == 'no'): ?>selected<?php endif; ?>>停用</option>
							<option value="deleted" style="display:none">删除</option>
						</select>
					</div>
					<div class="am-u-sm-8 am-u-md-5 am-text-right">
						<input type="text" class="am-input-sm" name="cdid[]" value="<?php echo ($vo["did"]); ?>" readonly>
					</div>
					<div class="am-hide-sm-only am-u-md-5">
						<a class="am-btn am-btn-success am-btn-xs" onclick="editdataarea('<?php echo ($key); ?>', '<?php echo ($nowdomain); ?>')"><span class="am-icon-pencil-square-o"></span> 编辑</a>
						<a class="am-btn am-btn-warning am-btn-xs" onclick="delline('<?php echo ($i); ?>')"><span class="am-icon-trash-o"></span> 删除</a>
					</div>
				</div>
			</div><?php endif; ?>
			<?php $i++;; endforeach; endif; ?>
		<div id="codearea">
			<div class="am-g am-margin-top am-hide-sm-only">
				<div class="am-u-sm-4 am-u-md-2 am-text-right">
					<select name="nopen[]">
						<option value="yes">启用</option>
						<option value="no">停用</option>
					</select>
				</div>
				<div class="am-u-sm-4 am-u-md-5 am-text-right">
					<input type="text" class="am-input-sm" name="ndid[]" placeholder="区块ID" value="">
				</div>
				<div class="am-hide-sm-only am-u-md-5">区块ID唯一，请用英文+字母，如“pc_index_1”</div>
			</div>
		</div>
		<div id="addarea"></div>
		<div class="am-margin">
			<button type="submit" class="am-btn am-btn-primary am-btn-sm">提交保存</button>
			<a href="<?php echo U('dataarea', array('action' => 'initialize', 'domain' => $nowdomain));?>" class="am-btn am-btn-warning am-btn-sm">更新区块数据</a>
		</div>
		</form>
	</div><?php endif; ?>
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