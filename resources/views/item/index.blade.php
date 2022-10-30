@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <form  action="{{ route('item') }}" class="form-inline">
        <h1 text-align: center;>商品一覧</h1>
        @csrf
        <input class="form-control mr-sm-4" type="text" name="keyword" style="margin-left: 2%;" placeholder="キーワード検索" value="@if (isset($keyword)) {{ $keyword }} @endif">
        <button class="btn btn-primary" type="submit">検索</button>
    </form>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                   <h3 class="card-title" style="font-weight: bold;">名前をクリックすると詳細情報が表示されます。</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>種別</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php //dd($items); ?>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><a href="">{{ $item->name }}</a></td>
                                    <td>{{ $type[$item->type] }}</td>
                                    <td><a href="/edit/{{ $item->id }}"> 編集 </a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $items->appends(request()->query())->links('pagination::bootstrap-4') }}
        <img src="http://127.0.0.1:8000/vendor/adminlte/dist/img/main.jpg" alt="" style="width: 100%; height: auto;">
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
