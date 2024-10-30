<?php
/*
Plugin Name: Mokusiga Google Tag Manager
Plugin URI: http://wordpress.org/extend/plugins/wp-piwik/mokusiga_google_tag_manager
Description: Insert Google Tag Manager into the Wordpress site with customised features.
Version: 1.2.2
Author: Mokusiga
Author URI: http://www.mokusiga.com
License: 
  -------------------------------------------------------------------
  Copyright 2013  Mokusiga  (email : support@mokusiga.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
    -------------------------------------------------------------------
*/


class MokusigaGoogleTagManager{
    private $gtm_id;
    private $is_updated = false;
    private $is_called = false;
    private $gtm_datalayer_name;
    private $gtm_datalayer_text;
    private $gtm_datalayer_show_users;
    private $gtm_datalayer_show_wp_version;
    private $gtm_location;
    private $gtm_location_text;
    private $custom_message;
    
    public function MokusigaGoogleTagManager() {
        load_plugin_textdomain('mokusiga_google_tag_manager', false, basename( dirname( __FILE__ ) ) . '/languages');
        $this->custom_message = '';
        
        $this->initAllStoredVariables();
        
        
        add_action('admin_init', array(&$this,"admin_init"));
        add_action('admin_menu', array(&$this,"admin_menu"));
        if('wp_footer' == $this->gtm_location ){	        
        	add_action( 'wp_footer', array(&$this,"output_gtm") );
        }else{
        	add_action( $this->gtm_location_text, array(&$this,"output_gtm") );
        }
    }
  
  
    private function initAllStoredVariables(){
        $this->gtm_id = get_option('mokusiga_gtm_id','');
        $this->gtm_location = get_option('mokusiga_gtm_location','');
        $this->validate_gtm_location();
        $this->gtm_location_text = get_option('mokusiga_gtm_location_text','');
        $this->gtm_datalayer_name = get_option('mokusiga_gtm_datalayer_name','');
        $this->validate_datalayer_name();
        $this->gtm_datalayer_text = get_option('mokusiga_gtm_datalayer_text','');
        $this->gtm_datalayer_show_users = get_option('mokusiga_gtm_datalayer_show_user','');
        $this->gtm_datalayer_show_wp_version = get_option('mokusiga_gtm_datalayer_show_wp_version','');
    }
    /**
     * Make sure there is a dataLayer variable name for the GTM
     */          
    public function validate_datalayer_name(){
        if(0 == strlen($this->gtm_datalayer_name)){
            update_option('mokusiga_gtm_datalayer_name','dataLayer');     // default. MUST HAVE
            $this->gtm_datalayer_name = get_option('mokusiga_gtm_datalayer_name','');
        }
    }
    public function validate_gtm_location(){
        if(0 == strlen($this->gtm_location)){
            update_option('mokusiga_gtm_location','wp_footer');     // default. MUST HAVE
            $this->gtm_location = get_option('mokusiga_gtm_location','');
        }
    }
    
    /**
     * Called from wp_footer hook
     */         
    public function output_gtm(){

        print $this->get_gtm();

    }
    
    /**
     * Get the GTM Code
     */          
    private function get_gtm() {
        global $current_user,$wp_version;
        
        // assign raw datalayer variables
        //$datalayer = $this->gtm_datalayer_text;
        
        
        
        
        // determine if there is a loggedIn datalayer variable
        if($this->gtm_datalayer_show_users){
            $loggedIn = 'false';
            if (is_user_logged_in()) {
                $loggedIn = 'true';
            }
            $datalayer = $datalayer."'isLoggedIn' : '$loggedIn',";
        }
        
         // show wp version
        if($this->gtm_datalayer_show_wp_version){
        	$datalayer = $datalayer." 'wpVersion' : '".$wp_version."',";
        }
        $datalayer = $datalayer." ".$this->gtm_datalayer_text;
        
        if( 0 <= strlen($datalayer)){
            if(',' == substr($datalayer,-1,1)){
                $datalayer = substr($datalayer,0,strlen($datalayer)-1);
            }
        }
         
        // Create Datalayer variables for GTM
        $datalayer = '<script>'.$this->gtm_datalayer_name.' = [{'.$datalayer.'}];</script>';
        $gtm = "<!-- Google Tag Manager code generated by Mokusiga -->\n";
        $gtm =  $gtm."<!-- Google Tag Manager -->\n$datalayer".
                 "<noscript><iframe src=\"//www.googletagmanager.com/ns.html?id=$this->gtm_id\"".
                 ' height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>'.
                 '<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':'.
                 'new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],'.
                 'j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src='.
                 '\'//www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);'.
                 "})(window,document,'script','$this->gtm_datalayer_name','$this->gtm_id');</script>\n".
                 "<!-- End Google Tag Manager -->\n";
        return $gtm;
    }
  
    /**
     * Shows Errormessage in Backend
     */
    private function show_message($message, $errormsg = false)
    {
    /*
        if ($errormsg) {
            echo '<div id="message" class="error">';
        }else {
            echo '<div id="message" class="updated fade">';
        }
        echo "<p><strong>$message</strong><a style=\"float:right;\" href=\"?mokusiga_google_tag_manager_message=0\">".__('Dismiss','mokusiga_google_tag_manager')."</a></p></div>";
    */
    }
  
    /**
    * Calls show_message with specific warning, missing id
    */
    public function show_missing_id_warning()
    {
        global $current_user ;
        $user_id = $current_user->ID;

        if (!current_user_can( 'manage_options' )) {
          $this->show_message('Google Tag Manager is missing the container id. <a href="/wp-admin/options-general.php?page=mokusiga_google_tag_manager_message">Please Fix this!</a>', true);
        }
    }
    /**
     * Initialize the menu hook in backend
     */         
    public function admin_init() {
        wp_enqueue_style('mokusiga_gtm_admin_style.css', plugins_url( 'css/style.css' , __FILE__ ), null, '1.0');
    }
    
    private function update_gtm_variables() {
        
        
        // GTM Container ID
        if(isset($_POST['mksg_gtm_id'])) {
            $gtm_id = esc_attr($_POST['mksg_gtm_id']);
            if($gtm_id != $this->gtm_id) {
                if(update_option('mokusiga_gtm_id',$gtm_id)) {
                    $this->gtm_id = $gtm_id;
                    $this->updated = true;
                }
            }
        }
        
        // GTM Location
        
        // datalayer Name
        if(isset($_POST['mksg_datalayer_name'])) {
            $gtm_datalayer_name = esc_attr($_POST['mksg_datalayer_name']);
            if($gtm_datalayer_name != $this->gtm_datalayer_name) {
                if(update_option('mokusiga_gtm_datalayer_name',$gtm_datalayer_name)) {
                    $this->gtm_datalayer_name = $gtm_datalayer_name;
                    $this->updated = true;
                }
            }
        }
        
        // datalayer Raw Text
        if(isset($_POST['mksg_datalayer_text'])) {
            $gtm_datalayer_text = stripslashes($_POST['mksg_datalayer_text']);
            if($gtm_datalayer_text != $this->gtm_datalayer_text) {
                if(update_option('mokusiga_gtm_datalayer_text',$gtm_datalayer_text)) {
                    $this->gtm_datalayer_text = $gtm_datalayer_text;
                    $this->updated = true;
                }
            }
        }
        
        // datalayer set isLoggedIn User boolean
        $gtm_datalayer_show_users = ''; // blank means unchecked
        if(isset($_POST['mksg_datalayer_isLoggedIn']) && 'on' == $_POST['mksg_datalayer_isLoggedIn']) {
            $gtm_datalayer_show_users = 'checked';
        }
        if($gtm_datalayer_show_users != $this->gtm_datalayer_show_users) {
            if(update_option('mokusiga_gtm_datalayer_show_user',$gtm_datalayer_show_users)) {
                $this->gtm_datalayer_show_users = $gtm_datalayer_show_users;
                $this->updated = true;
            }
        }
        
        // datalayer set version Number
        $gtm_datalayer_show_wp_version = ''; // blank means unchecked
        if(isset($_POST['mksg_datalayer_wp_version']) && 'on' == $_POST['mksg_datalayer_wp_version']) {
            $gtm_datalayer_show_wp_version = 'checked';
        }
        if($gtm_datalayer_show_wp_version != $this->gtm_datalayer_show_wp_version) {
            if(update_option('mokusiga_gtm_datalayer_show_wp_version',$gtm_datalayer_show_wp_version)) {
                $this->gtm_datalayer_show_wp_version = $gtm_datalayer_show_wp_version;
                $this->updated = true;
            }
        }
   
        // datalayer location
        if(isset($_POST['mksg_location'])) {
            $location = $_POST['mksg_location'];
            if('wp_footer' == $location){
                if($this->gtm_datalayer_location != $location){
                    $this->setDefaultGtmLocation();
                }
            }else if('custom' == $location){
                if(isset($_POST['mksg_location_custom_text']) 
                    && 0 < strlen(trim($_POST['mksg_location_custom_text']))) {
                    $location = trim($_POST['mksg_location_custom_text']);
                    if($this->gtm_location_text != $location){
                        if(update_option('mokusiga_gtm_location_text',$location)) {
                            $this->gtm_location_text = $location;
                            $this->updated = true;
                        }
                    } 
                    if(update_option('mokusiga_gtm_location', 'custom')) {
                            $this->gtm_location = 'custom';
                            $this->updated = true;
                     }  
                     
                }else{  // can't be zero length
                    if($this->gtm_datalayer_location != $location){
                        $this->setDefaultGtmLocation();
                        $this->custom_message = $this->custom_message."The Custom hook location cannot be empty. Footer will be used instead.<br />";
                    }
                }
            
            }else{
                if($this->gtm_datalayer_location != $location){
                    $this->setDefaultGtmLocation();
                }
            }
            
        }
        if(isset($_POST['mksg_location_custom_text'])) {
            $location = trim($_POST['mksg_location_custom_text']);
            if($this->gtm_location_text != $location){
                if($this->gtm_datalayer_location != $location){
                    if(update_option('mokusiga_gtm_location_text',$location)) {
                        $this->gtm_location_text = $location;
                        $this->updated = true;
                    }
                }
            }
        }
    }
    
    
    private function setDefaultGtmLocation(){
        if(update_option('mokusiga_gtm_location','wp_footer')) {
            $this->gtm_location = 'wp_footer';
            $this->updated = true;
        }
    }
    public function admin_menu() {
        if (current_user_can( 'manage_options' )) {
            // update any saved variables
            $this->update_gtm_variables();
        }else{
             $this->custom_message = "You do not have rights to cannot edit Google Tag Manager settings.";
        }
        
        
        
        
       /* global $pagenow;
        if($this->gtm_id == '' && $pagenow == 'index.php') {
          add_action('admin_notices', array(&$this,'show_missing_id_warning'));
        }  */
        
        add_options_page('Google Tag Manager - Mokusiga',
          'Google Tag Manager - Mokusiga',"manage_options",
          "mokusiga_google_tag_manager",array(&$this,"gtm_settings_menu"));
    }
    
    public function gtm_settings_menu() {
        global $wp_version;
        include('gtm_settings_menu.php');
  }
  
}

global $mokusiga_google_tag_manager;
$mokusiga_google_tag_manager = new MokusigaGoogleTagManager();


?>