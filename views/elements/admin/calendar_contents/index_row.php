<?php
/**
 * [ADMIN] カレンダーコンテンツ 一覧　行
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


<tr class="publish">
	<td class="row-tools">
		<?php $bcBaser->link($bcBaser->getImg('admin/icn_tool_check.png', array('width' => 24, 'height' => 24, 'alt' => '確認', 'class' => 'btn')), '/'.$data['CalendarContent']['name'], array('title' => '確認', 'target' => '_blank')) ?>
		<?php $bcBaser->link($bcBaser->getImg('admin/icn_tool_manage.png', array('width' => 24, 'height' => 24, 'alt' => '管理', 'class' => 'btn')), array('controller' => 'calendar_schedules', 'action' => 'index', $data['CalendarContent']['id']), array('title' => '管理')) ?>
		<?php $bcBaser->link($bcBaser->getImg('admin/icn_tool_edit.png', array('width' => 24, 'height' => 24, 'alt' => '編集', 'class' => 'btn')), array('action' => 'edit', $data['CalendarContent']['id']), array('title' => '編集')) ?>
		<?php $bcBaser->link($bcBaser->getImg('admin/icn_tool_copy.png', array('width' => 24, 'height' => 24, 'alt' => 'コピー', 'class' => 'btn')), array('action' => 'ajax_copy', $data['CalendarContent']['id']), array('title' => 'コピー', 'class' => 'btn-copy')) ?>
		<?php $bcBaser->link($bcBaser->getImg('admin/icn_tool_delete.png', array('width' => 24, 'height' => 24, 'alt' => '削除', 'class' => 'btn')), array('action' => 'ajax_delete', $data['CalendarContent']['id']), array('title' => '削除', 'class' => 'btn-delete')) ?>
	</td>
	<td><?php echo $data['CalendarContent']['id']; ?></td>
	<td><?php $bcBaser->link($data['CalendarContent']['name'], array('action' => 'edit', $data['CalendarContent']['id'])) ?></td>
	<td><?php echo $data['CalendarContent']['title'] ?></td>
	<td><?php echo $bcTime->format('Y-m-d',$data['CalendarContent']['created']); ?><br />
		<?php echo $bcTime->format('Y-m-d',$data['CalendarContent']['modified']); ?></td>
</tr>
