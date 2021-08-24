@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">儀表板</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        @if(Auth::check() && Auth::user()->role === 'admin')

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                已開課課程
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$info['totalClass']}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book-reader fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                已報名學生人次
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$info['totalStudents']}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-address-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                學生已認列總學分
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$info['totalScore']}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                學生已修課學分總時數
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$info['totalTime']}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(Auth::check() && Auth::user()->role === 'teacher')
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                目前開課中課程
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$info['runningClass']}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                已開課課程
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$info['totalClass']}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book-reader fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                已報名學生人次
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$info['totalStudents']}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-address-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(Auth::check() && Auth::user()->role === 'student')

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                目前修課中課程
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$info['startingClass']}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-address-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                已修課程
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$info['totalStudentClass']}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book-reader fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                已認列總學分
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$info['totalScore']}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                已修課學分總時數
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$info['totalTime']}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <hr>

            {{$warning}}

            <p>
                微學分採「追認制」，該學期完成 18小時或36小時的課程後，至USR微學分網站，按下認列學分申請按鈕，並在下個學期選課「通識─微學分」，方可認列學分。微學分可認列畢業學分，最高以 2 學分為限。學生應完成修業系所所規定之必修學分以及總學分數方能畢業，且不得因修習微學分課程延長修業年限。
            </p>
            
            <button class="btn btn-success" href="/micro-course/tutorial/create">認列學分</button>
            <form class="pass-form" action="/micro-course/request/store" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
        @endif
    </div>
</div>
@endsection


@section('js')

<script>
    $('.btn-success').click(function(){
        var listid = $(this).data("listid");
        if (confirm('請先確認您的時數是否已滿足申請條件')){
            event.preventDefault();
            $('.pass-form').submit();
        }
    });
</script>

@if(Session::has('error'))
    <script>
        alert('您的剩餘已修課總時數還不足申請認列學分!')
    </script>
@endif

@if(Session::has('fail'))
    <script>
        alert('您已發出過申請, 請靜待審核')
    </script>
@endif

@if(Session::has('success'))
    <script>
        alert('已成功發出認列申請, 請靜待校方審核!')
    </script>
@endif

@endsection
