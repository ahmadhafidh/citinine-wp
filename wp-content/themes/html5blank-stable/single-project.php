<?php get_header(); ?>

        <!-- project-main-wrapper -->
        <?php echo include_css('single-project.css'); ?>
	<main class="project-main-wrapper no-side-padding container-fluid" role="main">
            
                <!-- section -->
                <section class="no-side-padding container-fluid">
                    
                        <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                    
                                <!-- article -->
                                <article id="post-<?php the_ID(); ?>" <?php post_class('container-fluid no-side-padding'); ?>>
                    
                                        <!-- project-top-wrapper -->
                                        <div class="project-top-wrapper no-side-padding row">

                                                <!-- project-info-wrapper -->
                                                <div class="project-info-wrapper no-side-padding col-md-6 col-12">
                                                    
                                                        <!-- project-info-extra-wrapper -->
                                                        <div class="project-info-extra-wrapper row no-side-padding">
                                                            
                                                                <?php 
                                                                        //Project extra info
                                                                        //$location = get_field('');
                                                                ?>
                                                                
                                                        </div>
                                                        <!-- /project-info-extra-wrapper -->

                                                        <!-- project-title -->
                                                        <h1 class="project-title blue">
                                                                <a class="blue" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                                        </h1>
                                                        <!-- /post-title -->
                                                        
                                                        <!-- project-content-wrapper -->
                                                        <div class="project-content-wrapper no-side-padding col-11">
                                                        
                                                                <?php the_content(); // Dynamic Content ?>
                                                            
                                                        </div>
                                                        <!-- /project-content-wrapper -->
                                                        
                                                        
                                                </div>
                                                <!-- /project-info-wrapper -->

                                                <!-- project-image-wrapper -->
                                                <div class="project-image-wrapper no-side-padding col-md-6 col-12">

                                                        <!-- post thumbnail -->
                                                        <?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
                                                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                                        <?php the_post_thumbnail(); // Fullsize image for the single post ?>
                                                                </a>
                                                        <?php endif; ?>
                                                        <!-- /post thumbnail -->

                                                </div>
                                                <!-- /project-image-wrapper -->

                                        </div>
                                        <!-- /project-top-wrapper -->

                                        <!-- project-bottom-wrapper -->
                                        <div class="project-bottom-wrapper no-side-padding row">

                                                <!-- project-amenities-wrapper -->
                                                <div class="project-amenities-wrapper col-md-6 col-12">
                                                    
                                                        <?php 
                                                                // check if the repeater field has rows of data
                                                                if( have_rows('amenities') ):
                                                        ?>
                                                                        <!-- amenities-title -->
                                                                        <h5 class="amenities-title">Project Amenities</h5>
                                                                        
                                                                        <!-- project-amenities-inner -->
                                                                        <div class="project-amenities-inner row">
                                                        
                                                        <?php

                                                                        // loop through the rows of data
                                                                        while ( have_rows('amenities') ) : the_row();
                                                        ?>
                                                                                <!-- amenity-wrapper -->
                                                                                <div class="amenity-wrapper col-6">
                                                                                        
                                                                                        <!-- amenity-icon-wrapper -->
                                                                                        <div class="amenity-icon-wrapper">
                                                                                                                                                                                           
                                                                                                <?php 
                                                                                                        // display a sub field value
                                                                                                        $icon = get_sub_field('icon');
                                                                                                        if( $icon != '' ) {
                                                                                                ?>
                                                                                            
                                                                                                        <img class="amenity-icon" src="<?php echo $icon; ?>" />
                                                                                            
                                                                                                <?php 
                                                                                                        } 
                                                                                                ?>
                                                                                                
                                                                                        </div>
                                                                                        <!-- /amenity-icon-wrapper -->
                                                                                        
                                                                                        <!-- amenity-name-wrapper -->
                                                                                        <div class="amenity-name-wrapper">
                                                                                            
                                                                                                <?php 
                                                                                                        // display a sub field value
                                                                                                        the_sub_field('name');
                                                                                                ?>
                                                                                                
                                                                                        </div>
                                                                                        <!-- /amenity-name-wrapper -->
                                                                                    
                                                                                </div>
                                                                                <!-- /amenity-wrapper -->

                                                        <?php
                                                                        endwhile;
                                                        ?>  
                                                                        </div>
                                                                        <!-- project-amenities-inner -->
                                                                                
                                                        <?php

                                                                endif;
                                                                //END of rows data
                                                        ?>
                                                        
                                                </div>
                                                <!-- /project-amenities-wrapper -->
                                                
                                                <!-- project-contact-wrapper -->
                                                <div class="project-contact-wrapper no-side-padding col-md-6 col-12">
                                                        
                                                        <!-- project-contact-inner -->
                                                        <div class="project-contact-inner no-side-padding row">
                                                            
                                                                <!-- project-contact-image-wrapper -->
                                                                <div class="project-contact-image-wrapper col-5 no-side-padding">
                                                                        
                                                                        
                                                                        
                                                                </div>
                                                                <!-- /project-contact-image-wrapper -->
                                                                
                                                                <!-- project-contact-info-wrapper -->
                                                                <div class="project-contact-info-wrapper col-7 no-side-padding">
                                                                        
                                                                        <p class="project-contact-info white">Jangan ragu untuk menghubungi tim marketing kami untuk informasi lebih lengkap mengenai properti ini.</p>
                                                                        <a class="white-border-btn" href="#">Chat via whatsapp</a>
                                                                        
                                                                </div>
                                                                <!-- /project-contact-info-wrapper -->
                                                            
                                                        </div>
                                                        <!-- /project-contact-inner -->
                                                    
                                                </div>
                                                <!-- /project-contact-wrapper -->
                                            
                                        </div>
                                        <!-- /project-bottom-wrapper -->

                                </article>
                                <!-- /article -->

                <?php endwhile; ?>

                <?php else: ?>

                        <!-- article -->
                        <article>

                                <h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

                        </article>
                        <!-- /article -->

                <?php endif; ?>

                </section>
                <!-- /section -->
        
	</main>
        <!-- /project-main-wrapper -->

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
