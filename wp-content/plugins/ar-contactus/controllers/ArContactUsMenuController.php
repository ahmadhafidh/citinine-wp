<?php
ArContactUsLoader::loadController('ArContractUsControllerAbstract');
ArContactUsLoader::loadModel('ArContactUsModel');
ArContactUsLoader::loadClass('ArContactUsUpdater');

class ArContactUsMenuController extends ArContractUsControllerAbstract
{
    protected function ajaxActions()
    {
        return array(
            'arcontactus_save_menu_item' => 'saveItem',
            'arcontactus_reload_menu_items' => 'reloadItems',
            'arcontactus_reorder_menu_items' => 'reorderItems',
            'arcontactus_switch_menu_item' => 'switchItem',
            'arcontactus_edit_menu_item' => 'editItem',
            'arcontactus_delete_menu_item' => 'deleteItem',
            'arcontactus_export_data' => 'exportData',
            'arcontactus_import_data' => 'importData',
            'arcontactus_activate' => 'activate',
        );
    }
    
    public function activate()
    {
        $updater = new ArContactUsUpdater();
        $code = trim($_GET['code']);
        update_option('AR_CONTACTUS_PURCHASE_CODE', $code);
        wp_die($this->returnJson($updater->isActivated()));
    }

    public function exportData()
    {
        $params = $_POST;
        
        $generalConfig = new ArContactUsConfigGeneral('arcug_');
        $buttonConfig = new ArContactUsConfigButton('arcub_');
        if (ArContactUsLoader::isModelExists('ArContactUsConfigMobileButton')){
            $mobileButtonConfig = new ArContactUsConfigMobileButton('arcumb_');
            $mobileButtonConfig->loadFromConfig();
        }
        $menuConfig = new ArContactUsConfigMenu('arcum_');
        if (ArContactUsLoader::isModelExists('ArContactUsConfigMobileMenu')){
            $mobileMenuConfig = new ArContactUsConfigMobileMenu('arcumm_');
            $mobileMenuConfig->loadFromConfig();
        }
        $popupConfig = new ArContactUsConfigPopup('arcup_');
        $promptConfig = new ArContactUsConfigPrompt('arcupr_');
        if (ArContactUsLoader::isModelExists('ArContactUsConfigMobilePrompt')){
            $mobilePromptConfig = new ArContactUsConfigMobilePrompt('arcumpr_');
            $mobilePromptConfig->loadFromConfig();
        }
        $integrationConfig = new ArContactUsConfigLiveChat('arcul_');
        
        $generalConfig->loadFromConfig();
        $buttonConfig->loadFromConfig();
        $menuConfig->loadFromConfig();
        
        $popupConfig->loadFromConfig();
        $promptConfig->loadFromConfig();
        $integrationConfig->loadFromConfig();
        
        $data = array();
        if ($params['settings']){
            $data['general'] = $generalConfig->getAttributes();
            $data['button'] = $buttonConfig->getAttributes();
            if (isset($mobileButtonConfig)){
                $data['mobileButton'] = $mobileButtonConfig->getAttributes();
            }
            $data['menu'] = $menuConfig->getAttributes();
            if (isset($mobileMenuConfig)){
                $data['mobileMenu'] = $mobileMenuConfig->getAttributes();
            }
            $data['popup'] = $popupConfig->getAttributes();
            $data['prompt'] = $promptConfig->getAttributes();
            if (isset($mobilePromptConfig)){
                $data['mobilePrompt'] = $mobilePromptConfig->getAttributes();
            }
            $data['integrations'] = $integrationConfig->getAttributes();
        }
        if ($params['menu']){
            $data['menuItems'] = ArContactUsModel::find()->all();
        }
        if ($params['prompts']){
            $data['promptItems'] = ArContactUsPromptModel::find()->all();
        }
        if ($params['callbacks']){
            $data['callbackItems'] = ArContactUsCallbackModel::find()->all();
        }
        
        file_put_contents(AR_CONTACTUS_PLUGIN_DIR . 'uploads/export.json', $this->returnJson($data));
        
        $fileUrl = AR_CONTACTUS_PLUGIN_DIR . 'uploads/export.json';
        
        header('Content-Type: application/json');
        header("Content-Transfer-Encoding: Binary");
        header("Content-Disposition: attachment; filename=\"" . basename($fileUrl) . "\""); 
        readfile($fileUrl);
        exit();
    }
    
    public function saveItem()
    {
        $id = $_POST['id'];
        if (!$id){
            $model = new ArContactUsModel();
            $model->status = 1;
            $model->position = ArContactUsModel::getLastPostion() + 1;
        }else{
            $model = ArContactUsModel::findOne($id);
        }
        $model->load($_POST['data']);
        $model->validate();
        $errors = $model->getErrors();
        
        switch ($model->type){
            case ArContactUsModel::TYPE_LINK:
                if (empty($model->link)){
                    $errors['link'] = array(__('Link field is required'));
                }
                break;
            case ArContactUsModel::TYPE_JS:
                if (empty($model->js)){
                    $errors['js'] = array(__('Custom JS code field is required'));
                }
                break;
            case ArContactUsModel::TYPE_INTEGRATION:
                if (empty($model->integration)){
                    $errors['integration'] = array(__('Integration field is required'));
                }
                break;
            case ArContactUsModel::TYPE_CONTENT:
                if (empty($model->content)){
                    $errors['content'] = array(__('Content field is required'));
                }
                break;
        }
        
        if ($model->icon == 'FontAwesome icon') {
            $model->icon = $_POST['data']['fa_icon'];
        }
        
        if (empty($errors)){
            wp_die($this->returnJson(array(
                'success' => $model->save()
            )));
        }else{
            wp_die($this->returnJson(array(
                'success' => 0,
                'errors' => $errors
            )));
        }
    }
    
    public function reloadItems()
    {
        wp_die($this->returnJson(array(
            'success' => 1,
            'content' => $this->render('/admin/_items_table.php', array(
                'items' => ArContactUsModel::find()->orderBy('`position` ASC')->all()
            ))
        )));
    }
    
    public function reorderItems()
    {
        $data = $_POST['data'];
        foreach ($data as $item) {
            $k = explode('_', $item);
            ArContactUsModel::updateAll(array(
                'position' => (int)$k[1]
            ), array(
                'id'  => (int)$k[0]
            ));
        }
        wp_die($this->returnJson(array()));
    }
    
    public function switchItem()
    {
        $id = $_POST['id'];
        $model = ArContactUsModel::find()->where(array('id' => $id))->one();
        $model->status = $model->status? 0 : 1;
        $model->save();
        wp_die($this->returnJson(array(
            'success' => 1
        )));
    }
    
    public function editItem()
    {
        $id = $_GET['id'];
        $model = ArContactUsModel::find()->where(array('id' => $id))->one();
        $model->shortcode = $model->getShortcode();
        if ($model->isFontAwesome()) {
            $model->fa_icon = $model->icon;
            $model->icon = 'FontAwesome icon';
        }
        wp_die($this->returnJson($model));
    }
    
    public function deleteItem()
    {
        $id = $_POST['id'];
        $model = ArContactUsModel::find()->where(array('id' => $id))->one();
        wp_die($this->returnJson(array(
            'success' => $model->delete()
        )));
    }
}
