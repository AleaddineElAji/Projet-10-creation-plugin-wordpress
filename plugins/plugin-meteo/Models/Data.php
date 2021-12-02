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
        
        public function getApiKey(){
                global $wpdb;
                $query = 'SELECT option_value FROM alacs_options WHERE option_name = "APIKey"';
                $result = $wpdb->get_var($query);
                return $result;
        }
        
        public function insertKey($param){
                global $wpdb;
                $query = 'INSERT INTO '.$wpdb->prefix.'options (option_name, option_value,autoload) VALUES ("APIKey","'.$param.'","yes")';
                $result = $wpdb->query($query);
        }
        
        public function updateKey($param){
                global $wpdb;
                $query = 'UPDATE alacs_options SET option_value="'.$param.'" WHERE option_name = "APIKey";';
                $wpdb->get_var($query);
        }
}
