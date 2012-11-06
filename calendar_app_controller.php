<?php
/**
 * カレンダーコントローラー基底クラス
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
 * Include files
 */
/**
 * カレンダーコントローラー基底クラス
 *
 * @package			baser.plugins.calendar
 */
class CalendarAppController extends BaserPluginAppController {
/**
 * beforeFilter
 *
 * @return	void
 * @access 	public
 */
	function beforeFilter() {
		
		parent::beforeFilter();
		if(isset($this->params['admin'])) {
			$user = $this->BcAuth->user();
			$userModel = $this->getUserModel();
			if(!$user || !$userModel) {
				return;
			}
		}
	}
	
}