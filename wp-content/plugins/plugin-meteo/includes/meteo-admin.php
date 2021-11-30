<?php 

require_once  __DIR__ . '/../Models/Data.php'; 
?>
<head>
  <?php wp_head(); ?>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<style>
    input{
        width: 100%;
        margin: 2.5vh 0 !important;
    }

    label{
        width: 100%;
    }
    .rowAl{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }
    .box{
        min-height: max-content;
        background-color: #C0C0C015;
        box-shadow: #d9d7d7 3px 6px 14px;
    }
    .titleAl{
        margin-left: 5vw;
        margin-top: 2.5vh;
    }
    .MaxiBlocks{
        margin: 5vh auto !important;
    }
</style>

<body>

<section class="container MaxiBlocks">
    <div class="box">
        <div class="row rowAl">
            <h2 class="titleAl">API</h2>
            <div class="col-6">
                <form action="">
                    <label>Récuperer votre API :
                        <input type="text">
                    </label>
                </form>                
            </div>
        </div>
    </div>
</section>


<section class="container MaxiBlocks">
    <div class="box">
        <div class="row rowAl">
            <h2 class="titleAl">Shortcode</h2>
            <div class="col-6">
                <form action="">
                    <label>Récuperer votre shortcode :
                        <input type="text">
                    </label>
                </form>                
            </div>
        </div>
    </div>
</section>


<section class="container MaxiBlocks">
    <div class="box">
        <div class="row rowAl">
            <h2 class="titleAl">Météo</h2>
            <div class="col-6">
                <form action="">
                    <label>Département :
                        <input type="text">
                    </label>
                    <label for="">Ville :
                        <input type="text">
                    </label>
                </form>                
            </div>
        </div>
    </div>
</section>   

<!-- <form action="" method="post">
    <input type="submit" name="someAction" value="GO" />
</form> -->

<?php
    // if(isset($_POST['someAction']))
    // {
    //     curlalaedin();
    // }
    
    // function curlalaedin(){
    //     $curl = curl_init("https://geo.api.gouv.fr/communes");
    //     curl_setopt_array($curl, [
    //             CURLOPT_CAINFO          => __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer',
    //             CURLOPT_RETURNTRANSFER  => true,
    //     ]);
    //     $communes = curl_exec($curl);
    //     $communes = json_decode($communes, true);
    
    //     global $wpdb;
    
    //     $values = array();
    //     $place_holders = array();
    //     $query = "INSERT INTO communes ( code, codepostal, nom) VALUES ";
    //     foreach ($communes as $commune){
    //         foreach ($commune['codesPostaux'] as $codepostal){
    //             $id = $commune['code'];
    //             $code = $codepostal;                                
    //             $nom = $commune['nom'];
    //         array_push($values, $commune['code'], $codepostal, $commune['nom']);
    //         $place_holders[] = "(%d, %d, %s)";
    //     }}
    //     $query .= implode( ', ', $place_holders );
    //     $wpdb->query( $wpdb->prepare( "$query ", $values ) );
    
    //     curl_close($curl);   
    // }
?>

</body>

<?php



