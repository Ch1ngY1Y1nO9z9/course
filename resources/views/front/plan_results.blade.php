@extends('layouts.default')

@section('css')
    <link rel="stylesheet" href="/css/news.css">
    <link rel="stylesheet" href="/css/plan_result.css">
    <style>
        section#news-section .news-nav{
            margin-bottom:30px;
        }

        .swiper-container.videoSwiper .swiper-slide .video-slide img.video-img {
            height: initial;
        }
    </style>
@endsection

@section('content')
    <nav class="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">首頁</a></li>
                <li class="breadcrumb-item active" aria-current="page">成果專區</li>
              </ol>
        </div>
    </nav>

    <?php 
        $articles_1 = $articles->where('plan_type','教師成長');
        $articles_2 = $articles->where('plan_type','場域學習');
        $articles_3 = $articles->where('plan_type','成果亮點');
    ?>

    <section id="news-section">
        <div class="content container" style="margin-top: 30px">
            <div class="container">
                <div class="news-nav">
                    <div class="left-nav">
                        <div class="title">
                            <h3>Results</h3>
                            <h2>成果專區 - 教師成長</h2>
                        </div>
                    </div>
                </div>
                
                <div class="new-content position-relative">
                    @if(count($articles_1) == 0)
                        <p>目前沒有最新消息！</p>
                    @endif
                    
                    <div class="swiper-container videoSwiper">
                        <div class="swiper-wrapper">
                            @foreach($articles_1 as $article)
                                <div class="swiper-slide">
                                    <a href="/plan_results/{{$article->id}}">
                                        <div class="video-slide">
                                            @foreach($article->download_files as $file)
                                                @if ($loop->first)
                                                    <img class="video-img" src="{{$file->url}}" alt="">
                                                @endif
                                            @endforeach
                                        </div>
                                    </a>
                                    <div class="title">
                                        <a href="/plan_results/{{$article->id}}">
                                            {{$article->title}}
                                        </a>
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

                <hr class="my-5">

                <div>
                    <div class="news-nav">
                        <div class="left-nav">
                            <div class="title">
                                <h3>Results</h3>
                                <h2>成果專區 - 場域學習</h2>
                            </div>
                        </div>
                    </div>
                    <div class="new2-content position-relative">
                        @if(count($articles_2) == 0)
                            <p>目前沒有此類別項目！</p>
                        @endif
                        
                        <div class="swiper-container videoSwiper">
                            <div class="swiper-wrapper">
                                @foreach($articles_2 as $article)
                                    <div class="swiper-slide">
                                        <a href="/plan_results/{{$article->id}}">
                                            <div class="video-slide">
                                                @foreach($article->download_files as $file)
                                                    @if ($loop->first)
                                                        <img class="video-img" src="{{$file->url}}" alt="">
                                                    @endif
                                                @endforeach
                                            </div>
                                        </a>
                                        <div class="title">
                                            <a href="/plan_results/{{$article->id}}">
                                                {{$article->title}}
                                            </a>
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
                </div>

                <hr class="my-5">

                <div>
                    <div class="news-nav">
                        <div class="left-nav">
                            <div class="title">
                                <h3>Results</h3>
                                <h2>成果專區 - 成果亮點</h2>
                            </div>
                        </div>
                    </div>
                    <div class="new3-content position-relative">
                        @if(count($articles_3) == 0)
                            <p>目前沒有此類別項目！</p>
                        @endif
                        
                        <div class="swiper-container videoSwiper">
                            <div class="swiper-wrapper">
                                @foreach($articles_3 as $article)
                                    <div class="swiper-slide">
                                        <a href="/plan_results/{{$article->id}}">
                                            <div class="video-slide">
                                                @foreach($article->download_files as $file)
                                                    @if ($loop->first)
                                                        <img class="video-img" src="{{$file->url}}" alt="">
                                                    @endif
                                                @endforeach
                                            </div>
                                        </a>
                                        <div class="title">
                                            <a href="/plan_results/{{$article->id}}">
                                                {{$article->title}}
                                            </a>
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
                </div>
                
            </div>
        </div>
    </section>

@endsection

@section('js')
<script>
    var plan_results_swiper = new Swiper(".new-content .videoSwiper", {
        slidesPerView: 3,
        spaceBetween: 40,
        navigation: {
            nextEl: ".new-content .swiper-button-next",
            prevEl: ".new-content .swiper-button-prev",
        },
    });

    var plan_results_swiper2 = new Swiper(".new2-content .videoSwiper", {
        slidesPerView: 3,
        spaceBetween: 40,
        navigation: {
            nextEl: ".new2-content .swiper-button-next",
            prevEl: ".new2-content .swiper-button-prev",
        },
    });

    var plan_results_swiper3 = new Swiper(".new3-content .videoSwiper", {
        slidesPerView: 3,
        spaceBetween: 40,
        navigation: {
            nextEl: ".new3-content .swiper-button-next",
            prevEl: ".new3-content .swiper-button-prev",
        },
    });
</script>
@endsection