@extends('layouts.crm')

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Create Client</div>

                <div class="panel-body">
                    <create-client></create-client>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection