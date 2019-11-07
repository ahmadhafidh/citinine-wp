<?php
ArContactUsLoader::loadModel('ArContactUsConfigModel');

class ArContactUsConfigPopup extends ArContactUsConfigModel
{
    public $popup_width;
    
    public $timeout;
    public $message;
    public $phone_placeholder;
    public $phone_mask_on;
    public $maskedinput;
    public $phone_mask;
    public $proccess_message;
    public $success_message;
    public $fail_message;
    public $close_timeout;
    public $btn_title;
    public $name;
    public $name_required;
    public $name_title;
    public $name_placeholder;
    public $gdpr;
    public $gdpr_title;
    public $email;
    public $email_list;
    
    public $hr1;
    public $twilio;
    public $twilio_api_key;
    public $twilio_auth_token;
    public $twilio_phone;
    public $twilio_tophone;
    public $twilio_message;
    
    public $hr2;
    public $tg;
    public $tg_token;
    public $tg_chat_id;
    public $tg_text;
    
    public $hr3;
    public $onesignal;
    public $onesignal_alert;
    public $onesignal_app_id;
    public $onesignal_api_key;
    public $onesignal_title;
    public $onesignal_message;
    
    public $hr4;
    public $recaptcha;
    public $key;
    public $secret;
    public $hide_recaptcha;
    
    public function getFormTitle()
    {
        return __('Callback popup settings', 'ar-contactus');
    }
    
    public function attributeDefaults()
    {
        return array(
            'popup_width' => '360',
            'timeout' => '0',
            'message' => __("Please enter your phone number\nand we call you back soon", 'ar-contactus'),
            'phone_placeholder' => __("+XXX-XX-XXX-XX-XX", 'ar-contactus'),
            'phone_mask' => '+XXX-XX-XXX-XX-XX',
            'proccess_message' => __("We are calling you to phone", 'ar-contactus'),
            'success_message' => __("Thank you.\nWe are call you back soon.", 'ar-contactus'),
            'close_timeout' => 0,
            'fail_message' => __("Connection error. Please refresh the page and try again.", 'ar-contactus'),
            'btn_title' => __("Waiting for call", 'ar-contactus'),
            'tg_text' => __('New callback request from phone: {phone}', 'ar-contactus'),
            'maskedinput' => 1,
            'name' => 0,
            'name_title' => __('Enter your name', 'ar-contactus'),
            'gdpr' => 0,
            'gdpr_title' => __('I accept GDPR rules', 'ar-contactus'),
            'email' => 1,
            'email_list' => $this->getAdminEmail(),
            'onesignal' => 0,
            'onesignal_title' => __('New callback request', 'ar-contactus'),
            'onesignal_message' => __('New callback request received from {site}. Please call to {phone}.', 'ar-contactus'),
            'recaptcha' => 0,
            'hide_recaptcha' => 1,
            'twilio_message' => __("New callback request received from {phone}", 'ar-contactus')
        );
    }
    
    public function getAdminEmail()
    {
        return get_option('admin_email');
    }
}
