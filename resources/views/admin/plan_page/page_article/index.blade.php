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
                        <h3 class="panel-title">高教深耕計畫 - 相關法規管理</h3>
                    </div>
                    <div class="panel-body">
                        <a class="btn btn-success" href="/admin/plan_article/create">新增檔案</a>
                        <hr>
                        <table id="table" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>文章標題</th>
                                <th>檔案</th>
                                <th>功能</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lists as $list)
                                <tr>
                                    <td>{{$list->title}}</td>
                                    <td>
                                        @foreach($list->download_files as $file)
                                                <a class="btn btn-default btn-xs" href="{{$file->url}}" download="{{$file->old_filename}}">{{$file->old_filename}}</a>
                                        @endforeach
                                    </td>
                                    <td width="170">
                                        <a class="btn btn-sm btn-success" href="/admin/plan_article/edit/{{$list->id}}">編輯</a>
                                        <button class="btn btn-sm btn-danger" data-listid="{{$list->id}}">刪除</button>
                                        <form class="delete-form" action="/admin/plan_article/delete/{{$list->id}}" method="POST" style="display: none;" data-listid="{{$list->id}}">
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
            $('#table').DataTable();
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