<?php
/**
 * Provide a admin area view for the plugin
 *
 * @link       http://pixelative.co
 * @since      1.4.0
 *
 * @package    Amp_WP
 * @subpackage Amp_WP/admin/partials/settings
 */
?>
<div id="settings-gdpr" class="amp-wp-vtabs-content">
	<form id="amp_wp_setting_form" name="amp_wp_setting_form" method="post">
        <div class="amp-wp-vtabs-header">
            <div class="amp-wp-vtabs-title">
                <h2><?php _e('GDPR', 'amp-wp'); ?></h2>
            </div>
            <div class="amp-wp-vtabs-btn-toolbar">
                <?php submit_button( esc_html__('Save Changes', 'amp-wp'), 'button-primary', 'save', false); ?>
            </div>
        </div>
		<div class="amp-wp-vtabs-body">
            
            <!-- GDPR Compliance - START -->
            <h3 class="amp-wp-form-section-title"><?php _e('GDPR Compliance', 'amp-wp'); ?></h3>
            <table class="form-table amp-wp-form-table">
                <tbody>
                    <tr>
                        <th scope="row"><label for="gdpr_switch"><?php _e('GDPR Compliance for EU Users', 'amp-wp'); ?></label></th>
                        <td>
                            <div class="amp-wp-parent-child-field <?php echo ( $gdpr_switch == "1" ) ? 'active' : ''; ?>">
                                <div class="switch">
                                    <input type="checkbox" name="amp_wp_gdpr_settings[gdpr_switch]" id="gdpr_switch" <?php echo ( isset( $gdpr_switch ) && "1" == $gdpr_switch ) ? 'checked="checked"' : ''; ?>>
                                    <label for="gdpr_switch"><?php esc_html_e('&nbsp;', 'amp-wp'); ?></label>
                                </div>
                                <div class="amp-wp-child-field">
                                    <!-- Headline Text -->
                                    <label for="headline_text"><?php _e('Headline Text', 'amp-wp'); ?></label>
                                    <input type="text" name="amp_wp_gdpr_settings[headline_text]" id="headline_text" class="regular-text code" placeholder="<?php amp_wp_translation_echo( 'headline-text' ); ?>" value = "<?php echo ( $gdpr_headline_text ) ? esc_attr( $gdpr_headline_text ) : ''; ?>">
                                    <!-- /Headline Text -->

                                    <!-- Message to Visitor -->
                                    <label for="gdpr_message"><?php _e('Message to Visitor', 'amp-wp'); ?></label>
                                    <textarea name="amp_wp_gdpr_settings[gdpr_message]" id="gdpr_message" rows="3" class="large-text code" placeholder="<?php amp_wp_translation_echo( 'message-to-visitor' ); ?>"><?php echo ( $gdpr_message ) ? wp_kses_post( $gdpr_message ) : ''; ?></textarea>
                                    <p class="description"><?php amp_wp_translation_echo( 'message-to-visitor-description' ); ?></p>
                                    <!-- /Message to Visitor -->

                                    <!-- Accept Button Text -->
                                    <label for="gdpr_accept_button_text"><?php _e('Accept Button Text', 'amp-wp'); ?></label>
                                    <input type="text" name="amp_wp_gdpr_settings[gdpr_accept_button_text]" id="gdpr_accept_button_text" class="regular-text code" placeholder="<?php amp_wp_translation_echo( 'accept-button-text' ); ?>" value="<?php echo ( $gdpr_accept_button_text ) ? esc_attr( $gdpr_accept_button_text ) : ''; ?>">
                                    <!-- /Accept Button Text -->

                                    <!-- Reject Button Text -->
                                    <label for="gdpr_reject_button_text"><?php _e('Reject Button Text', 'amp-wp'); ?></label>
                                    <input type="text" name="amp_wp_gdpr_settings[gdpr_reject_button_text]" id="gdpr_reject_button_text" class="regular-text code" placeholder="<?php amp_wp_translation_echo( 'reject-button-text' ); ?>" value="<?php echo ( $gdpr_reject_button_text ) ? esc_attr( $gdpr_reject_button_text ) : ''; ?>">
                                    <!-- /Reject Button Text -->

                                    <!-- For More Information -->
                                    <label for="gdpr_for_more_privacy_info"><?php _e('For More Information', 'amp-wp'); ?></label>
                                    <input type="text" name="amp_wp_gdpr_settings[gdpr_for_more_privacy_info]" id="gdpr_for_more_privacy_info" class="regular-text code" placeholder="<?php amp_wp_translation_echo( 'for-more-information' ); ?>" value="<?php echo ( $gdpr_for_more_privacy_info ) ? esc_attr( $gdpr_for_more_privacy_info ) : ''; ?>">
                                    <p class="description"><?php amp_wp_translation_echo('for-more-information-description'); ?></p>
                                    <!-- /For More Information -->

                                    <!-- Select the Privacy Page -->
                                    <label for="gdpr_privacy_page"><?php _e('Select the Privacy Page.', 'amp-wp'); ?></label>
                                    <?php wp_dropdown_pages( $args ); ?>
                                    <p class="description"><?php amp_wp_translation_echo('select-the-privacy-page-description'); ?></p>
                                    <!-- /Select the Privacy Page -->

                                    <!-- Privacy Page Button Text -->
                                    <label for="gdpr_privacy_page_button_text"><?php _e('Privacy Page Button Text', 'amp-wp'); ?></label>
                                    <input type="text" name="amp_wp_gdpr_settings[gdpr_privacy_page_button_text]" id="gdpr_privacy_page_button_text" class="regular-text code" placeholder="<?php amp_wp_translation_echo( 'privacy-page-button-text' ); ?>" value="<?php echo ( $gdpr_privacy_page_button_text ) ? esc_attr( $gdpr_privacy_page_button_text ) : ''; ?>">
                                    <!-- /Privacy Page Button Text -->
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- GDPR Compliance - END -->

			<?php wp_nonce_field('amp_wp_notice_bar_gdpr_setting', 'amp_wp_notice_bar_gdpr_nonce'); ?>
			<input type="hidden" value="1" name="admin_notices">
		</div>
		<div class="amp-wp-vtabs-footer">
            <div class="amp-wp-vtabs-title">
                <h2><?php _e('GDPR', 'amp-wp'); ?></h2>
            </div>
            <div class="amp-wp-vtabs-btn-toolbar">
                <?php submit_button( esc_html__('Save Changes', 'amp-wp'), 'button-primary', 'save', false); ?>
            </div>
        </div>
	</form>
</div>