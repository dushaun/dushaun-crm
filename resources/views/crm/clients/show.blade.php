@extends('layouts.crm')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <display-client :data="{{ $client }}"></display-client>
        </div>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-6">
            <job-index :client="{{ $client->id }}"></job-index>
        </div>
        <div class="col-md-6">
            <invoice-index :client="{{ $client->id }}"></invoice-index>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection