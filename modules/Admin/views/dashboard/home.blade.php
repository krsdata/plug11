 <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Dashboard
                                <small>user, group category and category</small>
                            </h1>
                        </div>
                        <!-- END PAGE TITLE -->
                      
                        <!-- END PAGE TOOLBAR -->
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            Home
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Dashboard</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                       
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                            <span data-counter="counterup" data-value="7800">{{$users_count}}</span>
                                            <small class="font-green-sharp">$</small>
                                        </h3>
                                        <small>REGISTERED USER</small>
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
                                        <h3 class="font-green-sharp">
                                            <span data-counter="counterup" data-value="7800">{{$banner or 0 }}</span>
                                            <small class="font-green-sharp">$</small>
                                        </h3>
                                        <small>BANNERS</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: {{$banner}}%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">{{$banner}}% grow</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> progress </div>
                                        <div class="status-number"> {{$banner}}% </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                            <span data-counter="counterup" data-value="7800">{{$match}}</span>
                                            <small class="font-green-sharp">$</small>
                                        </h3>
                                        <small>TOTAL MATCHES</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width:  {{$match}}%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">{{$match}}% grow</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> progress </div>
                                        <div class="status-number"> {{$match}}% </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                               
             
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
                                            <span data-counter="counterup" data-value="567">{{$match_3}}</span>
                                        </h3>
                                        <small>LIVE MATCHES</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-basket"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: {{$match_3}}%;" class="progress-bar progress-bar-success blue-sharp">
                                            <span class="sr-only">{{$match_3}}% grow</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> grow </div>
                                        <div class="status-number"> {{$match_3}}% </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
    
                        
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                <div class="visual">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="1349">{{$match_2}}%</span>
                                    </div>
                                    <div class="desc"> COMPLETED MATCHES </div>
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
                                        <span data-counter="counterup" data-value="125">{{$contest_types or 0 }}</span> </div>
                                    <div class="desc"> TOTAL CONTEST TYPE </div>
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
                                    <div class="desc"> TOTAL REVENUE </div>
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
                                        <span data-counter="counterup" data-value="89"></span>{{$match_1}}</div>
                                    <div class="desc"> UPCOMING MATCHES </div>
                                </div>
                            </a>
                        </div>
                    </div>

                      


                <div class="row">
                    <div class=" col-lg-12 col-md-12 col-sm-11 col-xs-12 " style=""><p class="alert alert-success  ">CRON JOB : 
                     @if(Session::has('flash_alert_notice'))
                              
                           <span class="alert alert-danger">  {{ Session::get('flash_alert_notice') }} </span>
                             
                        @endif
                 </p> </div>
                     
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                      <div class="icon">
                                        <i class="fa fa-folder-open-o"></i>
                                    </div>
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
                                            <span data-counter="counterup" data-value="567">
                                                <a href="{{url('api/v2/getMatchDataFromApiAdmin')}}" target="_blank">All Match Status  </a>

                                            </span>
                                        </h3>
                                        <small> Update Match from Cron </small>
                                    </div>
                                  
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: {{$match_1}}%;" class="progress-bar progress-bar-success blue-sharp">
                                            <span class="sr-only">{{$match_3}}% grow</span>
                                        </span>
                                    </div>
                                    
                                </div>
                            </div>
                    </div> 

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                     <div class="icon">
                                        <i class="fa fa-folder-open-o"></i>
                                    </div>
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
                                            <span data-counter="counterup" data-value="567">
                                                <a href="{{url('api/v2/updateMatchDataByStatusAdmin/3')}}">Live Match Status  </a>

                                            </span>
                                        </h3>
                                        <small> Update Match from Cron </small>
                                    </div>
                                   
                                </div>
                                 
                            </div>
                    </div>

                      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                      <div class="icon">
                                        <i class="fa fa-folder-open-o"></i>
                                    </div>
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
                                            <span data-counter="counterup" data-value="567">
                                                <a href="{{url('api/v2/updateMatchDataByStatusAdmin/2')}}">Completed Match   </a>

                                            </span>
                                        </h3>
                                        <small> Update Match from Cron </small>
                                    </div>
                                  
                                </div>
                                 
                            </div>
                    </div>

                      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                      <div class="icon">
                                        <i class="fa fa-folder-open-o"></i>
                                    </div>
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
                                            <span data-counter="counterup" data-value="567">
                                                <a href="{{url('api/v2/updateMatchDataByStatusAdmin/1')}}" >Upcoming Match   </a>

                                            </span>
                                        </h3>


                                        <small style="font-size: 13px"> Upcoming Match from Cron </small>
                                    </div>
                                     
                                </div>
                                 
                            </div>
                    </div>

                    
                </div>

            <!-- BEGIN : HIGHCHARTS -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">Line Chart 1</span>
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
                                    <div id="highchart_1" style="height:500px;"></div>
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
                                        <span class="caption-subject font-green bold uppercase">Line Chart 2</span>
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
                                    <div id="highchart_2" style="height:500px;"></div>
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
                                        <span class="caption-subject font-green bold uppercase">Area Chart</span>
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
                                    <div id="highchart_3" style="height:500px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
              
                    <!-- END : HIGHCHARTS -->     <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->

        </div>
        