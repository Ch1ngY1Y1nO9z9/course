@extends('layouts.app')
@section('css')
    <link  href="/css/datepicker.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">影音專區管理 － 編輯文章</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="/admin/video/update/{{$list->id}}">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="form-group">
                                <label for="plan_type" class="col-sm-1 control-label">企劃別</label>
                                <div class="col-sm-5">
                                    <select id="plan_type" class="form-control" name="plan_type">
                                        <option value="重要訊息" @if($list->plan_type == "重要訊息") selected @endif>重要訊息</option>
                                        <option value="分項計畫A" @if($list->plan_type == "分項計畫A") selected @endif>分項計畫A</option>
                                        <option value="分項計畫B" @if($list->plan_type == "分項計畫B") selected @endif>分項計畫B</option>
                                        <option value="分項計畫C" @if($list->plan_type == "分項計畫C") selected @endif>分項計畫C</option>
                                        <option value="分項計畫D" @if($list->plan_type == "分項計畫D") selected @endif>分項計畫D</option>
                                        <option value="分項計畫E" @if($list->plan_type == "分項計畫E") selected @endif>分項計畫E</option>
                                        <option value="分項計畫F" @if($list->plan_type == "分項計畫F") selected @endif>分項計畫F</option>
                                        <option value="其他" @if($list->plan_type == "其他") selected @endif>其他</option>
                                    </select>
                                </div>

                                <label for="date" class="col-sm-1 control-label">日期</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="date" name="date" data-toggle="datepicker" value="{{$list->date}}">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label for="title" class="col-sm-1 control-label">文章標題</label>
                                <div class="col-sm-11">
                                    <input type="text" class="form-control" id="title" name="title" value="{{$list->title}}">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label for="content" class="col-sm-1 control-label">內文</label>
                                <div class="col-sm-11">
                                    <input class="form-control" id="main_content" name="main_content" value="{{$list->content}}" >
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-success">送出</button>
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
    <script src="/js/datepicker.min.js"></script>
    <script>
        $('[data-toggle="datepicker"]').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection