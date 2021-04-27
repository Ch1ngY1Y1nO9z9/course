@extends('layouts.default')

@section('title',$seo->title)
@section('keywords',$seo->keywords)
@section('description',$seo->description)

@section('css')
    <link  href="/css/datepicker.min.css" rel="stylesheet">
    <style>
        #search-box{
            margin-top: 30px;
            width: calc(100%);
            border: 1px solid #eee;
            border-left-width: .25rem;
            border-radius: .25rem;
            border-left-color: #65B9B4;
            box-shadow: 0 2px 3px rgba(0,0,0,.16);
        }

        .search-btn{
            background-color: #65B9B4;
            border-color: #549e99;
            margin-left: 33px;
            padding: 0.25em 2em;
        }

        .table.table-bg-color  th{
            color: #fff;
            background-color: #65B9B4;
            border-color: #549e99;
        }


        .remove-search{
            position: absolute;
            right: 1em;
            bottom: 0.25em;
            font-size: 2.5em;
            color: #111;
            opacity: 0.75;
        }

        .remove-search:hover{
            color: #111;
            opacity: 1;
        }

        a:hover {
            text-decoration: none;
        }

        @media screen and (max-width: 1400px){
            .search-btn{
                margin-left: 0 !important;
            }
        }

        @media screen and (max-width: 1200px){
            .search-btn{
                margin-left: auto !important;
                margin-right: auto !important;
                display: block !important;
            }
        }
    </style>
@endsection

@section('content')
    @if($route_name == 'front_news' ||$route_name == 'front_plan_results')
        <div id="search-box" class="card">
            <div class="card-body">

                @if(request()->input())
                    <a class="remove-search" href="/{{str_replace('front_','',$route_name)}}">
                        <i class="fas fa-times-circle"></i>
                    </a>
                @endif

                <form action="/{{str_replace('front_','',$route_name)}}" method="get">
                    <div class="form-group row">
                        <label for="years" class="col-form-label" style="margin-left: 14px">年度</label>
                        <div class="col-xl-3 col-lg-5">
                            <select class="custom-select" name="years" id="years">
                                <option value="" @if(!request()->input('years')) selected @endif>請選擇年度</option>
                                <option value="106" @if(request()->input('years') == '106') selected @endif>106年度</option>
                                <option value="107" @if(request()->input('years') == '107') selected @endif>107年度</option>
                                <option value="108" @if(request()->input('years') == '108') selected @endif>108年度</option>
                                <option value="109" @if(request()->input('years') == '109') selected @endif>109年度</option>
                                <option value="110" @if(request()->input('years') == '110') selected @endif>110年度</option>
                                <option value="111" @if(request()->input('years') == '111') selected @endif>111年度</option>
                                <option value="112" @if(request()->input('years') == '112') selected @endif>112年度</option>
                            </select>
                        </div>
                        <label for="plans" class="col-form-label" style="margin-left: 11px">計畫別</label>
                        <div class="col-xl-3 col-lg-5">
                            <select class="custom-select" name="plans" id="plans">
                                <option value="" @if(!request()->input('plans')) selected @endif>請選擇計畫別</option>
                                <option value="重要訊息" @if(request()->input('plans') == '重要訊息') selected @endif>重要訊息</option>
                                <option value="分項計畫A" @if(request()->input('plans') == '分項計畫A') selected @endif>分項計畫A</option>
                                <option value="分項計畫B" @if(request()->input('plans') == '分項計畫B') selected @endif>分項計畫B</option>
                                <option value="分項計畫C" @if(request()->input('plans') == '分項計畫C') selected @endif>分項計畫C</option>
                                <option value="分項計畫D" @if(request()->input('plans') == '分項計畫D') selected @endif>分項計畫D</option>
                                <option value="分項計畫E" @if(request()->input('plans') == '分項計畫E') selected @endif>分項計畫E</option>
                                <option value="分項計畫F" @if(request()->input('plans') == '分項計畫F') selected @endif>分項計畫F</option>
                                <option value="其他" @if(request()->input('plans') == '其他') selected @endif>其他</option>
                            </select>
                        </div>

                        <label for="key_words" class="col-form-label mt-3 mt-xl-0" style="margin-left: 15px">關鍵字</label>
                        <div class="col-xl-3 col-md-12 mt-3 mt-xl-0">
                            <input type="text" class="form-control" name="key_words" id="key_words" value="{{request()->input('key_words')}}" placeholder="請輸入相關關鍵字">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <label for="start_date" class="col-form-label" style="margin-left: 15px">選擇日期</label>
                        <div class="col-xl-3 col-md-12">
                            <input type="text" class="form-control" id="start_date" name="start_date" value="{{request()->input('start_date')}}" data-toggle="datepicker">
                        </div>
                        <label for="end_date" class="col-form-label mx-3 mx-xl-1">到</label>
                        <div class="col-xl-3 col-md-12">
                            <input type="text" class="form-control" id="end_date" name="end_date" value="{{request()->input('end_date')}}" data-toggle="datepicker">
                        </div>

                        <div class="custom-control custom-checkbox col-12 col-lg-12 col-xl-auto my-3 my-lg-2" style="margin-left: 15px;">
                            <input type="checkbox" class="custom-control-input" id="all_check" @if(request()->input('all_check') == 'on') checked @endif name="all_check">
                            <label class="custom-control-label" for="all_check">完全符合條件</label>
                        </div>

                        <button class="btn btn-info search-btn" type="submit">
                            搜尋
                        </button>
                    </div>
                </form>

            </div>
        </div>
    @endif

    <table class="table table-bg-color table-hover table-bordered" style="box-shadow: 0 2px 3px rgba(0,0,0,.16);margin-top: 30px;">
        <thead>
        <tr>
            <th>標題</th>
            <th width="125">時間</th>
            @if($route_name != 'front_honors' && $route_name != 'front_downloads'  && $route_name != 'front_highlight' && $route_name != 'front_promote' && $route_name != 'front_other')<th width="200">計畫別</th>@endif
            @if($route_name == 'front_downloads' || $route_name == 'front_highlight' || $route_name == 'front_promote' || $route_name == 'front_other')<th width="200">下載類別</th>@endif
        </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
            <tr>
                <td>
                    @if($article->top == 1) 
                        @if($route_name=='front_honors')
                            <img style="margin-top: -8px" width="25" src="imgs/honors_top.png" alt="榮譽榜單 置頂">
                            @else
                            <i class="fas fa-caret-square-up" style="color: red;"></i>
                        @endif
                    @endif
                    <a href="/{{str_replace('front_','',$route_name)}}/{{$article->id}}" style="color:black;">{{$article->title}}</a>
                </td>
                <td>{{$article->date}}</td>
                @if($route_name != 'front_honors' && $route_name != 'front_downloads' && $route_name != 'front_highlight' && $route_name != 'front_promote' && $route_name != 'front_other')<td>{{$article->plan_type}}</td>@endif
                @if($route_name == 'front_downloads' || $route_name == 'front_highlight' || $route_name == 'front_promote' || $route_name == 'front_other')
                    <td>
                        @foreach($article->download_files as $file)
                            <a style="margin-right: 5px" href="{{$file->url}}" download="{{$file->old_filename}}">
                                @if($file->ext == 'docx' || $file->ext == 'doc' ||$file->ext == 'odt')
                                    <img class="img-fluid" width="40" src="/imgs/word-01.png" alt="中山醫學大學 USR計畫 下載icon">
                                @elseif($file->ext == 'pdf')
                                    <img class="img-fluid" width="40" src="/imgs/pdf-01.png" alt="中山醫學大學 USR計畫 下載icon">
                                @elseif($file->ext == 'jpg')
                                    <img class="img-fluid" width="40" src="/imgs/icon-jpg.png" alt="中山醫學大學 USR計畫 下載icon">
                                @else
                                    <img class="img-fluid" width="40" src="/imgs/icon-download.png" alt="中山醫學大學 USR計畫 下載icon">
                                @endif
                            </a>
                        @endforeach
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="float-right">
        {{ $articles->appends(request()->input())->links('pagination_vendor.pagination.bootstrap-4') }}
    </div>


@endsection

@section('js')
    <script src="/js/datepicker.min.js"></script>
    <script>
        $('[data-toggle="datepicker"]').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection