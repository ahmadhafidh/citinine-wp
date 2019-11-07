<?php
ArContactUsLoader::loadModel('ArContactUsConfigButtonAbstract');

class ArContactUsConfigButton extends ArContactUsConfigButtonAbstract
{
    public function overrideUnsafeAttributes()
    {
        return array(
            'storefront_pos'
        );
    }
}
