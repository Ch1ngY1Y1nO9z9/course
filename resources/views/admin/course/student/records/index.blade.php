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
                        <h3 class="card-title">修課紀錄</h3>
                    </div>
                    <div class="card-body">
                        <table id="table" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>課程類別</th>
                                <th>課程名稱</th>
                                <th>課程日期</th>
                                <th>時數</th>
                                <th>報名人數</th>
                                <th>成績</th>
                                <th>功能</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>
                                            {{$item->getCoursesDetail->class_type}}
                                        </td>
                                        <td>
                                            {{$item->getCoursesDetail->tutorial->tutorial_name_cn}}<br>
                                            {{$item->getCoursesDetail->class_name}}
                                        </td>
                                        <td>
                                            {{$item->getCoursesDetail->getDate($item->getCoursesDetail->class_start)}}<br>
                                            {{$item->getCoursesDetail->getDate($item->getCoursesDetail->class_end)}}
                                        </td>
                                        <td>
                                            {{$item->getCoursesDetail->tutorial->tutorial_name_cn}}
                                        </td>
                                        <td>
                                            {{$item->getCoursesDetail->number}} / {{count($item->getCoursesDetail->signupList)}}
                                        </td>
                                        <td>
                                            {{$item->pass}}
                                        </td>
                                        <td width="200">
                                            <a class="btn btn-sm btn-primary" href="/admin/student/course_records/check/{{$item->course_id}}">檢視</a>
                                            <a class="btn btn-sm btn-warning text-dark" href="/admin/student/course_records/announce/{{$item->course_id}}">課程公告</a>
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
                "order": [[3,'desc']],
                language:{
                    "processing":   "處理中...",
                    "loadingRecords": "載入中...",
                    "lengthMenu":   "顯示 _MENU_ 項結果",
                    "zeroRecords":  "目前尚未選課",
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

        $('.btn-danger').click(function(){
            var listid = $(this).data("listid");
            if (confirm('確認取消報名？')){
                event.preventDefault();
                // $('.delete-form[data-listid="' + listid + '"]').submit();
            }
        });
    </script>
@endsection