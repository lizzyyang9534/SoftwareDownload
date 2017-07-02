<?php
ini_set("display_errors", 1);

$dbh = connectDB();

function connectDB()
{
	$dbname = //dbname;
	$username = //username;
	$host = //host;
	$password = //password;

	$dbh = new PDO("pgsql:dbname=$dbname;host=$host", $username, $password );
	return $dbh;
}
function getSoftware($ID){
	$dbh = connectDB();
	$sql = "select * from soft_software s,soft_category c where s.category_id = c.category_id and s.category_id = ".$ID." and s.software_on = 1 order by software_name;";
	$result = $dbh -> query($sql);
	return $result;
}
function getAllSoftware(){
	$dbh = connectDB();
	$sql = "select * from soft_software s,soft_category c where s.category_id = c.category_id and s.software_on = 1 order by s.category_id,software_name;";
	$result = $dbh -> query($sql);
	return $result;
}
function getCategory($ID){
	$dbh = connectDB();
	$sql = "select * from soft_category where category_id = ".$ID.";";
	$result = $dbh -> query($sql);
	return $result;
}
function getAllCategory(){
	$dbh = connectDB();
	$sql = 'select * from soft_category where category_on = 1 order by category_id';
	$result = $dbh -> query($sql);
	return $result;
}
function getSoftwareCategory(){
	$dbh = connectDB();
	$sql = 'select * from soft_category where category_id > 1 and category_on = 1 order by category_id';
	$result = $dbh -> query($sql);
	return $result;
}
function getPath($ID){
	$dbh = connectDB();
	$sql = "select p.*,s.software_id from soft_path p,soft_software s where p.software_id = s.software_id and p.software_id = ".$ID." and path_on = 1order by download_name";
	$result = $dbh -> query($sql);
	return $result;
}
function getAllPath(){
	$dbh = connectDB();
	$sql = 'select s.software_name,p.* from soft_software s,soft_path p where p.software_id = s.software_id and path_on = 1 order by software_name,download_name;';
	$result = $dbh -> query($sql);
	return $result;
}
function getDownloadPath($ID){
	$dbh = connectDB();
	$sql = "select download_path,download_count from soft_path where path_id = ".$ID.";";
	$result = $dbh -> query($sql);
	return $result;
}
function getAdmin(){
	$dbh = connectDB();
	$sql = "SELECT account FROM soft_administrator;";
	$result = $dbh -> query($sql);
	return $result;
}
function getMember($account){
	$dbh = connectDB();
	$sql = "SELECT * FROM soft_member WHERE account = '".$account."'";
	$result = $dbh -> query($sql);
	return $result;
}
function getNews(){
	$dbh = connectDB();
	$sql = "select * from soft_news order by news_id DESC";
	$result = $dbh -> query($sql);
	return $result;
}
function getPasswordStudent($id){
	$dbh = connectDB();
	$sql = "select * from a11vpasswd where std_no = '".$id."'";
	$result = $dbh -> query($sql);
	return $result;
}
function getPasswordStudentGra($id){
	$dbh = connectDB();
	$sql = "select * from gra_a11vpasswd where std_no = '".$id."'";
	$result = $dbh -> query($sql);
	return $result;
}
function getPasswordOther($id){
	$dbh = connectDB();
	$sql = "SELECT password FROM x00tpseudo_uid_ WHERE staff_cd= '".$id."'";
	$result = $dbh -> query($sql);
	return $result;
}
function getPasswordOtherEncode($password){
	$dbh = connectDB();
	$sql = "select encode(encrypt('".$password."','bsofafrfktr','aes'),'hex')";
	$result = $dbh -> query($sql);
	return $result;
}
function getInformationStudent($id){
	$dbh = connectDB();
	$sql = "select name from a11tstd_rec where std_no = '".$id."'";
	$result = $dbh -> query($sql);
	return $result;
}
function getInformationStudentGra($id){
	$dbh = connectDB();
	$sql = "select name from gra_a11tstd_rec where std_no = '".$id."'";
	$result = $dbh -> query($sql);
	return $result;
}
function getInformationOther($id){
	$dbh = connectDB();
	$sql = "SELECT c_name, sex FROM h0bvcomm WHERE staff_cd = '".$id."'";
	$result = $dbh -> query($sql);
	return $result;
}
function getStudentPersonid($id){
	$dbh = connectDB();
	$sql = "SELECT personid FROM a11tstd_rec WHERE std_no = '".$id."'";
	$result = $dbh -> query($sql);
	return $result;
}
function getStudentGraPersonid($id){
	$dbh = connectDB();
	$sql = "SELECT personid FROM gra_a11tstd_rec WHERE std_no = '".$id."'";
	$result = $dbh -> query($sql);
	return $result;
}
?>
