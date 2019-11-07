<?php get_header(); ?>

                <!-- single-post-main-wrapper -->
                <?php echo include_css('default-sidebar-layout.css'); ?>
                <?php echo include_css('single.css'); ?>
                <!-- default-sidebars-wrapper -->
                <div class="default-sidebars-wrapper container-fluid"><div class="row">

                        <!-- default-content-main-wrapper -->
                        <main class="default-content-main-wrapper col-lg-8 col-12" role="main">

                                <!-- section -->
                                <section class="default-section-wrapper single-post-content-wrapper">

                                        <?php if (have_posts()): while (have_posts()) : the_post(); ?>

                                                <!-- article -->
                                                <article id="post-<?php the_ID(); ?>" <?php post_class('no-side-padding col-12'); ?>>

                                                        <!-- single-post-extra-wrapper -->
                                                        <div class="single-post-extra-wrapper no-side-padding col-12">

                                                                <p class="gray"><?php the_category(', '); ?></p>

                                                                <p class="gray"><?php the_time('d M \'y'); ?></p>

                                                        </div>
                                                        <!-- /single-post-extra-wrapper -->

                                                        <!-- post-title -->
                                                        <h1 class="post-title blue">
                                                                <a class="blue" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                                        </h1>
                                                        <!-- /post title -->

                                                        <!-- single-post-image-wrapper -->
                                                        <?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
                                                                <div class="single-post-image-wrapper no-side-padding col-12"><?php the_post_thumbnail(); // Fullsize image for the single post ?></div>
                                                        <?php endif; ?>
                                                        <!-- /single-post-image-wrapper -->

                                                        <!-- single-post-content -->
                                                        <div class="single-post-content no-side-padding col-12">

                                                                <?php the_content(); // Dynamic Content ?>

                                                        </div>
                                                        <!-- /single-post-content -->

                                                </article>
                                                <!-- /article -->

                                        <?php endwhile; ?>

                                        <?php else: ?>

                                                <!-- article -->
                                                <article class="single-post-no-content no-side-padding col-12">

                                                        <h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

                                                </article>
                                                <!-- /article -->

                                        <?php endif; ?>

                                </section>
                                <!-- /section -->
                        </main>
                        <!-- default-content-main-wrapper -->

                        <?php get_sidebar(); ?>

                </div></div>
                <!-- /default-sidebars-wrapper -->
        
<?php get_sidebar(); ?>

<?php get_footer(); ?>
