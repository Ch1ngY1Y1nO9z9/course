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
                        <h3 class="card-title">{{$feature_name}} - 編輯</h3>
                    </div>
                    <div class="card-body">
                        <a href="javascript:history.back()">
                            <button type="submit" class="btn btn-success">返回</button>
                        </a>
                        <hr>
                        <form class="form-horizontal" method="POST" action="/admin/class/update/{{$item->id}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group row">
                                <label for="tutorial_id" class="col-sm-2 control-label">課程主軸</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="tutorial_id" name="tutorial_id" required>
                                        @foreach($tutorials as $tutorial)
                                        <option @if($tutorial->id == $item->tutorial_id) selected @endif value="{{$tutorial->id}}">{{$tutorial->tutorial_name_cn}}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="class_type" class="col-sm-2 control-label">課程類別</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="class_type" name="class_type" required>
                                        <option @if($item->class_type == '授課') selected @endif>授課</option>
                                        <option @if($item->class_type == '講座') selected @endif>講座</option>
                                        <option @if($item->class_type == '工作坊') selected @endif>工作坊</option>
                                        <option @if($item->class_type == '實作活動') selected @endif>實作活動</option>
                                        <option @if($item->class_type == '其他') selected @endif>其他</option>
                                      </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="class_name" class="col-sm-2 control-label">單元名稱</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="class_name" name="class_name" value="{{$item->class_name}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="teacher_name" class="col-sm-2 control-label">教師姓名</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="teacher_name" name="teacher_name" value="{{$item->teacher_name}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="degree" class="col-sm-2 control-label">教師學歷</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="degree" name="degree" value="{{$item->degree}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="experience" class="col-sm-2 control-label">教師經歷</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="experience" name="experience" value="{{$item->experience}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="class_start" class="col-sm-2 control-label">課程開始日期</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="class_start" name="class_start" value="{{$item->class_start}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="class_end" class="col-sm-2 control-label">課程結束日期</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="class_end" name="class_end" value="{{$item->class_end}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="radio1" class="col-sm-2 control-label">是否提供報名?</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="open" id="radio1" value="1" @if($item->open == 1) checked @endif >
                                        <label class="form-check-label" for="radio1">
                                          是
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="open" id="radio2" value="0" @if($item->open == 0) checked @endif >
                                        <label class="form-check-label" for="radio2">
                                          否
                                        </label>
                                      </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="number" class="col-sm-2 control-label">報名人數</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="number" name="number" value="{{$item->number}}" min="1" value="20">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sign_up_start_date" class="col-sm-2 control-label">報名開始日期</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="sign_up_start_date" name="sign_up_start_date" value="{{$item->sign_up_start_date}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sign_up_end_date" class="col-sm-2 control-label">報名結束日期</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="sign_up_end_date" name="sign_up_end_date" value="{{$item->sign_up_end_date}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="location" class="col-sm-2 control-label">授課地點</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="location" name="location" value="{{$item->location}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="total_hours" class="col-sm-2 control-label">時數</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="total_hours" name="total_hours"  value="{{$item->total_hours}}" min="0" step="0.5">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-sm-2 control-label">內容</label>
                                <div class="col-sm-10">
                                    <textarea class="summernote" id="content" name="content" required>
                                        {!!$item->content!!}
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contact" class="col-sm-2 control-label">聯絡人</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="contact" name="contact" value="{{$item->contact}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-sm-2 control-label">聯絡電話</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{$item->phone}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="extend" class="col-sm-2 control-label">附加說明</label>
                                <div class="col-sm-10">
                                    <textarea class="summernote" id="extend" name="extend">{!!$item->extend!!}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="upload_file" class="col-sm-2 control-label">當前附件</label>
                                <div class="col-sm-10">
                                    @if($item->files)
                                        <a target="_blank" href="{{$item->files}}" download>檔案下載連結</a>
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="files" class="col-sm-2 control-label">上傳新附件</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="files" name="files">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="remarks" class="col-sm-2 control-label">備註</label>
                                <div class="col-sm-10">
                                    <textarea id="remarks" name="remarks" class="form-control" rows="6" placeholder="供審核人員查看, 其他人無法看見">{{$item->remarks}}</textarea>
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