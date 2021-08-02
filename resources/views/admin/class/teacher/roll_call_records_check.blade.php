@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{$record->class->class_name}} - {{$recode->date}} 線上點名</h3>
                    </div>
                    <div class="card-body">
                        <a href="javascript:history.back()">
                            <button type="submit" class="btn btn-success">返回</button>
                        </a>
                        <hr>
                        <form class="form-horizontal">

                            <table id="table" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>學生姓名</th>
                                        <th>學號</th>
                                        <th>簽到</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $key->item)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>
                                                {{$item->student_name}}
                                            </td>
                                            <td>
                                                {{$item->student_id}}
                                            </td>
                                            <td width="170">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" checked disabled id="defaultCheck1">
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
    </script>
@endsection