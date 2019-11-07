<?php
ArContactUsLoader::loadClass('ArContactUsAbstract');
ArContactUsLoader::loadClass('ArContactUsImport');
ArContactUsLoader::loadClass('ArContactUsListTable');
ArContactUsLoader::loadClass('ArContactUsTwilio');
ArContactUsLoader::loadClass('ArContactUsUpdater');
ArContactUsLoader::loadController('ArContactUsMenuController');
ArContactUsLoader::loadController('ArContactUsPromptController');
ArContactUsLoader::loadController('ArContactUsRequestsController');

class ArContactUsAdmin extends ArContactUsAbstract
{
    const NONCE = 'arcontactus-update-key';
    
    private static $initiated = false;

    protected $errors = array();
    protected $success = null;

    protected $generalConfig = null;
    protected $buttonConfig = null;
    protected $mobileButtonConfig = null;
    protected $menuConfig = null;
    protected $mobileMenuConfig = null;
    protected $popupConfig = null;
    
    protected $promptConfig = null;
    protected $mobilePromptConfig = null;
    protected $liveChatsConfig = null;


    protected $json;
    
    public function init()
    {
        $this->generalConfig = new ArContactUsConfigGeneral('arcug_');
        $this->buttonConfig = new ArContactUsConfigButton('arcub_');
        $this->mobileButtonConfig = new ArContactUsConfigMobileButton('arcumb_');
        $this->menuConfig = new ArContactUsConfigMenu('arcum_');
        $this->mobileMenuConfig = new ArContactUsConfigMobileMenu('arcumm_');
        $this->popupConfig = new ArContactUsConfigPopup('arcup_');
        $this->promptConfig = new ArContactUsConfigPrompt('arcupr_');
        $this->mobilePromptConfig = new ArContactUsConfigMobilePrompt('arcumpr_');
        $this->liveChatsConfig = new ArContactUsConfigLiveChat('arcul_');
        if (!self::$initiated){
            $this->initHooks();
        }
        if ($this->isSubmitted()){
            if ($this->validate()){
                if ($this->save()){
                    $this->success = __('Settings updated', 'ar-contactus');
                }
            }
        }elseif($this->importSubmitted()){
            $import = new ArContactUsImport($this);
            if ($import->import()){
                $this->success = __('All data imported', 'ar-contactus');
            }else{
                $this->errors[] = array($import->getError());
            }
        }
    }
    
    public function importSubmitted()
    {
        return self::isSubmit('importDataSubmit');
    }
    
    public function validate()
    {
        foreach ($this->getForms() as $model) {
            if (self::isSubmit(get_class($model))) {
                $model->loadFromConfig();
                $model->populate();
                if (!$model->validate()) {
                    $this->errors = $model->getErrors();
                    return false;
                }
                return true;
            }
        }
    }
    
    public function getSubmit()
    {
        foreach ($this->getForms() as $model) {
            if (self::isSubmit(get_class($model))) {
                return get_class($model);
            }
        }
        if (self::isSubmit('importDataSubmit')){
            return 'importDataSubmit';
        }
    }
    
    public function isSubmitted()
    {
        foreach ($this->getAllowedSubmits() as $submit) {
            if ($this->isSubmit($submit)) {
                return true;
            }
        }
    }
    
    public function getAllowedSubmits()
    {
        $submits = array();
        foreach ($this->getForms() as $model) {
            $submits[] = get_class($model);
        }
        return $submits;
    }
    
    public function getForms()
    {
        return array(
            $this->generalConfig,
            $this->buttonConfig,
            $this->mobileButtonConfig,
            $this->menuConfig,
            $this->mobileMenuConfig,
            $this->popupConfig,
            $this->promptConfig,
            $this->mobilePromptConfig,
            $this->liveChatsConfig
        );
    }
    
    public function save()
    {
        if (!wp_verify_nonce($_POST['_wpnonce'], self::NONCE)){
            return false;
        }
        $this->errors = array();
        foreach ($this->getForms() as $model) {
            if (self::isSubmit(get_class($model))) {
                $model->populate();
                if ($model->saveToConfig()) {
                    $this->compilleDesktopCss();
                    $this->compilleMobileCss();
                    return true;
                } else {
                    $this->errors = $model->getErrors();
                }
            }
        }
        return false;
    }
    
    public function compilleDesktopCss()
    {
        if (!$this->menuConfig->isLoaded()){
            $this->menuConfig->loadFromConfig();
        }
        if (!$this->popupConfig->isLoaded()){
            $this->popupConfig->loadFromConfig();
        }
        if (!$this->buttonConfig->isLoaded()){
            $this->buttonConfig->loadFromConfig();
        }
        $content = self::render('front/styles.php', array(
            'menuConfig' => $this->menuConfig,
            'popupConfig' => $this->popupConfig,
            'buttonConfig' => $this->buttonConfig,
            'isMobile' => false
        ));
        $content = preg_replace('/\s+/is', ' ', $content);
        $content = str_replace(array('; }'), '}', $content);
        $content = str_replace(array('{ '), '{', $content);
        if (is_writable(AR_CONTACTUS_PLUGIN_DIR . 'res/css/generated-desktop.css')) {
            file_put_contents(AR_CONTACTUS_PLUGIN_DIR . 'res/css/generated-desktop.css', $content);
            update_option('arcu_css_generated', time());
        }
    }
    
    public function compilleMobileCss()
    {
        if (!$this->mobileMenuConfig->isLoaded()){
            $this->mobileMenuConfig->loadFromConfig();
        }
        if (!$this->popupConfig->isLoaded()){
            $this->popupConfig->loadFromConfig();
        }
        if (!$this->mobileButtonConfig->isLoaded()){
            $this->mobileButtonConfig->loadFromConfig();
        }
        $content = self::render('front/styles.php', array(
            'menuConfig' => $this->mobileMenuConfig,
            'popupConfig' => $this->popupConfig,
            'buttonConfig' => $this->mobileButtonConfig,
            'isMobile' => true
        ));
        $content = preg_replace('/\s+/is', ' ', $content);
        $content = str_replace(array('; }'), '}', $content);
        $content = str_replace(array('{ '), '{', $content);
        if (is_writable(AR_CONTACTUS_PLUGIN_DIR . 'res/css/generated-mobile.css')){
            file_put_contents(AR_CONTACTUS_PLUGIN_DIR . 'res/css/generated-mobile.css', $content);
            update_option('arcu_css_generated', time());
        }
    }
    
    public function initHooks()
    {
        self::$initiated = true;
        $updater = new ArContactUsUpdater($this);
        add_action('admin_init', array($this, 'adminInit'));
        add_action('admin_menu', array($this, 'adminMenu'), 5);
        add_action('admin_enqueue_scripts', array($this, 'loadResources'));
        add_filter('plugin_action_links', array($this, 'adminPluginSettings'), 10, 2);
        add_action('admin_head', array($this, 'renderOnesignal'));
        $updater->checkUpdate();
        add_action('upgrader_process_complete', array($updater, 'migrate'), 9, 0);
        $promptController = new ArContactUsPromptController();
        $promptController->init();
        
        $menuController = new ArContactUsMenuController();
        $menuController->init();
        
        $requestsController = new ArContactUsRequestsController();
        $requestsController->init();
    }
    
    public function renderOnesignal()
    {
        if (!$this->popupConfig->isLoaded()){
            $this->popupConfig->loadFromConfig();
        }
        if (!$this->popupConfig->onesignal){
            return false;
        }
        $manifest = AR_CONTACTUS_PLUGIN_URL . 'manifest.json';
        echo self::render('/admin/_onesignal.php', array(
            'manifest' => $manifest,
            'popupConfig' => $this->popupConfig,
            'host' => parse_url(AR_CONTACTUS_PLUGIN_URL, PHP_URL_HOST),
            'scheme' => parse_url(AR_CONTACTUS_PLUGIN_URL, PHP_URL_SCHEME),
        ));
    }
    
    public function adminPluginSettings($links, $file)
    {
        if ($file == plugin_basename(AR_CONTACTUS_PLUGIN_DIR . '/ar-contactus.php')){
            $links[] = '<a href="' . esc_url(admin_url('options-general.php?page=ar-contactus-key-config')) . '">'.esc_html__('Settings', 'ar-contactus').'</a>';
        }

        return $links;
    }
            
    public function callbackRequests(){
        echo self::render('/admin/callback-requests.php', array(
            'callbackList' => new ArContactUsListTable(),
            'activeSubmit' => 'arcontactus-requests'
        ));
    }
    
    public function getErrors()
    {
        return $this->errors;
    }
    
    public function adminInit() {
        load_plugin_textdomain('ar-contactus', false, basename(AR_CONTACTUS_PLUGIN_DIR) . '/languages');
    }

    public function adminMenu() {
        $this->loadMenu();
    }
    
    public function loadMenu() {
        $hook = add_options_page(__('Contact-us button', 'ar-contactus'), __('Contact-us button', 'ar-contactus'), 'manage_options', 'ar-contactus-key-config', array($this, 'displayConfig'));
        $menu_label = __('Callbacks', 'ar-contactus');
        $count = ArContactUsCallbackModel::newCount();
        $menu_label .= " <span class='update-plugins count-1' " . ($count? '' : 'style="display: none"') . "' id='arcontactus-cb-count'><span class='update-count'>" . $count . "</span></span>";
        add_menu_page(__('Callbacks', 'ar-contactus'), $menu_label, 'manage_options', 'ar-contactus-key-requests', array($this,'callbackRequests'), 'dashicons-phone');
    }
    
    public function displayConfig()
    {
        if (!$this->generalConfig->isLoaded()){
            $this->generalConfig->loadFromConfig();
        }
        if (!$this->buttonConfig->isLoaded()){
            $this->buttonConfig->loadFromConfig();
        }
        if (!$this->mobileButtonConfig->isLoaded()){
            $this->mobileButtonConfig->loadFromConfig();
        }
        if (!$this->menuConfig->isLoaded()){
            $this->menuConfig->loadFromConfig();
        }
        if (!$this->mobileMenuConfig->isLoaded()){
            $this->mobileMenuConfig->loadFromConfig();
        }
        if (!$this->popupConfig->isLoaded()){
            $this->popupConfig->loadFromConfig();
        }
        if (!$this->promptConfig->isLoaded()){
            $this->promptConfig->loadFromConfig();
        }
        if (!$this->mobilePromptConfig->isLoaded()){
            $this->mobilePromptConfig->loadFromConfig();
        }
        if (!$this->liveChatsConfig->isLoaded()){
            $this->liveChatsConfig->loadFromConfig();
        }
        
        $updater = new ArContactUsUpdater();
        wp_enqueue_editor();
        echo self::render('/admin/config.php', array(
            'generalConfig' => $this->generalConfig,
            'activated' => $updater->isActivated(),
            'buttonConfig' => $this->buttonConfig,
            'mobileButtonConfig' => $this->mobileButtonConfig,
            'menuConfig' => $this->menuConfig,
            'mobileMenuConfig' => $this->mobileMenuConfig,
            'popupConfig' => $this->popupConfig,
            'promptConfig' => $this->promptConfig,
            'mobilePromptConfig' => $this->mobilePromptConfig,
            'liveChatsConfig' => $this->liveChatsConfig,
            'integrations' => $this->liveChatsConfig->getIntegrations(),
            'errors' => $this->errors,
            'success' => $this->success,
            'callbackList' => new ArContactUsListTable(),
            'items' => ArContactUsModel::find()->orderBy('`position` ASC')->all(),
            'promptItems' => ArContactUsPromptModel::find()->orderBy('`position` ASC')->all(),
            'activeSubmit' => $this->getSubmit(),
            'brandColors' => $this->getBrandColors()
        ));
    }
    
    public function getBrandColors()
    {
        return array(
            'Skype' => '00aff0',
            'Viber' => '8f5db7',
            'Facebook Messenger' => '0084ff',
            'WhatsApp' => '25d366',
            'Telegram' => '0088cc',
            'Facebook' => '3b5998',
            'Android' => 'a4c639',
            'Zendesk' => 'f79a3e',
            'Vkontakte' => '45668e',
            'Twitter' => '1da1f2'
        );
    }
    
    public function js()
    {
        return array(
            'jquery' => null,
            'jquery-ui-sortable' => null,
            'semantic-ui.js' => 'res/semantic-ui/semantic.min.js',
            'color.js' => 'res/js/color.js',
            'admin.js' => 'res/js/admin.js'
        );
    }
    
    public function css()
    {
        return array(
            'semantic-ui-combined.css' => 'res/semantic-ui/semantic-combined.min.css',
            'arcontactus-admin.css' => 'res/css/admin.css'
        );
    }
    
    public function loadResources()
    {
        global $hook_suffix;
        if ($hook_suffix == 'settings_page_ar-contactus-key-config' || $hook_suffix == 'toplevel_page_ar-contactus-key-requests') {
            $this->registerCss();
            $this->registerJs();
        }
    }
}
