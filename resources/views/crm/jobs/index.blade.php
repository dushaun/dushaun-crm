@extends('layouts.crm')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <job-index></job-index>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection