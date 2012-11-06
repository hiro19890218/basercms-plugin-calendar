<?php
/**
 * [ADMIN] カレンダー記事 フォーム
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
	$("#CalendarScheduleDescription").focus();
});
</script>

<?php echo $bcForm->create('CalendarSchedule', array('url' => array('controller' => 'calendar_schedules', 'action' => 'edit', $calendarContent['CalendarContent']['id'], $bcForm->value('CalendarSchedule.year').'-'.$bcForm->value('CalendarSchedule.month').'-'.$bcForm->value('CalendarSchedule.day'), 'id' => false), 'id' => 'CalendarScheduleForm')) ?>

<!-- form -->
<div class="section">
	<table cellpadding="0" cellspacing="0" id="FormTable" class="form-table">
		<tr>
			<th class="col-head" style="width:53px"><?php echo $bcForm->label('CalendarSchedule.date', '日付') ?></th>
			<td class="col-input">
				<?php echo $bcForm->value('CalendarSchedule.year').'-'.$bcForm->value('CalendarSchedule.month').'-'.$bcForm->value('CalendarSchedule.day'); ?>
			</td>
		</tr>
		<tr>
			<th class="col-head"><?php echo $bcForm->label('CalendarSchedule.description', 'スケジュール') ?></th>
			<td class="col-input">
				<?php echo $bcForm->input('CalendarSchedule.description', array('type' => 'textarea', 'cols' => 60,'rows' => 5, 'maxlength' => 255, 'counter' => true)) ?>
				<?php echo $bcForm->error('CalendarSchedule.description') ?>
			</td>
		</tr>
	</table>
</div>
<!-- button -->
<div class="submit">
	<?php echo $bcForm->submit('更新', array('div' => false, 'class' => 'btn-orange button')) ?>
</div>

<?php echo $bcForm->end() ?>