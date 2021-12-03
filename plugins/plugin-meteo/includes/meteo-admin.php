<?php 

require_once  __DIR__ . '/../Models/Data.php'; 
echo '<style>';
require_once  __DIR__ . '../../includes/mon-css.css'; 
echo'</style>';
?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


<?php require_once __DIR__.'../../View/viewAl.php'; ?>


<script>
    //Ajax
    let zipCode = document.getElementById('zipCode')
    let labelDepart = document.getElementById('labelDepart')
    let departement = document.getElementById('lesdepartements')
    let btRadio = document.getElementById('btRadio')

    function showDepartmentList() {
    departement.innerHTML = ""
    if (zipCode.value != "") {
        labelDepart.style = "display:block!important"
        departement.style = "display:block!important"
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
        labelDepart.style = "display:none!important"
        departement.style = "display:none!important"
    }
}

zipCode.addEventListener('change', function () {
    showDepartmentList()
})

</script>

<?php

echo '<pre>';
$dataDecode = isset($_POST["departement"]) ? getDataWeather($_POST["departement"],$getAPI): '';
$dataClean = isset($_POST["departement"]) ? var_dump(getCleanData($dataDecode)): '';
$dataDisplay = isset($_POST["departement"]) ? var_dump(weatherAl($dataClean)): '';

echo '</pre>';


?>
