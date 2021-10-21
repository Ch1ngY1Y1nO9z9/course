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
                        <h3 class="card-title">{{$class->tutorial->tutorial_name_cn}} - 課堂評量</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="/micro-course/class/assessment/{{$class->id}}/store">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            @foreach($class->signupList as $student)
                                @if($student->status == '正取')
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">{{$student->student_name}}
                                    ({{$student->pass}})
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="form-check form-check-inline pass">
                                            <input class="form-check-input" type="checkbox" name="assessment[]" value="{{$student->student_id}}" checked>
                                            <label class="form-check-label" for="assessment1">通過</label>
                                        </div>
                                        <div class="form-check form-check-inline fail">
                                            <input class="form-check-input" type="checkbox" name="assessment[]" value="0">
                                            <label class="form-check-label" for="assessment2">不通過</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @endif
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
        $('input[type="checkbox"]').click(function(){
            if($(this).prop('checked')){
                if($(this).parent().hasClass('fail')){
                    $(this).closest('.col-sm-10').children('.pass').children('input[type="checkbox"]').prop('checked','')
                }else if($(this).parent().hasClass('pass')){
                    $(this).closest('.col-sm-10').children('.fail').children('input[type="checkbox"]').prop('checked','')
                }
            }

        })


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