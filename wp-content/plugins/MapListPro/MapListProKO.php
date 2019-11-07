<?php
/*
Plugin Name: Map List Pro
Version: 3.12.11
Description: Create interactive maps and lists of locations quickly and easily.
Author: SmartRedFox
Author URI: http://www.smartredfox.com
ChangeLog:
-3.0.6
-- Sort error for distances less than 1
-- Distance display not clearing on all items on clear search click
-- Removed un-needed option on settings page.
-3.0.7
-- Selected item zoom added back in
-- Initial map type shortcode option added in
-- Slide Up/Down moved to custom binding to make animations smooth
-- OSM map type added back in
-- Missing TimThumb file added back in.
-3.0.8
-- Added print directions option in.
-3.0.9
-- Additional styling added to detail page.
-3.0.10
-- Multi maps added back in
-3.0.11
-- All strings localised except shortcode wizard
-- Updated styles for featured images
-3.0.12
-- stayzoomedin option added
-- Fixed bug that was stopping selected zoom from working
-3.0.13
-- Added option to use default infowindows instead of infoboxes
-- Changed enqueues to hopefully stop some conflicts with other maps
-3.0.14
-- Started to abstract complex knockoutjs inline functions that cause wpauto and wptexturize filters to choke when double applied.
-3.0.15
- Added view detail button back in to infowindow.
- Fixed detail page incorrect enqueueing of scripts.
-3.0.16
- Fixed initial sort directions and type ignored.
- Fixed Print directions button keeps getting added when go is clicked.
- Fixed directions routes ignoring measurement units.
-3.1.0
- Fixed placeholder text stopping search in <IE10 with themes that run a shim
- Fixed categories on items blank
- Fixed trailing comma on categories list on item
- Fixed Template file ignoring child themes.
- Fixed View location link in infowindow not opening in new window if selected
- Fixed missing localization for "Categories:" on list items.
- Added custom map markers with custom shadows, and optional custom positioning.
-3.1.1
- Fixed / used instead of \ in icon gets
-3.1.2
- Fixed issue where pins are found in root of pin folder.
-3.2.0
- New filter added to allow extra fields to be added to the location editor.
- New filter added to allow editing of the description, with access to all available custom fields.
-3.2.1
- Misplaced div closure for map only view moved inside correct if statement.
-3.2.2
- Fixed bug that was stopping direction sort firing on geocode
- Added initial sort by direction for parameter, and location search.
-3.2.3
- Added home location option
-3.2.4
- Simplified shortcode output so it doesn't output defaults
-3.2.5
- Added css class to location list items for advanced styling.
- Made Map KO objects available in javascript via an array so that they can be refreshed when used in accordions etc.
- Selecting a location in the list hides all others.
- Categories start off unselected - but all locations show.
-3.2.6
-- Fixed custom css style save not working
-- Fixed insert button not showing properly in IE9
-- Missing localisation for View Location button in infowindow added.
-- Missing localisation for Print Directions button added.
-3.2.7
-- Fixed view location detail button still showing in info window when hidden.
-3.2.8
-- Fixed Google Chrome crash on directions print cancel.
-3.2.9
-- Fixed no search results on passed parameter issue with simple search
-- Added Google Map Language option to settings page
-- Fixed issue with map array causing maps to be generated twice
-- Fixed sort drop down hiding itself straight away
-3.3.0
-- Added day category mode - Add a category for each day to show only categories from that day
-3.3.1
-- Expand if only a single item returned
-- Fixed empty address causing errors
-- Fixed incomplete category save causing errors
-- Fixed category ordering getting ignored
-3.3.2
-- Added category search to text and combo search types
-- Removed some console.log calls from maplistfront.js
-- Fixed paging count not correct after search
-- Abstracted current page count from html
-- Added focus style to search boxes to make text clearer
-- Fixed missing "of" localisation in paging.
-3.3.3
-- Fixed send media to editor conflict - cmb issue.
-3.3.4
-- Stopped no location found message showing ahead of load.
-- Added post object to description filter so users can get custom fields etc.
-3.3.5
-- Added check in editor for matching place name and first address line to stop duplicates.
-- Made category label on filter button configurable.
-3.3.6
-- Removed trailing comma that was causing issues in ie7/8
3.3.7
-- Added category slug to each list item for styling etc.
-- SSL check for Google Maps API url added.
-- Category list sorted by slug
-- Reordered shortcode list for easier access
-- Added searchdistances attribute to shortcode for changing distance drop down
3.3.8
-- Added category slug to drop down list items
-- Added categoriesaslist option to shortcodes
3.3.9
-- Fixed error if no categories created
3.4.0
-- Fixed address line not keeping line breaks
-- Removed shadows from maplistfront.js as they are no longer supported by Google
3.4.1
-- Added directions type option into shortcode
3.4.2
-- Fixed directions type selection
-- Category order now set to be alphabetical
3.4.3
-- Fixed new category layout check
3.4.4
-- Updated theme file check (Thanks Fran).
-- Category sort updated to work from title not slug
3.5.0
-- Updated cmb metaboxes to most recent version
3.5.5
-- Changed the way that the detail page is rendered to make it work with all templates
-- Added minimum zoom code for single location into core
-- Added check in-case do_shortcode is called multiple times
-- Changed language file names and fixed textdomain call being made too early (Thanks foo41)
-- Made location slug translatable
-- Added hideuntilsearch shortcode option
-- Fixed a number of minor, non-breaking issues with js file (missing semicolons and radix params)
3.6.0
-- Multi category filtering added (alpha)
-- List item closes on marker close
-- Fixed conflict with some Woothemes
-- Fixed zoom issues when using selectedzoomlevel and keepzoomlevel together
-- Return keypress now submits search
-- Fixed clear search button not showing
-- Added style for checkboxes (works with categoriesaslist="true")
-- Updated fix for pages that have do_shortcode called multiple times.
-- Added 8 new "flat" styles
3.6.1
-- Added an option on the settings page to enter custom styles for the map
3.6.2
-- Fixed url slug
-- Fixed locations not sorting by distance automatically when using geolocation
-- Moved css enqueue to the same place as the javascript so it only gets loaded when needed
3.6.3
-- Fixed css not loading for detail pages
3.6.4
-- Added ssl check for add location pages
-- Multicategory filtering (beta)
3.6.5
-- Added multicategory categories to list items
3.6.6
-- Per map caching
3.6.7
-- Infowindow opens if only one location found
3.6.8
-- First category hides items in list when not showing
-- Fixed missing close div on detail page
-- Improved the logic for the address filler
-- When only one location visible the infowindow expands
-- Fixed print directions issue
3.6.9
-- Fixed error on location save
-- Added clustergridsize back in
3.6.10
-- Fixed error on expand in list only mode
3.6.11
-- Fixed issue with per category and per location filtering
-- Search bar now shows in map only mode
-- Added hidefilterbar shortcode option to hide all filter/search/sort options in one go
3.6.12
-- Marker clustering fixed
3.6.13
-- Fixed issue when no cache ever created
3.6.14
-- Fixed categoriesticked shortcode attribute not working
3.6.15
-- Fixed home location mode
-- Made menus hide by default after click (can be overriden with menushideonselect)
-- Added override for single item expansion (expandsingleresult)
-- Added option to make only one category be selected at one time (categoriesmultiselect)
-- Updated reset to clear more stuff
-- Added clearfix to stop layout issues for left and right layouts
3.6.16
-- Made categories label on items use text from setting
-- Fixed thumbnails not showing correctly on detail page
-- Removed timthumb script
-- Add custom event to resize maps (useful for when the map starts off hidden)
3.6.17
-- Updated language files for en_GB and fr_FR
3.6.18
-- Fixed single result expanded issue.
3.6.19
-- Accordion style layout added
3.6.20
-- Localised kms and miles in front end
-- Switched to use jquery json parsing for backwards compatibility
3.6.21
-- Changes to acccordion mode to make it work better
3.6.22
-- Manual category ordering (from icons page)
3.6.23
-- Fixed multi-select from marker bug
3.7
-- New marker cluster added (Marker Clusterer Plus)
-- InfoBoxes switched to use infoBubbles to me more "responsive"
3.7.1
-- Added help text to lat/lng fields
-- Stopped address from getting overwritten when marker moved in editor
-- Fixed missing spaces between multiple taxonomies on list items
-- Fixed expandsingleresult="false" not working
3.7.2
--Added hideinfowindow option to shortcode
3.7.3
-- Drastically sped up custom icons page
3.7.4
-- Changed icon directory scan to use glob
3.7.5
-- Fixed issue on location creation page
-- Fixed single item not expanding in list only mode
-- Add minimum width and height to infobubble
-- Changed the permalink flush so that it is versioned
3.7.6
-- Added new image resizer in (https://github.com/bfintal/bfi_thumb)
-- Added imagewidth and imageheight shortcode attributes in so that image sizes can be overridden.
3.7.7
-- Fixed path issue for resize tool
-- Stopped infowindow showing by default on detail page
3.8
-- Infowindow options expanded to allow infobox, infobubbles, and standard infowindows.
-- Infoboxes made to work well on responsive set ups.
3.8.1
-- Added infowidth and infoheight shortcode options to specify infowindow height and width in %
-- Added streetview shortcode option to allow streetview to be switched off easily.
3.8.2
-- Added lots of undocumented shortcode options into the wizard (more to come!)
3.8.3
-- Missing localisation strings fixed
3.8.4
-- Added form tags to the search field.
-- Clear directions on search clear
3.8.5
-- Added the ability to work with other post types
-- Changed the img bindings so they shouldn't show at all if not specified
3.8.6c
3.8.7
-- Made Go button appear on mobile keyboard and keyboard hide on form submit.
3.8.8
-- Added initialsortype="categorytitle" and "category" to enable the list to be grouped by category
3.9.0
-- hideuntilsearch option added in to allow locations to stay hidden until search terms are entered.
   Only works with manual start location and zoom.
3.9.1
-- Fixed categories hiding after clicking when in shown as a list.
3.9.3
-- Pulled custom map styles into the detail page.
-- Per location icons added.
3.9.4
-- Add language parameter to edit page's Google Maps call
-- Added category slug to list items for optional styling
3.9.5
-- Made accordion mode much more robust, and removed unneeded code
-- Fix for home location mode showing the home location twice if included in the map options.
-- Get directions option added to detail page
3.9.6
-- Edit page javascript error fixed.
3.9.7
-- Fix for location distances always using metric distances
-- Fix for initialsorttype stopping next attribute in shortcode from working
-- Removed duplicate tick box on other options
3.9.8
-- Fixed zoom issues for homelocation mode
-- Added additional search parameter for combo mode - locationSearchTerms & textSearchTerms can now be used
-- Added additional search parameter searchDistance - allows preselection of distance drop down
-- Updated English, French, and Hungarian po/mo files.
-- Added Czech language files (thanks Zefyr!)
3.9.9
-- Added additional filter (mlp_location_detail_description) to allow fields to be pulled into detail page
3.9.10
-- Added filter to allow you to move the map parts about (mlp_display_parts)
-- Added filter to change what shows in the infobox (mlp_infobox_parts)
-- Added filter to show what displays in the detail page (mlp_detail_page_parts)
-- Fixed single select categories not working
-- Added workaround for MarkerClusterer Plus bug causing clusters to disappear
-- Fixed clusters disappearing when used with homelocation
-- Allow filtering by category slug
3.9.11
-- Fixed categories hiding when clicked in list mode
-- Added tick to selected categories in list mode
3.9.12
-- Fixed multiple taxonomies "and" filtering
3.9.13
-- Fixed custom styles not being pulled from theme directory
3.9.14
-- Message to user now shows when geocoded search fails.
3.9.15
-- Added option to disable scrollwheel
3.9.16
-- Added span around category list in items to allow css hiding
3.9.17
-- Fixed issue on detail page that caused error $maplocation undefined
3.9.18
-- Fixed paging showing when in map only mode.
-- Fixed responsive issues with category boxes etc.
3.9.19
-- Fixed the hideinfowindow="true" option so it zooms and expands list item correctly.
3.10.0
-- Added option to turn comments on in the settings.
3.10.1
-- Fixed scroll wheel disabling issue
3.10.2
-- Changed clusterer to always use https
-- Changed paths so that wp_plugin_url is replaced by https plugin friendly option.
3.10.3
-- Changed activate function to stop error on activation in some server setups (thanks Gotequity).
3.10.4
-- Added categoriesmatchall option to shortcode to allow for AND filtering instead of OR in categories.
-- Added initiallyselectedcategories option to shortcode to allow some categories to start preselected
-- Fixed list items not closing when a different location is picked on the map.
3.10.5
-- Extended sort categories option to additional taxonomies
3.10.6
-- Get directions now fires when the enter key is pressed
3.10.7
-- Updated English po/mo files
-- Changed throttle value for main filter
-- Update knockout to 3.3.0
3.10.8
-- Allowed fixed initial zoom position to be overridden by search
3.10.9
-- Fixed categorymultiselect="false" not working in accordion mode
3.10.10
-- Switched all taxonomies to show as list if that option is selected
3.10.11
-- Fixed hideaddress option not hiding the address in the list items
3.11.0
-- Fixed expand and contract of single item
-- Fixed all taxonomies as list repeating first category
3.11.1
-- Renamed php classes to stop potential clashes
3.11.2
-- Made initial sort order default after clear all
-- Detail page directions now respect units option from main settings
3.11.3
-- Clicking on a marker now switches the list to the page that the location is on
3.11.5
-- Fixed single location not zooming to show geo marker
-- Updated close cross for infowindow to use https
-- Added jscs style guide file (not fully implemented yet)
-- Fixed paging not showing correct number
3.11.6
-- Fixed locations not closing correctly
3.11.7
-- Closing an accordion section now closes all locations when in single category mode
3.11.8
-- Added API key option to settings
3.12.0
-- Added singlelocationzoom option to the shortcode to allow single location zoom to be set
-- Changed Kms text to Km
3.12.1
-- Fixed list items not expanding when in list only view
3.12.2
-- Changed the way that the search and location text gets added to stop translation issues (thanks heike-carle)
-- Fixed the title not respecting openinnew in infowindows
3.12.3
-- Fixed issue with infobox widths
-- Fixed search box showing html inside it - thanks AaronR.
3.12.4
-- Updated .pot file, en-gb and en-us translations.
-- Made settings page clearer
3.12.5
-- Removed debug code
3.12.6
-- Made categoriesMultiSelect work for additional taxonomies as well
3.12.7
-- Removed sensor parameter
-- Added underscore in for js
-- Fixed multicategory filtering only selecting items from the last category selected
3.12.8
-- Updated marker clusterer plus to 2.1.4
3.12.9
-- Fixed deprecated warning for class constructor issue.
3.12.10
-- Fixed Count error on PHP 7.2
-- Start of underscore introduction for simplifying front-end
3.12.11
-- Fixed zoom issue on map
-- Fixed array warning on map listing admin page
-- Fixed warning for undefined search messages
 */

class MapListProKO {

    public static $version = "3.12.11";

    public static $counter = 0;
    public static $maps = Array();
    public static $isOnPage = false;
    public $mlpoutputhtml;
    public $numberOfLocations;
    public static $cachePeriod = 604800000;

    //Settings
    //=========================
    //The image in the list item and infowindow
    public static $imageWidth = 50;
    public static $imageHeight = 50;

    //The image on the location detail page
    public static $featuredImageWidth = 100;
    public static $featuredImageHeight = 100;

    //The icon on the list items
    public static $iconImageWidth = 25;
    public static $iconImageHeight = 25;

    //TODO: Add a setting for this
    //Post types that can be used for locations - Add your post type here if you want to use them as locations
    public $postTypesToUse = array('maplist');

    //Map id's
    public $MapID = 0;

    /**
     * Class Constructor
     */
    function __construct() {
        $this->plugin_defines();
        $this->setup_actions();

        // Include the library
        require_once( MAP_LIST_KO_PLUGIN_PATH . 'includes/libraries/mr-image-resize.php');
    }

    /**
     * Defines To Be Used Anywhere In Wordpress After The Plugin Has Been Initiated.
     */
    function plugin_defines(){
        define( 'MAP_LIST_KO_PLUGIN_PATH', trailingslashit( WP_PLUGIN_DIR.'/'.str_replace(basename( __FILE__ ),"",plugin_basename( __FILE__ ) ) ) );
        define( 'MAP_LIST_KO_PLUGIN_URL' , plugin_dir_url(__FILE__) );
    }


    /*Activation stuff - is run once on plugin activation*/
    public static function map_list_pro_activate(){
        //Set the default to be full view
        update_option('maplist_fullpageviewenabled','true');
    }

    /**
     * Setup actions
     */
    function setup_actions(){

        //New check to make sure new category pin system is in use - if not run translate
        $newPinStyle = get_option('mlp_pins_new_style');

        if($newPinStyle != 'true'){
            $oldCategoryIcons = get_option('mlp_custom_category_icons_options');
            if($oldCategoryIcons != ''){
                $newCategoryIcons = array();

                foreach($oldCategoryIcons as $category => $oldIcon){
                    $position_iconid = explode (',',$oldIcon);
                    $position_iconid[1] = 'default/mapmarker' .  $position_iconid[1] . '.png';
                    $position_iconid[2] = 'default/shadow.png';
                    $newCategoryIcons[$category] = $position_iconid;
                }

                //Update the options
                update_option('mlp_custom_category_icons_options',$newCategoryIcons);
                //Don't check again
                update_option('mlp_pins_new_style','true');
            }
        }

        //Register the maplist_location_category taxonomy and maplist post type
        add_action('init', array($this,'maplist_cat_posttype_register'));

        //Add meta boxes to locations page
        add_action( 'init', array($this,'maplist_metaboxes'));

        //Location page metaboxes
        add_filter( 'cmb_meta_boxes', array($this,'location_metaboxes'));

        //Add map option to metaboxes
        add_action( 'cmb_render_map', array($this,'cmb_render_map'), 10, 2 );

        //Add map option to metaboxes
        add_action( 'cmb_render_markers', array($this,'cmb_render_markers'), 10, 5 );

        add_action('plugins_loaded', array($this,'plugin_loaded'));

        //Create single page code and data
        add_action("template_redirect", array($this,'maplist_theme_redirect'));

        if(is_admin()){
            //Add shortcode button to editor
            add_action('init', array($this,'add_maplist_shortcode_button'));
            //Attach the additonal menu items
            add_action('admin_menu', array($this,'create_admin_menus'));
            //Ajax calls from shortcode wizard
            add_action('wp_ajax_get_all_maplocations', array($this,'get_all_maplocations_ajax'));
            add_action('wp_ajax_get_all_mapcategories', array($this,'get_all_mapcategories_ajax'));
            //setup column headings on map locations list page
            add_filter('manage_edit-maplist_columns', array($this,'add_new_maplist_columns'));
            //setup column data for the map locations list page
            add_action('manage_maplist_posts_custom_column',  array($this,'manage_maplist_columns'), 10, 2);
            //Hook up admin init - use if later binding needed
            add_action( 'admin_enqueue_scripts', array( &$this, 'admin_init' ) );
            //Post saved
            add_action( 'save_post', array($this,'maplist_save_postdata'));
        }
        else{
            add_action( 'template_redirect' , array( $this , 'frontend_scripts_styles' ) );
            add_shortcode('maplist', array($this, 'register_maplist_shortcode'));
        }
    }


    function plugin_loaded(){

        //Set domain for translations
        load_plugin_textdomain( 'maplistpro', false, dirname( plugin_basename( __FILE__ ) ) );
    }

    /* When a location is saved clear all caches */
    function maplist_save_postdata( $post_id ) {
        // verify if this is an auto save routine.
        // If it is our form has not been submitted, so we dont want to do anything
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
          return;

        //TODO:MAKE SURE THIS IS CLEARING THE CACHE
        if (isset($_POST['post_type']) && in_array($_POST['post_type'],$this->postTypesToUse))
        {
            //Add these transients to the option so we can clear them if we need to
            $transients = get_option('maplist_transients_array');

            if($transients){
                foreach($transients as $tran){
                    delete_transient('maplist_' . $tran);
                    delete_transient('maplisthtml_' . $tran);
                }
            }
        }

        return $post_id ;
    }

    function maplist_cat_posttype_register(){

        //See if full page view is enable
        $fullPageViewEnabled = get_option('maplist_fullpageviewenabled',false);
        $commentsEnabled = get_option('maplist_commentsenabled',false);

        $boxesToShow = array('title','thumbnail');

        //Enable full editor
        if($fullPageViewEnabled == 'true'){
            array_push($boxesToShow, "editor");
        }

        //Enable full editor
        if($commentsEnabled == 'true'){
            array_push($boxesToShow, "comments");
        }

        //register custom post type
        $args = array(
            'labels' => array(
                'name' => _x('Map locations', 'Map locations general name','maplistpro'),
                'singular_name' => _x('Map location', 'Map locations singular name','maplistpro'),
                'add_new' => _x('Add new', 'maplist item','maplistpro'),
                'add_new_item' => __('Add new map location','maplistpro'),
                'edit_item' => __('Edit map location','maplistpro'),
                'new_item' => __('New map location','maplistpro'),
                'view_item' => __('View map location','maplistpro'),
                'search_items' => __('Search maps','maplistpro')
            ),
            'exclude_from_search' => true,
            'public' => true,
            'show_ui' => true,
            // 'publicly_queryable' => false, //Turn off the url for location
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => array('slug' =>  __('location','maplistpro')),
            'menu_icon' => MAP_LIST_KO_PLUGIN_URL . 'images/mappin.png',
            'supports' => $boxesToShow //Boxes to show in the panel

        );

        register_post_type('maplist' , $args );

        //register custom taxonomy
        $categorylabels = array(
            'name' => _x( 'Location Categories', 'map_location categories','maplistpro' ),
            'singular_name' => _x( 'Location Category', 'map_location categories','maplistpro' ),
            'search_items' => _x( 'Search Location Categories', 'map_location categories','maplistpro' ),
            'popular_items' => _x( 'Popular Location Categories', 'map_location categories','maplistpro' ),
            'all_items' => _x( 'All Location Categories', 'map_location categories','maplistpro' ),
            'parent_item' => _x( 'Parent Map Location Category', 'map_location categories','maplistpro' ),
            'parent_item_colon' => _x( 'Parent Map Location Category:', 'map_location categories','maplistpro' ),
            'edit_item' => _x( 'Edit Map Location Category', 'map_location categories','maplistpro' ),
            'update_item' => _x( 'Update Map Location Category', 'map_location categories','maplistpro' ),
            'add_new_item' => _x( 'Add New Map Location Category', 'map_location categories','maplistpro' ),
            'new_item_name' => _x( 'New Map Location Category', 'map_location categories','maplistpro' ),
            'separate_items_with_commas' => _x( 'Separate map location categories with commas', 'map_location categories','maplistpro' ),
            'add_or_remove_items' => _x( 'Add or remove map location categories', 'map_location categories','maplistpro' ),
            'choose_from_most_used' => _x( 'Choose from the most used map location categories', 'map_location categories','maplistpro' ),
            'menu_name' => _x( 'Location Categories', 'map_location categories','maplistpro' ),
        );

        $categoryargs = array(
            'labels' => $categorylabels,
            'public' => true,
            'show_in_nav_menus' => true,
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
            'rewrite' => true,
            'query_var' => true
        );

        register_taxonomy( 'map_location_categories', $this->postTypesToUse, $categoryargs );


        // MULTICATEGORY
        // Instructions:
        // Add this code to your functions.php file to add a new category attached to map locations
        // Then add usealltaxonomies="true" to your shortcode to make them display in the front end

        // $categoryargsFood = array(
        //     'labels' => array(
        //         'label' => __( 'Food type' ),
        //         'rewrite' => array( 'slug' => 'food' ),
        //         'hierarchical' => true,
        //         ),
        //     'label' => "Food type",
        //     'public' => true,
        //     'show_in_nav_menus' => false,
        //     'show_ui' => true,
        //     'show_tagcloud' => false,
        //     'hierarchical' => true,
        //     'rewrite' => true,
        //     'query_var' => true
        // );

        // register_taxonomy( 'map_location_categories_food', $this->postTypesToUse, $categoryargsFood );

        //See if we've flushed permalinks, if not flush them
        if(!get_option('maplist_permalinksflushed' . self::$version)){
            flush_rewrite_rules();
            update_option('maplist_permalinksflushed' . self::$version,"true");
        }
    }

    //Move the search box etc around
    function get_main_map_display_parts(){

        $displayParts = array('map','search','message','list','paging');

        return apply_filters( 'mlp_display_parts', $displayParts);
    }

    //This allows you to set what shows in the infoboxes on the map
    function get_infobox_parts(){

        //Available options are :
        // "title" : The location title
        // "thumbnail" : The featured image thumbnail
        // "description" : The short description (as shows in the list)
        // "simpledescription" : The short description without the address
        // "categories" : Any categories specified for this item
        // "address" : The location address field
        $infoboxParts = array("title","thumbnail","simpledescription");

        return apply_filters( 'mlp_infobox_parts', $infoboxParts);
    }


    //This allows you to set what shows on the detail page, and in what order
    function get_detail_page_parts(){

        //Available options are :
        // "map" : The map
        // "title" : The locatioon title
        // "content" : The long description
        // "shortdescription" : The short description (as shows in the list)
        // "custom" : Any custom fields you add via the detail hook
        // "address" : The location address field
        // "directions" : Directions - only shows if enabled in settings;
        $detailParts = array("map","content","custom","address","directions");

        return apply_filters( 'mlp_detail_page_parts', $detailParts);
    }

    function maplist_theme_redirect() {

        //Only load if needed
        global $post_type;

        if('maplist' === $post_type && is_single()){

        global $wp;

        //A Specific Custom Post Type
        if (isset($wp->query_vars["post_type"]) && in_array($wp->query_vars["post_type"],$this->postTypesToUse)) {


            $this->frontend_scripts_styles();

            //Load css here so it only gets loaded when needed
            wp_enqueue_style( 'maplistCoreStyleSheets');
            wp_enqueue_style( 'maplistStyleSheets');

            //Create and pass the location
            $kolocation = new MLP_location();

            global $post;

            //Get all meta fields for this post (no need to pass id as this defaults to current post)
            $locationMetaFields = get_post_custom();

            //Store the content before we fill it with what we need
            $tempContent = $post->post_content;

            //Get all terms used by this location
            $lat = $locationMetaFields['maplist_latitude'][0];
            $lng = $locationMetaFields['maplist_longitude'][0];
            $temp = $locationMetaFields['maplist_alternateurl'][0];
            $alternateUrl = $temp == '' ? get_permalink($post->ID) : $locationMetaFields['maplist_alternateurl'][0];
            $imageUrlTemp = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID));

            $imageUrl = $imageUrlTemp[0];

            $address = wpautop($locationMetaFields['maplist_address'][0],true);

            //Create object
            $kolocation->title = $post->post_title;
            $kolocation->cssClass = 'loc-' . $post->ID;
            $kolocation->address = $address;
            $kolocation->latitude = $lat;
            $kolocation->longitude = $lng;
            $kolocation->pinColor = '';
            $kolocation->imageUrl = $imageUrl;
            $kolocation->_mapMarker = '';
            $kolocation->locationUrl = $alternateUrl;

           //Use the category or the location pin - location always wins out if both
            $markerUrl = get_post_meta($post->ID, 'maplist_marker', true);

            if($markerUrl && $markerUrl !== '/'){
                $kolocation->pinImageUrl = MAP_LIST_KO_PLUGIN_URL . 'images/pins/' . $markerUrl;
            }

            //Get description, fire it through wpautop to convert crs to p tags, then do shortcode stuff
            $tempDesc = do_shortcode(wpautop($locationMetaFields['maplist_description'][0],true));

            $kolocation->description = $tempDesc;

            //Encode all data to json
            $kojsobject = json_encode($kolocation);

            $disableInfoBoxes = get_option('maplist_disableinfoboxes');

            //Google map infoboxes
            if($disableInfoBoxes != 'true'){

                $infoBoxStyle = get_option('maplist_infoboxstyle');

                if($infoBoxStyle === "bubble"){
                    wp_register_script( 'infowindow_custom', MAP_LIST_KO_PLUGIN_URL . 'js/infobubble_packed.js', array('map_list-google-places'));
                }
                else{
                    wp_register_script( 'infowindow_custom', MAP_LIST_KO_PLUGIN_URL . 'js/infobox_packed.js', array('map_list-google-places'));
                }
            }

            //See if there are any custom styles
            $customStyles = stripslashes(get_option('maplist_custom_map_stylers',''));

            $params = array("infoboxstyle" => $infoBoxStyle,
                            'disableInfoBoxes' => $disableInfoBoxes,
                            "location" => $kojsobject,
                            'measurementUnits' => get_option('maplist_measurementunits'),
                            'noGeoSupported' => __('Geolocation is not supported by this browser.','maplistpro'),
                            "pluginurl" => MAP_LIST_KO_PLUGIN_URL,
                            'printDirectionsMessage' => __('Print directions','maplistpro'),
                            'customstylers' => $customStyles);

            $deps = array('knockout','jquery','map_list-google-places');

            if($disableInfoBoxes != 'true'){
                $deps[] = 'infowindow_custom';
            }

            //Get the content together for the page
            $pageContent = '<div class="FullMapPage prettyMapList">';

                $displayParts = $this->get_detail_page_parts();

                foreach($displayParts as $part){

                    switch(strtolower($part)){
                        case "map":
                            $pageContent .= '<div id="SingleMapLocation"></div>';
                            break;
                        case "title":
                            $pageContent .= "<h2 id='Maplocation-" . get_the_ID() . "'>" . get_the_title() . "</h2>";;
                            break;
                        case "content":

                            $pageContent .= '<div id="MapDescription" class="cf">';

                                //Post featured image
                                if(has_post_thumbnail($post->ID)){

                                    $imageUrlTemp = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID));

                                    $imageUrl = mlp_mr_image_resize($imageUrlTemp[0], self::$featuredImageWidth, self::$featuredImageHeight, true, 'tr', false);

                                    $pageContent .= "<img src='" . $imageUrl . "' class='float_left maplist_featuredimage'/>";
                                }

                                //Get the main content, format it, and display it
                                $content = $post->post_content;
                                $content = apply_filters('the_content', $content);
                                $content = str_replace(']]>', ']]&gt;', $content);
                                $content = do_shortcode(  $content );

                                if($content != ""){
                                    $pageContent .= $content;
                                }

                            $pageContent .= '</div>';//#MapDescription
                            break;
                        case "shortdescription":
                            $pageContent .= $tempDesc;
                            break;
                        case "custom":
                            //GET CUSTOM FIELDS FROM FILTER
                            $pageContent = apply_filters( 'mlp_location_detail_description', $pageContent,$locationMetaFields,$kolocation);
                            break;
                        case "address":
                            //Show address if it is set
                            if(isset($address)){
                                $pageContent .= '<div id="MapAddressContainer">';
                                    $pageContent .= '<span id="MapAddressLabel">';
                                        $pageContent .= __('Address:','maplistpro');
                                    $pageContent .= '</span>';

                                    $pageContent .= '<div id="MapAddress">';
                                        $pageContent .= $address;
                                    $pageContent .= '</div>';//#MapAddress
                                $pageContent .= '</div>';//#MapAddressContainer
                            }
                            break;
                        case "directions":
                            //Get directions
                            $showdirections = get_option('maplist_detailpagedirections');

                            if($showdirections == 'true'){
                                $pageContent .= "<!-- Directions -->";
                                $pageContent .= "<div class='getDirections'>" . __('Get directions from','maplistpro'). " <input class='directionsPostcode' type='text' value='' size='10'/>";
                                    $pageContent .= "<a href='#' class='getdirections btn corePrettyStyle'>" . __('Go','maplistpro'). "</a>";
                                    // $pageContent .= "<a href='#' class='getdirectionsgeo btn corePrettyStyle'>" . __('Geo locate me','maplistpro'). "</a>";
                                    $pageContent .= "<div class='mapLocationDirectionsHolder'></div>";
                                    $pageContent .= "<div class='mapLocationDirectionsError' style='display:none'><p class='prettyMessage'>" . __('Unable to find any directions.','maplistpro') . "</p></div>";
                                $pageContent .= "</div>";
                            }
                            break;
                    }

                }


            $pageContent .= '</div>';//#FullMapPage


            //Set the content to our output
            $post->post_content = $pageContent;

            //Styles
            //Core styles
            wp_register_style('maplistCoreStyleSheets', MAP_LIST_KO_PLUGIN_URL . 'css/MapListProCore.css', null, self::$version);

            //Colour Styles - Get selected stylesheet
            $stylesheet_url = $this->get_stylesheet_to_use();
            wp_register_style('maplistStyleSheets', $stylesheet_url,null, self::$version);

            //Scripts
            wp_register_script( 'FullPageMapScript', MAP_LIST_KO_PLUGIN_URL . 'js/fullPageMap.js', $deps, self::$version, true);
            wp_localize_script('FullPageMapScript', 'maplistFrontScriptParams', $params );
            wp_enqueue_script('underscore');
            wp_enqueue_script( 'FullPageMapScript' );

        }
        }
    }

    /*
     * Retrieves the css file that matches the style the user has selected, or falls back to a default if none
     */
    function get_stylesheet_to_use(){
        //Get user selected stylesheet if any
        $maplist_stylesheet_to_use = get_option('maplist_stylesheet_to_use');

        $stylesheet_url = MAP_LIST_KO_PLUGIN_URL . 'styles/Grey_light_default.css';

        if($maplist_stylesheet_to_use != ""){

            if(strpos($maplist_stylesheet_to_use, '#') !== FALSE){

                $stylesheet_url = get_stylesheet_directory_uri() . '/prettymapstyles/' . $maplist_stylesheet_to_use;
            }
            else{
                //Add our prettylist stylesheet
                $stylesheet_url = MAP_LIST_KO_PLUGIN_URL . 'styles/' . $maplist_stylesheet_to_use;
            }

        }

        return $stylesheet_url;
    }


    function frontend_scripts_styles()
    {


        //Core styles
        wp_register_style('maplistCoreStyleSheets', MAP_LIST_KO_PLUGIN_URL . 'css/MapListProCore.css',null,self::$version);

        //Colour Styles - Get selected stylesheet
        $stylesheet_url = $this->get_stylesheet_to_use();

        wp_register_style('maplistStyleSheets', $stylesheet_url,null,self::$version);

        //Add jQuery and underscore
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script('underscore');

        $additionalParams = $this->getAdditionalMapParams();

        //Switch depending on https
        if (is_ssl()) {
            wp_register_script( 'map_list-google-places', 'https://maps.googleapis.com/maps/api/js?libraries=places' . $additionalParams);
        }
        else{
            wp_register_script( 'map_list-google-places', 'http://maps.googleapis.com/maps/api/js?libraries=places' . $additionalParams);
        }


        //Google map clusterer
        wp_register_script( 'map_list-google-marker-clusterer', MAP_LIST_KO_PLUGIN_URL . 'js/markerclusterer_packed.js', array('map_list-google-places'));

        $disableInfoBoxes = get_option('maplist_disableinfoboxes');

        //Google map infoboxes
        if($disableInfoBoxes != 'true'){

            $infoBoxStyle = get_option('maplist_infoboxstyle');

            if($infoBoxStyle === "bubble"){
                wp_register_script( 'infowindow_custom', MAP_LIST_KO_PLUGIN_URL . 'js/infobubble_packed.js', array('map_list-google-places'));
            }
            else{
                wp_register_script( 'infowindow_custom', MAP_LIST_KO_PLUGIN_URL . 'js/infobox_packed.js', array('map_list-google-places'));
            }
        }

        //Knockout
        wp_register_script('knockout', MAP_LIST_KO_PLUGIN_URL . 'js/knockout-3.3.0.js',null,self::$version,true);
    }

    /***********************************
     * ADMIN ONLY STUFF
     *
     */

    //Initialize the metabox class
    function maplist_metaboxes(){
        if ( ! class_exists( 'cmb_Meta_Box') ){
            require_once(MAP_LIST_KO_PLUGIN_PATH . 'cmb_metaboxes/init.php');
        }
    }

    function location_metaboxes( $meta_boxes ) {
        $prefix = 'maplist_'; // Prefix for all fields

        //FIELDS TO SHOW IN EDITOR
        //================================

        $meta_boxes[] = array(
                'id' => 'location_metabox',
                'title' => __('Location Details','maplistpro'),
                'pages' => $this->postTypesToUse, // post type
                'context' => 'normal',
                'priority' => 'high',
                'show_names' => true, // Show field names on the left
                'fields' => array(
                        array(
                        'name' => __('Find location','maplistpro'),
                        'desc' => __('Location picker','maplistpro'),
                        'id' => $prefix . 'map',
                        'type' => 'map'),
                        array(
                        'name' => __('Latitude','maplistpro'),
                        'desc' => __('This should be in decimal format with no units (e.g. 51.508093)','maplistpro'),
                        'id' => $prefix . 'latitude',
                        'type' => 'text'),
                        array(
                        'name' => __('Longitude','maplistpro'),
                        'desc' => __('This should be in decimal format (e.g. -0.087720)','maplistpro'),
                        'id' => $prefix . 'longitude',
                        'type' => 'text'),
                        array(
                        'name' => __('Short description','maplistpro'),
                        'desc' => __('This appears on the expanded items in the list','maplistpro'),
                        'id' => $prefix . 'description',
                        'type' => 'wysiwyg'),
                        array(
                        'name' => __('Address','maplistpro'),
                        'desc' => __('Enter address','maplistpro'),
                        'id' => $prefix . 'address',
                        'type' => 'textarea_small'),
                        array(
                        'name' => __('Alternate web address','maplistpro'),
                        'desc' => __('(optional) A full website url (including http://).','maplistpro'),
                        'id' => $prefix . 'alternateurl',
                        'type' => 'text'),
                        array(
                        'name' => __('Custom icon','maplistpro'),
                        'desc' => __('(optional) Pick an icon for this location - this will override the category markers.','maplistpro'),
                        'id' => $prefix . 'marker',
                        'type' => 'markers')
                )
        );

        //Filter here is to allow extra fields to be added
        $meta_boxes[0]['fields'] = apply_filters( 'mlp_location_metaboxes', $meta_boxes[0]['fields']);

        return $meta_boxes;
    }

    function getAdditionalMapParams(){

        $additionalParams = '';

        //Get language needed
        $google_map_language = get_option('maplist_google_map_language');

        if($google_map_language != '' && $google_map_language != 'en'){
            $additionalParams .= '&language=' . $google_map_language;
        }

        // API key
        $google_maps_API_key = get_option('maplist_google_maps_api_key');

        if(isset($google_maps_API_key) && $google_maps_API_key !== null && $google_maps_API_key !== ''){
            $additionalParams .= '&key=' . $google_maps_API_key;
        }

        return $additionalParams;
    }

    //Render map field in admin
    function cmb_render_map( $field, $meta ) {

        //Add Google maps
        $additionalParams = $this->getAdditionalMapParams();

        //Switch depending on https
        if (is_ssl()) {
            wp_register_script( 'map_list-google-places', 'https://maps.googleapis.com/maps/api/js?libraries=places' . $additionalParams);
        }
        else{
            wp_register_script( 'map_list-google-places', 'http://maps.googleapis.com/maps/api/js?libraries=places' . $additionalParams);
        }


        //Get start position
        $defaultEditMapLocationLat = get_option('maplist_default_edit_map_location_lat');
        $defaultEditMapLocationLong = get_option('maplist_default_edit_map_location_long');
        $defaultEditMapZoom = get_option('maplist_default_edit_map_zoom');

        if($defaultEditMapLocationLat == '' || $defaultEditMapLocationLong == ''){
            $defaultEditMapLocationLat = '40.3';
            $defaultEditMapLocationLong ='-98.2' ;
        }

        if($defaultEditMapZoom == '' || $defaultEditMapZoom == 'None' ){
            $defaultEditMapZoom = 4;
        }

        wp_localize_script('map_list-google-places','maplocationdata',array('defaultEditMapLocationLat' => $defaultEditMapLocationLat,'defaultEditMapLocationLong' => $defaultEditMapLocationLong,'defaultEditMapZoom'=>$defaultEditMapZoom));

        wp_enqueue_script( 'map_list-google-places');

        //Display the map
        echo '<input type="text" value="" aria-required="true" id="MapSearchInput" placeholder="' . __('Enter a location','maplistpro') . '" autocomplete="off">';
        echo '<div id="GoogleMap"></div>';
        // echo '<a style="margin-right: 17px;float: right;margin-top: 10px;" class="button" id="UpdateMap" href="#">' . __('Update','maplistpro') . '</a>';


    }

    //Render map field in admin
    function cmb_render_markers( $field, $meta, $object_id, $object_type, $field_type_object ) {

        $allMarkers = $this->get_all_custom_icons();

        echo "<div class='cf'>";
            echo "<span class='currentIcon'></span>";
            echo "<a href='#' class='button clear-marker-selector'>Clear icon</a>";
            echo "<a href='#' class='button expand-marker-selector'>Choose custom icon</a>";
        echo "</div>";

        echo "<div class='iconChooser'>";

            echo '<ul class="mapCategoryIcons">';
                //style="display:none;"

            $i = 0;
            foreach($allMarkers as $markerSet){

                echo '<li>';
                    echo '<h3>' . str_replace('_', ' ', $markerSet[0])  . '</h3><ul>';

                    foreach($markerSet[1] as $marker){
                        if($marker != "." && $marker != ".." && $marker !='shadow.png' && $marker != 'shadowoverrides.txt'){
                            echo "<li><a href='#' class='mapIcon' data-iconimage='" . rawurlencode($marker) . "' data-iconfolder='" . rawurlencode($markerSet[0]) . "'><img src='" . MAP_LIST_KO_PLUGIN_URL . "images/pins/" . $markerSet[0] . "/" .  $marker . "' /></a></li>";
                            $i++;
                        }
                    }
                echo '</ul></li>';
            }

            echo "</ul>";


        echo "</div>";

        echo $field_type_object->input( array( 'type' => 'text' , 'class' => 'marker-picker') );

        if ( ! empty( $field_args['desc'] ) ) {
            echo '<p class="cmb_metabox_description">MARKER' . $field['desc'] . '</p>';
        }
        //Display the map
        // echo '<input type="text" value="" aria-required="true" id="MapSearchInput" placeholder="' . __('Enter a location','maplistpro') . '" autocomplete="off">';
        /*echo '<div id="GoogleMap"></div>';
        echo '<a style="margin-right: 17px;float: right;margin-top: 10px;" class="button" id="UpdateMap" href="#">' . __('Update','maplistpro') . '</a>';*/

    }

    function admin_init(){


        //Only load if needed
        global $post_type;

        if( in_array($post_type,$this->postTypesToUse) ){

            //Set up styles
            wp_enqueue_style( 'plugin_style', MAP_LIST_KO_PLUGIN_URL . 'css/admin/Metaboxes.css' );

            //Set up map scripts for editor
            $params = array('pluginUrl' => MAP_LIST_KO_PLUGIN_URL);
            wp_register_script('cmb_metabox_map', MAP_LIST_KO_PLUGIN_URL . 'js/admin/Metaboxes.js', array('jquery'),self::$version);
            wp_localize_script('cmb_metabox_map', 'metaboxScriptParams', $params );

            wp_enqueue_script( 'cmb_metabox_map');
        }
    }

    /**********************
    ADMIN MENUS
     **********************/
    public function create_admin_menus()
    {
        // this is where we add our plugin to the admin menu
        $page = add_options_page('Map Location Settings', 'Map List Pro', 'manage_options', dirname(__FILE__), array($this,'maplistpro_admin_options'));
        //Category icons page
        $iconpage = add_submenu_page( '/edit.php?post_type=maplist', __('Category icons','maplistpro'), __('Category icons','maplistpro'), 'manage_options', 'maplistproicons', array($this,'maplistpro_admin_icons') );
        add_action('admin_init', array($this,'map_list_pro_custom_category_icons_init'));

        //Shortcode wizard - does not appear in menus
        add_submenu_page(null,'Create Map Shortcode','Create Map Shortcode','edit_pages','createmapshortcode',array($this,'maplistpro_shortcode_creator'));

        //Add admin preview script only to settings page
        add_action( 'admin_print_styles-' . $page, array($this,'maplistpro_admin_scripts'));
        //Add admin preview script only to icon pages
        add_action( 'admin_print_styles-' . $iconpage, array($this,'category_order_editor_scripts'));
    }

    /**********************
    ADMIN SETTINGS PAGE
     **********************/
    //Get the options page from an include file
    function maplistpro_admin_options()
    {
        include(MAP_LIST_KO_PLUGIN_PATH . 'includes/admin/SettingsPage.php');
    }

    function maplistpro_admin_scripts()
    {
        /*Settings page js*/
        //Uses get_stylesheet_directory() to make child theme aware
        $params = array('pluginUrl' => MAP_LIST_KO_PLUGIN_URL,'altPluginUrl' => get_stylesheet_directory() . '/prettymapstyles/');
        wp_register_script('maplistpreviewer', MAP_LIST_KO_PLUGIN_URL . 'js/admin/SettingsPage.js',null,self::$version,true);
        wp_localize_script('maplistpreviewer', 'maplistScriptParams', $params );
        wp_enqueue_script('maplistpreviewer' );
    }

    /**********************
    CATEGORY ORDERING PAGE
     **********************/

    //Get the category icons page from an include file
    function maplistpro_admin_icons()
    {
        include(MAP_LIST_KO_PLUGIN_PATH . 'includes/admin/CustomCategoryOrder.php');
    }

    //TODO:Localize all strings below
    /* register settings for icon page */
    function map_list_pro_custom_category_icons_init(){

        add_settings_section(
            'mlp_custom_category_icons_description',
            __('Simple instructions:','maplistpro'),
            array($this,'mlp_custom_category_icons_desc'),
            'maplist_page_maplistproicons'
         );

        add_settings_field(
            'mlp_custom_category_icons_list',
            '',
            array($this,'mlp_custom_category_icons_list'),
            'maplist_page_maplistproicons',
            'mlp_custom_category_icons_description'
         );

        register_setting(
            'mlp_custom_category_icons_options',
            'mlp_custom_category_icons_options',
            array($this,'mlp_custom_category_icons_validate')
         );
    }

    /* validate input */
    function mlp_custom_category_icons_validate($input){
        //If item is empty set it to default
        foreach($input as &$inp){
            if($inp == ""){
                $inp = array(30,"default/mapmarker1.png","default/shadow.png");
            }
            else{
                //Split into more usable array
                $inp = explode(',',$inp);
            }
        }

        return $input;
    }

    /* description text */
    function mlp_custom_category_icons_desc(){
        _e('<p>Click to expand and choose a custom icon colour. When there are multiple categories per location, categories at the top of the list show first. Drag and drop to set category order.</p>','maplistpro');
    }


    /*
     * Gets an array of all custom icons
     */
    function get_all_custom_icons(){

        //Get all folders for pins
        // $markerOptions = scandir(MAP_LIST_KO_PLUGIN_PATH . 'images/pins');
        $dirChanged = chdir(MAP_LIST_KO_PLUGIN_PATH . 'images/pins/');

        //Output error if unable to access directory
        if($dirChanged === false){
            var_dump("Unable to change directory to " . MAP_LIST_KO_PLUGIN_PATH . 'images/pins/');
        }

        //Get just the directories first
        $markerOptions = glob( '*', GLOB_ONLYDIR + GLOB_NOSORT);

        //No directories found so quit out
        if($markerOptions === false){return false;}

        $markerArray = array();

        foreach($markerOptions as $markerOptionFolder){

            //Ignore directory list stuff and the attr.txt file
            if($markerOptionFolder != "." && $markerOptionFolder != ".." && $markerOptionFolder !='Attribution.txt'){

                //Move into each folder one by one
                $dirChanged = chdir(MAP_LIST_KO_PLUGIN_PATH . 'images/pins/' . $markerOptionFolder);

                //Output error if unable to access directory
                if($dirChanged === false){
                    var_dump("Unable to change directory to " . MAP_LIST_KO_PLUGIN_PATH . "images/pins/" . $markerOptionFolder . " (Pins)");
                }

                //Get all pins in directory
                $pins = glob( '*.{jpg,png,gif}', GLOB_NOSORT + GLOB_BRACE);

                $markerArray[] = array( $markerOptionFolder, $pins );
            }

        }

        return $markerArray;
    }

    /* filed output */
    function mlp_custom_category_icons_list() {
        //Get saved custom icons
        $options = get_option('mlp_custom_category_icons_options');

        //Get all markers
        $markerArray = $this->get_all_custom_icons();

        //If none returned then quit out
        if($markerArray === false){return;}

        //Get all categories for locations
        //================================
        $args = array(
          'orderby' => 'name',
          'pad_counts' => 0,
          'hierarchical' => 0,
          'taxonomy' => 'map_location_categories',
          'hide_empty' => 0
        );

        $categories = get_categories($args);

        if(Count($categories) > 0){

        //Output all categories with hidden form fields
        ?>

        <ul id='IconPicker'>
            <?php
        foreach($categories as $category){

            //No options set
            if(empty($options) || !isset($options[$category->slug]) || !isset($options[$category->slug][1])){
                echo "<li class='categoryItem' data-position='500'><span class='currentIcon' style='background-image:url(" . MAP_LIST_KO_PLUGIN_URL . "images/pins/default/mapmarker1.png);'>&nbsp;</span><label>$category->name</label>";
            }
            else{
                //Output the label
                echo "<li class='categoryItem' data-position='{$options[$category->slug][0]}' data-marker='{$options[$category->slug][1]}'><span class='currentIcon' style='background-image:url(" . MAP_LIST_KO_PLUGIN_URL . "images/pins/" . $options[$category->slug][1] . ");'>&nbsp;</span><label>$category->name</label>";
            }

                //See if there is a setting for it already
                if(isset($options[$category->slug])){

                    $existingCustomShadowOverrides = '';

                    ?>

                    <input type="hidden" class="known" name="mlp_custom_category_icons_options[<?php echo $category->slug; ?>]" value='<?php echo $options[$category->slug][0] . ',' . $options[$category->slug][1] . ',' . $options[$category->slug][2] . $existingCustomShadowOverrides; ?>' />
                    <?php
                }
                else{
                    ?>
                    <input type="hidden" class="unknown" name="mlp_custom_category_icons_options[<?php echo $category->slug; ?>]" value='' />
                    <?php
                }

                echo "<div class='iconChooser'><span>Choose an icon:</span>";
                    echo "<ul class='mapCategoryIcons'>";
                    echo "</ul>";
                echo "</div>";
            echo "</li>";
        }

        ?>
        </ul>

            <ul id="AllIconChoices" style="display:none;">
            <?php
            $i = 0;
            foreach($markerArray as $markerSet){

                echo '<li>';
                    echo '<h3>' . str_replace('_', ' ', $markerSet[0])  . '</h3><ul>';

                    //See if there is a custom shadow
                    $customShadow = in_array('shadow.png',$markerSet[1]);
                    $customShadowOverrides = '';

                    foreach($markerSet[1] as $marker){
                        if($marker != "." && $marker != ".." && $marker !='shadow.png' && $marker != 'shadowoverrides.txt'){
                            echo "<li><a href='#' class='mapIcon' $customShadowOverrides data-iconshadow='$customShadow' data-iconimage='" . rawurlencode($marker) . "' data-iconfolder='" . rawurlencode($markerSet[0]) . "'><img src='" . MAP_LIST_KO_PLUGIN_URL . "images/pins/" . $markerSet[0] . "/" .  $marker . "' /></a></li>";
                            $i++;
                        }
                    }
                echo '</ul></li>';
            }
            ?>
            </ul>

        <?php
        }
        else{

                echo "You haven't set any categories for locations yet.";

        }
    }

    /**********************
    LOAD ADMIN ICON CUSTOMISER SCRIPTS
     **********************/
    function category_order_editor_scripts()
    {
        //Add the javascript for the custom catgeory icons
        $params = array('pluginUrl' => MAP_LIST_KO_PLUGIN_URL);
        wp_register_script('maplisticons', MAP_LIST_KO_PLUGIN_URL . 'js/admin/CategoryOrderEditor.js',null,self::$version,true);
        wp_localize_script('maplisticons', 'maplistScriptParams', $params );
        wp_enqueue_script('maplisticons' );
        wp_enqueue_script('jquery-ui-sortable' );

        //Ad styles for the same page
        wp_register_style('maplistIconCustomiserStyleSheets', MAP_LIST_KO_PLUGIN_URL . 'css/admin/CategoryOrderEditor.css');
        wp_enqueue_style( 'maplistIconCustomiserStyleSheets');
    }

    /*********************
    ADD SHORTCODE BUTTON
     **********************/

    function add_maplist_shortcode_button() {
        if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
        {
            add_filter('mce_external_plugins', array($this,'add_shortcode_wizard'));
            add_filter('mce_buttons', array($this,'register_maplist_shortcode_button'));
        }
    }

    function register_maplist_shortcode_button($buttons) {
        array_push($buttons, "maplist");
        return $buttons;
    }

    function add_shortcode_wizard($plugin_array) {
        $plugin_array['maplist'] = MAP_LIST_KO_PLUGIN_URL.'js/admin/CreateShortcodeWizardModal.js';
        return $plugin_array;
    }


    function maplistpro_shortcode_creator($plugin_array){
        //edit.php?post_type=maplist&page=createmapshortcode
        include MAP_LIST_KO_PLUGIN_PATH . 'includes/admin/shortcode_wizard.php';
    }


    /*********************
    AJAX CALLS FOR SHORTCODE WIZARD
     **********************/
    //Ajax call for add shortcode modal
    function get_all_maplocations_ajax() {
        global $wpdb; // this is how you get access to the database

        $args = array( 'post_type' => $this->postTypesToUse,'orderby' => 'title','order' => 'ASC', 'numberposts' => -1, 'post_status' => null);
        $attachments = get_children($args);
        $html = '<ul>';//Start the list

        foreach ( $attachments as $attachment ) {
            $html .= '<li><label><input type="checkbox" class="file" id="file_' . $attachment->ID . '" name="file_' . $attachment->ID .'" value="' . $attachment->ID . '">' . $attachment->post_title . '</label></li>';
        }
        $html .= '</ul>';//End the list
        echo $html;

        die(); // this is required to return a proper result
    }

    //Ajax call for add shortcode modal
    function get_all_mapcategories_ajax() {

        $args = array('taxonomy' => 'map_location_categories','orderby' => 'name','order' => 'ASC');

        $categories = get_categories( $args );

        $html = '<ul>';//Start the list
        foreach ( $categories as $category ) {
            $html .= '<li><label><input type="checkbox" class="file" id="file_' . $category->term_id . '" name="file_' . $category->term_id .'" value="' . $category->term_id . '">' . $category->cat_name . '</label></li>';
        }
        $html .= '</ul>';//End the list
        echo $html;

        die(); // this is required to return a proper result
    }

    /*********************
    Admin Columns setup
     **********************/
    //Define column heading for Map location list page
    function add_new_maplist_columns() {
        global $post;

        $new_columns['cb'] = '<input type="checkbox" />';
        $new_columns['id'] = __('Id', 'maplistpro');

        //add custom fields

        if($field['name'] != 'Latitude' && $field['name'] != 'Longitude'){
            $new_columns[$field['id']] = _x($field['name'], 'maplistpro');
        }

        $new_columns['mapimage'] = _x('', 'column name');

        $new_columns['title'] = _x('Title', 'maplistpro');
        $new_columns['address'] = _x('Address', 'maplistpro');
        $new_columns['maplocationcategories'] = __('Categories', 'maplistpro');

        return $new_columns;
    }

    //Get column data for Map location list page
    function manage_maplist_columns($column_name, $id) {
        
        global $post;

        if($column_name == "id"){
            echo $post->ID;
        }
        else if($column_name == "maplocationcategories")
        {
            //get map location categories for this post (custom taxonmy: map-location-categories)
            $categories = wp_get_object_terms($post->ID, 'map_location_categories', array('orderby' => 'name', 'order' => 'ASC'));
                ?>
                <ul>
                <?php
            if ( !empty( $categories ) ) {
                foreach ( $categories as $cat ) {?>
                        <li><?php
                    if($cat->parent != 0) {
                        echo '>> ';
                    }
                            ?>
                            <a href='edit.php?map-location-categories=<?php echo $cat->slug;?>&post_type=maplist'><?php echo $cat->name;?></a>
                        </li>
                    <?php
                }
                    ?>
                    </ul>
                <?php
            }
            else{
                _e('Uncategorized','maplistpro');
            }
        }
        else if($column_name == "mapimage"){
            $lat = get_post_meta($post->ID, 'maplist_latitude', true);
            $lng = get_post_meta($post->ID, 'maplist_longitude', true);
                ?>
                <img border="0" alt="<?php the_title($post->ID); ?>" src="//maps.googleapis.com/maps/api/staticmap?center=<?php echo $lat; ?>,<?php echo $lng; ?>&zoom=14&size=100x100&markers=color:blue|<?php echo $lat; ?>,<?php echo $lng; ?>" title="Latitude: <?php echo $lat; ?> Longitude: <?php echo $lng; ?>" alt="Latitude: <?php echo $lat; ?> Longitude: <?php echo $lng; ?>">
                <?php
        }
        else if($column_name == "address"){
            echo get_post_meta($post->ID, 'maplist_address', true);
        }
        // else{
        //     $test = get_post_meta($post->ID, $column_name, true);
            
        //     $teststring = '';
        //     // echo count($test);
        //     // echo $test[0];
        //     foreach ($test as &$value) {
        //         $teststring = $teststring . $value[0];
        //     }
        //     echo $teststring;
        //     // echo get_post_meta($post->ID, $column_name, true)->length;
        // }
    }

    /*********************
    GET MARKER IMAGES
     **********************/
    //Get a single url from an array (or single string) of map markers
    function get_marker_images($postTerms){

        //Get all category icons
        $categoryIcons = get_option('mlp_custom_category_icons_options');
        //First number = position, second = icon, third = shadow
        //Default icon
        $catIcon = array(101,'default/mapmarker1.png','default/shadow.png');

        //Only do this if there are custom icons
        if($categoryIcons != ''){

            //See if this is a string passed in
            if(!is_array($postTerms)){
                $postTerms = array($postTerms);
            }

            foreach($postTerms as $postTerm){

                //Get the matching icon from $categoryIcons
                //if its index is higher than the previous
                if($postTerm != 'uncategorised'){
                    if(isset($postTerm->slug)){
                        if(array_key_exists($postTerm->slug,$categoryIcons)){
                            //If category is currently set check it
                            if(isset($tempCat)){
                                if($categoryIcons[$postTerm->slug][0] < $tempCat[0]){
                                    $tempCat = $categoryIcons[$postTerm->slug];
                                }
                            }
                            else{
                                //otherwise just set it
                                $tempCat = $categoryIcons[$postTerm->slug];
                            }
                        }
                    }
                    else{
                        if(array_key_exists(strtolower($postTerm),$categoryIcons)){
                            $tempCat = $categoryIcons[strtolower($postTerm)];
                        }
                    }
                }
            }

            //If found in the array
            if(isset($tempCat)){
                $shadow = $tempCat[2] != 'none' ? MAP_LIST_KO_PLUGIN_URL . "images/pins/" . $tempCat[2] : '';
                $shadowOverrides = null;

                //Custom overrides
                if(isset($tempCat[3]) && $tempCat[3] != 'undefined'){
                    $shadowOverrides = array($tempCat[3],$tempCat[4],$tempCat[5],$tempCat[6]);
                }

                return array(
                        "marker" => MAP_LIST_KO_PLUGIN_URL . "images/pins/" . $tempCat[1],
                        "shadow" => $shadow,
                        "overrides" => $shadowOverrides
                    );
            }
        }


        //Return the default marker
        return array(
                "marker" => MAP_LIST_KO_PLUGIN_URL . "images/pins/default/mapmarker1.png",
                "shadow" => MAP_LIST_KO_PLUGIN_URL . "images/pins/default/shadow.png"
            );

    }

    function get_dayofweek_as_string(){

        //Get todays day as int
        $dw = date( "w");

        switch ($dw)
        {
            case 0:
                return __('sunday','maplistpro');
                break;
            case 1:
                return __('monday','maplistpro');
                break;
            case 2:
                return __('tuesday','maplistpro');
                break;
            case 3:
                return __('wednesday','maplistpro');
                break;
            case 4:
                return __('thursday','maplistpro');
                break;
            case 5:
                return __('friday','maplistpro');
                break;
            case 6:
                return __('saturday','maplistpro');
                break;
            default:
                return '';
                break;
        }
    }


    function register_maplist_shortcode($atts, $content = null){

        //Get attributes from shortcode
        global $options;

        $options = shortcode_atts(
            array(
                "mapid" => "0",
                "categories" => "",
                "categoriesticked" => "false", // Start with all categories ticked - this doesn't affect which locations show initially
                "categoriesaslist" => "false", // Show the categories in a list rather than drop down
                "categoriesmultiselect" => true, // Can more than one category be selected at a time
                "categoriesmatchall" => false, // Should the category select by and AND or OR selection
                "clustermarkers" => 'false',
                "clustermaxzoomlevel" => '15',
                "clustergridsize" => '50',
                "country" => "", // An additional search term that gets added for all geocoding searches
                "daycategorymode" => false, // Add categories that match day names and different locations will show on each day
                "defaultzoom" => "",
                "defaultdirectionsmode" => "DRIVING",// BICYCLING, TRANSIT, WALKING
                "disablescroll" => false, // Stop the scrollwheel working on the map
                "expandsingleresult" => true, // When only one result shows should it expand automatically
                "fullpageviewenabled" => "", // Switch the detail page on/off
                "geoenabled" => "false", // Enabled gps/ip location for the map
                "hidefilter" => "false", // Hide the select category option
                "hidefilterbar" => "false", // Hide all filters (search, sort, categories)
                "hideinfowindow" => false, // don't show the infowindow at all
                "hidesort" => "false",
                "hidegeo" => "false",
                "hidesearch" => "false",
                "hidecategoriesonitems" => "false",
                "hideviewdetailbuttons" => "false",
                "hideaddress" => false,
                "hideuntilsearch" => false,
                "homelocationid" => "", // The id of a location to use a the centre of your map
                "initialsorttype" => "title",// distance, title, category (by category order on icon page), categorytitle,
                "initialmaptype" => "ROADMAP",
                "initiallyselectedcategories" => '',// An array of categories that start as selected
                "infowidth" => 70, // The width of the infowindow as a percentage of the map width
                "infoheight" => 50, // The height of the infowindow as a percentage of the map height
                "imageheight" => "100", // The height of the image in the list item and infowindow (in px)
                "imagewidth" => "100", // The width of the image in the list item and infowindow (in px)
                "keepzoomlevel" => false, // Should the map stay at the same zoom level all of the time
                "locationsperpage" => "3", // How many locations should show on each page
                "locationstoshow" => "", // The ID's of the locations to show on the map
                "limitresults" => -1, // This limits the number of results that show at one time in the front end
                "maximumposts" => 2000, // This limits the number of results returned from the database
                "mapposition" => "above",//above,leftmap,rightmap
                "menushideonselect" => true, // Should the menu hide when a category is selected
                "openinnew" => false,
                "orderby" => "title",
                "orderdir" => "ASC",
                "selectedzoomlevel" => "",
                "searchdistances" => "10,15,20,25,30,35", // The list of distances that show in the location search
                "showdirections" => "true",
                "showthumbnailicon" => false,
                "simplesearch" => "false", // true (text-only), false (location only), combo (text and location)
                "singlelocationzoom" => 15, // When only one location is showing what zoom level should be used
                "sortcategoriesby" => "title",// title, manual
                "startlatlong" => "",
                "streetview" => true,
                "usealltaxonomies" => false, // Use additional custom taxonomies
                "viewstyle" => "both" // listonly,maponly,both,accordion
            ), $atts);

        extract($options);


        //Caching only kicks in if the mapid is set
        $useCaching = $mapid !== 0 ;

        //Caching check
        if($useCaching){
            $newMap = get_transient( 'maplist_' . $mapid );
            $this->mlpoutputhtml = get_transient( 'maplisthtml_' . $mapid );
        }

        //Check if transient exists
        if ( $useCaching || false === $newMap ) {

            //Create map object
            $newMap = new MLP_Map;

            //Set id of this map
            $newMap->id = self::$counter;

            $categoriesTerms = '';
            $locationstoshowarray = array();

            //Create args here so we can add stuff to it
            $locationArgs = array(
                'post_type' => $this->postTypesToUse,
                'orderby' => $orderby,
                'order' => $orderdir,
                'post_status' => 'publish',
                'suppress_filters' => false,//Allow plugins like WPML to make changes
                'posts_per_page'  => intval($maximumposts),
            );

            //Don't get the home location if specified
            if($homelocationid !== ''){
                $locationArgs['exclude'] = $homelocationid;
            }

            // Show today's locations mode
            // Instructions: Add a category named after each day of the week.
            // If a location has the category that is named after the current day it will show
            if($daycategorymode === "true"){
                $categoriesTerms = $this->get_dayofweek_as_string();

            }
            else{
                //If using the location filter
                if($locationstoshow != ""){

                    //Get an array of files to display
                    $locationstoshowarray = explode(',',$locationstoshow);

                    //Add ids to get_post args
                    $locationArgs['post__in'] = $locationstoshowarray;
                }
                else{
                    // else see if we have a cat filter
                    if($categories != ""){

                        $categoriesToShow = explode(',',$categories);

                        // Get a comma separated list of terms so we can query by them
                        foreach($categoriesToShow as $key=>$value){

                            $valueInt = intval($value);

                            // Allow slugs to be used in the shortcode
                            $term = $valueInt === 0 ? $value : get_term($value,'map_location_categories');

                            // Make sure a term came back
                            if($term != null){
                                $categoriesTerms .= $valueInt === 0 ? $value : $term->slug; // Must be slug for get_posts
                                $categoriesTerms .= ',';
                            }
                        }

                        $locationArgs['map_location_categories'] = $categoriesTerms;
                    }
                }
            }


            //GET LOCATIONS
            $mapLocations = get_posts($locationArgs);

            //Count how many locations there are
            //Used by Shortcode_output to see if certain parts need to be displayed
            $this->numberOfLocations = count($mapLocations);

            //Full page view option
            //If it's not on the shortcode we get the option from the core settings
            if($fullpageviewenabled == ''){
                $fullpageviewenabled = get_option('maplist_fullpageviewenabled');
            }

            //Array of categories actually in use on this map
            $allCategoriesUsedByID = array();
            $allCategoriesUsedObjects = array();

            //CUSTOM TAXONOMY FILTERING
            //========================================

            //Get all additional taxonomies if they exist
            if($usealltaxonomies == true){
                $maplisttaxonomies = get_object_taxonomies('maplist', 'objects');

                //Set up array ready to be filled
                global $allTaxObjects;
                $allTaxObjects = array();

                //Used to keep track of additional taxonomies
                $taxonomyLookup = array();

                //loop over all taxonomies and get them
                foreach($maplisttaxonomies as $taxonomytouse){

                    //Standard category is handled separately as it is used for server side filtering as well
                    if('map_location_categories' == $taxonomytouse->name){ continue ;}

                    $args = array(
                      'orderby' => 'name',
                      'pad_counts' => 0,
                      'hierarchical' => 0,
                      'taxonomy' => $taxonomytouse->name,
                      'hide_empty' => 0
                    );

                    //If a sort order has been specified for categories
                    if($sortcategoriesby !== 'manual' && $sortcategoriesby !== 'title'){
                        $args['orderby'] = $sortcategoriesby;
                    }

                    $customcategories = get_categories($args);

                    $tempcustomcats = array();

                    foreach($customcategories as $customcat){
                        //Add this into our temp array
                        $tempcustomcats[] = new MLP_Category($customcat->name,$customcat->slug,'');
                    }

                    //Add to array with key set as category
                    $allTaxObjects[$taxonomytouse->name] = $tempcustomcats;

                    //Add this key to array
                    $taxonomyLookup[] = $taxonomytouse->name;
                }

                //Add lookup array
                $allTaxObjects['taxonomyLookup'] = $taxonomyLookup;

                $newMap->allTaxonomies = $allTaxObjects;

            }

            //Is the uncategorised option needed
            $uncatNeeded = false;

            //LOOP EVERY LOCATION
            foreach ($mapLocations as $mapLocation)
            {

                //Create location object
                $kolocation = new MLP_location();

                //Get all meta fields for this post
                $locationMetaFields = get_post_custom($mapLocation->ID);

                //Get latitude and longitude
                $lat = array_key_exists('maplist_latitude',$locationMetaFields) ? $locationMetaFields['maplist_latitude'][0] : '';
                $lng = array_key_exists('maplist_longitude',$locationMetaFields) ? $locationMetaFields['maplist_longitude'][0] : '';

                //Get the url set for this location (if there is one)
                $alternateurltemp = array_key_exists('maplist_alternateurl', $locationMetaFields) ? $locationMetaFields['maplist_alternateurl'][0] : '';

                //If there is no external link use the location's url
                if($alternateurltemp == ''){
                    $locationUrl = ($fullpageviewenabled == true && $mapLocation->post_content != '') ? $locationUrl = get_permalink($mapLocation->ID) : '';
                }
                else{
                    $locationUrl = $alternateurltemp;
                }


                //Get the address and add paragraphs etc to it
                $address = isset($locationMetaFields['maplist_address']) ? wpautop($locationMetaFields['maplist_address'][0],true) : '';

                //Get all terms used by this location
                $postCategories = wp_get_object_terms($mapLocation->ID, 'map_location_categories');

                //See if there are any custom taxonomies
                if($usealltaxonomies == true && Count($maplisttaxonomies) > 1){

                    $customTermsForPost = array();
                    //$kolocation
                    foreach($maplisttaxonomies as $taxonomy){

                        if('map_location_categories' == $taxonomy->name){ continue ;}

                        $customTermsForPost[$taxonomy->name] = wp_get_object_terms($mapLocation->ID, $taxonomy->name);
                    }

                    //Add custom filters to location object
                    $kolocation->customCategories = $customTermsForPost;

                }

                //Holder for our category objects to be passed to front end
                $assPostCategories = array();

                //If no cat add uncat
                if(count($postCategories) == 0){
                    $uncatNeeded = true;
                }

                //Add new categories to array for menu
                foreach($postCategories as $category){
                    //Make sure it's unique
                    if(!in_array($category->term_id,$allCategoriesUsedByID)){
                        $allCategoriesUsed[] = new MLP_Category($category->name,$category->slug,'');
                        //Put it in found array
                        $allCategoriesUsedByID[] = $category->term_id;
                    }

                    $assPostCategories[] = new MLP_Category($category->name,$category->slug,'');
                }

                if(has_post_thumbnail($mapLocation->ID)){
                    //Get the featured image
                    $imageUrlTemp = wp_get_attachment_image_src( get_post_thumbnail_id($mapLocation->ID));

                    $kolocation->imageUrl = mlp_mr_image_resize($imageUrlTemp[0], $imagewidth, $imageheight, true, 'tr', false);

                    //Show thumbnail icon
                    if($showthumbnailicon){

                        $tinyImageUrlTemp = wp_get_attachment_image_src( get_post_thumbnail_id($mapLocation->ID));

                        if($tinyImageUrlTemp != ''){

                            //Get the resized image thumbnail
                            $thumb = mlp_mr_image_resize($tinyImageUrlTemp[0], self::$iconImageHeight, self::$iconImageWidth, true, 'br', false);

                            $kolocation->smallImageUrl = $thumb;
                        }
                    }
                }

                //Get the icons for the categories

                //Add category slugs to each list item
                foreach($assPostCategories as $tempCategory){
                    $kolocation->cssClass .= " " . $tempCategory->slug;
                }

                //Sort categories alpha
                usort($assPostCategories,array($this,"alpha_sort_by_title"));

                //Create object
                $kolocation->title = $mapLocation->post_title;
                $kolocation->cssClass = $kolocation->cssClass . ' loc-' . $mapLocation->ID;
                $kolocation->address = $address;
                $kolocation->latitude = $lat;
                $kolocation->longitude = $lng;
                $kolocation->pinColor = '';
                $kolocation->pinShadowImageUrl = '';//TODO:Remove all shadow stuff as it's no longer needed
                $kolocation->categories = $assPostCategories;
                $kolocation->_mapMarker = '';
                $kolocation->locationUrl = $locationUrl;

                //Use the category or the location pin - location always wins out if both
                if(array_key_exists('maplist_marker',$locationMetaFields) && $locationMetaFields['maplist_marker'][0] !== '/'){
                    $kolocation->pinImageUrl = MAP_LIST_KO_PLUGIN_URL . 'images/pins/' . $locationMetaFields['maplist_marker'][0];
                }
                else{
                    $markerImages = $this->get_marker_images($postCategories);
                    $kolocation->pinImageUrl = $markerImages['marker'];
                }

                //Additional detail
                //==================================

                //Address
                //TODO:Add a builder for this
                if($hideaddress !== 'true'){
                    $topArea = "<div class='address'>$address</div>";
                }

                //Get description, fire it through wpautop to convert crs to p tags, then do shortcode stuff
                $tempDesc = isset($locationMetaFields['maplist_description']) ? do_shortcode(wpautop($locationMetaFields['maplist_description'][0])) : '';

                $kolocation->description = $topArea . $tempDesc;
                $kolocation->simpledescription = $tempDesc;

                //GET CUSTOM FIELDS FROM FILTER
                $kolocation->description = apply_filters( 'mlp_location_description', $kolocation->description,$locationMetaFields,$mapLocation);


                //Add this location to map
                $newMap->locations[] = $kolocation;

            }

            //No categories found so add a no categories category
            if(!isset($allCategoriesUsed)){
                $allCategoriesUsed[] = new MLP_Category('Uncategorized','uncategorized','');
            }
            else{

                if($sortcategoriesby === "manual"){
                    //Get saved custom icon order
                    $options = get_option('mlp_custom_category_icons_options');

                    $manualSortedCategories = array();

                    //Loop over order options array
                    foreach($options as $slug=>$categoryOption){

                        //Find this option in the categories
                        foreach($allCategoriesUsed as $category){
                            if($category->slug === $slug){
                                $manualSortedCategories[] = $category;
                            }
                        }
                    }

                    $allCategoriesUsed = $manualSortedCategories;

                }
                else{

                    //Sort the categories by slug
                    usort($allCategoriesUsed,array($this,"alpha_sort_by_title"));
                }



            }

            $newMap->categories = $allCategoriesUsed;

            $startlat = '';
            $startlong = '';

            if($startlatlong != ''){
                $splitString = explode (',', $startlatlong);
                $startlat = $splitString[0];
                $startlong = $splitString[1];
            }

            //Get the output file
            $filePath = MAP_LIST_KO_PLUGIN_PATH . 'includes/shortcode_output_split.php';

            //$mlpoutputhtml = '';
            $html = include($filePath);

            //See if there are any custom styles
            $customStyles = stripslashes(get_option('maplist_custom_map_stylers',''));

            //Categories multiselect doesn't work with accordions
            if($viewstyle === "accordion" || $categoriesmultiselect === "false"){$categoriesmultiselect = false;}

            //Set options object
            $newMap->options = array(
                "categoriesaslist" => $categoriesaslist,
                "categoriesticked" => $categoriesticked,
                "categoriesmultiselect" => $categoriesmultiselect,
                "categoriesmatchall" => $categoriesmatchall,
                "clustermarkers" => $clustermarkers,
                "clustermaxzoomlevel" => $clustermaxzoomlevel,
                "clustergridsize" => $clustergridsize,
                "country" => $country,
                "customstylers" => $customStyles,
                "defaultzoom" => $defaultzoom,
                "defaultdirectionsmode" => $defaultdirectionsmode,
                "disablescroll" => $disablescroll,
                "expandsingleresult" => $expandsingleresult,
                "fullpageviewenabled" => $fullpageviewenabled,
                "geoenabled" => $geoenabled,
                "hideaddress" => $hideaddress,
                "hidecategoriesonitems" => $hidecategoriesonitems,
                "hideviewdetailbuttons" => $hideviewdetailbuttons,
                "hideinfowindow" => $hideinfowindow,
                "hideuntilsearch" => $hideuntilsearch,
                "hidefilter" => $hidefilter,
                "initiallyselectedcategories" => $initiallyselectedcategories,
                "initialmaptype" => $initialmaptype,
                "initialsorttype" => $initialsorttype,
                "infoboxparts" => $this->get_infobox_parts(),
                "infoheight" => $infoheight / 100,
                "infowidth" => $infowidth / 100,
                "keepzoomlevel" => $keepzoomlevel,
                "limitresults" => $limitresults,
                "locationsperpage" => $locationsperpage,
                "locationstoshow" => $locationstoshow,
                "menushideonselect" => $menushideonselect,
                "openinnew" => $openinnew,
                'orderby' => $orderby,
                'orderdir' => $orderdir,
                "simplesearch" => $simplesearch,
                "singlelocationzoom" => $singlelocationzoom,
                "showdirections" => $showdirections,
                "selectedzoomlevel" => $selectedzoomlevel,
                "startlat" => $startlat,
                "startlong" => $startlong,
                "streetview" => $streetview,
                "searchdistances" => explode(",",$searchdistances),
                "viewstyle" => $viewstyle
            );




            //Get home location if needed
            if($homelocationid != ''){

                $home = get_post($homelocationid);

                //Make sure a home location is found
                if($home){

                    //Create location
                    $homelocation = new MLP_location();

                    //Get all meta fields for this post
                    $locationMetaFields = get_post_custom($homelocationid);

                    $lat = $locationMetaFields['maplist_latitude'][0];
                    $lng = $locationMetaFields['maplist_longitude'][0];

                    $address = isset($locationMetaFields['maplist_address']) ? $locationMetaFields['maplist_address'][0] : '';

                    //Categories are needed to work out icon to use
                    //================================================

                    //Get all terms used by this location
                    $postCategories = wp_get_object_terms($home->ID, 'map_location_categories');

                    //Holder for our category objects to be passed to front end
                    $assPostCategories = array();

                    //If no cat add uncat
                    if(count($postCategories) == 0){
                        $uncatNeeded = true;
                    }

                    //Add new categories to array for menu
                    foreach($postCategories as $category){
                        //Make sure it's unique
                        if(!in_array($category->term_id,$allCategoriesUsedByID)){
                            $allCategoriesUsed[] = new MLP_Category($category->name,$category->slug,'');
                            //Put it in found array
                            $allCategoriesUsedByID[] = $category->term_id;
                        }

                        $assPostCategories[] = new MLP_Category($category->name,$category->slug,'');
                    }

                    // $markerImages = $this->get_marker_images($postCategories);

                    //Create object
                    $homelocation->title = $home->post_title;
                    $homelocation->address = $address;
                    $homelocation->latitude = $lat;
                    $homelocation->longitude = $lng;
                    $homelocation->pinColor = '';
                    $homelocation->pinImageUrl = $markerImages['marker'];

                   //Use the category or the location pin - location always wins out if both
                    if(array_key_exists('maplist_marker',$locationMetaFields) && $locationMetaFields['maplist_marker'][0] !== '/'){
                        $homelocation->pinImageUrl = MAP_LIST_KO_PLUGIN_URL . 'images/pins/' . $locationMetaFields['maplist_marker'][0];
                    }
                    else{
                        $markerImages = $this->get_marker_images($postCategories);
                        $homelocation->pinImageUrl = $markerImages['marker'];
                    }

                    $homelocation->imageUrl = $imageUrl;
                    $homelocation->address = $address;
                    $homelocation->categories = $assPostCategories;
                    $homelocation->_mapMarker = '';
                    $homelocation->locationUrl = $locationUrl;

                    //Add home location to map object
                    $newMap->homelocation =  $homelocation;
                }
            }


            //Caching kicks in if mapid is set
            if($useCaching){

                //Add this map to the transient cache
                set_transient( 'maplist_' . $mapid, $newMap, self::$cachePeriod );
                set_transient( 'maplisthtml_' . $mapid,$mlpoutputhtml, self::$cachePeriod );

                //Add these transients to the option so we can clear them if we need to
                $transients = get_option('maplist_transients_array');
                //Add this transient to the options array
                $transients[$mapid] = $mapid;
                //Save the array
                update_option('maplist_transients_array',$transients);
            }

        }//End transient check


        //Add this map to the array
        self::$maps[] = $newMap;

        //Scripts that the map needs
        $deps = array('knockout','jquery','map_list-google-places','map_list-google-marker-clusterer');



        //See if infowindows are preferred
        $disableInfoBoxes = get_option('maplist_disableinfoboxes');

        /*Map page js*/
        $params = array(
            'KOObject' => self::$maps,
            'pluginurl' => MAP_LIST_KO_PLUGIN_URL,
            // 'defaultSearchMessage' => __('Search...','maplistpro'),
            // 'defaultSearchLocationMessage' => __('location...','maplistpro'),
            'disableInfoBoxes' => $disableInfoBoxes,
            'distanceWithinText' => __('within','maplistpro'),
            'distanceOfText' => __('of','maplistpro'),
            'hideviewdetailbuttons' => $hideviewdetailbuttons,
            'measurementUnits' => get_option('maplist_measurementunits'),
            'measurementUnitsMetricText' => __('Km','maplistpro'),
            'measurementUnitsImperialText' => __('Miles','maplistpro'),
            'noSelectedTypeMessage' => __('No locations of selected type(s) found.','maplistpro'),
            'noTypeMessage' => __('No categories selected.','maplistpro'),
            'noFilesFoundMessage' => __('No locations found.','maplistpro'),
            'noGeoSupported' => __('Geolocation is not supported by this browser.','maplistpro'),
            'printDirectionsMessage' => __('Print directions','maplistpro'),
            'viewLocationDetail' => __('View location detail','maplistpro')
        );


        if($disableInfoBoxes != 'true'){

            $infoBoxStyle = get_option('maplist_infoboxstyle');

            $infoBoxStyle = $infoBoxStyle ? $infoBoxStyle : 'box';

            $params["infoboxtype"] = $infoBoxStyle;

            //Add this to the list of required scripts
            $deps[] = 'infowindow_custom';
        }


        //Get access to the full map object and all options so you can make changes based on custom rules if needed
        apply_filters( 'mlp_map_object_filter', $newMap);

        wp_register_script('maplistko', MAP_LIST_KO_PLUGIN_URL . 'js/maplistfront.js',$deps,self::$version,true);
        wp_enqueue_script('maplistko');

        wp_localize_script('maplistko', 'maplistScriptParamsKo', $params );

        //Load css here so it only gets loaded when needed
        wp_enqueue_style( 'maplistCoreStyleSheets');
        wp_enqueue_style( 'maplistStyleSheets');

        //Shortcode is on page
        $isOnPage = true;

        return $this->mlpoutputhtml;
    }

    function alpha_sort_by_title($a, $b)
    {
        $al = strtolower($a->title);
        $bl = strtolower($b->title);
        if ($al == $bl) {
            return 0;
        }
        return ($al > $bl) ? +1 : -1;
    }

    function alpha_sort_by_id($a, $b)
    {
        $al = $a->id;
        $bl = $b->id;
        if ($al == $bl) {
            return 0;
        }
        return ($al > $bl) ? +1 : -1;
    }

}

//Activation hook
register_activation_hook(__FILE__, array('MapListProKO','map_list_pro_activate'));

$MapListProKO = new MapListProKO();

class MLP_Map
{
    public $id;
    public $locations = array();
    public $homelocation;
    public $categories;
    public $options;
}

class MLP_Location
{
    public $title;
    public $cssClass;
    public $description;
    public $simpledescription;
    public $dateCreated;
    public $categories;
    public $customCategories;
    public $latitude;
    public $longitude;
    public $address;
    public $pinImageUrl;
    public $pinShadowImageUrl;
    public $pinShadowOverrides;
    public $pinShape;
    public $imageUrl;
    public $smallImageUrl;
    public $locationUrl;
    public $_mapMarker;
    public $expanded;
}

class MLP_Category
{
    public function __construct($title,$slug,$markerImage){
        $this->title = $title;
        $this->slug = $slug;
        if($markerImage){
            $this->markerImage = $markerImage;
        }
        else{
            //Default marker
            $markerImage = MAP_LIST_KO_PLUGIN_URL . 'images/pins/default/BluePin.png';
        }
    }

    public $title;
    public $slug;
    public $selected;
    public $markerImage;
    public $sortIndex;
}