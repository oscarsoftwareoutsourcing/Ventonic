@extends('layouts.app-dashboard')

@section('extra-css')
@endsection

@section('content')
    <negotiations-module :types="{{ $negTypes }}" :statuses="{{ $negStatuses }}" :processes="{{ $negProcesses }}" :negotiations="{{ $negotiations }}" :user="{{ $userId }}" :contacts="{{ $userContacts }}" :a="{{ $userGroups }}" />
@endsection
@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('extra-js')
    <script>
        window.api_url="{{ env('MIX_API_URL') }}";
    </script>
@endsection