<?php
/* *****************
 * Model
 ******************/
class ContactPage extends Page
{

    public static $icon = "CustomerQuestions/images/email.png";
    public static $description = 'Contact form';
    public static $allow_children = false;
    public static $db = array(
        'Mailto' => 'Varchar(100)', //Email address where submissions will go
        'SubmitText' => 'HTMLText' //Text presented OnAfterSubmit
    );

    /**
    * We only admit one
    */
    public function canCreate($member = null)
    {
        if (ContactPage::get()->Count()>1) {
            return false;
        } else {
            return true;
        }
    }
    
    //CMS fields
    public function getCMSFields()
    {
        $contactTab = _t('ContactPage.CONTACT', "Contact");
        $fields = parent::getCMSFields();
        $fields->addFieldToTab("Root.".$contactTab, new TextField('Mailto', _t('ContactPage.EMAILSUBMISSIONSTO', "Email submissions to")));
        $fields->addFieldToTab("Root.".$contactTab, $submittext = new HTMLEditorField('SubmitText', _t('ContactPage.THANKYOUTEXT', "Thank you text"), 10));
        return $fields;
    }
}

/******************
 *  Controller
 ******************/

class ContactPage_Controller extends ContactForm_Controller
{
}
