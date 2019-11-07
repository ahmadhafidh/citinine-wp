<?php

/**
 * @property ArContactUsAdmin $owner
 */
class ArContactUsImport
{
    public $owner;
    public $error;
    
    public function __construct($owner)
    {
        $this->owner = $owner;
    }
    
    public function import()
    {
        if (!isset($_POST['confirm']) || empty($_POST['confirm'])){
            $this->error = __('You must agree data loss alert', 'ar-contactus');
            return false;
        }
        if (empty($_FILES) || !isset($_FILES['import'])){
            $this->error = __('Import error! No file selected.', 'ar-contactus');
            return false;
        }
        $file = $_FILES['import'];
        if ($file['size'] == 0){
            $this->error = __('Import error! No file selected.', 'ar-contactus');
            return false;
        }
        if ($file['type'] != 'application/json'){
            $this->error = __('Import error! Wrong file type.', 'ar-contactus');
            return false;
        }
        $filename = uniqid('import_') . '.json';
        if (!move_uploaded_file($file['tmp_name'], AR_CONTACTUS_PLUGIN_DIR . 'uploads/' . $filename)){
            $this->error = __('Import error! Error uploading file!', 'ar-contactus');
            return false;
        }
        $data = file_get_contents(AR_CONTACTUS_PLUGIN_DIR . 'uploads/' . $filename);
        $json = json_decode($data);
        if (empty($json)){
            $this->error = __('Import error! File is empty or read error!', 'ar-contactus');
            return false;
        }
        if (!isset($json->general) && !isset($json->button) && !isset($json->menu) && !isset($json->popup) && !isset($json->prompt) && !isset($json->menuItems) && !isset($json->callbackItems) && !isset($json->promptItems)){
            $this->error = __('Import error! File is empty or wrong format!', 'ar-contactus');
            return false;
        }
        if (!isset($json->mobileButton)){
            $json->mobileButton = $json->button;
        }
        if (!isset($json->mobileMenu)){
            $json->mobileMenu = $json->menu;
        }
        
        if (!isset($json->mobilePrompt)){
            $json->mobilePrompt = $json->prompt;
        }
        foreach ($json as $k => $data){
            $methodName = 'importData' . ucfirst($k);
            if (method_exists($this, $methodName) && $data){
                $this->{$methodName}($data);
            }
        }
        $this->owner->compilleDesktopCss();
        $this->owner->compilleMobileCss();
        return true;
    }
    
    public function getError()
    {
        return $this->error;
    }
    
    public function importDataGeneral($data)
    {
        ArContactUsLoader::loadModel('ArContactUsConfigGeneral');
        $model = new ArContactUsConfigGeneral('arcug_');
        $this->importDataConfigModel($model, $data);
    }
    
    public function importDataButton($data)
    {
        ArContactUsLoader::loadModel('ArContactUsConfigButton');
        $model = new ArContactUsConfigButton('arcub_');
        $this->importDataConfigModel($model, $data);
    }
    
    public function importDataMobileButton($data)
    {
        if (ArContactUsLoader::isModelExists('ArContactUsConfigMobileButton')){
            ArContactUsLoader::loadModel('ArContactUsConfigMobileButton');
            $model = new ArContactUsConfigMobileButton('arcumb_');
            $this->importDataConfigModel($model, $data);
        }
    }
    
    public function importDataMenu($data)
    {
        ArContactUsLoader::loadModel('ArContactUsConfigMenu');
        $model = new ArContactUsConfigMenu('arcum_');
        $this->importDataConfigModel($model, $data);
    }
    
    public function importDataMobileMenu($data)
    {
        if (ArContactUsLoader::isModelExists('ArContactUsConfigMobileMenu')){
            ArContactUsLoader::loadModel('ArContactUsConfigMobileMenu');
            $model = new ArContactUsConfigMobileMenu('arcumm_');
            $this->importDataConfigModel($model, $data);
        }
    }
    
    public function importDataPopup($data)
    {
        ArContactUsLoader::loadModel('ArContactUsConfigPopup');
        $model = new ArContactUsConfigPopup('arcup_');
        $this->importDataConfigModel($model, $data);
    }
    
    public function importDataPrompt($data)
    {
        ArContactUsLoader::loadModel('ArContactUsConfigPrompt');
        $model = new ArContactUsConfigPrompt('arcupr_');
        $this->importDataConfigModel($model, $data);
    }
    
    public function importDataMobilePrompt($data)
    {
        if (ArContactUsLoader::isModelExists('ArContactUsConfigMobilePrompt')){
            ArContactUsLoader::loadModel('ArContactUsConfigMobilePrompt');
            $model = new ArContactUsConfigMobilePrompt('arcumpr_');
            $this->importDataConfigModel($model, $data);
        }
    }
    
    public function importDataIntegrations($data)
    {
        ArContactUsLoader::loadModel('ArContactUsConfigLiveChat');
        $model = new ArContactUsConfigLiveChat('arcul_');
        $this->importDataConfigModel($model, $data);
    }
    
    public function importDataMenuItems($data)
    {
        ArContactUsLoader::loadModel('ArContactUsModel');
        ArContactUsModel::truncate();
        foreach ($data as $item) {
            $model = new ArContactUsModel();
            foreach ($item as $attribute => $value){
                if ($attribute != 'id' && property_exists($model, $attribute)){
                    $model->$attribute = $value;
                }
            }
            $model->registered_only = (int)$model->registered_only;
            $model->save();
        }
    }
    
    public function importDataPromptItems($data)
    {
        ArContactUsLoader::loadModel('ArContactUsPromptModel');
        ArContactUsPromptModel::truncate();
        foreach ($data as $item) {
            $model = new ArContactUsPromptModel();
            foreach ($item as $attribute => $value){
                if ($attribute != 'id' && property_exists($model, $attribute)){
                    $model->$attribute = $value;
                }
            }
            $model->save();
        }
    }
    
    public function importDataCallbackItems($data)
    {
        ArContactUsLoader::loadModel('ArContactUsCallbackModel');
        ArContactUsCallbackModel::truncate();
        foreach ($data as $item) {
            $model = new ArContactUsCallbackModel();
            foreach ($item as $attribute => $value){
                if ($attribute != 'id' && property_exists($model, $attribute)){
                    $model->$attribute = $value;
                }
            }
            $model->save();
        }
    }
    
    protected function importDataConfigModel($model, $data)
    {
        $model->clearConfig();
        $model->loadDefaults();
        $model->setAttributes($data);
        $model->saveToConfig(false);
    }
}
