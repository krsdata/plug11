
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
             <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                   @include('packages::partials.breadcrumb')

                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light portlet-fit bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings font-red"></i>
                                        <span class="caption-subject font-red sbold uppercase">{{ $heading }}</span>
                                    </div>
                                     <div class="col-md-2 pull-right">
                                            <div style="width: 150px;" class="input-group"> 
                                                <a href="{{ route('prizeDistribution.create')}}">
                                                    <button class="btn btn-success"><i class="fa fa-plus-circle"></i> Add {{ $heading }}</button> 
                                                </a>
                                            </div>
                                        </div> 
                                     
                                </div>
                                  
                                    @if(Session::has('flash_alert_notice'))
                                         <div class="alert alert-success alert-dismissable" style="margin:10px">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                          <i class="icon fa fa-check"></i>  
                                         {{ Session::get('flash_alert_notice') }} 
                                         </div>
                                    @endif
                                <div class="portlet-body table-responsive">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <form action="{{route('prizeDistribution')}}" method="get" id="filter_data">
                                             
                                            <div class="col-md-3">
                                                <input value="{{ (isset($_REQUEST['search']))?$_REQUEST['search']:''}}" placeholder="Search by  Match Id" type="text" name="search" id="search" class="form-control" >
                                            </div>
                                            <div class="col-md-2">
                                                <input type="submit" value="Search" class="btn btn-primary form-control">
                                            </div>
                                           
                                        </form>
                                         <div class="col-md-2">
                                             <a href="{{ route('prizeDistribution') }}">   <input type="submit" value="Reset" class="btn btn-default form-control"> </a>
                                        </div>
                                       
                                        </div>
                                    </div>
                                     
                                    <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th>Sno.</th>
                                           @foreach($tables as $col_name)
                                                <th> {{$col_name}}</th> 
                                            @endforeach
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
            @foreach($prizeDistribution as $key => $result)
            
                <tr>
                    <td> {{ (($prizeDistribution->currentpage()-1)*15)+(++$key) }}</td>
                    @foreach($tables as $col_name)

                           <td>  {!!$result->$col_name!!} </td>
                    @endforeach
                        
                    <td> 
                        <a href="{{ route('prizeDistribution.edit',$result->id)}}">
                            <button class="btn btn-success btn-xs">
                            <i class="fa fa-fw fa-edit" title="edit"></i> 
                            </button>
                        </a>
                        
                         {!! Form::close() !!}

                    </td>
                   
                </tr>
               @endforeach
                
            </tbody>
        </table>
<span>
  Showing {{($prizeDistribution->currentpage()-1)*$prizeDistribution->perpage()+1}} to {{$prizeDistribution->currentpage()*$prizeDistribution->perpage()}}
  of  {{$prizeDistribution->total()}} entries 
</span>

         <div class="center" align="center">  {!! $prizeDistribution->appends(['search' => isset($_GET['search'])?$_GET['search']:''])->render() !!}</div>
    </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            
            
            <!-- END QUICK SIDEBAR -->
        </div>
        