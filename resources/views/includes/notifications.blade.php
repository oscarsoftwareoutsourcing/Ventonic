{{-- @extends('layouts.app-dashboard') --}}

<notification :userid="{{auth()->user()->id}}" :unreads="{{auth()->user()->unreadNotifications}}"></notificacion>

{{-- @section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection --}}
