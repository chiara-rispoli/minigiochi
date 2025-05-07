<?php

$city = '';
$weather = '';
$error = '';

if (!empty($_GET['city'])) {

    $city = str_replace(' ', '', trim($_GET['city']));

    $url = 'https://www.weather-forecast.com/locations/' . $city . '/forecasts/latest';

    $content = @file_get_contents($url);


    if ($content) {
        $ini = strpos($content, '3 days');
        $end = strpos($content, '</span>', $ini);
        $weather = strip_tags(substr($content, $ini + 7, $end - $ini));

    } else {
        $error = 'no data found';
    }


}


?>

<!DOCTYPE html>
<html lang="it-IT">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meteo</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <style type="text/css">
        
        h1 {
            color: white;
        }

        body {
            background: url(bg.jpg) no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            width: 500px;
            margin: auto;
            border: 0px solid white;
            text-align: center;
            margin-top: 15%;
        }

    </style>

</head>

<body>
    <div class="container">

        <h1>What's the weather?</h1>

        <form action="meteo.php">

            <div class="form-group">

                <label for="city">Enter the name of the city:</label>

                <input class="form-control" placeholder="Es. Milano" value="<?= $city ?>" name="city" id="city"
                    required>

            </div>

            <div class="form-group">

                <button class="btn btn-primary">Submit</button>

            </div>

            <?php

            $class = $weather ? 'success' : 'danger'

                ?>

            <div class="alert alert-<?= $class ?>">

                <?= $weather ? $weather : $error ?>


            </div>

        </form>

    </div>



</body>

</html>