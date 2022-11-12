@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品編集画面</h1>
@stop

@section('content')
<div class="container">
            <form action="{{ route('itemEdit') }}" method="POST">
                @csrf
                <input type="text" name="id" value="{{ $items->id }}" class="form-control" hidden>
                <p>名前<input type="text" name="name" value="{{ $items->name }}" class="form-control"></p>
                <P>種別
                    <select name="type" class="form-control">
                        <option>野菜</option>
                        <option>肉類</option>
                        <option>魚類</option>
                        <option>調味料</option>
                        <option>インスタント</option>
                        <option>菓子類</option>
                        <option>冷凍食品</option>
                        <option>飲料水</option>
                        <option selected hidden>{{ $type[$items->type] }}</option>
                    </select>
                </P>
                <p>詳細<textarea type="text" class="form-control" name="detail" value="{{ $items->detail }}">{{ $items->detail }}</textarea></p>
                <!-- <P>ステータス
                    <select class="form-control" name="status" value="{{ $items->status }}">
                        <option value="active" @if($items->status)selected @endif>表示</option>
                        <option value="nonactive" @if(!$items->status)selected @endif>非表示</option>
                    </select>
                    </P> -->
                <!-- 編集ボタン -->
                <button type="submit" class="btn btn-primary" class="form-control">編集</button>
            </form>
            <form action="{{ route('itemDelete') }}" method="post">
                @csrf
                <input type="text" name="id" value="{{ $items->id }}" class="form-control" hidden>
                <!-- 削除ボタン -->
                <button type="submit" class="btn btn-danger" class="form-control" style="margin-top: 15px;">削除</button>
            </form>
        </div>
@stop

@section('css')
@stop

@section('js')
@stop