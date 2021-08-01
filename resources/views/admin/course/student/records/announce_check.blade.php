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
                        <h3 class="card-title">公告</h3>
                    </div>
                    <div class="card-body">
                        <a href="javascript:history.back()">
                            <button type="submit" class="btn btn-success">返回</button>
                        </a>
                        <hr>
                        <form class="form-horizontal" method="POST">

                            <div class="form-group row">
                                <label for="title" class="col-sm-2 control-label">標題</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title" value="{{$item->title}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-sm-2 control-label">內容</label>
                                <div class="col-sm-10">
                                    <textarea class="summernote" id="content" name="content">
                                        {{$item->content}}
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="files" class="col-sm-2 control-label">附件</label>
                                <div class="col-sm-10">
                                    @if($item->files)
                                        <a href="{{$item->files}}" download>附件下載</a>
                                    @else
                                        -
                                    @endif
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="/js/summernote-zh-TW.js"></script>
<script>

    $(function() {
        $('.summernote').summernote('disable');
    });
</script>
@endsection