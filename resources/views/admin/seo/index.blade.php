@extends('layouts.app') @section('css')
<style>
    .card {
        margin-bottom: 30px;
    }
</style>
@endsection @section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-10 offset-sm-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SEO管理 - 預設/通用值</h3>
                </div>
                <div class="card-body">
                    <form action="/admin/seo/update/default" method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                        <div class="col-sm-12">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" value="{{ $seo_default['title'] }}" name="title" />
                        </div>
                        <div class="col-sm-12">
                            <label for="keyword">keywords</label>
                            <textarea class="form-control" name="keywords" cols="30"
                                rows="4">{{ $seo_default["keywords"] }}</textarea>
                        </div>
                        <div class="col-sm-12">
                            <label for="keyword">description</label>
                            <textarea class="form-control" name="description" cols="30"
                                rows="4">{{ $seo_default["description"] }}</textarea>
                        </div>
                        <div class="center-block text-center">
                            <button style="margin-top: 15px" class="btn btn-primary">
                                更新此SEO
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SEO管理 - 首頁</h3>
                </div>
                <div class="card-body">
                    <form action="/admin/seo/update/index" method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                        <div class="col-sm-12">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" value="{{ $seo_index['title'] }}" name="title" />
                        </div>
                        <div class="col-sm-12">
                            <label for="keyword">keywords</label>
                            <textarea class="form-control" name="keywords" cols="30"
                                rows="4">{{ $seo_index["keywords"] }}</textarea>
                        </div>
                        <div class="col-sm-12">
                            <label for="keyword">description</label>
                            <textarea class="form-control" name="description" cols="30"
                                rows="4">{{ $seo_index["description"] }}</textarea>
                        </div>
                        <div class="center-block text-center">
                            <button style="margin-top: 15px" class="btn btn-primary">
                                更新此SEO
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SEO管理 - 最新消息</h3>
                </div>
                <div class="card-body">
                    <form action="/admin/seo/update/news" method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                        <div class="col-sm-12">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" value="{{ $seo_news['title'] }}" name="title" />
                        </div>
                        <div class="col-sm-12">
                            <label for="keyword">keywords</label>
                            <textarea class="form-control" name="keywords" cols="30"
                                rows="4">{{ $seo_news["keywords"] }}</textarea>
                        </div>
                        <div class="col-sm-12">
                            <label for="keyword">description</label>
                            <textarea class="form-control" name="description" cols="30"
                                rows="4">{{ $seo_news["description"] }}</textarea>
                        </div>
                        <div class="center-block text-center">
                            <button style="margin-top: 15px" class="btn btn-primary">
                                更新此SEO
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SEO管理 - 成果專區</h3>
                </div>
                <div class="card-body">
                    <form action="/admin/seo/update/plan_results" method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                        <div class="col-sm-12">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" value="{{ $seo_plan_results['title'] }}"
                                name="title" />
                        </div>
                        <div class="col-sm-12">
                            <label for="keyword">keywords</label>
                            <textarea class="form-control" name="keywords" cols="30" rows="4">{{
                                        $seo_plan_results["keywords"]
                                    }}</textarea>
                        </div>
                        <div class="col-sm-12">
                            <label for="keyword">description</label>
                            <textarea class="form-control" name="description" cols="30" rows="4">{{
                                        $seo_plan_results["description"]
                                    }}</textarea>
                        </div>
                        <div class="center-block text-center">
                            <button style="margin-top: 15px" class="btn btn-primary">
                                更新此SEO
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SEO管理 - 媒體頻道</h3>
                </div>
                <div class="card-body">
                    <form action="/admin/seo/update/video" method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                        <div class="col-sm-12">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" value="{{ $seo_video['title'] }}" name="title" />
                        </div>
                        <div class="col-sm-12">
                            <label for="keyword">keywords</label>
                            <textarea class="form-control" name="keywords" cols="30"
                                rows="4">{{ $seo_video["keywords"] }}</textarea>
                        </div>
                        <div class="col-sm-12">
                            <label for="keyword">description</label>
                            <textarea class="form-control" name="description" cols="30"
                                rows="4">{{ $seo_video["description"] }}</textarea>
                        </div>
                        <div class="center-block text-center">
                            <button style="margin-top: 15px" class="btn btn-primary">
                                更新此SEO
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SEO管理 - 活動行事曆</h3>
                </div>
                <div class="card-body">
                    <form action="/admin/seo/update/activity_calendar" method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                        <div class="col-sm-12">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" value="{{
                                        $seo_activity_calendar['title']
                                    }}" name="title" />
                        </div>
                        <div class="col-sm-12">
                            <label for="keyword">keywords</label>
                            <textarea class="form-control" name="keywords" cols="30" rows="4">{{
                                        $seo_activity_calendar["keywords"]
                                    }}</textarea>
                        </div>
                        <div class="col-sm-12">
                            <label for="keyword">description</label>
                            <textarea class="form-control" name="description" cols="30" rows="4">{{
                                        $seo_activity_calendar["description"]
                                    }}</textarea>
                        </div>
                        <div class="center-block text-center">
                            <button style="margin-top: 15px" class="btn btn-primary">
                                更新此SEO
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SEO管理 - 師生榮譽榜</h3>
                </div>
                <div class="card-body">
                    <form action="/admin/seo/update/honors" method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                        <div class="col-sm-12">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" value="{{ $seo_honors['title'] }}" name="title" />
                        </div>
                        <div class="col-sm-12">
                            <label for="keyword">keywords</label>
                            <textarea class="form-control" name="keywords" cols="30"
                                rows="4">{{ $seo_honors["keywords"] }}</textarea>
                        </div>
                        <div class="col-sm-12">
                            <label for="keyword">description</label>
                            <textarea class="form-control" name="description" cols="30"
                                rows="4">{{ $seo_honors["description"] }}</textarea>
                        </div>
                        <div class="center-block text-center">
                            <button style="margin-top: 15px" class="btn btn-primary">
                                更新此SEO
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SEO管理 - 下載專區</h3>
                </div>
                <div class="card-body">
                    <form action="/admin/seo/update/downloads" method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                        <div class="col-sm-12">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" value="{{ $seo_downloads['title'] }}"
                                name="title" />
                        </div>
                        <div class="col-sm-12">
                            <label for="keyword">keywords</label>
                            <textarea class="form-control" name="keywords" cols="30"
                                rows="4">{{ $seo_downloads["keywords"] }}</textarea>
                        </div>
                        <div class="col-sm-12">
                            <label for="keyword">description</label>
                            <textarea class="form-control" name="description" cols="30" rows="4">{{
                                        $seo_downloads["description"]
                                    }}</textarea>
                        </div>
                        <div class="center-block text-center">
                            <button style="margin-top: 15px" class="btn btn-primary">
                                更新此SEO
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">SEO管理 - 宣傳專區</h3>
                </div>
                <div class="card-body">
                    <form action="/admin/seo/update/publicity_area" method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                        <div class="col-sm-12">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" value="{{ $seo_publicity_area['title'] }}"
                                name="title" />
                        </div>
                        <div class="col-sm-12">
                            <label for="keyword">keywords</label>
                            <textarea class="form-control" name="keywords" cols="30" rows="4">{{
                                        $seo_publicity_area["keywords"]
                                    }}</textarea>
                        </div>
                        <div class="col-sm-12">
                            <label for="keyword">description</label>
                            <textarea class="form-control" name="description" cols="30" rows="4">{{
                                        $seo_publicity_area["description"]
                                    }}</textarea>
                        </div>
                        <div class="center-block text-center">
                            <button style="margin-top: 15px" class="btn btn-primary">
                                更新此SEO
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('js') @endsection