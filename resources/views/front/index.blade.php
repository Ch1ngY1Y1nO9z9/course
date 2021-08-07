@extends('layouts.default_index')

@section('title',$seo->title)
@section('keywords',$seo->keywords)
@section('description',$seo->description)

@section('css')
    <link rel="stylesheet" href="/css/index.css">
@endsection

@section('content')
<section id="main-section">
    <section id="banner">
        <div class="swiper-container bannerSwiper">
            <div class="swiper-wrapper">
                @foreach($banners as $banner)
                    <div class="swiper-slide">
                        <a href="{{$banner->slider_a_href}}"><img class="img-fluid" src="{{$banner->slider_url}}" alt="{{$banner->slider_alt}}"></a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="title">
                        <h3>About Us</h3>
                        <h2>關於我們</h2>
                    </div>
                    <div class="context-left">
                        <p>
                        {{$about->description}}
                        </p>
                    </div>
                    <a href="/plan_vision" class="btn btn-sm btn-dark btn-more">更多資訊</a>
                </div>
                <div class="col-md-6">
                    <div class="title">
                        <h3>Goal</h3>
                        <h2>USR理念</h2>
                    </div>
                    <div class="context-right">
                        {!!$about_2->description!!}
                    </div>
                </div>
            </div>
        </div>
    </section>

</section>

<section id="news-section">
    <div class="container">
        <div class="news-nav">
            <div class="left-nav">
                <div class="title">
                    <h3>News</h3>
                    <h2>最新消息</h2>
                </div>
                <nav>
                    <a class="btn btn-sm btn-dark" href="">全部</a>
                    <a class="btn btn-sm btn-secondary" href="">課程公告</a>
                    <a class="btn btn-sm btn-secondary" href="">校內活動</a>
                    <a class="btn btn-sm btn-secondary" href="">場域活動</a>
                    <a class="btn btn-sm btn-secondary" href="">其他公告</a>
                    <a class="btn btn-sm btn-secondary" href="">資訊轉知</a>
                </nav>
            </div>
            <div class="more">
                <a class="btn btn-link" href="/news">
                    全部消息
                    <img src="/imgs/icons/more.png" alt="more">
                </a>
            </div>
        </div>
        <div class="new-content">
            <ul>
                @foreach($news as $new)
                    <li>
                        <div class="dateTypeLabel">
                            <span class="date">{{$new->date}}</span><span class="type">校內活動</span>
                        </div>
                        <a href="/news/{{$new->id}}" class="title">{{$new->title}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

<section id="schedule-section">
    <div class="container">
        <div class="schedule-nav">
            <div class="title">
                <h3>USR Schedule</h3>
                <h2>USR行事曆</h2>
            </div>
            <nav>
                <a class="btn btn-primary" href="">課程公告</a>
                <a class="btn btn-dark" href="">校內活動</a>
                <a class="btn btn-dark" href="">場域活動</a>
            </nav>
        </div>
        <div class="schedule-content">

        </div>
    </div>
</section>

<section id="video-section">
    <div class="container">
        <div class="video-nav">
            <div class="title">
                <h3>Video</h3>
                <h2>影音中心</h2>
            </div>
            <div class="more">
                <a class="btn btn-link" href="/video">
                    所有影音
                    <img src="/imgs/icons/more.png" alt="more">
                </a>
            </div>
        </div>
        <div class="video-content">
            <div class="swiper-container videoSwiper">
                <div class="swiper-wrapper">
                    @foreach($videos as $video)
                    <div class="swiper-slide">
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
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-button-next">
                <img width="50" src="/imgs/icons/right-pagination.png" alt="next">
            </div>
            <div class="swiper-button-prev">
                <img width="50" src="/imgs/icons/left-pagination.png" alt="prev">
            </div>
        </div>
    </div>
</section>

<section id="download-section">
    <div class="container">
        <div class="download-nav">
            <div class="title">
                <h3>Download</h3>
                <h2>檔案中心</h2>
            </div>

            <div class="more">
                <a class="btn btn-link" href="/downloads">
                    所有檔案
                    <img src="/imgs/icons/more.png" alt="more">
                </a>
            </div>
        </div>
        <div class="download-content">
            <ul>
                @foreach($downloads as $download)
                <li>
                    <div class="dateTypeLabel">
                        <span class="date">{{$download->date}}</span>
                    </div>
                    <span class="title">{{$download->title}}</span>
                    <span class="download">
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
    </div>
</section>

<section id="links-section">
    <div class="container">
        <div class="swiper-container links-Swiper">
            <div class="swiper-wrapper">
                @foreach($links as $link)
                    <div class="swiper-slide">
                        <a class="title" href="{{$link->links_a_href}}">
                            <img src="{{$link->links_url}}" alt="{{$link->links_alt}}">
                            <p>
                                {{$link->links_alt}}
                            </p>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next">
                <img width="15" src="/imgs/icons/right-pagination-white.png" alt="next">
            </div>
            <div class="swiper-button-prev">
                <img width="15" src="/imgs/icons/left-pagination-white.png" alt="next">
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
    var swiper = new Swiper(".bannerSwiper", {
        slidesPerView: 'auto',
        centeredSlides: true,
        spaceBetween: 40,
        loop: true,
        grabCursor: true,
        pagination: {
            el: ".bannerSwiper .swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    var swiper = new Swiper(".videoSwiper", {
        slidesPerView: 'auto',
        spaceBetween: 40,
        loop: true,
        navigation: {
            nextEl: ".video-content .swiper-button-next",
            prevEl: ".video-content .swiper-button-prev",
        },
    });

    var swiper = new Swiper(".links-Swiper", {
        slidesPerView: 'auto',
        spaceBetween: 40,
        grabCursor: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>
@endsection