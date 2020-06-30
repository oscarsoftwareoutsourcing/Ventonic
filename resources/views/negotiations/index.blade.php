@extends('layouts.app-dashboard')
@section('extra-css')
<style>
    .scrolling-wrapper{
	    overflow-x: auto;
    }
</style>
@endsection

@section('content')
    <negotiations-module :types="{{ $negTypes }}" :statuses="{{ $negStatuses }}" :processes="{{ $negProcesses }}" :negotiations="{{ $negotiations }}" :user="{{ $userId }}" :contacts="{{ $userContacts }}" />
@endsection
@section('extra-js')
    <script>
        window.api_url="{{ env('MIX_API_URL') }}";
    </script>
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection