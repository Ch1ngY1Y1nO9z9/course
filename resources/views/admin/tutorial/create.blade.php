@extends('layouts.app')
@section('css')

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">課程主軸管理 - 新增</h3>
                    </div>
                    <div class="card-body">
                        <a href="javascript:history.back()">
                            <button type="submit" class="btn btn-success">返回</button>
                        </a>
                        <hr>
                        <form class="form-horizontal" method="POST" action="/admin/tutorial/store" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group row">
                                <label for="tutorial_name_cn" class="col-sm-2 control-label">課程名稱(中)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tutorial_name_cn" name="tutorial_name_cn" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tutorial_name_en" class="col-sm-2 control-label">課程名稱(英)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tutorial_name_en" name="tutorial_name_en" required>
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <label for="tutorials_type" class="col-sm-2 control-label">單元類別</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="tutorials_type" name="tutorials_type" required>
                                        <option selected hidden>-</option>
                                        <option>授課</option>
                                        <option>講座</option>
                                        <option>工作坊</option>
                                        <option>實作活動</option>
                                        <option>其他</option>
                                      </select>
                                </div>
                            </div> --}}

                            <div class="form-group row">
                                <label for="organizer" class="col-sm-2 control-label">主辦單位</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="organizer" name="organizer" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sort" class="col-sm-2 control-label">排序</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="sort" name="sort" value="0" min="0" required>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-success">新增</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection