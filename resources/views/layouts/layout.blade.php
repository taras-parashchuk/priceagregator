<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Styles -->

    <style>
        #pleaseWait, #pleaseWait2 {
            visibility: visible;
        }
        #spinner1, #spinner2{
            visibility:hidden;
        }
 </style>
 <script>

    $changes = {{ Session::get('updated') }}
    $total =   {{ Session::get('total') }}
    $refused =  {{ Session::get('refused') }}

 </script>
</head>
<body>
<!-------------------- Navbar --------------------->
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
                    <a class="dropdown-item" href="/vag">VAG</a>

                    <a class="dropdown-item" href="/volvo">VOLVO</a>
                    <a class="dropdown-item" href="/toyota">TOYOTA</a>
                    <a class="dropdown-item" href="/psa">GROUPE PSA</a>
                    <a class="dropdown-item" href="/gm">GENERAL MOTORS</a>
                    <a class="dropdown-item" href="/bmw">BMV</a>
                    <a class="dropdown-item" href="/fiat">FIAT</a>

                    <a class="dropdown-item" href="/daimler">DAIMLER</a>
                    <a class="dropdown-item" href="/hyundai">HYUNDAI</a>
                    <a class="dropdown-item" href="/mazda">MAZDA</a>
                    <a class="dropdown-item" href="/suzuki">SUZUKI</a>

                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Новый прайс
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  data-toggle="modal"  data-target="#FileUpload1" href="#">Загрузить</a>
                    <a class="dropdown-item"  data-toggle="modal" data-target="#ModalUploadDatabase" href="#">Обновить базу</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Редактирование
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ModalRenewRecord">Обновить Запись</a>
                    <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#ModalRenewRecords">Список изменений</a>
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
            <li class="nav-item">
                <a class="nav-link"  data-toggle="modal" data-target="#ModalHelp" href="#">Помощь</a>
            </li>
        </ul>

    </div>
</nav>
<!-------------------- End Navbar --------------------->



            <!------------------------- Modal Help / Помощь ------------------------------>
<div class="modal fade" id="ModalHelp" tabindex="-1" role="dialog" aria-labelledby="ModalHelpLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalHelpLabel">Инструкция</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mx-5" >
                    <div class="row my-2">
                        <div class="col"><h4>Бренд</h4>  Выбор прайса автомобильного бренда с которым желаете работать</div>
                    </div>
                    <div class="row my-2">
                        <div class="col"><h4>Новый прайс</h4>  <b>Загрузить -</b> Загружает первые 10 записей из файла для просмотра структуры файла.<br>
                              <b>Обновить -</b> Выбор полей которые будут загружены и обновлены в базе. И загрузка прайса.
                        </div>

                    </div>
                    <div class="row my-2">
                        <div class="col"><h4>Редактирование</h4>  <b>Обновить запись -</b>  Диалоговое окно в котором можно ввести новое значение для записи хранящейся в базе.<br>
                           <b>Список обновлений -</b> Позволяет загрузить файл и обновить группу записей хранящихся в базе.
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col"><h4>Выгрузка</h4> Выгрузка прайслиста текущего бренда по одному из шаблонов. Возможность редактирования шаблонов.</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>

            </div>
        </div>
    </div>
</div>

 <!---------------------------- Новый прайс -> Загрузить ------------------------------------->

<div class="modal fade" id="FileUpload1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="FileUpload1label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="FileUpload1label">Загрузка прайса для  {{ Session::get('brand') }}</h5>


                <button type="button" class="close" data-dismiss="modal" id="pleaseWait" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('file.upload.post') }}" method="POST" id="uploadpriceform" enctype="multipart/form-data">
                    <div class="form-group">
                        <div>
                            @csrf
                            <input type="file" name="file" id="uploadpricefile">
                        </div>

                    </div>

                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="loadprice" >
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner1"></span>
                        Загрузить
                    </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<!---------------------------------------  Редактирование  ->  Обновить запись   --------------------------------------------------->


<div class="modal fade" id="ModalRenewRecord" tabindex="-1" role="dialog" aria-labelledby="ModalRenewRecord" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalRenewRecordTitle">Обновление записи в базе {{ Session::get('brand') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--    Number	Number2	Weight	VPE	VIN	NL	Title	Teileart -->
                <form method="POST" action="/update">
                    @csrf
                    <div class="row">
                        <div class="col mr-5">
                            <div class="row text-right">
                                <div class="col">
                                    Number:
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control mb-2" id="Number" name="Number" placeholder="Number"  required>
                                    <div class="invalid-feedback">
                                        Пожалуйста введите Number
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    Number2:
                                </div>
                                <div class="col text-right">
                                    <input type="text" class="form-control mb-2" id="Number2" name="Number2" placeholder="Number2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    Weight:
                                </div>
                                <div class="col text-right">
                                    <input type="text" class="form-control mb-2" id="Weight" name="Weight" placeholder="Weight">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    VPE:
                                </div>
                                <div class="col text-right">
                                    <input type="text" class="form-control mb-2" id="VPE" name="VPE" placeholder="VPE">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    VIN:
                                </div>
                                <div class="col text-right">
                                    <input type="text" class="form-control mb-2" id="VIN" name="VIN" placeholder="VIN">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    NL:
                                </div>
                                <div class="col text-right">
                                    <input type="text" class="form-control mb-2" id="NL" name="NL" placeholder="NL">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    Title:
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control mb-2" id="Title" name="Title" placeholder="Title">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    Teileart:
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control mb-2" id="Teileart" name="Teileart" placeholder="Teileart">
                                </div>
                            </div>
                            <div class="row">
                                <p class="col">
                                    <p class="text-muted px-3">Все поля записи с соответствующим номером "Number" заменяются новыми.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="modal-footer">
                           <button type="submit" class="btn btn-primary" id="buttonrenewrecord">
                                   Обновить
                           </button>
                        </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-----------------------------------   Новый прайс -> Обновить базу ---------------------------------------------->

<div class="modal fade" id="ModalUploadDatabase" tabindex="-1" role="dialog" aria-labelledby="ModalUploadDatabase" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalUploadDatabaseLabel">Обновление записи в базе {{ Session::get('brand') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--    Number	Number2	Weight	VPE	VIN	NL	Title	Teileart -->
                <form method="POST" action="/update">
                    @csrf
                    <div class="row">
                        <div class="col mr-5">
                            <div class="row text-right">
                                <div class="col">
                                    Number:
                                </div>
                                <div class="col ">
                                    <input type="text" class="form-control mb-2" id="Number" name="Number" placeholder="Number">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    Number2:
                                </div>
                                <div class="col text-right">
                                    <input type="text" class="form-control mb-2" id="Number2" name="Number2" placeholder="Number2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    Weight:
                                </div>
                                <div class="col text-right">
                                    <input type="text" class="form-control mb-2" id="Weight" name="Weight" placeholder="Weight">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    VPE:
                                </div>
                                <div class="col text-right">
                                    <input type="text" class="form-control mb-2" id="VPE" name="VPE" placeholder="VPE">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    VIN:
                                </div>
                                <div class="col text-right">
                                    <input type="text" class="form-control mb-2" id="VIN" name="VIN" placeholder="VIN">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    NL:
                                </div>
                                <div class="col text-right">
                                    <input type="text" class="form-control mb-2" id="NL" name="NL" placeholder="NL">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    Title:
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control mb-2" id="Title" name="Title" placeholder="Title">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    Teileart:
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control mb-2" id="Teileart" name="Teileart" placeholder="Teileart">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end ">
                        <div class="col-3 mt-5">
                            <button type="submit" class="btn btn-primary">Загрузить</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!------------------------------------------ Редактирование / Список изменений ------------------------------------------->

<div class="modal fade " id="ModalRenewRecords" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalRenewRecords" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalRenewRecordslabel">Загрузить список изменений в базу  {{ Session::get('brand') }}</h5>


                <button type="button" class="close" data-dismiss="modal" id="pleaseWait2" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/updates" method="POST"  id="uploadchangesform" enctype="multipart/form-data">
                    <div class="form-group">
                        <div>
                            @csrf
                            <div class="row mb-3 px-3 text-muted">
                                Загрузка файлов только *.csv формата<br>
                                Расположение столбцов в файле должна соответсвовать столбцам в базе.
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <b>Файл</b>
                                </div>

                                <div class="col">
                                    <p class="text-center">A</p>
                                </div>
                                <div class="col">
                                    <p class="text-center">B</p>
                                </div>
                                <div class="col">
                                    <p class="text-center">C</p>
                                </div>
                                <div class="col">
                                    <p class="text-center">D</p>
                                </div>
                                <div class="col">
                                    <p class="text-center">E</p>
                                </div>
                                <div class="col">
                                    <p class="text-center">F</p>
                                </div>
                                <div class="col">
                                    <p class="text-center">G</p>
                                </div>
                                <div class="col">
                                    <p class="text-center">H</p>
                                </div>
                            </div>
                            <div class="row  mb-4">
                                <div class="col">
                                    <b>База</b>
                                </div>
                                <div class="col">
                                    Number
                                </div>
                                <div class="col">
                                    Number2
                                </div>
                                <div class="col">
                                    Weight
                                </div>
                                <div class="col">
                                    VPE
                                </div>
                                <div class="col">
                                    VIN
                                </div>
                                <div class="col">
                                    NL
                                </div>
                                <div class="col">
                                    Title
                                </div>
                                <div class="col">
                                    Teileart
                                </div>
                            </div>

                            <input type="file" id="fileupdates" name="fileupdates">
                        </div>

                    </div>

                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-primary" id="uploadchanges" >
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner2"></span>
                            Загрузить
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------->

@if ($message = Session::get('usersuploaded'))
    <div class="alert alert-success alert-block">
         <strong>{{ $usersuploaded }}</strong>
    </div>
@endif

<div class="row py-3">
    <div class="col-1 mx-3">
      @if (Session::has('brand'))
            <b>Текущий бренд</b>  <h5><span class="badge badge-success">{{ Session::get('brand')}}</span></h5>
        @elseif (Session::has('brand')=="")
            <b>Бренд не выбран</b>
       @endif

    </div>
    <div class="col-1 mx-1">
        @isset($kol)
            <b>Записей:</b> <p id="recordscount"> {{ $kol ?? '' }}</p>
        @endisset
       </div>
        @if (Session::has('updated'))
        <b>Изменено: </b> <p  id="changedrecords">{{Session::get('updated')}}</p>
        @endif

    <div class="col-10 mx-1">

    </div>

</div>
           <!------------------------------- TABS ---------------------------->
<div class="row">
    <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="input2-tab" data-toggle="tab" href="#input2" role="tab" aria-controls="input2" aria-selected="true">Вход 2</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="input1-tab" data-toggle="tab" href="#input1" role="tab" aria-controls="input1" aria-selected="false">Вход 1</a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="input2" role="tabpanel" aria-labelledby="input2-tab">
                    <!-------------
                   <table class="table table-bordered">
                       <thead>
                       <tr>
                           <th scope="col">Part number</th>
                           <th scope="col">Title</th>
                           <th scope="col">Price</th>
                           <th scope="col">Zalog</th>
                           <th scope="col">RG</th>
                           <th scope="col">Zakup</th>
                       </tr>
                       </thead>
                       <tbody>
                       <tr>
                           <th scope="row">152207246532</th>
                           <td>fraga auto</td>
                           <td>228.65</td>
                           <td>16</td>
                           <td>1</td>
                           <td>192.07</td>
                       </tr>
                       <tr>
                           <th scope="row">69576082790</th>
                           <td>undefined</td>
                           <td>12427530354</td>
                           <td>28.94</td>
                           <td>1</td>
                           <td>28.94</td>
                       </tr>
                       <tr>
                           <th scope="row">52107147991</th>
                           <td>no name </td>
                           <td>386.02</td>
                           <td>16</td>
                           <td>1</td>
                           <td>324.26</td>
                       </tr>
                       </tbody>
                   </table>
                   ------------------>
                    <div class="container">
                        @if(! empty($products)&& count($products)>0)
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Number</th>
                                <th scope="col">Number2</th>
                                <th scope="col">Weight</th>
                                <th scope="col">VPE</th>
                                <th scope="col">VIN</th>
                                <th scope="col">NL</th>
                                <th scope="col">Title</th>
                                <th scope="col">Teileart</th>
                            </tr>
                            </thead>
                            <tbody>



                           @foreach ($products as $product)
           <tr><td>  {{ $product->NUMBER }}</td>
               <td>  {{ $product->NUMBER2 }}</td>
               <td>  {{ $product->WEIGHT }}</td>
               <td>  {{ $product->VPE }}</td>
               <td> {{ $product->VIN }}</td>
               <td> {{ $product->NL }}</td>
               <td>{{ $product->TITLE }}</td>
               <td>{{ $product->TEILEART }}</td></tr>
                           @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $products->links() }}
                    @else
                        <div class="col mt-5" > <h2 class="text-center text-muted">В базе нет записей.</h2></div>
                    @endif




                </div>
               <div class="tab-pane fade" id="input1" role="tabpanel" aria-labelledby="input1-tab">
                   <table class="table table-bordered">
                       <thead>
                       <tr>
                           <th scope="col">A</th>
                           <th scope="col">B</th>
                           <th scope="col">C</th>
                           <th scope="col">D</th>
                           <th scope="col">E</th>
                           <th scope="col">F</th>
                       </tr>
                       </thead>
                       <tbody>
                       <tr>
                           <th scope="row">51457948739</th>
                           <td>KRONENMUTTER</td>
                           <td>53.86</td>
                           <td>16</td>
                           <td>1</td>
                           <td>45.24</td>
                       </tr>
                       <tr>
                           <th scope="row">26789009877665</th>
                           <td>33321135135</td>
                           <td>KREUZSCHLITZSCHRAU</td>
                           <td>146.46</td>
                           <td>1</td>
                           <td>123.03</td>
                       </tr>
                       <tr>
                           <th scope="row">82222162886</th>
                           <td>MONTAGESATZ VISION
                           </td>
                           <td>230.25</td>
                           <td>16</td>
                           <td>1</td>
                           <td>193.41</td>
                       </tr>
                       </tbody>
                   </table>

               </div>

           </div>
  </div>
</div>
<!--------------------- Notification Modal -------------------------->
<div class="modal"  id="notification" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="notification-header">
                <h5 class="modal-title p-5" id="notification-title" >Modal title</h5>
            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------------>
<!--------------------- Notification Toast -------------------------->


<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-left align-items-center"  >
    <div class="toast" style="position: absolute; top: 70px; right: 10px; min-width:300px;height:130px;" data-autohide="true">
        <div class="toast-header">
            <strong class="mr-auto" id="toasttitle">AHTUNG</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
         </div>
        <div class="toast-body" id="toastbody">
            FASCISTEN STRELIERT
        </div>
    </div>
</div>

<!------------------------------------------------------------------->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){

      //  alert($changes); спрацьовує
  //---------   Dialog window price uploading  ----------------//
  //  FileUpload1 -- modal id ; uploadpricefile -- форма выбора файла
        $('#FileUpload1').on('shown.bs.modal', function()
           {

               if ($('#uploadpricefile').get(0).files.length === 0)    //  Поле выбора файла
               {      // если не выбран файл для загрузки, деактивируем кнопку
                   console.log("не выбран файл для загрузки");
                   $("#loadprice").attr("disabled", true);
               } else {
                   // если выбран файл для загрузки, активируем кнопку
                   console.log("выбран файл для загрузки");
                   $("#loadprice").attr("disabled", false);
               }

             $('#FileUpload1').change(function()    //форма изменилась, проверяем файл ли файл
                         {

                             if ($('#uploadpricefile').get(0).files.length === 0)    //  Поле выбора файла
                             {      // если не выбран файл для загрузки, деактивируем кнопку
                                 console.log("не выбран файл для загрузки");
                                 $("#loadprice").attr("disabled", true);
                             } else {
                                 // если выбран файл для загрузки, активируем кнопку
                                 console.log("выбран файл для загрузки");
                                 $("#loadprice").attr("disabled", false);
                             }
                          })
                 })


            $("#loadprice").click(function(){                     // Если нажали кнопку загрузить прайс
                                                          // Деактивируем кнопку, показываем спиннер
            $("#pleaseWait").css("visibility", "hidden"); // hide close sign
            $("#spinner1").css("visibility", "visible");  // show spinner
            setTimeout(function(){
            $("#loadprice").attr("disabled", true);       // button disabled after 1 minute
        }, 1000);
      });
        $("#uploadchanges").click(function(){              // Когда нажали кнопку Редактирование -> список изменений -> загрузить
            $("#pleaseWait2").css("visibility", "hidden"); // hide close sign
            $("#spinner2").css("visibility", "visible");   // show spinner
               setTimeout(function(){
                $("#uploadchanges").attr("disabled", true);       // button disabled after 1 second
            }, 1000);
      });

        $('#ModalRenewRecords').on('shown.bs.modal', function () {    // "редактирование -> список изменений" модальное окно
            let $recordscount = Number($("#recordscount").text());
            if ($recordscount == 0) {                                 // если записей в базе 0 то деактивируем кнопку, показываем сообщение
                $("#uploadchanges").attr("disabled", true);
                $("#fileupdates").attr("disabled",true);
                $('.toast').toast({delay: 5000});
               // $('.toast').toast('show');
                $("#toasttitle").html("Ошибка. ");
                $("#toastbody").html(" Записей не найдено");
                $('.toast').toast('show');
                                     }
            if ($('#fileupdates').get(0).files.length === 0)    //  Поле выбора файла
                    {      // если не выбран файл для загрузки, деактивируем кнопку
                         console.log("не выбран файл для загрузки");
                         $("#uploadchanges").attr("disabled", true);
                    } else {
                // если выбран файл для загрузки, активируем кнопку
                        console.log("выбран файл для загрузки");
                        $("#uploadchanges").attr("disabled", false);
                    }
             $("#uploadchangesform").change(function() {   // Если Форма "редактирование -> список изменений" изменялась
               // alert( "Handler for .change() called." );
                if ($('#fileupdates').get(0).files.length === 0) //  Поле выбора файла
                  {                                   // если не выбран файл для загрузки, активируем кнопку
                      console.log("не выбран файл для загрузки");
                      $("#uploadchanges").attr("disabled", true);
                  } else {                            // если  выбран файл для загрузки, деактивируем кнопку
                    console.log("выбран файл для загрузки");
                    $("#uploadchanges").attr("disabled", false);
                }
            });
        })

        $('#ModalRenewRecord').on('shown.bs.modal', function () {   // Редактирование обновить запись

            let $recordscount = Number($("#recordscount").text());
            if ($recordscount == 0) {                               // Если в базе нет записей, деактивируем кнопку, показываем сообщение
                 console.log("button  renewrecord disabled");
                 $("#buttonrenewrecord").attr("disabled", true);
                 $('.toast').toast({delay: 5000});
                 $('.toast').toast('show');
                 $("#toasttitle").html("Ошибка. ");
                 $("#toastbody").html(" Записей не найдено");
                // $('#notification').modal('show');
                  $('.toast').toast('show');
            }
        })

    });  // End document ready

    // Когда форма "новый прайс -> загрузить прячется", возвращаем стили
   $("#FileUpload1").on('hidden.bs.modal', function(){
        $("#loadprice").attr("disabled", false);
        $("#spinner1").css("visibility", "hidden");
        $("#pleaseWait").css("visibility", "visible");
    });
  //-----------------------------------------------------------//
    // Когда форма "Редактирование -> список изменений" прячется, возвращаем стили
        $("#ModalRenewRecords").on('hidden.bs.modal', function(){
            $("#uploadchanges").attr("disabled", false);
            $("#spinner2").css("visibility", "hidden");
            $("#pleaseWait2").css("visibility", "visible");

      });
    //-----------------------------------------------------------//


    window.addEventListener('load', (event) => {              // При новой загрузке страницы
        //updates made in database notification activate
      //  let $changes = Number($("#changedrecords").text());   // читаем в переменную сколько изменений сделано
     //   alert($changes);
       // alert($errors);


                       $('.toast').toast({delay: 5000});      // показываем всплывающее окно с количеством изменений
                      // $('.toast').toast('show');

                       if ($refused > 0) {
                          $("#toasttitle").html("Не совсем успешно. ");
                           // alert($refused);
                          $("#toastbody").html(" Изменений сделано : " + $changes + "<br>Всего строк: "+ $total + "<p>Ошибок: " + $refused+"</p>");

                                        } else
                                            {
                                   $("#toasttitle").html("Успешно. ");

                                   $("#toastbody").html(" Изменений сделано : " + $changes + "<p>Ошибок: " + $refused+"</p>");
                                            }

                      // $('#notification').modal('show');
                       $('.toast').toast('show');

        });
</script>
</body>
</html>
