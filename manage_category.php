<script>
var n = "";
function add(){
	$("#manage1").before("<tr id=\"add_category\">"+
		"<td class=\"center aligned\">*</td>"+
		"<td><div id=\"categoryName\" class=\"ui input\"><input id=\"add_categoryName\" type=\"text\" class=\"width-200 input_height\"></input></div></td>"+
		"<td width=\"100\"><div class=\"s_manage_update\">"+
			"<i class=\"color-F49B7D large checkmark icon\" onclick=\"add_submit();\"></i>"+
			"<i class=\"color-8BC1DC large remove icon\" onclick=\"add_cancel();\"></i></div></td></tr>");
	$("#add_button").hide("fast");
}
function add_submit(){
	var NAME = $('#add_categoryName').val();
	if(NAME.length > 0){	
		$.ajax({
			url: "./api/add.php",
			type: "post",
			data: {
				manage:"category",
				name:NAME
			},
			success: function() {
				location.reload();
			}
		});
	}else{
		$('#categoryName').addClass("error");
	}	
}
function add_cancel(){
	$("#add_category").remove();
	$("#add_button").show("fast");
}
function edit(COUNT,ID){
	n = $('#category_name'+COUNT).text();
	$('#category_name'+COUNT).html("<div id=\"categoryName"+COUNT+"\" class=\"ui input\"><input id=\"edit_categoryName"+COUNT+"\" type=\"text\" class=\"width-200 input_height\" value=\"" + $('#category_name'+COUNT).text() + "\"></input></div>");
	$('#update'+COUNT).html("<i id=\"submit"+COUNT+"\" class=\"color-F49B7D large checkmark icon\" onclick=\"edit_submit("+COUNT+","+ID+")\"></i><i id=\"cancel"+COUNT+"\" class=\"color-8BC1DC large remove icon\" onclick=\"edit_cancel("+COUNT+","+ID+")\"></i>");
}
function edit_submit(COUNT,ID){
	var NAME = $('#edit_categoryName'+COUNT).val();
	if(NAME.length > 0){	
		$.ajax({
			url: "./api/edit.php",
			type: "post",
			data: {
				manage:"category",
				id:ID,
				name:NAME
			},
			success: function() {
				$('#category_name'+COUNT).text(NAME);
				$('#update'+COUNT).html("<img id=\"edit"+COUNT+"\" class=\"s_manage_edit\" src=\"images/edit.png\" height=\"22\" width=\"22\" title=\"編輯\" onclick=\"edit("+COUNT+","+ID+");\">"+
					"<img id=\"delete"+COUNT+"\" class=\"s_manage_delete\" src=\"images/delete.png\" height=\"22\" width=\"22\" title=\"刪除\">"
				);
			}
		});
	}else{
		$("#categoryName"+COUNT).addClass("error");
	}
}
function edit_cancel(COUNT,ID){
	$('#category_name'+COUNT).text(n);
	$('#update'+COUNT).html("<img id=\"edit"+COUNT+"\" class=\"s_manage_edit\" src=\"images/edit.png\" height=\"22\" width=\"22\" title=\"編輯\" onclick=\"edit("+COUNT+","+ID+");\">"+
		"<img id=\"delete"+COUNT+"\" class=\"s_manage_delete\" src=\"images/delete.png\" height=\"22\" width=\"22\" title=\"刪除\">"
	);
}
function Delete(ID){
	if(confirm("確定刪除?")){
		$.ajax({
			url: "./api/delete.php",
			type: "post",
			data: {
				manage:"category",
				id:ID
			},
			success: function() {
				location.reload();
			}
		});	
	}
}
</script>
<div class="s_header">分類管理</div>
<div id="add_button" class="ui icon button pop float-left" style="margin-bottom:10px" onclick="add()">
  <i class="add icon"></i>
</div>
<table id="table_header" class="ui striped table">
	<thead>
		<tr>
			<th width="60px" class="center aligned table_header">編號</th>
			<th colspan="2" class="table_header">類別名稱</th>
		</tr>
	</thead>
	<tbody>
	<?php
	require_once('include/DB.php');
	$result = getSoftwareCategory();
	$count = 1;
	while($rowResult = $result -> fetch()){
	$id = $rowResult["category_id"];
	?>
	<tr id="manage<?php echo $count;?>">
		<td id="number<?php echo $count;?>" class="center aligned"><?php echo $count;?></td>
		<td id="category_name<?php echo $count;?>"><?php echo $rowResult["category_name"] ?></td>
		<td width="100">
			<div id="update<?php echo $count;?>" class="s_manage_update">
				<img id="edit<?php echo $count;?>" class="s_manage_edit" src="images/edit.png" height="22" width="22" title="編輯" onclick="edit(<?php echo $count.",".$id;?>);">
				<img id="delete<?php echo $count;?>" class="s_manage_delete" src="images/delete.png" height="22" width="22" title="刪除" onclick="Delete(<?php echo $id;?>);">
			</div>
		</td>
	</tr>
	<?php
	$count += 1;
	}
	?>
	</tbody>
</table>