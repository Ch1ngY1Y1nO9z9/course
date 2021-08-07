@extends('layouts.default')

@section('css')
    <link rel="stylesheet" href="/css/news.css">
@endsection

@section('content')
    <nav class="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">首頁</a></li>
                <li class="breadcrumb-item active" aria-current="page">下載專區</li>
              </ol>
        </div>
    </nav>
    <section id="news-section">
        <div class="content container" style="margin-top: 30px">
            <div class="container">
                <div class="news-nav">
                    <div class="left-nav">
                        <div class="title">
                            <h3>Downloads</h3>
                            <h2>下載專區</h2>
                        </div>
                        
                        <nav>
                            <a class="btn btn-sm {{request()->get('type') == null ? 'btn-dark' : 'btn-secondary'}}" href="/downloads">全部</a>
                            <a class="btn btn-sm {{request()->get('type') == '辦公室辦法' ? 'btn-dark' : 'btn-secondary'}}" href="/downloads?type=辦公室辦法">辦公室辦法</a>
                            <a class="btn btn-sm {{request()->get('type') == '委員會辦法' ? 'btn-dark' : 'btn-secondary'}}" href="/downloads?type=委員會辦法">委員會辦法</a>
                            <a class="btn btn-sm {{request()->get('type') == '相關表單' ? 'btn-dark' : 'btn-secondary'}}" href="/downloads?type=相關表單">相關表單</a>
                        </nav>
                    </div>
                </div>
                <div class="new-content">
                    <ul>
                        @if(count($articles) == 0)
                            <p>目前沒有檔案可以下載！</p>
                        @endif
                        
                        @foreach($articles as $download)
                            <li>
                                <div class="dateTypeLabel">
                                    <span class="date">{{$download->date}}</span><span class="type">{{$download->plan_type}}</span>
                                </div>
                                <span class="title">{{$download->title}}</span>
                                <span class="float-right">
                                    @if(count($download->download_files)>0)
                                        @foreach($download->download_files as $file)
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
                                    @endif
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="float-right">
                    {{ $articles->appends(request()->input())->links('pagination_vendor.pagination.bootstrap-4') }}
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>

@endsection

@section('js')
@endsection