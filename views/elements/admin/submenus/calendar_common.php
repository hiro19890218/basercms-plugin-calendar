<?php
/**
 * [ADMIN] カレンダー共通メニュー
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
	<th>カレンダープラグイン共通メニュー</th>
	<td>
		<ul class="cleafix">
			<li><?php $bcBaser->link('カレンダー一覧',array('controller'=>'calendar_contents','action'=>'index')) ?></li>
			<li><?php $bcBaser->link('新規カレンダーを登録',array('controller'=>'calendar_contents','action'=>'add')) ?></li>
		</ul>
	</td>
</tr>
