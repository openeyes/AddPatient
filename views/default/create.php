<?php /**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2012
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2012, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
 ?>
<div class="centralColumn">
<?php
	$form = $this->beginWidget('BaseEventTypeCActiveForm', array(
		'id'=>'patient-create',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array('class'=>'sliding'),
	))?>
	<div id="event_content" class="whiteBox">
		<h4 class="elementTypeName">Add Patient</h4>
		<?php echo $this->renderPartial('//elements/form_errors',array('errors'=>$errors))?>
		<?php echo $form->textField($patient,'hos_num')?>
		<?php echo $form->textField($patient,'nhs_num')?>
		<?php echo $form->radioButtons($patient,'gender','gender')?>
		<?php echo $form->dropDownList($patient,'ethnic_group_id',CHtml::listData(EthnicGroup::model()->findAll(array('order'=>'name')),'id','name'))?>
		<?php echo $form->dateOfBirth($patient,'dob')?>
		<?php echo $form->textField($patient,'title')?>
		<?php echo $form->textField($patient,'first_name')?>
		<?php echo $form->textField($patient,'last_name')?>
		<?php echo $form->textField($patient,'address1')?>
		<?php echo $form->textField($patient,'address2')?>
		<?php echo $form->textField($patient,'city')?>
		<?php echo $form->textField($patient,'county')?>
		<?php echo $form->textField($patient,'postcode')?>
		<?php echo $form->dropDownList($patient,'country_id',CHtml::listData(Country::model()->findAll(array('order'=>'name')),'id','name'))?>
		<?php echo $form->textField($patient,'primary_phone')?>
		<?php echo $form->textField($patient,'email')?>
		<?php echo $this->renderPartial('//elements/form_errors',array('errors'=>$errors))?>
		<div class="btngroup padtop">
			<?php echo EventAction::button('Save', 'save', array('id' => 'p_save', 'colour' => 'green'))->toHtml()?>
			<?php echo EventAction::button('Cancel', 'cancel', array('id' => 'p_cancel', 'colour' => 'red'))->toHtml()?>
		</div>
	</div>
	<?php $this->endWidget()?>
</div>
