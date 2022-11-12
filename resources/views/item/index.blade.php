@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <form  action="{{ route('item') }}" class="form-inline">
        <h1 text-align: center;>商品一覧 / 検索</h1>
        @csrf
        <select name="select" id="type" class="form-control mr-sm-4" style="margin-left: 2%;">
            <option value="">指定なし</option>
            <option value="1">野菜</option>
            <option value="2">肉類</option>
            <option value="3">魚類</option>
            <option value="4">調味料</option>
            <option value="5">インスタント</option>
            <option value="6">菓子類</option>
            <option value="7">冷凍食品</option>
            <option value="8">飲料水</option>
        </select>
        <input class="form-control mr-sm-4" type="text" name="keyword" placeholder="キーワード検索" value="@if (isset($keyword)) {{ $keyword }} @endif">
        <button class="btn btn-primary" type="submit">検索</button>
    </form>
@stop

@section('content')
   
    <!-- モーダル本体 -->
    <div class="modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="staticBackdropLabel">商品詳細</h5>
                </div>
                <div class="modal-body" style="font-size: 25px;">
                    <p class="text-center" style="font-weight: bolder;">ID:<span class="item-id" style="font-weight: normal; margin-left: 5px"></span></p>
                    <p class="text-center" style="font-weight: bolder;">名前:<span class="item-name" style="font-weight: normal; margin-left: 5px"></span></p>
                    <p class="text-center" style="font-weight: bolder;">種別:<span class="item-type" style="font-weight: normal; margin-left: 5px"></span></p>
                    <p class="text-center" style="font-weight: bolder;">詳細</p>
                    <p class="text-center"><span class="item-detail"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close" data-bs-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>

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
                                <th>更新日</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php //dd($items); ?>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><button type="button" class="btn modal-button" data-itemid="{{ $item->id }}" data-itemdetail="{{ $item->detail }}" data-itemtype="{{ $type[$item->type] }}" data-itemname="{{ $item->name }}" data-bs-toggle="modal" data-bs-target="#staticBackdrop">{{ $item->name }}</button></td>
                                    <td>{{ $type[$item->type] }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td><a href="/edit/{{ $item->id }}"> 編集 </a></td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        {{ $items->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
@stop
@section('css')
@stop

@section('js')
@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    jQuery(function($) { 
        $('.modal-button').on('click', function(){
            let itemName = $(this).data('itemname');
            let itemType = $(this).data('itemtype');
            let itemDetail = $(this).data('itemdetail');
            let itemId = $(this).data('itemid');
            $('.item-name').html(itemName);
            $('.item-type').html(itemType);
            $('.item-detail').html(itemDetail);
            $('.item-id').html(itemId);
            $('.modal').fadeIn();
        });
        $('.btn-close').on('click', function(){
            $('.modal').fadeOut();
        });
    });
</script>