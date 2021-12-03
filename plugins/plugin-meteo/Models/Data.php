<?php

require_once __DIR__.'/Database.php';


class Data extends Database{
        public function displayCommunes($dequeldepartement){
                // global $wpdb;
                // $datas = $wpdb->get_results( "SELECT * FROM alacs_communes WHERE codepostal LIKE '$dequeldepartement%'", OBJECT );  
                $datas = $this->connect()->prepare("SELECT * FROM alacs_communes WHERE codepostal LIKE '$dequeldepartement%'");  
                $datas->execute();
                $allDatas = $datas->fetchAll();
                $allDatasJSON = json_encode($allDatas);
                echo $allDatasJSON;
        }

}
