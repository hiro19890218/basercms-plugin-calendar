<?php
/**
 * カレンダーコンテンツコントローラー
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
 * @package baser.plugins.calemdar.controllers
 */
class CalendarContentsController extends CalendarAppController {
/**
 * クラス名
 *
 * @var string
 * @access public
 */
	var $name = 'CalendarContents';
/**
 * モデル
 *
 * @var array
 * @access public
 */
	var $uses = array('Calendar.CalendarContent');
/**
 * ヘルパー
 *
 * @var array
 * @access public
 */
	var $helpers = array(BC_FORM_HELPER);
/**
 * コンポーネント
 *
 * @var array
 * @access public
 */
	var $components = array('BcAuth','Cookie','BcAuthConfigure','RequestHandler');
/**
 * ぱんくずナビ
 *
 * @var string
 * @access public
 */
	var $crumbs = array(
                array('name' => 'プラグイン管理', 'url' => array('plugin' => '', 'controller' => 'plugins', 'action' => 'index')),
                array('name' => 'カレンダー管理', 'url' => array('plugin' => 'calendar', 'controller' => 'calendar_contents', 'action' => 'index'))
	);
/**
 * サブメニューエレメント
 *
 * @var array
 * @access public
 */
	var $subMenuElements = array();
/**
 * [ADMIN] カレンダーコンテンツ一覧
 *
 * @return void
 * @access public
 */
	function admin_index() {

		$datas = $this->CalendarContent->find('all',array('order'=>array('CalendarContent.id')));
		$this->set('datas', $datas);
		
		if($this->RequestHandler->isAjax() || !empty($this->params['url']['ajax'])) {
			$this->render('ajax_index');
			return;
		}
		
		$this->pageTitle = 'カレンダー一覧';

	}
/**
 * [ADMIN] カレンダーコンテンツ追加
 *
 * @return void
 * @access public
 */
	function admin_add() {

		$this->pageTitle = '新規カレンダー登録';

		if(!$this->data) {
			$this->data = $this->CalendarContent->getDefaultValue();
		}else {

			/* 登録処理 */
			$this->CalendarContent->create($this->data);

			// データを保存
			if($this->CalendarContent->save()) {
				$id = $this->CalendarContent->getLastInsertId();
				$message = '新規カレンダー「'.$this->data['CalendarContent']['title'].'」を追加しました。';
				$this->Session->setFlash($message);
				$this->CalendarContent->saveDbLog($message);
				$this->redirect(array('action' => 'edit', $id));
			}else {
				$this->Session->setFlash('入力エラーです。内容を修正してください。');
			}

		}

		$this->render('form');

	}
/**
 * [ADMIN] 編集処理
 *
 * @param int $id
 * @return void
 * @access public
 */
	function admin_edit($id) {

		/* 除外処理 */
		if(!$id && empty($this->data)) {
			$this->Session->setFlash('無効なIDです。');
			$this->redirect(array('action' => 'index'));
		}

		if(empty($this->data)) {
			$this->data = $this->CalendarContent->read(null, $id);
		}else {

			/* 更新処理 */
			if($this->CalendarContent->save($this->data)) {
				$message = 'カレンダー「'.$this->data['CalendarContent']['title'].'」を更新しました。';
				$this->Session->setFlash($message);
				$this->CalendarContent->saveDbLog($message);

				$this->redirect(array('action' => 'edit', $id));
			}else {
				$this->Session->setFlash('入力エラーです。内容を修正してください。');
			}

		}

		$this->set('publishLink', '/'.$this->data['CalendarContent']['name'].'/index');
		
		/* 表示設定 */
		$this->set('calendarContent',$this->data);
		$this->subMenuElements = array('calendar_schedules','calendar_common');
		$this->pageTitle = 'カレンダー設定編集：'.$this->data['CalendarContent']['title'];
		$this->render('form');

	}
/**
 * [ADMIN] 削除処理
 *
 * @param int $id
 * @return void
 * @access public
 * @deprecated
 */
	function admin_delete($id = null) {

		/* 除外処理 */
		if(!$id) {
			$this->Session->setFlash('無効なIDです。');
			$this->redirect(array('action' => 'index'));
		}

		// メッセージ用にデータを取得
		$calendar = $this->CalendarContent->read(null, $id);

		/* 削除処理 */
		if($this->CalendarContent->del($id)) {
			$message = 'カレンダー「'.$calendar['CalendarContent']['title'].'」 を削除しました。';
			$this->Session->setFlash($message);
			$this->CalendarContent->saveDbLog($message);
		}else {
			$this->Session->setFlash('データベース処理中にエラーが発生しました。');
		}

		$this->redirect(array('action' => 'index'));

	}
/**
 * [ADMIN] Ajax 削除処理
 *
 * @param int $id
 * @return void
 * @access public
 */
	function admin_ajax_delete($id = null) {

		/* 除外処理 */
		if(!$id) {
			$this->ajaxError(500, '無効な処理です。');
		}

		// メッセージ用にデータを取得
		$calendar = $this->CalendarContent->read(null, $id);

		/* 削除処理 */
		if($this->CalendarContent->del($id)) {
			$this->CalendarContent->saveDbLog('カレンダー「'.$calendar['CalendarContent']['title'].'」 を削除しました。');
			echo true;
		}

		exit();

	}
/**
 * [ADMIN] データコピー（AJAX）
 * 
 * @param int $id 
 * @return void
 * @access public
 */
	function admin_ajax_copy($id) {
		
		if(!$id) {
			$this->ajaxError(500, '無効な処理です。');
		}
		$result = $this->CalendarContent->copy($id);
		if($result) {
			$this->set('data', $result);
		} else {
			$this->ajaxError(500, $this->CalendarContent->validationErrors);
		}
		
	}
	
}
