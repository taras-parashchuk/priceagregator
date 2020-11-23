<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Styles -->

</head>
<body>
<div class="flex-top position-ref full-height">



    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <p class="navbar-brand" href="#">Price Agregator</p>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="Home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Volvo">Volvo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Volkswagen">Volkswagen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bmw">BMV</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  active" href="Another">Another</a>
                    </li>
                </ul>
            </div>
        </nav>



    </div>
    <div class="jumbotron">
        <h2 class="display-4">Прайс v1.0</h2>
        <p class="lead">Это программа обработки прайсов от разных поставщиков. Чтобы начать обработку прайса перейдите по ссылке с названием бренда.</p>
        <hr class="my-4">
        <p>Утилита разработана для использования в торговой организации и не предназначена для массового использования.</p>
        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>

