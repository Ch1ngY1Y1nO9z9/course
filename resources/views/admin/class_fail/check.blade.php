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
                        <h3 class="card-title">課程管理 - 檢視</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <a href="javascript:history.back()">
                                    <button type="submit" class="btn btn-success">返回</button>
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">課程名稱</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$item->tutorial->tutorial_name_cn}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">課程英文名稱</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$item->tutorial->tutorial_name_en}}" readonly>
                            </div>
                        </div>
{{-- 
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">經費來源</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$item->budget}}" readonly>
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">單元類別</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="exampleFormControlSelect2" disabled>
                                    <option>{{$item->class_type}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">舉辦單位</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$item->tutorial->organizer}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">教師姓名</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$item->teacher_name}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">教師學歷</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$item->degree}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">教師經歷</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$item->experience}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">課程開始日期</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control"  value="{{$item->class_start}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">課程結束日期</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control"  value="{{$item->class_end}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">是否提供報名?</label>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" @if($item->open == 1) checked @endif disabled>
                                    <label class="form-check-label">
                                        是
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" @if($item->open == 0) checked @endif disabled>
                                    <label class="form-check-label">
                                        否
                                    </label>
                                    </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">報名人數</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$item->number}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">報名開始日期</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" value="{{$item->sign_up_start_date}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">報名結束日期</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" value="{{$item->sign_up_end_date}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">授課地點</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$item->location}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">時數</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" value="{{$item->total_hours}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">學分數</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" value="{{$item->credit}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">內容</label>
                            <div class="col-sm-10">
                                <textarea class="summernote1" readonly>
                                    {!!$item->content!!}
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">聯絡人</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$item->contact}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">聯絡電話</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$item->phone}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">附加說明</label>
                            <div class="col-sm-10">
                                <textarea class="summernote2" readonly>
                                    {!!$item->extend!!}
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="upload_file" class="col-sm-2 control-label">附件</label>
                            <div class="col-sm-10">
                                @if($item->files)
                                    <a target="_blank" href="{{$item->files}}" download>檔案下載連結</a>
                                @else
                                    -
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">備註</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="6" placeholder="供審核人員查看, 其他人無法看見" readonly>
                                    {{$item->remarks}}
                                </textarea>
                            </div>
                        </div>
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
        $(function() {
            $('.summernote1').summernote('disable');
            $('.summernote2').summernote('disable');
        });
    </script>
@endsection