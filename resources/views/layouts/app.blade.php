<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @auth
                        <li><a href="/admin/seo">SEO設定</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                首頁相關 <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/admin/banner">Banner</a></li>
                                <li><a href="/admin/important">重要公告</a></li>
                                <li><a href="/admin/activity">活動記錄</a></li>
                                <li><a href="/admin/youtube_video">影音錦囊</a></li>
                                <li class="divider"></li>
                                <li><a href="/admin/plan_page/5">其他相關連結</a></li>
                            </ul>
                        </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    高教深耕計畫 <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="/admin/plan_page/1">計畫架構</a></li>
                                    <li><a href="/admin/plan_page/2">計畫主軸</a></li>
                                    <li><a href="/admin/plan_page/3">計畫管考</a></li>
                                    <li><a href="/admin/plan_page/4">團隊介紹</a></li>
                                    <li><a href="/admin/plan_page_related_legislation">相關法規</a></li>
                                </ul>
                            </li>
                        <li><a href="/admin/news">最新消息</a></li>
                        <li><a href="/admin/result">計畫成果</a></li>
                        <li><a href="/admin/honor">師生榮譽榜</a></li>
                        <li><a href="/admin/video">影音專區</a></li>
                        <li><a href="/admin/download">下載專區</a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                宣傳專區 <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/admin/highlight">特色亮點成果</a></li>
                                <li><a href="/admin/promote">宣傳品</a></li>
                                <li><a href="/admin/other">其他</a></li>
                            </ul>
                        </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="/admin/reset_password">更改密碼</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>
</html>
