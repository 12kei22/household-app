@extends('layouts.layout')

@section('title')
    家計簿
@endsection

@section('content')
    <div class="top-page d-flex flex-column justify-content-center align-items-center ">
        <div class="h1 text-center">
            <h1 class="text-light"><strong>家計簿</strong></h1>
            <h2 class="text-light">🎵気楽にコツコツ家計管理🎵</h2>
        </div>
        <div class="d-flex">
            @auth
                <a href="{{ route('register') }}" class="btn btn-success">支出一覧</a>
            @else
                <a href="{{ route('register') }}" class="btn btn-success">まずは無料で登録</a>
            @endauth
        </div>
    </div>
@endsection
