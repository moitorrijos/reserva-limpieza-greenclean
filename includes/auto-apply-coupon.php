<?php

add_action( 'woocommerce_before_cart', 'gcs_apply_coupon' );

function gcs_apply_coupon() {
    $coupon_code = 'bztrvxen';
    if ( WC()->cart->has_discount( $coupon_code ) ) return;
    WC()->cart->apply_coupon( $coupon_code );
    wc_print_notices();
}