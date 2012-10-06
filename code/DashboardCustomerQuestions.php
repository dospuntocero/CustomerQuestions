<?php


/**
 * Defines the "Recent Edits" dashboard panel type
 *
 * @package Dashboard
 * @author Franciso Arenas <unclecheese@leftandmain.com>
 */

class DashboardCustomerQuestions extends DashboardPanel {

	
	static $db = array (
		'Count' => 'Int'
	);

	static $defaults = array (
		'Count' => 10
	);

	static $icon = "CustomerQuestions/images/email-dashboard.png";


	static $priority = 10;


	public function getLabel() {
		return _t('CustomerQuestions.CUSTOMERQUESTIONS','Customer Questions');
	}

	public function getDescription() {
		return _t('CustomerQuestions.DESCRIPTION','Shows a linked list of recently contact forms submited to our site');
	}


	public function PanelHolder() {
		Requirements::css("CustomerQuestions/css/CustomerQuestions.css");
		return $this->renderWith($this->holderTemplate);
	}


	public function getConfiguration() {
		$fields = parent::getConfiguration();
		$fields->push(TextField::create("Count",_t('DashboardCustomerQuestions.COUNT','Number of submitted forms to display')));
		return $fields;
	}



	/**
	 * Gets the recent edited pages, limited to a user provided number of records
	 *
	 * @return ArrayList
	 */
	public function CustomerQuestions() {
		$records = CustomerQuestion::get()->sort("LastEdited DESC")->filter(array(
			"Answered" => "0"
		))->limit($this->Count);
		$set = ArrayList::create(array());
		foreach($records as $r) {
			$set->push(ArrayData::create(array(
				'AnswerLink' => "admin/customer-questions/CustomerQuestion/EditForm/field/CustomerQuestion/item/{$r->ID}/edit",
				'Title' => $r->Question
			)));
			
		}
		return $set;
	}


}