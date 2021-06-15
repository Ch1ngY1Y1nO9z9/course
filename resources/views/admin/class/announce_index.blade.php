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
                        <h3 class="card-title">{{$class->class_cn}} - 課程公告</h3>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-success" href="/admin/class/announce/{{$class->id}}/create">新增公告</a>
                        <hr>
                        <table id="table" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>標題</th>
                                <th>內容</th>
                                <th>上架時間</th>
                                <th>下架時間</th>
                                <th>功能</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        [重要通知] 課程改為線上教學
                                    </td>
                                    <td>
                                        因應疫情緣故, 目前此堂課程將改為線上教學, google會議的網址為....
                                    </td>
                                    <td>
                                        2021/06/14 10:00 am
                                    </td>
                                    <td>
                                        2021/07/14 00:00 am
                                    </td>
                                    <td width="150">
                                        <a class="btn btn-sm btn-success mt-1" href="/admin/class/announce/1/edit">編輯</a>
                                        <button class="btn btn-sm btn-danger mt-1" data-listid="1">撤下</button>
                                        <form class="delete-form" action="/admin/class/announce/1/delete" method="POST" style="display: none;" data-listid="1">
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
                                </tr>
                                @foreach($items as $item)
                                <tr>
                                    <td>
                                        {{$item->title}}
                                    </td>
                                    <td>
                                        {{$item->content}}
                                    </td>
                                    <td>
                                        {{$item->start_date}}
                                    </td>
                                    <td>
                                        {{$item->end_date}}
                                    </td>
                                    <td width="150">
                                        <a class="btn btn-sm btn-primary mt-1" href="/admin/class/check/{{$item->id}}">檢視</a>
                                        <a class="btn btn-sm btn-success mt-1" href="/admin/class/edit/{{$item->id}}">編輯</a>
                                        <button class="btn btn-sm btn-danger mt-1" data-listid="{{$item->id}}">撤下</button>
                                        <form class="delete-form" action="/admin/class/delete/{{$item->id}}" method="POST" style="display: none;" data-listid="{{$item->id}}">
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
            if (confirm('確認是否撤下此課程？')){
                event.preventDefault();
                $('.delete-form[data-listid="' + listid + '"]').submit();
            }
        });

        $('.btn-warning').click(function(){
            var listid = $(this).data("listid");
            if (confirm('確認是否複製此課程？')){
                event.preventDefault();
                $('.copy-form[data-listid="' + listid + '"]').submit();
            }
        });

    </script>
@endsection