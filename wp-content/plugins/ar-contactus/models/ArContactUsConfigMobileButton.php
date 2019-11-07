<?php
ArContactUsLoader::loadModel('ArContactUsConfigButtonAbstract');

class ArContactUsConfigMobileButton extends ArContactUsConfigButtonAbstract
{
    public function positionSelectOptions()
    {
        $array = array(
            'left' => __('Left', 'ar-contactus'),
            'right' => __('Right', 'ar-contactus')
        );
        if (function_exists('storefront_handheld_footer_bar')) {
            $array['storefront'] = __('StoreFront theme footer');
        }
        return $array;
    }
    
    public function attributeDefaults()
    {
        return array(
            'mode' => 'regular',
            'button_icon' => 'hangouts',
            'button_size' => 'small',
            'button_color' => '008749',
            'position' => 'right',
            'x_offset' => '10',
            'y_offset' => '10',
            'pulsate_speed' => 2000,
            'icon_speed' => 600,
            'icon_animation_pause' => 2000,
            'text' => '',
            'drag' => 0,
        );
    }
}