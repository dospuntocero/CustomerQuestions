<?php 

class CustomerQuestionsAdmin extends ModelAdmin
{
    public static $managed_models = array('CustomerQuestion'); // Can manage multiple models
    public static $url_segment = 'customer-questions';
    public static $menu_title = 'Customer Questions';
    public $showImportForm = false;
    
    public function BackLink()
    {
        return Injector::inst()->get("Dashboard")->Link();
    }
}
