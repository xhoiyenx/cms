<?php
$files = array();
foreach ( glob( 'includes/config/*.php' ) as $file ) {
  $files[ basename($file, '.php') ] = require 'config/' . basename( $file );
}
return $files;