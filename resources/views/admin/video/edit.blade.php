@extends('layouts.app')
@section('css')
    <link  href="/css/datepicker.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">媒體頻道管理 － 編輯文章</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="/micro-course/video/update/{{$list->id}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group row">
                                <label for="plan_type" class="col-sm-2 control-label">類別</label>
                                <div class="col-sm-10">
                                    <select id="plan_type" class="form-control" name="plan_type">
                                    <option value="課程公告" @if($list->plan_type == "課程公告") selected @endif>課程公告</option>
                                        <option value="校內活動" @if($list->plan_type == "校內活動") selected @endif>校內活動</option>
                                        <option value="場域活動" @if($list->plan_type == "場域活動") selected @endif>場域活動</option>
                                        <option value="其他公告" @if($list->plan_type == "其他公告") selected @endif>其他公告</option>
                                        <option value="資訊轉知" @if($list->plan_type == "資訊轉知") selected @endif>資訊轉知</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date" class="col-sm-2 control-label">日期</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="date" name="date" data-toggle="datepicker" value="{{$list->date}}" required>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <label for="title" class="col-sm-2 control-label">文章標題</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title" value="{{$list->title}}">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <label for="upload_files" class="col-sm-2 control-label">現有圖片</label>
                                <div class="col-sm-4">
                                    @foreach($files as $file)
                                        <img src="{{$file->url}}" alt="" class="img-fluid">
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="upload_files" class="col-sm-2 control-label">重新上傳背景圖片</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="upload_files" name="upload_files">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-sm-2 control-label">Youtube網址</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="main_content" name="main_content" value="{{$list->content}}" >
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-success">送出</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/js/datepicker.min.js"></script>
    <script>
        $('[data-toggle="datepicker"]').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection