@extends('layouts.app')

@section('title')
    Web Developer
@endsection

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <h2 style="margin: 0">Enquire</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <enquire></enquire>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection