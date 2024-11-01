<?php

namespace rbve;

Class URLParameters {
  function __construct() {
    $this->string = "?";
    $this->count = 0;
  }

  public function add($param,$value) {
    if ( $this->count != 0 ) {
      $this->string .= "&";
    }
    $this->string .= $param . "=" . $value;
    $this->count = $this->count + 1;
  }

  public function done() {
    if ( $this->count > 0 ) {
      return $this->string;
    }
    return false;
  }
}

?>