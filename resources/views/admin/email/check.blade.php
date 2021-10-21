@extends('layouts.app')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link  href="/css/datepicker.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">

                        <h3 class="card-title">寄件備份 - {{$item->title}}</h3>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-success" href="javascript:history.back()">返回</a>
                        <hr>
                            <div class="form-group row">
                                <label for="content" class="col-sm-1 control-label">內文</label>
                                <div class="col-sm-11">
                                    <textarea readonly class="summernote" id="main_content" name="main_content">{{$item->content}}</textarea>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="/js/summernote-zh-TW.js"></script>
    <script src="/js/datepicker.min.js"></script>
    <script>
        $(function() {
            $('.summernote').summernote('disable');
        });
    </script>
@endsection