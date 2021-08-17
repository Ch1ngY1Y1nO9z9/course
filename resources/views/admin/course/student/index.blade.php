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
                                <th>單元類別</th>
                                <th>課程名稱</th>
                                <th>課程日期</th>
                                <th>時數</th>
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
                                        {{$item->tutorial->tutorial_name_cn}}<br>
                                        {{$item->class_name}}
                                    </td>
                                    <td>
                                        {{$item->getDate($item->class_start)}}<br>
                                        {{$item->getDate($item->class_end)}}    
                                    </td>
                                    <td>
                                        {{$item->total_hours}}
                                    </td>
                                    <td>
                                        @if($item->open == 1)
                                        {{$item->number}} / {{count($item->signupList)}}
                                        @elseif($item->open == 0)
                                        不開放報名
                                        @endif
                                    </td>
                                    <td>
                                        {{$item->getDate($item->sign_up_start_date)}}<br>
                                        {{$item->getDate($item->sign_up_end_date)}}
                                    </td>
                                    <td width="200">
                                        <a class="btn btn-sm btn-primary" href="/micro-course/student/course/check/{{$item->id}}">檢視</a>
                                        @if( $date > strtotime($item->sign_up_start_date) && $date < strtotime($item->sign_up_end_date))
                                            @if(!$item->querySignup(Auth::user()->account_id) && $item->open == 1)
                                                <a class="btn btn-sm btn-success" href="/micro-course/class/signup/{{$item->id}}">報名</a>
                                            @else
                                            @if($item->CheckTime($item->id) && $item->open == 1)
                                                <button class="btn btn-sm btn-danger" data-listid="{{$item->id}}">取消報名</button>
                                            @endif
                                                <form class="delete-form" action="/micro-course/class/signup/delete/{{$item->id}}" method="POST" style="display: none;" data-listid="{{$item->id}}">
                                                    {{ csrf_field() }}
                                                </form>
                                            @endif
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
                $('.delete-form[data-listid="' + listid + '"]').submit();
            }
        });
    </script>

    @if(Session::has('signup_success'))
    <script>
        alert('報名成功!');
    </script>
    @elseif(Session::has('signup_full'))
    <script>
        alert('名額已滿!')
    </script>
    @endif
    
    @if(Session::has('delete_success'))
    <script>
        alert('取消成功!');
    </script>
    @endif
@endsection