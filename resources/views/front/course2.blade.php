@extends('layouts.default')

@section('css')
    <link rel="stylesheet" href="/css/news.css">
    <link rel="stylesheet" href="/css/video.css">
@endsection

@section('content')
    <nav class="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">首頁</a></li>
                <li class="breadcrumb-item active" aria-current="page">課程專區 - 微學分課程</li>
              </ol>
        </div>
    </nav>
    <section id="news-section">
        <div class="content container" style="margin-top: 30px">
            <div class="container">
                <div class="news-nav">
                    <div class="left-nav">
                        <div class="title">
                            <h3>Course</h3>
                            <h2>課程專區 - 微學分課程</h2>
                        </div>

                        <nav>
                            <a class="btn btn-sm {{request()->get('type') == null ? 'btn-dark' : 'btn-secondary'}}" href="/course2">全部</a>
                            <a class="btn btn-sm {{request()->get('type') == '課程公告' ? 'btn-dark' : 'btn-secondary'}}" href="/course2?type=課程公告">課程公告</a>
                            <a class="btn btn-sm {{request()->get('type') == '課程成果' ? 'btn-dark' : 'btn-secondary'}}" href="/course2?type=課程成果">課程成果</a>
                        </nav>
                    </div>
                </div>
                <div class="video-content">
                    <div class="row">
                        @if(count($articles) == 0)
                            <p>目前沒有上傳課程相關內容！</p>
                        @endif
                        @foreach($articles as $course)
                            <div class="col-md-4 mb-3">
                                <a href="/course/{{$course->id}}">
                                        <div class="video-slide">
                                            @foreach($course->download_files as $file)
                                                @if ($loop->first)
                                                    <img class="video-img" src="{{$file->url}}" alt="">
                                                @endif
                                            @endforeach
                                        </div>
                                    </a>
                                    <div class="dateTypeLabel">
                                        <span class="date">{{$course->date}}</span>
                                        <span class="type float-right">{{$course->plan_type}}</span>
                                    </div>
                                    <div class="title">
                                        <a href="/course/{{{{$course->id}}}}">
                                            {{$course->title}}
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