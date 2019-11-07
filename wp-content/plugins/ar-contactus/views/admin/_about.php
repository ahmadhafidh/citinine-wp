<div class="ui segment arconfig-panel hidden" id="arcontactus-about">
    <div class="text-center">
        <a href="">
            <img src="<?php echo AR_CONTACTUS_PLUGIN_URL . 'res/img/logo-big.png' ?>" alt="logo" />
        </a>
        <p class="hero"><?php echo __('All-in-one contact us button', 'ar-contactus') ?></p>
        <p class="muted">Ver. <?php echo AR_CONTACTUS_VERSION ?></p>
        <p>
            <?php echo __('This plugin displays contact button with customizable menu on every page. So your customers will able to contact you easily.', 'ar-contactus') ?>
        </p>
        
        <div class="arcu-activation">
            <div>
                <?php if (!isset($activated['success']) || !$activated['success']){?>
                <div>
                    <label><?php echo __('Purchase code', 'ar-contactus') ?></label>
                </div>
                <div>
                    <div class="field">
                        <input placeholder="" id="arcontactus_pcode" autocomplete="off" value="<?php echo get_option('AR_CONTACTUS_PURCHASE_CODE', '') ?>" data-default="" data-serializable="true" name="pcode" type="text">
                        <div class="errors" id="arcontactus_activation_error"></div>
                    </div>
                </div>
                <div class="actions">
                    <button type="button" onclick="arCU.activate();" class="button button-primary button-large"><?php echo __('Activate', 'ar-contactus') ?></button>
                </div>
                <?php }elseif($activated['success']){ ?>
                    <div><?php echo __('Purchase code: ', 'ar-contactus') ?> <b><?php echo get_option('AR_CONTACTUS_PURCHASE_CODE', '') ?></b></div>
                <?php } ?>
            </div>
        </div>

        <p>
            <?php echo sprintf(__('We hope you would find this plugin useful and would have 1 minute to %s, this encourage our support and developers.', 'ar-contactus'), '<a href="https://codecanyon.net/downloads" target="_blank">' . __('give us excellent rating', 'ar-contactus') . '</a>') ?>
        </p>
        <p>
            <?php echo sprintf(__('If you like this plugin please follow us on %s.', 'ar-contactus'), '<a href="https://codecanyon.net/user/areama/follow" target="_blank">codecanyon.net</a>') ?>
        </p>
        <p class="text-center">
            <a href="https://codecanyon.net/downloads" target="_blank">
                <img src="<?php echo AR_CONTACTUS_PLUGIN_URL . 'res/img/5-stars.png' ?>" alt="<?php echo __('5 stars', 'ar-contactus') ?>">
            </a>
        </p>
        <p>
            <?php echo sprintf(__('If you have any questions or suggestions about this plugin, please %s', 'ar-contactus'), '<a href="https://codecanyon.net/user/areama" target="_blank">' . __('contact us', 'ar-contactus') . '</a>') ?>
        </p>
        <h2>
            <?php echo __('Also please checkout our other plugins that can help improve your site!', 'ar-contactus') ?><br>
        </h2>
        <div class="ui grid" id="ar-plugins">
            <div class="row">
                <div class="eight wide column">
                    <a class="ar-plugin" href="https://codecanyon.net/item/all-product-images-or-second-image-rollover-on-hover/23670584?ref=areama" target="_blank">
                        <img src="https://s3.envato.com/files/263719397/logo.png" />
                        <div class="ar-plugin-content">
                            <div class="ar-plugin-title">
                                All product images or second image (rollover) on hover
                            </div>
                            <div class="ar-plugin-desc">
                                This plugin allows to display all product images or display second product image on mouse hover in product list. 
                                <strong>4 desktop modes</strong>, <strong>mobile friendly</strong>. Mobile swipe functionality supported! Highly customizable!
                            </div>
                        </div>
                    </a>
                </div>
                <div class="eight wide column">
                    <a class="ar-plugin" href="https://codecanyon.net/item/live-sales-popup-product-sold-notification/23600180?ref=areama" target="_blank">
                        <img src="https://s3.envato.com/files/263379131/logo.png" />
                        <div class="ar-plugin-content">
                            <div class="ar-plugin-title">
                                Live Sales Popup: product sold notification
                            </div>
                            <div class="ar-plugin-desc">
                                <strong>Boost your sales</strong> with the lightweight ‘influential marketing’ tool for customer enagagement and motivation. 
                                Share <strong>recent orders</strong> with your website visitors to proove your sales, 
                                show notifications when someone <strong>adds product to cart</strong>, 
                                show notification with <strong>viewers count of current product</strong> to push visitor to purchase.
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <p>
            <a target="_blank" href="https://codecanyon.net/user/areama/portfolio?ref=areama"><?php echo __('View all our plugins &gt;&gt;&gt;', 'ar-contactus') ?></a>
        </p>
    </div>
</div>