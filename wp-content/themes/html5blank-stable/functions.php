<?php
/*
 *  Author: Rudy Anggono
 *  URL: kitatechnology.com
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	Javascript Defer
\*------------------------------------*/
/* function add_defer_to_js( $url ){ 
    
    if (  FALSE !== strpos( $url, 'defer=' ) //FALSE === strpos( $url, 'contact-form-7' )
      or FALSE === strpos( $url, '.js' )
    ) { 

            // not our file
            return $url;
    }
    
    // Must be a ', not "!
    return "$url' defer='defer";
}
add_filter( 'clean_url', 'add_defer_to_js', 11, 1 ); */

//Add Defer and Async Attributes to Javascript
function add_defer_and_async_attribute($tag, $handle) {
    
        /* 
        // add script handles to the array below
        $scripts_to_check = array('my-js-handle', 'another-handle');

        foreach( $scripts_to_check as $script_check ) {
                if ( $script_check === $handle && strpos($tag, 'defer=') === false ) {
                        $tag = str_replace(' src', ' defer="defer" src', $tag);
                }
                if ( $script_check === $handle && strpos($tag, 'defer=') === false ) {
                        $tag = str_replace(' src', ' async="async" src', $tag);
                }
        }
        return $tag; */
        if( !is_admin() && strpos($tag, 'defer=') === false ){
            
                $tag = str_replace(' src', ' defer="defer" src', $tag);
        }
        if( !is_admin() && strpos($tag, 'async=') === false ){
            
                $tag = str_replace(' src', ' async="async" src', $tag);
        }
        
        return $tag;
}
// if(!is_admin()) add_filter('script_loader_tag', 'add_defer_and_async_attribute', 10, 2);

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width)){
    
        $content_width = 900;
}

if (function_exists('add_theme_support')){
    
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Wayfengshui, use a find and replace
         * to change 'wayfengshui' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'html5blank', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );
        
        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );
    
        // Add Menu Support
        add_theme_support('menus');
        /*  // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
                //'menu-1' => esc_html__( 'Primary', 'html5blank' ),
                'primary'=> esc_html__( 'Primary Menu', 'html5blank' ),
        ) ); */

        // Add Thumbnail Theme Support
        add_theme_support('post-thumbnails');
        add_image_size('popular-post', 991, 312, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

        // Add Support for Custom Backgrounds - Uncomment below if you're going to use
        /*add_theme_support('custom-background', array(
            'default-color' => 'FFF',
            'default-image' => get_template_directory_uri() . '/img/bg.jpg'
        ));*/

        // Add Support for Custom Header - Uncomment below if you're going to use
        /*add_theme_support('custom-header', array(
            'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
            'header-text'			=> false,
            'default-text-color'		=> '000',
            'width'				=> 1000,
            'height'			=> 198,
            'random-default'		=> false,
            'wp-head-callback'		=> $wphead_cb,
            'admin-head-callback'		=> $adminhead_cb,
            'admin-preview-callback'	=> $adminpreview_cb
        ));*/
        
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        /*add_theme_support( 'html5', array(
               'search-form',
               'comment-form',
               'comment-list',
               'gallery',
               'caption',
        ) ); */

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
        ) );
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function html5blank_nav(){
    
	wp_nav_menu(
                array(
                        'theme_location'  => 'header-menu',
                        'menu'            => '',
                        'container'       => 'div',
                        'container_class' => 'menu-{menu slug}-container',
                        'container_id'    => '',
                        'menu_class'      => 'menu',
                        'menu_id'         => '',
                        'echo'            => true,
                        'fallback_cb'     => 'wp_page_menu',
                        'before'          => '',
                        'after'           => '',
                        'link_before'     => '',
                        'link_after'      => '',
                        'items_wrap'      => '<ul>%3$s</ul>',
                        'depth'           => 0,
                        'walker'          => ''
                )
	);
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts(){
    
        if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

            wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
            wp_enqueue_script('conditionizr'); // Enqueue it!

            wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
            wp_enqueue_script('modernizr'); // Enqueue it!

            wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
            wp_enqueue_script('html5blankscripts'); // Enqueue it!
        }
}
// Load HTML5 Blank scripts (footer.php)
function html5blank_footer_scripts() {
    
        //Register the script
        wp_register_script('hamburger-js', get_template_directory_uri() . '/assets/js/hamburger/hamburgers.js', array('jquery'), '1.0.0', true); // Conditional script(s)
        wp_enqueue_script('hamburger-js'); // Enqueue it!
    
        //Register the script
        wp_register_script('global-js', get_template_directory_uri() . '/assets/js/global.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('global-js'); // Enqueue it!
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts(){
    
    if (is_page('pagenamehere')) {
            wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
            wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

/* ADDED BY RUDY **/
function include_css( $in_css, $version = '1.0', $in_directory = false ){
    
        //Check the directory
        $directory = '/assets/css/';
        if( $in_directory !== false ){
            
                $directory = $in_directory;
        }
        
        //Check if file exists
        if( file_exists( get_template_directory() . $directory . $in_css ) ){
        
                //Strip the css extension for the style type
                $style_name = str_replace( '.css', '', $in_css );
                
                //Prepare the style path
                $css_path   = get_template_directory_uri() . '/assets/css/' . $in_css;
                
                //Register the stylesheet
                wp_register_style( $style_name, $css_path, array(), $version, 'all' );
                //wp_enqueue_style( $style_name ); // Enqueue it!

                //Prepare and echo the stylesheet
                echo '<!-- STYLESHEET FOR '. $style_name . ' -->';
                echo '<link rel="stylesheet" id="' . $style_name . '"  href="' . $css_path . '?ver=' . $version . '" media="all" />';
                echo '<!-- END OF STYLESHEET FOR '. $style_name . ' -->';
        }
}

// Load HTML5 Blank styles
function html5blank_styles() {

        wp_register_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap-4.3.1/css/bootstrap.min.css', array(), '1.0', 'all');
        wp_enqueue_style('bootstrap'); // Enqueue it!
        
        //Hamburger Styles
        wp_register_style('hamburger-css', get_template_directory_uri() . '/assets/js/hamburger/hamburgers.min.css', array(), '1.0', 'all');
        wp_enqueue_style('hamburger-css'); // Enqueue it!

        wp_register_style('styles', get_template_directory_uri() . '/assets/css/styles.css', array(), '1.0', 'all');
        wp_enqueue_style('styles'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_html5_menu(){
    
        register_nav_menus(array( // Using array to specify more menus if needed
                'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
                'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
                'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
        ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = ''){
    
        $args['container'] = false;
        return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var){
    
        return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist){
    
        return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes){
    
        global $post;
        if (is_home()) {
            $key = array_search('blog', $classes);
            if ($key > -1) {
                unset($classes[$key]);
            }
        } elseif (is_page()) {
            $classes[] = sanitize_html_class($post->post_name);
        } elseif (is_singular()) {
            $classes[] = sanitize_html_class($post->post_name);
        }

        return $classes;
}

// If Dynamic Sidebar Exists
// If Dynamic WIDGET Exists
if (function_exists('register_sidebar')) {
    
        // Define Sidebar Widget Area
        register_sidebar(array(
                'name'          => __('Sidebar Area', 'html5blank'),
                'description'   => __('Sidebar Widget Area', 'html5blank'),
                'id'            => 'widget-side-bar',
                'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3>',
                'after_title'   => '</h3>'
        ));
        // Define Sidebar Widget Area
        register_sidebar(array(
                'name'          => __('Project Search Form', 'html5blank'),
                'description'   => __('Project Search Form', 'html5blank'),
                'id'            => 'project-search-form',
                'before_widget' => '<div id="%1$s" class="projects-sidebar-widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3>',
                'after_title'   => '</h3>'
        ));
        // Define Footer Widget Left Area
        register_sidebar(array(
                'name'          => __('Footer Left Area', 'html5blank'),
                'description'   => __('Footer Widget Left Part', 'html5blank'),
                'id'            => 'widget-footer-left',
                'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3>',
                'after_title'   => '</h3>'
        ));
        // Define Footer Widget Center Left Area
        register_sidebar(array(
                'name'          => __('Footer Center Left Area', 'html5blank'),
                'description'   => __('Footer Widget Center Left Part', 'html5blank'),
                'id'            => 'widget-footer-center-left',
                'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3>',
                'after_title'   => '</h3>'
        ));
        // Define Footer Widget Center Right Area
        register_sidebar(array(
                'name'          => __('Footer Center Right Area', 'html5blank'),
                'description'   => __('Footer Widget Center Right Part', 'html5blank'),
                'id'            => 'widget-footer-center-right',
                'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3>',
                'after_title'   => '</h3>'
        ));
        // Define Footer Widget Right Area
        register_sidebar(array(
                'name'          => __('Footer Right Area', 'html5blank'),
                'description'   => __('Footer Widget Right Part', 'html5blank'),
                'id'            => 'widget-footer-right',
                'before_widget' => '<div id="%1$s" class="widget-wrapper %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3>',
                'after_title'   => '</h3>'
        ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style(){
    
        global $wp_widget_factory;
        remove_action('wp_head', array(
                $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
                'recent_comments_style'
        ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination(){

        global $wp_query;
        $big = 999999999;
        echo paginate_links(array(
                'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
                'format'    => '?paged=%#%',
                'current'   => max(1, get_query_var('paged')),
                'total'     => $wp_query->max_num_pages
        ));
}

function html5wp_infinitepaginate(){ 

        //Prepare the information
        $loopFile        = 'loop'; //$_POST['loop_file'];
        $paged           = $_POST['page_no'];
        $category_name   = $_POST['category'];
        $posts_per_page  = get_option('posts_per_page');

        # Load the posts
        query_posts( array('paged' => $paged, 'category_name' => $category_name ) ); 
        get_template_part( $loopFile );

        exit;
}
add_action('wp_ajax_infinite_scroll', 'html5wp_infinitepaginate');           // for logged in user
add_action('wp_ajax_nopriv_infinite_scroll', 'html5wp_infinitepaginate');    // if user not logged in

function html5wp_infinite_pagination(){
    
        //Show the pagination
        echo '<a id="inifiniteLoader">Loading... <img src="' . get_template_directory_uri('template_directory') . '/assets/images/ajax-loader.gif" /></a>';
}
function inifinite_scroll_script(){ 
    
        //Get the total number of maximum query
        global $wp_query;
    
        //Default settings
        $category_wrapper   = '.articles-categories-wrapper';
        $pagination_wrapper = '.articles-pagination-wrapper';
        
        //Get the current category 
        $term = get_queried_object();
    
        //Check if category page
        if( is_category() && isset($term->slug) && $term->slug != '' ){ 
                ?>
                <script type="text/javascript">
                        
                        //Load the function
                        (function($) {

                                //On document ready
                                var is_article_ajaxing = false;
                                $(document).ready(function(){
                                    
                                        //Check if the infinite scroll is defined
                                        if ( $("<?php echo $pagination_wrapper; ?>").length > 0 ) {
                                                
                                                //Pagination count
                                                var pagination_count = 2;
                                                var total = <?php echo $wp_query->max_num_pages; ?>;
                                                $(window).scroll(function(){
                                                    
                                                        //Check the scroll position
                                                        var pagination_link = $("<?php echo $pagination_wrapper; ?>").find("a").offset().top;
                                                        var scroll_position = pagination_link - 120; //alert( $(window).scrollTop() + " " + scroll_position); // - $(window).height(); 
                                                        if( $(window).scrollTop() >= scroll_position && is_article_ajaxing === false && pagination_count <= total ){
                                                            
                                                                //Update the ajaxing status
                                                                is_article_ajaxing = true;
                                                            
                                                                //Load the article
                                                                load_article(pagination_count);
                                                                pagination_count++;
                                                        }
                                                }); 
                                                
                                                //Clicking prevent default
                                                $("a#inifiniteLoader").on("click", function(e){
                                                    
                                                        //Prevent Default
                                                        e.preventDefault();
                                                });
                                        }

                                        function load_article(pageNumber){ 
                                        
                                                //Show the link
                                                $("a#inifiniteLoader").show("fast");

                                                //Perform ajax
                                                $.ajax({
                                                        url : "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
                                                        type: 'POST',
                                                        data: "action=infinite_scroll&page_no="+ pageNumber + "&category=<?php echo $term->slug; ?>", 
                                                        success: function(html){
                                                            
                                                                //Hide the loader
                                                                $("a#inifiniteLoader").hide("1000");
                                                                
                                                                //Append the content
                                                                $("<?php echo $category_wrapper; ?>").append(html);   // This will be the div where our content will be loaded
                                                                
                                                                //Update the status
                                                                is_article_ajaxing = false;
                                                        }
                                                });
                                                
                                                //Return false;
                                                return false;
                                        }
                                });

                        })(jQuery);
                </script>
                <?php
        }
} 
add_action('wp_footer', 'inifinite_scroll_script');

// Custom Excerpts
function html5wp_index($length) { // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');

        return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length){
    
        return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = ''){
    
        global $post;
        if (function_exists($length_callback)) {
            add_filter('excerpt_length', $length_callback);
        }
        if (function_exists($more_callback)) {
            add_filter('excerpt_more', $more_callback);
        }
        $output = get_the_excerpt();
        $output = apply_filters('wptexturize', $output);
        $output = apply_filters('convert_chars', $output);
        $output = '<p>' . $output . '</p>';
        echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more){
    
        global $post;
        return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar(){ 
    
    	return true;
        //return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag){
    
        return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html ){
    
        $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
        return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults){
    
        $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
        $avatar_defaults[$myavatar] = "Custom Gravatar";
        return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments(){
    
        if (!is_admin()) {
            if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
                    wp_enqueue_script('comment-reply');
            }
        }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth){
    
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination
add_action('wp_footer', 'html5blank_footer_scripts'); //Add Custom Scripts to wp_footer

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/* =============================================================================
        THEMES SETTINGS -- Added by RUDY
============================================================================== */
// __DIR__ is THEME URL -- TO CALL ON FRONT END USE : $theme_option = get_option('theme_option');
require_once( __DIR__ . '/assets/addon/theme_settings.php');

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null){
    
        return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) { // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.

        return '<h2>' . $content . '</h2>';
}

?>
