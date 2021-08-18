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
                        <h3 class="card-title">查詢成績</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <a href="/micro-course/course">
                                    <button type="submit" class="btn btn-success">返回</button>
                                </a>
                            </div>
                        </div>
                        <hr>
                        <form class="form-horizontal" method="post" action="/micro-course/course/export_query">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group row">
                                <label for="year" class="col-sm-2 control-label">輸入學年</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="year" name="year" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="academic" class="col-sm-2 control-label">選擇學期</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="academic" name="academic">
                                        <option value="-1" selected>上學期</option>
                                        <option value="-2">下學期</option>
                                      </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="student_id" class="col-sm-2 control-label">輸入學號</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="student_id" name="student_id">
                                    <small class="text-danger">*若沒輸入學號則自動匯出整學期所有學生修課資料</small>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-success">查詢</button>
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

    @if(Session::has('error'))
    <script>
        alert('未查詢到任何資料!')
    </script>
    @endif
@endsection