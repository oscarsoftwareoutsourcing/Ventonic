@extends('layouts.app-dashboard')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">




                <div class="dashboard-ecommerce">
                <div class="row justify-content-center">

                    <div class="col-lg6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex flex-column align-items-start pb-0">
                                <div class="avatar bg-rgba-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-users text-primary font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700 mt-1">92.6k</h2>
                                <h3><a class="text-white" href="{{  route('oportunity.saved')  }}">Oportunidades</a></h3>
                            </div>
                            <div class="card-content" style="position: relative;">
                                <div id="subscribe-gain-chart"></div>
                                <div class="resize-triggers">
                                    <div class="expand-trigger">
                                        <div style="width: 350px; height: 101px;"></div>
                                    </div>
                                    <div class="contract-trigger"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex flex-column align-items-start pb-0">
                                <div class="avatar bg-rgba-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-credit-card text-success font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700 mt-1">92.6k</h2>
                                <h3><a class="text-white" href="{{route('negociationCompany.index')}}">Negociaciones</a></h3>
                            </div>
                            <div class="card-content" style="position: relative;">
                                <div class="resize-triggers">
                                    <div class="expand-trigger">
                                        <div style="width: 350px; height: 101px;"></div>
                                    </div>
                                    <div class="contract-trigger"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex flex-column align-items-start pb-0">
                                <div class="avatar bg-rgba-danger p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-user text-danger font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700 mt-1">92.6k</h2>
                                <h3><a class="text-white" href="{{route('contact.list')}}">Contactos</a></h3>
                            </div>
                            <div class="card-content" style="position: relative;">
                                <div class="resize-triggers">
                                    <div class="expand-trigger">
                                        <div style="width: 350px; height: 101px;"></div>
                                    </div>
                                    <div class="contract-trigger"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg6 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex flex-column align-items-start pb-0">
                                <div class="avatar bg-rgba-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-calendar text-warning font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700 mt-1">92.6k</h2>
                                <h3><a class="text-white" href="calender">Calendario</a></h3>
                            </div>
                            <div class="card-content" style="position: relative;">
                                <div class="resize-triggers">
                                    <div class="expand-trigger">
                                        <div style="width: 350px; height: 101px;"></div>
                                    </div>
                                    <div class="contract-trigger"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-end">
                                <h4>Sessions By Device</h4>
                                <div class="dropdown chart-dropdown">
                                    <button class="btn btn-sm border-0 dropdown-toggle px-0" type="button" id="dropdownItem1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Last 7 Days
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem1">
                                        <a class="dropdown-item" href="#">Last 28 Days</a>
                                        <a class="dropdown-item" href="#">Last Month</a>
                                        <a class="dropdown-item" href="#">Last Year</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body pt-0">
                                    <div id="session-chart" class="mb-1"></div>
                                    <div class="chart-info d-flex justify-content-between mb-1">
                                        <div class="series-info d-flex align-items-center">
                                            <i class="feather icon-monitor font-medium-2 text-primary"></i>
                                            <span class="text-bold-600 mx-50">Desktop</span>
                                            <span> - 58.6%</span>
                                        </div>
                                        <div class="series-result">
                                            <span>2%</span>
                                            <i class="feather icon-arrow-up text-success"></i>
                                        </div>
                                    </div>
                                    <div class="chart-info d-flex justify-content-between mb-1">
                                        <div class="series-info d-flex align-items-center">
                                            <i class="feather icon-tablet font-medium-2 text-warning"></i>
                                            <span class="text-bold-600 mx-50">Mobile</span>
                                            <span> - 34.9%</span>
                                        </div>
                                        <div class="series-result">
                                            <span>8%</span>
                                            <i class="feather icon-arrow-up text-success"></i>
                                        </div>
                                    </div>
                                    <div class="chart-info d-flex justify-content-between mb-50">
                                        <div class="series-info d-flex align-items-center">
                                            <i class="feather icon-tablet font-medium-2 text-danger"></i>
                                            <span class="text-bold-600 mx-50">Tablet</span>
                                            <span> - 6.5%</span>
                                        </div>
                                        <div class="series-result">
                                            <span>-5%</span>
                                            <i class="feather icon-arrow-down text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card chat-application">
                            <div class="card-header">
                                <h4 class="card-title">Chat</h4>
                            </div>
                            <div class="chat-app-window">
                                <div class="user-chats">
                                    <div class="chats">
                                        <div class="chat">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-2.jpg" alt="avatar" height="40" width="40" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Cake sesame snaps cupcake gingerbread</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar mt-50">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-5.jpg" alt="avatar" height="40" width="40" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Apple pie pie jujubes chupa chups muffin</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-2.jpg" alt="avatar" height="40" width="40" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Chocolate cake</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar mt-50">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-5.jpg" alt="avatar" height="40" width="40" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Donut sweet pie oat cake dragée fruitcake</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat">
                                            <div class="chat-avatar mt-50">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-2.jpg" alt="avatar" height="40" width="40" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Liquorice chocolate bar jelly beans icing</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar mt-50">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-5.jpg" alt="avatar" height="40" width="40" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Powder toffee tootsie roll macaroon cupcake.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-2.jpg" alt="avatar" height="40" width="40" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Apple pie oat cake brownie cotton candy cupcake chocolate bar dessert.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar mt-50">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-5.jpg" alt="avatar" height="40" width="40" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Biscuit cake jujubes carrot cake topping sweet cake.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-footer">
                                    <div class="card-body d-flex justify-content-around pt-0">
                                        <input type="text" class="form-control mr-50" placeholder="Type your Message">
                                        <button type="button" class="btn btn-icon btn-primary"><i class="feather icon-navigation"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between pb-0">
                                <h4 class="card-title">Customers</h4>
                                <div class="dropdown chart-dropdown">
                                    <button class="btn btn-sm border-0 dropdown-toggle px-0" type="button" id="dropdownItem3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Last 7 Days
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem3">
                                        <a class="dropdown-item" href="#">Last 28 Days</a>
                                        <a class="dropdown-item" href="#">Last Month</a>
                                        <a class="dropdown-item" href="#">Last Year</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body py-0">
                                    <div id="customer-chart"></div>
                                </div>
                                <ul class="list-group list-group-flush customer-info">
                                    <li class="list-group-item d-flex justify-content-between ">
                                        <div class="series-info">
                                            <i class="fa fa-circle font-small-3 text-primary"></i>
                                            <span class="text-bold-600">New</span>
                                        </div>
                                        <div class="product-result">
                                            <span>890</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between ">
                                        <div class="series-info">
                                            <i class="fa fa-circle font-small-3 text-warning"></i>
                                            <span class="text-bold-600">Returning</span>
                                        </div>
                                        <div class="product-result">
                                            <span>258</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between ">
                                        <div class="series-info">
                                            <i class="fa fa-circle font-small-3 text-danger"></i>
                                            <span class="text-bold-600">Referrals</span>
                                        </div>
                                        <div class="product-result">
                                            <span>149</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js-app')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection
