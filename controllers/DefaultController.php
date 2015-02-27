<?php

class DefaultController extends BaseController
{
	public $patient;

	public function accessRules()
	{
		return array(
			// Level 3 or above can do anything
			array('allow',
		//		'expression' => 'BaseController::checkUserLevel(4)',
			),
			// Deny anything else (default rule allows authenticated users)
		);
	}

	public function actionCreate()
	{
		if (@$_POST['patient_id']) {
			$patient = Patient::model()->findByPk($_POST['patient_id']);
			$contact = $patient->contact;
			$address = $patient->contact->address;
		} elseif ($this->patient) {
			$patient = $this->patient;
			$contact = $this->patient->contact;
			$address = $this->patient->contact->address;
		} else {
			$patient = new Patient;
			$contact = new Contact;
			$address = new Address;
		}

		if (Yii::app()->params['default_country']) {
			$address->country_id = Country::model()->find('name=?',array(Yii::app()->params['default_country']))->id;
		} else {
			$address->country_id = 1;
		}

		$form_errors = array();

		if (!empty($_POST['Patient'])) {
			$contact = new Contact;
			$contact->attributes = $_POST['Contact'];

			if (!$contact->save()) {
				foreach ($contact->getErrors() as $errors) {
					foreach ($errors as $error) {
						$form_errors['Contact'][] = $error;
					}
				}
			} else {
				if (!preg_match('/^[0-9]+ [A-Z][a-z]{2} [0-9]{4}$/',$_POST['Patient']['dob']) && strtotime($_POST['Patient']['dob'])) {
					$_POST['Patient']['dob'] = date('j M Y',strtotime($_POST['Patient']['dob']));
				}

				$patient->attributes = Helper::convertNHS2MySQL($_POST['Patient']);
				$patient->hos_num = str_pad($patient->hos_num,7,'0',STR_PAD_LEFT);
				$patient->contact_id = $contact->id;

				if (!$patient->validate(null,true,array('Contact','Address'))) {
					foreach ($patient->getErrors() as $errors) {
						foreach ($errors as $error) {
							$form_errors['Patient'][] = $error;
						}
					}
					$contact->delete();
				} else {
					if (!$patient->save()) {
						throw new Exception("Unable to save patient: ".print_r($patient->getErrors(),true));
					}

					foreach (array('Home','Correspondence') as $type) {
						$address_type = AddressType::model()->find('name=?',array($type));

						$address = new Address;
						$address->attributes = $_POST['Address'];
						$address->address_type_id = $address_type->id;
						$address->contact_id = $contact->id;

						if (!$address->save()) {
							throw new Exception("Unable to save patient address: ".print_r($address->getErrors(),true));
						}
					}

					return $this->redirect(array('/patient/view/'.$patient->id));
				}
			}
		}

		$this->render(
			'create',
			array(
				'patient' => $patient,
				'contact' => $contact,
				'address' => $address,
				'errors' => $form_errors,
			),
			false, true
		);
	}

	public function actionUpdate($id)
	{
		if (!$this->patient = Patient::model()->findByPk($id)) {
			throw new Exception("Unable to find patient: $id");
		}

		$this->actionCreate();
	}
}
