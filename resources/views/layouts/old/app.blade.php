<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Auto House</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Бренд
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">VAG</a>
                            <a class="dropdown-item" href="#">TOYOTA</a>
                            <a class="dropdown-item" href="#">GROUPE PSA</a>
                            <a class="dropdown-item" href="#">GENERAL MOTORS</a>
                            <a class="dropdown-item" href="#">FORD</a>
                            <a class="dropdown-item" href="#">FIAT</a>
                            <a class="dropdown-item" href="/bmw">BMW</a>
                            <a class="dropdown-item" href="#">DAIMLER</a>
                            <a class="dropdown-item" href="#">HYUNDAI</a>
                            <a class="dropdown-item" href="#">MAZDA</a>
                            <a class="dropdown-item" href="#">SUZUKI</a>
                            <a class="dropdown-item" href="#">VOLVO</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Новый прайс
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Загрузить</a>
                            <a class="dropdown-item" href="#">Обновить базу</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Редактирование
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Обновить Запись</a>
                            <a class="dropdown-item" href="#">Список обновлений</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Выгрузка
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Шаблон 1</a>
                            <a class="dropdown-item" href="#">Шаблон 2</a>
                            <a class="dropdown-item" href="#">Шаблон 3</a>
                        </div>
                    </li>

                </ul>

            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col my-5"></div>
            </div>

            <div class="row align-items-center">
                <div class="col-3">

                </div>

                <div class="col-6 my-5">
                    <h2>Программа обработки прайсов</h2>
                    <p class="lead">Это программа обработки прайсов от разных поставщиков. Чтобы начать обработку прайса перейдите по ссылке с названием бренда.</p>
                    <hr class="my-4">
                    <small>Утилита разработана для использования в торговой организации и не предназначена для массового использования.</small>
                </div>
                <div class="col-3">

                </div>

            </div>

            <div class="row">
                <div class="col my-5"></div>
            </div>


        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>
