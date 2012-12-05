<?php
/**
 * [ADMIN] カレンダーコンテンツ フォーム
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
?>
<script type="text/javascript">
$(window).load(function() {
	$("#CalendarContentName").focus();
});
</script>

<?php if($this->action == 'admin_edit'): ?>
<div class="em-box align-left">
	<strong>このカレンダーのURL：<?php $bcBaser->link($bcBaser->getUri('/'.$calendarContent['CalendarContent']['name'].'/index'),'/'.$calendarContent['CalendarContent']['name'].'/index') ?></strong>
</div>
<?php endif ?>

<!-- form -->
<h2>基本項目</h2>


<?php echo $bcForm->create('CalendarContent') ?>
<div class="section">
	<table cellpadding="0" cellspacing="0" class="form-table">
	<?php if($this->action == 'admin_edit'): ?>
		<tr>
			<th class="col-head"><?php echo $bcForm->label('CalendarContent.id', 'NO') ?></th>
			<td class="col-input">
				<?php echo $bcForm->value('CalendarContent.id') ?>
				<?php echo $bcForm->input('CalendarContent.id', array('type' => 'hidden')) ?>
			</td>
		</tr>
	<?php endif; ?>
		<tr>
			<th class="col-head"><?php echo $bcForm->label('CalendarContent.name', 'カレンダーアカウント名') ?>&nbsp;<span class="required">*</span></th>
			<td class="col-input">
				<?php echo $bcForm->input('CalendarContent.name', array('type' => 'text', 'size'=>40,'maxlength'=>255)) ?>
				<?php echo $html->image('admin/icn_help.png', array('id' => 'helpCategoryFilter', 'class' => 'btn help', 'alt' => 'ヘルプ')) ?>
				<?php echo $bcForm->error('CalendarContent.name') ?>
				<div id="helptextCategoryFilter" class="helptext">
					<ul>
						<li>カレンダーのURLに利用します。<br />
							(例)カレンダーアカウント名が test の場合・・・http://example/test/</li>
						<li>半角英数字で入力してください。</li>
					</ul>
				</div>
			</td>
		</tr>
		<tr>
			<th class="col-head"><?php echo $bcForm->label('CalendarContent.title', 'カレンダータイトル') ?>&nbsp;<span class="required">*</span></th>
			<td class="col-input">
				<?php echo $bcForm->input('CalendarContent.title', array('type' => 'text', 'size' => 40, 'maxlength' => 255, 'counter' => true)) ?>
				<?php echo $bcForm->error('CalendarContent.title') ?>
			</td>
		</tr>
	</table>
</div>
<!-- button -->
<div class="submit">
<?php if($this->action == 'admin_add'): ?>
	<?php echo $bcForm->submit('登録', array('div' => false, 'class' => 'btn-red button')) ?>
<?php else: ?>
	<?php echo $bcForm->submit('更新', array('div' => false, 'class' => 'btn-orange button')) ?>
	<?php $bcBaser->link('削除', 
			array('action' => 'delete', $bcForm->value('CalendarContent.id')),
			array('class' => 'btn-gray button'),
			sprintf('%s を本当に削除してもいいですか？', $bcForm->value('CalendarContent.title')),
			false); ?>
<?php endif ?>
</div>

<?php echo $bcForm->end() ?>