<?php

require_once 'Database.php';

class Data extends Database{
    public function addDataCommune($code, $nom){
        $ajouter = $this->connect()->prepare('INSERT INTO communes (code, nom) VALUES (:code, :nom)');
        $ajouter->bindParam (':code', $code); 
        $ajouter->bindParam (':nom', $nom);
        $ajouter->execute();     
    }

}


?>