<?php

function rbve_vimeo($atts) {
  $defaults = rbve_defaults('vimeo');

  // Merge attributes with defaults
  $atts = array_merge(array_filter($defaults, 'strval'), array_filter($atts, 'strval'));

  // Variables
  $id = $atts['vimeo'];
  $width = $atts['width'];
  $height = $atts['height'];

  // URL Params
  $url_params = new \rbve\URLParameters();

  $boolean_options = array(
    'autoplay',
    'autopause',
    'portrait',
    'title',
    'loop',
    'badge',
    'byline'
  );

  foreach ( $boolean_options as $option ) {
    if ( $atts[$option] == 'true' ) {
      $url_params->add($option,'1');
    }
    else {
      $url_params->add($option,'0');
    }
  }

  if ( $atts['player_id'] != 'false' ) {
    $url_params->add('player_id', $atts['player_id']);
  }

  $url_params->add('color',$atts['color']);

  // Finalize URL Parameters
  $url_params = $url_params->done();

  $full_screen = "webkitallowfullscreen mozallowfullscreen allowfullscreen";

  $vimeo = "\t";

  $vimeo .= "<iframe src=\"//player.vimeo.com/video/$id$url_params\" width=\"$width\" height=\"$height\" frameborder=\"0\" $full_screen></iframe>";

  $vimeo .= "\n";

  return $vimeo;
}

?>