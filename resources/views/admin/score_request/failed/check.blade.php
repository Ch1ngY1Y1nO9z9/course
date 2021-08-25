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
                        <h3 class="card-title">未通過的認列學分申請 - 檢視</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <a href="javascript:history.back()">
                                    <button type="submit" class="btn btn-primary">返回</button>
                                </a>
                            </div>
                        </div>

                        <hr>

                        <table id="table" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>提出申請時已通過的課程</th>
                                <th>時數</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach(json_decode($item->passed_courses) as $signUp_id)
                                <?php  $class = $item->getCourse($signUp_id); ?>
                                <tr>
                                    <td>
                                        {{$class->getCoursesDetail->tutorial->tutorial_name_cn}} -
                                        {{$class->getCoursesDetail->class_name}}
                                    </td>
                                    <td>
                                        {{$class->getCoursesDetail->total_hours}}
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
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "order": [[0,'desc']],
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