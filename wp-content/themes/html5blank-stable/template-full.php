<?php
/**
 * Template Name: Full-width Page Template
 * 
 * The template for displaying Full Width Page
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Citinine
 */

get_header();

?>        

        <!-- full-page-wrapper -->
        <?php echo include_css('page-full.css'); ?>
	<main class="full-page-wrapper no-side-padding container-fluid" role="main">
            
		<!-- full-page-section -->
		<section class="full-page-section no-side-padding container-fluid">
                    
                <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                   
			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class('full-page-article-wrapper no-side-padding row'); ?>>

				<?php the_content(); ?>

				<?php //comments_template( '', true ); // Remove if you don't want comments ?>

				<?php //edit_post_link(); ?>

			</article>
			<!-- /article -->

                <?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>

		</section>
		<!-- /full-page-section -->
                
	</main>
        <!-- full-page-wrapper -->

<?php //get_sidebar(); ?>

<?php get_footer(); ?>

