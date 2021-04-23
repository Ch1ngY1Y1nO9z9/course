@extends('layouts.default')

@section('title',$seo->title)
@section('keywords',$seo->keywords)
@section('description',$seo->description)

@section('css')
    <style>
        .sen1 {
            margin-bottom: 30px;
        }

        .sen2 {
            margin-bottom: 50px;
        }

        .sen1_top {
            border-bottom: 1px solid #dee2e6;
        }

        .sen2_top ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .sen2_top li {
            display: inline-block;
            width: 200px;
            max-width: calc(50% - 10px);
        }

        .sen1_bottom,
        .sen2_bottom {
            width: 100%;
        }

        .sen1_bottom ul,
        .sen2_bottom ul {
            padding-left: 13px;
            list-style: none;
            margin-top: 10px;
        }

        .sen1_bottom ul li,
        .sen2_bottom ul li {
            border-bottom: solid 1px gray;
            padding: 3px 0;
        }

        .sen1_bottom ul li a,
        .sen2_bottom ul li a{
            color: rgba(0, 0, 0, 0.71);

        }

        .sen1_bottom ul li::before,.sen2_bottom ul li::before {
            content: "•";
            color: #ebaa2c;
            display: inline-block;
            width: 1em;
        }

        .sen3_top,
        .sen4_top {
            width: 100%;
            max-width: 100%;

        }

        .sen3_bottom,
        .sen4_bottom {
            padding:10px 15px;
            height: 100%;
            width: 100%;
            background-color: #EEEEEE;
            margin-bottom: 30px;
        }

        .sen4_bottom iframe{
            width: 100%;
        }

        .images-banner-bg-div{
            height: 280px;
            width: 100%;
            background-size: cover;
        }
    </style>
@endsection

@section('content')
    <div class="sen1">
        <div class="sen1_top" title="師生榮譽榜">
            <img height="63" src="/imgs/panel_honors_title.png" alt="修平 高教深耕 師生榮譽榜 標題">
        </div>
        <div class="sen1_bottom">
            <ul>
                @foreach($honors as $honor)
                    <li><a href="/honors/{{$honor->id}}">{{$honor->title}}
                            <span class="float-right">【{{$honor->date}}】</span>
                            <div style="clear: both;"></div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <span style="margin-top: -15px;margin-right: 10px" class="float-right"><a style="color: rgba(0, 0, 0, 0.71)" href="/honors">more</a></span>
    </div>
    <div class="sen2">
        <div class="sen2_top">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" title="最新消息">
                    <a class="active" id="news-tab" data-toggle="tab" href="#news" role="tab" aria-controls="news" aria-selected="true">
                        <img class="img-fluid" src="/imgs/panel_news_title.png" alt="修平 高教深耕 最新消息 標題">
                    </a>
                </li>
                <li class="nav-item" title="計畫成果">
                    <a id="plan-tab" data-toggle="tab" href="#plan" role="tab" aria-controls="plan" aria-selected="false">
                        <img class="img-fluid" src="/imgs/panel_plan_title.png" alt="修平 高教深耕 計畫成果 標題">
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="news" role="tabpanel" aria-labelledby="news-tab">
                <div class="sen2_bottom">
                    <ul>
                        @foreach($news as $new)
                            <li>
                                <a href="/news/{{$new->id}}">{{$new->title}}
                                    <span class="float-right">【{{$new->date}}】</span>
                                    <div style="clear: both;"></div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <span style="margin-top: -15px;margin-right: 10px" class="float-right"><a style="color: rgba(0, 0, 0, 0.71)" href="/news">more</a></span>
            </div>
            <div class="tab-pane fade" id="plan" role="tabpanel" aria-labelledby="plan-tab">
                <div class="sen2_bottom">
                    <ul>
                        @foreach($results as $result)
                            <li>
                                <a href="/plan_results/{{$result->id}}">{{$result->title}}</a>
                                <span class="float-right">【{{$result->date}}】</span>
                                <div style="clear: both;"></div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <span style="margin-top: -15px;margin-right: 10px" class="float-right"><a style="color: rgba(0, 0, 0, 0.71)" href="/plan_results">more</a></span>

            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="sen4">
                <div class="sen4_top" style="position: relative">
                    <img class="img-fluid" src="/imgs/panel_video_title2.png" alt="修平 高教深耕 影音集錦 標題">
                    <a style="position: absolute;right: 20px;top: 20px;font-size: 16px;color: white;letter-spacing: 1px;" href="https://hesphust.hust.edu.tw/video">MORE</a>
                </div>


                <?php
                parse_str( parse_url( $youtube_url->title, PHP_URL_QUERY ), $my_array_of_vars );
                ?>
                <div class="sen4_bottom" style="height: 300px">
                    <iframe height="280" src="https://www.youtube.com/embed/{{$my_array_of_vars['v']}}" frameborder="0" allow="autoplay; encrypted-media"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-6">
            <div class="sen3">
                <div class="sen3_top">
                    <img class="img-fluid" src="/imgs/panel_video_title1.png" alt="修平 高教深耕 活動紀錄 標題">
                </div>
                <div class="sen3_bottom" style="height: 300px">
                    <div id="images-banner" class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach($imgnews_index as $imgnew)
                                <div class="swiper-slide">
                                    <a style="width: 100%" href="{{$imgnew->link}}">
                                        <div class="images-banner-bg-div" style="background-image: url('{{$imgnew->image_url}}')">
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        var swiper = new Swiper('#images-banner', {
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
@endsection