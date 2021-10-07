@extends('layouts.app')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">信件寄送</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="/micro-course/mail/send">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group row">
                                <label for="filter" class="col-sm-2 control-label">選擇寄送對象</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="filter" name="filter">
                                        <option value="-" hidden>-</option>
                                        <option value="all">全部</option>
                                        <option value="class">班級</option>
                                        <option value="student">學生</option>
                                    </select>
                                </div>
                            </div>

                            <div id="class_id" class="form-group row">
                                <label for="class_id" class="col-sm-2 control-label">選擇班級</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="class_id">
                                        @foreach($classes as $class)
                                            <option value="{{$class->id}}">{{$class->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="account_id" class="form-group row">
                                <label for="account_id" class="col-sm-2 control-label">輸入學號</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="account_id">
                                    <small class="text-danger"></small>
                                </div>
                            </div>

                            <div id="title" class="form-group row">
                                <label for="title" class="col-sm-2 control-label">信件標題</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                            </div>

                            <div id="email_content" class="form-group row">
                                <label for="email_content" class="col-sm-2 control-label">信件內容</label>
                                <div class="col-sm-10">
                                    <textarea class="summernote" name="email_content" cols="30"
                                    rows="4"></textarea>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <div class="col-sm-12 text-center">
                                    <div id="submit_btn" class="btn btn-success">寄出</div>
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="/js/summernote-zh-TW.js"></script>
    <script src="/js/mail.js"></script>
    @if(Session::has('success'))
    <script>
        alert('信件成功寄出!');
    </script>
    @endif
@endsection