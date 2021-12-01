<?php

require_once __DIR__.'../class/Data.php';

if (isset($_GET['depart']) && !empty($_GET['depart'])) {
    $cp = $_GET['depart'];
    $communes = new Data();
    $communes->displayCommunes($cp);
    echo $communes;
} 

?>