<script>
function download(ID){
	$.ajax({
		url: "download_path.php",
		type: "post",
		data: {
			id:ID
		},
		success: function(data) {
			window.open(data,'_blank');
		}
	});
}
</script>
<?php
	$result_category = getCategory($_GET['id']);
	$rowResult_category = $result_category -> fetch();
?>
<div class="s_header"><?php echo $rowResult_category["category_name"]?></div>
<?php
$result = getSoftware($_GET['id']);
while($rowResult = $result -> fetch()){
?>
<table class="ui striped table">
	<thead>
		<tr>
			<td colspan="3" class="download_software"><?php echo $rowResult["software_name"]?></td>
		</tr>
		<tr height="35">
			<th class="download_software_header">檔案名稱</th>
			<th width="84px" class="download_software_header">下載次數</th>
			<th width="84px" class="download_software_header">檔案下載</th>
		</tr>
	</thead>
	<tbody>	
		<?php
		$result_path = getPath($rowResult["software_id"]);
		while($rowResult_path = $result_path -> fetch()){
			$id = $rowResult_path["path_id"];
		?>
		<tr>
			<td><?php echo $rowResult_path["download_name"]?></td>
			<td width="84px" class="center aligned"><?php echo $rowResult_path["download_count"];?></td>
			<td width="84px"><span id="path<?php echo $id;?>" class="s_button download_button" onclick="download(<?php echo $id;?>)">下載</span></td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>
<?php
}
?>
