<?php

function rbve_youtube($atts) {
  $defaults = rbve_defaults('youtube');

  // Merge attributes with defaults
  $atts = array_merge(array_filter($defaults, 'strval'), array_filter($atts, 'strval'));

  // Variables
  $id = $atts['youtube'];
  $width = $atts['width'];
  $height = $atts['height'];
  $url_params = new \rbve\URLParameters();

  if ( $atts['related'] == 'false' ) {
    $url_params->add('rel','0');
  }

  if ( $atts['autoplay'] == 'true' ) {
    $url_params->add('autoplay','1');
  }

  if ( $atts['captions'] == 'true' ) {
    $url_params->add('cc_load_policy','1');
  }

  if ( $atts['origin'] == 'true' ) {
    $url = get_permalink() ? get_permalink() : get_bloginfo('url');
    $url_params->add('origin', $url);
  }

  // Finalize URL Params
  $url_params = $url_params->done();

  $youtube = "\t";

  if ( $atts['style'] == 'old' ) {
    $youtube .= "<object width=\"$width\" height=\"$height\" data=\"//www.youtube.com/v/$id$url_params\" type=\"application/x-shockwave-flash\"><param name=\"src\" value=\"//www.youtube.com/v/$id$url_params\" /></object>";
    $youtube .= "\n";
  }
  elseif ( $atts['style'] == 'new' ) {
    $youtube .= "<iframe id=\"ytplayer\" type=\"text/html\" width=\"$width\" height=\"$height\" src=\"//www.youtube.com/embed/$id$url_params\" frameborder=\"0\"></iframe>";
    $youtube .= "\n";
  }
  else {
    return false;
  }

  return $youtube;
}

?>