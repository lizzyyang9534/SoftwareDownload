<!DOCTYPE html>
<?php
	ini_set("display_errors", 1);
	include_once('include/DB.php');
	session_start();
	if(!isset($_SESSION["login_id"])){
		header("Location:login.php");
	}else{
?>
<html>
<head>
	<!-- Standard Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<!-- Site Properities -->
	<title>校園授權軟體</title>
    <link rel="stylesheet" type="text/css" href="css/semantic.css">
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
	<!-- Used with Tab History !-->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.address/1.6/jquery.address.min.js"></script>
	<script src="js/semantic.js"></script>
	<script type="text/javascript" src="js/js.js"></script>
</head>
<body>
	<div class="s_top">
		<?php include_once 'header.php';?>
    </div>
    <div class="s_main">
    	<div class="s_container s_center">
			<div class="sidebar">
				<div class="ui vertical menu width-250">
					<a class="teal item" href="manage.php?id=1">公告管理</a>
					<a class="teal item" href="manage.php?id=2">分類管理</a>
					<a class="teal item" href="manage.php?id=3">軟體管理</a>
					<a class="teal item" href="manage.php?id=4">載點管理</a>
				</div>
			</div>
			<div class="s_content">
				<?php
					switch(@$_GET['id'])
					{
						default:	
						case '1':
							include_once("manage_news.php");
							break;
						case '2':
							include_once("manage_category.php");
							break;
						case '3':
							include_once("manage_software.php");
							break;
						case '4':
							include_once("manage_path.php");
							break;
					}
				?>
			</div>
		</div>
	</div>
	<div class="s_gotop"><img src="images/gotop.png" height="50" width="50" class="padding-10"></div>
	<div class="ui vertical segment s_footer">
		<div class="s_center">
			<?php include_once 'footer.php';?>
		</div>
	</div>
</body>
</html>
<?php }?>