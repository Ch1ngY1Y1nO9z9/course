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
                    <h3 class="card-title">首頁背景圖設定</h3>
                </div>
                <div class="card-body">
                    @foreach($index_backgrounds as $section)
                        <div class="my-3">
                            <form action="/micro-course/index_background_setting/{{$section->block}}/update" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                                <div class="col-sm-12">
                                    <label for="title">目前{{$section->checkSection($section->block)}}區塊背景圖片</label>    
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <img src="{{$section->background_link}}" width=300 alt="">
                                </div>
                            
                                <div class="col-sm-12">
                                    <label for="title">重新上傳背景圖片<small class="text-danger">建議尺寸: 1920px * {{$section->checkSize($section->block)}}px</small></label>
                                    <input class="form-control" type="file" name="background_link" />
                                </div>
                                <br>
                                <div class="col-sm-12">
                                    <label for="title">是否填滿背景?</label>
                                    <input class="ml-3" type="checkbox" name="background_size" value="0" @if($section->background_size == '0') checked="true" @endif />
                                </div>
                                <br>
                                <div class="center-block text-center">
                                    <button style="margin-top: 15px" class="btn btn-primary">
                                    更新設定
                                    </button>
                                </div>
                                <hr>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('js') @endsection