<?php
  /*-----------------------------------------------------------------------------
    Custom Copyright Code
  -----------------------------------------------------------------------------*/
  // automatically set the current date with protections and time spans
  function theme_copyright( $year = 'auto' ) {
    if ( intval( $year ) == 'auto' ) {
      $year = date( 'Y' );
    }
    if ( intval( $year ) == date( 'Y' ) ) {
      echo intval( $year );
    }
    if ( intval( $year ) < date( 'Y' ) ) {
      echo intval( $year ) . ' - ' . date( 'Y' );
    }
    if ( intval( $year ) > date( 'Y' ) ) {
      echo date( 'Y' );
    }
  }
