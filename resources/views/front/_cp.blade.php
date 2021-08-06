@extends('layouts.default')

@section('css')
@endsection

@section('content')
    <div class="content container-fluid" style="margin-top: 30px">
        {!! $page->content !!}
    </div>

@endsection

@section('js')
@endsection