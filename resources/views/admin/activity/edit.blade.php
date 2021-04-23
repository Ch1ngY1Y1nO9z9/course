@extends('layouts.app')
@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">活動圖片管理 － 編輯圖片</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="/admin/activity/update/{{$list->id}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="form-group">
                                <label for="sort" class="col-xs-1 control-label">權重</label>
                                <div class="col-xs-5">
                                    <input type="number" class="form-control" id="sort" name="sort" step="1" min="1" value="{{$list->sort}}">
                                </div>
                                <label for="link" class="col-xs-1 control-label">超連結</label>
                                <div class="col-xs-5">
                                    <input type="text" class="form-control" id="link" name="link" value="{{$list->link}}">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label class="col-xs-1 control-label">目前圖片</label>
                                <div class="col-xs-11">
                                    <img width="250px" src="{{$list->image_url}}" alt=""/>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label for="upload_file" class="col-xs-1 control-label">更新圖片</label>
                                <div class="col-xs-11">
                                    <input type="file" class="form-control" id="upload_file" name="upload_file" multiple>
                                </div>
                            </div>
                            <span class="text-danger">＊建議尺寸大小為寬 300px,高 200px</span>
                            <hr>
                            <div class="form-group">
                                <div class="col-xs-12 text-center">
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
@endsection