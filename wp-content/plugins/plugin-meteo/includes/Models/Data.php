<?php

require_once 'Database.php';

class Data extends Database
{

    public function deleteData(){
        $supprimer = $this->connect()->prepare('DELETE From communes');
        $supprimer->execute();
        $this->connect()->query('ALTER TABLE communes AUTO_INCREMENT = 1');
    }


    public function addData($code, $nom){
        $ajouter = $this->connect()->prepare('INSERT INTO communes (code, nom)VALUES (:code, :nom)');
        $ajouter->bindParam (':code', $code); 
        $ajouter->bindParam (':nom', $nom);
        $ajouter->execute();       
    }

    public function allData(){
        $interventions = $this->connect()->prepare('SELECT * FROM communes WHERE code LIKE "DEP-%"');
        $interventions->execute();
        $int = $interventions->fetchAll(); //On lui demande de nous retourner dans la variable $int le résultat de notre requête sous forme de tableau.
        return $int;
    }


    public function getList($whichList){

        switch ($whichList) {
            case 'region':
                $departement = $this->connect()->prepare('SELECT code, nom FROM communes WHERE code LIKE "REG-%"');
                break;

                case 'departement':
                    $departement = $this->connect()->prepare('SELECT code, nom FROM communes WHERE code LIKE "DEP-%"');
                    break;
            
            default:
            $departement = $this->connect()->prepare('SELECT code, nom FROM communes WHERE code LIKE "DEP-%"');
                break;
        }

        
        $departement->execute();
        $dept = $departement->fetchAll(); //On lui demande de nous retourner dans la variable $int le résultat de notre requête sous forme de tableau.
        return $dept;
        var_dump($dept);
    }

    public function departmentList(){
        $departement = $this->connect()->prepare('SELECT code, nom FROM communes WHERE code LIKE "DEP-%"');
        $departement->execute();
        $dept = $departement->fetchAll(); //On lui demande de nous retourner dans la variable $int le résultat de notre requête sous forme de tableau.
        return $dept;
        var_dump($dept);
    }

    public function getDepartement($d){
        $departement = $this->connect()->prepare('SELECT * FROM communes WHERE nom = "'.$d.'"');
        $departement->execute();
        //$departement->debugDumpParams();
        $dept = $departement->fetchAll(); //On lui demande de nous retourner dans la variable $int le résultat de notre requête sous forme de tableau.
        return $dept;
        //var_dump($dept);
    }
}



