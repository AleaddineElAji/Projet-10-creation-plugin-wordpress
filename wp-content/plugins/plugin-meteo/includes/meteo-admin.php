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


<input type="text" name="depart" id="zipCode">

<select name="departement" id="lesdepartements" class="form-control" hidden>
    <option value="" disabled selected>Choisir un département</option>
</select>




<script>
    //Ajax
    let zipCode = document.getElementById('zipCode')
    let departement = document.getElementById('lesdepartements')

    function showDepartmentList() {
    departement.innerHTML = ""
    if (zipCode.value != "") {
        departement.style = "display:block!important"
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var departements = JSON.parse(this.response)
                console.log(departements)
                document.getElementById("lesdepartements").innerHTML += '<option value="">Selecionnez une région</option>'
                for (let i = 0; i < departements.length; i++) {
                    document.getElementById("lesdepartements").innerHTML += '<option value="' + departements[i].nom + '">' + departements[i].nom + '</option>'
                }
            }
        }
        xmlhttp.open("GET", "../wp-content/plugins/plugin-meteo/includes/search.php?depart=" + zipCode.value)
        xmlhttp.send()
    } else {
        departement.style = "display:none!important"
    }
}

zipCode.addEventListener('change', function () {
    showDepartmentList()
})

</script>
</body>



