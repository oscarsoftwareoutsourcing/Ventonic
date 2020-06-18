@extends('layouts.app-dashboard')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="alert alert-primary float-left display-block"><i class="feather icon-users "></i> <span class="text-white"">Gestion de grupos de usuarios</span></h6>
                        </div>
                        <div class="card-header">
                            <div>
                                <a type="button" href="{{route('group.form')}}" class="btn btn-outline-primary btn-md text-white"><i class="feather icon-users "></i> Nuevo grupo </a><span>  o puedes <a href="{{route('contact.list')}}" class="text-primary">gestionar los usuarios</a> de tu cuenta</span>
                            </div>
                        </div>
                        <div class="card-body px-75">
                            <div class="list-group">
                                @foreach($groups as $group)
                                <a href="{{route('group.edit', ['group_id'=> $group->id])}}"><p class="list-group-item text-primary">{{$group->name}}<span class="text-white">
                                    <code><i class='feather icon-user'></i>{{App\Group::getUserByGroup($group->id)}}</code></span>
                                </p></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-js')
<script src="{{ asset('js/oportunitys/oportunitys.js') }}"></script>
@endsection
