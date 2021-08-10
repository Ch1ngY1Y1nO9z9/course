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
                        <h3 class="card-title">下載專區管理 － 編輯文章</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="/admin/download/update/{{$list->id}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="form-group row">
                                <label for="article_type" class="col-sm-1 control-label">類別</label>
                                <div class="col-sm-5">
                                    <select id="plan_type" class="form-control" name="plan_type">
                                        <option value="辦公室辦法" @if($list->plan_type == "辦公室辦法") selected @endif>辦公室辦法</option>
                                        <option value="委員會辦法" @if($list->plan_type == "委員會辦法") selected @endif>委員會辦法</option>
                                        <option value="相關表單" @if($list->plan_type == "相關表單") selected @endif>相關表單</option>
                                    </select>
                                </div>
                                <label for="date" class="col-sm-1 control-label">日期</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="date" name="date" data-toggle="datepicker" value="{{$list->date}}">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <label for="title" class="col-sm-1 control-label">文章標題</label>
                                <div class="col-sm-11">
                                    <input type="text" class="form-control" id="title" name="title" value="{{$list->title}}">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <label for="content" class="col-sm-1 control-label">內文</label>
                                <div class="col-sm-11">
                                    <textarea class="summernote" id="main_content" name="main_content">{{$list->content}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="del_files" class="col-sm-1 control-label">刪除檔案</label>
                                <div class="col-sm-11">
                                <div class="row">
                                    @foreach($files as $file)
                                        <div class="col-sm-auto">
                                            <input type="checkbox" name="del_files[]" value="{{$file->id}}">
                                            <a href="{{$file->url}}" download="{{$file->old_filename}}">{{$file->old_filename}}</a>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="upload_files" class="col-sm-1 control-label">上傳檔案</label>
                                <div class="col-sm-11">
                                    <input type="file" class="form-control" id="upload_files" name="upload_files[]" multiple>
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="/js/summernote-zh-TW.js"></script>
    <script src="/js/datepicker.min.js"></script>
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

        $('[data-toggle="datepicker"]').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection