<?php
/**
 * スケジュールモデル
 * 
 * @copyright		Copyright 2012, untrois
 * @link		http://www.untrois.jp/
 * @author		あつ
 * @package		baser.plugins.calendar.models
 * @version		$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license		MIT
 */
/**
 * Include files
 */
/**
 * カレンダーモデル
 *
 * @package baser.plugins.calendar.models
 */
class CalendarSchedule extends CalendarAppModel {
/**
 * クラス名
 *
 * @var string
 * @access public
 */
	var $name = 'CalendarSchedule';
/**
 * belongsTo
 *
 * @var array
 * @access public
 */
	var $belongsTo = array(
			'CalendarContent' =>    array(  'className'=>'Calendar.CalendarContent',
							'foreignKey'=>'calendar_content_id')
	);
        
}
