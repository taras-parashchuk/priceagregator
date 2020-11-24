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
    <style>
        #pleaseWait {
            visibility: visible;
        }
        #spinner1{
            visibility:hidden;
        }
    </style>

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
                    <a class="dropdown-item" href="/edit">TOYOTA</a>
                    <a class="dropdown-item" href="/psa">GROUPE PSA</a>
                    <a class="dropdown-item" href="/gm">GENERAL MOTORS</a>
                    <a class="dropdown-item" href="/bmw">BMV</a>
                    <a class="dropdown-item" href="/fiat">FIAT</a>

                    <a class="dropdown-item" href="/daimler">DAIMLER</a>
                    <a class="dropdown-item" href="/hyuidai">HYUNDAI</a>
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
                    <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#ModalRenewRecords">Список обновлений</a>
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
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalHelpLabel">Инструкция</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mx-5" >
                    <div class="row my-2">
                        <div class="col"><span class="badge badge-info">Бренд</span> -> выбор прайса автомобильного бренда с которым желаете работать</div>
                    </div>
                    <div class="row my-2">
                        <div class="col"><span class="badge badge-info">Новый прайс</span> -> <span class="badge badge-info">Загрузить</span> Загружает первые 10 записей из файла для просмотра структуры файла.<br>
                            <span class="badge badge-info">Новый прайс</span> -> <span class="badge badge-info">Обновить</span> Выбор полей которые будут загружены и обновлены в базе. И загрузка прайса.
                        </div>

                    </div>
                    <div class="row my-2">
                        <div class="col"><span class="badge badge-info">Редактирование</span> -> <span class="badge badge-info">Обновить запись</span>  Диалоговое окно в котором можно ввести новое значение для записи хранящейся в базе.<br>
                            <span class="badge badge-info">Редактирование</span> -> <span class="badge badge-info">Список обновлений</span> Позволяет загрузить файл и обновить группу записей хранящихся в базе.
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col"><span class="badge badge-info">Выгрузка</span> Выгрузка прайслиста текущего бренда по одному из шаблонов. Возможность редактирования шаблонов.</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>

            </div>
        </div>
    </div>
</div>

 <!---------------------------- Modal Load Price / Загрузить прайс------------------------------------->

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
                <form action="{{ route('file.upload.post') }}" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <div>
                            @csrf
                            <input type="file" name="file">
                        </div>

                    </div>


                    <button type="submit" class="btn btn-primary" id="loadprice" type="submit">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner1"></span>
                        Understood
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>


 <!-----------------------------------   Modal Upload to database / Обновить базу ---------------------------------------------->

<div class="modal fade" id="ModalUploadDatabase" tabindex="-1" role="dialog" aria-labelledby="ModalUploadDatabase" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLoadFile2">Обновление базы</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary">Загрузить</button>
            </div>
        </div>
    </div>
</div>

<!---------------------------------------  Renew Record / Обновить запись в базе   --------------------------------------------------->

<div class="modal fade" id="ModalRenewRecord" tabindex="-1" role="dialog" aria-labelledby="ModalRenewRecord" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalRenewRecord">Обновление записи в базе</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary">Загрузить</button>
            </div>
        </div>
    </div>
</div>

<!------------------------------------------ Renew Records / Загрузить список изменений ------------------------------------------->
<div class="modal fade" id="ModalRenewRecords" tabindex="-1" role="dialog" aria-labelledby="ModalRenewRecords" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalRenewRecords">Загрузить список изменений в базу</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary">Загрузить</button>
            </div>
        </div>
    </div>
</div>

@if ($message = Session::get('usersuploaded'))
    <div class="alert alert-success alert-block">
         <strong>{{ $usersuploaded }}</strong>
    </div>
@endif

<div class="row py-3">
    <div class="col-1 mx-3">


        @if (Session::has('brand'))
            Текущий бренд:  <h4><span class="badge badge-success">{{ Session::get('brand')}}</span></h4>
        @elseif (Session::has('brand')=="")
             Бренд не выбран

        @endif

    </div>
    <div class="col-1 mx-1">
        @isset($kol)
           Записей:  {{ $kol ?? '' }}
        @endisset
       </div>
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
                        @if(! empty($products))
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



                           @foreach ($products as $product)
                               <tr><td>  {{ $product->kod }}</td><td>  {{ $product->price }}</td><td>  {{ $product->zalog }}</td> <td>  {{ $product->rg }}</td>  <td> {{ $product->kod }}<td></td></tr>
                           @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $products->links() }}
                    @else
                        I do not have any products
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

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
    $("#loadprice").click(function(){

            $("#pleaseWait").css("visibility", "hidden");
            $("#spinner1").css("visibility", "visible");
         /*   $("#loadprice").attr("disabled", true); */
        setTimeout(function(){
            $("#loadprice").attr("disabled", true);
        }, 2000);
    });
    })
   $("#FileUpload1").on('hidden.bs.modal', function(){
        $("#loadprice").attr("disabled", false);
        $("#spinner1").css("visibility", "hidden");
        $("#pleaseWait").css("visibility", "visible");
    });

</script>
</body>
</html>
