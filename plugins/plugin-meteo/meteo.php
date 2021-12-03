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

  function createPage(){
    $page_array = array(
      'post_title' => 'Page météo',
      'post_content' => 'page permettant de voir les résultats météo',
      'post_status'  => 'publish',
      'post_type'    => 'page',
      'post_author'  => get_current_user_id(),
  );
  wp_insert_post($page_array);
  }

  function createTableCode(){
    global $wpdb;
    $query ='CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'shortcode
    (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        shortcode VARCHAR(30)
    )';
    $wpdb->query($query);
  }

  function createTableCommunes(){
    global $wpdb;
    $query = 'CREATE TABLE IF NOT EXISTS '.$wpdb->prefix.'communes
    (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        code INT(6),
        codepostal INT(6),
        nom VARCHAR(30)
    )';
    $wpdb->query($query);
  }

  function curlalaedin(){
    $curl = curl_init("https://geo.api.gouv.fr/communes");
    curl_setopt_array($curl, [
            CURLOPT_CAINFO          => __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer',
            CURLOPT_RETURNTRANSFER  => true,
    ]);
    $communes = curl_exec($curl);
    $communes = json_decode($communes, true);

    global $wpdb;

    $values = array();
    $place_holders = array();
    $query = 'INSERT INTO '.$wpdb->prefix.'communes ( code, codepostal, nom) VALUES ';
    foreach ($communes as $commune){
        foreach ($commune['codesPostaux'] as $codepostal){
        array_push($values, $commune['code'], $codepostal, $commune['nom']);
        $place_holders[] = "(%d, %d, %s)";
    }}
    $query .= implode( ', ', $place_holders );
    $wpdb->query( $wpdb->prepare( "$query ", $values ) );

    curl_close($curl);   
}

  createPage();
  createTableCode();
  createTableCommunes();
  curlalaedin();
}

function desactivation(){

  function desactivationPage(){
    $ondoitsupprimerquoi = get_page_by_title('Page météo');
    wp_delete_post($ondoitsupprimerquoi->ID, true);
  }

  function deleteDataTableCode(){
    global $wpdb;
    $query ='TRUNCATE TABLE '.$wpdb->prefix.'shortcode';
    $wpdb->query($query);
  }

  function deleteDataTableCommunes(){
    global $wpdb;
    $query = 'TRUNCATE TABLE '.$wpdb->prefix.'communes';
    $wpdb->query($query);
  }

  desactivationPage();
  deleteDataTableCode();
  deleteDataTableCommunes();
}
function uninstallFunction(){

  function deleteTableCode(){
    global $wpdb;
    $query ='DROP TABLE '.$wpdb->prefix.'shortcode';
    $wpdb->query($query);
  }

  function deleteTableCommunes(){
    global $wpdb;
    $query = 'DROP TABLE '.$wpdb->prefix.'communes';
    $wpdb->query($query);
  }

  deleteTableCode();
  deleteTableCommunes();
}

//Creéation d'un shortcode simple avec argument
function welcomewho($where){
  $s = isset($where["ville"]) ? $where["ville"]: '';
  $test = getDataWeather($s,getApiKey());
  require_once  __DIR__ . '/View/viewPage.php'; 

  return var_dump($test);
}
add_shortcode('meteo', 'welcomewho');

register_activation_hook( __FILE__, 'initFunction' );

register_deactivation_hook( __FILE__, 'desactivation' );

register_uninstall_hook( __FILE__, 'uninstallFunction' );