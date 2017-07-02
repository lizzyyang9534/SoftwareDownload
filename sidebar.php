<div class="ui vertical menu width-250">
<?php
	require_once('include/DB.php');
	$result = getAllCategory();
	while($rowResult = $result -> fetch()){
?>
	<a class="teal item" href="index.php?id=<?php echo $rowResult['category_id']; ?>"><?php echo $rowResult['category_name']; ?></a>	
<?php
	}
?>
</div>