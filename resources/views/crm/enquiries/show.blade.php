@extends('layouts.crm')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <display-enquiry :data="{{ $enquiry }}"></display-enquiry>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection