@extends('layouts.app')
@section('css')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{Auth::user()->name}} - QR碼點名</h3>

                        @if(Session::has('status_msg'))
                            <h1>{{Session::get('status_msg')}}</h1>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection