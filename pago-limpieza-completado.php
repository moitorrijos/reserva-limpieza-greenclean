<?php

add_action( 'woocommerce_checkout_update_order_meta', 'gcs_crear_post_limpieza' );

function gcs_crear_post_limpieza($order_id) {
  if ($_SESSION['days'] && $_SESSION['hour']) {
    $order = wc_get_order( $order_id );
    $client_name = $order->billing_first_name . ' ' . $order->billing_last_name;
    $nueva_limpieza = array(
      'post_title'    => 'Limpieza Pedido No. ' . $order_id . ' Para ' . $client_name,
      'post_content'  => 'This is my post.',
      'post_type'     => 'limpieza',
      'post_status'   => 'publish',
    );
    $limpieza_id  = wp_insert_post( $nueva_limpieza );
    $fechas       = $_SESSION['days'];
    $horario      = $_SESSION['hour'];

    //Change date format from $fechas array
    foreach ($fechas as &$fecha) {
      $fecha = DateTime::createFromFormat('Ymd', $fecha)->format('j F Y');
    }

    unset($fecha);
    
    $order_items  = $order->get_items();
    
    function get_order_names($order) {
      return $order["name"];
    }

    $order_names = array_map('get_order_names', $order_items);

    $extra_services = array();

    array_push(
      $extra_services,
      array_values($order_names)[5],
      array_values($order_names)[6],
      array_values($order_names)[7],
      array_values($order_names)[8],
      array_values($order_names)[9],
      array_values($order_names)[10]
    );

    $extra_services = array_filter($extra_services);

    update_post_meta( $limpieza_id, 'nombre_de_cliente', $client_name );
    update_post_meta( $limpieza_id, 'fechas', implode(",\n", $fechas) );
    update_post_meta( $limpieza_id, 'horario', $horario );
    update_post_meta( $limpieza_id, 'ubicacion', array_values($order_names)[0] );
    update_post_meta( $limpieza_id, 'area', array_values($order_names)[1] );
    update_post_meta( $limpieza_id, 'propiedad', array_values($order_names)[2] );
    update_post_meta( $limpieza_id, 'habitaciones', array_values($order_names)[3] );
    update_post_meta( $limpieza_id, 'tipo_de_limpieza', array_values($order_names)[4] );
    update_post_meta( $limpieza_id, 'servicios_extra', implode(",\n", $extra_services) );
  }
}

// define the woocommerce_email_order_meta callback 
function detalles_fecha_horario_reserva( $order, $sent_to_admin, $plain_text, $email ) { 
  if ($_SESSION['days'] && $_SESSION['hour']) {
    $fechas       = $_SESSION['days'];
    $horario      = $_SESSION['hour'];

    //Change date format from $fechas array
    foreach ($fechas as &$fecha) {
      $fecha = DateTime::createFromFormat('Ymd', $fecha)->format('j F Y');
    }

    unset($fecha);

    ?>
      <p>Fechas seleccionadas: <?php echo implode(",\n", $fechas); ?></p>
      <p>Horario preferido: <?php echo $horario; ?></p>
    <?php
  }
}; 
       
// add the action 
add_action( 'woocommerce_email_after_order_table', 'detalles_fecha_horario_reserva', 10, 4 ); 