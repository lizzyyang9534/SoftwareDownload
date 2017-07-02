<?php
	header("Content-Type: text/html;charset=utf-8");
	session_start();
	unset($_SESSION["account"]);
	//echo "登出成功!";
	header("Location:login.php");
?>