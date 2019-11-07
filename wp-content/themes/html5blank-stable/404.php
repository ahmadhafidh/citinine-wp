<?php get_header(); ?>

        <!-- default-sidebars-wrapper -->
        <div class="default-sidebars-wrapper container-fluid"><div class="row">
    
                <!-- default-content-main-wrapper -->
                <main class="default-content-main-wrapper col-md-8 col-12" role="main">
                    
                        <!-- section -->
                        <section class="default-section-wrapper">

                                <!-- article -->
                                <article id="post-404">

                                        <h1><?php _e( 'Page not found', 'html5blank' ); ?></h1>
                                        <h2>
                                                <a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'html5blank' ); ?></a>
                                        </h2>

                                </article>
                                <!-- /article -->

                        </section>
                        <!-- /section -->
                </main>
                <!-- default-content-main-wrapper -->
                
                <?php get_sidebar(); ?>
                    
        </div></div>
        <!-- /default-sidebars-wrapper -->

<?php get_footer(); ?>
