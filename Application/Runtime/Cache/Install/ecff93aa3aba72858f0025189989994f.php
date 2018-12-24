<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>
<link href="/book/Public/install/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
	<div class="logo"><a href="#" target="_blank"><img src="/book/Public/install/logo.png" alt="YGBOOK" title="YGBOOK" /></a></div>
	<div class="check">
		<h3>环境监测</h3>
		<ul>
			<li>服务器操作系统:	.................................................................<?php echo ($sys_info["os"]); ?></li>
			<li>Web 服务器:		.................................................................<?php echo ($sys_info["web_server"]); ?></li>
			<li>PHP 版本:		.................................................................<?php echo ($sys_info["php_ver"]); ?></li>
			<li>MySQL 版本:		.................................................................<?php echo ($sys_info["mysql_ver"]); ?></li>
			<li>Socket 支持:	.................................................................<?php echo ($sys_info["socket"]); ?></li>
			<li>时区设置:		.................................................................<?php echo ($sys_info["timezone"]); ?></li>
			<li>GD 版本:		.................................................................<?php echo ($sys_info["gd"]); ?></li>
			<li>Zlib 支持:		.................................................................<?php echo ($sys_info["zlib"]); ?></li>
		</ul>
		<h3>目录权限检测</h3>
		<ul>
			<?php if(is_array($writeable)): foreach($writeable as $key=>$v): ?><li><?php echo ($v["dir"]); ?> 		.................................................................<?php echo ($v["if_write"]); ?></li><?php endforeach; endif; ?>
		</ul>
		<p class="action">
			<input type="button" class="btnGray" value="后退" onclick="location.href='<?php echo U('index/index');?>'"/>
			<?php if($no_write != ''): ?><input type="submit" class="btnGray" value="继续" onclick="location.href='<?php echo U('index/setting');?>'" disabled="true"/>
			<?php else: ?>
			<input type="submit" class="btn" value="继续" onclick="location.href='<?php echo U('index/setting');?>'"/><?php endif; ?>
		</p>
	</div>
</div>
</body>
</html>