@extends('layouts.app-dashboard')

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/file-uploaders/dropzone.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/file-uploaders/dropzone.css') }}">
    <style>
        .ps-width {
            width: 100% !important;
        }
        #appFooter {
            position: relative !important;
        }
        .dropzone {
            border: 2px dashed #0087FF !important;
            min-height: 300px !important;
        }
        .dropzone .dz-message span {
            display:block !important;
            color: #0087FF !important;
        }
        #searchAndListsCol .list {
            width:100%;
        }
        #searchAndListsCol .list.col-lg-2, #searchAndListsCol .list.col-sm-4 {
            padding-right: 4px;
            padding-left: 4px;
        }
    </style>
@endsection

@section('content')
    <negotiations-module :types="{{ $negTypes }}" :statuses="{{ $negStatuses }}" :processes="{{ $negProcesses }}"
                         :negotiations="{{ $negotiations }}" :user="{{ $userId }}" :contacts="{{ $userContacts }}"
                         :a="{{ $userGroups }}" />

@endsection



@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('extra-js')

    <script>
        let $body = $('body');
        $body.addClass('menu-collapsed');
    </script>
    <!--<script src="{{ asset('vendors/js/extensions/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/scripts/extensions/dropzone.js') }}"></script>-->
    <script>
        window.api_url="{{ env('MIX_API_URL') }}";
    </script>
@endsection
