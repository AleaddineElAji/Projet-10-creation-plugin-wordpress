<?php

require_once  __DIR__ . '/Models/Data.php'; 
require_once  __DIR__ . '/Controllers/meteoController.php'; 


//A l'installation du plugin on va faire en sorte qu'une table soit créé dans notre base de données si elle n'existe pas
// global $wpdb;
// $servername = $wpdb->dbhost;
// $username = $wpdb->dbuser;
// $password = $wpdb->dbpassword;
// $dbname = $wpdb->dbname;
// $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// $sh = $conn->prepare( "DESCRIBE `communes`");
// if ( !$sh->execute() ) {
//   $sql = "CREATE TABLE communes (
//     id INT(6) AUTO_INCREMENT PRIMARY KEY,
//     code int(6) NOT NULL,
//     nom VARCHAR(30) NOT NULL,
//     )";
//     $conn->exec($sql);
//     $conn = null;
// } 


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
  require_once("admin/meteo-admin.php");
}

register_activation_hook( __FILE__, 'createTableCode' );
register_activation_hook( __FILE__, 'createTableCommunes' );

register_deactivation_hook( __FILE__, 'deleteTableCode' );
register_deactivation_hook( __FILE__, 'deleteTableCommunes' );
