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
                        <h3 class="card-title">課程管理 - 新增</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">課程名稱</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="slider_a_href" name="slider_a_href">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">課程英文名稱</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="slider_a_href" name="slider_a_href">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">經費來源</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="slider_a_href" name="slider_a_href">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">課程類別</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="exampleFormControlSelect2">
                                        <option selected hidden>-</option>
                                        <option>授課</option>
                                        <option>講座</option>
                                        <option>工作坊</option>
                                        <option>實作活動</option>
                                      </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">舉辦單位</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="slider_a_href" name="slider_a_href">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">教師姓名</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="slider_a_href" name="slider_a_href">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">教師學歷</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="slider_a_href" name="slider_a_href">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">教師經歷</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="slider_a_href" name="slider_a_href">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">課程開始日期</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="slider_a_href" name="slider_a_href">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">課程結束日期</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="slider_a_href" name="slider_a_href">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">是否提供報名?</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                          是
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        <label class="form-check-label" for="exampleRadios2">
                                          否
                                        </label>
                                      </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">報名人數</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="slider_a_href" name="slider_a_href">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">開始報名日期</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="slider_a_href" name="slider_a_href">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">截止報名日期</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="slider_a_href" name="slider_a_href">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">授課地點</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="slider_a_href" name="slider_a_href">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">總時數</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="slider_a_href" name="slider_a_href" min="0">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">學分數</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="slider_a_href" name="slider_a_href" max="2" min="0">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">內容</label>
                                <div class="col-sm-10">
                                    <textarea class="summernote" id="main_content" name="main_content">

                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">聯絡人</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="slider_a_href" name="slider_a_href">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">聯絡電話</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="slider_a_href" name="slider_a_href">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">附加說明</label>
                                <div class="col-sm-10">
                                    <textarea class="summernote" id="main_content" name="main_content">

                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="upload_file" class="col-sm-2 control-label">附件</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="upload_file" name="upload_file">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider_a_href" class="col-sm-2 control-label">備註</label>
                                <div class="col-sm-10">
                                    <textarea id="main_content" name="main_content" class="form-control" rows="6" placeholder="供審核人員查看, 其他人無法看見"></textarea>
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