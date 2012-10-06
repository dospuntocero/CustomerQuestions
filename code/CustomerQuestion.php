<?php
class CustomerQuestion extends DataObject {

	static $singular_name = "Customer Question";
	static $plural_name = "Customer Questions";

	static $db = array(
		"Name" => "Varchar(255)",
		"Cellphone" => "Varchar",
		"Email" => "Varchar(255)",
		"Question" => "Text",
		"Answer" => "Text",
		"Answered" => "Boolean",
	);

	//Fields to show in the DOM
	static $summary_fields = array(
		"Name" => "Name",
		"Email" => "Email"
	);
	
	public function getCMSFields() {	
		$fields = parent::getCMSFields();
		$fields->removeFieldFromTab("Root.Main","Answered");
		$fields->addFieldToTab("Root.Main", TextField::create('Name',_t('CustomerQuestion.NAME',"Name"))->setAttribute('readonly', true));
		$fields->addFieldToTab("Root.Main", TextField::create('Cellphone',_t('CustomerQuestion.CELLPHONE',"Cell Phone"))->setAttribute('readonly', true));
		$fields->addFieldToTab("Root.Main", TextField::create('Email',_t('CustomerQuestion.EMAIL',"Email"))->setAttribute('readonly', true));
		$fields->addFieldToTab("Root.Main", TextareaField::create('Question',_t('CustomerQuestion.QUESTION',"Question"))->setAttribute('readonly', true));

		$answer = TextareaField::create('Answer',_t('CustomerQuestion.ANSWER',"Your Answer"));


		if ($this->Answered) {
			$fields->addFieldToTab("Root.Main", LiteralField::create('YourAnswer',_t('CustomerQuestion.YOURANSWER',"Your Answer")));
			$fields->addFieldToTab("Root.Main", $answer->setAttribute('readonly', true));
		}
		else{
			$fields->addFieldToTab("Root.Main", $answer);
		}
		return $fields;
	}
	
	public function onBeforeWrite(){
		parent::onBeforeWrite();
		if (!$this->Answered && !empty($this->Answer)) {
			//Set data
			$From = $this->Email;
			$To = "fa@god.cl";
			$Subject = _t('CustomerQuestion.ANSWER',"Here is your Answer!");
			$Body = $this->Answer;
			$email = new Email($From, $To, $Subject, $Body);
			//set template
			$email->setTemplate('ContactAnswer');
			//send mail
			if ($email->send()) {
				$this->Answered = 1;
				return Injector::inst()->get("Dashboard")->Link();
			}else{
				Controller::curr()->redirect(Director::baseURL(). $this->URLSegment . "/error");
			}
		}
	}
}