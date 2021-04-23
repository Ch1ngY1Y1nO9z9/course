@extends('layouts.default')

@section('title',$seo->title)
@section('keywords',$seo->keywords)
@section('description',$seo->description)

@section('css')
    <style>
        #search-box{
            margin: 30px 0;
            width: calc(100%);
            border: 1px solid #eee;
            border-left-width: .25rem;
            border-radius: .25rem;
            border-left-color: #65B9B4;
            box-shadow: 0 2px 3px rgba(0,0,0,.16);
        }

        .summer-note-content{
            margin-top:30px;
        }

        .summer-note-content table , .summer-note-content img{
            max-width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="summer-note-content">
        {!! $article->content !!}
    </div>
    @if($route_name=='front_downloads_detail'|| $route_name == 'front_highlight_detail' || $route_name == 'front_promote_detail' || $route_name == 'front_other_detail')
        @if(count($article->download_files)>0)
            <div id="search-box" class="card">
                <div class="card-body">
                    <h5>下載附件:</h5>
                    @foreach($article->download_files as $file)
                        <a style="margin-right: 5px" href="{{$file->url}}" download="{{$file->old_filename}}">
                            @if($file->ext == 'docx' || $file->ext == 'doc' ||$file->ext == 'odt')
                                <img class="img-fluid" width="40" src="/imgs/word-01.png" alt="修平 高教深耕計畫 相關法律">
                            @elseif($file->ext == 'pdf')
                                <img class="img-fluid" width="40" src="/imgs/pdf-01.png" alt="修平 高教深耕計畫 相關法律">
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
    </script>
@endsection