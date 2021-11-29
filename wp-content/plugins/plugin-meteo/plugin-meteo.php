<?php
    /*
    Plugin Name:  Plugin Meteo
    Plugin URI:   https://aleaddinee.promo-93.codeur.online/
    Description:  Plugin permettant de connaitre les données météo d'un lieu 
    Version:      1.0.0
    Author:       EL AJI Alaedin
    Author URI:   https://aleaddinee.promo-93.codeur.online/
    */



    require_once  __DIR__ . '/model/Table.php'; 
    require_once  __DIR__ . '/model/Data.php'; 

    
    add_action('admin_menu','lienDeMenu');

    function lienDeMenu(){
        add_menu_page(
            'La page de mon plugin', //Titre de ma page
            'Météo', //Lien dans le add_menu_page
            'manage_options',
            plugin_dir_path(__FILE__).'views/index.php'// L'adresse ou l'on doit attérir quand on clique sur le lien de menu
        );
    }

    function cardStyles() {
        // pour importer une feuille css
        wp_register_style('mon-css', '/css/mon-css.css', dirname(__FILE__));
        wp_enqueue_style('mon-css');
        
    }
    add_action('admin_print_styles', 'cardStyles');




    // function curlAl(){
    //     $curl = curl_init("https://geo.api.gouv.fr/communes");
    //     curl_setopt($curl, CURLOPT_CAINFO,__DIR__.'/cert.cer' );
    //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //     $communes = curl_exec($curl);

    //     if($communes === false){
    //         var_dump(curl_error($curl));
    //     }

    //     else{
    //         $communes = json_decode($communes, true);
    //         $import = new Data;

    //         foreach($communes as $commune){
    //             $import->addDataCommune($commune['code'], $commune['nom']);
    //         }
    //     }
    //     curl_close($curl);
    // }

    // add_action('plugins_loaded','curlAl');
?>