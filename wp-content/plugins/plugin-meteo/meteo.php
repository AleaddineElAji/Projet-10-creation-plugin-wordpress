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

function createTableCode(){
  $activObj = new Data();
  $newTable = $activObj->connect()->prepare('CREATE TABLE shortcode
  (
      id INT(6) PRIMARY KEY NOT NULL,
      shortcode VARCHAR(30)
  )');
  $newTable->execute();
}
function deleteTableCode(){
  $activObj = new Data();
  $newTable = $activObj->connect()->prepare('DELETE TABLE shortcode');
  $newTable->execute();
}

function createTableCommunes(){
  $activObj = new Data();
  $newTable = $activObj->connect()->prepare('CREATE TABLE communes
  (
      id INT(6) PRIMARY KEY NOT NULL,
      code INT(6),
      nom VARCHAR(30)
  )');
  $newTable->execute();
}
function deleteTableCommunes(){
  $activObj = new Data();
  $newTable = $activObj->connect()->prepare('DELETE TABLE communes');
  $newTable->execute();
}

function cURLAl(){
  //Traitement des données
  $curl = curl_init("https://geo.api.gouv.fr/communes");
  curl_setopt($curl, CURLOPT_CAINFO,__DIR__.'/cert.cer' );
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $communes = curl_exec($curl);

  if($communes === false){
      var_dump(curl_error($curl));
  }
  else{
      $communes = json_decode($communes, true);
      $import = new Data();
      $delete = new Data();
      $delete->deleteData();
      for ($i=0; $i < count($communes) ; $i++) {   
          $import->addData($communes[$i]['code'], $communes[$i]['nom']);
      }
  }
  curl_close($curl);  
}




register_activation_hook( __FILE__, 'createTableCode' );
register_activation_hook( __FILE__, 'cURLAl' );
register_deactivation_hook( __FILE__, 'deleteTableCode' );

register_activation_hook( __FILE__, 'createTableCommunes' );
register_deactivation_hook( __FILE__, 'deleteTableCommunes' );

