@extends('layouts.crm')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <enquiry-index></enquiry-index>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection