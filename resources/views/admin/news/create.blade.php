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
                        <h3 class="card-title">最新消息管理 － 新增文章</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="/admin/news/store">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="form-group row">
                                <label for="plan_type" class="col-sm-2 control-label">企劃別</label>
                                <div class="col-sm-10">
                                    <select id="plan_type" class="form-control" name="plan_type">
                                        <option value="課程公告">課程公告</option>
                                        <option value="校內活動">校內活動</option>
                                        <option value="場域活動">場域活動</option>
                                        <option value="其他公告">其他公告</option>
                                        <option value="資訊轉知">資訊轉知</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date" class="col-sm-2 control-label">日期</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="date" name="date" data-toggle="datepicker">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <label for="title" class="col-sm-2 control-label">文章標題</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="content" class="col-sm-2 control-label">內文</label>
                                <div class="col-sm-10">
                                    <textarea class="summernote" id="main_content" name="main_content"></textarea>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-success">新增</button>
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