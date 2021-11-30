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
        border: 1px solid black !important;
        border-radius: 5px !important;
        padding: 0 !important;
        padding-left: 0.75rem !important;
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

    .btMeteo{
        margin-bottom: 2rem;
        border-radius: 10px !important;
    }

</style>

<body>

<section class="container MaxiBlocks">
    <div class="box">
        <div class="row rowAl">
            <h2 class="titleAl">API</h2>
            <div class="col-6">
                <form method="POST" action="">
                    <label>Récuperer votre API :
                        <input type="text" name="inputAPI">
                    </label>
                    <button class="btMeteo" type="submit" name="btAPISend">chercher</button>
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
                <form method="POST" action="">
                    <label>Récuperer votre shortcode :
                        <input type="text" name="inputShortcode">
                    </label>
                    <button class="btMeteo" type="submit" name="btShortcodeSend">chercher</button>
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
                <form method="POST" action="">
                    <label>Département :
                        <input type="text" name="inputDept">
                    </label>
                    <label for="">Ville :
                        <input type="text" name="inputVille">
                    </label>
                    <button class="btMeteo" type="submit" name="btMeteoSend">chercher</button>
                </form>   
            </div>
        </div>
    </div>
</section>   

<?php

if(isset($_POST['btAPISend'])){
    echo'merci pour le click API';
}
if(isset($_POST['btShortcodeSend'])){
    echo'merci pour le click Shortcode';
}
if(isset($_POST['btMeteoSend'])){
    echo'merci pour le click Meteo';
}

?>

<!-- <script>
        //Ajax
    function ajax(url, params){
        var httpRequest;
        makeRequest(url, params);
        function makeRequest(url, params){
            httpRequest = new XMLHttpRequest();
            if(!httpRequest){
                console.log('Abandon: ( Impossible de créer unt instance de XMLHTTP');
                return false;
            }
            httpRequest.onreadystatechange = alertContents;
            httpRequest.open('POST', url);
            httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            httpRequest.send('params=' + encodeURIComponent(params));
        }

        function alertContents(){
            try {
                if (httpRequest.readyState === XMLHttpRequest.DONE) {
                    if (httpRequest.status === 200) {
                        var response = JSON.parse(httpRequest.responseText);
                        console.log(response);
                    } else {
                        console.log('Il y a eu un problème avec la requête.');
                    }
                }
            }
            catch(e){
                console.log("Une exception s’est produite : " + e.description);
            }
        }
    };
    // Générateur de sélecteur de catégorie
    ajax('/ajax/selectdepartement.php', [])
    
    
</script> -->

</body>



