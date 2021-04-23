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
                        <h3 class="panel-title">重要公告管理</h3>
                    </div>
                    <div class="panel-body">
                        <a class="btn btn-success" href="/admin/important/create">新增公告</a>
                        <hr>
                        <table id="table" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>圖片</th>
                                <th>超連結</th>
                                <th>權重</th>
                                <th>功能</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lists as $list)
                                <tr>
                                    <td>
                                        {{--@foreach($list->image_url as $url)--}}
                                            {{--<img width="150px" src="{!! $url['url']!!}">--}}
                                        {{--@endforeach--}}
                                    </td>
                                    <td>{{$list->link}}</td>
                                    <td>{{$list->sort}}</td>
                                    <td width="97">
                                        <a class="btn btn-sm btn-success" href="/admin/important/edit/{{$list->id}}">編輯</a>
                                        <button class="btn btn-sm btn-danger" data-listid="{{$list->id}}">刪除</button>
                                        <form class="delete-form" action="/admin/important/delete/{{$list->id}}" method="POST" style="display: none;" data-listid="{{$list->id}}">
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
                "order": [[2,'desc']]
            });
        } );

        $('.btn-danger').click(function(){
            var listid = $(this).data("listid");
            if (confirm('確認是否刪除此圖片？')){
                event.preventDefault();
                $('.delete-form[data-listid="' + listid + '"]').submit();
            }
        });
    </script>
@endsection