<?php
/**
 * カレンダーヘルパー
 * 
 * @copyright		Copyright 2012, untrois
 * @link		http://www.untrois.jp/
 * @author		あつ
 * @package		baser.plugins.calendar.views.helpers
 * @version		$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license		MIT
 */
/**
 * カレンダーヘルパー
 * @package baser.plugins.calendar.views.helpers
 */
class CalendarHelper extends AppHelper {
/**
 * view
 *
 * @var View
 * @access protected
 */
	var $_view = null;
/**
 * ヘルパー
 *
 * @var array
 * @access public
 */
	var $helpers = array('Html', BC_TIME_HELPER, BC_BASER_HELPER);
/**
 * カレンダーカテゴリモデル
 *
 * @var CalendarCategory
 * @access public
 */
	var $CalendarCategory = null;
/**
 * コンストラクタ
 *
 * @return void
 * @access public
 */
	function __construct() {

		$this->_view =& ClassRegistry::getObject('view');
		$this->_setCalendarContent();

	}
/**
 * カレンダーコンテンツデータをセットする
 *
 * @param int $calendarContentId
 * @return void
 * @access protected
 */
	function _setCalendarContent($calendarContentId = null) {

		if(isset($this->calendarContent) && !$calendarContentId) {
			return;
		}
		if($calendarContentId) {
			$CalendarContent = ClassRegistry::getObject('CalendarContent');
			$CalendarContent->expects(array());
			$this->calendarContent = Set::extract('CalendarContent', $CalendarContent->read(null, $calendarContentId));
		} elseif(isset($this->_view->viewVars['calendarContent']['CalendarContent'])) {
			$this->calendarContent = $this->_view->viewVars['calendarContent']['CalendarContent'];
		}

	}
/**
 * カレンダータイトルを出力する
 *
 * @return void
 * @access public
 */
	function title() {

		echo $this->getTitle();

	}
/**
 * タイトルを取得する
 *
 * @return string
 * @access public
 */
	function getTitle() {

		return $this->calendarContent['title'];

	}
/**
 * カレンダーの説明文を取得する
 *
 * @return string
 * @access public
 */
	function getDescription() {

		return $this->calendarContent['description'];

	}
/**
 * カレンダーの説明文を出力する
 *
 * @return void
 * @access public
 */
	function description() {
		echo $this->getDescription();
	}
/**
 * カレンダーの説明文が指定されているかどうかを判定する
 *
 * @return boolean
 * @access public
 */
	function descriptionExists() {

		if(!empty($this->calendarContent['description'])) {
			return true;
		}else {
			return false;
		}

	}

}