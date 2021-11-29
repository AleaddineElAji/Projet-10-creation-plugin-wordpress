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

  function curlalaedin(){
    //Traitement des données
    $curl = curl_init("https://geo.api.gouv.fr/communes");
    curl_setopt($curl, CURLOPT_CAINFO,__DIR__.DIRECTORY_SEPARATOR.'/cert.cer' );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $communes = curl_exec($curl);
  // print_r($communes);
    if($communes === false){
      var_dump(curl_error($curl));
    }else{
      $communes = json_decode($communes, true);
      global $wpdb;
      // $delete = new Data();
      // $delete->deleteData();
      // for ($i=0; $i < count($communes) ; $i++) {   
      //     $import->addData($communes[$i]['code'], $communes[$i]['nom']);
      // }
      foreach($communes as $commune){
        // $wpdb->insert($commune['code'], $commune['nom']);
        $wpdb->insert('communes', array('code' => $commune['code'],'nom' => $commune['nom'],));
      }
    }
    curl_close($curl);  
  }
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
}

register_activation_hook( __FILE__, 'initFunction' );

register_uninstall_hook( __FILE__, 'uninstallFunction' );