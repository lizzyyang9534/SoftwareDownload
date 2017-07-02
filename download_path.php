<?php
require_once('./include/DB.php');

$id = $_POST["id"];

$result = getDownloadPath($id);
$rowResult = $result -> fetch();

$count = $rowResult["download_count"];
$count += 1;
$sql = "update soft_path set download_count = :download_count where path_id = ".$id.";";
$statement = $dbh -> prepare($sql);
$statement -> bindParam(':download_count', $count, PDO::PARAM_INT);
$statement -> execute();

$path = $rowResult["download_path"];
echo "ftp://soft.ccu.edu.tw/public/".$path;
?>