<?php

function get_cleaning_dates() {
  // get cleaning post type.
  $cleaning_dates = get_posts(array(
    'post_type'       => 'limpieza',
    'numberposts'  => -1
  ));
  // Get all cleaning dates raw from posts_meta table.
  $cleaning_dates = array_map( function( $date ) {
    return get_post_meta( $date->ID, 'fechas', true );
  }, $cleaning_dates );

  // Explode all raw strings into array of dates in string format.
  $cleaning_dates = array_map( function( $date ) {
    return explode( ',', $date );
  }, $cleaning_dates );

  // Flatten the multidimentional array resulted from the explode function.
  $cleaning_dates = array_flatten( $cleaning_dates );

  // Trim the strings inside the new flatten array
  $cleaning_dates = array_map( function( $date ) {
    return trim( $date );
  }, $cleaning_dates );

  // Convert strings to dates
  $cleaning_dates = array_map( function( $date ) {
    $date = date_create( $date );
    return $date;
  }, $cleaning_dates );

  // Filter out dates before today
  $cleaning_dates = array_filter( $cleaning_dates, function( $date ) {
    $today = new DateTime();
    if ( $date->getTimestamp() > $today->getTimestamp() ) {
      return $date;
    }
  } );

  // Format date to string in Y-m-d format.
  $cleaning_dates = array_map( function( $date ) {
    $date = $date->format( 'Y-m-d' );
    return $date;
  }, $cleaning_dates );
  
  // Only take duplicated dates into account
  $duplicate_dates = array();

  // Set the reservation limit number
  $reservation_limit = 5;

  $duplicates = array_count_values( $cleaning_dates );
  $duplicate_dates = array();
  foreach ( $duplicates as $date => $count ) {
    if ( $count === $reservation_limit ) { 
      array_push( $duplicate_dates, $date ); 
    }
  }

  return $duplicate_dates;
}