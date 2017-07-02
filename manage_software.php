<script>
var n = "";
var d = "";
function add(){
	$("#add_software").show("fast");
	$("#add_button").hide("fast");
}
function add_submit(){
	$("#softwareName,#select_category").removeClass("error");
	var NAME = $('#add_softwareName').val();
	var CATEGORY = $('#add_category').val();
	var DESCRIPTION = $('#add_description').val();
	if(NAME.length > 0 && CATEGORY.length > 0){
		$.ajax({
			url: "./api/add.php",
			type: "post",
			data: {
				manage:"software",
				name:NAME,
				category:CATEGORY,
				description:DESCRIPTION
			},
			success: function() {
				location.reload();
			}
		});
	}else{
		if(NAME.length < 1)
			$('#softwareName').addClass("error");
		if(CATEGORY.length < 1)
			$('#select_category').addClass("error");
	}
}
function add_cancel(){
	$("#add_software").hide();
	$("#add_button").show("fast");
	$("#softwareName,#select_category").removeClass("error");
	$('#add_category').val("");
}
function edit(COUNT,ID){
	n = $('#software_name'+COUNT).text();
	d = $('#description'+COUNT).text();
	$('#software_name'+COUNT).html("<div id=\"softwareName"+COUNT+"\" class=\"ui input width-200\"><input id=\"edit_softwareName"+COUNT+"\" type=\"text\" class=\"width-200 input_height\" value=\"" + n + "\"></input></div>");
	$('#description'+COUNT).html("<div class=\"ui input width-200\"><input id=\"edit_description"+COUNT+"\" type=\"text\" class=\"width-200 input_height\" value=\"" + d + "\"></input></div>");
	$('#update'+COUNT).html("<i id=\"submit"+COUNT+"\" class=\"color-F49B7D large checkmark icon\" onclick=\"edit_submit("+COUNT+","+ID+")\"></i><i id=\"cancel"+COUNT+"\" class=\"color-8BC1DC large remove icon\" onclick=\"edit_cancel("+COUNT+","+ID+")\"></i>");
}
function edit_submit(COUNT,ID){
	var NAME = $('#edit_softwareName'+COUNT).val();
	var DESCRIPTION = $('#edit_description'+COUNT).val();
	if(NAME.length > 0){
		$.ajax({
			url: "./api/edit.php",
			type: "post",
			data: {
				manage:"software",
				id:ID,
				name:NAME,
				description:DESCRIPTION
			},
			success: function() {
				$('#software_name'+COUNT).html(""+NAME);
				$('#description'+COUNT).html(""+DESCRIPTION);
				$('#update'+COUNT).html("<img id=\"edit"+COUNT+"\" class=\"s_manage_edit\" src=\"images/edit.png\" height=\"22\" width=\"22\" title=\"編輯\" onclick=\"edit("+COUNT+","+ID+");\">"+
					"<img id=\"delete"+COUNT+"\" class=\"s_manage_delete\" src=\"images/delete.png\" height=\"22\" width=\"22\" title=\"刪除\">"
				);
			}
		});
	}else{
		$('#softwareName'+COUNT).addClass("error");
	}
}
function edit_cancel(COUNT,ID){
	$('#software_name'+COUNT).html(""+n);
	$('#description'+COUNT).html(""+d);
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
				manage:"software",
				id:ID
			},
			success: function() {
				location.reload();
			}
		});	
	}
}

$(function() {
    $("#add_software").hide();
});
</script>
<div class="s_header">軟體管理</div>
<div id="add_button" class="ui icon button pop" style="float:left;margin-bottom:10px;" onclick="add()">
  <i class="add icon"></i>
</div>

<table id="table_header" class="ui striped table">
	<thead>
		<tr>
			<th width="60px" class="center aligned table_header">編號</th>
			<th class="table_header">軟體名稱</th>
			<th width="180px" class="table_header">類別</th>
			<th colspan="2" class="table_header">說明</th>
		</tr>
	</thead>
	<tbody>
	<tr id="add_software">
		<td class="center aligned">*</td>
		<td><div id="softwareName" class="ui input"><input id="add_softwareName" type="text" class="width-200 input_height"></div></td>
		<td>
			<div id="select_category" class="ui selection dropdown">
				<input id="add_category" type="hidden" name="category">
				<i class="dropdown icon"></i>
				<div class="default text">請選擇分類</div>
				<div class="menu">
					<?php require_once('include/DB.php');
					$result = getSoftwareCategory();
					while($rowResult = $result -> fetch()){ ?>				
					<div class="item" data-value="<?php echo $rowResult["category_id"];?>" data-text="<?php echo $rowResult["category_name"];?>"><?php echo $rowResult["category_name"];?></div>
					<?php }?>
				</div>
			</div>
		</td>
		<td class="s_manage_description"><div class="ui input"><input id="add_description" type="text" class="width-200 input_height"></div></td>
		<td width="100">
			<div class="s_manage_update">
				<i class="color-F49B7D large checkmark icon" onclick="add_submit();"></i>
				<i class="color-8BC1DC large remove icon" onclick="add_cancel();"></i>
			</div>
		</td>
	</tr>
	<?php
	require_once('include/DB.php');
	$result = getAllSoftware();
	$count = 1;
	while($rowResult = $result -> fetch()){
	$id = $rowResult["software_id"];
	?>
		<tr id="manage<?php echo $count;?>">		
			<td id="number<?php echo $count;?>" class="center aligned"><?php echo $count;?></td>
			<td id="software_name<?php echo $count;?>"><?php echo $rowResult["software_name"] ?></td>
			<td id="category_name<?php echo $count;?>"><?php echo $rowResult["category_name"] ?></td>
			<td id="description<?php echo $count;?>"><?php echo $rowResult["description"] ?></td>
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