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
                        <h3 class="card-title">{{Auth::user()->name}} - {{$feature_name}}</h3>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-success" href="/admin/class/create">新增課程</a>
                        <hr>
                        <table id="table" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>課程類別</th>
                                <th>課程名稱</th>
                                <th>課程日期</th>
                                <th>時數(小時)</th>
                                <th>可報名/已報名</th>
                                <th>報名期限</th>
                                <th>審核狀態</th>
                                <th>功能</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td>
                                        {{$item->tutorial->tutorials_type}}
                                    </td>
                                    <td>
                                        {{$item->tutorial->tutorial_name_cn}}<br>
                                        {{$item->class_name}}
                                    </td>
                                    <td>
                                        {{$item->class_start}}<br>
                                        {{$item->class_end}}
                                    </td>
                                    <td>
                                        {{$item->total_hours}}
                                    </td>
                                    <td>
                                        {{$item->number}} / {{$item->checkSignUp($item->id)}}
                                    </td>
                                    <td>
                                        {{$item->sign_up_start_date}}<br>
                                        {{$item->sign_up_end_date}}
                                    </td>
                                    <td>
                                        {{$item->status}}
                                    </td>
                                    <td width="150">
                                        @if($item->status != '未送出')
                                            <a class="btn btn-sm btn-primary mt-1" href="/admin/class/check/{{$item->id}}">檢視</a>
                                        @endif

                                        @if($feature_name != '單元審核')
                                            @if(Auth::user()->role == 'admin' && $item->status != '已通過')
                                                <a class="btn btn-sm btn-success mt-1" href="/admin/class/edit/{{$item->id}}">編輯</a>
                                            @endif

                                            @if($item->status != '已撤下' && $item->status != '審核未通過')
                                                <button class="btn btn-sm btn-danger mt-1 del" data-listid="{{$item->id}}">撤下</button>
                                                <form class="delete-form" action="/admin/class/delete/{{$item->id}}" method="POST" style="display: none;" data-listid="{{$item->id}}">
                                                    {{ csrf_field() }}
                                                </form>
                                            @endif
                                        @endif

                                        @if($feature_name == '單元審核')
                                        <br>
                                        <button class="btn btn-sm btn-success pass mt-1" data-listid="{{$item->id}}">通過</button>
                                        <form class="pass-form" action="/admin/class_review/{{$item->id}}/pass" method="POST" style="display: none;" data-listid="{{$item->id}}">
                                            {{ csrf_field() }}
                                        </form>
                                        <button class="btn btn-sm btn-danger fail mt-1" data-listid="{{$item->id}}">不通過</button>
                                        <form class="delete-form" action="/admin/class_review/{{$item->id}}/fail" method="POST" style="display: none;" data-listid="{{$item->id}}">
                                            {{ csrf_field() }}
                                        </form>
                                        @endif

                                        @if($item->status != '未送出'&& $item->status != '待審核' && $item->status != '已撤下' && $item->status != '審核未通過')
                                        <a class="btn btn-sm btn-secondary mt-1" href="/admin/class/assessment/{{$item->id}}">期末評量</a>
                                        @endif

                                        @if($feature_name != '單元審核')
                                        <button class="btn btn-sm btn-warning mt-1 text-dark" data-listid="{{$item->id}}">複製</button>
                                        <form class="copy-form" action="/admin/class/copy/{{$item->id}}" method="POST" style="display: none;" data-listid="{{$item->id}}">
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

        $('.del').click(function(){
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

        $('.fail').click(function(){
            var listid = $(this).data("listid");
            if (confirm('確認不通過此課程？')){
                event.preventDefault();
                $('.delete-form[data-listid="' + listid + '"]').submit();
            }
        });

        $('.pass').click(function(){
            var listid = $(this).data("listid");
            if (confirm('確認通過此課程？')){
                event.preventDefault();
                $('.pass-form[data-listid="' + listid + '"]').submit();
            }
        });

    </script>

    @if(Session::has('copy_success'))
        <script>
            alert('複製完成!記得需重新上傳附件檔案後按更新送出審核!')
        </script>
    @endif

    @if(Session::has('passed'))
    <script>
        alert('期末課程評分已完成!')
    </script>
@endif
@endsection