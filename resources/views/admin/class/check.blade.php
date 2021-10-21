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
                        <h3 class="card-title">{{$feature_name}} - 檢視</h3>
                    </div>
                    <div class="card-body">
                        
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <a href="/micro-course/class">
                                    <button type="submit" class="btn btn-success">返回</button>
                                </a>
                                <hr>
                            </div>

                            @if($item->status != '未送出'&& $item->status != '待審核' && $item->status != '已撤下' && $item->status != '審核未通過')
                            <div class="col-sm-12">
                                @if($item->checkClassStatus())
                                    <a class="btn btn-warning text-dark" href="/micro-course/class/announce/{{$item->id}}">課程公告</a>
                                @endif
                                <a class="btn btn-primary" href="/micro-course/class/check/{{$item->id}}/students">查看選課名單</a>
                                @if($item->checkClassStatus())
                                <a class="btn btn-success" href="/micro-course/class/check/{{$item->id}}/rollCall">線上點名</a>
                                @endif
                                <a class="btn btn-info" href="/micro-course/class/roll_call_online/{{$item->id}}">查看點名紀錄</a>
                            </div>
                            <hr>
                            @endif
                        </div>
                        
                        <div class="form-group row">
                            <label for="tutorial_id" class="col-sm-2 control-label">課程主軸</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="tutorial_id" name="tutorial_id" disabled>
                                    <option>{{$item->tutorial->tutorial_name_cn}}</option>
                                  </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class_name" class="col-sm-2 control-label">單元類別</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="class_name" name="class_name" value="{{$item->class_type}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class_name" class="col-sm-2 control-label">單元名稱</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="class_name" name="class_name" value="{{$item->class_name}}" readonly>
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
                                <textarea id="experience" name="experience" class="form-control" cols="30" rows="10" readonly>{{$item->experience}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">單元課程開始時間</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control"  value="{{$item->class_start}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">單元課程結束時間</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control"  value="{{$item->class_end}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">時數</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" value="{{$item->total_hours}}" readonly>
                            </div>
                        </div>

                        {{-- <div class="form-group row">
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
                        </div> --}}
                        
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">報名人數上限</label>
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
                            <label class="col-sm-2 control-label">報名截止日期</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" value="{{$item->sign_up_end_date}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">上課地點</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$item->location}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">單元課程介紹</label>
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
                            <label class="col-sm-2 control-label">聯絡方式</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$item->phone}}" placeholder="請填寫聯絡email或電話" readonly>
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label class="col-sm-2 control-label">附加說明</label>
                            <div class="col-sm-10">
                                <textarea class="summernote2" readonly>
                                    {!!$item->extend!!}
                                </textarea>
                            </div>
                        </div> --}}

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
                                <textarea class="form-control" rows="6" placeholder="供審核人員查看, 其他人無法看見" data-toggle="tooltip" data-placement="top" title="此欄位僅供後台審核人員觀看" readonly>{{$item->remarks}}</textarea>
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