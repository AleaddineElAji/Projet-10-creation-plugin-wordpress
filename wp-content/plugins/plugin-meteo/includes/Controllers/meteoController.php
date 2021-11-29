<?php
require_once  __DIR__ . '/../Models/Data.php';


// add_action( 'plugins_loaded', array( $this, 'createTableCode' ) );
// add_action( 'plugins_loaded', array( $this, 'createTableCommunes' ) );


// register_uninstall_hook(__FILE__,function () {
//     $table_name = 'shortcode';
//     $deleteTable = $this->connect()->prepare('DROP TABLE IF EXISTS '.$table_name.'');
//     $deleteTable->execute();
// });

// register_uninstall_hook(__FILE__,function () {
//     $table_name = 'communes';
//     $deleteTable = $this->connect()->prepare('DROP TABLE IF EXISTS '.$table_name.'');
//     $deleteTable->execute();
// });