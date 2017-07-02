<?php
require_once('../include/DB.php');

$manage = $_POST["manage"];

if($manage == "category"){
	$name = $_POST["name"];
	try{
		$sql = "insert into soft_category (category_name) values(:category_name);";
		$statement = $dbh -> prepare($sql);
		$statement -> bindParam(':category_name', $name, PDO::PARAM_STR);
		$statement -> execute();
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}
else if($manage == "software"){	
	$name = $_POST["name"];
	$category = $_POST["category"];
	$description = $_POST["description"];
	try{
		$sql = "insert into soft_software (software_name,category_id,description) values(:software_name,:category_id,:description)";
		$statement = $dbh -> prepare($sql);
		$statement -> bindParam(':software_name', $name, PDO::PARAM_STR); 
		$statement -> bindParam(':category_id', $category, PDO::PARAM_INT);		
		$statement -> bindParam(':description', $description, PDO::PARAM_STR);
		$statement -> execute();
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}
else if($manage == "path"){
	$name = $_POST["name"];
	$software = $_POST["software"];
	$path = $_POST["path"];
	try{
		$sql = "insert into soft_path (software_id,download_name,download_path) values(:software_id,:download_name,:download_path)";
		$statement = $dbh -> prepare($sql);
		$statement -> bindParam(':software_id', $software, PDO::PARAM_INT);
		$statement -> bindParam(':download_name', $name, PDO::PARAM_STR);   
		$statement -> bindParam(':download_path', $path, PDO::PARAM_STR);
		$statement -> execute();
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}
else if($manage == "news"){
	$news = $_POST["news"];
	try{
		$sql = "insert into soft_news (news_content) values(:news_content)";
		$statement = $dbh -> prepare($sql);
		$statement -> bindParam(':news_content', $news, PDO::PARAM_STR);
		$statement -> execute();
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}
?>