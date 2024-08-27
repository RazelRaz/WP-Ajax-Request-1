<?php
/*
 * Plugin Name:       WP Ajax Request
 * Description:       This is a basic Plugin
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Razel Ahmed
 * Author URI:        https://razelahmed.com
 */

class Wp_Ajax_Request {
  private static $instance;

  public static function getInstance() {

    //if there is no instance
    if ( ! self::$instance ) {
      self::$instance = new self();
    }

    return self::$instance;

  }

  private function __construct() {
    $this->register_constants();
    $this->require_classes();
  }

  private function require_classes() {

    require_once __DIR__ ."/includes/ajax.php";

    new Rz_Wp_Plugin_Ajax();
  }

  private function register_constants() {
    define( 'RA_AJX_URL', plugin_dir_url(__FILE__) );
  }



}

Wp_Ajax_Request::getInstance();