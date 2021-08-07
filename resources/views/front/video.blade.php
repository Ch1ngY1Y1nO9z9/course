@extends('layouts.default')

@section('css')
    <link rel="stylesheet" href="/css/news.css">
    <link rel="stylesheet" href="/css/video.css">
@endsection

@section('content')
    <nav class="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">首頁</a></li>
                <li class="breadcrumb-item active" aria-current="page">媒體頻道</li>
              </ol>
        </div>
    </nav>
    <section id="news-section">
        <div class="content container" style="margin-top: 30px">
            <div class="container">
                <div class="news-nav">
                    <div class="left-nav">
                        <div class="title">
                            <h3>Video</h3>
                            <h2>媒體頻道</h2>
                        </div>
                        
                        <nav>
                            <a class="btn btn-sm {{request()->get('type') == null ? 'btn-dark' : 'btn-secondary'}}" href="/video">全部</a>
                            <a class="btn btn-sm {{request()->get('type') == '課程公告' ? 'btn-dark' : 'btn-secondary'}}" href="/video?type=課程公告">課程公告</a>
                            <a class="btn btn-sm {{request()->get('type') == '校內活動' ? 'btn-dark' : 'btn-secondary'}}" href="/video?type=校內活動">校內活動</a>
                            <a class="btn btn-sm {{request()->get('type') == '場域活動' ? 'btn-dark' : 'btn-secondary'}}" href="/video?type=場域活動">場域活動</a>
                            <a class="btn btn-sm {{request()->get('type') == '其他公告' ? 'btn-dark' : 'btn-secondary'}}" href="/video?type=其他公告">其他公告</a>
                            <a class="btn btn-sm {{request()->get('type') == '資訊轉知' ? 'btn-dark' : 'btn-secondary'}}" href="/video?type=資訊轉知">資訊轉知</a>
                        </nav>
                    </div>
                </div>
                <div class="video-content">
                    <div class="row">
                        @if(count($articles) == 0)
                            <p>目前沒有上傳影片！</p>
                        @endif
                        @foreach($articles as $video)
                            <div class="col-md-4 mb-3">
                                <a href="{{$video->content}}" target="_blank">
                                        <div class="video-slide">
                                            @foreach($video->download_files as $file)
                                                @if ($loop->first)
                                                    <img class="video-img" src="{{$file->url}}" alt="">
                                                @endif
                                            @endforeach
                                            <div class="video-play">
                                                <img src="/imgs/icons/video-play.png" alt="">
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dateTypeLabel">
                                        <span class="date">{{$video->date}}</span>
                                        <span class="type">{{$video->plan_type}}</span>
                                    </div>
                                    <div class="title">
                                        <a href="{{$video->content}}" target="_blank">
                                            {{$video->title}}
                                        </a>
                                    </div>
                                </a>
                            </div>
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