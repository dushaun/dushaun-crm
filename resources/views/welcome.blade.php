@extends('layouts.app')

@section('title')
    Web Developer
@endsection

@section('front-page-style')
    <style>
        .full-height {
            height: 90vh;
        }

        .front-page-footer {
            height: 10vh;
            background-color: #323232;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .top-left {
            position: absolute;
            left: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .subtitle {
            font-size: 42px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .links.alt > a {
            color: #e5e5e5;
        }

        .m-b {
            margin-bottom: 7px;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
@endsection

@section('navbar')
    @parent
@endsection

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b">
                DuShaun
            </div>

            <div class="subtitle m-b-md">
                Web Developer
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection