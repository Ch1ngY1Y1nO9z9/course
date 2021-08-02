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
                        {{-- <div class="form-group row">
                            <label for="tutorial_id" class="col-sm-2 control-label">課程主軸</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="tutorial_id" name="tutorial_id" disabled>
                                    <option>{{$item->tutorial->tutorial_name_cn}}</option>
                                  </select>
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="class_name" class="col-sm-2 control-label">單元名稱</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="class_name" name="class_name" value="{{$item->tutorial->tutorial_name_cn}} {{$item->class_name}}" readonly>
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
                            <label class="col-sm-2 control-label">報名人數</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$item->number}}" readonly>
                            </div>
                        </div>

                        {{-- <div class="form-group row">
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
                        </div> --}}

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
                        @if($item->files)
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
                        @endif
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
        $('.summernote1').summernote('disable');
        $('.summernote2').summernote('disable');
    </script>
@endsection