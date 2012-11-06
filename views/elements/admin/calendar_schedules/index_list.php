<?php
/**
 * [ADMIN] カレンダー記事 一覧　テーブル
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
<h2><?php echo h($year . '年' . $month . '月'); ?></h2>
<div class="pagination clearfix">
	<div class="page-numbers">
		<?php echo $bcBaser->link('&lt; 前月へ', array('action' => 'index', $calendarContentId, date('Y-m', mktime(0, 0, 0, $month - 1, 1, $year))), array('class' => 'prev')); ?>
		<span><span><?php echo $bcBaser->link('今月', array('action' => 'index', $calendarContentId), array('class' => 'number')); ?></span></span>
		<?php echo $bcBaser->link('翌月へ &gt;', array('action' => 'index', $calendarContentId, date('Y-m', mktime(0, 0, 0, $month + 1, 1, $year))), array('class' => 'next')); ?>
	</div>
</div>
<table cellpadding="0" cellspacing="0" class="list-table" id="ListTable">
	<thead>
		<tr>
			<th>日</th>
			<th>月</th>
			<th>火</th>
			<th>水</th>
			<th>木</th>
			<th>金</th>
			<th>土</th>
		</tr>
	</thead>
	<tbody>
		<?php for ($day = 1 - $week; $day <= $lastday; $day+=7): ?>
		<tr class="publish">
			<?php for ($i = 0; $i < 7; $i++): ?>
			<td>
				<?php $tmp_day = $day + $i; $tmp_date = date('Y-m-d', mktime(0, 0, 0, $month, $tmp_day, $year)); ?>
				<?php if ($tmp_day > 0 && $tmp_day <= $lastday) { echo $bcBaser->link($tmp_day, array('action' => 'edit', $calendarContentId, $tmp_date)); } ?>
				<?php if (isset($schedules[$tmp_date])): ?><p><?php echo nl2br($schedules[$tmp_date]); ?></p><?php endif; ?>
			</td>
			<?php endfor; ?>
		</tr>
		<?php endfor; ?>
	</tbody>
</table>
