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
                        <h3 class="card-title">課程管理 - 編輯</h3>
                    </div>
                    <div class="card-body">
                        <a href="javascript:history.back()">
                            <button type="submit" class="btn btn-success">返回</button>
                        </a>
                        <hr>
                        <form class="form-horizontal" method="POST" action="/micro-course/tutorial/update/{{$item->id}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group row">
                                <label for="tutorial_name_cn" class="col-sm-2 control-label">課程名稱(中)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tutorial_name_cn" name="tutorial_name_cn" value="{{$item->tutorial_name_cn}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tutorial_name_en" class="col-sm-2 control-label">課程名稱(英)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tutorial_name_en" name="tutorial_name_en" value="{{$item->tutorial_name_en}}" required>
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <label for="tutorials_type" class="col-sm-2 control-label">單元類別</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="tutorials_type" name="tutorials_type" required>
                                        <option @if($item->tutorials_type == '授課') selected @endif>授課</option>
                                        <option @if($item->tutorials_type == '講座') selected @endif>講座</option>
                                        <option @if($item->tutorials_type == '工作坊') selected @endif>工作坊</option>
                                        <option @if($item->tutorials_type == '實作活動') selected @endif>實作活動</option>
                                        <option @if($item->tutorials_type == '其他') selected @endif>其他</option>
                                      </select>
                                </div>
                            </div> --}}

                            <div class="form-group row">
                                <label for="organizer" class="col-sm-2 control-label">主辦單位</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="organizer" name="organizer" value="{{$item->organizer}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sort" class="col-sm-2 control-label">排序</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="sort" name="sort" value="{{$item->sort}}" min="0" required>
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
                    url: "/micro-course/img/post",
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