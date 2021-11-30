<?php
 /*
 Plugin Name: Plugin météo
 Plugin URI: https://aleaddinee.promo-93.codeur.online/
 Description: Récuperation des données météo grace une API
 Version: 1.0.0
 Author: Access Code School
 Author URI: https://aleaddinee.promo-93.codeur.online/
 License: GPL3
 Text Domain: Plugin météo 
 */


// require_once plugin_dir_path(__FILE__) . 'includes/config.php';

require_once  __DIR__ . '/Models/Data.php'; 
require_once  __DIR__ . '/Controllers/meteoController.php'; 

//Ajout de lien de notre plugin dans le menu latéral
add_action( 'admin_menu', 'pluginLink' );
 
function pluginLink()
{
      add_menu_page(
        'Météo', //Titre de la page
        'Météo', //Lien devant être affiché dans la barre latérale
        'manage_options', //Obligatoire pour que ca fonctionne
        'météo_admin', //Le Slug
        'meteo_page'//Le callBack
    );
}

//Maintenant génération de l'intérieur de la page admin quand le slug est appelé
function meteo_page(){
  require_once("includes/meteo-admin.php");
}

function initFunction(){

  function createTableCode(){
    global $wpdb;
    $query ='CREATE TABLE shortcode
    (
        id INT(6) PRIMARY KEY NOT NULL,
        shortcode VARCHAR(30)
    )';
    $wpdb->query($query);
  }

  function createTableCommunes(){
    global $wpdb;
    $query = 'CREATE TABLE communes
    (
        id INT(6) PRIMARY KEY NOT NULL,
        code INT(6),
        nom VARCHAR(30)
    )';
    $wpdb->query($query);
  }

  // function curlalaedin(){
  //   //Traitement des données
  //   $curl = curl_init("https://geo.api.gouv.fr/communes");
  //   curl_setopt($curl, CURLOPT_CAINFO,__DIR__.DIRECTORY_SEPARATOR.'/cert.cer' );
  //   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  //   $communes = curl_exec($curl);
  // // print_r($communes);
  //   if($communes === false){
  //     var_dump(curl_error($curl));
  //   }else{
  //     $communes = json_decode($communes, true);

  //     global $wpdb;

  //     $values = array();
  //     $place_holders = array();
      
  //     $query = "INSERT INTO communes (code, nom) VALUES ";

  //     foreach ( $communes as $key => $value ) {
  //       array_push( $values, $value);
  //       $place_holders[] = "('%d', '%s')";
  //       // var_dump($value);
  //     }
  //     $query .= implode( ', ', $place_holders );
  //     $wpdb->query( $wpdb->prepare( "$query ", $values ) );
  //   }
  //   curl_close($curl);  
  // }

  function curlalaedin(){
    $curl = curl_init("https://geo.api.gouv.fr/communes");
    curl_setopt_array($curl, [
            CURLOPT_CAINFO          => __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer',
            CURLOPT_RETURNTRANSFER  => true,
    ]);
    $communes = curl_exec($curl);
    $communes = json_decode($communes, true);

    global $wpdb;

    $table_name_communes ='communes';
    $values = array();
    $place_holders = array();
    $query = "INSERT INTO $table_name_communes ( code, codepostal, nom) VALUES ";
    foreach ($communes as $commune){
        foreach ($commune['codesPostaux'] as $codepostal) {
            $id = $commune['code'];
            $code = $codepostal;                                
            $nom = $commune['nom'];
        array_push($values, $commune['code'], $codepostal, $commune['nom']);
        $place_holders[] = "(%d, %d, %s)";
    }}
    $query .= implode( ', ', $place_holders );
    $wpdb->query( $wpdb->prepare( "$query ", $values ) );

    curl_close($curl);
  }

  createTableCode();
  createTableCommunes();
  curlalaedin();
}

function uninstallFunction(){

  function deleteTableCode(){
    global $wpdb;
    $query ='DROP TABLE shortcode';
    $wpdb->query($query);
  }

  function deleteTableCommunes(){
    global $wpdb;
    $query = 'DROP TABLE communes';
    $wpdb->query($query);
  }

  deleteTableCode();
  deleteTableCommunes();
}

register_activation_hook( __FILE__, 'initFunction' );

register_uninstall_hook( __FILE__, 'uninstallFunction' );