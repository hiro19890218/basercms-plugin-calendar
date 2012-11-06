<?php
/**
 * [PUBLISH] カレンダートップ
 * 
 * @copyright		Copyright 2012, untrois
 * @link		http://www.untrois.jp/
 * @author		あつ
 * @package		baser.plugins.calendar.views
 * @version		$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license		MIT
 */
$bcBaser->css(array('/calendar/css/style'), array('inline' => true));
?>
<h2><?php echo h($year . '年' . $month . '月'); ?></h2>

<ul class="pager">
	<li><?php echo $bcBaser->link('&laquo; 前月へ', array('action' => 'index', date('Y-m', mktime(0, 0, 0, $month - 1, 1, $year)))); ?></li>
	<li><?php echo $bcBaser->link('今月', array('action' => 'index')); ?></li>
	<li><?php echo $bcBaser->link('翌月へ &raquo;', array('action' => 'index', date('Y-m', mktime(0, 0, 0, $month + 1, 1, $year)))); ?></li>
</ul>


<ol class="calendar">
	<li id="weekday">
		<ol>
			<li>日</li>
			<li>月</li>
			<li>火</li>
			<li>水</li>
			<li>木</li>
			<li>金</li>
			<li>土</li>
		</ol>
	</li>
	<li>
		<ol>
			<?php for ($day = 1 - $week; $day <= $lastday; $day++): ?>
			<li>
				<?php $tmp_date = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year)); ?>
				<?php if ($day > 0 && $day <= $lastday) { echo $day; } ?>
				<?php if (isset($schedules[$tmp_date])): ?><p><?php echo nl2br($schedules[$tmp_date]); ?></p><?php endif; ?>
			</li>
			<?php endfor; ?>
		</ol>
	</li>
</ol>

