<?php
/**
 * [ADMIN] カレンダーコンテンツ 一覧　テーブル
 * 
 * @copyright		Copyright 2012, untrois
 * @link		http://www.untrois.jp/
 * @author		あつ
 * @package		baser.plugins.calendar.views.elements
 * @version		$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license		MIT
 */
?>


<table cellpadding="0" cellspacing="0" class="list-table" id="ListTable">
	<thead>
		<tr>
			<th class="list-tool">
				<div>
					<?php $bcBaser->link($bcBaser->getImg('admin/btn_add.png', array('width' => 69, 'height' => 18, 'alt' => '新規追加', 'class' => 'btn')), array('action' => 'add')) ?>
				</div>	
			</th>
			<th>NO</th>
			<th>カレンダーアカウント</th>
			<th>カレンダータイトル</th>
			<th>登録日<br />更新日</th>
		</tr>
	</thead>
	<tbody>
<?php if(!empty($datas)): ?>
	<?php $count=1; ?>
	<?php foreach($datas as $data): ?>
		<?php $bcBaser->element('calendar_contents/index_row', array('data' => $data, 'count' => $count)) ?>
		<?php $count++; ?>
	<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="6"><p class="no-data">データが見つかりませんでした。</p></td>
		</tr>
<?php endif; ?>
	</tbody>
</table>
