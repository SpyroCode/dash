<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DashBoard Credicor Mexicano</title>
    <!--<link rel="stylesheet" type="text/css" href="css/bootstrap.css"> dark-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?=base_url?>css/styles.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="<?=base_url?>js/jquery.js"></script>
    <script src="<?=base_url?>js/jquery.knob.js"></script>
    <!--<script src="js/theme/dark-unika.js"></script>-->
    <script>
        $(document).ready(function () {
            //$(".dial").knob();
            $('.cr').knob({
                'min': 0,
                'max': 100,
                'width': 100,
                'height': 100,
                'displayInput': true,
                'fgColor': "#BA4A00",
                'release': function (v) { $("p").text(v); },
                'readOnly': true
            });
            $('.ap').knob({
                'min': 0,
                'max': 100,
                'width': 100,
                'height': 100,
                'displayInput': true,
                'fgColor': "#2980B9",
                'release': function (v) { $("p").text(v); },
                'readOnly': true
            });
            $('.vp').knob({
                'min': 0,
                'max': 100,
                'width': 100,
                'height': 100,
                'displayInput': true,
                'fgColor': "#2ECC71",
                'release': function (v) { $("p").text(v); },
                'readOnly': true
            });
        });
    </script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="<?=base_url?>">Credicor</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
                aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor02">

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?=base_url?>">Inicio <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url?>colocacion/index">Colocacion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cartera</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Menu1</a>
                    </li>
                </ul>

            </div>
        </nav>


    </header>

    <div class="container-fluid">