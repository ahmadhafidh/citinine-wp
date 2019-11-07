<?php 
/* @var $model ArContactUsModel */
?>
<a id="arcontactus-menu-item-<?php echo $model->id ?>" 
   style="border-left: 2px solid #<?php echo $model->color ?>; 
   <?php if (isset($params['bg']) && $params['bg']){ echo 'background-color: ' . $params['bg'] . ';'; } ?>"
   class="arcu-menu-item"
    <?php if ($model->type == ArContactUsModel::TYPE_LINK){ ?>
        href="<?php echo $model->link ?>" 
        target="<?php echo $model->target == ArContactUsModel::TARGET_NEW_WINDOW? '_blank' : '_self' ?>"
    <?php }elseif($model->type == ArContactUsModel::TYPE_INTEGRATION || $model->type == ArContactUsModel::TYPE_JS){ ?>
        href="#" 
        onclick="jQuery('#msg-item-<?php echo $model->id ?>').trigger('click'); return false"
    <?php }elseif($model->type == ArContactUsModel::TYPE_CALLBACK){ ?>
        href="#"
        onclick="jQuery('#arcontactus').contactUs('openCallbackPopup'); return false;"
    <?php } ?>>
    <span class="arcu-menu-item-icon" style="color: #<?php echo $model->color ?>">
        <?php echo $model->getIcon() ?>
    </span>
    <span class="arcu-menu-item-title" style="<?php if (isset($params['color']) && $params['color']){ echo 'color: ' . $params['color'] . ';'; } ?>">
        <?php echo $model->title ?>
    </span>
</a>