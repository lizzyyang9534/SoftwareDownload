<a href="index.php" class="s_logo">
	<img src="images/CCUCC-LOGO.png" height="38" width="48" class="float-left margin-6-0">
	<div class="float-right">校園授權軟體</div>
</a>

<div class="float-right margin-right-50 margin-top-8">
    <a href="logout.php" class="s_button">登出</a>
</div>

<?php
if(isset($_SESSION['admin']) && $_SESSION['admin'] == "Y"){
?>
<div class="float-right margin-right-20 margin-top-8">
    <a href="manage.php" class="s_button2">管理</a>
</div>
<?php
}
?>