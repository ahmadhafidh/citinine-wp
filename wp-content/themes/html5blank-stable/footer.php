                        <!-- footer -->
                        <?php include_css('footer.css'); ?>
                        <footer class="footer" role="contentinfo"><div class="container">

                                <!-- footer-inner-wrapper -->
                                <div class="footer-inner-wrapper row">
                                    
                                        <!-- footer-left-wrapper -->
                                        <div class="footer-left-wrapper col-lg-3 col-12">
                                                <?php if ( is_active_sidebar( 'widget-footer-left' ) ) : ?>
                                                        <?php dynamic_sidebar( 'widget-footer-left' ); ?>
                                                <?php endif; ?>
                                        </div>
                                        <!-- /footer-left-wrapper -->

                                        <!-- footer-center-left-wrapper -->
                                        <div class="footer-center-left-wrapper col-lg-3 col-12">
                                                <?php if ( is_active_sidebar( 'widget-footer-center-left' ) ) : ?>
                                                        <?php dynamic_sidebar( 'widget-footer-center-left' ); ?>
                                                <?php endif; ?>
                                        </div>
                                        <!-- /footer-center-left-wrapper -->

                                        <!-- footer-center-right-wrapper -->
                                        <div class="footer-center-right-wrapper col-lg-3 col-sm-12 col-12">
                                                <?php if ( is_active_sidebar( 'widget-footer-center-right' ) ) : ?>
                                                        <?php dynamic_sidebar( 'widget-footer-center-right' ); ?>
                                                <?php endif; ?>
                                        </div>
                                        <!-- /footer-center-right-wrapper -->

                                        <!-- footer-right-wrapper -->
                                        <div class="footer-right-wrapper col-lg-3 col-12">
                                                <?php if ( is_active_sidebar( 'widget-footer-right' ) ) : ?>
                                                        <?php dynamic_sidebar( 'widget-footer-right' ); ?>
                                                <?php endif; ?>
                                        </div>
                                        <!-- /footer-right-wrapper -->
                                    
                                </div>
                                <!-- /footer-inner-wrapper -->

                        </div></footer>
			<!-- /footer -->

		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>

	</body>
</html>
