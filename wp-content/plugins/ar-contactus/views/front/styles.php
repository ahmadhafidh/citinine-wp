<?php if ($menuConfig->menu_bg){?>
    .arcontactus-widget .messangers-block{
        background-color: #<?php echo $menuConfig->menu_bg ?>;
    }
    .arcontactus-widget .messangers-block::before{
        border-top-color: #<?php echo $menuConfig->menu_bg ?>;
    }
<?php } ?>
<?php if ($menuConfig->menu_color){?>
    .messangers-block .messanger p, .messangers-block .messanger .arcu-item-label{
        color:  #<?php echo $menuConfig->menu_color ?>;
    }
<?php } ?>
<?php if ($menuConfig->menu_hcolor){?>
    .messangers-block .messanger:hover p, .messangers-block .messanger:hover .arcu-item-label{
        color:  #<?php echo $menuConfig->menu_hcolor ?>;
    }
<?php } ?>
<?php if ($menuConfig->menu_hbg){?>
    .messangers-block .messanger:hover{
        background-color:  #<?php echo $menuConfig->menu_hbg ?>;
    }
<?php } ?>
#arcontactus-message-callback-phone-submit{
    font-weight: normal;
}
<?php if ($popupConfig->hide_recaptcha){?>
    .grecaptcha-badge{
        display: none;
    }
<?php } ?>
<?php if ($buttonConfig->x_offset){?>
    .arcontactus-widget.<?php echo $buttonConfig->position ?>.arcontactus-message{
        <?php if ($buttonConfig->position == 'left'){?>
            left: <?php echo (int)$buttonConfig->x_offset ?>px;
        <?php } ?>
        <?php if ($buttonConfig->position == 'right'){?>
            right: <?php echo (int)$buttonConfig->x_offset ?>px;
        <?php } ?>
    }
<?php } ?>
<?php if ($buttonConfig->y_offset){?>
    .arcontactus-widget.<?php echo $buttonConfig->position ?>.arcontactus-message{
        bottom: <?php echo (int)$buttonConfig->y_offset ?>px;
    }
<?php } ?>
<?php if ($buttonConfig->position == 'storefront'){?>
    .arcontactus-widget .arcontactus-message-button{
        display: none;
    }
    .arcontactus-widget.arcontactus-message{
        bottom: -1000px;
    }
<?php } ?>
<?php if ($menuConfig->shadow_size){ ?>
    .arcontactus-widget .messangers-block, .arcontactus-widget .arcontactus-prompt, .arcontactus-widget .callback-countdown-block{
        box-shadow: 0 0 <?php echo (int)$menuConfig->shadow_size ?>px rgba(0, 0, 0, <?php echo $menuConfig->shadow_opacity ?>);
    }
<?php } ?>
.arcontactus-widget .arcontactus-message-button .pulsation{
    -webkit-animation-duration:<?php echo $buttonConfig->pulsate_speed / 1000 ?>s;
    animation-duration: <?php echo $buttonConfig->pulsate_speed / 1000 ?>s;
}
<?php if ($menuConfig->item_border_style != 'none' && $menuConfig->item_border_color){?>
.arcontactus-widget.arcontactus-message .messangers-block .messangers-list li{
    border-bottom: 1px <?php echo $menuConfig->item_border_style ?> #<?php echo $menuConfig->item_border_color ?>;
}
.arcontactus-widget.arcontactus-message .messangers-block .messangers-list li:last-child{
    border-bottom: 0 none;
}
<?php } ?>
#ar-zalo-chat-widget{
    display: none;
}
#ar-zalo-chat-widget.active{
    display: block;
}
<?php if (!$isMobile){ ?>
.arcontactus-widget .messangers-block,
.arcontactus-widget .arcu-popup{
    <?php if ($menuConfig->menu_width){ ?>
        width: <?php echo (int)$menuConfig->menu_width ?>px;
    <?php }else{ ?>
        width: auto;
    <?php } ?>
}
.messangers-block .messanger p, .messangers-block .messanger .arcu-item-label{
    <?php if (!$menuConfig->menu_width){ ?>
        white-space: nowrap;
    <?php } ?>
}
<?php if ($popupConfig->popup_width){?>
.arcontactus-widget .callback-countdown-block{
    width: <?php echo (int)$popupConfig->popup_width ?>px;
}
<?php } ?>
<?php } ?>

.arcontactus-widget.no-bg .messanger .arcu-item-label{
    background: #<?php echo $menuConfig->menu_bg?>;
}
.arcontactus-widget.no-bg .messanger:hover .arcu-item-label{
    background: #<?php echo $menuConfig->menu_hbg?>;
}
.arcontactus-widget.no-bg .messanger .arcu-item-label:before,
.arcontactus-widget.no-bg .messanger:hover .arcu-item-label:before{
    border-left-color: #<?php echo $menuConfig->menu_hbg?>;
}
.arcontactus-widget.left.no-bg .messanger:hover .arcu-item-label:before{
    border-right-color: #<?php echo $menuConfig->menu_hbg?>;
    border-left-color: transparent;
}

<?php if ($menuConfig->shadow_size){ ?>
    .arcontactus-widget.no-bg .messanger:hover .arcu-item-label{
        box-shadow: 0 0 <?php echo (int)$menuConfig->shadow_size ?>px rgba(0, 0, 0, <?php echo $menuConfig->shadow_opacity ?>);
    }
<?php } ?>

@media(max-width: 428px){
    .arcontactus-widget.<?php echo $buttonConfig->position ?>.arcontactus-message.opened,
    .arcontactus-widget.<?php echo $buttonConfig->position ?>.arcontactus-message.open,
    .arcontactus-widget.<?php echo $buttonConfig->position ?>.arcontactus-message.popup-opened{
        left: 0;
        right: 0;
        bottom: 0;
    }
}