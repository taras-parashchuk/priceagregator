
@extends('layouts.layout')

@section('title', 'Log view')

@section('content')
    <div class="row">
        <div class="col px-5">

            @if (count($logs) > 0)
                   <table class="table table-sm table-bordered table-info">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Создано</th>
                            <th scope="col">Номер</th>
                            <th scope="col">Действие</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Сообщение</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($logs as $log)

                        @if ($log->status === "success")
                           <tr class="table-light">
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->created_at }}</td>
                                <td>{{ $log->number }}</td>
                                <td>{{ $log->action }}</td>
                                <td>{{ $log->status }}</td>
                                <td>{{ $log->message }}</td>
                            </tr>
                       @else
                                <tr class="table-danger">
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->created_at }}</td>
                                <td>{{ $log->number }}</td>
                                <td>{{ $log->action }}</td>
                                <td>{{ $log->status }}</td>
                                <td>{{ $log->message }}</td>
                            </tr>
                       @endif
                        @endforeach

                        </tbody>
                    </table>
                {{ $logs->links() }}
                    <div class="row py-3">
                        <div class="col-1">
                            <a class="btn btn-primary" href="/" role="button">Назад</a>
                        </div>
                        <div class="col-10">
                        <div class="col-1">
                            <form method="GET" action="/clearlog">
                                @csrf
                                <button type="submit" class="btn btn-primary" id="ClearLogButton" >
                                    Очистить
                                </button>

                            </form>
                        </div>


                        </div>

                    </div>


            @else
                <h1 class="text-muted">:(  Нет записей</h1>
                <div class="row py-5">
                    <div class="col">
                        <a class="btn btn-primary" href="/" role="button">Назад</a>
                    </div>
                </div>
            @endif


        </div>

    </div>
    @endsection


