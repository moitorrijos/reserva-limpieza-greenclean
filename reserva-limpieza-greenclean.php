<?php
/**
 * Plugin Name:     Reserva tu limpieza GCS
 * Plugin URI:      https://github.com/moitorrijos/gcs-reserva-tu-limpieza
 * Description:     Plugin personalizado para la creación de un formulario para reservar limpieza en Green Clean Solutions.
 * Author:          Juan Moises Torrijos
 * Author URI:      https://moitorrijos.com
 * Text Domain:     reserva-limpieza-greenclean
 * Domain Path:     /languages
 * Version:         2.3.1
 *
 * @package         Reserva_Limpieza_Greenclean
 */

defined( 'ABSPATH' ) || exit;

require __DIR__ . '/vendor/autoload.php';

include( plugin_dir_path( __FILE__ ) . 'register_my_session.php' );
include( plugin_dir_path( __FILE__ ) . 'register-limpieza-cpt.php');
include( plugin_dir_path( __FILE__ ) . 'svg-inliner.php' );
include( plugin_dir_path( __FILE__ ) . 'formulario-reserva.php' );
include( plugin_dir_path( __FILE__ ) . 'reserva-endpoint.php' );
include( plugin_dir_path( __FILE__ ) . 'pago-limpieza-completado.php' );
include( plugin_dir_path( __FILE__ ) . 'hide-reserva-products.php' );