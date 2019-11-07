<?php
ArContactUsLoader::loadController('ArContractUsControllerAbstract');
ArContactUsLoader::loadModel('ArContactUsModel');
ArContactUsLoader::loadClass('ArContactUsTelegram');
ArContactUsLoader::loadClass('ArContactUsOnesignal');
        
class ArContactUsRequestsController extends ArContractUsControllerAbstract
{
    protected $errors = array();
    protected $popupConfig = null;
    protected $json;

    protected function ajaxActions()
    {
        return array(
            'arcontactus_request_callback' => 'requestCallback',
            'arcontactus_callback_count' => 'callbackCount',
            'arcontactus_switch_callback' => 'switchCallback',
            'arcontactus_reload_callback' => 'reload',
            'arcontactus_export_callback' => 'export',
            'arcontactus_edit_comment' => 'editComment',
            'arcontactus_save_comment' => 'saveComment',
        );
    }
    
    protected function ajaxNoprivActions()
    {
        return array(
            'arcontactus_request_callback' => 'requestCallback'
        );
    }
    
    public function setMailContentType()
    {
        return "text/html";
    }
    
    public function saveComment()
    {
        $id = $_POST['id'];
        $comment = $_POST['comment'];
        $model = ArContactUsCallbackModel::findOne($id);
        $model->comment = $comment;
        $model->save();
        wp_die($this->returnJson(array(
            'success' => 1,
            'model' => $model,
            'content' => ArContactUsAdmin::render('admin/partials/comment.php', array(
                'item' => array(
                    'comment' => $model->comment,
                    'id' => $model->id
                )
            ))
        )));
    }
    
    public function editComment()
    {
        $id = $_GET['id'];
        $model = ArContactUsCallbackModel::findOne($id);
        wp_die($this->returnJson(array(
            'success' => 1,
            'model' => $model,
            'header' => ArContactUsAdmin::render('admin/partials/request-item-header.php', array(
                'model' => $model
            ))
        )));
    }
    
    public function requestCallback()
    {
        $this->popupConfig = new ArContactUsConfigPopup('arcup_');
        $this->popupConfig->loadFromConfig();
        
        $phone = wp_strip_all_tags($_POST['phone']);
        if ($this->isValid() && $this->isValidPhone($phone)) {
            $name = '';
            $referer = $_SERVER['HTTP_REFERER'];
            if (isset($_POST['name'])){
                $name = wp_strip_all_tags($_POST['name']);
            }
            $email = $this->sendEmail($phone, $name, $referer);
            $twilio = $this->sendTwilioSMS($phone, $name, $referer);
            $tg = $this->sendTelegram($phone, $name, $referer);
            $push = $this->sendPush($phone, $name, $referer);
            ArContactUsLoader::loadModel('ArContactUsCallbackModel');
            $model = new ArContactUsCallbackModel();
            $model->created_at = date('Y-m-d H:i:s');
            $model->phone = $phone;
            $model->referer = $referer;
            $model->status = ArContactUsCallbackModel::STATUS_NEW;
            $model->id_user = get_current_user_id();
            $model->name = $name;
            $model->save();
            wp_die($this->returnJson(array(
                'success' => 1,
                'email' => $email,
                'json' => AR_CONTACTUS_DEBUG? $this->json : null,
                'twilio' => AR_CONTACTUS_DEBUG? $twilio : null,
                'tg' => AR_CONTACTUS_DEBUG? $tg : null,
                'push' => $push
            )));
        }else{
            wp_die($this->returnJson(array(
                'success' => 0,
                'errors' => $this->getErrors()
            )));
        }
    }
    
    protected function sendPush($phone, $name, $referer)
    {
        if (!$this->popupConfig->onesignal || !$this->popupConfig->onesignal_api_key || !$this->popupConfig->onesignal_app_id || !$this->popupConfig->onesignal_title || !$this->popupConfig->onesignal_message){
            return false;
        }
        $onesignal = new ArContactUsOnesignal($this->popupConfig);
        $message = strtr($this->popupConfig->onesignal_message, array(
            '{site}' => parse_url(AR_CONTACTUS_PLUGIN_URL, PHP_URL_HOST),
            '{phone}' => $phone,
            '{name}' => $name,
            '{referer}' => $referer,
        ));
        $title = strtr($this->popupConfig->onesignal_title, array(
            '{site}' => parse_url(AR_CONTACTUS_PLUGIN_URL, PHP_URL_HOST),
            '{phone}' => $phone,
            '{name}' => $name,
            '{referer}' => $referer,
        ));
        return $onesignal->sendMessage(array(
            'en' => $message
        ), array(
            'en' => $title
        ), '/');
    }


    protected function sendTelegram($phone, $name, $referer)
    {
        if (!$this->popupConfig->tg_chat_id || 
                !$this->popupConfig->tg_token || 
                !$this->popupConfig->tg_text ||
                !$this->popupConfig->tg){
            return false;
        }
        $telegram = new ArContactUsTelegram($this->popupConfig->tg_token, $this->popupConfig->tg_chat_id);
        $message = strtr($this->popupConfig->tg_text, array(
            '{phone}' => $phone,
            '{name}' => $name,
            '{referer}' => $referer,
            '{site}' => parse_url(AR_CONTACTUS_PLUGIN_URL, PHP_URL_HOST),
        ));
        return $telegram->send($message);
    }
    
    protected function sendTwilioSMS($phone, $name, $referer)
    {
        if (!$this->popupConfig->twilio ||
                !$this->popupConfig->twilio_api_key ||
                !$this->popupConfig->twilio_auth_token ||
                !$this->popupConfig->twilio_message ||
                !$this->popupConfig->twilio_phone ||
                !$this->popupConfig->twilio_tophone
            ){
            return false;
        }
        $twilio = new ArContactUsTwilio($this->popupConfig->twilio_api_key, $this->popupConfig->twilio_auth_token);
        $fromPhone = $this->popupConfig->twilio_phone;
        $toPhone = $this->popupConfig->twilio_tophone;
        $message = strtr($this->popupConfig->twilio_message, array(
            '{phone}' => $phone,
            '{name}' => $name,
            '{referer}' => $referer,
            '{site}' => parse_url(AR_CONTACTUS_PLUGIN_URL, PHP_URL_HOST),
        ));
        
        $res = $twilio->sendSMS($message, $fromPhone, $toPhone);
        return $res;
    }


    public function isValidPhone($phone)
    {
        if (empty($phone)){
            $this->errors[] = __('Phone is incorrect!', 'ar-contactus');
            return false;
        }
        return true;
    }
    
    public function callbackCount()
    {
        wp_die($this->returnJson(array(
            'count' => ArContactUsCallbackModel::newCount()
        )));
    }
    
    public function switchCallback()
    {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $model = ArContactUsCallbackModel::findOne($id);
        $model->status = $status;
        $model->updated_at = date('Y-m-d H:i:s');
        $model->save();
        wp_die($this->returnJson(array(
            'success' => 1
        )));
    }
    
    public function export()
    {
        $models = ArContactUsCallbackModel::find()->all();
        $csvLines = array(
            'ID;Name;Phone;Page;Request date;Status'
        );
        foreach ($models as $model) {
            switch ($model->status){
                case ArContactUsCallbackModel::STATUS_NEW:
                    $status = __('New', 'ar-contactus');
                    break;
                case ArContactUsCallbackModel::STATUS_DONE:
                    $status = __('Done', 'ar-contactus');
                    break;
                case ArContactUsCallbackModel::STATUS_IGNORE:
                    $status = __('Ignore', 'ar-contactus');
                    break;
            }
            $csvLines[] = implode(';', array(
                $model->id,
                $model->name,
                "=\"{$model->phone}\"",
                $model->referer,
                $model->created_at,
                $status
            ));
        }
        $content = implode(PHP_EOL, $csvLines);
        file_put_contents(AR_CONTACTUS_PLUGIN_DIR . '/uploads/export.csv', "\xEF\xBB\xBF" . $content);
        wp_die($this->returnJson(array(
            'success' => 1,
            'file' => AR_CONTACTUS_PLUGIN_URL . '/uploads/export.csv'
        )));
    }
    
    public function reload()
    {
        if (!isset($GLOBALS['hook_suffix'])){
            $GLOBALS['hook_suffix'] = null;
        }
        wp_die($this->returnJson(array(
            'success' => 1,
            'content' => self::render('/admin/_requests.php', array(
                'callbackList' => new ArContactUsListTable(),
                'activeSubmit' => 'arcontactus-requests',
                'noSegment' => 1
            ))
        )));
    }
    
    protected function sendEmail($phone, $name, $referer)
    {
        if ($this->popupConfig->email && $this->popupConfig->email_list){
            add_filter('wp_mail_content_type', array($this, 'setMailContentType'));
            $emails = explode(PHP_EOL, $this->popupConfig->email_list);
            $res = true;
            foreach ($emails as $email){
                $res = wp_mail($email, 'New callback request [' . get_option('blogname') . ']', self::render('mail/callback.php', array(
                    'phone' => $phone,
                    'name' => $name,
                    'referer' => $referer,
                    'subject' => 'New callback request [' . get_option('blogname') . ']',
                    'pluginUrl' => rtrim( plugin_dir_url( __DIR__ ), '/\\' )
                ))) && $res;
            }
            return $res;
        }
        return null;
    }


    /**
     * Check is everything is ok
     * @return boolean
     */
    public function isValid()
    {
        if (!isset($_POST['action'])){
            return false;
        }
        $action = $_POST['action'];
        return $action == 'arcontactus_request_callback' && $this->isValidRecaptcha();
    }
    
    /**
     * Check is recaptha token valid
     * @return boolean
     */
    public function isValidRecaptcha()
    {
        if (!$this->popupConfig->recaptcha){
            return true;
        }
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded' . PHP_EOL,
                'content' => http_build_query(array(
                    'secret' => $this->popupConfig->secret,
                    'response' => $_POST['gtoken']
                ))
            ),
        ));
        $data = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
        $json = json_decode($data, true);
        $this->json = $json;
        if (isset($json['success']) && $json['success']) {
            if (isset($json['score']) && ($json['score'] < 0.3)) { // reCaptcha returns score from 0 to 1.
                $this->errors[] = __('Bot activity detected!', 'ar-contactus');
                return false;
            }
        } else {
            $this->addReCaptchaErrors($json['error-codes']);
            return false;
        }
        return true;
    }

    /**
     * Humanize recaptha errors
     * @param type $errors
     */
    public function addReCaptchaErrors($errors)
    {
        $reCaptchaErrors = $this->getReCaptchaErrors();
        if ($errors) {
            foreach ($errors as $error) {
                if (isset($reCaptchaErrors[$error])) {
                    $this->errors[] = $reCaptchaErrors[$error];
                } else {
                    $this->errors[] = $error;
                }
            }
        }
    }

    /**
     * recaptha errors
     * @param type $errors
     */
    public function getReCaptchaErrors()
    {
        return array(
            'missing-input-secret' => __('The secret parameter is missing. Please check your reCaptcha Secret.', 'ar-contactus'),
            'invalid-input-secret' => __('The secret parameter is invalid or malformed. Please check your reCaptcha Secret.', 'ar-contactus'),
            'missing-input-response' => __('Bot activity detected! Empty captcha value.', 'ar-contactus'),
            'invalid-input-response' => __('Bot activity detected! Captcha value is invalid.', 'ar-contactus'),
            'bad-request' => __('The request is invalid or malformed.', 'ar-contactus'),
        );
    }
    
    public function getErrors()
    {
        return $this->errors;
    }
}
