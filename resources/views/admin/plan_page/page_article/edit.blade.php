@extends('layouts.app')
@section('css')
    <link href="/css/summernote.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link  href="/css/datepicker.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">宣傳品管理 － 編輯文章</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="/admin/plan_article/update/{{$list->id}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group">
                                <label for="title" class="col-xs-1 control-label">文章標題</label>
                                <div class="col-xs-11">
                                    <input type="text" class="form-control" id="title" name="title" value="{{$list->title}}">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label for="del_files" class="col-xs-1 control-label">刪除檔案</label>
                                <div class="clearfix"></div>
                                <div class="col-xs-1"></div>
                                <div class="col-xs-11">
                                    @foreach($list->download_files as $file)
                                        <div class="col-xs-3">
                                            <input type="checkbox" name="del_files[]" value="{{$file->id}}">
                                            <a href="{{$file->url}}" download="{{$file->old_filename}}">{{$file->old_filename}}</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="upload_files" class="col-xs-1 control-label">上傳檔案</label>
                                <div class="col-xs-11">
                                    <input type="file" class="form-control" id="upload_files" name="upload_files[]" multiple>
                                </div>
                            </div>
                            <hr>

                            <div class="form-group">
                                <div class="col-xs-12 text-center">
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
    <script src="/js/summernote.min.js"></script>
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