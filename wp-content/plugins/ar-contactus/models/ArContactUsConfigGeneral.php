<?php
ArContactUsLoader::loadModel('ArContactUsConfigModel');

class ArContactUsConfigGeneral extends ArContactUsConfigModel
{
    public $mobile;
    public $sandbox;
    public $allowed_ips;
    public $pages;
    public $fa_css;
    public $disable_init;
    public $delay_init;
    public $ga_account;
    public $ga_script;
    public $ga_tracker;
    
    public function attributeDefaults()
    {
        return array(
            'mobile' => 1,
            'sandbox' => 0,
            'allowed_ips' => $this->getCurrentIP(),
            'fa_css' => 1,
            'disable_init' => 0,
            'delay_init' => 0,
            'ga_account' => '',
            'ga_script' => 1,
            'ga_tracker' => 1
        );
    }
    
    public function getFormTitle()
    {
        return __('General settings', 'ar-contactus');
    }
}
