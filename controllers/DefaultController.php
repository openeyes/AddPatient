<?php

class DefaultController extends BaseController
{
	public function actionCreate() {
		$patient = new Patient;
		$patient->spoof['country_id'] = 1;

		$form_errors = array();

		if (!empty($_POST['Patient'])) {
			$patient->loadFrom($_POST['Patient']);

			if (!$patient->validate(null,true,array('Contact','Address'))) {
				foreach ($patient->getErrors() as $errors) {
					foreach ($errors as $error) {
						$form_errors['Patient'][] = $error;
					}
				}
			} else {
				if (!$patient->save()) {
					throw new Exception("Unable to save patient: ".print_r($patient->getErrors(),true));
				}

				$contact = new Contact;
				$contact->attributes = $_POST['Patient'];
				$contact->parent_class = 'Patient';
				$contact->parent_id = $patient->id;
				if (!$contact->save()) {
					throw new Exception("Unable to save patient contact: ".print_r($contact->getErrors(),true));
				}

				foreach (array('C','H') as $type) {
					$address = new Address;
					$address->attributes = $_POST['Patient'];
					$address->type = $type;
					$address->parent_class = 'Patient';
					$address->parent_id = $patient->id;
					if (!$address->save()) {
						throw new Exception("Unable to save patient address: ".print_r($address->getErrors(),true));
					}
				}

				return $this->redirect(array('/patient/view/'.$patient->id));
			}
		}

		$this->render(
			'create',
			array(
				'patient' => $patient,
				'errors' => $form_errors,
			),
			false, true
		);
	}
}
