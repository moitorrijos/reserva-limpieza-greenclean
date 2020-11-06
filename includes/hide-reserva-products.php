<?php

/**
 * Exclude products from a particular category on the shop page
 */
function custom_pre_get_posts_query( $q ) {

  $tax_query = (array) $q->get( 'tax_query' );

  $tax_query[] = array(
         'taxonomy' => 'product_cat',
         'field' => 'slug',
         'terms' => array( 'habitaciones', 'area', 'servicios-extra', 'tipo-de-limpieza', 'tipo-de-propiedad', 'ubicacion', 'habitaciones' ), // Don't display products in the clothing category on the shop page.
         'operator' => 'NOT IN'
  );


  $q->set( 'tax_query', $tax_query );

}
add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query' );  