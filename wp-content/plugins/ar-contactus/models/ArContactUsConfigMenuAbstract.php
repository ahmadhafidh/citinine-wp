<?php
ArContactUsLoader::loadModel('ArContactUsConfigModel');

class ArContactUsConfigMenuAbstract extends ArContactUsConfigModel
{
    public $menu_size;
    public $menu_width;
    public $menu_style;
    public $item_style;
    public $item_border_style;
    public $item_border_color;
    public $menu_header_on;
    public $menu_header;
    public $header_close;
    public $header_close_bg;
    public $header_close_color;
    public $menu_bg;
    public $menu_color;
    public $menu_subtitle_color;
    public $menu_hbg;
    public $menu_hcolor;
    public $menu_subtitle_hcolor;
    public $shadow_size;
    public $shadow_opacity;
    public $auto_open;
    
    public function getFormTitle()
    {
        return __('Menu settings', 'ar-contactus');
    }
    
    public function attributeDefaults()
    {
        return array(
            'menu_size' => 'large',
            'menu_width' => '300',
            'item_style' => 'rounded',
            'menu_style' => 0,
            'item_border_style' => 'none',
            'item_border_color' => 'dddddd',
            'menu_header_on' => '',
            'menu_header' => 'How would you like to contact us?',
            'header_close' => '',
            'header_close_bg' => '008749',
            'header_close_color' => 'ffffff',
            'menu_bg' => 'ffffff',
            'menu_color' => '3b3b3b',
            'menu_subtitle_color' => '787878',
            'menu_subtitle_hcolor' => '787878',
            'menu_hbg' => 'f0f0f0',
            'menu_hcolor' => '3b3b3b',
            'shadow_size' => '30',
            'shadow_opacity' => '0.2',
            'auto_open' => 0
        );
    }
}