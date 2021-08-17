@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">線上點名 - QR碼</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="/micro-course/class/check/{{$id}}/QRCode_generate" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <input type="hidden" name="class_id" value="{{$id}}">

                            <div class="form-group row">
                                <label for="start_date" class="col-sm-2 control-label">本堂課開始時間</label>
                                <div class="col-sm-10">
                                    <?php        
                                        $date = date('Y-m-d', time());
                                        $time = date('h:i', time());
                                        $date_time = $date.'T'.$time;
                                    ?>
                                    <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{$date_time}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="time" class="col-sm-2 control-label">點名截止時間(分)</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="time" name="time" value="30" min="1">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-success">產生QR碼</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
