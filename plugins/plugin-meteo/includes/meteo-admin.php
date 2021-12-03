<?php 

require_once  __DIR__ . '/../Models/Data.php'; 
echo '<style>';
require_once  __DIR__ . '../../includes/mon-css.css'; 
echo'</style>';
?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<?php require_once __DIR__.'../../View/viewAl.php'; ?>

<?php

echo '<pre>';

$dataDecode = isset($_POST["departement"]) ? getDataWeather($_POST["departement"],$getAPI): '';
$dataAladinien = isset($_POST["departement"]) ? (genereCode($_POST["departement"])) : '';

var_dump($dataDecode);

echo '</pre>';

?>
