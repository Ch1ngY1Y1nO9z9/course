@extends('layouts.default')

@section('css')
    <style>
        #menu-4 td{
            line-height: 40px;
            padding-left: 20px;
            font-size: 16px;
        }

        #menu-4 img.img-fluid{
            max-width: 40px;
        }
    </style>
@endsection

@section('content')
    <div class="content container-fluid">
        <table id="menu-4" class="table table-hover table-bordered mt-4" style="box-shadow: 0 2px 3px rgba(0,0,0,.16);">
            <tbody>
            @foreach($lists as $list)
                <tr>
                    <td>
                        {{$list->title}}
                    </td>
                    <td>
                        @foreach($list->download_files as $file)
                            @if($file->ext == 'doc' ||$file->ext == 'docx')
                                <a href="{{$file->url}}" download="{{$file->old_filename}}"><img class="img-fluid" src="/imgs/word-01.png" alt="中山醫學大學 USR計畫 相關法律"></a>
                            @elseif($file->ext == 'pdf')
                                <a href="{{$file->url}}" download="{{$file->old_filename}}"><img class="img-fluid" src="/imgs/pdf-01.png" alt="中山醫學大學 USR計畫 相關法律"></a>
                            @else
                                <a href="{{$file->url}}">{{$file->old_filename}}</a>
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>



@endsection

@section('js')
@endsection