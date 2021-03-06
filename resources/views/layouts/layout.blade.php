@php
    $letters = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z' ,'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'];
    $prcolnum = 0;
@endphp


<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Styles -->

    <style>
        #pleaseWait, #pleaseWait2,#pleaseWait3 {
            visibility: visible;
        }
        #spinner1, #spinner2,#spinner3{
            visibility:hidden;
        }
        #progressbar {
            visibility:hidden;
        }
 </style>
 <script>
     let letters = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z" ,"AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ"];

    $changes = <?php  if (Session::get('updated'))  { $updated = Session::get('updated'); echo $updated.";";     } else { echo "0;"; }  ?>
    $total   = <?php  if (Session::get('total'))    { $total   = Session::get('total');   echo $total.";";       } else { echo "0;"; }  ?>
    $refused = <?php  if (Session::get('refused'))  { $refused = Session::get('refused'); echo $refused.";";     } else { echo "0;"; }  ?>
    $deleted = <?php  if (Session::get('deleted'))  { $deleted = Session::get('deleted'); echo $deleted.";";     } else { echo "0;"; }  ?>
    $brand   = <?php  if (Session::get('brand'))    { $brand   = Session::get('brand');   echo "'".$brand."';";  } else { echo "0;"; }  ?>
    $added   = <?php  if (Session::get('added'))    { $added   = Session::get('added');   echo "'".$added."';";  } else { echo "0;"; }  ?>
    $message = <?php  if (Session::get('message'))  { $message = Session::get('message'); echo "'".$message."';";} else { echo "0;"; }  ?>

    $KIKO = {{Session::get('prcolnum')}}


    blocked = 0;
   let ticks = 0;
   let posticks = 0;
   let zeroticks = 0;
   let nullticks = 0;
   let checknewprice = 0;
   let currentprice =new Array();


    function drawPriceTable()
        {
            $("#nonewprice").remove();

            html ='<table class="table table-bordered table-sm"><thead><tr>';
            for (i=0; i < currentprice[0].length; i++)
            {
                html = html + "<th scope=\"col\">" + letters[i]+"</th>";
            }
            html = html +"</thead>";

           for (i = 0; i < currentprice.length; i++)
           {
               html = html +  "<tr>";
               for(y = 0; y < currentprice[i].length; y++)
                    {
                        html = html +"<td>" + currentprice[i][y] +"</td>";
                    }
               html = html + "</tr>";
           }
           html = html + "</tbody> </table>";

            $("#jsonresponse").html(html);

            /*
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                </table>
            */
        }

    function getMessage() {

        $.ajax({
            type:'GET',
            url:'/status',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "brand" : $brand
            },
            success:function(data) {
                console.log("Blocked " + data.blocked);
                console.log("Status " + data.status);
                if (data.blocked > 0) {
                    $("#progressbar").css("visibility","visible");
                    $("#polzunok").show();
                    $("#polzunok").attr("style","width:"+ data.blocked +"%");
                    $("#polzuntitle").html(data.status);

                    return data.blocked;
                }
                else         {
                    if(data.blocked == 0) {zeroticks++;}
                    if ((data.blocked > 99)||(zeroticks >20)){
                                clearInterval(polzunchek);
                                $("#progressbar").css("visibility","hidden");
                                zeroticks = 0;
                               }
                    console.log("Not Blocked ");
                    return 0;
                }
            },
            error: function (data) {
                console.log("AJAX error");
            }
        });
    }

    function getSamplePrice() {

        $.ajax({
            type:'GET',
            url:'/newprice',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "brand" : $brand
                  },
            dataType: "json",
            success:function(data) {
               // console.log(data.tableprice);
               // console.log(data.pricearray);

               if (data != 0)
                        {

                            console.log(" RESPONSE RECEIVED ");
                            currentprice = data.pricearray;
                            drawPriceTable();
                            console.log(currentprice);
                            clearInterval(checknewprice);
                            console.log(" INTERVAL CLEARED ");
                  }  else {

                        nullticks++;
                      if (nullticks > 5) {
                       // Clear interval getSamplePrice
                       nullticks = 0;
                       console.log(" response is null for 5 times");
                       console.log(" checknewprice  interval cleared ");
                       clearInterval(checknewprice);
                                         }
                                }
                                   },
            error: function (data) {
                 console.log("AJAX error, ... ");
                //  Проверяем пока не появится
                nullticks++;
                if (nullticks > 5) {
                    // Clear interval getSamplePrice
                    nullticks = 0;
                    console.log(" response is null for 5 times");
                    console.log(" checknewprice  interval cleared ");
                    clearInterval(checknewprice);
                                    }
                                  }
        });
      }



 </script>
</head>
<body>
<!-------------------- Navbar --------------------->
@section('navbar')
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
                    <a class="dropdown-item" href="/bmw">BMV</a>
                    <a class="dropdown-item" href="/volvo">VOLVO</a>
                    <!--  <a class="dropdown-item" href="/toyota">TOYOTA</a>
                      <a class="dropdown-item" href="/psa">GROUPE PSA</a>
                      <a class="dropdown-item" href="/gm">GENERAL MOTORS</a>

                      <a class="dropdown-item" href="/fiat">FIAT</a>

                      <a class="dropdown-item" href="/daimler">DAIMLER</a>
                      <a class="dropdown-item" href="/hyundai">HYUNDAI</a>
                      <a class="dropdown-item" href="/mazda">MAZDA</a>
                      <a class="dropdown-item" href="/suzuki">SUZUKI</a> -->

                  </div>
              </li>
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Новый прайс
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  data-toggle="modal"  data-target="#FileUpload1" href="#">Загрузить</a>
                      <a class="dropdown-item"  data-toggle="modal" data-target="#ModalUpdateDatabase" href="#">Обновить базу</a>
                  </div>
              </li>
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Редактирование
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ModalRenewRecord">Обновить Запись</a>
                      <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#ModalRenewRecords">Список изменений</a>
                      <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#ModalAddRecords">Список дополнений</a>
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
                      <a class="dropdown-item" href="/dwbase">Выгрузить базу</a>
                  </div>
              </li>
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Настройки
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <!-----  data-toggle="modal"  data-target="#LogModal" --->
                    <a class="dropdown-item" href="/log">Просмотр лога</a>
                    <a class="dropdown-item" href="/files">Просмотр файлов</a>
                   </div>
            </li>
            <li class="nav-item">
                <a class="nav-link"  data-toggle="modal" data-target="#ModalHelp" href="#">Помощь</a>
            </li>
        </ul>

    </div>
</nav>
@show
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
                <p>Выберите тип файла</p>
                <form action="/file-upload" method="POST" id="uploadpriceform" enctype="multipart/form-data">
                    @csrf
                    <div class="form-check">
                        <input class="form-check-input" type="radio"  name="ftype" id="csv"  value="CSV" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            CSV
                        </label>
                    </div>
                    <div class="form-check pb-3">
                        <input class="form-check-input" type="radio"  name="ftype" id="txt" value="TXT">
                        <label class="form-check-label" for="flexRadioDefault2">
                            TXT
                        </label>
                    </div>
                    <div class="form-group">
                        <div>

                            <input type="file" name="file" id="uploadpricefile">
                        </div>

                    </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="loadprice" >
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

<!--------------------------------------------- Новый прайс -> обновить базу -------------------------------------------->
<div class="modal fade" id="ModalUpdateDatabase" tabindex="-1" role="dialog" aria-labelledby="ModalUpdateDatabase" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalUpdateDatabaseLabel">Обновление базы {{ Session::get('brand') }} из прайса</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--    Number	Number2	Weight	VPE	VIN	NL	Title	Teileart -->
                <form method="POST" action="/updatenp">
                    @csrf
                    <div class="row pb-5">
                        <div class="col">
                            Выберите столбцы в прайслисте соответствующие полям в базе NUMBER и TITLE.<br>
                            Если поле TITLE в прайсе соответствует полю TITLE в базе, значение не изменяется.<br>

                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <b>Прайс</b>
                        </div>

                        <div class="col">

                            <select class="custom-select" name="NUMBER">
                                <option value="0" selected>A</option>
                                <option value="1">B</option>
                                <option value="2">C</option>
                                <option value="3">D</option>
                                <option value="4">E</option>
                                <option value="5">F</option>
                                <option value="6">G</option>
                                <option value="7">H</option>
                                <option value="8">I</option>
                                <option value="9">J</option>
                                <option value="10">K</option>
                                <option value="11">L</option>
                                <option value="12">M</option>
                                <option value="13">N</option>
                                <option value="14">O</option>
                                <option value="15">P</option>
                                <option value="16">Q</option>
                                <option value="17">R</option>
                                <option value="18">S</option>
                                <option value="19">T</option>
                                <option value="20">U</option>
                                <option value="21">V</option>
                                <option value="22">W</option>
                                <option value="23">X</option>
                                <option value="24">Y</option>
                                <option value="25">Z</option>
                                <option value="26">AA</option>
                                <option value="27">AB</option>
                                <option value="28">AC</option>
                                <option value="29">AD</option>
                                <option value="30">AE</option>
                                <option value="31">AF</option>
                                <option value="32">AG</option>
                                <option value="33">AH</option>
                                <option value="34">AI</option>
                                <option value="35">AJ</option>
                                <option value="36">AK</option>
                                <option value="37">AL</option>
                                <option value="38">AM</option>
                                <option value="39">AN</option>
                                <option value="40">AO</option>
                            </select>
                        </div>
                        <div class="col">
                            <p class="text-muted text-center">x</p>
                        </div>
                        <div class="col">
                            <p class="text-muted text-center">x</p>
                        </div>
                        <div class="col">
                            <p class="text-muted text-center">x</p>
                        </div>
                        <div class="col">
                            <p class="text-muted text-center">x</p>
                        </div>
                        <div class="col">
                            <p class="text-muted text-center">x</p>
                        </div>
                        <div class="col">
                            <select class="custom-select" name="TITLE">
                                <option value="0" selected>A</option>
                                <option value="1">B</option>
                                <option value="2">C</option>
                                <option value="3">D</option>
                                <option value="4">E</option>
                                <option value="5">F</option>
                                <option value="6">G</option>
                                <option value="7">H</option>
                                <option value="8">I</option>
                                <option value="9">J</option>
                                <option value="10">K</option>
                                <option value="11">L</option>
                                <option value="12">M</option>
                                <option value="13">N</option>
                                <option value="14">O</option>
                                <option value="15">P</option>
                                <option value="16">Q</option>
                                <option value="17">R</option>
                                <option value="18">S</option>
                                <option value="19">T</option>
                                <option value="20">U</option>
                                <option value="21">V</option>
                                <option value="22">W</option>
                                <option value="23">X</option>
                                <option value="24">Y</option>
                                <option value="25">Z</option>
                                <option value="26">AA</option>
                                <option value="27">AB</option>
                                <option value="28">AC</option>
                                <option value="29">AD</option>
                                <option value="30">AE</option>
                                <option value="31">AF</option>
                                <option value="32">AG</option>
                                <option value="33">AH</option>
                                <option value="34">AI</option>
                                <option value="35">AJ</option>
                                <option value="36">AK</option>
                                <option value="37">AL</option>
                                <option value="38">AM</option>
                                <option value="39">AN</option>
                                <option value="40">AO</option>
                            </select>
                        </div>
                        <div class="col">
                            <p class="text-muted text-center">x</p>
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
                                Все строки базы с соответствующими номерами будут заменены на значения из файла.<br>
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
<!------------------------------------------ Редактирование / Список дополнений ------------------------------------------->

<div class="modal fade " id="ModalAddRecords" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ModalAddRecords" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalAddRecordslabel">Загрузить список дополнений в базу  {{ Session::get('brand') }}</h5>


                <button type="button" class="close" data-dismiss="modal" id="pleaseWait3" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/additions" method="POST"  id="uploadadditionsform" enctype="multipart/form-data">
                    <div class="form-group">
                        <div>
                            @csrf
                            <div class="row mb-3 px-3 text-muted">
                                Если в базе нет записи с соответствующим номером, она будет добавлена.<br>
                                Существующие записи не обновляются.<br>
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

                            <input type="file" id="fileadditions" name="fileadditions">
                        </div>

                    </div>

                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-primary" id="uploadadditions" >
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner3"></span>
                            Загрузить
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!---------------------------------------------------------------------------------------------------------------------->

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

    <div class="col-9 mx-1">
        <div class="" id="progressbar">
        <div class="font-weight-bold" id="polzuntitle">Обновление</div>
            <p>Дождитесь выполнения задачи</p>
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" id="polzunok" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 1%"></div>
            </div>
        </div>
    </div>

</div>
@section('content')
           <!------------------------------- TABS ---------------------------->
<div class="row">
    <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="input2-tab" data-toggle="tab" href="#input2" role="tab" aria-controls="input2" aria-selected="true">База</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="input1-tab" data-toggle="tab" href="#input1" role="tab" aria-controls="input1" aria-selected="false">Прайс</a>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="input2" role="tabpanel" aria-labelledby="input2-tab">

                    <div class="container">
                        @if(! empty($products)&& count($products)>0)
                        <table class="table table-bordered table-sm table-hover">
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
                <!----------------------------------------------------------------------------------------------------->

               <div class="tab-pane fade" id="input1" role="tabpanel" aria-labelledby="input1-tab">
                    <div class="row">
                        <div class="col">
                   @isset($pricedata)

                       <table class="table table-bordered table-sm">
                           <thead>
                           <tr>
                               @for ($i = 0; $i < count($pricedata[0]); $i++)
                                   <th scope="col">{{ $letters[$i] }}</th>
                               @endfor
                           </tr>
                           </thead>

                           <tbody>
                           @for ($i = 1; $i < $rownum; $i++)
                               <tr>
                                   @for ($y = 0; $y < count($pricedata[0]); $y++)
                                       <td>{{$pricedata[$i][$y] }}</td>
                                   @endfor
                               </tr>
                           @endfor
                           </tbody>
                       </table>
                   @endisset
                    </div>
                    </div>

                   @empty($pricedata)

                       <h1 class="text-muted p-5" id="nonewprice">:) Новый прайс не загружен</h1>
                       <div id="jsonresponse">

                       </div>
                   @endempty
               </div>


              <!--------------------------------------------------------------------------------------------------------->

           </div>
  </div>
</div>
           @show
<!--------------------- Notification Delete input files -------------------------->
<div class="modal" id="delInputFiles" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Удалить входные файлы  {{ Session::get('brand') }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Вы собираетесь удалить входные, загруженные файлы. Для бренда  {{ Session::get('brand') }}</p>

            </div>
            <div class="modal-footer">
                    <form method="POST" action="/delinput">
                    @csrf
                <input type="hidden" name="brand" value="{{ Session::get('brand')}}">
                <button type="submit" id="ddInputFiles" class="btn btn-primary">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--------------------------------------------------------------------------------->
<!--------------------- Notification Delete output files -------------------------->
<div class="modal" id="delOutputFiles" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Удалить выходные файлы  {{ Session::get('brand') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Вы собираетесь удалить выходные, скачанные файлы. Для бренда  {{ Session::get('brand') }}</p>
            </div>
            <div class="modal-footer">
                @csrf
                <form method="POST" action="/deloutput">
                    @csrf
                    <input type="hidden" name="brand" value="{{ Session::get('brand')}}">
                <button type="submit" id="ddOutputFiles" class="btn btn-primary">Удалить
                </form>
            </div>
        </div>
    </div>
</div>
<!----------------------------------------------------------------------------------------->
<!---------------------------- Notification Toast Messages -------------------------------->


<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-left align-items-center"  >
    <div class="toast" style="position: absolute; top: 60px; right: 10px; min-width:300px;height:130px;" data-autohide="true">
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

<!-------------------------------------------------------------------------------------------------->

<!---------------------------------------------------------------------------------------->

<script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){




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


        $("#loadprice").click(function(){             // Если нажали кнопку загрузить прайс
            // Деактивируем кнопку, показываем спиннер
            $("#pleaseWait").css("visibility", "hidden"); // hide close sign
            $("#spinner1").css("visibility", "visible");  // show spinner
            setTimeout(function(){
                $("#loadprice").attr("disabled", true);       // button disabled after 1 sec
            }, 1000);
            setTimeout(function(){
                $("#FileUpload1").modal('hide');
            },1000);
            //Show progress bar
            $("#progressbar").css("visibility","visible");
            $("#polzunok").show();

            //Ajax load file  ****************************************************************

            let formData = new FormData();
            formData.append('file',  $('#uploadpricefile').get(0).files[0]);
            formData.append('ftype', $('input[name=ftype]:checked', '#uploadpriceform').val());


            console.log("");
            //$('input[name=ftype]:checked', '#uploadpriceform').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url: "/file-upload",
                //  headers: {"_token": $('meta[name="csrf-token"]').attr('content')},

                data: formData,
                //data: $("#FileUpload1").serialize(),
               // dataType: "json",
                mimeType: "multipart/form-data",
                cache:false,
                contentType: false,
                processData: false,
                xhr: function(){
                    var xhr = $.ajaxSettings.xhr(); // получаем объект XMLHttpRequest
                    xhr.upload.addEventListener('progress', function(evt){ // добавляем обработчик события progress (onprogress)
                        if(evt.lengthComputable) { // если известно количество байт
                            // высчитываем процент загруженного
                            let percentComplete = Math.ceil(evt.loaded / evt.total * 100);
                            console.log(percentComplete);
                            // устанавливаем значение в атрибут value тега <progress>
                            // и это же значение альтернативным текстом для браузеров, не поддерживающих <progress>
                            //progressBar.val(percentComplete).text('Загружено ' + percentComplete + '%');
                            $("#polzunok").attr("style","width:"+ percentComplete +"%");
                        }
                    }, false);
                    return xhr;
                },
                success: function(xhr){
                    // this.reset();
                    console.log('File has been uploaded successfully');

                    // jsonData = JSON.parse(xhr.responseText);
                    //console.log(xhr.responseType);
                    //  $("#jsonresponse").html(xhr.result);
                    //let returnedData = JSON.parse(xhr.result);
                    //        console.log(xhr.result);
                    $("#progressbar").css("visibility","hidden");
                    $("#polzunok").hide();
                    $("#polzunok").attr("style","width:0%");

                    // Вытаскивает табличку из кеша функцией
                    // Периодически проверяем наличие таблички в Кеше
                    console.log('Checking cache for new sample price');
                    // getSamplePrice

                    checknewprice = setInterval(getSamplePrice, 3000);
                    console.log("Start checking new price");
                    getSamplePrice();
                    //getSamplePrice();
                },
                error: function(request, status, error){
                 //   console.log(xhr.responseText);
                    var statusCode = request.status;
                    alert(statusCode);
                    $("#progressbar").css("visibility","hidden");
                    $("#polzunok").hide();
                    $("#polzunok").attr("style","width:0%");
                }
            });





        });

// ---------------------------    Редактирование -> список изменений -> загрузить ---------------------------------//
        $("#uploadchanges").click(function(){              // Когда нажали кнопку Редактирование -> список изменений -> загрузить
            $("#pleaseWait2").css("visibility", "hidden"); // hide close sign
            $("#spinner2").css("visibility", "visible");   // show spinner
               setTimeout(function(){
                $("#uploadchanges").attr("disabled", true);       // button disabled after 1 second
            }, 1000);
               setTimeout(function(){
                   $("#ModalRenewRecords").modal('hide');
               },3000);
                blocked = 1;
                if(blocked > 0) {
              let  polzuncheck = setInterval(getMessage, 3000);
                    $("#progressbar").css("visibility","visible");
                    $("#polzunok").show();
                                }
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
// ---------------------------    Редактирование -> список добавлений -> загрузить ---------------------------------//
        $("#uploadadditions").click(function(){              // Когда нажали кнопку Редактирование -> список добавлений -> загрузить
            $("#pleaseWait3").css("visibility", "hidden"); // hide close sign
            $("#spinner3").css("visibility", "visible");   // show spinner
            setTimeout(function(){
                $("#uploadadditions").attr("disabled", true);       // button disabled after 1 second
            }, 1000);
            setTimeout(function(){
                $("#ModalAddRecords").modal('hide');
            },3000);
            blocked = 1;
            if(blocked > 0) {
                let  polzuncheck = setInterval(getMessage, 3000);
                $("#progressbar").css("visibility","visible");
                $("#polzunok").show();
            }
        });

        $('#ModalAddRecords').on('shown.bs.modal', function () {    // "редактирование -> список добавлений" модальное окно
            let $recordscount = Number($("#recordscount").text());
            if ($recordscount == 0) {                                 // если записей в базе 0 то деактивируем кнопку, показываем сообщение
           /*     $("#uploadadditions").attr("disabled", true);
                $("#fileadditions").attr("disabled",true);
                $('.toast').toast({delay: 5000});

                $("#toasttitle").html("Ошибка. ");
                $("#toastbody").html(" Записей не найдено");
                $('.toast').toast('show');  */
            }
            if ($('#fileadditions').get(0).files.length === 0)    //  Поле выбора файла
            {      // если не выбран файл для загрузки, деактивируем кнопку
                console.log("не выбран файл для загрузки");
                $("#uploadadditions").attr("disabled", true);
            } else {
                // если выбран файл для загрузки, активируем кнопку
                console.log("выбран файл для загрузки");
                $("#uploadadditions").attr("disabled", false);
            }
            $("#uploadadditionsform").change(function() {   // Если Форма "редактирование -> список добавлений" изменялась
                // alert( "Handler for .change() called." );
                if ($('#fileadditions').get(0).files.length === 0) //  Поле выбора файла
                {                                   // если не выбран файл для загрузки, активируем кнопку
                    console.log("не выбран файл для загрузки");
                    $("#uploadadditions").attr("disabled", true);
                } else {                            // если  выбран файл для загрузки, деактивируем кнопку
                    console.log("выбран файл для загрузки");
                    $("#uploadadditions").attr("disabled", false);
                }
            });
        })

// -----------------------------   Редактирование -> обновить запись   ---------------------------------------------------//
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
 //------------------- Модальное окно удалить входные файлы ------------------------//
       $("#ddInputFiles").on('click',function (){


         //  $('#delInputFiles').modal('hide');


       });
 //------------------- Модальное окно удалить выходные файлы ------------------------//
        $("#ddOutputFiles").on('click',function (){
        //    $('#delOutputFiles').modal('hide');


        });

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




        function getMessage() {
            $.ajax({
                type:'GET',
                url:'/status',
                data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        "brand" : $brand
                      },
                success:function(data) {
                              console.log("Blocked " + data.blocked);
                              console.log("Status " + data.status);
                    if (data.blocked > 0) {
                                            $("#progressbar").css("visibility","visible");
                                            $("#polzunok").show();
                                            $("#polzunok").attr("style","width:"+ data.blocked +"%");
                                            $("#polzuntitle").html(data.status);

                                          }
                             else         {  $("#progressbar").css("visibility","hidden");
                                            console.log("Not Blocked ");
                                           }
                },
                error: function (msg) {
                     console.log("AJAX error");
                }
            });
        }

            getMessage();



       $message = 0;

                       $('.toast').toast({delay: 5000});      // показываем всплывающее окно с количеством изменений

          console.log("Изменений сделано: "+ $changes);
          console.log("Ошибок :" + $refused);
          console.log("Всего строк:" + $total);

       if (($changes > 0) && ($refused == 0) ) {

           $("#toasttitle").html("Успешно. ");
           $("#toastbody").html(" Изменений сделано : " + $changes+"<br>Всего строк :" + $total);
           $message = 1;
                                     }


        if (($total > 0) && ($refused >0)) {
            $("#toasttitle").html("Ошибки !");
            $("#toastbody").html(" Изменений сделано : " + $changes +"<br>Всего строк :" + $total +"<br>Ошибок: "+ $refused);
            $message = 1;
        }

   if ($deleted > 0 ) {

            $("#toasttitle").html("Успешно. ");
            $("#toastbody").html(" Удалено " +  $deleted +" файл(ов) ");
            $message = 1;
        }

   if ($added > 0) {
            $("#toasttitle").html("Успешно. ");
            $("#toastbody").html(" Добавлено " +  $added +" записей");
            $message = 1;
                    }

    if ($message != "") {
            $("#toasttitle").html("Сообщение. ");
            $("#toastbody").html("База данных занята.");
            $message = 1;
        }

        if ($message) { $('.toast').toast('show'); $message = 0; }




    });



    //Check status of the table

//    $("window").on('load',function() {
//              alert("Hello");
//            }
//        );



    // VAg   v CSV


</script>
</body>
</html>
