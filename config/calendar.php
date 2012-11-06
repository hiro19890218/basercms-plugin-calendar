<?php
/**
 * カレンダー設定
 * 
 * @copyright		Copyright 2012, untrois
 * @link		http://www.untrois.jp/
 * @author		あつ
 * @package		baser.plugins.calendar.config
 * @version		$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license		MIT
 */
/**
 * システムナビ
 */
	$config['BcApp.adminNavi.calendar'] = array(
		'name' => 'カレンダープラグイン',
		'contents' => array(
			array('name' => 'カレンダー一覧', 'url' => array('admin' => true, 'plugin' => 'calendar', 'controller' => 'calendar_contents', 'action' => 'index')),
			array('name' => 'カレンダー登録', 'url' => array('admin' => true, 'plugin' => 'calendar', 'controller' => 'calendar_contents', 'action' => 'add')),
		)
	);
	$CalendarContent = ClassRegistry::init('Calendar.CalendarContent');
	$calendarContents = $CalendarContent->find('all', array('recursive' => -1));
	foreach($calendarContents as $calendarContent) {
		$calendarContent = $calendarContent['CalendarContent'];
		$config['BcApp.adminNavi.calendar']['contents'] = array_merge($config['BcApp.adminNavi.calendar']['contents'], array(
			array('name' => '['.$calendarContent['title'].'] 公開ページ',		'url' => '/'.$calendarContent['name'].'/index'),
			array('name' => '['.$calendarContent['title'].'] 記事一覧',		'url' => array('admin' => true, 'plugin' => 'calendar', 'controller' => 'calendar_schedules', 'action' => 'index', $calendarContent['id'])),
			array('name' => '['.$calendarContent['title'].'] 設定',			'url' => array('admin' => true, 'plugin' => 'calendar', 'controller' => 'calendar_contents', 'action' => 'edit', $calendarContent['id'])),
		));
	}
