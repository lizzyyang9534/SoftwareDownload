<?php
	ini_set('display_errors', 1); //顯示錯誤訊息 
	ini_set('log_errors', 1); //錯誤log 檔開啟 
	//ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); //log檔位置
	error_reporting(E_ALL); //錯誤回報
?>
<html>
	<head>
		<meta charset="utf8">
	</head>
	<body>
		<?php
			$uploadDir = "./";
			$uploadFile =$uploadDir.iconv("UTF-8","Big5",$_FILES["uploadFile"]["name"]);
			
			if(move_uploaded_file($_FILES["uploadFile"]["tmp_name"],$uploadFile))
			{
				echo "success<hr>";
				echo "File name ". $_FILES["uploadFile"]["name"]."<br>";
				echo "File size ". $_FILES["uploadFile"]["size"]."<br>";
				echo "File temp name ". $_FILES["uploadFile"]["tmp_name"]."<br>";
				echo "File type ". $_FILES["uploadFile"]["type"]."<br>";
			}
			else
			{
				echo "failed<hr>";
			}
		?>
	</body>
</html>