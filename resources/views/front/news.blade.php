@extends('layouts.default')

@section('css')
    <link rel="stylesheet" href="/css/news.css">
@endsection

@section('content')
    <nav class="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">首頁</a></li>
                <li class="breadcrumb-item active" aria-current="page">最新消息</li>
              </ol>
        </div>
    </nav>
    <section id="news-section">
        <div class="content container" style="margin-top: 30px">
            <div class="container">
                <div class="news-nav">
                    <div class="left-nav">
                        <div class="title">
                            <h3>News</h3>
                            <h2>最新消息</h2>
                        </div>
                        
                        <nav>
                            <a class="btn btn-sm {{request()->get('type') == null ? 'btn-dark' : 'btn-secondary'}}" href="/news">全部</a>
                            <a class="btn btn-sm {{request()->get('type') == '課程公告' ? 'btn-dark' : 'btn-secondary'}}" href="/news?type=課程公告">課程公告</a>
                            <a class="btn btn-sm {{request()->get('type') == '校內活動' ? 'btn-dark' : 'btn-secondary'}}" href="/news?type=校內活動">校內活動</a>
                            <a class="btn btn-sm {{request()->get('type') == '場域活動' ? 'btn-dark' : 'btn-secondary'}}" href="/news?type=場域活動">場域活動</a>
                            <a class="btn btn-sm {{request()->get('type') == '其他公告' ? 'btn-dark' : 'btn-secondary'}}" href="/news?type=其他公告">其他公告</a>
                            <a class="btn btn-sm {{request()->get('type') == '資訊轉知' ? 'btn-dark' : 'btn-secondary'}}" href="/news?type=資訊轉知">資訊轉知</a>
                        </nav>
                    </div>
                </div>
                <div class="new-content">
                    <ul>
                        @if(count($articles) == 0)
                            <p>目前沒有最新消息！</p>
                        @endif
                        
                        @foreach($articles as $new)
                            <li>
                                <div class="dateTypeLabel">
                                    <span class="date">{{$new->date}}</span><span class="type">{{$new->plan_type}}</span>
                                </div>
                                <a href="/news/{{$new->id}}" class="title">{{$new->title}}</a>
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