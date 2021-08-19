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
                    <h3 class="card-title">頁尾資訊設定</h3>
                </div>
                <div class="card-body">
                    <form action="/micro-course/website_info_setting/update" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                        <div class="col-sm-12">
                            <label for="title">學校地址</label>
                            <input class="form-control" type="text" value="{{$website_info_setting->address}}" name="address" />
                        </div>

                        <hr>

                        <div class="col-sm-12">
                            <label for="title">辦公室位置</label>
                            <input class="form-control" type="text" value="{{$website_info_setting->office_location}}" name="office_location" />
                        </div>

                        <hr>

                        <div class="col-sm-12">
                            <label for="title">聯絡電話</label>
                            <input class="form-control" type="text" value="{{$website_info_setting->tel}}" name="tel" />
                        </div>

                        <hr>

                        <div class="col-sm-12">
                            <label for="title">聯絡信箱</label>
                            <input class="form-control" type="text" value="{{$website_info_setting->mail}}" name="mail" />
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