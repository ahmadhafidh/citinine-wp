<ul>
    <li>
        <?php echo __('Name', 'ar-contactus') ?>: <b><?php echo $model->name ?></b>
    </li>
    <li>
        <?php echo __('Phone', 'ar-contactus') ?>: <b><a href="tel:<?php echo $model->formatPhone() ?>"><?php echo $model->phone ?></a></b>
    </li>
    <li>
        <?php echo __('User', 'ar-contactus') ?>: <b><?php echo $model->getUserName() ?></b>
    </li>
    <li>
        <?php echo __('Created at', 'ar-contactus') ?>: <b><?php echo $model->created_at ?></b>
    </li>
    <li>
        <?php echo __('Status', 'ar-contactus') ?>: <b><?php echo $model->getStatusLabel() ?></b>
    </li>
</ul>