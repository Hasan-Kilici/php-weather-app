<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
 
  <title>Weather App</title>
</head>
<body>
  <?php
   $city = urlencode($_GET['city']);
        $city_data = array();
        $api_key = 'your api key';
        $weather = "";
        $error = "";
        $weatherStatu = "";

    if ($_GET['city']) {
         
     $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=".$api_key); 
        $weatherArray = json_decode($urlContents, true);  
        if ($weatherArray['cod'] == 200) {
            $weather = $_GET['city']." şehrinde";
            $tempInCelcius = intval($weatherArray['main']['temp'] - 273);
            $weather .= " Hava ".$tempInCelcius."&deg;C derece"; 
        } else {
            $error = "Şehir bulunamadı - Tekrar deneyin"; 
        }    
    }
    ?>
  <div class="container"> 
  <h1>Hava nasıl?</h1>
  <div class="card">
  <form>
    <div class="card-body" style="padding:8px;">
  <fieldset class="form-group">
    <label for="city">Şehir</label>
    <input type="text" class="form-control" name="city" id="city" placeholder="örnek : Konya" value = "<?php echo $_GET['city']; ?>">
  </fieldset>
   
  <button type="submit" class="btn btn-primary">Gönder</button>
    </div>
</form>
  </div>

   <div id="weather"><?php
      if ($weather) {
        echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
      } else if ($error) {
         echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
      }
    ?>
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"></script>
</body>
</html>
