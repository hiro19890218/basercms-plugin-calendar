<?php
/**
 * [ADMIN] カレンダースケジュール管理メニュー
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


<tr>
	<th>カレンダー管理メニュー</th>
	<td>
		<ul class="cleafix">
			<li><?php $bcBaser->link('スケジュール一覧', array('controller' => 'calendar_schedules','action'=>'index',$calendarContent['CalendarContent']['id'])) ?></li>
			<li><?php $bcBaser->link('公開ページ確認', '/'.$calendarContent['CalendarContent']['name'].'/index') ?></li>
		</ul>
	</td>
</tr>