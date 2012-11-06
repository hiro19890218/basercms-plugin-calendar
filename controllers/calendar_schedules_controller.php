<?php
/**
 * スケジュールコントローラー
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
 * @package baser.plugins.calendar.controllers
 */
class CalendarSchedulesController extends CalendarAppController {
/**
 * クラス名
 *
 * @var string
 * @access public
 */
	var $name = 'CalendarSchedules';
/**
 * モデル
 *
 * @var array
 * @access public
 */
	var $uses = array('Calendar.CalendarContent', 'Calendar.CalendarSchedule');
/**
 * ヘルパー
 *
 * @var array
 * @access public
 */
	var $helpers = array(BC_TEXT_HELPER, BC_TIME_HELPER, BC_FORM_HELPER);
/**
 * コンポーネント
 *
 * @var array
 * @access public
 */
	var $components = array('BcAuth','Cookie','BcAuthConfigure');
/**
 * ぱんくずナビ
 *
 * @var string
 * @access public
 */
	var $crumbs = array(
		array('name' => 'プラグイン管理', 'url' => array('plugin' => '', 'controller' => 'plugins', 'action' => 'index')),
		array('name' => 'カレンダー管理', 'url' => array('controller' => 'calendar_contents', 'action' => 'index'))
	);
/**
 * サブメニューエレメント
 *
 * @var array
 * @access public
 */
	var $subMenuElements = array();
/**
 * カレンダーコンテンツデータ
 *
 * @var array
 * @access public
 */
	var $calendarContent;
/**
 * beforeFilter
 *
 * @return void
 * @access public
 */
	function beforeFilter() {

		parent::beforeFilter();
		
		if(isset($this->params['pass'][0])) {
			
			$this->CalendarContent->recursive = -1;
			$this->calendarContent = $this->CalendarContent->read(null,$this->params['pass'][0]);
			$this->crumbs[] = array('name' => $this->calendarContent['CalendarContent']['title'].'管理', 'url' => array('controller' => 'calendar_schedules', 'action' => 'index', $this->params['pass'][0]));
			
			if($this->params['prefix'] == 'admin') {
				$this->subMenuElements = array('calendar_schedules','calendar_common');
			}
			
		}
		
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
 * [ADMIN] 一覧表示
 *
 * @return void
 * @access public
 */
	function admin_index($calendarContentId, $date = null) {

		if(!$calendarContentId || !$this->calendarContent) {
			$this->Session->setFlash('無効な処理です。');
			$this->redirect(array('controller' => 'calendar_contents', 'action' => 'index'));
		}

		/* 画面情報設定 */
		if (empty($date)) {
			$date = date('Y-m');
		}
		list($year, $month) = explode('-', $date);
		// 月初の曜日取得
		$week= date('w', mktime(0, 0, 0, $month, 1, $year));
		// 月末の日付取得
		$lastday = date('d', mktime(0, 0, 0, $month + 1, 0, $year));
		$this->set(compact('lastday', 'month', 'week', 'year'));

		/* 検索条件生成 */
		$tmp_schedules = $this->CalendarSchedule->find('all', array('fields' => array('CalendarSchedule.year', 'CalendarSchedule.month', 'CalendarSchedule.day', 'CalendarSchedule.description'), 'conditions' => array('CalendarSchedule.calendar_content_id' => $calendarContentId, 'CalendarSchedule.year' => $year, 'CalendarSchedule.month' => $month), 'recursive' => -1));
		$schedules = array();
		foreach ($tmp_schedules as $v) {
			$key = date('Y-m-d', strtotime($v['CalendarSchedule']['year'] . '-' . $v['CalendarSchedule']['month'] . '-' . $v['CalendarSchedule']['day']));
			$schedules[$key] = $v['CalendarSchedule']['description'];
		}
		$this->set(compact('calendarContentId', 'schedules'));

		if($this->RequestHandler->isAjax() || !empty($this->params['url']['ajax'])) {
			$this->render('ajax_index');
			return;
		}
		
		$this->pageTitle = '['.$this->calendarContent['CalendarContent']['title'].'] スケジュール一覧';

	}
/**
 * [ADMIN] 編集処理
 *
 * @param int $calendarContentId
 * @param int $id
 * @return void
 * @access public
 */
	function admin_edit($calendarContentId, $date) {

		if(!$calendarContentId || !$date) {
			$this->Session->setFlash('無効な処理です。');
			$this->redirect(array('controller' => 'calendar_contents', 'action' => 'index'));
		}

		list($year, $month, $day) = explode('-', $date);
		$schedule = $this->CalendarSchedule->find('first', array('conditions' => array('CalendarSchedule.calendar_content_id' => $calendarContentId, 'CalendarSchedule.year' => $year, 'CalendarSchedule.month' => $month, 'CalendarSchedule.day' => $day), 'recursive' => -1));
		if(empty($this->data)) {
			$this->data['CalendarSchedule']['year'] = $year;
			$this->data['CalendarSchedule']['month'] = $month;
			$this->data['CalendarSchedule']['day'] = $day;
			if (empty($schedule)) {
				$this->data['CalendarSchedule']['description'] = '';
			} else {
				$this->data['CalendarSchedule']['description'] = $schedule['CalendarSchedule']['description'];
			}
		}else {
			if (empty($schedule)) {
				/* 登録処理 */
				$this->CalendarSchedule->create();
			} else {
				/* 更新処理 */
				$this->data['CalendarSchedule']['id'] = $schedule['CalendarSchedule']['id'];
			}
			$this->data['CalendarSchedule']['calendar_content_id'] = $calendarContentId;
			$this->data['CalendarSchedule']['year'] = $year;
			$this->data['CalendarSchedule']['month'] = $month;
			$this->data['CalendarSchedule']['day'] = $day;
			if($this->CalendarSchedule->save($this->data)) {
				$message = $this->data['CalendarSchedule']['year'].'-'.$this->data['CalendarSchedule']['month'].'-'.$this->data['CalendarSchedule']['day'].'のスケジュールを更新しました。';
				$this->Session->setFlash($message);
				$this->CalendarSchedule->saveDbLog($message);

				$this->redirect(array('action' => 'index', $calendarContentId, $year . '-' . $month));
				
			}else {
				$this->Session->setFlash('入力エラーです。内容を修正してください。');
			}
		}

		// 表示設定
		$this->pageTitle = '['.$this->calendarContent['CalendarContent']['title'].'] スケジュール編集： '.$this->data['CalendarSchedule']['year'].'-'.$this->data['CalendarSchedule']['month'].'-'.$this->data['CalendarSchedule']['day'];
		$this->render('form');

	}
}
