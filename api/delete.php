<?php
require_once('../include/DB.php');
$dbh = connectDB();

$manage = $_POST["manage"];
$id = $_POST["id"];

if($manage == "category"){
	try{		
		$sql = "update soft_category set category_on = 0 where category_id = :category_id";
		$statement = $dbh -> prepare($sql);
		$statement -> bindParam(':category_id', $id, PDO::PARAM_INT);
		$statement -> execute();
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}
else if($manage == "software"){	
	try{		
		$sql = "update soft_software set software_on = 0 where software_id = :software_id";
		$statement = $dbh -> prepare($sql);
		$statement -> bindParam(':software_id', $id, PDO::PARAM_INT);
		$statement -> execute();
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}
else if($manage == "path"){
	try{		
		$sql = "update soft_path set path_on = 0 where path_id = :path_id";
		$statement = $dbh -> prepare($sql);
		$statement -> bindParam(':path_id', $id, PDO::PARAM_INT);
		$statement -> execute();
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}
else if($manage == "news"){
	try{		
		$sql = "update soft_news set news_on = 0 where news_id = :news_id";
		$statement = $dbh -> prepare($sql);
		$statement -> bindParam(':news_id', $id, PDO::PARAM_INT);
		$statement -> execute();
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}
?>