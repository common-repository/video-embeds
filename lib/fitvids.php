<?php

function rbve_fitvids_scripts() {
  wp_register_script('rbve-fitvids', plugins_url("/video-embeds/js/1.0.3/jquery.fitvids.js"), 'jquery', get_option('rbve_version'), true);
  wp_register_script('rbve', plugins_url("/video-embeds/js/rbve.js"), 'jquery', get_option('rbve_version'), true);

  if ( get_option('rbve_fitvids') == 'true' ) {
    wp_enqueue_script('rbve-fitvids');
    wp_enqueue_script('rbve');
  }
}
add_action('wp_enqueue_scripts','rbve_fitvids_scripts');

?>