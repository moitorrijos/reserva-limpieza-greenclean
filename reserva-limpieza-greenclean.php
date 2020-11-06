<?php
/**
 * Plugin Name:     Reserva tu limpieza GCS
 * Plugin URI:      https://github.com/moitorrijos/gcs-reserva-tu-limpieza
 * Description:     Plugin personalizado para la creación de un formulario para reservar limpieza en Green Clean Solutions.
 * Author:          Juan Moises Torrijos
 * Author URI:      https://moitorrijos.com
 * Text Domain:     reserva-limpieza-greenclean
 * Domain Path:     /languages
 * Version:         3.17
 *
 * @package         Reserva_Limpieza_Greenclean
 */

defined( 'ABSPATH' ) || exit;
define ( 'GCS_Version', '3.17' );

include( plugin_dir_path( __FILE__ ) . 'includes/array_flatten.php');
include( plugin_dir_path( __FILE__ ) . 'includes/get_gcs_holidays.php');
include( plugin_dir_path( __FILE__ ) . 'includes/get_cleaning_dates.php');
include( plugin_dir_path( __FILE__ ) . 'includes/register_my_session.php' );
include( plugin_dir_path( __FILE__ ) . 'includes/register-limpieza-cpt.php');
include( plugin_dir_path( __FILE__ ) . 'formulario-reserva.php' );
include( plugin_dir_path( __FILE__ ) . 'includes/reserva-endpoint.php' );
include( plugin_dir_path( __FILE__ ) . 'includes/pago-limpieza-completado.php' );
include( plugin_dir_path( __FILE__ ) . 'includes/hide-reserva-products.php' );
include( plugin_dir_path( __FILE__ ) . 'includes/remove-shipping-method.php' );
