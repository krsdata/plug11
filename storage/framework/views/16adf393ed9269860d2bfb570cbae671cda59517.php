
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
  <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
    <?php echo $__env->make('packages::partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
                            <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light portlet-fit bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings font-red"></i>
                                        <span class="caption-subject font-red sbold uppercase">All Matches </span>
                                    </div>
                                     <div class="col-md-12 pull-right">
                                        <div class=" pull-right">
                                            <div   class="input-group"> 
                                                <a href="<?php echo e(route('match')); ?>?status=3">
                                                    <button  class="btn btn-success"><i class="fa fa-plus-circle"></i> Live </button> 
                                                </a> 
                                            </div>
                                        </div>
                                        <div class=" pull-right">
                                            <div   class="input-group"> 
                                                <a href="<?php echo e(route('match')); ?>?status=2">
                                                    <button  class="btn btn-success"><i class="fa fa-plus-circle"></i> Completed </button> 
                                                </a> 
                                            </div>
                                        </div>
                                        <div class=" pull-right">
                                            <div   class="input-group"> 
                                                <a href="<?php echo e(route('match')); ?>?status=1">
                                                    <button  class="btn btn-success"><i class="fa fa-plus-circle"></i> Upcoming </button> 
                                                </a> 
                                            </div>
                                        </div>

                                        <button type="button" class="btn pull-right btn-primary" data-toggle="modal" data-target="#changeDate" data-whatever="@" style="margin-right: 10px">Change Match Date</button> 

                                         <button type="button" class="btn pull-right btn-primary" data-toggle="modal" data-target="#changeMatchStatus" data-whatever="@" style="margin-right: 10px">Change Match Status</button> 
                                         
                                    </div>
                                     
                                </div>
                                  
                                    <?php if(Session::has('flash_alert_notice')): ?>
                                         <div class="alert alert-success alert-dismissable" style="margin:10px">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                          <i class="icon fa fa-check"></i>  
                                         <?php echo e(Session::get('flash_alert_notice')); ?> 
                                         </div>
                                    <?php endif; ?>
                                <div class="portlet-body table-responsive" style="min-height: 480px">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <form action="<?php echo e(route('match')); ?>" method="get" id="filter_data">
                                             
                                            <div class="col-md-3">
                                                <input value="<?php echo e((isset($_REQUEST['search']))?$_REQUEST['search']:''); ?>" placeholder="Search " type="text" name="search" id="search" class="form-control" >
                                            </div>
                                              <div class="col-md-3">
                                                <select class="form-control" name="status">
                                                    <option value="">Select Status</option>
                                                    <option value="1" <?php if(isset($_REQUEST['status']) && $_REQUEST['status']==1): ?> selected <?php endif; ?>>Upcoming</option>
                                                     <option value="2" <?php if(isset($_REQUEST['status']) && $_REQUEST['status']==2) { echo "selected"; }  ?>> Completed</option>
                                                      <option value="3" <?php if(isset($_REQUEST['status']) && $_REQUEST['status']==3): ?> selected <?php endif; ?>>Live</option>
                                                      <option value="4" <?php if(isset($_REQUEST['status']) && $_REQUEST['status']==4): ?> selected <?php endif; ?>>Cancelled</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="submit" value="Search" class="btn btn-primary form-control">
                                            </div>
                                           
                                        </form>
                                         <div class="col-md-2">
                                             <a href="<?php echo e(route('match')); ?>">   <input type="submit" value="Reset" class="btn btn-default form-control"> </a>
                                        </div>
                                       
                                        </div>
                                    </div>
                                     
                                    <table class="table table-striped table-hover table-bordered" id="contact">
                                        <thead>
                                            <tr>
                                                 <th>Sno.</th>
                                                <th> Match Id </th>
                                                <th> Match Between </th> 
                                                <th> Short title </th> 
                                                <th> Add Contest</th> 
                                                <th> Player List </th>  
                                                <th> Action</th> 
                                                <th> Status</th> 
                                                <th> Date </th> 
                                                <th> Prize Status</th>  
                                                <th> Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $match; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                              <td>
                                               

                                               <?php echo e((($match->currentpage()-1)*15)+(++$key)); ?></td>
                                                <td> <?php echo e($result->match_id); ?> </td>
                                                 <td> <?php echo e($result->title); ?> </td>
                                                 <td> <?php echo e($result->short_title); ?> </td>
                                                 <td> <a class="btn btn-success" href="<?php echo e(route('defaultContest.create')); ?>?match_id=<?php echo e($result->match_id); ?>">
                                                    Add Contest
                                                 </a>
                                                  </td>
                                                 <td> <a class="btn btn-success" href="<?php echo e(route('match.show',$result->id)); ?>?player=<?php echo e($result->match_id); ?>">
                                                    View Players

                                                 </a>
                                                 
                                               </td>
                                               <td>    
    <style type="text/css">
      .dropdown-item{
        width: 200px;
        float: left;
      }
    </style>
    <div class="btn-group dropleft"> 
      <button class="btn btn-danger" type="button" data-toggle="dropdown">Action
      <span class="caret"></span></button>

      <div class="dropdown-menu">
        <a class="dropdown-item btn btn-primary" href="<?php echo e(route('match.show',$result->id)); ?>">View Details <i class="fa fa-eye" title="details"></i> </a>
        <?php if($result->status==2): ?>
         <a class="dropdown-item btn btn-success" target="_blank" href=" <?php echo e(url('api/v2/prizeDistribution?match_id='.$result->match_id)); ?>">
           Generate Prize
              </a> 
          <?php else: ?>
          <a class="dropdown-item btn btn-warning" href="#">Generate Prize - NA</a>
          <?php endif; ?>  
        <div class="dropdown-divider"></div>
        <a class="dropdown-item btn btn-info" href="<?php echo e(route('triggerEmail','match_id='.$result->match_id)); ?>">Prize Email Trigger</a>
           
          <a class="dropdown-item btn btn-danger" data-toggle="modal" data-target="#cancelContest_<?php echo e($result->id); ?>" href="#">Cancel Match Contest</a>

          <a class="dropdown-item btn btn-danger" data-toggle="modal" data-target="#playing11_<?php echo e($result->id); ?>" href="#">Playing 11 Squad</a>

         <a class="dropdown-item btn btn-primary" href="<?php echo e(route('cancelMatch','match_id='.$result->match_id)); ?>">Cancel This Match</a>


         <a class="dropdown-item btn btn-primary" href="<?php echo e(route('matchContest','search='.$result->match_id)); ?>">View All Contests</a>
         
      </div>
    </div>

<div class="modal fade" id="cancelContest_<?php echo e($result->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg  " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Cancel Match Contest</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <form action="<?php echo e(route('cancelContest','match_id='.$result->match_id)); ?>"> 
      <div class="modal-body">

         <table class="table table-striped table-hover table-bordered" id="contact">
          <thead>
              <tr>
                  <th>Sno.</th>
                  <th> Contest Name</th> 
                  <th> Total Spot </th>  
                  <th> Filled Spot</th> 
                  <th> Remaining Spot</th>
                  <th> Entry Fees</th>
                  <th> Status</th> 
                  <th> Action </th> 
              </tr>

          </thead>
          <tbody>
            <?php $__currentLoopData = $result->contests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $contest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($key+1); ?> </td>
              <td><?php echo e($contest->contest_name); ?></td>
              <td><?php echo e($contest->total_spots); ?></td>
              <td><?php echo e($contest->filled_spot??'0'); ?></td>
              <td>
                <?php  

                  $count = ($contest->total_spots-$contest->filled_spot);
                  if($count<1){
                    echo "Unlimited Spot";
                  }else{
                    echo $count; 
                  }
               ?> </td>
               <td><?php echo e($contest->entry_fees??'0'); ?></td>
              <td><?php echo e(($contest->is_cancelled==0)?'Active':'Cancelled'); ?>  </td>
              <td>
                 <div class="mt-checkbox-list">
                  <input type="hidden" name="match_id" value="<?php echo e($result->match_id); ?>">
                  <?php if(($contest->is_cancelled==0)): ?>
                    <label class="mt-checkbox mt-checkbox-outline">
                        <input type="checkbox" name="cancel_contest[]" id="cancel_contest_<?php echo e($result->match_id); ?>" value="<?php echo e($contest->id); ?>">  
                        <span></span>
                    </label>
                    </div>
                    <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 
          </tbody>
      </table>  

        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success"> Cancel Selected Contest </button>
        </div>
      </div>
    </form>
</div>
</div>
</div>


<div class="modal fade" id="playing11_<?php echo e($result->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg  " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Playing 11</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <div class="modal-body">

         <table class="table table-striped table-hover table-bordered" id="contact">
          <thead>
              <tr>
                  <th>Sno.</th>
                  <th> Player Name</th> 
              </tr>

          </thead>
          <tbody>
            <tr>
              <td>Team A</td>
              <td><?php echo e((count($result->playing11_teamA)==0)?'Not announced':''); ?></td>
            </tr>
            <?php $__currentLoopData = $result->playing11_teamA; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $playing11): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($key+1); ?> </td>
              <td><?php echo e($playing11->name); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td>Team B</td>
              <td><?php echo e((count($result->playing11_teamB)==0)?'Not announced':''); ?></td>
            </tr>
             <?php $__currentLoopData = $result->playing11_teamB; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $playing11): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($key+1); ?> </td>
              <td><?php echo e($playing11->name); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
      </table>  

        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
</div>
</div>
</div>


                                              </td> 
                                             

                                         <td> <?php echo e($result->status_str); ?> </td>
                                         <td> 
                                          <?php echo e(date('Y-m-d h:i:s A',$result->timestamp_start)); ?>

                                            
                                        </td>
                                         <td> 
                                            <?php if($result->current_status==1): ?> 
                                             Prize Distributed 
                                            <?php else: ?>
                                             NA
                                            <?php endif; ?>
                                            </td> 
                                            <td> <a href="<?php echo e(route('match.edit',$result->id)); ?>">
                            <button class="btn btn-success btn-xs">
                            <i class="fa fa-fw fa-edit" title="edit"></i> 
                            </button>
                        </a>
 </td>
                                    </tr>







                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </tbody>
                            </table>
                            <span>
                              Showing <?php echo e(($match->currentpage()-1)*$match->perpage()+1); ?> to <?php echo e($match->currentpage()*$match->perpage()); ?>

                            of  <?php echo e($match->total()); ?> entries </span>
                             <div class="center" align="center">  <?php echo $match->appends(['search' => isset($_GET['search'])?$_GET['search']:'','status' => isset($_GET['status'])?$_GET['status']:''])->render(); ?></div>
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


<!-- start match -->
<div class="modal fade" id="changeMatchStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Match Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
           
          <input type="hidden" name="change_status" value="change_status">
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Match Id:</label>
            <input type="text" class="form-control" id="match_id"  name="match_id" required="" >
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Match Status:</label>
             <select class="form-control" name="status" required="">
                <option value="">Select Status</option>
                <option value="1">Upcoming</option>
                <option value="2">Completed</option>
                <option value="3">Live</option>
                <option value="4">Cancelled</option>
             </select> 
          </div>
         <!--  <div class="form-group">
            <label for="message-text" class="col-form-label">Match Id:</label>
            <textarea class="form-control" id="message-text" ></textarea>
          </div> -->
           <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Save </button>
      </div>
        </form>
      </div>
     
    </div>
  </div>
</div>
<!-- End status -->

<div class="modal fade" id="changeDate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Match Date</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" name="change_date" value="change_date">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Start Date:</label>
            <input type="text" class="form-control form_datetime_start form_datetime" id="start_date" value="<?php echo e(date('Y-m-d H:i')); ?>" readonly name="date_start">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label" >End Date:</label>
            <input type="text" class="form-control form_datetime_end form_datetime" id="end_date" value="<?php echo e(date('Y-m-d H:i')); ?>" readonly name="date_end">
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Match Id:</label>
            <input type="text" class="form-control" id="match_id"  name="match_id" >
          </div>
            
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"> Save </button>
        </div>

        </form>
      </div>
     
    </div>
  </div>
</div>

<div class="modal fade" id="popMsg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Email sent successfully</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="popMsg2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Prize distributed successfully!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>


<?php /**PATH /var/www/sportsfight.in/modules/Admin/views/match/home.blade.php ENDPATH**/ ?>