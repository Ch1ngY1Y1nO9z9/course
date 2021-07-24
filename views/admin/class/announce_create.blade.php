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
                        <h3 class="card-title">公告</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="/admin/class/announce/1/update" enctype="multipart/form-data">

                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="class_id" value="{{$id}}">

                            <div class="form-group row">
                                <label for="title" class="col-sm-2 control-label">標題</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-sm-2 control-label">內容</label>
                                <div class="col-sm-10">
                                    <textarea class="summernote" id="content" name="content">

                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="files" class="col-sm-2 control-label">附件</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="files" name="files">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="start_date" class="col-sm-2 control-label">上架日期</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="end_date" class="col-sm-2 control-label">下架日期</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" required>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-success">發布</button>
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