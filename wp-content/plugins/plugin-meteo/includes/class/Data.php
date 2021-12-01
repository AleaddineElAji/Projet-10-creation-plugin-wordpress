<?php

require_once __DIR__.'Database.php';

class Data extends Database{
        function displayCommunes($dequeldepartement){
                global $wpdb;
                $datas = $wpdb->get_results( 'SELECT * FROM {$wpdb->prefix}communes WHERE codepostal LIKE '.$dequeldepartement.'%', OBJECT );
                $datas->execute();
                $allDatas = $datas->fetchAll();
                $allDatasJSON = json_encode($allDatas);
                echo $allDatasJSON;
        }
}
