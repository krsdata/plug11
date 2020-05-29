@extends('packages::layouts.master')
  @section('title', 'Dashboard')
    @section('content') 
      @include('packages::partials.navigation')
      <!-- Left side column. contains the logo and sidebar -->
      @include('packages::partials.sidebar')
     
      
  

<div class="page-content-wrapper">
 <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
      
      
        <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>KeyFeature
                        
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
                            <span class="active">Key Feature</span>
                        </li>
                    </ul>
                  <div class="row">
                        
                              <div class="col-md-12" >
                            <div class="portlet light bordered">
                                <div class="portlet-title" >
                                    <div class="caption">
                                      
                                        <i class="icon-microphone font-dark hide"></i>
                                        <span class="caption-subject bold font-dark uppercase"> Recent Matches</span>
                                           <div class="btn-group">
                        <button type="button" class="btn dark btn-sm btn-circle dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="hidden-sm hidden-xs" >Sports&nbsp;</span>
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu custom_action"  role="menu">
                            <li>
                                <a href="#">
                                    <i class="fa fa-soccer-ball-o"></i> Cricket </a>
                            </li>
                            <li>
                                <a href="#" >
                                    <i class="fa fa-soccer-ball-o"></i> Football </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-soccer-ball-o"></i> Basketball </a>
                            </li>
                        
                            <li>
                                <a href="#">
                                    <i class="fa fa-soccer-ball-o"></i> Baseball
                                    
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-soccer-ball-o"></i> Volleyball  
                                  
                                </a>
                            </li>
                          
                        </ul>
                    </div>
                                         <div id="reportrange" class="btn default btn-circle btn-sm" style="margin-left: 560px;"  >
                                               <i class="fa fa-calendar"></i> &nbsp;
                                               <span ></span>
                                                <b class="fa fa-angle-down"></b>
                                         </div>
                                    </div>
                  
                                    
                            </div>
                                   <div class="portlet-body">

                                         <div class="row number-stats margin-bottom-30">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="stat-left">
                                                <div class="stat-chart">
                                                    <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                    <div id="sparkline_bar"><canvas width="113" height="55" style="display: inline-block; width: 113px; height: 55px; vertical-align: top;"></canvas></div>
                                                </div>
                                            
                                                <div class="stat-number">
                                                    <div class="title"> Deposit </div>
                                                    <div class="number"> @if( $Total_dep) {{ $Total_dep }} @else 0 @endif  </div>
                                                </div>
                                             
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="stat-right">
                                                <div class="stat-chart">
                                                    <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                    <div id="sparkline_bar2"><canvas width="107" height="55" style="display: inline-block; width: 107px; height: 55px; vertical-align: top;"></canvas></div>
                                                </div>
                                                <div class="stat-number">
                                                    <div class="title"> Free </div>
                                                    <div class="number"> 0   </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                <div class="row" >

                    @foreach($match as $key=> $result)

                                        <div class="col-md-2">
                        <div class="mt-widget-4">
                            <div class="mt-img-container">

                                <!--- counter---  match type- -->
                                
                                <img src="{{url('media/img/key2.jpg')}}" />
                            </div>
                            <div class="mt-container bg-purple-opacity" >
                                <div class="sec1">{!! Carbon\Carbon::parse($result->created_at)->format('h:i:s'); !!}</div>
                                <div class="sec2">@if($result->competition){{$result->competition->title}}@else No Contest @endif</div>
                                <div class="mt-head-title" style="font-size: 14px; margin-top:3px; font-weight: bold; text-align: center; "> {{$result->short_title}}</div>

                                <div class="sec3">{{$result->format_str}}</div><br>

                                    <div class="mt-body-icons sec4" style=" margin-top: -3px;text-align: center; ">
                                        <i class="fa fa-user"></i>
                                        <span>@if($result->joinContest){{$result->joinContest->count()}}@else 0 @endif</span>                            
                                    </div>
                                          <!-- Modal -->
                                       <div class="mt-body-icons" style=" margin-top: 7px; text-align: center; ">
                                        <i class="fa fa-rupee"></i>
                                         <span>{{$result->id}}</span>                            
                                    </div>
                                  <div class="mt-body-icons" style=" margin-top: 8px; text-align: center; ">
                                        <i class="fa fa-soccer-ball-o"></i>
                                        <span>@if($result->create_contests){{$result->create_contests->count()}}@else 0 @endif</span>                            
                                    </div>
                                    <div class="mt-footer-button">
                                        <button type="button" class="btn btn-circle btn-danger btn-sm" style="margin-top: -13px; margin-left: 80px; width: 70px; font-size: 10px;">  {!! Carbon\Carbon::parse($result->created_at)->format('d-m-Y'); !!}</button>
                                 </div>
                                 <div>
                                        <button type="button" class="btn btn-circle btn-danger btn-sm" style="margin-top: 20px; width: 70px;   border-top-right-radius: 50px !important; font-size: 10px;  border-bottom-right-radius: 50px !important">{{$result->status_str}}</button>
                                    </div>
                                    
                                </div>

                           


                            </div>
                        </div>
                    @endforeach
                       
                      </div>
                <br><br>
                    </div >
                     <span align="center">{{ $match->links()}}</span>
                </div>
           
            </div>
        </div>


    <!-----------------------USER ACTIVITY BEGINs------------------------------------------------------------------------------------------>
                 <div class="row">
                        <div class="col-xs-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption caption-md">
                                        <i class="icon-bar-chart font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">User Activity</span>
                                        <span class="caption-helper">Daily stats...</span>
                                    </div>
                                    <div class="actions">
                                     
                                    <div class="tabbable-line">
                                    
                                             <ul class="nav nav-tabs custom_nav pull-right">
                                            <li class="active">
                                                <a href="#over1" data-toggle="tab"> Today</a>
                                            </li>
                                            <li>
                                                <a href="#over2" data-toggle="tab">Week</a>
                                            </li>
                                            <li>
                                                <a href="#over3" data-toggle="tab"> Month </a>
                                            </li>
                                         
                                        </ul>   
                                        </div>
                                    </div>
                                
                                 
                                </div>
                       
                                <div class="row number-stats margin-bottom-30">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="stat-left">
                                                <div class="stat-chart">
                                                   
                                                    <div class="sparkline-chart">
                                                              <div class="number" id="sparkline_bar5"></div>
                                                        </div>
                                                </div>
                                                
                                                <div class="stat-number">
                                                    <div class="title"> Daily </div>
                                                    <div class="number">@if($Num_User){{$Num_User->count()}}@else 0 @endif </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="stat-right">
                                                <div class="stat-chart">
                                                
                                                     <div class="sparkline-chart">
                                                <div class="number" id="sparkline_bar6"></div>
                                                </div>
                                            </div>
                                                <div class="stat-number">
                                                    <div class="title"> Monthly </div>
                                                    <div class="number"> @if($Num_User2){{$Num_User2->count()}}@else 0 @endif  </div>
                                                </div>
                                         
                                            </div>
                                        </div>
                                    </div>
                          
                                     <div class="tab-content">
                                        <div class="tab-pane active" id="over1">

                                                <div class="table-responsive">
                                                <div class="table-responsive table-scrollable table-scrollable-borderless" >
                                        <table class="table table-hover table-light" >
                                            <thead>
                                                <tr>
                                                    <th> Sno. </th>
                                                    <th> Member </th>
                                                    <th> Email </th>
                                                    <th> Balance </th>
                                                    <th> Phone</th>
                                                    <th> Details</th>
                                                    <th> SignUp Date</th>
                                                    <th> Status</th>
                                                    <th> Action</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                            @foreach($user1 as $key => $result)
                                            <tr class="custom_table" >
                                                <td> 1</td>
                                                <td>{{$result->first_name.'  '.$result->last_name}}</td>
                                                <td> {{$result->email}} </td>
                                                <td>  </td>
                                                <td> {{$result->phone}} </td>
                                                <td> @if($result->role_type==3)
                                                    <a href="#" style="font-size: 12px;">
                                                        View Details
                                                        <i class="fa fa-eye" title="edit"></i> 

                                                    </a>
                                                    @endif
                                                </td>
                                                <td> {!! Carbon\Carbon::parse($result->created_at)->format('d-m-Y'); !!}</td>
                                                <td>
                                                         <span class="label label-{{ ($result->status==1)?'success':'warning'}} status" id="{{$result->id}}"  data="{{$result->status}}"  onclick="changeStatus({{$result->id}},'user')" >
                                                            {{ ($result->status==1)?'Active':'Inactive'}}
                                                        </span>
                                                </td>
                                                <td>  <a href="{{ route('user.edit',$result->id)}}?role_type={{$result->role_type}}">
                                                            <i class="fa fa-fw fa-pencil-square-o" title="edit"></i> 
                                                        </a>

                                                        {!! Form::open(array('class' => 'form-inline pull-left deletion-form', 'method' => 'DELETE',  'id'=>'deleteForm_'.$result->id, 'route' => array('user.destroy', $result->id))) !!}
                                                        <button class='delbtn btn btn-danger btn-xs' type="submit" name="remove_levels" value="delete" id="{{$result->id}}"><i class="fa fa-fw fa-trash" title="Delete"></i></button>
                                                           {!! Form::close() !!}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>

                                    </div>
                                      <span align="center">{{ $user1->links()}}</span>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="over2">
                                                <div class="table-responsive">
                                                   <div class="table-responsive table-scrollable table-scrollable-borderless" >
                                        <table class="table table-hover table-light" >
                                            <thead>
                                                <tr>
                                                    <th> Sno. </th>
                                                    <th> Member </th>
                                                    <th> Email </th>
                                                    <th> Balance </th>
                                                    <th> Phone</th>
                                                    <th> Details</th>
                                                    <th> SignUp Date</th>
                                                    <th> Status</th>
                                                    <th> Action</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                            @foreach($user2 as $key => $result)
                                            <tr class="custom_table" >
                                                <td> 1</td>
                                                <td>{{$result->first_name.'  '.$result->last_name}}</td>
                                                <td> {{$result->email}} </td>
                                                <td>  </td>
                                                <td> {{$result->phone}} </td>
                                                <td> @if($result->role_type==3)
                                                    <a href="#" style="font-size: 12px;">
                                                        View Details
                                                        <i class="fa fa-eye" title="edit"></i> 

                                                    </a>
                                                    @endif
                                                </td>
                                                <td> {!! Carbon\Carbon::parse($result->created_at)->format('d-m-Y'); !!}</td>
                                                <td>
                                                         <span class="label label-{{ ($result->status==1)?'success':'warning'}} status" id="{{$result->id}}"  data="{{$result->status}}"  onclick="changeStatus({{$result->id}},'user')" >
                                                            {{ ($result->status==1)?'Active':'Inactive'}}
                                                        </span>
                                                </td>
                                                <td>  <a href="{{ route('user.edit',$result->id)}}?role_type={{$result->role_type}}">
                                                            <i class="fa fa-fw fa-pencil-square-o" title="edit"></i> 
                                                        </a>

                                                        {!! Form::open(array('class' => 'form-inline pull-left deletion-form', 'method' => 'DELETE',  'id'=>'deleteForm_'.$result->id, 'route' => array('user.destroy', $result->id))) !!}
                                                        <button class='delbtn btn btn-danger btn-xs' type="submit" name="remove_levels" value="delete" id="{{$result->id}}"><i class="fa fa-fw fa-trash" title="Delete"></i></button>
                                                           {!! Form::close() !!}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>

                                    </div>
                                      <span align="center">{{ $user2->links()}}</span>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="over3">
                                                <div class="table-responsive">
                                                   <div class="table-responsive table-scrollable table-scrollable-borderless" >
                                        <table class="table table-hover table-light" >
                                            <thead>
                                                <tr>
                                                    <th> Sno. </th>
                                                    <th> Member </th>
                                                    <th> Email </th>
                                                    <th> Balance </th>
                                                    <th> Phone</th>
                                                    <th> Details</th>
                                                    <th> SignUp Date</th>
                                                    <th> Status</th>
                                                    <th> Action</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                            @foreach($user3 as $key => $result)
                                            <tr class="custom_table" >
                                                <td> 1</td>
                                                <td>{{$result->first_name.'  '.$result->last_name}}</td>
                                                <td> {{$result->email}} </td>
                                                <td>  </td>
                                                <td> {{$result->phone}} </td>
                                                <td> @if($result->role_type==3)
                                                    <a href="#" style="font-size: 12px;">
                                                        View Details
                                                        <i class="fa fa-eye" title="edit"></i> 

                                                    </a>
                                                    @endif
                                                </td>
                                                <td> {!! Carbon\Carbon::parse($result->created_at)->format('d-m-Y'); !!}</td>
                                                <td>
                                                         <span class="label label-{{ ($result->status==1)?'success':'warning'}} status" id="{{$result->id}}"  data="{{$result->status}}"  onclick="changeStatus({{$result->id}},'user')" >
                                                            {{ ($result->status==1)?'Active':'Inactive'}}
                                                        </span>
                                                </td>
                                                <td>  <a href="{{ route('user.edit',$result->id)}}?role_type={{$result->role_type}}">
                                                            <i class="fa fa-fw fa-pencil-square-o" title="edit"></i> 
                                                        </a>

                                                        {!! Form::open(array('class' => 'form-inline pull-left deletion-form', 'method' => 'DELETE',  'id'=>'deleteForm_'.$result->id, 'route' => array('user.destroy', $result->id))) !!}
                                                        <button class='delbtn btn btn-danger btn-xs' type="submit" name="remove_levels" value="delete" id="{{$result->id}}"><i class="fa fa-fw fa-trash" title="Delete"></i></button>
                                                           {!! Form::close() !!}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>

                                    </div>
                                      <span align="center">{{ $user3->links()}}</span>
                                                </div>
                                            </div>
                                      
                                        </div>
                                        </div>
                                    </div>
                                </div>

                          

             
    


    <!---------------------------------------------MATCH SUMMARY BEGINS------------------------------------------------------------------->
          <div class="portlet light bordered">
                                <div class="portlet-title">
                                   <div class="caption caption-md">
                                        <i class="icon-bar-chart font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">MATCH SUMMARY</span>
                                     
                                    </div>
                                   
                                    <div class="actions">
                                        <div class="btn-group">
                                            <a class="btn red btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Contests
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                             
                                            <ul class="dropdown-menu pull-right custom_action">
                                                 @foreach($contest1->unique('title') as $result)
                                                <li>
                                                    <a href="javascript:;"> {{ $result->title }} </a>
                                                </li>
                                           
                                               
                                           
                                               @endforeach
                                                </ul>
                                        </div>
                                    </div>
                                 
                                </div>
                                <div class="portlet-body">
                                    <div class="tabbable-line">
                                        <ul class="nav nav-tabs custom_nav">
                                            <li class="active">
                                                <a href="#overview_1" data-toggle="tab"> Results </a>
                                            </li>
                                            <li>
                                                <a href="#overview_2" data-toggle="tab">Collection</a>
                                            </li>
                                            <li>
                                                <a href="#overview_3" data-toggle="tab"> Top Performer </a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> Ranking
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu custom_action"  role="menu">
                                                    <li>
                                                        <a href="#overview_4" data-toggle="tab">
                                                            <i class="fa fa-bell"></i> Top 10 Matches </a>
                                                    </li>
                                                    <li>
                                                        <a href="#overview_4" data-toggle="tab">
                                                            <i class="fa fa-info-circle"></i> Recent Match </a>
                                                    </li>
                                                    <li>
                                                        <a href="#overview_4" data-toggle="tab">
                                                            <i class="fa fa-newspaper-o"></i> Last Match </a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li>
                                                        <a href="#overview_4" data-toggle="tab">
                                                            <i class="fa fa-gear"></i> Last 10 Matches</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="overview_1">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover table-bordered custom_table1">
                                                        <thead>
                                                            <tr>
                                                                <th> MATCH OVERVIEW </th>
                                                                <th> USERID </th>
                                                                <th> WON </th>
                                                                <th> </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                                @foreach($match as $key=> $result)
                                                            <tr>
                                                                <td>
                                                                    <a href="javascript:;"> {{$result->title}} </a>
                                                                </td>
                                                                <td> UAS62550 </td>
                                                                <td> 809 </td>
                                                                <td>
                                                                    <a href="javascript:;" class="btn btn-sm btn-default">
                                                                        <i class="fa fa-search"></i> View </a>
                                                                </td>
                                                            </tr>
                                                           
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="overview_2">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover table-bordered custom_table1">
                                                        <thead>
                                                            <tr>
                                                                <th> Collection </th>
                                                                <th> Amount </th>
                                                                <th> Users </th>
                                                                <th> </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a href="javascript:;">Daily </a>
                                                                </td>
                                                                <td> @if( $Total_dep) {{ $Total_dep }} @else 0 @endif</td>
                                                                <td> @if($Num_User){{$Num_User->count()}}@else 0 @endif </td>
                                                                <td>
                                                                    <a href="javascript:;" class="btn btn-sm btn-default">
                                                                        <i class="fa fa-search"></i> View </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="javascript:;"> Weekly </a>
                                                                </td>
                                                                <td> @if( $Total_dep1) {{ $Total_dep1 }} @else 0 @endif</td>
                                                                <td> @if($Num_User1){{$Num_User1->count()}}@else 0 @endif </td>
                                                                <td>
                                                                    <a href="javascript:;" class="btn btn-sm btn-default">
                                                                        <i class="fa fa-search"></i> View </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="javascript:;"> Monthly</a>
                                                                </td>
                                                                <td> @if( $Total_dep2) {{ $Total_dep2 }} @else 0 @endif </td>
                                                                <td> @if($Num_User2){{$Num_User2->count()}}@else 0 @endif</td>
                                                                <td>
                                                                    <a href="javascript:;" class="btn btn-sm btn-default">
                                                                        <i class="fa fa-search"></i> View </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="javascript:;"> Annual </a>
                                                                </td>
                                                                <td> @if( $Total_dep) {{ $Total_dep }} @else 0 @endif</td>
                                                                <td> @if($Num_User3){{$Num_User3->count()}}@else 0 @endif </td>
                                                                <td>
                                                                    <a href="javascript:;" class="btn btn-sm btn-default">
                                                                        <i class="fa fa-search"></i> View </a>
                                                                </td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="overview_3">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover table-bordered custom_table1">
                                                        <thead>
                                                            <tr>
                                                                <th> Player Name </th>
                                                                <th> Total Matches </th>
                                                                <th> Total Amount </th>
                                                                <th> </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                  
                                                            <tr>
                                                                <td>
                                                                    <a href="javascript:;">abc </a>
                                                                </td>
                                                                <td> 3 </td>
                                                                <td> $625.50 </td>
                                                                <td>
                                                                    <a href="javascript:;" class="btn btn-sm btn-default">
                                                                        <i class="fa fa-search"></i> View </a>
                                                                </td>
                                                            </tr>
                                                             <tr>
                                                                <td>
                                                                    <a href="javascript:;">abc </a>
                                                                </td>
                                                                <td> 3 </td>
                                                                <td> $625.50 </td>
                                                                <td>
                                                                    <a href="javascript:;" class="btn btn-sm btn-default">
                                                                        <i class="fa fa-search"></i> View </a>
                                                                </td>
                                                            </tr>
                                                             <tr>
                                                                <td>
                                                                    <a href="javascript:;">abc </a>
                                                                </td>
                                                                <td> 3 </td>
                                                                <td> $625.50 </td>
                                                                <td>
                                                                    <a href="javascript:;" class="btn btn-sm btn-default">
                                                                        <i class="fa fa-search"></i> View </a>
                                                                </td>
                                                            </tr>
                                                         
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="overview_4">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover table-bordered custom_table1">
                                                        <thead>
                                                            <tr>
                                                                <th> Player Name </th>
                                                                <th> Rank </th>
                                                                <th> Amount </th>
                                                                <th> Status </th>
                                                                <th> </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a href="javascript:;"> David Wilson </a>
                                                                </td>
                                                                <td> 1 </td>
                                                                <td> $625.50 </td>
                                                                <td>
                                                                    <span class="label label-sm label-warning"> Pending </span>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:;" class="btn btn-sm btn-default">
                                                                        <i class="fa fa-search"></i> View </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="javascript:;"> Amanda Nilson </a>
                                                                </td>
                                                                <td> 2 </td>
                                                                <td> $12625.50 </td>
                                                                <td>
                                                                    <span class="label label-sm label-warning"> Pending </span>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:;" class="btn btn-sm btn-default">
                                                                        <i class="fa fa-search"></i> View </a>
                                                                </td>
                                                            </tr>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>

    <!------------------------------------------------------------------------------------------------------------------------------------>

        

    </div>
</div>

           
@include('packages::partials.quicknavbar')
@stop
