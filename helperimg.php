<?php 
/**
 * @package HelperImgTag
 */
/*
Plugin Name:Imagify Helper Image Tag
Plugin URI: None
Description: A very simple plugin to prevent the replacement of img tags with picture tags when Imagify WebP feature is enabled.
Version: 1.0.0
Author: Efren Villarico
Author URI: None
License: MIT License
Text-Domain: helperimgtag-plugin
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class HelperImgTagPlugin {

    public function __construct()
    {
        add_filter( 'imagify_allow_picture_tags_for_webp', function() {return false;});
        if( !function_exists('is_plugin_active') ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );			
		}		
        if( ! is_plugin_active( 'imagify/imagify.php' )) {
            add_action( 'admin_notices', array($this,'imagify_missing_notice') );
        }
    }
    function imagify_missing_notice() {   
        echo '<div class="error"><p><strong>' . sprintf( esc_html__( 'Imagify Helper Image Tag Plugin  may not work with Imagify plugin deactivated or not installed. You can get Imagify %s.', 'helperimg' ), '<a href="https://wordpress.org/plugins/imagify/" target="_blank">here</a>' ) . '</strong></p></div>';
    }
    public function activate() {
    }
    public function deactivate() {
    }
}

if ( class_exists('HelperImgTagPlugin')){
    $helperImgTagPlugin = new HelperImgTagPlugin();
}

register_activation_hook( __FILE__, array($helperImgTagPlugin, 'activate') );
register_deactivation_hook( __FILE__, array($helperImgTagPlugin, 'deactivate') );
