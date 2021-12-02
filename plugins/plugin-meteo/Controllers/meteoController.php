<?php
require_once  __DIR__ . '/../Models/Data.php';


function controleOne(){
    $data = new Data;
    $datas = $data->getApiKey();
    require(__DIR__ . "/../includes/meteto-amdin.php");
    return $html;
}

function controleTwo($param){
    $data = new Data;
    $datas = $data->insertKey($param);
    require(__DIR__ . "/../includes/meteto-amdin.php");
    return $html;
}

function controleThree($param){
    $data = new Data;
    $datas = $data->updateKey($param);
    require(__DIR__ . "/../includes/meteto-amdin.php");
    return $html;
}

function controleFour($ville, $APIKey){
    $data = new Data;
    $datas = $data->getDataWeather($ville, $APIKey);
    require(__DIR__ . "/../includes/meteto-amdin.php");
    return $html;
}