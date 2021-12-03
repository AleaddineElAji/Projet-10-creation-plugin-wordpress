<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


<section>

<div class="container">
    <div class="row">
        <div class="col-4">
            <img src="<?= 'http://openweathermap.org/img/wn/'.$test["weather"][0]["icon"].'@2x.png' ?>" class="card-img-top" alt="icons">
            <div><?= ceil($test["main"]["temp"] - 273.53) ." °C" ?></div>
        </div>
        <div class="col-8">
            <div><?= $test["name"] ?></div>
            <div><?= $test["weather"][0]["description"] ?></div>
            <div>température minimum :<?=ceil($test["main"]["temp_min"] - 273.53) ." °C" ?></div>
            <div>température maximum :<?= ceil($test["main"]["temp_max"] - 273.53) ." °C" ?></div>
            <div>pression :<?= $test["main"]["pressure"] ?></div>
            <div>humidité :<?= $test["main"]["humidity"] ?></div>
        </div>
    </div>
</div>

</section>

