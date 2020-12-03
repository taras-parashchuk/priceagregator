@extends('layouts.layout')

@section('title', 'Files view')

@section('content')
    <div class="row">
        <div class="col px-5">

            @if (count($files) > 0)
                <table class="table  table-bordered">
                    <thead>
                    <tr class="table-info">
                        <th scope="col">id</th>
                        <th scope="col">Создано</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Действие</th>
                        <th scope="col">Размер (байт)</th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach ($files as $file)

                             <tr class="table-default">
                                <td>{{ $file->id }}</td>
                                <td>{{ $file->created_at }}</td>
                        <td><a href="{{$links[$loop->index]}}">{{ $file->originalname }}</a></td>
                                <td>{{ $file->mission }}</td>
                                <td>{{ $file->fsize}}</td>
                            </tr>

                    @endforeach

                    </tbody>
                </table>

                <div class="row py-3">
                    <div class="col-1">
                        <a class="btn btn-primary" href="/" role="button">Назад</a>
                    </div>

                        <div class="col-2">
                            <form method="POST" action="/delinput">
                                @csrf
                                <input type="hidden" name="brand" value="{{Session::get('brand')}}">
                                <button type="submit" class="btn btn-primary" id="ClearLogButton" >
                                    Удалить файлы
                                </button>
                            </form>
                        </div>

                       <div class="col-11">

                       </div>

                </div>

            @else
                <h1 class="text-muted">:(  Нет файлов</h1>
                <div class="row py-5">
                    <div class="col">
                        <a class="btn btn-outline-primary btn-sm" href="/" role="button">Назад</a>
                    </div>
                </div>
            @endif


        </div>

    </div>
@endsection

