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

  // Only take duplicated dates into account
  $duplicate_dates = array();

  $count = count( $cleaning_dates );
  for ($i = 0; $i < $count; $i++) {
    $date = $cleaning_dates[$i];
    for ($j = 0; $j < $count; $j++) {
      if ( $date === $cleaning_dates[$j] ) {
        array_push( $duplicate_dates, $date );
      }
    }
  }

  // Filter out duplicated dates
  $reserved_dates = array_unique( $duplicate_dates );
  $reserved_dates = array_values( $reserved_dates );
  // Convert dates format to Ymd

  return $reserved_dates;
}