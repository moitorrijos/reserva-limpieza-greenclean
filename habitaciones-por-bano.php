<?php

add_action( 'init', 'gcs_add_rooms_prices_function' );

function gcs_add_rooms_prices_function() {

  if (isset($_GET['action']) && $_GET['action'] === 'add-rooms-prices' ) {
    $habitaciones_por_bano = array(
      "1 habitación 1 Baño "    =>  35,
      "1 habitación 1.5 Baño"   =>  37.5,
      "1 habitación 2 Baños"    =>  38,
      "1 habitación 2.5 Baño"   =>  39,
      "1 habitación 3 Baños"    =>  41,
      "1 habitación 3.5 Baño"   =>  43.5,
      "1 habitación 4 Baños"    =>  46,
      "1 habitación 4.5 Baño"   =>  46.5,
      "1 habitación 5 Baño"     =>  48.5,
      "1 habitación 5.5 Baños"  =>  50.5,
      "2 habitación 1 Baño"     =>  40,
      "2 habitación 1.5 Baño"   =>  42.5,
      "2 habitación 2 Baños"    =>  45,
      "2 habitación 2.5 Baño"   =>  47.5,
      "2 habitación 3 Baños"    =>  50,
      "2 habitación 3.5 Baño"   =>  52.5,
      "2 habitación 4 Baños"    =>  55,
      "2 habitación 4.5 Baño"   =>  60,
      "2 habitación 5 Baño"     =>  62.5,
      "2 habitación 5.5 Baños"  =>  6,
      "3 habitación 1 Baño"     =>  45,
      "3 habitación 1.5 Baño"   =>  47.5,
      "3 habitación 2 Baños"    =>  50,
      "3 habitación 2.5 Baño"   =>  52.5,
      "3 habitación 3 Baños"    =>  55,
      "3 habitación 3.5 Baño"   =>  57.5,
      "3 habitación 4 Baños"    =>  60,
      "3 habitación 4.5 Baño"   =>  62.5,
      "3 habitación 5 Baño"     =>  65,
      "3 habitación 5.5 Baños"  =>  67.5,
      "4 habitación 1 Baño"     =>  60,
      "4 habitación 1.5 Baño"   =>  62.5,
      "4 habitación 2 Baños"    =>  65,
      "4 habitación 2.5 Baño"   =>  67.5,
      "4 habitación 3 Baños"    =>  70,
      "4 habitación 3.5 Baño"   =>  72.5,
      "4 habitación 4 Baños"    =>  75,
      "4 habitación 4.5 Baño"   =>  77.5,
      "4 habitación 5 Baño"     =>  80,
      "4 habitación 5.5 Baños"  =>  82.5,
      "5 habitación 1 Baño"     =>  70,
      "5 habitación 1.5 Baño"   =>  72.5,
      "5 habitación 2 Baños"    =>  75,
      "5 habitación 2.5 Baño"   =>  77.5,
      "5 habitación 3 Baños"    =>  80,
      "5 habitación 3.5 Baño"   =>  82.5,
      "5 habitación 4 Baños"    =>  85,
      "5 habitación 4.5 Baño"   =>  87.5,
      "5 habitación 5 Baño"     =>  90,
      "5 habitación 5.5 Baños"  =>  92.5
    );
    
    foreach($habitaciones_por_bano as $habitacion => $precio) {
      $post_id = wp_insert_post(array(
        'post_title' => $habitacion,
        'post_type' => 'product',
        'post_status' => 'publish'
      ));
    
      // set product is simple/variable/grouped
      wp_set_object_terms( $post_id, 'habitaciones', 'product_cat' );
      update_post_meta( $post_id, '_visibility', 'visible' );
      update_post_meta( $post_id, '_stock_status', 'instock');
      update_post_meta( $post_id, 'total_sales', '0' );
      update_post_meta( $post_id, '_downloadable', 'no' );
      update_post_meta( $post_id, '_virtual', 'yes' );
      update_post_meta( $post_id, '_regular_price', $precio );
      update_post_meta( $post_id, '_sale_price', '' );
      update_post_meta( $post_id, '_purchase_note', '' );
      update_post_meta( $post_id, '_featured', 'no' );
      update_post_meta( $post_id, '_length', '' );
      update_post_meta( $post_id, '_width', '' );
      update_post_meta( $post_id, '_height', '' );
      update_post_meta( $post_id, '_sku', '' );
      update_post_meta( $post_id, '_product_attributes', array() );
      update_post_meta( $post_id, '_sale_price_dates_from', '' );
      update_post_meta( $post_id, '_sale_price_dates_to', '' );
      update_post_meta( $post_id, '_price', $precio );
      update_post_meta( $post_id, '_sold_individually', '' );
      update_post_meta( $post_id, '_manage_stock', 'yes' );
      wc_update_product_stock($post_id, 1, 'set' );
      update_post_meta( $post_id, '_backorders', 'no' );
      // update_post_meta( $post_id, '_stock', $single['qty'] );
    }
  }
}

