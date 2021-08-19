@extends('layouts.app') @section('css')
<style>
    .card {
        margin-bottom: 30px;
    }
</style>
@endsection @section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-10 offset-sm-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">網頁樣式設定</h3>
                </div>
                <div class="card-body">
                    <form action="/micro-course/website_style_setting/update" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                        <div class="col-sm-12">
                            <label for="title">導覽列背景顏色</label>
                            <input class="form-control" type="color" value="{{$website_style_setting->main_navbar_bg_color}}" name="main_navbar_bg_color" />
                        </div>

                        <hr>

                        <div class="col-sm-12">
                            <label for="title">友站連結背景顏色</label>
                            <input class="form-control" type="color" value="{{$website_style_setting->more_navbar_bg_color}}" name="more_navbar_bg_color" />
                        </div>

                        <hr>
                        <div class="col-sm-12">
                            <label for="title">頁尾背景顏色</label>
                            <input class="form-control" type="color" value="{{$website_style_setting->footer_bg_color}}" name="footer_bg_color" />
                        </div>
                        <hr>
                        <div class="col-sm-12">
                            <label for="title">目前內容頁背景圖片</label>    
                        </div>
                        <div class="col-sm-12 mb-3">
                            <img src="{{$website_style_setting->content_page_bg_img}}" width=200 height=200 alt="">
                        </div>
                       
                        <div class="col-sm-12">
                            <label for="title">重新上傳內容頁背景圖片</label>
                            <input class="form-control" type="file" name="content_page_bg_img" />
                        </div>
                        <hr>
                        <div class="center-block text-center">
                            <button style="margin-top: 15px" class="btn btn-primary">
                            更新設定
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('js') @endsection