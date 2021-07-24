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
                        <h3 class="card-title">課程列表</h3>
                    </div>
                    <div class="card-body">
                        <table id="table" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>課程類別</th>
                                <th>課程名稱</th>
                                <th>課程日期</th>
                                <th>總時數</th>
                                <th>可報名/已報名</th>
                                <th>報名期限</th>
                                <th>功能</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td>
                                        {{$item->class_type}}
                                    </td>
                                    <td>
                                        {{$item->class_cn}}
                                    </td>
                                    <td>
                                        <?php
                                            $start = date("Y-m-d h:i a", strtotime($item->class_start));
                                            $end = date("Y-m-d h:i a", strtotime($item->class_end));
                                        ?>
                                        {{$start}}<br>
                                        {{$end}}
                                    </td>
                                    <td>
                                        {{$item->total_hours}}
                                    </td>
                                    <td>
                                        <?php
                                            $sign_up = count(APP\Courses::where('id',$item->id)->get());    
                                        ?>
                                        {{$item->number}} / {{$sign_up}}
                                    </td>
                                    <td>
                                        <?php
                                            $sign_up_start = date("Y-m-d h:i a", strtotime($item->class_start));
                                            $sign_up_end = date("Y-m-d h:i a", strtotime($item->class_end));
                                        ?>
                                        {{$sign_up_start}}<br>
                                        {{$sign_up_end}}
                                    </td>
                                    <td width="200">
                                        <a class="btn btn-sm btn-primary" href="/admin/student/course/check/{{$item->id}}">檢視</a>
                                        @if(strtotime($date) > strtotime($item->class_start) && strtotime($date) < strtotime($item->sign_up_end_date))
                                            <a class="btn btn-sm btn-success" href="/admin/class/edit/{{$item->id}}">報名</a>
                                            <button class="btn btn-sm btn-danger" data-listid="{{$item->id}}">取消報名</button>
                                            <form class="delete-form" action="/admin/class_review/delete/{{$item->id}}" method="POST" style="display: none;" data-listid="{{$item->id}}">
                                                {{ csrf_field() }}
                                            </form>
                                        @endif  
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
                "order": [[2,'asc']],
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

        $('.btn-danger').click(function(){
            var listid = $(this).data("listid");
            if (confirm('確認取消報名？')){
                event.preventDefault();
                // $('.delete-form[data-listid="' + listid + '"]').submit();
            }
        });
    </script>
@endsection