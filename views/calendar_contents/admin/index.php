<?php
/**
 * [ADMIN] カレンダーコンテンツ 一覧
 * 
 * @copyright		Copyright 2012, untrois
 * @link		http://www.untrois.jp/
 * @author		あつ
 * @package		baser.plugins.calendar.views
 * @version		$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license		MIT
 */
$bcBaser->js(array(
	'admin/jquery.baser_ajax_data_list', 
	'admin/jquery.baser_ajax_batch',
	'admin/baser_ajax_data_list_config',
	'admin/baser_ajax_batch_config'
));
?>

<script type="text/javascript">
	$(function(){
		$.baserAjaxDataList.config.methods.del.confirm = '削除を行うと関連するスケジュールは全て削除されてしまい元に戻す事はできません。\n本当に削除してもいいですか？';
		$.baserAjaxDataList.init();
		$.baserAjaxBatch.init({ url: $("#AjaxBatchUrl").html()});
	});
</script>

<div id="AlertMessage" class="message" style="display:none"></div>
<div id="AjaxBatchUrl" style="display:none"><?php $bcBaser->url(array('controller' => 'calendar_contents', 'action' => 'ajax_batch')) ?></div>
<div id="DataList"><?php $bcBaser->element('../calendar_contents/admin/ajax_index', null, false, false) ?></div>