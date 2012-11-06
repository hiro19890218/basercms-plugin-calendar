<?php 
/* CalendarSchedules schema */
class CalendarSchedulesSchema extends CakeSchema {
	var $name = 'CalendarSchedules';

	var $file = 'calendar_schedules.php';

	var $connection = 'plugin';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $calendar_schedules = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 8),
		'calendar_content_id' => array('type' => 'integer', 'null' => false, 'length' => 8),
		'year' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'month' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'day' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'description' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
}
