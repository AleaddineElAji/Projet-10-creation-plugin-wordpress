<?php

require_once __DIR__.'/../Models/Data.php';
require_once __DIR__.'/../../../../wp-load.php';
define( 'SHORTINIT', true );

if (isset($_GET['depart']) && !empty($_GET['depart'])) {
    $cp = $_GET['depart'];
    $communes = new Data();
    $communes->displayCommunes($cp);
    return $communes;
} 

?>