@extends('layouts.app')
@section('css')
    <link href="/css/summernote.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">課程公告 - 檢視</h3>
                    </div>
                    <div class="card-body">
                        <a href="javascript:history.back()">
                            <button type="submit" class="btn btn-success">返回</button>
                        </a>
                        <hr>
                        <div class="form-group row">
                            <label for="slider_a_href" class="col-sm-2 control-label">類別</label>
                            <div class="col-sm-10">
                                招生公告
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="slider_a_href" class="col-sm-2 control-label">標題</label>
                            <div class="col-sm-10">
                                110學年度私立醫學校院聯合招考轉學生招生簡章公告
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="slider_a_href" class="col-sm-2 control-label">內文</label>
                            <div class="col-sm-10">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="slider_a_href" class="col-sm-2 control-label">地點</label>
                            <div class="col-sm-10">
                                行政大樓
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="slider_a_href" class="col-sm-2 control-label">開始日期</label>
                            <div class="col-sm-10">
                                2021-04-28
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="slider_a_href" class="col-sm-2 control-label">結束日期</label>
                            <div class="col-sm-10">
                                2021-05-29
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="slider_a_href" class="col-sm-2 control-label">更新日期</label>
                            <div class="col-sm-10">
                                2021-04-29
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/js/summernote.min.js"></script>
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