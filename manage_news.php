<script>
var n = "";
function add(){
	$("#manage1").before("<tr id=\"add_news\">"+
		"<td class=\"center aligned\">*</td>"+
		"<td><div id=\"newsContent\" class=\"ui input\"><input id=\"add_newsContent\" type=\"text\" class=\"width-200 input_height\"></input></div></td>"+
		"<td width=\"100\"><div class=\"s_manage_update\">"+
			"<i class=\"color-F49B7D large checkmark icon\" onclick=\"add_submit();\"></i>"+
			"<i class=\"color-8BC1DC large remove icon\" onclick=\"add_cancel();\"></i></div></td></tr>");
	$("#add_button").hide("fast");
}
function add_submit(){
	var NEWS = $('#add_newsContent').val();
	if(NEWS.length > 0){	
		$.ajax({
			url: "./api/add.php",
			type: "post",
			data: {
				manage:"news",
				news:NEWS
			},
			success: function() {
				location.reload();
			}
		});
	}else{
		$('#newsContent').addClass("error");
	}	
}
function add_cancel(){
	$("#add_news").remove();
	$("#add_button").show("fast");
}
function edit(COUNT,ID){
	n = $('#news'+COUNT).text();
	$('#news'+COUNT).html("<div id=\"newsContent"+COUNT+"\" class=\"ui input\"><input id=\"edit_newsContent"+COUNT+"\" type=\"text\" class=\"width-200 input_height\" value=\"" + $('#news'+COUNT).text() + "\"></input></div>");
	$('#update'+COUNT).html("<i id=\"submit"+COUNT+"\" class=\"color-F49B7D large checkmark icon\" onclick=\"edit_submit("+COUNT+","+ID+")\"></i><i id=\"cancel"+COUNT+"\" class=\"color-8BC1DC large remove icon\" onclick=\"edit_cancel("+COUNT+","+ID+")\"></i>");
}
function edit_submit(COUNT,ID){
	var NEWS = $('#edit_newsContent'+COUNT).val();
	if(NEWS.length > 0){	
		$.ajax({
			url: "./api/edit.php",
			type: "post",
			data: {
				manage:"news",
				id:ID,
				news:NEWS
			},
			success: function() {
				$('#news'+COUNT).text(NEWS);
				$('#update'+COUNT).html("<img id=\"edit"+COUNT+"\" class=\"s_manage_edit\" src=\"images/edit.png\" height=\"22\" width=\"22\" title=\"編輯\" onclick=\"edit("+COUNT+","+ID+");\">"+
					"<img id=\"delete"+COUNT+"\" class=\"s_manage_delete\" src=\"images/delete.png\" height=\"22\" width=\"22\" title=\"刪除\">"
				);
			}
		});
	}else{
		$("#newsContent"+COUNT).addClass("error");
	}
}
function edit_cancel(COUNT,ID){
	$('#news'+COUNT).text(n);
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
				manage:"news",
				id:ID
			},
			success: function() {
				location.reload();
			}
		});	
	}
}
</script>
<div class="s_header">公告管理</div>
<div id="add_button" class="ui icon button pop" style="float:left;margin-bottom:10px;" onclick="add()">
  <i class="add icon"></i>
</div>
<table id="table_header" class="ui striped table">
	<thead>
		<tr>
			<th width="60px" class="center aligned table_header">編號</th>
			<th colspan="2" class="table_header">公告內容</th>
		</tr>
	</thead>
	<tbody>
	<?php
	require_once('include/DB.php');
	$result = getNews();
	$count = 1;
	while($rowResult = $result -> fetch()){
	$id = $rowResult["news_id"];
	?>
		<tr id="manage<?php echo $count;?>">
			<td id="number<?php echo $count;?>" class="center aligned"><?php echo $count;?></td>
			<td id="news<?php echo $count;?>"><?php echo $rowResult["news_content"] ?></td>
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