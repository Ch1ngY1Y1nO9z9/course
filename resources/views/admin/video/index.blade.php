@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">


@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">媒體頻道管理</h3>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-success" href="/admin/video/create">新增</a>
                        <hr>
                        <table id="table" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>標題</th>
                                <th>類別</th>
                                <th>日期</th>
                                <th>功能</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lists as $list)
                                <tr>
                                    <td>{{$list->title}}</td>
                                    <td>{{$list->plan_type}}</td>
                                    <td>{{$list->date}}</td>
                                    <td width="170">
                                        @if($list->top == 0)
                                            <button class="btn btn-sm btn-primary" data-listid="{{$list->id}}">置頂</button>
                                            <form class="to_top-form" action="/admin/top/top/{{$list->id}}" method="POST" style="display: none;" data-listid="{{$list->id}}">
                                                {{ csrf_field() }}
                                            </form>
                                        @else
                                            <button class="btn btn-sm btn-primary" data-listid="{{$list->id}}">取消置頂</button>
                                            <form class="to_top-form" action="/admin/top/normal/{{$list->id}}" method="POST" style="display: none;" data-listid="{{$list->id}}">
                                                {{ csrf_field() }}
                                            </form>
                                        @endif
                                        <a class="btn btn-sm btn-success" href="/admin/video/edit/{{$list->id}}">編輯</a>
                                        <button class="btn btn-sm btn-danger" data-listid="{{$list->id}}">刪除</button>
                                        <form class="delete-form" action="/admin/video/delete/{{$list->id}}" method="POST" style="display: none;" data-listid="{{$list->id}}">
                                            {{ csrf_field() }}
                                        </form>
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
                "order": [[2,'desc']],
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
            if (confirm('確認是否刪除此文章？')){
                event.preventDefault();
                $('.delete-form[data-listid="' + listid + '"]').submit();
            }
        });

        $('.btn-primary').click(function(){
            var listid = $(this).data("listid");
            if (confirm('確認是否變更置頂此文章？')){
                event.preventDefault();
                $('.to_top-form[data-listid="' + listid + '"]').submit();
            }
        });
    </script>
@endsection