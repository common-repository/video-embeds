<?php

// Defaults

// YouTube
function rbve_defaults_youtube() {
  $default_defaults = array(
    'width' => '720',
    'height' => '400',
    'style' => 'new',
    'related' => 'false',
    'autoplay' => 'false',
    'captions' => 'false',
    'origin' => 'true'
  );
  if( !get_option('rbve_youtube_options') ) {
    update_option('rbve_youtube_options', $default_defaults);
  }
}

// Vimeo
function rbve_defaults_vimeo() {
  $default_defaults = array(
    'width' => '720',
    'height' => '400',
    'autopause' => 'true',
    'autoplay' => 'false',
    'badge' => 'true',
    'byline' => 'true',
    'color' => '00adef',
    'loop' => 'false',
    'player_id' => 'false',
    'portrait' => 'true',
    'title' => 'true'
  );
  if( !get_option('rbve_vimeo_options') ) {
    update_option('rbve_vimeo_options', $default_defaults);
  }
}

function rbve_defaults($type=false) {
  rbve_defaults_youtube();
  rbve_defaults_vimeo();

  if ( $type ) {
    return get_option('rbve_' . $type . '_options');
  }
  return false;
}

?>