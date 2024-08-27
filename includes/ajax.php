<?php

class Rz_Wp_Plugin_Ajax {
  public function __construct() {
    add_action("admin_menu", array( $this,"admin_menu") );
    add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
    add_action( 'wp_ajax_rz_ajax_get_posts', array( $this, 'rz_ajax_get_posts' ) );
    add_action( 'wp_ajax_nopriv_rz_ajax_get_posts', array( $this, 'rz_ajax_get_posts' ) );
  }
  public function admin_menu() {
    add_menu_page(
      'Rz Ajax Menu',
      'Ajax',
      'manage_options',
      'rz_wp_plugin_ajax',
      array( $this,'rz_wp_plugin_ajax_callback')
    );
  }

  public function rz_wp_plugin_ajax_callback() {
    echo '<div class="rz-wp-plugin-ajax"></div>';
  }

  public function enqueue_admin_scripts( $hook ) {
    if ( 'toplevel_page_rz_wp_plugin_ajax' == $hook ) {
      wp_enqueue_script('ajax-learning', RA_AJX_URL . 'assets/js/ajax.js', array('jquery') );

      wp_localize_script( 'ajax-learning', 'RzAjax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'ajax_nonce' => wp_create_nonce('rzajx'),
      ));

    }
    // var_dump($hook);
  }

  public function rz_ajax_get_posts() {
    check_ajax_referer('rzajx');

    $per_page = isset( $_POST['per_page'] ) ? intval( $_POST['per_page'] ) : 10;

    $post = get_posts(array(
      'post_type' => 'page',
      'posts_per_page' => $per_page,
    ));

    wp_send_json( $post );
  }



}