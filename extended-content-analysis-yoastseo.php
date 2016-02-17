<?php
/**
 * @link              http://www.ressourcenmangel.de/
 * @since             1.0.0
 * @package           extended-content-analysis-yoastseo
 *
 * @wordpress-plugin
 * Plugin Name:       Extended Content Analysis for YOAST SEO
 * Plugin URI:        https://github.com/Basbee
 * Description:       Plugin extends the "Content Analysis" Features of YOAST SEO while it fetches the complete Post or Page content manually and even gets the data out of layout building tools like Enfolds Avia Layout Builder.
 * Version:           1.0.0
 * Author:            Sebastian Kulahs
 * Author URI:        https://github.com/Basbee
 * Text Domain:       extended-content-analysis-yoastseo
 */



// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


// manually require plugin.php in order to use is_plugin_active
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );




/*
 *  Check if YOAST SEO Plugin is installed and activated
 */
if ( !is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {

    
    /*
    *   display message if YOAST SEO is not activated
    */
    function extend_content_yoast_admin_notices() {
            
            echo '<div class="updated"><p>YOAST SEO Plugin ( min v.3.0 ) must be activated in order to get <strong>"Extended Content Analysis for YOAST SEO"</strong> work correctly.</p></div>';        
    
    }
    add_action('admin_notices', 'extend_content_yoast_admin_notices');    

    
} else{
    
    
    /*
    *   Register scripts - add child theme javascripts to admin area only
    */
    function extend_content_yoast_scripts() {
        
        wp_register_script( 'extend-content-analysis', plugins_url( '/admin/js/extend-content-yoast.js', __FILE__ ) );
    	wp_enqueue_script( 'extend-content-analysis', plugins_url( '/admin/js/extend-content-yoast.js', __FILE__ ), array('yoast-seo'), '1.0.0', true );
    	// register var pluginsUrl for usage in JS files
    	wp_localize_script('extend-content-analysis', 'extendContentYoastScript', array('pluginsUrl' => plugins_url('', __FILE__),));
    	
    }
    add_action('admin_enqueue_scripts', 'extend_content_yoast_scripts');
    
    
}