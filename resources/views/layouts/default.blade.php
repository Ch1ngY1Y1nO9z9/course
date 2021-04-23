<!DOCTYPE html>
<html lang="zh-TW">
<head>

    <?php
        $default_seo=\App\Seo::where('page','default')->first();
        $countNumbers=\App\WebCount::pluck('ip');
        $countNumbers=count($countNumbers->toArray())+ 5000;
    ?>


    <meta charset="utf-8">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="@yield('keywords', $default_seo->keywords)"/>
    <meta name="description" content="@yield('description', $default_seo->description)"/>
    <meta property="og:url"           content="@yield('og_url', '')"/>
    <meta property="og:type"          content="@yield('og_type', 'website')" />
    <meta property="og:site_name"     content="@yield('og:site_name','')" />
    <meta property="og:title"         content="@yield('og_title','')" />
    <meta property="og:description"   content="@yield('og_description','')" />
    <meta property="og:image"         content="@yield('og_image', '')" />

    <!-- csrf-token meta -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.0/css/swiper.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <title>@yield('title', $default_seo->title)</title>

        <style>
            body {
                font-family: Arial, "微軟正黑體", "Microsoft JhengHei", "文泉驛正黑", "WenQuanYi Zen Hei", "儷黑 Pro", "LiHei Pro", "標楷體", DFKai-SB, sans-serif;
                background-image: url("/imgs/background.jpg");
            }
            .allcontainer {
                background-color: white;
            }
            .nav_top {
                height: 10px;
                background-color: #65B9B4;
            }

            .logo_sen {
                height: 100px;
                position: relative;
            }

            .logo_sen ul {
                list-style: none;
                text-align: right;
                margin: 0;
            }

            .logo_sen li {
                display: inline-block;
                
            }

            .logo_sen li a{
                border-left: solid 1px black;
                color: #000;
                font-size: 14px;
                font-weight: 900;
                margin: 5px 5px;
                padding-left: 10px;
            }

            .logo_sen li:first-child a{
                border-left: none;
            }

            .logo {
                margin-top: 20px;
                width: 500px;
                max-width: 100%;
                display: inline-block;
                position: absolute;
                top: 0;
            }

            .main-nav {
                height: 135px;
                background: linear-gradient(to bottom, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 1) 35%, rgba(255, 255, 255, 1) 35%, rgba(101, 185, 180, 1) 35%, rgba(101, 185, 180, 1) 35%, rgba(101, 185, 180, 1) 100%);
            }

            .main-nav ul {
                list-style: none;
                text-align: center;
                margin: 0;
                position: relative;
            }

            .main-nav li {
                display: inline-block;
                margin: 5px 30px;
            }

            .main-nav ul li img {
                width: 80px;

            }

            .li1, .li2, .li3, .li4, .li5, .li6, .li7 {
                position: relative;
            }

            .li1 p, .li2 p, .li3 p, .li4 p, .li5 p, .li6 p, .li7 p {
                position: absolute;
                width: 105px;
                top: 90px;
                left: -13px;
                letter-spacing: 2px;
                color: white;
                font-weight: 700;
                text-align: center;
            }

            .swiper-container {
                width: 100%;
            }

            .swiper-slide {
                text-align: center;
                font-size: 18px;
                background: #fff;
                /* Center slide text vertically */
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .swiper-button-next, .swiper-container-rtl .swiper-button-prev ,.swiper-button-prev, .swiper-container-rtl .swiper-button-next{
                background-image: none;
                height: 100%;
                top:22px;
                display: flex;
                align-items: center;
                justify-content: center;
                width: 80px;
                background-color: transparent;
                color: rgba(255, 255, 255, 0.67);
                transition: 0.5s;
            }

            .swiper-button-next:hover, .swiper-container-rtl:hover .swiper-button-prev:hover ,.swiper-button-prev:hover, .swiper-container-rtl:hover .swiper-button-next:hover{
                background-color: rgba(140, 140, 140, 0.5);
            }

            .swiper-button-next, .swiper-container-rtl .swiper-button-prev{
                right: 0;
            }

            .swiper-button-prev, .swiper-container-rtl .swiper-button-next{
                left: 0;
            }

            .banner-down {
                background-color: #65B9B4;
                height: 10px;
                margin-bottom: 30px;
            }

            .main_right {
                top: -22px;
            }

            .meun {
                margin-bottom: 30px;
            }

            .menu1, .menu2, .menu3, .menu4, .menu5, .menu6 {
                width: 100%;
                margin-bottom: 5px;
            }

            .important_sen{
                width: 100%;
                margin-bottom: 30px;
            }

            .footer {
                padding: 10px 0;
                color: white;
                background-color: #65B9B4;
            }

            .footer p {
                margin: 0;
                text-align: center;
                font-size: 14px;
                font-weight: 500;
            }

            #mobile-nav{
                display: none;
            }

            #main-container{
                box-shadow: 2px 4px 13px 4px rgba(132, 132, 137, 0.5);
                padding: 0;
            }

            .li7:hover .li7-collapse{
                display: block;
            }

            .li7-collapse{
                position: absolute;
                top: 115px;
                right: 0;
                z-index: 99;
                display: none;
            }

            .li7-collapse a{
                width: 150px;
                margin: 0;
                padding: 10px;
                z-index: 99;
            }

        </style>

        <style>
            @media (min-width: 1400px) {
                .container {
                    max-width: 1330px;
                }
            }

            @media (max-width: 1221px) {
                .logo_sen{
                    height: auto;
                }
                .main-nav , .logo{
                    display: none;
                }

                #mobile-nav{
                    display: block;
                }

                .swiper-button-next, .swiper-container-rtl .swiper-button-prev ,.swiper-button-prev, .swiper-container-rtl .swiper-button-next{
                    width: 15px;
                    font-size: 0.25em;
                }
            }

            @media (max-width: 460px) {
                .logo_sen{
                    display: none;
                }
            }
        </style>

    @yield('css')
</head>
<body>

<div class="container" id="main-container">
<div class="allcontainer">
<div class="nav_top"></div>
<div class="logo_sen">
    <div class="container">
        <ul>
            <li>
                <a href="/">回到首頁</a>
            </li>
            <li>
                <a href="http://www.hust.edu.tw/">修平首頁</a>
            </li>
            <li>
                <a href="/site_maps">網站地圖</a>
            </li>
            <li>
                <a href="/others_link">相關連結</a>
            </li>
        </ul>
        <div class="logo">
            <a href="/">
                <img class="img-fluid" src="/imgs/LOGO-HUST.gif" alt="修平科技大學 高等教育深耕計畫">
            </a>
        </div>
    </div>
</div>

<nav id="mobile-nav" class="navbar navbar-expand-xl navbar-light" style="background-color: #fff">
    <div class="container">
        <a class="navbar-brand" href="/" style="max-width: calc(100% - 80px);">
            <img class="img-fluid" src="/imgs/logo.gif" alt="修平科技大學 高等教育深耕計畫">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/news">最新消息</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/plan_results">計畫成果</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/video">影音專區</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/activity_calendar">活動行事曆</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/honors">師生榮譽榜</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/downloads">下載專區</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        宣傳專區
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/highlight">特色宣傳成果</a>
                        <a class="dropdown-item" href="/promote">宣傳品</a>
                        <a class="dropdown-item" href="/other">其他</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<nav class="main-nav">
    <ul>
        <li>
            <a href="/news" title="最新消息">
                <div class="li1">
                    <img class="img-fluid" src="/imgs/nav_news.png"
                         onmouseover="this.src='/imgs/nav_news_hover.png';"
                         onmouseout="this.src='/imgs/nav_news.png';"
                         alt="修平 高教深耕 最新消息">
                    <p>最新消息</p>
                </div>
            </a>
        </li>
        <li>
            <a href="/plan_results" title="計畫成果">
                <div class="li2">
                    <img class="img-fluid" src="/imgs/nav_plan_results.png"
                         onmouseover="this.src='/imgs/nav_plan_results_hover.png';"
                         onmouseout="this.src='/imgs/nav_plan_results.png';"
                         alt="修平 高教深耕 計畫成果">
                    <p>計畫成果</p>
                </div>
            </a>
        </li>
        <li>
            <a href="/video">
                <div class="li3">
                    <img class="img-fluid" src="/imgs/nav_video.png"
                         onmouseover="this.src='/imgs/nav_video_hover.png';"
                         onmouseout="this.src='/imgs/nav_video.png';"
                         alt="修平 高教深耕 影音專區">
                    <p>影音專區</p>
                </div>
            </a>
        </li>
        <li>
            <a href="/activity_calendar">
                <div class="li4">
                    <img class="img-fluid" src="/imgs/nav_activity_calendar.png"
                         onmouseover="this.src='/imgs/nav_activity_calendar_hover.png';"
                         onmouseout="this.src='/imgs/nav_activity_calendar.png';"
                         alt="修平 高教深耕 活動行事曆">
                    <p>活動行事曆</p>
                </div>
            </a>
        </li>
        <li>
            <a href="/honors">
                <div class="li5">
                    <img class="img-fluid" src="/imgs/nav_honors.png"
                         onmouseover="this.src='/imgs/nav_honors_hover.png';"
                         onmouseout="this.src='/imgs/nav_honors.png';"
                         alt="修平 高教深耕 師生榮譽榜">
                    <p>師生榮譽榜</p>
                </div>
            </a>
        </li>
        <li>
            <a href="/downloads">
                <div class="li6">
                    <img class="img-fluid" src="/imgs/nav_downloads.png"
                         onmouseover="this.src='/imgs/nav_downloads_hover.png';"
                         onmouseout="this.src='/imgs/nav_downloads.png';"
                         alt="修平 高教深耕 下載專區">
                    <p>下載專區</p>
                </div>
            </a>
        </li>
        <li>
            <div class="li7">
                <img class="img-fluid" src="/imgs/nav_publicity_area.png"
                     onmouseover="this.src='/imgs/nav_publicity_area_hover.png';"
                     onmouseout="this.src='/imgs/nav_publicity_area.png';"
                     alt="修平 高教深耕 宣傳專區">
                <p>宣傳專區</p>

                <div class="li7-collapse">
                    <ul class="list-group">
                        <a href="/highlight" class="list-group-item list-group-item-action">特色亮點成果</a>
                        <a href="/promote" class="list-group-item list-group-item-action">宣傳品</a>
                        <a href="/other" class="list-group-item list-group-item-action">其他</a>
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</nav>

<div class="banner">
    <div id="main-banner" class="swiper-container">
        <div class="swiper-wrapper">
            @foreach($banners as $banner)
                <div class="swiper-slide">
                    <a href="{{$banner->slider_a_href}}"><img class="img-fluid" src="{{$banner->slider_url}}" alt="{{$banner->slider_alt}}"></a>
                </div>
            @endforeach
            {{--<div class="swiper-slide">--}}
                {{--<img class="img-fluid" src="/imgs/banner1.jpg" alt="修平 高教深耕 首頁輪播圖片">--}}
            {{--</div>--}}
            {{--<div class="swiper-slide">--}}
                {{--<img class="img-fluid" src="/imgs/banner2.jpg" alt="修平 高教深耕 首頁輪播圖片">--}}
            {{--</div>--}}
            {{--<div class="swiper-slide">--}}
                {{--<img class="img-fluid" src="/imgs/banner3.jpg" alt="修平 高教深耕 首頁輪播圖片">--}}
            {{--</div>--}}
        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next">
            <i class="fas fa-caret-right fa-5x"></i>
        </div>
        <div class="swiper-button-prev">
            <i class="fas fa-caret-left fa-5x"></i>
        </div>
    </div>
</div>

<div class="banner-down"></div>
    <div class="main container-fluid">
        <div class="row">
            <div class="col-md-3 main_left flex-column">
                <div class="meun">
                    <div class="menu1">
                        <img class="img-fluid" src="/imgs/menu02-01.png" alt="修平 高教深耕計畫 標題">
                    </div>
                    <div class="menu2">
                        <a href="/plan_architecture" title="計畫架構">
                            <img class="img-fluid" src="/imgs/menu02-02.png"
                                 onmouseover="this.src='/imgs/menu02-02_hover.png';"
                                 onmouseout="this.src='/imgs/menu02-02.png';"
                                 alt="修平 高教深耕計畫 計畫架構">
                        </a>
                    </div>
                    <div class="menu3">
                        <a href="/plan_spindle" title="計畫主軸">
                            <img class="img-fluid" src="/imgs/menu02-03.png"
                                 onmouseover="this.src='/imgs/menu02-03_hover.png';"
                                 onmouseout="this.src='/imgs/menu02-03.png';"
                                 alt="修平 高教深耕計畫 計畫主軸">
                        </a>
                    </div>
                    <div class="menu4">
                        <a href="/plan_test" title="計畫管考">
                            <img class="img-fluid" src="/imgs/menu02-04.png"
                                 onmouseover="this.src='/imgs/menu02-04_hover.png';"
                                 onmouseout="this.src='/imgs/menu02-04.png';"
                                 alt="修平 高教深耕計畫 計畫管考">
                        </a>
                    </div>
                    <div class="menu5">
                        <a href="/team_introduction" title="團隊介紹">
                            <img class="img-fluid" src="/imgs/menu02-05.png"
                                 onmouseover="this.src='/imgs/menu02-05_hover.png';"
                                 onmouseout="this.src='/imgs/menu02-05.png';"
                                 alt="修平 高教深耕計畫 團隊介紹">
                        </a>
                    </div>
                    <div class="menu6">
                        <a href="/related_legislation" title="相關法規">
                            <img class="img-fluid" src="/imgs/menu02-06.png"
                                 onmouseover="this.src='/imgs/menu02-06_hover.png';"
                                 onmouseout="this.src='/imgs/menu02-06.png';"
                                 alt="修平 高教深耕計畫 相關法規">
                        </a>
                    </div>
                </div>

                <div class="important_news">
                    @foreach($imgnews as $imgnew)
                        <div class="swiper-container important-news-swiper-container">
                            <div class="swiper-wrapper">
                                @if($imgnew->image_url != null)
                                    @foreach($imgnew->image_url as $url)
                                        <div class="swiper-slide">
                                            <div class="important_sen">
                                                <a href="{{$imgnew->link}}">
                                                    <img class="img-fluid" src="{!! $url['url']!!}">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                    {{--<div class="important_sen">--}}
                        {{--<a href="#">--}}
                            {{--<img class="img-fluid" src="/imgs/ad_pic1.jpg" alt="">--}}
                        {{--</a>--}}
                    {{--</div>--}}
                    {{--<div class="important_sen">--}}
                        {{--<a href="#">--}}
                            {{--<img class="img-fluid" src="/imgs/ad_pic2.jpg" alt="">--}}
                        {{--</a>--}}
                    {{--</div>--}}
                </div>

            </div>
            <div class="col-md-9 main_right">
                @yield('content')

            </div>
        </div>
    </div>

    <div class="footer">
        <p>網站瀏覽人數：<span>{{$countNumbers}}</span></p>
        <p>地址：412-80台中市大里區工業路11號&nbsp;&nbsp;統一編號：52006700</p>
        <p>電話：+886-4-2496-1100．FAX：+886-4-2496-1187</p>
        <p>網站維護：修平高等教育深耕計畫人員</p>
        <p>Copyright © 2018, Hsiuping University of Science and Technology - All rights reserved</p>
    </div>

    <!-- WhatsHelp.io widget -->
    <script type="text/javascript">
        (function () {
            var options = {
                facebook: "297901500020", // Facebook page ID
                line: "//line.me/R/ti/p/R5SJ9jW7tY", // Line QR code URL
                company_logo_url: "//storage.whatshelp.io/widget/c8/c829/c82958045e7a3b6a096f19a61efabc2c/10926201_10153720693430021_8579223621001086037_n.png", // URL of company logo (png, jpg, gif)
                greeting_message: "有什麼需要幫助的嗎？\n點擊下面按鈕來聯絡我們～", // Text of greeting message
                call_to_action: "聯絡我們", // Call to action
                button_color: "#65B9B4", // Color of button
                position: "right", // Position may be 'right' or 'left'
                order: "line,facebook" // Order of buttons
            };
            var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
            var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
            s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
            var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
        })();
    </script>
    <!-- /WhatsHelp.io widget -->
</div>
</div>


<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.0/js/swiper.min.js"></script>

<script>
    var swiper = new Swiper('#main-banner', {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });

    var swiper = new Swiper('.important-news-swiper-container', {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-52997245-6"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-52997245-6');
</script>


@yield('js')

</body>
</html>