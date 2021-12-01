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


    .box input{
        width: 100%;
        margin: 2.5vh 0 !important;
        border: 1px solid black !important;
        border-radius: 5px !important;
        padding: 0 !important;
        padding-left: 0.75rem !important;
    }

    #btRadio input{
        width: 25px !important;
        height: 25px !important;
        margin: 2.5vh 0 !important;
        border: 1px solid black !important;
        border-radius: 5px !important;
        padding: 0 !important;
        padding-left: 0.75rem !important;  
    }

    #btRadio{
        justify-content: center;
        display: none;
    }


    input[type=checkbox]:before {
        display: none !important;
    }

    input[type=checkbox]:after {
        left: 8px !important;
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

    .checkboxAl{
        width: fit-content;
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

    .wp-core-ui select {
        max-width: 100% !important;
    }
</style>

<body>
<?php
    function affichageKey(){
        global $wpdb;
        $query = 'SELECT option_value FROM alacs_options WHERE option_name = "APIKey"';
        $result = $wpdb->get_var($query);
        echo $result;
    }

    function updateKey($param){
        global $wpdb;
        $query = 'UPDATE alacs_options SET option_value='.$param.' WHERE option_name = "APIKey";';
        $wpdb->get_var($query);
    }
?>

<section class="container MaxiBlocks">
    <div class="box">
        <div class="row rowAl">
            <h2 class="titleAl">API</h2>
            <div class="col-6">
                <label>Récuperer votre clef d'API :
                    <input id="inputAPI" type="text" name="inputAPI" value='<?php affichageKey();?>'>
                </label>
                <button id="btAPI" class="btMeteo" name="btAPISend" class="js-copy" data-target="#tocopy">recuperer votre clef d'API</button>
            </div>
        </div>
    </div>
</section>

<section class="container MaxiBlocks">
    <div class="box">
        <div class="row rowAl">
            <h2 class="titleAl">Lieu de la recherche</h2>
            <div class="col-6">
                <label>Département :
                    <input type="text" name="depart" id="zipCode">
                </label>
                <label for="">Ville :
                    <select name="departement" id="lesdepartements" class="form-control" hidden>
                        <option value="" disabled selected>Choisir un département</option>
                    </select>
                </label>
                <div id="btRadio" class="row">
                    <div class="checkboxAl">
                        <input type="checkbox" id="radioTemp" name="radioTemp" value="temperature"checked>
                        <label for="radioTemp">temperature</label>
                    </div>
                    <div class="checkboxAl">
                        <input type="checkbox" id="radioPrec" name="radioPrec" value="precipitations">
                        <label for="radioTemp">précipitations</label>
                    </div>
                    <div class="checkboxAl">
                        <input type="checkbox" id="radioNuag" name="radioNuag" value="nuages">
                        <label for="radioTemp">nuages</label>
                    </div>
                    <div class="checkboxAl">
                        <input type="checkbox" id="radioPress" name="radioPress" value="pression">
                        <label for="radioTemp">pression</label>
                    </div>
                    <div class="checkboxAl">
                        <input type="checkbox" id="radioVent" name="radioVent" value="vent">
                        <label for="radioTemp">vent</label>
                    </div>
                </div>
                <button class="btMeteo" type="submit" name="btMeteoSend">chercher</button>
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
                    <button class="btMeteo" type="submit" name="btShortcodeSend">Récuperer votre shortcode</button>
                </form>                
            </div>
        </div>
    </div>
</section>

<!-- <main class="flex flex-col h-screen justify-center items-center bg-gray-100">
  <div class="bg-white max-w-sm p-5 rounded shadow-md mb-3">
    <input
      class="border-blue-500 border-solid border rounded py-2 px-4"
      type="text"
      placeholder="Enter some text"
      id="copyMe"
    />
    <button
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded"
      onclick="copyMeOnClipboard()"
    >
      Copy
    </button>
  </div>
  <p class="text-green-700"></p>
</main> -->


<script>
    //Ajax
    let zipCode = document.getElementById('zipCode')
    let departement = document.getElementById('lesdepartements')
    let btRadio = document.getElementById('btRadio')

    function showDepartmentList() {
    departement.innerHTML = ""
    if (zipCode.value != "") {
        departement.style = "display:block!important"
        btRadio.style = "display:flex!important"
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var departements = JSON.parse(this.response)
                console.log(departements)
                document.getElementById("lesdepartements").innerHTML += '<option value="">Selecionnez une commune</option>'
                for (let i = 0; i < departements.length; i++) {
                    document.getElementById("lesdepartements").innerHTML += '<option value="' + departements[i].nom + '">' + departements[i].nom + '</option>'
                }
            }
        }
        xmlhttp.open("GET", "../wp-content/plugins/plugin-meteo/includes/search.php?depart=" + zipCode.value)
        xmlhttp.send()
    } else {
        departement.style = "display:none!important"
        btRadio.style = "display:none!important"
    }
}

zipCode.addEventListener('change', function () {
    showDepartmentList()
})


// const copyText = document.querySelector("#copyMe")
// const showText = document.querySelector("p")

// const copyMeOnClipboard = () => {
//   copyText.select()
//   copyText.setSelectionRange(0, 99999) // used for mobile phone
//   document.execCommand("copy")
//   showText.innerHTML = `${copyText.value} is copied`
//   setTimeout(() => {
//     showText.innerHTML = ""
//   }, 1000)
// }


</script>




</body>



