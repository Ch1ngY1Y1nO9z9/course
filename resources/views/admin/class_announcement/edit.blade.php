@extends('layouts.app')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">課程公告 - 編輯</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="/admin/class_announcement/update/{{$item->id}}">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group row">
                                <label for="type" class="col-sm-2 control-label">公告類別</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="type" name="type">
                                        <option @if($item->type == '系列公告') selected @endif>系統公告</option>
                                        <option @if($item->type == '調課公告') selected @endif>調課公告</option>
                                        <option @if($item->type == '業務公告') selected @endif>業務公告</option>
                                        <option @if($item->type == '招生公告') selected @endif>招生公告</option>
                                        <option @if($item->type == '活動公告') selected @endif>活動公告</option>
                                      </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-2 control-label">標題</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title" value="{{$item->title}}" required>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="content" class="col-sm-2 control-label">內文</label>
                                <div class="col-sm-10">
                                    <textarea class="summernote" id="content" name="content" required>
                                        {!! $item->content !!}
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="location" class="col-sm-2 control-label">地點</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="location" name="location" value="{{$item->location}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="start_date" class="col-sm-2 control-label">開始日期</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{$item->start_date}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="end_date" class="col-sm-2 control-label">結束日期</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{$item->end_date}}" required>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-success">更新</button>
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
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            $('.summernote').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['fontsize', ['fontsize']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']]
                ],
                height: 400,
                lang: 'zh-TW',
                fontNames: [
                    'sourcehansans-tc','Microsoft JhengHei', 'Heiti TC', 'LiHei Pro', 'Gotham', 'Helvetica Neue', 'Helvetica', 'Arial', 'sans-serif'
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        url = $(this).data('upload'); //path is defined as data attribute for  textarea
                        for(var i = files.length - 1; i >= 0; i--) {
                            sendFile(files[i], this);
                        }
                    }
                }
            });

            function sendFile(file, editor, welEditable) {
                data = new FormData();
                data.append("file", file);
                $.ajax({
                    data: data,
                    type: "POST",
                    url: "/admin/img/post",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(url) {
                        $('.summernote').summernote('editor.insertImage', url, function ($image) {
                            $image.css('max-width', '100%');
                        });
                    }
                });
            }
        });
    </script>
@endsection