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
                        <h3 class="card-title">Banner管理 － 編輯圖片</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="/admin/banner/update/{{$list->id}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="form-group row">
                                <label for="sort" class="col-sm-2 control-label">權重</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="sort" name="sort" step="1" min="1" value="{{$list->sort}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">超連結</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="slider_a_href" name="slider_a_href" value="{{$list->slider_a_href}}">
                                </div>
                            </div>


                            <hr>

                            <div class="form-group row">
                                <label for="slider_alt" class="col-sm-2 control-label">圖片替代文字(alt)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="slider_alt" name="slider_alt" value="{{$list->slider_alt}}">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">目前圖片</label>
                                <div class="col-sm-10">
                                    <img width="250px" src="{{$list->slider_url}}" alt="{{$list->slider_alt}}"/>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <label for="upload_file" class="col-sm-2 control-label">上傳圖片</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="upload_file" name="upload_file">
                                </div>
                            </div>

                            <span class="text-danger">＊建議尺寸大小為寬 1080px,高 335px</span>

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