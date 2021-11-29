<?php

require_once 'Database.php';

// CLASS Table
class Table extends Database{
    public function __construct() {
        add_action( 'plugins_loaded', array( $this, 'createTableCode' ) );
        add_action( 'plugins_loaded', array( $this, 'createTableCommunes' ) );

        register_uninstall_hook(__FILE__,function () {
            $table_name = 'communes';
            $deleteTable = $this->connect()->prepare('DROP TABLE IF EXISTS '.$table_name.'');
            $deleteTable->execute();
        });

        register_uninstall_hook(__FILE__,function () {
            $table_name = 'shortcode';
            $deleteTable = $this->connect()->prepare('DROP TABLE IF EXISTS '.$table_name.'');
            $deleteTable->execute();
        });
    }

    function createTableCode(){
        $newTable = $this->connect()->prepare('CREATE TABLE shortcode
        (
            id INT(6) PRIMARY KEY NOT NULL,
            shortcode VARCHAR(30)
        )');
        $newTable->execute();
    }

    function createTableCommunes(){
        $newTable = $this->connect()->prepare('CREATE TABLE communes
        (
            id INT(6) PRIMARY KEY NOT NULL,
            code INT(6),
            nom VARCHAR(30)
        )');
        $newTable->execute();
    }
}