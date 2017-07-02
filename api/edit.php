<?php
require_once('../include/DB.php');

$manage = $_POST["manage"];
$id = $_POST["id"];

if($manage == "category"){
	$name = $_POST["name"];
	try{
		$sql = "update soft_category set category_name = :category_name where category_id = :category_id";
		$statement = $dbh -> prepare($sql);
		$statement -> bindParam(':category_name', $name, PDO::PARAM_STR);
		$statement -> bindParam(':category_id', $id, PDO::PARAM_INT);
		$statement -> execute();
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}
else if($manage == "software"){	
	$name = $_POST["name"];
	$description = $_POST["description"];
	try{
		$sql = "update soft_software set software_name = :software_name,description = :description where software_id = :software_id";
		$statement = $dbh -> prepare($sql);
		$statement -> bindParam(':software_name', $name, PDO::PARAM_STR);   
		$statement -> bindParam(':description', $description, PDO::PARAM_STR);
		$statement -> bindParam(':software_id', $id, PDO::PARAM_INT);
		$statement -> execute();
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}
else if($manage == "path"){
	$name = $_POST["name"];
	$path = $_POST["path"];
	try{
		$sql = "update soft_path set download_name = :download_name,download_path = :download_path where path_id = :path_id";
		$statement = $dbh -> prepare($sql);
		$statement -> bindParam(':download_name', $name, PDO::PARAM_STR);   
		$statement -> bindParam(':download_path', $path, PDO::PARAM_STR);
		$statement -> bindParam(':path_id', $id, PDO::PARAM_INT);
		$statement -> execute();
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}
if($manage == "news"){
	$news = $_POST["news"];
	try{
		$sql = "update soft_news set news_content = :news_content where news_id = :news_id";
		$statement = $dbh -> prepare($sql);
		$statement -> bindParam(':news_content', $news, PDO::PARAM_STR);
		$statement -> bindParam(':news_id', $id, PDO::PARAM_INT);
		$statement -> execute();
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}
?>