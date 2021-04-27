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
                        <h3 class="card-title">影音專區管理 － 新增文章</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="/admin/video/store">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="form-group row">
                                <label for="article_type" class="col-sm-2 control-label">企劃別</label>
                                <div class="col-sm-10">
                                    <select id="plan_type" class="form-control" name="plan_type">
                                        <option value="重要訊息">重要訊息</option>
                                        <option value="分項計畫A">分項計畫A</option>
                                        <option value="分項計畫B">分項計畫B</option>
                                        <option value="分項計畫C">分項計畫C</option>
                                        <option value="分項計畫D">分項計畫D</option>
                                        <option value="分項計畫E">分項計畫E</option>
                                        <option value="分項計畫F">分項計畫F</option>
                                        <option value="其他">其他</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date" class="col-sm-2 control-label">日期</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="date" name="date" data-toggle="datepicker">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <label for="title" class="col-sm-2 control-label">文章標題</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <label for="content" class="col-sm-2 control-label">網址</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="main_content" name="main_content">
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
    <script src="/js/datepicker.min.js"></script>
    <script>
        $('[data-toggle="datepicker"]').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection