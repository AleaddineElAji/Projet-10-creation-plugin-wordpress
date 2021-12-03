<?php
require_once  __DIR__ . '/../Models/Data.php';

function getApiKey(){
    global $wpdb;
    $query = 'SELECT option_value FROM alacs_options WHERE option_name = "APIKey"';
    $result = $wpdb->get_var($query);
    return $result;
}

function insertKey($param){
    global $wpdb;
    $query = 'INSERT INTO '.$wpdb->prefix.'options (option_name, option_value,autoload) VALUES ("APIKey","'.$param.'","yes")';
    $result = $wpdb->query($query);
}

function updateKey($param){
    global $wpdb;
    $query = 'UPDATE alacs_options SET option_value="'.$param.'" WHERE option_name = "APIKey";';
    $wpdb->get_var($query);
}

function getDataWeather($ville,$APIKey){
    $curl = curl_init("api.openweathermap.org/data/2.5/weather?q=$ville&appid=$APIKey");
    curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER  => true,
    ]);
    $data = curl_exec($curl);
    $data = json_decode($data, true);
    curl_close($curl);
    return $data;
}


function getCleanData($dataJson){
    $temperature = $dataJson['name'];
    $ressenti = $dataJson['main']['feels_like'] - 273.15;
    $humidite = $dataJson['main']['humidity'];
    $tempMin = $dataJson['main']['temp_min'] - 273.15;
    $tempMax = $dataJson['main']['temp_max'] - 273.15;
    $vitesseVent = $dataJson['wind']['speed'];
    $descVent = $dataJson['weather']['0']['description'];
    $icons = $dataJson['weather']['0']['icon'];

    $allDatas = array($temperature,$ressenti,$humidite,$tempMin,$tempMax,$vitesseVent,$descVent,$icons);
    return $allDatas;
}

function weatherAl($dataJson){
    getCleanData($dataJson);
}