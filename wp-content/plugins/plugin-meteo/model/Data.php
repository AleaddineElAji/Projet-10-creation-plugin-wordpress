<?php

require_once 'Database.php';


// CLASS DATA
class Data extends Database{

    public function __construct() {
        add_action( 'plugins_loaded', array( $this, 'createTableCode' ) );
        add_action( 'plugins_loaded', array( $this, 'createTableCommunes' ) );
        add_action( 'plugins_loaded', array( $this, 'insert' ) );
        add_action( 'plugins_loaded', array( $this, 'getAll' ) );

        register_deactivation_hook(__FILE__,function () {
            $table_name = 'communes';
            $deleteTable = $this->connect()->prepare('DROP TABLE IF EXISTS '.$table_name.'');
            $deleteTable->execute();
        });

        register_deactivation_hook(__FILE__,function () {
            $table_name = 'shortcode';
            $deleteTable = $this->connect()->prepare('DROP TABLE IF EXISTS '.$table_name.'');
            $deleteTable->execute();
        });
    }

    public function createTableCode(){
        $newTable = $this->connect()->prepare('CREATE TABLE shortcode
        (
            id INT(6) PRIMARY KEY NOT NULL,
            shortcode VARCHAR(30)
        )');
        $newTable->execute();
    }

    public function createTableCommunes(){
        $newTable = $this->connect()->prepare('CREATE TABLE communes
        (
            id INT(6) PRIMARY KEY NOT NULL,
            code INT(6),
            nom VARCHAR(30)
        )');
        $newTable->execute();
    }

    function getAll(){
        $datas = $this->connect()->prepare("SELECT * FROM communes");
        $datas->execute();
        $allDatas = $datas->fetchAll(); 
        return $allDatas;
    }
    function insert($code, $nom){
        $ajouter = $this->connect()->prepare('INSERT INTO communes ( code, nom) VALUES (:code, :nom)');
        $ajouter->bindParam(':code', $code); 
        $ajouter->bindParam(':nom', $nom);
        $ajouter->execute(); 
        $ajouter->debugDumpParams();       
    }
}