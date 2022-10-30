@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 style="text-align: center; letter-spacing: 1em; font-weight: bold;">新着商品</h1>
@stop

@section('content')
    <table class="table">
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>種別</th>
            <th>登録日</th>
            <th>更新日</th>
        </tr>
        <?php //dd($items); ?>  
    @foreach($items as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$type[$item->type]}}</td>
            <td>{{$item->updated_at}}</td>
            <td>{{$item->created_at}}</td>
        </tr>
    @endforeach
    </table>
    <img src="http://127.0.0.1:8000/vendor/adminlte/dist/img/main.jpg" alt="" style="width: 100%; height: auto;">
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

