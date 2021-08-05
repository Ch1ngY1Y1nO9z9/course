@extends('layouts.default')

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

                <div class="swiper-slide">
                    <img src="/imgs/banner/01.png" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="/imgs/banner/02.png" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="/imgs/banner/03.png" alt="">
                </div>
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
                            台灣已進入高齡社會， 伴隨高齡人口增加， 其在社區中的食衣住行育樂等需求， 也都一一浮現。 長者如何在社區中健康老化？ 活得幸福又快樂？ 因此，
                            具有厚實人文社會關懷底蘊的東海大學， 以建置「開放式養生村」為願景， 連結與整合校內外資源， 創設五大支持系統與樂齡學院， 師生共同進入社區，
                            提升社區長者生心社層面的整體福祉， 環境更友善， 打造３６０度的環繞幸福！
                        </p>
                    </div>
                    <a href="" class="btn btn-sm btn-dark btn-more">更多資訊</a>
                </div>
                <div class="col-md-6">
                    <div class="title">
                        <h3>Goal</h3>
                        <h2>USR理念</h2>
                    </div>
                    <div class="context-right">
                        <span class="badge badge1">關懷</span>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus totam a voluptates
                            impedit cum qu
                        </p>
                        <span class="badge badge2">石岡</span>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus totam a voluptates
                            impedit cum qu
                        </p>
                        <span class="badge badge3">中山</span>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus totam a voluptates
                            impedit cum qu
                        </p>
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
                    <h3>About Us</h3>
                    <h2>關於我們</h2>
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
                <a class="btn btn-dark" href="">校外活動</a>
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
                <a class="btn btn-link" href="#">
                    所有影音
                    <img src="/imgs/icons/more.png" alt="more">
                </a>
            </div>
        </div>
        <div class="video-content">
            <div class="swiper-container videoSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="">
                            <div class="video-slide">
                                <img class="video-img" src="/imgs/video/v-1.jpg" alt="">
                                <div class="video-play">
                                    <img src="/imgs/icons/video-play.png" alt="">
                                </div>
                            </div>
                        </a>
                        <div class="dateTypeLabel">
                            <span class="date">2021/06/12</span><span class="type">校內活動</span>
                        </div>
                        <div class="title">
                            <a href="">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, sit!
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <div class="video-slide">
                                <img class="video-img" src="/imgs/video/v-2.jpg" alt="">
                                <div class="video-play">
                                    <img src="/imgs/icons/video-play.png" alt="">
                                </div>
                            </div>
                        </a>
                        <div class="dateTypeLabel">
                            <span class="date">2021/06/12</span><span class="type">校內活動</span>
                        </div>
                        <div class="title">
                            <a href="">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, sit!
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <div class="video-slide">
                                <img class="video-img" src="/imgs/video/v-3.jpg" alt="">
                                <div class="video-play">
                                    <img src="/imgs/icons/video-play.png" alt="">
                                </div>
                            </div>
                        </a>
                        <div class="dateTypeLabel">
                            <span class="date">2021/06/12</span><span class="type">校內活動</span>
                        </div>
                        <div class="title">
                            <a href="" >
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, sit!
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <div class="video-slide">
                                <img class="video-img" src="/imgs/video/v-1.jpg" alt="">
                                <div class="video-play">
                                    <img src="/imgs/icons/video-play.png" alt="">
                                </div>
                            </div>
                        </a>
                        <div class="dateTypeLabel">
                            <span class="date">2021/06/12</span><span class="type">校內活動</span>
                        </div>
                        <div class="title">
                            <a href="">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, sit!
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <div class="video-slide">
                                <img class="video-img" src="/imgs/video/v-2.jpg" alt="">
                                <div class="video-play">
                                    <img src="/imgs/icons/video-play.png" alt="">
                                </div>
                            </div>
                        </a>
                        <div class="dateTypeLabel">
                            <span class="date">2021/06/12</span><span class="type">校內活動</span>
                        </div>
                        <div class="title">
                            <a href="">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, sit!
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <a href="">
                            <div class="video-slide">
                                <img class="video-img" src="/imgs/video/v-3.jpg" alt="">
                                <div class="video-play">
                                    <img src="/imgs/icons/video-play.png" alt="">
                                </div>
                            </div>
                        </a>
                        <div class="dateTypeLabel">
                            <span class="date">2021/06/12</span><span class="type">校內活動</span>
                        </div>
                        <div class="title">
                            <a href="" >
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, sit!
                            </a>
                        </div>
                    </div>

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
                <a class="btn btn-link" href="">
                    所有檔案
                    <img src="/imgs/icons/more.png" alt="more">
                </a>
            </div>
        </div>
        <div class="download-content">
            <ul>
                <li>
                    <div class="dateTypeLabel">
                        <span class="date">2021/06/12</span>
                    </div>
                    <a href="" class="title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime,
                        sit!</a>
                    <span class="download">
                        <a href="#" target="_blank">
                            <img src="/imgs/icons/download.png" alt="download">
                        </a>
                    </span>
                </li>
                <li>
                    <div class="dateTypeLabel">
                        <span class="date">2021/06/12</span>
                    </div>
                    <a href="" class="title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime,
                        sit!</a>
                    <span class="download">
                        <a href="#" target="_blank">
                            <img src="/imgs/icons/download.png" alt="download">
                        </a>
                    </span>
                </li>
                <li>
                    <div class="dateTypeLabel">
                        <span class="date">2021/06/12</span>
                    </div>
                    <a href="" class="title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime,
                        sit!</a>
                    <span class="download">
                        <a href="#" target="_blank">
                            <img src="/imgs/icons/download.png" alt="download">
                        </a>
                    </span>
                </li>
            </ul>
        </div>
    </div>
</section>

<section id="links-section">
    <div class="container">
        <div class="swiper-container links-Swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a class="title" href="">
                        <img src="/imgs/links-2.png" alt="">
                        <p>
                            《宜居石岡，永續健康》粉專
                        </p>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a class="title" href="">
                        <img src="/imgs/links-1.png" alt="">
                        <p>
                            大學社會責任推動中心
                        </p>
                    </a>
                    
                </div>
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