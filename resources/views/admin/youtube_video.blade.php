@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">影音錦囊</h3>
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="post" action="/admin/youtube_video">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group">
                            <label for="plan_type" class="col-xs-2 control-label">Youtube連結</label>
                            <div class="col-xs-5">
                                <input name="youtube_url" type="text" class="form-control" value="{{$youtube_url->title}}">
                            </div>

                            <div class="col-xs-1 text-center">
                                <button type="submit" class="btn btn-success">更新</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
