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
                    <li class="nav-item ">
                        <a class="nav-link" href="Home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Volvo">Volvo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Volkswagen">Volkswagen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="bmw">BMV</a>
                    </li>

                </ul>
            </div>
        </nav>



    </div>

    <div class="container">

        <div class="row">
            <div class="col">
                <h2 class="text-center pt-3">Обработка прайсов BMW</h2>
                <p class="text-center"></p>
            </div>

            <div>

            </div>
        </div>

        <div class="row">
            <div class="col">

            </div>
            <div class="col-6">


                <div class="panel-group">


                    <div class="card">
                        <div class="card-header">
                            Загрузите прайc для BMV
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/profile">
                                @csrf
                                <p class="card-text">Файл должен быть в текстовом формате</p>
                                <div> <input id="file" type="file"></div>
                                <div class="pt-3">
                                    <input class="btn btn-primary " type="submit" value="submit">
                                </div>
                                @error('file')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </form>

                        </div>
                    </div>

                </div>


            </div>
            <div class="col">

            </div>
        </div>

    </div>


</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>

