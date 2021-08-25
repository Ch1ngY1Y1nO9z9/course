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
                        <h3 class="card-title">認列學分申請 - 檢視</h3>
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
                                <th>已通過的課程</th>
                                <th>時數</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                    @if(!in_array($item->id,$recorded_id))
                                    <tr>
                                        <td>
                                            {{$item->getCoursesDetail->tutorial->tutorial_name_cn}} -
                                            {{$item->getCoursesDetail->class_name}}
                                        </td>
                                        <td>
                                            {{$item->getCoursesDetail->total_hours}}
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-right">
                            總計時數: {{$total_time}}小時
                        </div>

                        <hr>
                        <div class="form-group row">
                            <label for="score" class="col-sm-2 control-label">可認列學分</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="score" min="0" value="{{$socre}}" required>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <button class="btn btn-success pass mt-1 mr-1" data-listid="{{$id}}">通過</button>
                            <button class="btn btn-danger fail mt-1 ml-1" data-listid="{{$id}}">不通過</button>
                        </div>

                        <form class="pass-form" action="/micro-course/request/passed/{{$id}}" method="POST" data-listid="{{$id}}">
                            <input type="hidden" name="score" value="{{$socre}}">
                            <input type="hidden" name="recorded_id" value="{{json_encode($recorded_id)}}">
                            {{ csrf_field() }}
                        </form>
                        <form class="delete-form" action="/micro-course/request/fail/{{$id}}" method="POST" style="display: none;" data-listid="{{$id}}">
                            <input type="hidden" name="recorded_id" value="{{json_encode($recorded_id)}}">
                            {{ csrf_field() }}
                        </form>
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

        $('#score').change(function(){
            var score = $(this).val()
            $("input[name='score']").val(score);
            $(this).val(score);
        })

        $('.fail').click(function(){
            var listid = $(this).data("listid");
            if (confirm('確認取消此申請？')){
                event.preventDefault();
                $('.delete-form[data-listid="' + listid + '"]').submit();
            }
        });

        $('.pass').click(function(){
            var listid = $(this).data("listid");
            if (confirm('確認通過此認列申請？')){
                event.preventDefault();
                $('.pass-form[data-listid="' + listid + '"]').submit();
            }
        });

    </script>

@endsection