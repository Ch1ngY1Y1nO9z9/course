@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">應用物理學 - 4/26 線上點名</h3>
                    </div>
                    <div class="card-body">
                        <a href="javascript:history.back()">
                            <button type="submit" class="btn btn-success">返回</button>
                        </a>
                        <hr>
                        <form class="form-horizontal">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <table id="table" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>學生姓名</th>
                                    <th>學號</th>
                                    <th>簽到</th>
                                </tr>
                                </thead>
                                <tbody>
    
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            黃某某
                                        </td>
                                        <td>
                                            123456789
                                        </td>
                                        <td width="170">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" checked disabled id="defaultCheck1">
                                              </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>2</td>
                                        <td>
                                            林某某
                                        </td>
                                        <td>
                                            123456790
                                        </td>
                                        <td width="170">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" checked disabled id="defaultCheck1">
                                              </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>3</td>
                                        <td>
                                            陳某某
                                        </td>
                                        <td>
                                            123456791
                                        </td>
                                        <td width="170">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" checked disabled id="defaultCheck1">
                                              </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>4</td>
                                        <td>
                                            張某某
                                        </td>
                                        <td>
                                            123456792
                                        </td>
                                        <td width="170">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" checked disabled id="defaultCheck1">
                                              </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
    </script>
@endsection