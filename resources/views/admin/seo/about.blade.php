@extends('layouts.app') 
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .card {
        margin-bottom: 30px;
    }
    .badge {
        font-size: 16px;
        padding: 0.5rem 1.8rem;
        margin-bottom: 8px;
    }
    .badge1 {
        background-color: #35e4d7;
    }
    .badge2 {
        background-color: #ffbd59;
    }
    .badge3 {
        background-color: #97b3e4;
    }
</style>
@endsection @section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-10 offset-sm-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">關於我們</h3>
                </div>
                <div class="card-body">
                    <form action="/micro-course-course/seo/update/about" method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                        <div class="col-sm-12">
                            <label for="keyword">內容</label>
                            <textarea class="form-control" name="description" cols="30"
                                rows="4">{{ $about["description"] }}</textarea>
                        </div>
                        <div class="center-block text-center">
                            <button style="margin-top: 15px" class="btn btn-primary">
                                更新此項目
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">USR理念</h3>
                </div>
                <div class="card-body">
                    <form action="/micro-course-course/seo/update/about_2" method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                        <div class="col-sm-12">
                            <label for="keyword">內容</label>
                            <textarea class="form-control summernote" name="description" cols="30"
                                rows="4">{{ $about_2["description"] }}</textarea>
                        </div>
                        <div class="center-block text-center">
                            <button style="margin-top: 15px" class="btn btn-primary">
                                更新此項目
                            </button>
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
                    url: "/micro-course-course/img/post",
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