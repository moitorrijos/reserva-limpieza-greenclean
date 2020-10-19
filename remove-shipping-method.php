<?php

function enqueue_shipping_method() {
  if ( function_exists( 'is_woocommerce') ) {
    wp_enqueue_script(
      'remove_shipping_method',
      plugin_dir_url(__FILE__) . 'dist/remove-shipping-method.js',
      array(),
      GCS_Version,
      true
    );
  }
}

add_action( 'wp_enqueue_scripts', 'enqueue_shipping_method' );