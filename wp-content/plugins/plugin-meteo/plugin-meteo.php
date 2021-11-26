<?php
    /*
    Plugin Name:  Plugin Meteo
    Plugin URI:   https://aleaddinee.promo-93.codeur.online/
    Description:  Plugin permettant de connaitre les données météo d'un lieu 
    Version:      1.0.0
    Author:       EL AJI Alaedin
    Author URI:   https://aleaddinee.promo-93.codeur.online/
    */


    // require_once 'model/Data.php';

    
    // CLASS DATABSE

    class Database{
        public function __construct() {
            add_action( 'plugins_loaded', array( $this, 'connect' ) );
        }
    
        public function connect(){ //fonction de connextion à la base
            try{
                global $wpdb;
                $servername = $wpdb->dbhost;
                $username = $wpdb->dbuser;
                $password = $wpdb->dbpassword;
                $dbname = $wpdb->dbname;
                $bdd = new PDO('mysql:host='.$servername.';dbname='.$dbname.';port=3306;charset=utf8', $username, $password);
                return $bdd; 
            }
            catch(Exception $e){
                die('Erreur : '.$e->getMessage());
            }
        }
    }

    // CLASS DATA
class Data extends Database{
    public function __construct() {
        add_action( 'plugins_loaded', array( $this, 'createTableCode' ) );
        add_action( 'plugins_loaded', array( $this, 'createTableCommunes' ) );
        add_action( 'plugins_loaded', array( $this, 'insert' ) );


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

    // function getAll(){
    //     $datas = $this->connect()->prepare("SELECT * FROM communes");
    //     $datas->execute();
    //     $allDatas = $datas->fetchAll();
    //     return $allDatas;
    // }

    function insert($code, $nom){
        $ajouter = $this->connect()->prepare('INSERT INTO communes ( code, nom) VALUES (:code, :nom)');
        $ajouter->bindParam(':code', $code); 
        $ajouter->bindParam(':nom', $nom);
        $ajouter->execute(); 
        $ajouter->debugDumpParams();       
    }
}

    function curlAl(){
        $curl = curl_init("https://geo.api.gouv.fr/communes");
        curl_setopt($curl, CURLOPT_CAINFO,__DIR__.'/cert.cer' );
        $communes = curl_exec($curl);
        $communes = json_decode($communes, true);
        foreach ($communes as $commune) {
            $communesainserer = new Data;
            $communesainserer->insert($commune['code'],$commune['nom']);
        }
        curl_close($curl);
    }



    $wpdocsclassDatabase = new Database();

?>