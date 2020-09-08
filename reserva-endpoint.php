<?php

add_action('wp_ajax_gcs_go_to_cart', 'gcs_go_to_cart_func');
add_action('wp_ajax_nopriv_gcs_go_to_cart', 'gcs_go_to_cart_func');

function gcs_go_to_cart_func() {
  if ( !check_ajax_referer( 'gcs_reserva_nonce', 'security' ) ) {
		return wp_send_json_error('Invalid security threshold, please try again later.');
  }

  $all_ids = $_POST['allIds'];
  $quantity = $_POST['quantity'];

  $_SESSION['days'] = $_POST['days'];
  $_SESSION['hour'] = $_POST['hour'];

  global $woocommerce;

  $woocommerce->cart->empty_cart();
  foreach($all_ids as $product_id) {
    $woocommerce->cart->add_to_cart( $product_id, $quantity );
  }

  if (is_wp_error( $woocommerce )) {
    wp_send_json_error();
  } else {
    wp_send_json_success();
  }
  exit();
}
