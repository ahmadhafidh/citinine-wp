<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class('news-article-wrapper row'); ?>>
            
                <?php 
                        //Prepare the content width
                        $content_width = 12;
                ?>
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists  ?>
            
                        <?php 
                                //Update the content width
                                $content_width = 6;
                        ?>
                        
                        <!-- news-article-image-wrapper -->
			<div class="news-article-image-wrapper col-lg-6 col-12">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <?php the_post_thumbnail( 'large' ); // Declare pixel size you need inside the array ?>
                                </a>
                        </div>
                        <!-- /news-article-image-wrapper -->
                        
		<?php endif; ?>
                
                <!-- news-article-content-wrapper -->
                <div class="news-article-content-wrapper col-lg-<?php echo $content_width; ?> col-12">
                
                        <!-- news-article-title -->
                        <h2 class="news-article-title meriweather blue">
                                <a class="meriweather blue" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <?php the_title(); ?>
                                </a>
                        </h2>
                        <!-- /news-article-title -->
                        
                        <!-- news-article-excerpt -->
                        <div class="news-article-excerpt">
                                <?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>
                        </div>
                        <!-- /news-article-excerpt -->
                    
                </div>
                <!-- /news-article-content-wrapper -->

		<?php //edit_post_link(); ?>

	</article>
	<!-- /article -->

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article class="news-article-wrapper row">
                
                <!-- news-article-content-wrapper -->
                <div class="news-article-content-wrapper col-12">
                
                        <!-- news-article-title -->
                        <h2 class="news-article-title meriweather blue">
                                <?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?>
                        </h2>
                        <!-- /news-article-title -->
                        
                </div>
                <!-- /news-article-content-wrapper -->
            
	</article>
	<!-- /article -->

<?php endif; ?>
