<?php get_header(); ?>

        <!-- default-sidebars-wrapper -->
        <?php echo include_css('default-sidebar-layout.css'); ?>
        <div class="default-sidebars-wrapper container-fluid"><div class="row">
    
                <!-- default-content-main-wrapper -->
                <main class="default-content-main-wrapper col-lg-8 col-12" role="main">
                    
                        <!-- section -->
                        <section class="default-section-wrapper">

                                <h1><?php _e( 'Latest Posts', 'html5blank' ); ?></h1>

                                <?php get_template_part('loop'); ?>

                                <?php get_template_part('pagination'); ?>

                        </section>
                        <!-- /section -->
                </main>
                <!-- default-content-main-wrapper -->
                
                <?php get_sidebar(); ?>
                    
        </div></div>
        <!-- /default-sidebars-wrapper -->

<?php get_footer(); ?>

