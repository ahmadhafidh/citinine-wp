<?php if ($generalConfig->ga_account && $generalConfig->ga_script){ ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $generalConfig->ga_account ?>"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '<?php echo $generalConfig->ga_account ?>');
</script>
<?php } ?>
<?php if (!empty($generatedCss)){?>
<style type="text/css">
    <?php echo $generatedCss ?>
</style>
<?php } ?>
<div id="arcontactus"></div>
<?php foreach ($items as $item){?>
    <?php if ($item['type'] == 4){?>
        <div id="arcu-popup-content-<?php echo $item['id'] ?>" class="arcu-popup-html">
            <?php echo $item['content'] ?>
        </div>
    <?php } ?>
<?php } ?>
<script src="<?php echo AR_CONTACTUS_PLUGIN_URL ?>res/js/jquery.contactus.min.js?version=<?php echo AR_CONTACTUS_VERSION ?>"></script>
<?php if ($popupConfig->phone_mask_on && $popupConfig->maskedinput){?>
    <script src="<?php echo AR_CONTACTUS_PLUGIN_URL ?>res/js/jquery.maskedinput.min.js?version=<?php echo AR_CONTACTUS_VERSION ?>"></script>
<?php } ?>
<?php if ($vkChat){ ?>
    <script type="text/javascript" src="https://vk.com/js/api/openapi.js?157"></script>
    <?php if (!$isMobile) {?>
        <style type="text/css">
            #vk_community_messages{
                <?php if ($buttonConfig->position == 'right') { ?>
                    right: -10px !important;
                <?php }else{ ?>
                    left: -10px !important;
                <?php } ?>
            }
        </style>
    <?php } ?>
    <div id="vk_community_messages"></div>
<?php } ?>
<?php if ($skype) { ?>
    <script src="https://swc.cdn.skype.com/sdk/v1/sdk.min.js"></script>
    <div 
        class="skype-chat" 
        id="arcontactus-skype"
        style="display: none"
        data-can-close="true" 
        data-can-collapse="true"
        data-can-upload-file="true"
        data-show-header="true"
        data-entry-animation="true"
        <?php if ($liveChatsConfig->skype_type == 'skype') {?>
            data-contact-id="<?php echo $liveChatsConfig->skype_id ?>" 
        <?php }else{ ?>
            data-bot-id="<?php echo $liveChatsConfig->skype_id ?>"
        <?php } ?>
        data-color-message="#<?php echo $liveChatsConfig->skype_message_color ?>"
    ></div>
<?php } ?>
<?php if ($zalo) { ?>
    <div id="ar-zalo-chat-widget">
        <div class="zalo-chat-widget" data-oaid="<?php echo $liveChatsConfig->zalo_id ?>" data-welcome-message="<?php echo $liveChatsConfig->zalo_welcome ?>" data-autopopup="0" data-width="<?php echo (int)$liveChatsConfig->zalo_width ?>" data-height="<?php echo (int)$liveChatsConfig->zalo_height ?>"></div>
    </div>
    <script src="https://sp.zalo.me/plugins/sdk.js"></script>
<?php } ?>
<?php if ($tidio){ ?>
    <?php if ($liveChatsConfig->tidio_userinfo){ ?>
        <script>
            document.tidioIdentify = {
                email: '<?php echo $user->user_email ?>',
                name: "<?php echo $user->user_firstname . ' ' . $user->user_lastname ?>"
            };
        </script>
    <?php } ?>
    <script src="//code.tidio.co/<?php echo $liveChatsConfig->tidio_key ?>.js"></script>
<?php } ?>
<?php if ($jivosite){?>
    <script src="//code.jivosite.com/widget.js" data-jv-id="<?php echo $liveChatsConfig->jivosite_id ?>" async></script>
<?php } ?>
<script type="text/javascript">
    var zaloWidgetInterval;
    var tawkToInterval;
    var skypeWidgetInterval;
    var lcpWidgetInterval;
    var closePopupTimeout;
    var lzWidgetInterval;
    <?php if ($promptConfig->enable_prompt && $messages){?>
        var arCuMessages = <?php echo json_encode($messages) ?>;
        var arCuLoop = <?php echo $promptConfig->loop? 'true' : 'false' ?>;;
        var arCuCloseLastMessage = <?php echo $promptConfig->close_last? 'true' : 'false' ?>;
        var arCuPromptClosed = false;
        var _arCuTimeOut = null;
        var arCuDelayFirst = <?php echo (int)$promptConfig->first_delay ?>;
        var arCuTypingTime = <?php echo (int)$promptConfig->typing_time ?>;
        var arCuMessageTime = <?php echo (int)$promptConfig->message_time ?>;
        var arCuClosedCookie = 0;
    <?php } ?>
    var arcItems = [];
    <?php if ($liveChatsConfig->isTawkToIntegrated() && $tawkTo) {?>
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    <?php } ?>
    window.addEventListener('load', function(){
        <?php if ($promptConfig->show_after_close != '-1'){?>
            arCuClosedCookie = arCuGetCookie('arcu-closed');
        <?php } ?>
        jQuery('#arcontactus').on('arcontactus.init', function(){
            <?php if ($menuConfig->menu_style == '1'){?>
                jQuery('#arcontactus').addClass('no-bg');
            <?php } ?>
            <?php if ($popupConfig->phone_mask_on){?>
                jQuery.mask.definitions['#'] = "[0-9]";
                jQuery('#arcontactus .arcu-field-phone').arCuMask('<?php echo $popupConfig->phone_mask ?>');
            <?php } ?>
            <?php if ($promptConfig->enable_prompt && $messages){ ?>
                if (arCuClosedCookie){
                    return false;
                }
                arCuShowMessages();
            <?php } ?>
            <?php if ($menuConfig->auto_open){ ?>
                setTimeout(function(){
                    if (arCuGetCookie('arcumenu-closed') == 0){
                        jQuery('#arcontactus').contactUs('openMenu');
                    }
                }, <?php echo (int)$menuConfig->auto_open ?>);
            <?php } ?>
        });
        jQuery('#arcontactus').on('arcontactus.closeMenu', function(){
            arCuCreateCookie('arcumenu-closed', 1, 1);
        });
        <?php if ($promptConfig->enable_prompt && $messages){ ?>
            jQuery('#arcontactus').on('arcontactus.openMenu', function(){
                clearTimeout(_arCuTimeOut);
                if (!arCuPromptClosed){
                    arCuPromptClosed = true;
                    jQuery('#arcontactus').contactUs('hidePrompt');
                }
            });
            jQuery('#arcontactus').on('arcontactus.openCallbackPopup', function(){
                clearTimeout(_arCuTimeOut);
                if (!arCuPromptClosed){
                    arCuPromptClosed = true;
                    jQuery('#arcontactus').contactUs('hidePrompt');
                }
            });

            jQuery('#arcontactus').on('arcontactus.hidePrompt', function(){
                clearTimeout(_arCuTimeOut);
                if (arCuClosedCookie != "1"){
                    arCuClosedCookie = "1";
                    <?php if ($promptConfig->show_after_close != '-1'){?>
                        arCuPromptClosed = true;
                        <?php if ($promptConfig->show_after_close == '0'){?>
                            arCuCreateCookie('arcu-closed', 1, 0);
                        <?php }else{ ?>
                            arCuCreateCookie('arcu-closed', 1, <?php echo ((int)$promptConfig->show_after_close) / 1440 ?>);
                        <?php } ?>
                    <?php } ?>
                }
            });
        <?php } ?>
        <?php if ($popupConfig->close_timeout) {?>
            jQuery('#arcontactus').on('arcontactus.successCallbackRequest', function(){
                closePopupTimeout = setTimeout(function(){
                    jQuery('#arcontactus').contactUs('closeCallbackPopup');
                }, <?php echo $popupConfig->close_timeout * 1000 ?>);
            });
            jQuery('#arcontactus').on('arcontactus.closeCallbackPopup', function(){
                clearTimeout(closePopupTimeout);
            })
        <?php } ?>
        <?php foreach ($items as $item){?>
            <?php if ($item['js'] && $item['type'] == ArContactUsModel::TYPE_CALLBACK){ ?>
                jQuery('#arcontactus').on('arcontactus.successCallbackRequest', function(){
                    <?php echo $item['js'] ?>
                });
            <?php } ?>
            var arcItem = {};
            <?php if ($item['id']){?>
                arcItem.id = '<?php echo $item['id'] ?>';
            <?php } ?>
            <?php if ($item['type'] == ArContactUsModel::TYPE_INTEGRATION){ ?>
                arcItem.onClick = function(e){
                    e.preventDefault();
                    jQuery('#arcontactus').contactUs('closeMenu');
                <?php if ($item['integration'] == 'tawkto'){ ?>
                    if (typeof Tawk_API == 'undefined'){
                        console.error('Tawk.to integration is disabled in module configuration');
                        return false;
                    }
                    jQuery('#arcontactus').contactUs('hide');
                    Tawk_API.showWidget();
                    Tawk_API.maximize();
                    tawkToInterval = setInterval(function(){
                        checkTawkIsOpened();
                    }, 100);
                <?php }elseif($item['integration'] == 'crisp'){ ?>
                    if (typeof $crisp == 'undefined'){
                        console.error('Crisp integration is disabled in module configuration');
                        return false;
                    }
                    jQuery('#arcontactus').contactUs('hide');
                    $crisp.push(["do", "chat:show"]);
                    $crisp.push(["do", "chat:open"]);
                <?php }elseif ($item['integration'] == 'intercom'){ ?>
                    if (typeof Intercom == 'undefined'){
                        console.error('Intercom integration is disabled in module configuration');
                        return false;
                    }
                    jQuery('#arcontactus').contactUs('hide');
                    Intercom('show');
                <?php }elseif ($item['integration'] == 'facebook'){ ?>
                    if (typeof FB == 'undefined' || typeof FB.CustomerChat == 'undefined'){
                        console.error('Facebook customer chat integration is disabled in module configuration');
                        return false;
                    }
                    jQuery('#arcontactus').contactUs('hide');
                    jQuery('#ar-fb-chat').addClass('active');
                    FB.CustomerChat.showDialog();
                <?php }elseif ($item['integration'] == 'vk'){ ?>
                    if (typeof vkMessagesWidget == 'undefined'){
                        console.error('VK chat integration is disabled in module configuration');
                        return false;
                    }
                    vkMessagesWidget.expand();
                <?php }elseif ($item['integration'] == 'zopim'){ ?>
                    <?php if ($liveChatsConfig->isZendeskChat()) {?>
                        if (typeof zE == 'undefined'){
                            console.error('Zendesk integration is disabled in module configuration');
                            return false;
                        }
                        zE('webWidget', 'show');
                        zE('webWidget', 'open');
                    <?php }else{ ?>
                        if (typeof $zopim == 'undefined'){
                            console.error('Zendesk integration is disabled in module configuration');
                            return false;
                        }
                        $zopim.livechat.window.show();
                    <?php } ?>
                    jQuery('#arcontactus').contactUs('hide');
                <?php }elseif ($item['integration'] == 'skype'){ ?>
                    e.preventDefault();
                    jQuery('#arcontactus').contactUs('closeMenu');
                    jQuery('#arcontactus-skype').show();
                    SkypeWebControl.SDK.Chat.showChat();
                    SkypeWebControl.SDK.Chat.startChat({
                        ConversationId: '<?php echo $liveChatsConfig->skype_id ?>',
                        ConversationType: 'agent'
                    });
                    skypeWidgetInterval = setInterval(function(){
                        checkSkypeIsOpened();
                    }, 100);
                    jQuery('#arcontactus').contactUs('hide');
                <?php }elseif ($item['integration'] == 'zalo'){ ?>
                    if (typeof ZaloSocialSDK == 'undefined'){
                        console.error('Zalo integration is disabled in module configuration');
                        return false;
                    }
                    jQuery('#ar-zalo-chat-widget').addClass('active');
                    ZaloSocialSDK.openChatWidget();
                    zaloWidgetInterval = setInterval(function(){
                        checkZaloIsOpened();
                    }, 100);
                    jQuery('#arcontactus').contactUs('hide');
                <?php }elseif ($item['integration'] == 'lhc'){ ?>
                    if (typeof lh_inst == 'undefined'){
                        console.error('Live Helper Chat integration is disabled in module configuration');
                        return false;
                    }
                    jQuery('#arcontactus').contactUs('hide');
                    lh_inst.lh_openchatWindow();
                <?php }elseif ($item['integration'] == 'smartsupp'){ ?>
                    if (typeof smartsupp == 'undefined'){
                        console.error('Smartsupp chat integration is disabled in module configuration');
                        return false;
                    }
                    jQuery('#arcontactus').contactUs('hide');
                    jQuery('#chat-application').addClass('active');
                    smartsupp('chat:open');
                    ssInterval = setInterval(function(){
                        checkSSIsOpened();
                    }, 100);
                <?php }elseif ($item['integration'] == 'livechat'){?>
                    if (typeof LC_API == 'undefined'){
                        console.error('Live Chat integration is disabled in module configuration');
                        return false;
                    }
                    jQuery('#arcontactus').contactUs('hide');
                    LC_API.open_chat_window();
                <?php }elseif ($item['integration'] == 'livechatpro'){?>
                    if (typeof phpLiveChat == 'undefined'){
                        console.error('Live Chat Pro integration is disabled in module configuration');
                        return false;
                    }
                    <?php if (!$isMobile) {?>
                        jQuery('#arcontactus').contactUs('hide');
                    <?php } ?>
                    jQuery('#customer-chat-iframe').addClass('active');
                    setTimeout(function(){
                        lcpWidgetInterval = setInterval(function(){
                            checkLCPIsOpened();
                        }, 100);
                    }, 500);
                    phpLiveChat.show();
                <?php }elseif ($item['integration'] == 'livezilla'){?>
                    if (typeof OverlayChatWidgetV2 == 'undefined'){
                        console.error('Live Zilla integration is disabled in module configuration');
                        return false;
                    }
                    jQuery('#arcontactus').contactUs('hide');
                    jQuery('#lz_overlay_wm').addClass('active');
                    OverlayChatWidgetV2.Show();
                    lzWidgetInterval = setInterval(function(){
                        checkLZIsOpened();
                    }, 100);
                <?php }elseif ($item['integration'] == 'tidio'){?>
                    if (typeof tidioChatApi == 'undefined'){
                        console.error('Tidio integration is disabled in module configuration');
                        return false;
                    }
                    jQuery('#arcontactus').contactUs('hide');
                    tidioChatApi.show();
                    tidioChatApi.open();
                <?php }elseif ($item['integration'] == 'jivosite'){?>
                    if (typeof jivo_api == 'undefined'){
                        console.error('Jivosite integration is disabled in module configuration');
                        return false;
                    }
                    jQuery('#arcontactus').contactUs('hide');
                    jivo_api.open();
                <?php } ?>
                <?php if ($item['js']){ ?>
                    <?php echo $item['js'] ?>
                <?php } ?>
                }
            <?php }elseif ($item['type'] == ArContactUsModel::TYPE_CONTENT){ ?>
                arcItem.href = '_popup';
                arcItem.popupContent = jQuery('#arcu-popup-content-<?php echo $item['id'] ?>').html();
                jQuery('#arcu-popup-content-<?php echo $item['id'] ?>').remove();
            <?php }elseif ($item['js']){ ?>
                arcItem.onClick = function(e){
                    <?php if ($item['type'] == ArContactUsModel::TYPE_JS){ ?>
                        e.preventDefault();                        
                    <?php } ?>
                    <?php echo $item['js'] ?>
                }
            <?php } ?>
            arcItem.class = '<?php echo $item['class'] ?>';
            arcItem.title = "<?php echo $item['title'] ?>";
            <?php if ($item['subtitle']){?>
                arcItem.subTitle = "<?php echo $item['subtitle'] ?>";
            <?php } ?>
            arcItem.icon = '<?php echo $item['icon'] ?>';
            <?php if ($item['type'] == ArContactUsModel::TYPE_LINK){ ?>
                arcItem.href = '<?php echo $item['href'] ?>';
            <?php }elseif($item['type'] == ArContactUsModel::TYPE_CALLBACK){ ?>
                arcItem.href = 'callback';
            <?php } ?>
            <?php if ($item['type'] == ArContactUsModel::TYPE_LINK && $item['target'] == ArContactUsModel::TARGET_SAME_WINDOW){ ?>
                arcItem.target = '_self';
            <?php } ?>
            arcItem.color = '<?php echo $item['color'] ?>';
            arcItems.push(arcItem);
        <?php } ?>
        var arcuOptions = {
            <?php if ($buttonIcon){ ?>
                buttonIcon: '<?php echo $buttonIcon ?>',
            <?php } ?>
            drag: <?php echo $buttonConfig->drag? 'true' : 'false' ?>,
            mode: '<?php echo $buttonConfig->mode? $buttonConfig->mode : 'regular' ?>',
            buttonIconUrl: '<?php echo AR_CONTACTUS_PLUGIN_URL . 'res/img/msg.svg' ?>',
            showMenuHeader: <?php echo $menuConfig->menu_header_on? 'true' : 'false' ?>,
            menuHeaderText: "<?php echo ArContactUsTools::escJsString($menuConfig->menu_header) ?>",
            showHeaderCloseBtn: <?php echo $menuConfig->header_close? 'true' : 'false' ?>,
            <?php if (isset($menuConfig->menu_header_bg) && $menuConfig->menu_header_bg){ ?>
                headerCloseBtnBgColor: '#<?php echo $menuConfig->header_close_bg ?>',
            <?php } ?>
            <?php if ($menuConfig->header_close_bg){ ?>
                headerCloseBtnBgColor: '#<?php echo $menuConfig->header_close_bg ?>',
            <?php } ?>
            <?php if ($menuConfig->header_close_color){ ?>
                headerCloseBtnColor: '#<?php echo $menuConfig->header_close_color ?>',
            <?php } ?>
            itemsIconType: '<?php echo $menuConfig->item_style ?>',
            align: '<?php echo $buttonConfig->position ?>',
            reCaptcha: <?php echo $popupConfig->recaptcha? 'true' : 'false' ?>,
            reCaptchaKey: '<?php echo ArContactUsTools::escJsString($popupConfig->key) ?>',
            countdown: <?php echo (int)$popupConfig->timeout ?>,
            theme: '#<?php echo $buttonConfig->button_color ?>',
            <?php if ($buttonConfig->text){ ?>
                buttonText: "<?php echo ArContactUsTools::escJsString($buttonConfig->text) ?>",
            <?php }else{ ?>
                buttonText: false,
            <?php } ?>
            buttonSize: '<?php echo ArContactUsTools::escJsString($buttonConfig->button_size) ?>',
            menuSize: '<?php echo ArContactUsTools::escJsString($menuConfig->menu_size) ?>',
            phonePlaceholder: '<?php echo $popupConfig->phone_placeholder ?>',
            callbackSubmitText: '<?php echo ArContactUsTools::escJsString($popupConfig->btn_title) ?>',
            errorMessage: '<?php echo ArContactUsTools::escJsString($popupConfig->fail_message) ?>',
            callProcessText: '<?php echo ArContactUsTools::escJsString($popupConfig->proccess_message) ?>',
            callSuccessText: '<?php echo ArContactUsTools::escJsString($popupConfig->success_message) ?>',
            iconsAnimationSpeed: <?php echo (int)$buttonConfig->icon_speed ?>,
            callbackFormText: '<?php echo ArContactUsTools::escJsString($popupConfig->message) ?>',
            items: arcItems,
            ajaxUrl: '<?php echo admin_url('admin-ajax.php') ?>',
            <?php if ($promptConfig->prompt_position){?>
                promptPosition: '<?php echo $promptConfig->prompt_position ?>',
            <?php } ?>
            callbackFormFields: {
                <?php if ($popupConfig->name){?>
                name: {
                    name: 'name',
                    enabled: true,
                    required: <?php echo $popupConfig->name_required? 'true' : 'false' ?>,
                    type: 'text',
                    label: "<?php echo $popupConfig->name_title ?>",
                    placeholder: "<?php echo $popupConfig->name_placeholder ?>"
                },
                <?php } ?>
                phone: {
                    name: 'phone',
                    enabled: true,
                    required: true,
                    type: 'tel',
                    label: '',
                    placeholder: "<?php echo $popupConfig->phone_placeholder ?>"
                },
                <?php if ($popupConfig->gdpr){?>
                gdpr: {
                    name: 'gdpr',
                    enabled: true,
                    required: true,
                    type: 'checkbox',
                    label: "<?php echo $popupConfig->gdpr_title ?>",
                }
                <?php } ?>
            },
            action: 'arcontactus_request_callback'
        };
        <?php if (!$generalConfig->disable_init){?>
            <?php if ($generalConfig->delay_init){?>
                setTimeout(function(){
                    jQuery('#arcontactus').contactUs(arcuOptions);
                }, <?php echo (int)$generalConfig->delay_init ?>);
            <?php } else { ?>
                jQuery('#arcontactus').contactUs(arcuOptions);
            <?php } ?>
        <?php } ?>
        <?php if ($liveChatsConfig->isTawkToIntegrated() && $tawkTo) {?>
            Tawk_API.onLoad = function(){
                if(!Tawk_API.isChatOngoing()){
                    Tawk_API.hideWidget();
                }else{
                    jQuery('#arcontactus').contactUs('hide');
                }
            };
            Tawk_API.onChatMinimized = function(){
                Tawk_API.hideWidget();
                setTimeout(function(){
                    Tawk_API.hideWidget();
                }, 100);
                jQuery('#arcontactus').contactUs('show');
            };
            Tawk_API.onChatEnded = function(){
                Tawk_API.hideWidget();
                jQuery('#arcontactus').contactUs('show');
            };
            <?php if ($liveChatsConfig->tawk_to_userinfo && $user->ID) { ?>
                Tawk_API.visitor = {
                    name : "<?php echo $user->user_firstname . ' ' . $user->user_lastname ?>",
                    email : '<?php echo $user->user_email ?>'
                };
            <?php } ?>
            (function(){
                var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                s1.async=true;
                s1.src='https://embed.tawk.to/<?php echo $liveChatsConfig->tawk_to_site_id ?>/<?php echo $liveChatsConfig->tawk_to_widget ?>';
                s1.charset='UTF-8';
                s1.setAttribute('crossorigin','*');
                s0.parentNode.insertBefore(s1,s0);
            })();
        <?php } ?>
        <?php if ($liveChatsConfig->isFacebookChatIntegrated() && $facebook) {?>
            FB.Event.subscribe('customerchat.dialogHide', function(){
                jQuery('#ar-fb-chat').removeClass('active');
                jQuery('#arcontactus').contactUs('show');
            });
        <?php } ?>
        <?php if ($liveChatsConfig->isLhcIntegrated() && $lhc){?>
            lh_inst.chatClosedCallback = function(){
                jQuery('#arcontactus').contactUs('show');
                clearInterval(LHCInterval);
            };
            lh_inst.chatOpenedCallback = function(){
                jQuery('#arcontactus').contactUs('hide');
                LHCInterval = setInterval(function(){
                    checkLHCisOpened();
                }, 100);
            };
        <?php } ?>
        <?php if ($tidio){?>
            function onTidioChatApiReady(){
                window.tidioChatApi.hide();
            }
            function onTidioChatClose(){
                window.tidioChatApi.hide();
                jQuery('#arcontactus').contactUs('show');
            }
            if (window.tidioChatApi) {
                window.tidioChatApi.on("ready", onTidioChatApiReady);
                window.tidioChatApi.on("close", onTidioChatClose);
            }else{
                document.addEventListener("tidioChat-ready", onTidioChatApiReady);
                document.addEventListener("tidioChat-close", onTidioChatClose);
            }
        <?php } ?>
        <?php if ($generalConfig->ga_account && $generalConfig->ga_tracker){ ?>
            ga('create', '<?php echo $generalConfig->ga_account ?>', 'auto');
        <?php } ?>
    });
    <?php if ($liveChatsConfig->isCrispIntegrated() && $crisp) {?>
        window.$crisp=[];window.CRISP_WEBSITE_ID="<?php echo $liveChatsConfig->crisp_site_id ?>";(function(){
            d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);
        })();
        $crisp.push(["on", "session:loaded", function(){
            $crisp.push(["do", "chat:hide"]);
        }]);
        $crisp.push(["on", "chat:closed", function(){
            $crisp.push(["do", "chat:hide"]);
            jQuery('#arcontactus').contactUs('show');
        }]);
        $crisp.push(["on", "message:received", function(){
            $crisp.push(["do", "chat:show"]);
            jQuery('#arcontactus').contactUs('hide');
        }]);
    <?php } ?>
    <?php if ($liveChatsConfig->isIntercomIntegrated() && $intercom) {?>
        window.intercomSettings = {
            app_id: "<?php echo $liveChatsConfig->intercom_app_id ?>",
            alignment: 'right',     
            horizontal_padding: 20, 
            vertical_padding: 20
        };
        (function() {
            var w = window;
            var ic = w.Intercom;
            if (typeof ic === "function") {
                ic('reattach_activator');
                ic('update', intercomSettings);
            } else {
                var d = document;
                var i = function() {
                    i.c(arguments)
                };
                i.q = [];
                i.c = function(args) {
                    i.q.push(args)
                };
                w.Intercom = i;

                function l() {
                    var s = d.createElement('script');
                    s.type = 'text/javascript';
                    s.async = true;
                    s.src = 'https://widget.intercom.io/widget/<?php echo $liveChatsConfig->intercom_app_id ?>';
                    var x = d.getElementsByTagName('script')[0];
                    x.parentNode.insertBefore(s, x);
                }
                if (w.attachEvent) {
                    w.attachEvent('onload', l);
                } else {
                    w.addEventListener('load', l, false);
                }
            }
        })();
        Intercom('onHide', function(){
            jQuery('#arcontactus').contactUs('show');
        });
    <?php } ?>
    <?php if ($vkChat) {?>
        var vkMessagesWidget = VK.Widgets.CommunityMessages("vk_community_messages", <?php echo $liveChatsConfig->vk_page_id ?>, {
            disableButtonTooltip: 1,
            welcomeScreen: 0,
            expanded: 0,
            buttonType: 'no_button',
            widgetPosition: '<?php echo $buttonConfig->position ?>'
        });
    <?php } ?>
    <?php if ($skype){?>
        function checkSkypeIsOpened(){
            if (jQuery('#arcontactus-skype .lwc-chat-frame').hasClass('close-chat')){ 
                jQuery('#arcontactus').contactUs('show');
                clearInterval(skypeWidgetInterval);
            }
        }
    <?php } ?>
    <?php if ($lcp) {?>
        function checkLCPIsOpened(){
            console.log('checkLCPIsOpened');
            if (parseInt(jQuery('#customer-chat-iframe').css('bottom')) < -300){ 
                jQuery('#arcontactus').contactUs('show');
                jQuery('#customer-chat-iframe').removeClass('active');
                clearInterval(lcpWidgetInterval);
            }
        }
    <?php } ?>
    <?php if ($zalo) {?>
        function checkZaloIsOpened(){
            if (jQuery('#ar-zalo-chat-widget>div').height() < 100){ 
                jQuery('#ar-zalo-chat-widget').removeClass('active');
                jQuery('#arcontactus').contactUs('show');
                clearInterval(zaloWidgetInterval);
            }
        }
    <?php } ?>
    <?php if ($tawkTo) {?>
        function checkTawkIsOpened(){
            console.log('checkTawkIsOpened');
            if (Tawk_API.isChatMinimized()){ 
                Tawk_API.hideWidget();
                jQuery('#arcontactus').contactUs('show');
                clearInterval(tawkToInterval);
            }
        }
    <?php } ?>
    <?php if ($lhc){ ?>
        var LHCChatOptions = {};
        var LHCInterval = null;

        LHCChatOptions.opt = {
            widget_height: <?php echo (int)$liveChatsConfig->lhc_height ?>,
            widget_width: <?php echo (int)$liveChatsConfig->lhc_width ?>,
            popup_height: <?php echo (int)$liveChatsConfig->lhc_popup_width ?>,
            popup_width: <?php echo (int)$liveChatsConfig->lhc_popup_width ?>
        };
        (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        var refferer = (document.referrer) ? encodeURIComponent(document.referrer.substr(document.referrer.indexOf('://')+1)) : '';
        var location  = (document.location) ? encodeURIComponent(window.location.href.substring(window.location.protocol.length)) : '';
        po.src = '<?php echo $liveChatsConfig->lhc_uri ?>/chat/getstatus/(click)/internal/(ma)/br/(position)/bottom_right/(check_operator_messages)/true/(top)/350/(units)/pixels?r='+refferer+'&l='+location;
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
        
        function checkLHCisOpened(){
            if (lh_inst.isMinimized){ 
                jQuery('#arcontactus').contactUs('show');
                lh_inst.isMinimized = false;
                clearInterval(LHCInterval);
            }
        }
    <?php } ?>
    <?php if ($ss){?>
        var _smartsupp = _smartsupp || {};
        _smartsupp.key = '<?php echo $liveChatsConfig->ss_key ?>';
        window.smartsupp||(function(d) {
          var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
          s=d.getElementsByTagName('script')[0];c=d.createElement('script');
          c.type='text/javascript';c.charset='utf-8';c.async=true;
          c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
        })(document);
        <?php if ($liveChatsConfig->ss_userinfo and $user->ID){?>
            smartsupp('name', "<?php echo $user->user_firstname . ' ' . $user->user_lastname ?>");
            smartsupp('email', '<?php echo $user->user_email ?>');
            smartsupp('variables', {
                accountId: {
                    label: 'User ID',
                    value: <?php echo $user->ID ?>
                }
            });
        <?php } ?>
        var ssInterval;
        
        function checkSSIsOpened(){
            if (jQuery('#chat-application').height() < 300){ 
                smartsupp('chat:close');
                jQuery('#arcontactus').contactUs('show');
                clearInterval(ssInterval);
                jQuery('#chat-application').removeClass('active');
            }
        }
        smartsupp('on', 'message', function(model, message) {
            if (message.type == 'agent') {
                jQuery('#chat-application').addClass('active');
                smartsupp('chat:open');
                jQuery('#arcontactus').contactUs('hide');
                setTimeout(function(){
                    ssInterval = setInterval(function(){
                        checkSSIsOpened();
                    }, 100);
                }, 500);
                
            }
        });
    <?php } ?>
    <?php if ($lc){?>
        window.__lc = window.__lc || {};
        window.__lc.license = <?php echo $liveChatsConfig->lc_key ?>;
        (function() {
          var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
          lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
        })();
        var LC_API = LC_API || {};
        var livechat_chat_started = false;
        LC_API.on_before_load = function() {
            LC_API.hide_chat_window();
        };
        LC_API.on_after_load = function() {
            LC_API.hide_chat_window();
            <?php if ($liveChatsConfig->lc_userinfo && $user->ID){?>
                LC_API.set_visitor_name('<?php echo $user->user_firstname . ' ' . $user->user_lastname ?>');
                LC_API.set_visitor_email('<?php echo $user->user_email ?>');
            <?php } ?>
        };
        LC_API.on_chat_window_minimized = function(){
            LC_API.hide_chat_window();
            jQuery('#arcontactus').contactUs('show');
        };
        LC_API.on_message = function(data) {
            LC_API.open_chat_window();
            jQuery('#arcontactus').contactUs('hide');
        };
        LC_API.on_chat_started = function() {
            livechat_chat_started = true;
        };
    <?php } ?>
    <?php if ($liveZilla) {?>
        function checkLZIsOpened(){
            if (!jQuery('#lz_overlay_chat').is(':visible')){ 
                jQuery('#arcontactus').contactUs('show');
                jQuery('#lz_overlay_wm').removeClass('active');
                clearInterval(lzWidgetInterval);
            }
        }
    <?php } ?>
    <?php if ($lcp) { ?>
    (function(d,t,u,s,e){e=d.getElementsByTagName(t)[0];s=d.createElement(t);s.src=u;s.async=1;e.parentNode.insertBefore(s,e);})(document,'script','<?php echo $liveChatsConfig->lcp_uri ?>');
    <?php } ?>
    <?php if ($jivosite){?>
        <?php if ($liveChatsConfig->jivosite_userinfo){?>
            function jivo_onLoadCallback(state) {
                jivo_api.setContactInfo({
                    "name": "<?php echo $user->user_firstname . ' ' . $user->user_lastname ?>",
                    "email": "<?php echo $user->user_email ?>"
                }); 
            }
        <?php } ?>
        function jivo_onChangeState(state) {
            if (state == 'chat') {
                jQuery('.globalClass_ET').addClass('active');
                jQuery('#arcontactus').contactUs('hide');
            }
            if (state == 'call' || state == 'chat/call') {
                jQuery('.globalClass_ET').addClass('active');
                jQuery('#arcontactus').contactUs('hide');
            }
            if (state == 'label' || state == 'chat/min'){
                jQuery('.globalClass_ET').removeClass('active');
                jQuery('#arcontactus').contactUs('show');
            }
        } 
    <?php } ?>
</script>
<?php if ($liveZilla){ ?>
    <script type="text/javascript" rel="livezilla" id="<?php echo $liveChatsConfig->lz_id ?>" src="<?php echo $liveChatsConfig->lz_id ?>"></script>
<?php } ?>
<?php if ($zopim) {?>
    <?php if ($liveChatsConfig->isZendeskChat()) {?>
        <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=<?php echo $liveChatsConfig->zopim_id ?>"> </script>
        <script type="text/javascript">
            zE('webWidget:on', 'chat:connected', function(){
                zE('webWidget', 'hide');
            });
            zE('webWidget:on', 'open', function(){
                jQuery('#arcontactus').contactUs('hide');
            });
            zE('webWidget:on', 'close', function(){
                zE('webWidget', 'hide');
                jQuery('#arcontactus').contactUs('show');
            });
            zE('webWidget:on', 'chat.unreadMsgs', function(msgs){
                zE('webWidget', 'show');
                zE('webWidget', 'open');
            });
            <?php if ($liveChatsConfig->zopim_userinfo && $user->ID){ ?>
                zE('webWidget', 'identify', {
                    name: "<?php echo $user->user_firstname . ' ' . $user->user_lastname ?>",
                    email: '<?php echo $user->user_email ?>'
                });
            <?php } ?>
        </script>
    <?php }else { ?>
        <script type="text/javascript">
            window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
            d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
            _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
            $.src="https://v2.zopim.com/?<?php echo $liveChatsConfig->zopim_id ?>";z.t=+new Date;$.
            type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
            $zopim(function(){
                $zopim.livechat.hideAll();
                <?php if ($buttonConfig->position == 'left') {?>
                    $zopim.livechat.window.setPosition('bl');
                <?php }else { ?>
                    $zopim.livechat.window.setPosition('br');
                <?php } ?>
                $zopim.livechat.window.onHide(function(){
                    $zopim.livechat.hideAll();
                    jQuery('#arcontactus').contactUs('show');
                });
            });
        </script>
    <?php } ?>
<?php } ?>
<?php if ($liveChatsConfig->isFacebookChatIntegrated() && $facebook) {?>
    <style type="text/css">
        <?php if ($buttonConfig->position == 'left'){ ?>
            .fb-customerchat > span > iframe{
                left: 10px !important;
                right: auto !important;
            }
        <?php }else{ ?>
            .fb-customerchat > span > iframe{
                right: 10px !important;
                left: auto !important;
            }
        <?php } ?>
        #ar-fb-chat{
            display: none;
        }
        #ar-fb-chat.active{
            display: block;
        }
    </style>
    <div id="ar-fb-chat">
        <div id="fb-root"></div>
        <?php if ($liveChatsConfig->fb_init){ ?>
            <script>
                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "//connect.facebook.net/<?php echo $liveChatsConfig->fb_lang? $liveChatsConfig->fb_lang : 'en_US' ?>/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            </script>
        <?php } ?>
        <div class="fb-customerchat"
            attribution=setup_tool
            page_id="<?php echo $liveChatsConfig->fb_page_id ?>"
            greeting_dialog_display="hide"
            <?php if ($liveChatsConfig->fb_color){ ?>
              theme_color="#<?php echo $liveChatsConfig->fb_color ?>"
            <?php } ?>
        ></div>
    </div>
<?php }