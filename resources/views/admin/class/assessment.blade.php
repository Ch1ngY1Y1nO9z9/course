@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{$class->tutorial->tutorial_name_cn}} - 期末評量</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="/micro-course/class/assessment/{{$class->id}}/store">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            @foreach($class->signupList as $student)

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">{{$student->student_name}}</label>
                                    <div class="col-sm-10">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="assessment[]" id="assessment1" value="{{$student->student_id}}" checked>
                                            <label class="form-check-label" for="assessment1">通過</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="assessment[]" id="assessment2" value="0">
                                            <label class="form-check-label" for="assessment2">不通過</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                            @endforeach
                            <div class="form-group row">
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
    <script>
        $('.btn-success').click(function(){
            if (confirm('確認是否送出？')==true){
                event.preventDefault();
                $('.form-horizontal').submit();
            }else{
                return false
            }
        });
    </script>
@endsection