<?php
getApiKey();
if(isset($_POST['update-apikey'])){
    updateKey($_POST['inputInsertApi']);
}else if(isset($_POST['register-apikey'])){
    insertKey($_POST['inputInsertApi']);
}
getApiKey();
$getAPI = getApiKey();

?>

<section class="container MaxiBlocks">
    <div class="box">
        <div class="row rowAl">
            <h2 class="titleAl">API</h2>
            <div class="col-6">
                <form action="" method="POST">
                    <label>Récuperer votre clé d'API :
                        <input id="inputAPI" type="text" name="inputInsertApi" value="<?php echo $getAPI ?>" required>
                    </label> 
                        <button type="submit" class="btS btn btn-primary" name="<?php echo !empty(getApiKey())?'update-apikey':'register-apikey'; ?>"><?php echo !empty(getApiKey())?'Modifier votre clé':'Enregistrer votre clé'; ?></button> 
                </form>
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
                <label id="labelDepart" for="">Ville :
                    <form action="" method="POST" >
                        <select name="departement" id="lesdepartements" class="form-control" hidden>
                            <option value="" disabled selected>Choisir un département</option>
                        </select>
                        <button class="btS btn btn-primary" type="submit" name="btDepart">Générer votre shortcode</button>
                    </form>
                </label>
            </div>
        </div>
    </div>
</section>   


<section class="container MaxiBlocks">
    <div class="box">
        <div class="row rowAl">
            <h2 class="titleAl">Shortcode</h2>
            <div class="col-6">
                <label>Récuperer votre shortcode :
                    <input type="text" name="inputShortcode" id="copyMe" value="<?= $dataAladinien = isset($_POST["departement"]) ? (genereCode($_POST["departement"])) : '' ?>">
                </label>
                <button id="clickAl" class="btS btn btn-primary" type="submit" name="btShortcodeSend">Récuperer votre shortcode</button>
            </div>
        </div>
    </div>
</section>


<script>
document.getElementById("clickAl").addEventListener('click', function(e) {
    const copyText = document.querySelector("#copyMe")
    copyText.select()
    copyText.setSelectionRange(0, 99999) // used for mobile phone
    document.execCommand("copy")
})
</script>

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

<?php global $wpdb;var_dump($wpdb)?>
