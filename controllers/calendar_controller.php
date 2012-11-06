<?php
/**
 * カレンダー記事コントローラー
 * 
 * @copyright		Copyright 2012, untrois
 * @link		http://www.untrois.jp/
 * @author		あつ
 * @package		baser.plugins.calendar.controllers
 * @version		$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license		MIT
 */
/**
 * Include files
 */
/**
 * カレンダーコントローラー
 *
 * @package			baser.plugins.calendar.controllers
 */
class CalendarController extends CalendarAppController {
/**
 * クラス名
 *
 * @var string
 * @access public
 */
	var $name = 'Calendar';
/**
 * モデル
 *
 * @var array
 * @access public
 */
	var $uses = array('Calendar.CalendarSchedule', 'Calendar.CalendarContent');
/**
 * ヘルパー
 *
 * @var array
 * @access public
 */
	var $helpers = array();
/**
 * コンポーネント
 * 
 * @var array
 * @access public
 */
	var $components = array();
/**
 * ぱんくずナビ
 *
 * @var array
 * @access public
 */
	var $crumbs = array();
/**
 * サブメニューエレメント
 *
 * @var array
 * @access public
 */
	var $subMenuElements = array();
/**
 * カレンダーデータ
 * 
 * @var array
 * @access public
 */
	var $calendarContent = array();
/**
 * beforeFilter
 *
 * @return void
 * @access public
 */
	function beforeFilter() {
		
		parent::beforeFilter();

		$this->CalendarContent->recursive = -1;
		if($this->contentId) {
			$this->calendarContent = $this->CalendarContent->read(null,$this->contentId);
		}else {
			$this->calendarContent = $this->CalendarContent->read(null,$this->params['pass'][0]);
		}

		$this->subMenuElements = array('default');
		$this->crumbs = array(array('name' => $this->calendarContent['CalendarContent']['title'], 'url' => '/'.$this->calendarContent['CalendarContent']['name'].'/index'));
		
	}
/**
 * beforeRender
 *
 * @return void
 * @access public
 */
	function beforeRender() {

		parent::beforeRender();
                
		$this->set('calendarContent',$this->calendarContent);


	}
/**
 * [PUBLIC] カレンダーを一覧表示する
 *
 * @return void
 * @access public
 */
	function index($date = null) {

		$this->layout = 'default';
		$template = 'default'.DS.'index';

		if (empty($date)) {
			$date = date('Y-m');
		}
		list($year, $month) = explode('-', $date);
		// 年月チェック
		if (!checkdate($month, '01', $year)) {
                    $this->redirect('/');
		}
		// 月初の曜日取得
		$week= date('w', mktime(0, 0, 0, $month, 1, $year));
		// 月末の日付取得
		$lastday = date('d', mktime(0, 0, 0, $month + 1, 0, $year));
		$this->set(compact('lastday', 'month', 'week', 'year'));
                
		$datas = $this->_getCalendarSchedules(array('calendar_content_id' => $this->calendarContent['CalendarContent']['id'], 'year' => $year, 'month' => $month));
		$this->set('editLink', array('admin' => true, 'controller' => 'calendar_contents', 'action' => 'edit', $this->calendarContent['CalendarContent']['id']));
		$this->set('schedules', $datas);
		$this->pageTitle = $this->calendarContent['CalendarContent']['title'];
		$this->crumbs = array();
		$this->render($template);

	}
/**
 * [MOBILE] カレンダー記事を一覧表示する
 *
 * @return void
 * @access public
 */
	function mobile_index() {

		$this->setAction('index');

	}
/**
 * [SMARTPHONE] カレンダー記事を一覧表示する
 *
 * @return void
 * @access public
 */
	function smartphone_index() {

		$this->setAction('index');

	}

/**
 * カレンダー記事を取得する
 * 
 * @param array $options
 * @return array
 * @access protected
 */
	function _getCalendarSchedules($conditions = array()) {
		
		$tmp_schedules = $this->CalendarSchedule->find('all', array('fields' => array('CalendarSchedule.year', 'CalendarSchedule.month', 'CalendarSchedule.day', 'CalendarSchedule.description'), 'conditions' => $conditions, 'recursive' => -1));
		$schedules = array();
		foreach ($tmp_schedules as $v) {
			$key = date('Y-m-d', strtotime($v['CalendarSchedule']['year'] . '-' . $v['CalendarSchedule']['month'] . '-' . $v['CalendarSchedule']['day']));
                	$schedules[$key] = $v['CalendarSchedule']['description'];
		}
		return $schedules;

	}
}
?>