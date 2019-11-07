<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
                <meta charset="<?php bloginfo( 'charset' ); ?>">
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="profile" href="https://gmpg.org/xfn/11">
                
                <link href="//www.google-analytics.com" rel="dns-prefetch">
                <link href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/favicon.ico" rel="shortcut icon">
                <link href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/touch.png" rel="apple-touch-icon-precomposed">
                
				<meta name="description" content="<?php bloginfo('description'); ?>">
				
				<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
				<link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
                
                <?php wp_head(); ?>
                
		<script>
                        // conditionizr.com
                        // configure environment tests
                        conditionizr.config({
                            assets: '<?php echo get_template_directory_uri(); ?>',
                            tests: {}
                        });
                </script>

	</head>
	<body <?php body_class(); ?>>

		<!-- wrapper -->
		<div class="wrapper">
		
			<?php include_css('header.css'); ?>

			<!-- header -->
			<header class="header clear" role="banner"><div class="container">
			
                    <!-- header-navigation-wrapper -->
                    <div class="header-navigation-wrapper row">
                                    
                                <!-- header-logo-wrapper -->
                                <div class="header-logo-wrapper col-lg-2 col-12">
                                        
                                        <a class="logo" href="<?php echo home_url(); ?>">
                                        
                                                        <!-- svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/citinine-logo.png" alt="Citinine Logo" class="logo-img">
                                        </a>
                                        
                                </div>
                                <!-- /header-logo-wrapper -->

                                <!-- header-nav-wrapper -->
                                <div class="header-nav-wrapper col-lg-6 col-2">
                                    
                                        <!-- mobile-menu -->
                                        <div class="mobile-menu hamburger hamburger--spring">
                                                <div class="hamburger-box">
                                                        <div class="hamburger-inner"></div>
                                                </div>

                                                <!-- nav -->
                                                <nav class="header-nav-wrapper nav full-wrap" role="navigation">
                                                        <?php html5blank_nav(); ?>
                                                </nav>
                                                <!-- /nav -->
                                        </div>
                                        <!-- /mobile-menu -->
										
                                </div>
                            	<!-- /header-nav-wrapper -->
                            	
                            	<?php 
                                        //Get the themes options
                                        $theme_option = get_option('theme_option');
                            	?>

                                <!-- header-info-wrapper -->
                                <div class="header-info-wrapper col-lg-3 col-12">
                                        
                                        <?php 
                                                if( isset($theme_option['phone']) && $theme_option['phone'] != '' ){ 
                                        ?>
                                                        <p class="header-contact">
                                                                <i class="fa fa-phone"></i> 
                                                                <span><?php echo $theme_option['phone']; ?></span>
                                                        </p>
                                        <?php 
                                                }
                                        ?>

                                        <?php 
                                                if( isset($theme_option['email']) && $theme_option['email'] != '' ){ 
                                        ?>
                                                        <?php /* <p class="header-contact"><i class="fa fa-paper-plane"></i> <?php echo $theme_option['email']; ?></p> */ ?>
                                        <?php 
                                                }
                                        ?>

                                        <?php 
                                                if( isset($theme_option['address']) && $theme_option['address'] != '' ){ 
                                        ?>
                                                        <?php /* <p class="header-contact"><i class="fa fa-map-marker"></i> <?php echo $theme_option['address']; ?></p>*/ ?>
                                        <?php 
                                                }
                                        ?>
                                        
                                </div>
                            	<!-- /header-info-wrapper -->

                                <!-- header-icon-wrapper -->
                                <div class="header-icon-wrapper col-lg-1 col-2">
                                		
                                        <?php 
                                                if( isset($theme_option['facebook']) && $theme_option['facebook'] != '' ){ 
                                        ?>
                                                        <a class="header-social" href="<?php echo $theme_option['facebook']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                        <?php 
                                                }
                                        ?>

                                        <?php 
                                                if( isset($theme_option['instagram']) && $theme_option['instagram'] != '' ){ 
                                        ?>
                                                        <a class="header-social" href="<?php echo $theme_option['instagram']; ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                                        <?php 
                                                }
                                        ?>
                                		
                                </div>
                                <!-- /header-icon-wrapper -->
                                    
                    </div>
                    <!-- /header-navigation-wrapper -->

			</div></header>
			<!-- /header -->
