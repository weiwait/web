<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
</head>
<style>
	. {
		margin: 0;
		padding: 0;
	}
	form {
		width: 100%;
		height: 500px;
		margin: 80px auto;
	}
	.input-wrap {
		width: 280px;
		height: 28px;
		margin: auto;
	}
	.input-wrap input {
		width: 180px;
		height: 28px;
		margin: auto;
	}
	.submit input {
		width: 80px;
		height: 38px;
		font-size: 22px;
	}
	.submit {
		border: 1px solid #ccc;
		width: 80px;
		height: 38px;
		margin: 20px auto;
	}
	.popup-true, .popup-false {
		width: 168px;
		height: 148px;
		position: relative;
		top: -50px;
		left: 43%;
		border: 1px solid #cbd;
		background: red;
		line-height: 148px;
		text-align: center;
		font-size: 28px;
		display: none;
	}
	.popup-false {
		top: -200px;
	}
</style>
<body>
	<form action="" method="post" id="sub" onsubmit="return sub();">
		<div class="input-wrap">教师名称:<input type="text" name="teacher"></div>
		<div class="submit"><input type="submit" value="添加"></div>
		<div class="popup-true">添加成功</div>
		<div class="popup-false">添加失败</div>
	</form>
	<script type="text/javascript" src="/web/Public/assets/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="/web/Public/assets/js/ajaxForm.js"></script>
	<script type="text/javascript">
		function sub() {
			$('#sub').ajaxSubmit(function(m) {
				if(m >= 1) {
					$('.popup-true').fadeIn(1200, function() {
						$(this).slideUp(800,function() {
							window.location.reload();
						});
					});
				}else {
					$('.popup-false').slideDown(1200, function() {
						$(this).fadeOut(800, function() {
							window.location.reload();
						});
					});
				}
			});
			return false;
		}
	</script>
</body>
</html>