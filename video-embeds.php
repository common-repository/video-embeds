<?php
/*
Plugin Name: Video Embeds
Plugin URI: https://github.com/ryanburnette/video-embeds
Description: Just another plugin that creates shortcodes for embedding videos in posts.
Version: 0.1.1
Author: Ryan Burnette
Author URI: http://ryanburnette.com
License: GPL2
*/

// Version
function rbve_get_plugin_version($file) {
  $plugin_folder = get_plugins( '/' . plugin_basename( dirname($file) ) );
  $plugin_file = basename( ($file) );
  return $plugin_folder[$plugin_file]['Version'];
}

function rbve_version($file) {
  $version_pre = get_option('rbve_version');
  $version_now = rbve_get_plugin_version(__FILE__);
  if ( $version_pre != $version_now ) {
    rbve_upgrade($version_pre, $version_now);
    update_option('rbve_version', $version_now);
  }
}
add_action('admin_init','rbve_version');

$version = get_option('rbve_version');

// Upgrade routines
function rbve_upgrade($old,$new) {
  return false;
}

// Menu
function rbve_menu() {
  add_options_page('Video Embeds', 'Video Embeds', apply_filters('rbve_menu_capability','manage_options'), 'rbve', 'rbve_settings_page');
}
add_action('admin_menu','rbve_menu');

// Menu page
function rbve_settings_page() {
  include('pages/settings.php');
}

// Defaults
include('lib/defaults.php');

// Lib
include('lib/vimeo.php');
include('lib/youtube.php');
include('lib/url-parameters.php');
include('lib/fitvids.php');

// Shortcode
function rbve_shortcode_func($atts) {
  $ids = $atts['id'] ? $atts['id'] : false;
  $class = $atts['class'] ? $atts['class'] : false;

  if ( $ids ) {
    $div_attributes = " id=\"$ids\"";
  }
  if ( $class ) {
    $div_attributes .= " class=\"rbve-wrapper $class\"";
  }
  else {
    $div_attributes .= " class=\"rbve-wrapper\"";
  }

  $return = "\n\n";
  $return .= "<!-- rbve -->\n";
  $return .= "<div$div_attributes>\n";
  if ( $atts['youtube'] ) {
    $return .= rbve_youtube($atts);
  }
  if ( $atts['vimeo'] ) {
    $return .= rbve_vimeo($atts);
  }
  $return .= "</div>\n";
  $return .= "<!-- /rbve -->\n\n";

  return $return;
}
add_shortcode('ve', 'rbve_shortcode_func');

// Admin notices
function rbve_admin_notice() {
  if ( isset($_POST['rbve_settings']) ) {
    ?>
    <div class="updated">
        <p><?php _e("Your settings have been updated."); ?></p>
    </div>
    <?php
  }
}
add_action('admin_notices', 'rbve_admin_notice');

?>
