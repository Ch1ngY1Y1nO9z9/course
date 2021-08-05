@extends('layouts.default')

@section('css')
    <style>
        .cascading{
            list-style: none;
            margin: 1.3em 0;
            padding: 2em 0;
            background: #f3f5f6;
        }

        .cascading>li:nth-child(4n+1) {
            margin-left: 4%;
        }
        .sitemap>ul>li {
            line-height: 1.6;
            list-style: square;
            margin-bottom: .6em;
        }
        .cascading>li {
            margin: 0 1%;
            padding: 0 0 2.7em;
            display: inline-block;
            vertical-align: top;
            width: 28%;
        }
        .cascading>li>a {
            font-size: 1.2em;
            border-bottom: 3px solid #ac2;
            color: #333;
            padding-bottom: .1em;
            margin-bottom: .25em;
        }
        .cascading li a {
            display: block;
            padding: .35em .3em;
        }
        .cascading>li>ul {
            margin-left: 0;
        }
        .cascading ul {
            list-style: none;
            margin: 0 0 .6em 0;
            padding: 0;
            line-height: 1.3;
        }
        .cascading>li>ul>li {
            text-indent: -2em;
            padding-left: 2em;
        }
        .cascading li a {
            display: block;
            padding: .35em .3em;
        }
        a {
            text-decoration: none;
            color: #555;
        }
        .cascading a:hover {
            text-decoration: underline;
            color: #0af;
        }

        @media (max-width: 800px) {
            .cascading>li {
                width: 90%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="content container-fluid" style="margin-top: 30px">
        <ul class="cascading">
            <li>
                <a href="#" title="中山醫學大學科技大學 USR計畫">USR計畫</a>
                <ul>
                    <li>
                        <a href="/plan_architecture" title="計畫架構">1. 計畫架構</a>
                    </li>
                    <li>
                        <a href="/plan_spindle" title="計畫架構">2. 計畫主軸</a>
                    </li>
                    <li>
                        <a href="/plan_test" title="計畫架構">3. 計畫管考</a>
                    </li>
                    <li>
                        <a href="/team_introduction" title="計畫架構">4. 團隊介紹</a>
                    </li>
                    <li>
                        <a href="/related_legislation" title="計畫架構">5. 相關法規</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#" title="中山醫學大學科技大學 USR計畫">網站總覽</a>
                <ul>
                    <li>
                        <a href="/news" title="最新消息">1. 最新消息</a>
                    </li>
                    <li>
                        <a href="/plan_results" title="成果專區">2. 成果專區</a>
                    </li>
                    <li>
                        <a href="/video" title="媒體頻道">3. 媒體頻道</a>
                    </li>
                    <li>
                        <a href="/activity_calendar" title="活動行事曆">4. 活動行事曆</a>
                    </li>
                    <li>
                        <a href="/honors" title="師生榮譽榜">5. 師生榮譽榜</a>
                    </li>
                    <li>
                        <a href="/downloads" title="下載專區">6. 下載專區</a>
                    </li>
                    <li>
                        <a href="#" title="宣傳專區">7. 宣傳專區</a>
                        <ul style="margin-left: 20px">
                            <li>
                                <a href="/highlight">7.1 特色亮點成果</a>
                            </li>
                            <li>
                                <a href="/promote">7.2 宣傳品</a>
                            </li>
                            <li>
                                <a href="/other">7.3 其他</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
@endsection

@section('js')
@endsection