
<?php
class Data extends Database{
    public function __construct() {
        add_action( 'plugins_loaded', array( $this, 'insert' ) );

    }

    function insert($code, $nom){
        $ajouter = $this->connect()->prepare('INSERT INTO communes ( code, nom) VALUES (:code, :nom)');
        $ajouter->bindParam(':code', $code); 
        $ajouter->bindParam(':nom', $nom);
        $ajouter->execute(); 
        $ajouter->debugDumpParams();       
    }


    function curlAl(){
        $curl = curl_init("https://geo.api.gouv.fr/communes");
        curl_setopt($curl, CURLOPT_CAINFO,__DIR__.'/cert.cer' );
        $communes = curl_exec($curl);
        $communes = json_decode($communes, true);
        foreach ($communes as $commune) {
            $communesainserer = new Data;
            $communesainserer->insert($commune['code'],$commune['nom']);
        }
        curl_close($curl);
    }

}


?>