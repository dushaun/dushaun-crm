@extends('layouts.app')

@section('title')
    Web Developer
@endsection

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">About</div>

                <div class="panel-body">
                    It Works!
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection