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
	<input type="hidden" name="patient_id" value="<?php echo $this->patient ? $this->patient->id : ''?>" />
	<div id="event_content" class="whiteBox">
		<h4 class="elementTypeName">Add Patient</h4>
		<?php echo $this->renderPartial('//elements/form_errors',array('errors'=>$errors))?>
		<?php echo $form->textField($patient,'hos_num',array('autocomplete'=>'off'))?>
		<?php echo $form->textField($patient,'nhs_num',array('autocomplete'=>'off'))?>
		<?php echo $form->radioButtons($patient,'gender',array('M'=>'Male','F'=>'Female'))?>
		<?php echo $form->dropDownList($patient,'ethnic_group_id',CHtml::listData(EthnicGroup::model()->findAll(array('order'=>'name')),'id','name'))?>
		<?php echo $form->checkBox($patient,'translator_needed')?>
		<?php echo $form->datePicker($patient,'dob',array(),array('size'=>11,'null'=>true))?>
		<?php echo $form->textField($contact,'title',array('autocomplete'=>'off'))?>
		<?php echo $form->textField($contact,'first_name',array('autocomplete'=>'off'))?>
		<?php echo $form->textField($contact,'last_name',array('autocomplete'=>'off'))?>
		<?php echo $form->textField($address,'address1',array('autocomplete'=>'off'))?>
		<?php echo $form->textField($address,'address2',array('autocomplete'=>'off'))?>
		<?php echo $form->textField($address,'city',array('autocomplete'=>'off'))?>
		<?php echo $form->textField($address,'county',array('autocomplete'=>'off'))?>
		<?php echo $form->textField($address,'postcode',array('autocomplete'=>'off'))?>
		<?php echo $form->dropDownList($address,'country_id',CHtml::listData(Country::model()->notDeleted()->findAll(array('order'=>'name')),'id','name'))?>
		<?php echo $form->textField($contact,'primary_phone',array('autocomplete'=>'off'))?>
		<?php echo $form->textField($contact,'secondary_phone',array('autocomplete'=>'off'))?>
		<?php echo $form->textField($address,'email',array('autocomplete'=>'off'))?>
		<?php echo $this->renderPartial('//elements/form_errors',array('errors'=>$errors))?>
		<div class="btngroup padtop">
			<?php echo EventAction::button('Save', 'save', array('id' => 'p_save', 'colour' => 'green'))->toHtml()?>
			<?php echo EventAction::button('Cancel', 'cancel', array('id' => 'p_cancel', 'colour' => 'red'))->toHtml()?>
		</div>
	</div>
	<?php $this->endWidget()?>
</div>
