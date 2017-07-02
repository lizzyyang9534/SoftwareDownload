<script>
var n = "";
var p = "";
function add(){
	$("#add_path").show("fast");
	$("#add_button").hide("fast");
}
function add_submit(){
	$("#select_software,#downloadName,#downloadPath").removeClass("error");
	var SOFTWARE = $('#add_software').val();
	var NAME = $('#add_downloadName').val();
	var PATH = $('#add_downloadPath').val();
	if(SOFTWARE.length > 0 && NAME.length > 0 && PATH.length > 0){
		$.ajax({
			url: "./api/add.php",
			type: "post",
			data: {
				manage:"path",
				software:SOFTWARE,
				name:NAME,
				path:PATH
			},
			success: function() {
				location.reload();
			}
		});
	}else{
		if(SOFTWARE.length < 1)
			$('#select_software').addClass("error");
		if(NAME.length < 1)
			$('#downloadName').addClass("error");
		if(PATH.length < 1)
			$('#downloadPath').addClass("error");
	}
}
function add_cancel(){
	$("#add_path").hide();
	$("#add_button").show("fast");
	$("#select_software,#downloadName,#downloadPath").removeClass("error");
}
function edit(COUNT,ID){
	n = $('#download_name'+COUNT).text();
	p = $('#download_path'+COUNT).text();
	$('#download_name'+COUNT).html("<div id=\"downloadName"+COUNT+"\" class=\"ui input\"><input id=\"edit_downloadName"+COUNT+"\" type=\"text\" class=\"width-200 input_height\" value=\"" + $('#download_name'+COUNT).text() + "\"></input></div>");
	$('#download_path'+COUNT).html("<div id=\"downloadPath"+COUNT+"\" class=\"ui input width-250\"><input id=\"edit_downloadPath"+COUNT+"\" type=\"text\" class=\"input_height\" value=\"" + $('#download_path'+COUNT).text() + "\"></input></div>");
	$('#update'+COUNT).html("<i id=\"submit"+COUNT+"\" class=\"color-F49B7D large checkmark icon\" onclick=\"edit_submit("+COUNT+","+ID+")\"></i><i id=\"cancel"+COUNT+"\" class=\"color-8BC1DC large remove icon\" onclick=\"edit_cancel("+COUNT+","+ID+")\"></i>");
}
function edit_submit(COUNT,ID){
	var NAME = $('#edit_downloadName'+COUNT).val();
	var PATH = $('#edit_downloadPath'+COUNT).val();
	if(NAME.length > 0 && PATH.length > 0){
		$.ajax({
			url: "./api/edit.php",
			type: "post",
			data: {
				manage:"path",
				id:ID,
				name:NAME,
				path:PATH
			},
			success: function() {
				$('#download_name'+COUNT).html(""+NAME);
				$('#download_path'+COUNT).html(""+PATH);
				$('#update'+COUNT).html("<img id=\"edit"+COUNT+"\" class=\"s_manage_edit\" src=\"images/edit.png\" height=\"22\" width=\"22\" title=\"編輯\" onclick=\"edit("+COUNT+","+ID+");\">"+
					"<img id=\"delete"+COUNT+"\" class=\"s_manage_delete\" src=\"images/delete.png\" height=\"22\" width=\"22\" title=\"刪除\">"
				);
			}
		});
	}else{
		if(NAME.length < 1)
			$('#downloadName'+COUNT).addClass("error");
		if(PATH.length < 1)
			$('#downloadPath'+COUNT).addClass("error");
	}
}
function edit_cancel(COUNT,ID){
	$('#download_name'+COUNT).html(""+n);
	$('#download_path'+COUNT).html(""+p);
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
				manage:"path",
				id:ID
			},
			success: function() {
				location.reload();
			}
		});	
	}
}
</script>
<div class="s_header">載點管理</div>
<div id="add_button" class="ui icon button pop" style="float:left;margin-bottom:10px;" onclick="add()">
  <i class="add icon"></i>
</div>
<table id="table_header" class="ui compact striped table" style="word-break:break-all">
	
	<thead>
		<tr>
			<th width="60px" class="center aligned table_header">編號</th>
			<th width="310px" class="table_header">軟體名稱</th>
			<th width="200px" class="table_header">載點名稱</th>
			<th class="table_header">載點路徑</th>
			<th width="100px" class="table_header"></th>
		</tr>
	</thead>
	<tbody>
	<tr id="add_path">
		<td class="center aligned">*</td>
		<td>
			<div id="select_software" class="ui inline dropdown">
				<input id="add_software" type="hidden" name="software">
				<div class="text">請選擇軟體</div>
				<i class="dropdown icon"></i>
				<div class="menu">
					<?php require_once('include/DB.php');
					$result = getSoftwareCategory();
					while($rowResult = $result -> fetch()){?>
					<div class="item">
						<i class="dropdown icon"></i>
						<span class="text"><?php echo $rowResult["category_name"]?></span>
						<div class="menu">
							<?php $result_software = getSoftware($rowResult["category_id"]);
							while($rowResult_software = $result_software -> fetch()){?>
							<div class="item" data-value="<?php echo $rowResult_software["software_id"];?>"><?php echo $rowResult_software["software_name"]?></div>
							<?php }?>
						</div>
					</div>
					<?php }?>
				</div>
			</div>
		</td>
		<td><div id="downloadName" class="ui input"><input id="add_downloadName" type="text" class="width-200 input_height"></input></div></td>
		<td><div id="downloadPath" class="ui input width-250"><input id="add_downloadPath" type="text" class="input_height"></input></div></td>
		<td width="100">
			<div class="s_manage_update">
				<i class="color-F49B7D large checkmark icon" onclick="add_submit();"></i>
				<i class="color-8BC1DC large remove icon" onclick="add_cancel();"></i>
			</div>
		</td>
	</tr>
	<?php
	
	require_once('include/DB.php');
	$result = getAllPath();
	$count = 1;
	while($rowResult = $result -> fetch()){
	$id = $rowResult["path_id"];
	?>
		<tr id="manage<?php echo $count;?>">
			<td  id="number<?php echo $count;?>" class="center aligned"><?php echo $count;?></td>
			<td  id="software_name<?php echo $count;?>"><?php echo $rowResult["software_name"] ?></td>
			<td  id="download_name<?php echo $count;?>"><?php echo $rowResult["download_name"] ?></td>
			<td  id="download_path<?php echo $count;?>"><?php echo $rowResult["download_path"] ?></td>
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