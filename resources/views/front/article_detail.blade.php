@extends('layouts.default')

@section('title',$seo->title)
@section('keywords',$seo->keywords)
@section('description',$seo->description)

@section('css')
    <link rel="stylesheet" href="/css/plan_result.css">
    <style>
        .summer-note-content{
            margin-top:30px;
        }

        .summer-note-content table , .summer-note-content img{
            max-width: 100%;
        }

        .swiper-container.videoSwiper .swiper-slide .video-slide{
            height: 400px;
        }
    </style>
@endsection

@section('content')
    <nav class="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">首頁</a></li>
                <li class="breadcrumb-item active" aria-current="page">查看文章內容</li>
              </ol>
        </div>
    </nav>
    
    <div class="summer-note-content container p-3">
        <h3>
            {!! $article->title !!}
        </h3>
        {!! $article->content !!}
    </div>

    @if($route_name=='front_news_detail' || $route_name =='front_plan_results_detail')
    <div class="container">
        <div class="swiper-container videoSwiper">
            <div class="swiper-wrapper">
                @foreach($article->download_files as $file)
                    <div class="swiper-slide">
                        <div class="video-slide">
                            <img class="video-img" src="{{$file->url}}" alt="">
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next">
                <img width="50" src="/imgs/icons/right-pagination.png" alt="next">
            </div>
            <div class="swiper-button-prev">
                <img width="50" src="/imgs/icons/left-pagination.png" alt="prev">
            </div>
        </div>
    </div>
    @endif

    @if($route_name=='front_downloads_detail'|| $route_name == 'front_highlight_detail' || $route_name == 'front_promote_detail' || $route_name == 'front_other_detail')
        @if(count($article->download_files)>0)
            <div id="search-box" class="card">
                <div class="card-body">
                    <h5>下載附件:</h5>
                    @foreach($article->download_files as $file)
                        <a style="margin-right: 5px" href="{{$file->url}}" download="{{$file->old_filename}}">
                            @if($file->ext == 'docx' || $file->ext == 'doc' ||$file->ext == 'odt')
                                <img class="img-fluid" width="40" src="/imgs/word-01.png" alt="中山醫學大學 USR計畫 相關法律">
                            @elseif($file->ext == 'pdf')
                                <img class="img-fluid" width="40" src="/imgs/pdf-01.png" alt="中山醫學大學 USR計畫 相關法律">
                            @else
                                <button class="btn btn-sm btn-outline-info">{{$file->old_filename}}</button>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
@endsection

@section('js')
    <script>
        $("table").wrap( "<div class='table-responsive'></div>" ).addClass('table');

        var swiper = new Swiper(".videoSwiper", {
            slidesPerView: 2,
            spaceBetween: 40,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
@endsection