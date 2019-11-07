<?php

class theme_settings {
    
        /** 
         *  HOLD THE DEFAULT SETTINGS 
         */
        private $page_title     = 'Theme Settings';
        private $page_info      = 'Enter your settings below:';
        private $page_id        = 'my-setting-admin';
        private $option_group   = 'theme_group';
        private $option_name    = 'theme_option';
        private $section_id     = 'setting_section_id';
        private $section_title  = 'Theme Additional Settings';
        
    
        /**
         * Holds the values to be used in the fields callbacks
         */
        private $options_list = array(
        								'facebook'  => array(
                                                            'type'  => 'text', 
                                                            'title' => 'Facebook',
                                                            'name'  => 'facebook',
                                                            'id'    => 'facebook'
                                                    ), 
                                        'instagram' => array(
                                                            'type'  => 'text', 
                                                            'title' => 'Instagram',
                                                            'name'  => 'instagram',
                                                            'id'    => 'instagram'
                                                    ), 
                                        'phone'   	=> array(
                                                            'type'  => 'text', 
                                                            'title' => 'Phone',
                                                            'name'  => 'phone',
                                                            'id'    => 'phone'
                                                    ), 
                                        'email'   => array(
                                                            'type'  => 'text', 
                                                            'title' => 'Email',
                                                            'name'  => 'email',
                                                            'id'    => 'email'
                                                    ), 
                                    	'address'   => array(
                                                            'type'  => 'textarea', 
                                                            'title' => 'Address',
                                                            'name'  => 'address',
                                                            'id'    => 'address'
                                                    ),
                            );
        private $options;

        /**
         * Start up
         */
        public function __construct() {
            
                add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
                add_action( 'admin_init', array( $this, 'page_init' ) );
        }

        /**
         * Add options page
         */
        public function add_plugin_page() {
            
                // This page will be under "Settings"
                add_options_page(
                        'Settings Admin', 
                        $this->page_title, 
                        'manage_options', 
                        $this->page_id, 
                        array( $this, 'create_admin_page' )
                );
        }

        /**
         * Options page callback
         */
        public function create_admin_page() {

                // Set class property
                $this->options = get_option( $this->option_name );
                ?>
                <div class="wrap">
                        <h1><?php echo $this->page_title; ?></h1>
                        <form method="post" action="options.php">
                        <?php
                                // This prints out all hidden setting fields
                                settings_fields( $this->option_group );
                                do_settings_sections( $this->page_id );
                                
                                //Add option button
                                submit_button();
                        ?>
                        </form>
                </div>
                <?php
        }

        /**
         * Register and add settings
         */
        public function page_init() {        

                register_setting(
                        $this->option_group, // Option group
                        $this->option_name, // Option name
                        array( $this, 'sanitize' ) // Sanitize
                );

                add_settings_section(
                        $this->section_id, // ID
                        $this->section_title, // Title
                        array( $this, 'print_section_info' ), // Callback
                        $this->page_id // Page
                );  

                //Loop through each option list
                foreach( $this->options_list as $option_key => $option ){
                    
                        //Add the setting information
                        add_settings_field(
                                $option['name'], // ID
                                $option['title'], // Title 
                                array( $this, 'input_callback' ), // Callback
                                $this->page_id, // Page
                                $this->section_id, // Section           
                                $option_key
                        ); 
                }   
        }

        /**
         * Sanitize each setting field as needed
         *
         * @param array $input Contains all settings fields as array keys
         */
        public function sanitize( $input ) {
                
                //Prepare the input
                $new_input = array();
                
                //Loop through each input
                foreach( $this->options_list as $option_key => $option ){
                    
                        // Validate file fields
                        if( $option[ 'type' ] == 'text' ){
                            
                                //Check each value
                                if( isset( $input[ $option['name'] ] ) )
                                        $new_input[ $option['name'] ] = sanitize_text_field( $input[ $option['name'] ] );
                            
                        } elseif ( $option[ 'type' ] == 'textarea' ) {
                            
                                //Check each value
                                if( isset( $input[ $option['name'] ] ) )
                                        $new_input[ $option['name'] ] = sanitize_textarea_field( $input[ $option['name'] ] );
                                
                        } elseif ( $option[ 'type' ] == 'image' ) {
                            
                                if ( isset( $input[ $option['name'] ] ) ) {
                                    
                                        // Only update setting if input value is in the list of valid options
                                        $setting_file = $option['name'];
                                        $new_input[ $option['name'] ] = ( isset( $_FILES[$setting_file] ) ? theme_setting_image_upload( $option['name'], $input ) : $new_input[$option['name']] );
                                }
                        }
                }

                //Return the input
                return $new_input;
        }

        /** 
         * Print the Section text
         */
        public function print_section_info() {
            
                print $this->page_info;
        }
        
        /** 
         * Get the settings option array and print one of its values
         */
        public function input_callback( $in_key ){
            
                //Check the type
                if( !isset($this->options_list[$in_key]) ){ return false; }
                
                //Prepare the information
                $output = '';
                if( $this->options_list[$in_key]['type'] == 'text' ){
                    
                        $output = '<input type="text" id="' . $this->options_list[$in_key]['id'] . '" name="' . $this->option_name . '['. $this->options_list[$in_key]['name'] . ']" value="%s" />';
                        
                } elseif( $this->options_list[$in_key]['type'] == 'textarea' ){
                    
                        $output = '<textarea id="' . $this->options_list[$in_key]['id'] . '" name="' . $this->option_name . '['. $this->options_list[$in_key]['name'] . ']">%s</textarea>';
                        
                } elseif( $this->options_list[$in_key]['type'] == 'image' ){
                    
                        $output = '<input type="file" id="' . $this->options_list[$in_key]['id'] . '" name="' . $this->option_name . '['. $this->options_list[$in_key]['name'] . ']" value="%s" />';
                }
                $value  = '';
                if( isset( $this->options[ $this->options_list[$in_key]['name'] ] ) ){ $value = esc_attr( $this->options[ $this->options_list[$in_key]['name'] ]); }
            
                //Echo the output
                printf( $output, $value );
        }
        
        /** 
         *  Get function for handling setting image upload
         */
        private function theme_setting_image_upload( $the_file, $input ) {
            
                //Prepare to get the file information
                $data = $_FILES[ $the_file ];
                if ( '' != $data['name'] )
                        $upload = wp_handle_upload( $_FILES[ $the_file ], array( 'test_form' => false ) );
                else
                        $upload['url'] = $input[$the_file];
                
                //Prepare to return the information
                return $upload['url'];
        }
}

if( is_admin() ) {

		//Add the themes 
        $theme_settings_page = new theme_settings();
}