
@extends('layouts.master')
@section('content')
        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h2 class="title-1">overview</h2>
                                <!--button class="au-btn au-btn-icon au-btn--blue">
                                    <i class="zmdi zmdi-plus"></i>add item</button-->
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-25">
                        <div class="col-sm-6 col-lg-3">
                          <a href="{{route('leads')}}">
                            <div class="overview-item overview-item--c1">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-account-o"></i>
                                        </div>
                                        <div class="text">
                                            <h2>{{$count_lead}}</h2>
                                            <span>Total Leads</span>
                                        </div>
                                    </div>
                                    <div class="overview-chart">
                                        <canvas></canvas>
                                    </div>
                                </div>
                            </div>
                          </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <a href="{{route('contacts')}}">
                            <div class="overview-item overview-item--c2">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-shopping-cart"></i>
                                        </div>
                                        <div class="text">
                                            <h2>{{$count_contact}}</h2>
                                            <span>Total Contacts</span>
                                        </div>
                                    </div>
                                    <div class="overview-chart">
                                        <canvas></canvas>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <a href="{{route('accounts')}}"> 
                            <div class="overview-item overview-item--c3">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-calendar-note"></i>
                                        </div>
                                        <div class="text">
                                            <h2>{{$count_account}}</h2>
                                            <span>Total Accounts</span>
                                        </div>
                                    </div>
                                    <div class="overview-chart">
                                        <canvas></canvas>
                                    </div>
                                </div>
                            </div>
                           </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="overview-item overview-item--c4">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-money"></i>
                                        </div>
                                        <div class="text">
                                            <h2>0</h2>
                                            <span>Activities</span>
                                        </div>
                                    </div>
                                    <div class="overview-chart">
                                        <canvas></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 class="title-1 m-b-25">Today's Leads</h2>
                            <div class="table-responsive table--no-card m-b-40">
                                <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>Lead Name</th>
                                            <th>Company</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Lead Owner</th>
                                            <th>Lead Source</th>
                                        </tr>
                                    </thead>
                                    <tbody>                              
                                        @foreach ($leads as $list)    
                                        <tr>   
                                            <td>{{$list->lead_name}}</td>                    
                                            <td>{{$list->company}}</td>
                                            <td>{{$list->email}}</td>
                                            <td>{{$list->mobile}}</td>
                                            <td>{{session('USER_NAME')}}</td>  
                                                @foreach ($lead_source_data as $list1)
                                                    @if($list->lead_source_id == $list1->id)
                                                    <td>{{$list1->name}}</td>  
                                                    @endif                                         
                                                @endforeach                                                        
                                             </tr>                                 
                                        @endforeach                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <h2 class="title-1 m-b-25">Top Contacts</h2>
                            <div class="au-card au-card--bg-blue au-card-top-countries m-b-40">
                                <div class="au-card-inner">
                                    <div class="table-responsive">
                                        <table class="table table-top-countries">
                                            <tbody>
                                                @foreach ($contacts as $list)    
                                                <tr>
                                                    <td>{{$list->first_name}} {{$list->last_name}}</</td>
                                                    <td class="text-right">{{$list->mobile}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
                                    <div class="bg-overlay bg-overlay--blue"></div>
                                    <h3>
                                        <i class="zmdi zmdi-account-calendar"></i>Accounts</h3>
                                    <button class="au-btn-plus">
                                        <i class="zmdi zmdi-plus"></i>
                                    </button>
                                </div>
                                <div class="au-task js-list-load">
                                    <div class="au-task-list js-scrollbar3">
                                        <div class="au-task__item au-task__item--danger">
                                            @foreach ($accounts as $list)                                          
                                            <div class="au-task__item-inner">
                                                <h5 class="task">
                                                    <a href="{{route('accounts')}}">{{$list->account_name}}</a>
                                                </h5>
                                                <span class="time">{{\Carbon\Carbon::parse($list->created_at)}}</span>                                          
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--div class="au-task__footer">
                                        <button class="au-btn au-btn-load js-load-btn">load more</button>
                                    </div-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2021 CRM PANEL. All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
   

@endsection