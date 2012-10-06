<?php
class ContactForm_Controller extends Page_Controller {

	function init() {
		parent::init();
		Requirements::css("mysite/css/Form.css");
		Requirements::javascript("mysite/javascript/thirdparty/jquery.js");
		Requirements::javascript("mysite/javascript/thirdparty/jquery-validate/jquery.validate.pack.js");
		Requirements::javascript("mysite/javascript/thirdparty/jquery-validate/localization/messages_es.js");
	
		Requirements::customScript('
		jQuery(document).ready(function() {
			jQuery("#Form_ContactForm").validate({
				rules: {
					Name: "required",
					Email: {
						required: true,
							email: true
							},
						Comments: {
							required: true,
								minlength: 20
							}
						},
						messages: {
						Name: "'._t("ContactPage.NAME","We need your name").'",
						Email: "'._t("ContactPage.EMAIL","Without your real email address, we can't reach you").'",
						Comments: "'._t("ContactPage.COMMENTS","What are you thinking? Tell me").'"
					}
				});
			});
		');
	}
	
	function ContactForm() {
	// Create fields
		$fields = new FieldList(
			TextField::create('Name')->setTitle(_t('ContactPage.NAMEINPUT',"Name <em>*</em>")),
			TextField::create("Cellphone")->setTitle(_t('ContactPage.CELLPHONE',"Cellphone")),
			EmailField::create("Email")->setTitle(_t('ContactPage.EMAIL',"Email address"))->setAttribute('type', 'email'),
      TextareaField::create("Question")->setTitle(_t('ContactPage.QUESTION',"Question <em>*</em>"))

		);

		// Create action
		$send = new FormAction('SendContactForm', _t('ContactPage.SEND',"Send"));
		$send->addExtraClass("success btn");

		$actions = new FieldList(
			$send
		);
		// Create action
		$validator = new RequiredFields('Name', 'Email', 'Question');
		return new Form($this, 'ContactForm', $fields, $actions, $validator);
	}
 
	function SendContactForm($data, $form) {
		//saves the question in the database
		$CustomerQuestion = new CustomerQuestion();
		$form->saveInto($CustomerQuestion);
		$CustomerQuestion->write();
		
		$cp = DataObject::get_one("ContactPage");

		//Sets data
		$From = $data['Email'];
		$To = $cp->Mailto;
		$Subject = _t('ContactPage.WEBSITECONTACTMESSAGE',"Website Contact message");
		$email = new Email($From, $To, $Subject);
		//set template
		$email->setTemplate('ContactEmail');
		//populate template
		$email->populateTemplate(array(
			"ID" => "$CustomerQuestion->ID",
			"Name" => $data["Name"],
			"Cellphone" => $data["Cellphone"],
			"Email" => $data["Email"],
			"Question" => $data["Question"]
		));
		//send mail
		if ($email->send()) {
			Controller::curr()->redirect(Director::baseURL(). $this->URLSegment . "/success");
		}else{
			Controller::curr()->redirect(Director::baseURL(). $this->URLSegment . "/error");
		}
	}

	public function error(){
		return $this->httpError(500);
	}

	public function success(){
		$renderedContent = $this->renderWith('Page', array('Content' => $this->SubmitText));
		return $renderedContent;
	}
}