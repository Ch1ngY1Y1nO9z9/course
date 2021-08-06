@extends('layouts.app')
@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">友站連結管理 － 新增</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="/admin/links/store" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="form-group row">
                                <label for="sort" class="col-sm-2 control-label">權重</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="sort" name="sort" step="1" min="1" value="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="links_a_href" class="col-sm-2 control-label">超連結</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="links_a_href" name="links_a_href">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <label for="links_alt" class="col-sm-2 control-label">圖片替代文字(alt)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="links_alt" name="links_alt">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <label for="upload_file" class="col-sm-2 control-label">上傳圖片</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="upload_file" name="upload_file">
                                </div>
                            </div>
                            <span class="text-danger">＊建議尺寸大小為寬 50px,高 50px</span>
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
@endsection