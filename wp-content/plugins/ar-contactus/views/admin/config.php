<?php 
if (empty($activeSubmit) && (isset($_GET['paged']) || isset($_GET['orderby']) || isset($_GET['arcontactus_requests']))){
    $activeSubmit = 'arcontactus-requests';
}?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<div id="arcontactus-plugin-container">
    <div class="arcontactus-masthead">
        <div class="arcontactus-masthead__inside-container">
            <div class="arcontactus-masthead__logo-container">
                <?php echo sprintf(__('All-in-one contact button %swith call-back request feature%s', 'ar-contactus'), '<small>', '</small>') ?>
            </div>
        </div>
    </div>
    <div class="arcontactus-body">
        <?php if (!isset($activated['success']) || !$activated['success']){?>
            <div class="ui red message">
                <b><?php echo __('Plugin is not activated.', 'ar-contactus') ?></b> <?php echo __('You will not receive updates automaticaly.', 'ar-contactus') ?>
                <a href="#" onclick="jQuery('#arcu-about-tab').click(); return false;"><?php echo __('Please activate plugin.', 'ar-contactus') ?></a>
            </div>
        <?php } ?>
        <?php if ($success){?>
            <div class="ui success message">
                <?php echo $success ?>
            </div>
        <?php } ?>
        <?php if ($errors){?>
            <?php foreach ($errors as $fieldErrors){?>
                <?php foreach ($fieldErrors as $error){?>
                    <div class="ui negative message">
                        <?php echo $error ?>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
        <div class="ui grid">
            <div class="four wide column">
                <div class="ui vertical fluid pointing menu" id="acrontactus-menu">
                    <a class="item <?php echo ($activeSubmit == 'ArContactUsConfigGeneral' || empty($activeSubmit))? 'active' : '' ?>" data-target="#arcontactus-general">
                        <?php echo __('General configuration', 'ar-contactus') ?>
                    </a>
                    <a class="item <?php echo (in_array($activeSubmit, array('ArContactUsConfigButton', 'ArContactUsConfigMobileButton')))? 'active' : '' ?>" data-target="#arcontactus-button">
                        <?php echo __('Button settings', 'ar-contactus') ?>
                    </a>
                    <a class="item <?php echo (in_array($activeSubmit, array('ArContactUsConfigMenu', 'ArContactUsConfigMobileMenu')))? 'active' : '' ?>" data-target="#arcontactus-menu">
                        <?php echo __('Menu settings', 'ar-contactus') ?>
                    </a>
                    <a class="item <?php echo ($activeSubmit == 'ArContactUsConfigPopup')? 'active' : '' ?>" data-target="#arcontactus-callback">
                        <?php echo __('Callback popup settings', 'ar-contactus') ?>
                    </a>
                    <a class="item <?php echo (in_array($activeSubmit, array('ArContactUsConfigPrompt', 'ArContactUsConfigMobilePrompt')))? 'active' : '' ?>" data-target="#arcontactus-prompt">
                        <?php echo __('Prompt settings', 'ar-contactus') ?>
                    </a>
                    <a class="item <?php echo ($activeSubmit == 'ArContactUsConfigLiveChat')? 'active' : '' ?>" data-target="#arcontactus-livechat">
                        <?php echo __('Live chat integrations', 'ar-contactus') ?>
                    </a>
                    <a class="item" data-target="#arcontactus-prompt-items">
                        <?php echo __('Prompt messages', 'ar-contactus') ?>
                    </a>
                    <a class="item" data-target="#arcontactus-items">
                        <?php echo __('Menu items', 'ar-contactus') ?>
                    </a>
                    <a class="item <?php echo ($activeSubmit == 'arcontactus-requests')? 'active' : '' ?>" href="<?php echo admin_url('admin.php?page=ar-contactus-key-requests') ?>">
                        <?php echo __('Callback requests', 'ar-contactus') ?>
                    </a>
                    <a class="item <?php echo ($activeSubmit == 'importDataSubmit')? 'active' : '' ?>" data-target="#arcontactus-data">
                        <?php echo __('Export/import', 'ar-contactus') ?>
                    </a>
                    <a class="item" id="arcu-about-tab" data-target="#arcontactus-about">
                        <?php echo __('About', 'ar-contactus') ?>
                    </a>
                </div>
            </div>
            <div class="twelve wide stretched column" id="arcontactus-tabs">
                <span class="hidden"></span>
                <?php echo ArContactUsAdmin::render('/admin/_general.php', array(
                    'generalConfig' => $generalConfig,
                    'activeSubmit' => $activeSubmit
                )) ?>
                <?php echo ArContactUsAdmin::render('/admin/_button.php', array(
                    'buttonConfig' => $buttonConfig,
                    'activeSubmit' => $activeSubmit,
                    'mobileButtonConfig' => $mobileButtonConfig
                )) ?>
                <?php echo ArContactUsAdmin::render('/admin/_menu.php', array(
                    'menuConfig' => $menuConfig,
                    'buttonConfig' => $buttonConfig,
                    'mobileMenuConfig' => $mobileMenuConfig,
                    'activeSubmit' => $activeSubmit
                )) ?>
                <?php echo ArContactUsAdmin::render('/admin/_callback.php', array(
                    'popupConfig' => $popupConfig,
                    'activeSubmit' => $activeSubmit
                )) ?>
                <?php echo ArContactUsAdmin::render('/admin/_live_chats.php', array(
                    'liveChatsConfig' => $liveChatsConfig,
                    'buttonConfig' => $buttonConfig,
                    'activeSubmit' => $activeSubmit
                )) ?>
                <?php echo ArContactUsAdmin::render('/admin/_prompt.php', array(
                    'promptConfig' => $promptConfig,
                    'mobilePromptConfig' => $mobilePromptConfig,
                    'activeSubmit' => $activeSubmit
                )) ?>
                <?php echo ArContactUsAdmin::render('/admin/_items.php', array(
                    'items' => $items,
                    'buttonConfig' => $buttonConfig,
                )) ?>
                <?php echo ArContactUsAdmin::render('/admin/_prompt_items.php', array(
                    'items' => $promptItems
                )) ?>
                <?php echo ArContactUsAdmin::render('/admin/_data.php', array(
                    'activeSubmit' => $activeSubmit
                )) ?>
                <?php echo ArContactUsAdmin::render('/admin/_about.php', array(
                    'activated' => $activated
                )) ?>
                <span class="hidden"></span>
            </div>
        </div>
    </div>
</div>

<div class="ui modal small" id="arcontactus-prompt-modal">
    <i class="close icon"></i>
    <div class="header" id="arcontactus-prompt-modal-title">
        <?php echo __('Add item', 'ar-contactus') ?>
    </div>
    <form id="arcontactus-prompt-form" method="POST" onsubmit="arCU.prompt.save(); return false;">
        <input type="hidden" id="arcontactus_prompt_id" name="id" data-serializable="true" autocomplete="off" data-default=""/>
        <div class="ui form" style="padding: 20px;">
            <div class="ui grid">
                <div class="row">
                    <div class="two wide column">
                    </div>
                    <div class="twelve wide column">
                        <div class="field required">
                            <label><?php echo __('Message', 'ar-contactus') ?></label>
                            <textarea placeholder="" rows="3" id="arcontactus_prompt_message" data-default="" autocomplete="off" data-serializable="true" name="message" type="text"></textarea>
                            <div class="errors"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="actions">
            <button type="button" class="button-large black deny button">
                <?php echo __('Cancel', 'ar-contactus') ?>
            </button>
            <button type="submit" class="button button-primary button-large icon">
                <?php echo __('Save', 'ar-contactus') ?>
                <i class="checkmark icon"></i>
            </button>
        </div>
    </form>
</div>

<div class="ui modal small" id="arcontactus-modal">
    <i class="close icon"></i>
    <div class="header" id="arcontactus-modal-title">
        <?php echo __('Add item', 'ar-contactus') ?>
    </div>
    <form id="arcontactus-form" method="POST" onsubmit="arCU.save(); return false;">
        <input type="hidden" id="arcontactus_id" name="id" data-serializable="true" autocomplete="off" data-default=""/>
        <div class="ui form" style="padding: 20px;">
            <div class="ui grid">
                <div class="row">
                    <div class="two wide column">
                    </div>
                    <div class="twelve wide column">
                        <div class="field required">
                            <label><?php echo __('Title', 'ar-contactus') ?></label>
                            <input placeholder="" id="arcontactus_title" data-default="" data-serializable="true" name="title" type="text">
                            <div class="errors"></div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="two wide column">
                    </div>
                    <div class="twelve wide column">
                        <div class="field">
                            <label><?php echo __('Subtitle', 'ar-contactus') ?></label>
                            <input placeholder="" id="arcontactus_subtitle" data-default="" data-serializable="true" name="subtitle" type="text">
                            <div class="errors"></div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="two wide column"></div>
                    <div class="twelve wide column">
                        <div class="field required">
                            <label><?php echo __('Icon', 'ar-contactus') ?></label>
                            <div class="ui fluid selection search dropdown iconed" id="arcontactus-icon-dropdown">
                                <input name="icon" onchange="arContactUsIconChanged()" id="arcontactus_icon" data-default="" autocomplete="off" data-serializable="true" type="hidden">
                                <i class="dropdown icon"></i>
                                <div class="default text"><?php echo __('Select icon', 'ar-contactus') ?></div>
                                <div class="menu">
                                    <?php foreach (ArContactUsConfigModel::getIcons() as $key => $svg){?>
                                        <div class="item" data-value="<?php echo $key ?>">
                                            <?php echo $svg ?>
                                            <?php echo $key ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="errors"></div>
                        </div>
                    </div>
                </div>
                
                <div class="row hidden" id="arcu-fa5">
                    <div class="two wide column"></div>
                    <div class="twelve wide column">
                        <div class="field">
                            <label><?php echo __('FontAwesome icon', 'ar-contactus') ?></label>
                            <input placeholder="&#x3C;i class=&#x22;fab fa-font-awesome-flag&#x22;&#x3E;&#x3C;/i&#x3E;" id="arcontactus_fa_icon" data-default="" data-serializable="true" name="fa_icon" type="text">
                            <div class="errors"></div>
                            <div class="help-block">
                                <?php echo sprintf(__('You can use FontAwesome5 icon. Please find needed icon here %s', 'ar-contactus'), '<a target="_blank" href="https://fontawesome.com/icons?d=gallery">https://fontawesome.com/icons</a>') ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="two wide column"></div>
                    <div class="twelve wide column">
                        <div class="field required">
                            <label><?php echo __('Color', 'ar-contactus') ?></label>
                            <div style="width: 60%; float: left; padding: 0 3px 0 0">
                                <input class="jscolor" id="arcontactus_color" data-jscolor="{value:'000000'}" data-default="000000" autocomplete="off" data-serializable="true" name="color" type="text">
                                <div class="errors"></div>
                            </div>
                            <div style="width: 40%; float: left;">
                                <select style="margin: 0; height: 38px" id="arcontactus_brand_color" class="form-control arcontactus-control" data-default="0">
                                    <option value="0" disabled=""><?php echo __('Brand color', 'ar-contactus') ?></option>
                                    <?php foreach($brandColors as $brand => $color){?>
                                        <option value="<?php echo $color ?>"><?php echo $brand ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="two wide column">
                    </div>
                    <div class="twelve wide column">
                        <div class="field required">
                            <label><?php echo __('Display options', 'ar-contactus') ?></label>
                            <div style="width: 50%; float: left; padding: 0 3px 0 0">
                                <select id="arcontactus_display" name="display" class="form-control arcontactus-control" data-serializable="true" data-default="1">
                                    <option value="1"><?php echo __('Desktop and mobile', 'ar-contactus') ?></option>
                                    <option value="2"><?php echo __('Desktop only', 'ar-contactus') ?></option>
                                    <option value="3"><?php echo __('Mobile only', 'ar-contactus') ?></option>
                                </select>
                                <div class="errors"></div>
                            </div>
                            <div style="width: 50%; float: left;">
                                <select id="arcontactus_registered_only" name="registered_only" class="form-control arcontactus-control" data-serializable="true" data-default="0">
                                    <option value="0"><?php echo __('All users', 'ar-contactus') ?></option>
                                    <option value="1"><?php echo __('Logged-in users only', 'ar-contactus') ?></option>
                                    <option value="2"><?php echo __('Not logged-in users only', 'ar-contactus') ?></option>
                                </select>
                                <div class="errors"></div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="two wide column">
                    </div>
                    <div class="twelve wide column">
                        <div class="field required">
                            <label><?php echo __('Action', 'ar-contactus') ?></label>
                            <select id="arcontactus_type" name="type" class="form-control arcontactus-control" data-serializable="true" data-default="0">
                                <option value="0"><?php echo __('Link', 'ar-contactus') ?></option>
                                <option value="1"><?php echo __('Integration', 'ar-contactus') ?></option>
                                <option value="2"><?php echo __('Custom JS code', 'ar-contactus') ?></option>
                                <option value="3"><?php echo __('Callback form', 'ar-contactus') ?></option>
                                <option value="4"><?php echo __('Custom popup', 'ar-contactus') ?></option>
                            </select>
                            <div class="errors"></div>
                        </div>
                    </div>
                </div>
                
                <div class="row arcu-link-group">
                    <div class="two wide column">
                    </div>
                    <div class="twelve wide column">
                        <div class="field required">
                            <label><?php echo __('Link', 'ar-contactus') ?> 
                                <a target="_blank" href="https://plugins.areama.net/ar-contactus/docs/deeplinks.php"><small style="font-weight: normal"><?php echo __('Deeplink examples', 'ar-contactus') ?></small></a>
                            </label>
                            <input placeholder="" id="arcontactus_link" data-default="" autocomplete="off" data-serializable="true" name="link" type="text">
                            <div class="errors"></div>
                            <div class="help-block">
                                <?php echo sprintf(__('You can set absolute or relative URL. Also you can use %scallback%s tag to generate callback request form.', 'ar-contactus'), '<b>', '</b>') ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row arcu-link-group">
                    <div class="two wide column">
                    </div>
                    <div class="twelve wide column">
                        <div class="field required">
                            <label><?php echo __('Target', 'ar-contactus') ?></label>
                            <select id="arcontactus_target" name="target" class="form-control arcontactus-control" data-serializable="true" data-default="0">
                                <option value="0"><?php echo __('New window', 'ar-contactus') ?></option>
                                <option value="1"><?php echo __('Same window', 'ar-contactus') ?></option>
                            </select>
                            <div class="errors"></div>
                        </div>
                    </div>
                </div>
                
                <div class="row arcu-content-group" id="arcu-content-group">
                    <div class="two wide column">
                    </div>
                    <div class="twelve wide column">
                        <div class="field required">
                            <label><?php echo __('Content', 'ar-contactus') ?></label>
                            <textarea class="wp-editor-area" rows="6" tabindex="2" autocomplete="off" data-serializable="true" data-default="" name="content" id="arcontactus_content" aria-hidden="false"></textarea>
                            <div class="errors"></div>
                        </div>
                    </div>
                </div>
                
                <div class="row" id="arcu-integration-group">
                    <div class="two wide column">
                    </div>
                    <div class="twelve wide column">
                        <div class="field required">
                            <label><?php echo __('Integration', 'ar-contactus') ?></label>
                            <select id="arcontactus_integration" name="integration" class="form-control arcontactus-control" data-serializable="true" data-default="0">
                                <?php foreach ($integrations as $id => $integration) {?>
                                    <option value="<?php echo $id ?>"><?php echo $integration ?></option>
                                <?php } ?>
                            </select>
                            <div class="errors"></div>
                        </div>
                    </div>
                </div>
                
                <div class="row" id="arcu-js-group">
                    <div class="two wide column">
                    </div>
                    <div class="twelve wide column">
                        <div class="field">
                            <label><?php echo __('Custom JS code', 'ar-contactus') ?></label>
                            <textarea placeholder="" rows="3" id="arcontactus_js" data-default="" autocomplete="off" data-serializable="true" name="js" type="text"></textarea>
                            <div class="errors"></div>
                            <div class="help-block">
                                <?php echo __('JavaScript code to run onclick. Please type here JavaScript code without <b>&lt;script&gt;</b> tag.', 'ar-contactus') ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row hidden" id="arcu-shortcode-group">
                    <div class="two wide column">
                    </div>
                    <div class="twelve wide column">
                        <div class="field">
                            <label><?php echo __('Shortcode', 'ar-contactus') ?></label>
                            <input placeholder="" rows="3" readonly=""id="arcontactus_shortcode" class="disabled" data-default="" autocomplete="off" type="text" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="actions">
            <button type="button" class="button-large black deny button">
                <?php echo __('Cancel', 'ar-contactus') ?>
            </button>
            <button type="submit" class="button button-primary button-large icon">
                <?php echo __('Save', 'ar-contactus') ?>
                <i class="checkmark icon"></i>
            </button>
        </div>
    </form>
</div>

<script>
    window.addEventListener('load', function(){
        if (jQuery.fn.dropdown && jQuery.fn.dropdown.noConflict){
            jQuery.fn.bsDropdown = jQuery.fn.dropdown.noConflict();
        }
        
        jQuery('#arcontactus-plugin-container .menu .item').uiTab();
        jQuery('#arcontactus-plugin-container .ui.dropdown').dropdown();
        
        arCU.ajaxUrl = ajaxurl;
        arCU.nonce = '<?php echo wp_create_nonce('arcontactus-key') ?>';
        arCU.editTitle = '<?php echo __('Edit item', 'ar-contactus') ?>';
        arCU.addTitle = '<?php echo __('Add item', 'ar-contactus') ?>';
        arCU.init();
        arCU.callback.updateCounter();
        setInterval(function(){
            arCU.callback.updateCounter();
        }, 5000);
        jQuery('#acrontactus-menu a').on('click', function(){
            var target = jQuery(this).data('target');
            if (!target){
                return true;
            }
            jQuery('#acrontactus-menu .active').removeClass('active');
            jQuery(this).addClass('active');
            jQuery('.arconfig-panel').addClass('hidden');
            jQuery(target).removeClass('hidden');
        });
        jQuery('.ui.checkbox').checkbox();
        jQuery('#arcontactus-tabs').addClass('active');
        arContactUsSwitchFields();
        jQuery('.ui.toggle.checkbox').on('click', function(){
            arContactUsSwitchFields();
        });
        
        jQuery('#arcontactus_type').change(function(){
            arcontactusChangeType();
        });
        jQuery('#arcontactus_brand_color').change(function(){
            jQuery('#arcontactus_color').val(jQuery(this).val());
            document.getElementById('arcontactus_color').jscolor.importColor();
        });
        jQuery('#ARCUMB_POSITION').change(function(){
            arcontactusMobilePositionChange();
        });
        
        jQuery('#ARCUM_MENU_STYLE').change(function(){
            arcontactusChangeMenuStyle();
        });
        
        arcontactusMobilePositionChange();
        arcontactusChangeType();
        arcontactusChangeMenuStyle();
    });
    
    function arcontactusChangeMenuStyle(){
        if (jQuery('#ARCUM_MENU_STYLE').val() == '0'){
            jQuery('#ArContactUsConfigMenu .field_item_border_style, #ArContactUsConfigMenu .field_item_border_color, #ArContactUsConfigMenu .field_menu_header_on, #ArContactUsConfigMenu .field_menu_header, #ArContactUsConfigMenu .field_header_close, #ArContactUsConfigMenu .field_header_close_bg, #ArContactUsConfigMenu .field_header_close_color').removeClass('hidden');
            arContactUsSwitchFields();
        }else{
            jQuery('#ArContactUsConfigMenu .field_item_border_style, #ArContactUsConfigMenu .field_item_border_color, #ArContactUsConfigMenu .field_menu_header_on, #ArContactUsConfigMenu .field_menu_header, #ArContactUsConfigMenu .field_header_close, #ArContactUsConfigMenu .field_header_close_bg, #ArContactUsConfigMenu .field_header_close_color').addClass('hidden');
        }
    }
    
    function arcontactusMobilePositionChange(){
        if (jQuery('#ARCUMB_POSITION').val() == 'storefront') {
            jQuery('#ArContactUsConfigMobileButton .field_x_offset, #ArContactUsConfigMobileButton .field_y_offset, #ArContactUsConfigMobileButton .field_pulsate_speed, #ArContactUsConfigMobileButton .field_icon_animation_pause, #ArContactUsConfigMobileButton .field_button_size, #ArContactUsConfigMobileButton .field_icon_speed, #ArContactUsConfigMobileButton .field_text, #ArContactUsConfigMobileButton .field_drag').addClass('hidden');
            jQuery('#ArContactUsConfigMobileButton .field_storefront_pos').removeClass('hidden');
        } else {
            jQuery('#ArContactUsConfigMobileButton .field_x_offset, #ArContactUsConfigMobileButton .field_y_offset, #ArContactUsConfigMobileButton .field_pulsate_speed, #ArContactUsConfigMobileButton .field_icon_animation_pause, #ArContactUsConfigMobileButton .field_button_size, #ArContactUsConfigMobileButton .field_icon_speed, #ArContactUsConfigMobileButton .field_text, #ArContactUsConfigMobileButton .field_drag').removeClass('hidden');
            jQuery('#ArContactUsConfigMobileButton .field_storefront_pos').addClass('hidden');
        }
    }
    
    function arContactUsIconChanged(){
        if (jQuery('#arcontactus_icon').val() == 'FontAwesome icon') {
            jQuery('#arcu-fa5').removeClass('hidden');
        }else{
            jQuery('#arcu-fa5').addClass('hidden');
        }
    }
    
    function arcontactusChangeType(){
        var val = jQuery('#arcontactus_type').val();
        jQuery('#arcu-js-group').removeClass('hidden');
        switch(val){
            case "0": // link
                jQuery('.arcu-link-group').removeClass('hidden');
                //jQuery('#arcu-js-group').addClass('hidden');
                jQuery('#arcu-integration-group').addClass('hidden');
                jQuery('#arcu-content-group').addClass('hidden');
                break;
            case "1": // integration
                jQuery('.arcu-link-group').addClass('hidden');
                //jQuery('#arcu-js-group').addClass('hidden');
                jQuery('#arcu-integration-group').removeClass('hidden');
                jQuery('#arcu-content-group').addClass('hidden');
                break;
            case "2": // js
                jQuery('.arcu-link-group').addClass('hidden');
                //jQuery('#arcu-js-group').removeClass('hidden');
                jQuery('#arcu-integration-group').addClass('hidden');
                jQuery('#arcu-content-group').addClass('hidden');
                break;
            case "3": // callback
                jQuery('.arcu-link-group').addClass('hidden');
                //jQuery('#arcu-js-group').addClass('hidden');
                jQuery('#arcu-integration-group').addClass('hidden');
                jQuery('#arcu-content-group').addClass('hidden');
                break;
            case "4": // content
                jQuery('.arcu-link-group').addClass('hidden');
                jQuery('#arcu-js-group').addClass('hidden');
                jQuery('#arcu-integration-group').addClass('hidden');
                jQuery('#arcu-content-group').removeClass('hidden');
                break;
        }
    }
    
    function arContactUsSwitchFields(){
        if (jQuery('.field_email #ARCUP_EMAIL').is(':checked')){
            jQuery('.field_email_list').removeClass('hidden');
        }else{
            jQuery('.field_email_list').addClass('hidden');
        }
        if (jQuery('.field_recaptcha #ARCUP_RECAPTCHA').is(':checked')){
            jQuery('.field_key, .field_secret, .field_hide_recaptcha').removeClass('hidden');
        }else{
            jQuery('.field_key, .field_secret, .field_hide_recaptcha').addClass('hidden');
        }
        if (jQuery('.field_onesignal #ARCUP_ONESIGNAL').is(':checked')){
            jQuery('.field_onesignal_app_id, .field_onesignal_api_key, .field_onesignal_title, .field_onesignal_message').removeClass('hidden');
        }else{
            jQuery('.field_onesignal_app_id, .field_onesignal_api_key, .field_onesignal_title, .field_onesignal_message').addClass('hidden');
        }
        if (jQuery('.field_loop #ARCUPR_LOOP').is(':checked')){
            jQuery('.field_close_last').addClass('hidden');
        }else{
            jQuery('.field_close_last').removeClass('hidden');
        }
        
        if (jQuery('.field_twilio #ARCUP_TWILIO').is(':checked')){
            jQuery('.field_twilio_api_key, .field_twilio_auth_token, .field_twilio_phone, .field_twilio_tophone, .field_twilio_message').removeClass('hidden');
        }else{
            jQuery('.field_twilio_api_key, .field_twilio_auth_token, .field_twilio_phone, .field_twilio_tophone, .field_twilio_message').addClass('hidden');
        }
        
        if (jQuery('#ARCUL_TAWK_TO_ON').is(':checked')){
            jQuery('.field_tawk_to_site_id, .field_tawk_to_userinfo, .field_tawk_to_widget').removeClass('hidden');
        }else{
            jQuery('.field_tawk_to_site_id, .field_tawk_to_userinfo, .field_tawk_to_widget').addClass('hidden');
        }
        
        if (jQuery('#ARCUL_CRISP_ON').is(':checked')){
            jQuery('.field_crisp_site_id').removeClass('hidden');
        }else{
            jQuery('.field_crisp_site_id').addClass('hidden');
        }
        
        if (jQuery('#ARCUL_INTERCOM_ON').is(':checked')){
            jQuery('.field_intercom_app_id').removeClass('hidden');
        }else{
            jQuery('.field_intercom_app_id').addClass('hidden');
        }
        
        if (jQuery('#ARCUL_FB_ON').is(':checked')){
            jQuery('.field_fb_page_id, .field_fb_init, .field_fb_lang, .field_fb_color').removeClass('hidden');
        }else{
            jQuery('.field_fb_page_id, .field_fb_init, .field_fb_lang, .field_fb_color').addClass('hidden');
        }
        
        if (jQuery('#ARCUL_VK_ON').is(':checked')){
            jQuery('.field_vk_page_id').removeClass('hidden');
        }else{
            jQuery('.field_vk_page_id').addClass('hidden');
        }
        
        if (jQuery('#ARCUL_ZOPIM_ON').is(':checked')){
            jQuery('.field_zopim_id, .field_zopim_userinfo').removeClass('hidden');
        }else{
            jQuery('.field_zopim_id, .field_zopim_userinfo').addClass('hidden');
        }
        
        if (jQuery('#ARCUL_SKYPE_ON').is(':checked')){
            jQuery('.field_skype_type, .field_skype_id, .field_skype_message_color').removeClass('hidden');
        }else{
            jQuery('.field_skype_type, .field_skype_id, .field_skype_message_color').addClass('hidden');
        }
        
        if (jQuery('#ARCUL_ZALO_ON').is(':checked')){
            jQuery('.field_zalo_id, .field_zalo_welcome, .field_zalo_width, .field_zalo_height').removeClass('hidden');
        }else{
            jQuery('.field_zalo_id, .field_zalo_welcome, .field_zalo_width, .field_zalo_height').addClass('hidden');
        }
        
        if (jQuery('#ARCUL_ZALO_ON').is(':checked')){
            jQuery('.field_zalo_id, .field_zalo_userinfo, .field_zalo_welcome, .field_zalo_width, .field_zalo_height').removeClass('hidden');
        }else{
            jQuery('.field_zalo_id, .field_zalo_userinfo, .field_zalo_welcome, .field_zalo_width, .field_zalo_height').addClass('hidden');
        }
        
        if (jQuery('#ARCUL_LHC_ON').is(':checked')){
            jQuery('.field_lhc_uri, .field_lhc_width, .field_lhc_height, .field_lhc_popup_width, .field_lhc_popup_height').removeClass('hidden');
        }else{
            jQuery('.field_lhc_uri, .field_lhc_width, .field_lhc_height, .field_lhc_popup_width, .field_lhc_popup_height').addClass('hidden');
        }
        
        if (jQuery('#ARCUL_SS_ON').is(':checked')){
            jQuery('.field_ss_key, .field_ss_userinfo').removeClass('hidden');
        }else{
            jQuery('.field_ss_key, .field_ss_userinfo').addClass('hidden');
        }
        
        if (jQuery('#ARCUL_LC_ON').is(':checked')){
            jQuery('.field_lc_key, .field_lc_userinfo').removeClass('hidden');
        }else{
            jQuery('.field_lc_key, .field_lc_userinfo').addClass('hidden');
        }
        
        if (jQuery('#ARCUL_LCP_ON').is(':checked')){
            jQuery('.field_lcp_uri').removeClass('hidden');
        }else{
            jQuery('.field_lcp_uri').addClass('hidden');
        }
        
        if (jQuery('#ARCUL_LZ_ON').is(':checked')){
            jQuery('.field_lz_id').removeClass('hidden');
        }else{
            jQuery('.field_lz_id').addClass('hidden');
        }
        
        if (jQuery('#ARCUL_TIDIO_ON').is(':checked')){
            jQuery('.field_tidio_key, .field_tidio_userinfo').removeClass('hidden');
        }else{
            jQuery('.field_tidio_key, .field_tidio_userinfo').addClass('hidden');
        }
        
        if (jQuery('#ARCUL_JIVOSITE_ON').is(':checked')){
            jQuery('.field_jivosite_id, .field_jivosite_userinfo').removeClass('hidden');
        }else{
            jQuery('.field_jivosite_id, .field_jivosite_userinfo').addClass('hidden');
        }
        
        if (jQuery('#ARCUP_PHONE_MASK_ON').is(':checked')){
            jQuery('.field_maskedinput, .field_phone_mask').removeClass('hidden');
        }else{
            jQuery('.field_maskedinput, .field_phone_mask').addClass('hidden');
        }
        
        if (jQuery('#ARCUP_GDPR').is(':checked')){
            jQuery('.field_gdpr_title').removeClass('hidden');
        }else{
            jQuery('.field_gdpr_title').addClass('hidden');
        }
        
        if (jQuery('#ARCUP_NAME').is(':checked')){
            jQuery('.field_name_required, .field_name_title, .field_name_placeholder').removeClass('hidden');
        }else{
            jQuery('.field_name_required, .field_name_title, .field_name_placeholder').addClass('hidden');
        }
        
        if (jQuery('#ARCUP_TG').is(':checked')){
            jQuery('.field_tg_token, .field_tg_chat_id, .field_tg_text').removeClass('hidden');
        }else{
            jQuery('.field_tg_token, .field_tg_chat_id, .field_tg_text').addClass('hidden');
        }
        
        if (jQuery('#ARCUM_MENU_HEADER_ON').is(':checked')){
            jQuery('#ArContactUsConfigMenu .field_menu_header, #ArContactUsConfigMenu .field_header_close, #ArContactUsConfigMenu .field_header_close_bg, #ArContactUsConfigMenu .field_header_close_color').removeClass('hidden');
        }else{
            jQuery('#ArContactUsConfigMenu .field_menu_header, #ArContactUsConfigMenu .field_header_close, #ArContactUsConfigMenu .field_header_close_bg, #ArContactUsConfigMenu .field_header_close_color').addClass('hidden');
        }
        
        if (jQuery('#ARCUMM_MENU_HEADER_ON').is(':checked')){
            jQuery('#ArContactUsConfigMobileMenu .field_menu_header,#ArContactUsConfigMobileMenu .field_header_close, #ArContactUsConfigMobileMenu .field_header_close_bg, #ArContactUsConfigMobileMenu .field_header_close_color').removeClass('hidden');
        }else{
            jQuery('#ArContactUsConfigMobileMenu .field_menu_header,#ArContactUsConfigMobileMenu .field_header_close, #ArContactUsConfigMobileMenu .field_header_close_bg, #ArContactUsConfigMobileMenu .field_header_close_color').addClass('hidden');
        }
        
        if (jQuery('#ARCUG_SANDBOX').is(':checked')){
            jQuery('.field_allowed_ips').removeClass('hidden');
        }else{
            jQuery('.field_allowed_ips').addClass('hidden');
        }
    }
</script>