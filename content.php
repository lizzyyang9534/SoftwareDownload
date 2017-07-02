<?php
if(@$_GET['id'] > 1)
	include_once 'download.php';
else
	include_once 'news.php';
?>