<?php
/**
 * カレンダーコンテンツモデル
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
class CalendarContent extends CalendarAppModel {
/**
 * クラス名
 *
 * @var string
 * @access public
 */
	var $name = 'CalendarContent';
/**
 * behaviors
 *
 * @var array
 * @access public
 */
	var $actsAs = array('BcContentsManager', 'BcPluginContent', 'BcCache');
/**
 * validate
 *
 * @var array
 * @access public
 */
	var $validate = array(
		'name' => array(
				array(	'rule'		=> array('halfText'),
						'message'	=> 'カレンダーアカウント名は半角のみ入力してください。',
						'allowEmpty'=> false),
				array(	'rule'		=> array('notInList', array('calendar')),
						'message'	=> 'カレンダーアカウント名に「calendar」は利用できません。'),
				array(	'rule'		=> array('isUnique'),
						'message'	=> '入力されたカレンダーアカウント名は既に使用されています。'),
				array(	'rule'		=> array('maxLength', 50),
						'message'	=> 'カレンダーアカウント名は50文字以内で入力してください。')
		),
		'title' => array(
			array(	'rule'		=> array('notEmpty'),
					'message'	=> 'カレンダータイトルを入力してください。'),
			array(	'rule'		=> array('maxLength', 255),
					'message'	=> 'カレンダータイトルは255文字以内で入力してください。')
		),
	);
/**
 * ユーザーグループデータをコピーする
 * 
 * @param int $id
 * @param array $data
 * @return mixed CalendarContent Or false
 */
	function copy($id, $data = null) {
		
		if($id) {
			$data = $this->find('first', array('conditions' => array('CalendarContent.id' => $id), 'recursive' => -1));
		}
		$data['CalendarContent']['name'] .= '_copy';
		$data['CalendarContent']['title'] .= '_copy';
		unset($data['CalendarContent']['id']);
		$this->create($data);
		$result = $this->save();
		if($result) {
			$result['CalendarContent']['id'] = $this->getInsertID();
			return $result;
		} else {
			if(isset($this->validationErrors['name'])) {
				return $this->copy(null, $data);
			} else {
				return false;
			}
		}
		
	}
}
