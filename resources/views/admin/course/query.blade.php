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
                        <h3 class="card-title">{{$year}} - 學生修課紀錄</h3>
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
                        <table id="table" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>學號/姓名</th>
                                <th>已通過的課程名稱</th>
                                <th>修課時數</th>
                                <th>認列總學分數</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        {{$student->account_id}} / {{$student->name}}
                                    </td>
                                    <td>
                                        -
                                    </td>
                                    <td>
                                        -
                                    </td>
                                    <td>
                                        {{$student->score}}
                                    </td>
                                </tr>

                                @foreach($items as $item)
                                <tr>
                                    <td>
                                        -
                                    </td>
                                    <td>
                                        {{$item->getCoursesDetail->class_name}}
                                    </td>
                                    <td>
                                        {{$item->GetAllStudentTime($item->student_id)}}
                                    </td>
                                    <td>
                                        -
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "order": [[0,'desc']],
                dom: 'Bfrtip',
                buttons: [{
                    extend: "excel",
                    title: '',
                    className: "btn btn-primary",
                    titleAttr: 'Export in Excel',
                    text: '匯出成Excel',
                    init: function( api, node, config) {
                    $(node).removeClass('btn-default')
                    },
                    exportOptions: {
                        columns: [ 0, 1, 2, 3],
                    },
                    filename: function(){
                        var a = $('.card-title').text();
                        var d = new Date().toISOString().substring(0, 6);
                        return a + d;
                    }
                }],
                language:{
                    "processing":   "處理中...",
                    "loadingRecords": "載入中...",
                    "lengthMenu":   "顯示 _MENU_ 項結果",
                    "zeroRecords":  "沒有符合的結果",
                    "info":         "顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
                    "infoEmpty":    "顯示第 0 至 0 項結果，共 0 項",
                    "infoFiltered": "(從 _MAX_ 項結果中過濾)",
                    "infoPostFix":  "",
                    "search":       "搜尋:",
                    "paginate": {
                        "first": "<<",
                        "last": ">>",
                        "next": ">",
                        "previous": "<"
                    },
                    "aria": {
                        "sortAscending":  ": 升冪排列",
                        "sortDescending": ": 降冪排列"
                    }
                }
            });
        } );

    </script>
@endsection