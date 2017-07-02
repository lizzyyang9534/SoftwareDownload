<div class="s_header">公告欄</div>
<div class="ui warning message float-left text-align-left" style="margin-top:0;">
	<h3><i class="large warning icon"></i>下載須知</h3>
	<p>本下載系統受限於授權範圍，目前僅提供校內行政區（不包含宿舍區）下載使用。</p>
	<p>(適用微軟(Microsoft)軟體)軟體成功啟動後，至少每180天內必須再認證一次，每當超過180天之後，軟體將變成30天試用，請務必在30天內進行軟體認證，否則軟體將被鎖定。</p>
	<p>本校提供之認證系統並不保證可以在您的設備上安裝及認證，因為軟硬體有設計差異會造成少部分相容性問題，如有軟硬體安裝相容問題請詢問廠商協助處理。</p>
</div>
<table class="ui striped table">
	<thead>
		<tr>
			<th class="table_header">公告內容</th>
		</tr>
	</thead>
	<tbody>
		<?php require_once('include/DB.php');
		$result = getNews();
		while($rowResult = $result -> fetch()){?>
		<tr>
			<td><?php echo $rowResult["news_content"];?></td>
		</tr>
		<?php }?>
	</tbody>
</table>