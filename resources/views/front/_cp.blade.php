@extends('layouts.default')

@section('css')
    <style>
        body{
            background:url("/imgs/pattern.png");
        }
    </style>
@endsection

@section('content')
    <nav class="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">首頁</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$page->name}}</li>
              </ol>
        </div>
    </nav>
    
    <div class="content container" style="margin-top: 30px">
        {!! $page->content !!}
    </div>

@endsection

@section('js')
@endsection