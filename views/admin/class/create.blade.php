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
                        <form class="form-horizontal" method="POST" action="/admin/class/store" enctype="multipart/form-data">

                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                            <div class="form-group row">
                                <label for="class_cn" class="col-sm-2 control-label">課程名稱</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="class_cn" name="class_cn" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="class_en" class="col-sm-2 control-label">課程英文名稱</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="class_en" name="class_en" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="budget" class="col-sm-2 control-label">經費來源</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="budget" name="budget">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="class_type" class="col-sm-2 control-label">課程類別</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="class_type" name="class_type" required>
                                        <option selected hidden>-</option>
                                        <option>授課</option>
                                        <option>講座</option>
                                        <option>工作坊</option>
                                        <option>實作活動</option>
                                        <option>其他</option>
                                      </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="organizer" class="col-sm-2 control-label">舉辦單位</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="organizer" name="organizer">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="teacher_name" class="col-sm-2 control-label">教師姓名</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="teacher_name" name="teacher_name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="degree" class="col-sm-2 control-label">教師學歷</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="degree" name="degree" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="experience" class="col-sm-2 control-label">教師經歷</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="experience" name="experience" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="class_start" class="col-sm-2 control-label">課程開始日期</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="class_start" name="class_start" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="class_end" class="col-sm-2 control-label">課程結束日期</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="class_end" name="class_end" required>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="radio1" class="col-sm-2 control-label">是否提供報名?</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="open" id="radio1" value="1" checked>
                                        <label class="form-check-label" for="radio1">
                                          是
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="open" id="radio2" value="0">
                                        <label class="form-check-label" for="radio2">
                                          否
                                        </label>
                                      </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="number" class="col-sm-2 control-label">報名人數</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="number" name="number" value="1" min="1">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sign_up_start_date" class="col-sm-2 control-label">開始報名日期</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="sign_up_start_date" name="sign_up_start_date" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sign_up_end_date" class="col-sm-2 control-label">截止報名日期</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="sign_up_end_date" name="sign_up_end_date" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="location" class="col-sm-2 control-label">授課地點</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="location" name="location" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="total_hours" class="col-sm-2 control-label">總時數</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="total_hours" name="total_hours" value="0.0" min="0" step="0.5">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="credit" class="col-sm-2 control-label">學分數</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="credit" name="credit" max="2" min="0" value="0.0" step="0.5">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-sm-2 control-label">內容</label>
                                <div class="col-sm-10">
                                    <textarea class="summernote" id="content" name="content" required>

                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contact" class="col-sm-2 control-label">聯絡人</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="contact" name="contact" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-sm-2 control-label">聯絡電話</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="extend" class="col-sm-2 control-label">附加說明</label>
                                <div class="col-sm-10">
                                    <textarea class="summernote" id="extend" name="extend">

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
                                <label for="remarks" class="col-sm-2 control-label">備註</label>
                                <div class="col-sm-10">
                                    <textarea id="remarks" name="remarks" class="form-control" rows="6" placeholder="供審核人員查看, 其他人無法看見"></textarea>
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