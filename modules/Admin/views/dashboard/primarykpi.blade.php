@extends('packages::layouts.master')
  @section('title', 'Dashboard')
    @section('content') 
      @include('packages::partials.navigation')
      <!-- Left side column. contains the logo and sidebar -->
      @include('packages::partials.sidebar')

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Primary KPI
                                <small>stats, weekly stats and monthly stats</small>
                            </h1>
                        </div>
                        <!-- END PAGE TITLE -->
                      
                        <!-- END PAGE TOOLBAR -->
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                         <li>
                           <a href="{{url('admin')}}"> Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Primary KPI</span>
                        </li>
                    </ul>
                 <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                            <span data-counter="counterup" data-value="7800">0</span>
                                            <small class="font-green-sharp">$</small>
                                        </h3>
                                        <small>REGISTERED USERS</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">76% progress</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> progress </div>
                                        <div class="status-number"> 76% </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze">
                                            <span data-counter="counterup" data-value="1349">0</span>
                                        </h3>
                                        <small>AMOUNT SPENT</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-like"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 85%;" class="progress-bar progress-bar-success red-haze">
                                            <span class="sr-only">85% change</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> change </div>
                                        <div class="status-number"> 85% </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
                                            <span data-counter="counterup" data-value="567"></span>
                                        </h3>
                                        <small>REVENUE PER USER</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-basket"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 45%;" class="progress-bar progress-bar-success blue-sharp">
                                            <span class="sr-only">45% grow</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> grow </div>
                                        <div class="status-number"> 45% </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-purple-soft">
                                            <span data-counter="counterup" data-value="276"></span>
                                        </h3>
                                        <small>REFERALS PER USER</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 57%;" class="progress-bar progress-bar-success purple-soft">
                                            <span class="sr-only">56% change</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> change </div>
                                        <div class="status-number"> 57% </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BEGIN DASHBOARD STATS 1-->
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                <div class="visual">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="1349">0</span>
                                    </div>
                                    <div class="desc"> AVERAGE CONTEST </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                <div class="visual">
                                    <i class="fa fa-bar-chart-o"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="12,5">0</span>M$ </div>
                                    <div class="desc"> MATCHES PLAYED </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                <div class="visual">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="549">0</span>
                                    </div>
                                    <div class="desc"> AMOUNT ON PROMOTION </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                                <div class="visual">
                                    <i class="fa fa-globe"></i>
                                </div>
                                <div class="details">
                                    <div class="number"> +
                                        <span data-counter="counterup" data-value="89"></span>% </div>
                                    <div class="desc"> TOTAL USERS </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- END DASHBOARD STATS 1-->
 

                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">MATCHES & TRANSACTION</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-cloud-upload"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-wrench"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="chartContainer2" style="height:400px;"></div>
                                </div>
                            </div>
                        </div>


                    </div>
                                  <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">RETURN ON INVESTMENT</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-cloud-upload"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-wrench"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="chartContainer3" style="height:400px;"></div>
                                </div>
                            </div>
                        </div>

                   </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">TOTAL CONTEST</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-cloud-upload"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-wrench"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="chartContainer4" style="height:400px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                                       

                            <div class="row">
                            <div class="col-lg-6 col-xs-12 col-sm-12">
                            <!-- BEGIN REGIONAL STATS PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-share font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">Registration of Customers</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-cloud-upload"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-wrench"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" data-container="false" data-placement="bottom" href="javascript:;"> </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="region_statistics_loading">
                                        <img src="assets/global/img/loading.gif" alt="loading" /> </div>
                                    <div id="region_statistics_content" class="display-none">
                                        <div class="btn-toolbar margin-bottom-10">
                                            <div class="btn-group btn-group-circle" data-toggle="buttons">
                                                <a href="" class="btn grey-salsa btn-sm active"> Users </a>
                                                <a href="" class="btn grey-salsa btn-sm"> Orders </a>
                                            </div>
                                            <div class="btn-group pull-right">
                                                <a href="" class="btn btn-circle grey-salsa btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Select Region
                                                    <span class="fa fa-angle-down"> </span>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="javascript:;" id="regional_stat_world"> World </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;" id="regional_stat_usa"> USA </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;" id="regional_stat_europe"> Europe </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;" id="regional_stat_russia"> Russia </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;" id="regional_stat_germany"> Germany </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div id="vmap_world" class="vmaps display-none"> </div>
                                        <div id="vmap_usa" class="vmaps display-none"> </div>
                                        <div id="vmap_europe" class="vmaps display-none"> </div>
                                        <div id="vmap_russia" class="vmaps display-none"> </div>
                                        <div id="vmap_germany" class="vmaps display-none"> </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END REGIONAL STATS PORTLET-->
                        </div>

                        


                       <div class="col-lg-6 col-xs-12 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <span class="caption-subject bold uppercase font-dark">Transactions</span>
                                        <span class="caption-helper">Area Wise</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" href="#">
                                            <i class="icon-cloud-upload"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="#">
                                            <i class="icon-wrench"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="#">
                                            <i class="icon-trash"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="dashboard_amchart_2" class="mapChart" style="height: 341px"></div>
                                </div>
                            </div>
                        </div>

                    </div>

                        <div class="row">
                        <div class="col-lg-6 col-xs-12 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-cursor font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">General Stats</span>
                                    </div>
                                    <div class="actions">
                                        <a href="javascript:;" class="btn btn-sm btn-circle red easy-pie-chart-reload">
                                            <i class="fa fa-repeat"></i> Reload </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number transactions" data-percent="55">
                                                    <span>+55</span>% </div>
                                                <a class="title" href="javascript:;"> Transactions
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"> </div>
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number visits" data-percent="85">
                                                    <span>+85</span>% </div>
                                                <a class="title" href="javascript:;"> New Visits
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"> </div>
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number bounce" data-percent="46">
                                                    <span>-46</span>% </div>
                                                <a class="title" href="javascript:;"> Bounce
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                                                <div class="col-lg-6 col-xs-12 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-cursor font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">General Stats</span>
                                    </div>
                                    <div class="actions">
                                        <a href="javascript:;" class="btn btn-sm btn-circle red easy-pie-chart-reload">
                                            <i class="fa fa-repeat"></i> Reload </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number transactions" data-percent="55">
                                                    <span>+55</span>% </div>
                                                <a class="title" href="javascript:;"> Transactions
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"> </div>
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number visits" data-percent="85">
                                                    <span>+85</span>% </div>
                                                <a class="title" href="javascript:;"> New Visits
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"> </div>
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number bounce" data-percent="46">
                                                    <span>-46</span>% </div>
                                                <a class="title" href="javascript:;"> Bounce
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-xs-12 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <span class="caption-subject bold uppercase font-dark">VIEW TO INSTALL</span>
                                        
                                    </div>
                                     <div class="actions">
                                        <a href="#" class="btn btn-circle green btn-outline btn-sm">
                                            <i class="fa fa-pencil"></i> Export </a>
                                        <a href="#" class="btn btn-circle green btn-outline btn-sm">
                                            <i class="fa fa-print"></i> Print </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="chartContainer7" style="height: 300px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption ">
                                        <span class="caption-subject font-dark bold uppercase">INSTALL TO REGISTERATION</span>
                                       
                                    </div>
                                    <div class="actions">
                                        <a href="#" class="btn btn-circle green btn-outline btn-sm">
                                            <i class="fa fa-pencil"></i> Export </a>
                                        <a href="#" class="btn btn-circle green btn-outline btn-sm">
                                            <i class="fa fa-print"></i> Print </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="chartContainer8"  style="height: 300px;" ></div>
                                </div>
                            </div>
                        </div>
                    </div>


                                        <div class="row">
                        <div class="col-lg-6 col-xs-12 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <span class="caption-subject bold uppercase font-dark">REGISTERATION TO TRANSACTION</span>
                                        
                                    </div>
                                     <div class="actions">
                                        <a href="#" class="btn btn-circle green btn-outline btn-sm">
                                            <i class="fa fa-pencil"></i> Export </a>
                                        <a href="#" class="btn btn-circle green btn-outline btn-sm">
                                            <i class="fa fa-print"></i> Print </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="chartContainer9" style="height: 300px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption ">
                                        <span class="caption-subject font-dark bold uppercase">SHARES TO REFERALS</span>
                                       
                                    </div>
                                    <div class="actions">
                                        <a href="#" class="btn btn-circle green btn-outline btn-sm">
                                            <i class="fa fa-pencil"></i> Export </a>
                                        <a href="#" class="btn btn-circle green btn-outline btn-sm">
                                            <i class="fa fa-print"></i> Print </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="chartContainer10"  style="height: 300px;" ></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    




                     <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">PER USER AQUISITION COST VS DAILY NEW USER ADDITION</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-cloud-upload"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-wrench"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="chartContainer5" style="height:400px;"></div>
                                </div>
                            </div>
                        </div>


                    </div>


                     <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">REVENUE & PROFIT PER MATCH</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-cloud-upload"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-wrench"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="chartContainer6" style="height:400px;"></div>
                                </div>
                            </div>
                        </div>


                    </div>



                            <div class="row">
            
                                    <div class="col-lg-6">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <span class="caption-subject bold uppercase font-dark">ENTRY TICKET</span>
                                    
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" href="#">
                                            <i class="icon-cloud-upload"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="#">
                                            <i class="icon-wrench"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="#">
                                            <i class="icon-trash"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                                    </div>
                                </div>
                                
                              <div id="chart_wrap" >
                    <div id="chartContainer"></div>
                    </div>
                            
                            </div>
                        </div>


                        <div class="col-lg-6 col-xs-12 col-sm-24">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <span class="caption-subject bold uppercase font-dark">Activity</span>
                              
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" href="#">
                                            <i class="icon-cloud-upload"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="#">
                                            <i class="icon-wrench"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="#">
                                            <i class="icon-trash"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                                    </div>
                                </div>
                                
                              <div id="chart_wrap" >
                    <div id="chartContainer1"></div>
                    </div>
                            
                            </div>
                        </div>
                    <!-- END : ECHARTS -->




                  </div>

                    </div>
                </div>
            
                <!-- END CONTENT BODY -->

           @include('packages::partials.quicknavbar')
@stop