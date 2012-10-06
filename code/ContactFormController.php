<?php
class ContactForm_Controller extends Page_Controller {


	function init() {
		parent::init();
		Requirements::css("mysite/css/Form.css");
		Requirements::javascript(THIRDPARTY_DIR."/jquery/jquery.min.js");
		Requirements::javascript(THIRDPARTY_DIR."/jquery-validate/jquery.validate.pack.js");
		Requirements::javascript(THIRDPARTY_DIR."/jquery-validate/localization/messages_es.js");

		Requirements::customScript('
			jQuery(document).ready(function() {
				jQuery("#Form_ContactForm").validate({
					rules: {
						Name: "required",
						Email: {
							required: true,
							email: true
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
			TextField::create("Comments")->setTitle(_t('ContactPage.COMMENTSINPUT',"Comments <em>*</em>"))->setMaxLength(50)
		);

		// Create action
		$send = new FormAction('SendContactForm', _t('ContactPage.SEND',"Send"));
		$send->addExtraClass("success btn");

		$actions = new FieldList(
			$send
		);
	// Create action
		$validator = new RequiredFields('Name', 'Email', 'Comments');
		return new Form($this, 'ContactForm', $fields, $actions, $validator);
	}

	function SendContactForm($data) {

		$cp = SiteConfig::current_site_config();

		//Set data
		$From = $data['Email'];
		$To = $cp->Mailto;
		$Subject = _t('ContactPage.WEBSITECONTACTMESSAGE',"Website Contact message");  	  
		$email = new Email($From, $To, $Subject);
		//set template
		$email->setTemplate('ContactEmail');
		//populate template
		$email->populateTemplate($data);
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