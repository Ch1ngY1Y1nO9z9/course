@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/b-1.5.1/b-html5-1.5.1/r-2.2.1/datatables.min.css"/>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">計畫成果管理</h3>
                    </div>
                    <div class="panel-body">
                        <a class="btn btn-success" href="/admin/result/create">新增文章</a>
                        <hr>
                        <table id="table" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>文章標題</th>
                                <th>企劃別</th>
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
                                        <a class="btn btn-sm btn-success" href="/admin/result/edit/{{$list->id}}">編輯</a>
                                        <button class="btn btn-sm btn-danger" data-listid="{{$list->id}}">刪除</button>
                                        <form class="delete-form" action="/admin/result/delete/{{$list->id}}" method="POST" style="display: none;" data-listid="{{$list->id}}">
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
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/b-1.5.1/b-html5-1.5.1/r-2.2.1/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "order": [[2,'asc']]
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