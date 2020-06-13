  <?php $__env->startSection('title', 'Dashboard'); ?>
    <?php $__env->startSection('header'); ?>
    <h1>Dashboard</h1>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('content'); ?> 
      <?php echo $__env->make('packages::partials.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php echo $__env->make('packages::partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            
            <!-- END PAGE HEAD-->
            <!-- BEGIN PAGE BREADCRUMB -->
           <?php echo $__env->make('packages::partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light portlet-fit bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-red"></i>
                                <span class="caption-subject font-red sbold uppercase"><?php echo e($page_title); ?></span>
                            </div>
                        </div>
                            <?php if(Session::has('flash_alert_notice')): ?>
                                 <div class="alert alert-success alert-dismissable" style="margin:10px">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                  <i class="icon fa fa-check"></i>  
                                 <?php echo e(Session::get('flash_alert_notice')); ?> 
                                 </div>
                            <?php endif; ?>
                        <div class="portlet-body table-responsive">
                            <div class="table-toolbar">
                                <div class="row">
                                    <form action="<?php echo e(route('matchTeams')); ?>" method="get" id="filter_data">
                                     
                                    <div class="col-md-3">
                                        <input value="<?php echo e((isset($_REQUEST['search']))?$_REQUEST['search']:''); ?>" placeholder="Search by  name,email" type="text" name="search" id="search" class="form-control" >
                                    </div>
                                    <div class="col-md-2">
                                        <input type="submit" value="Search" class="btn btn-primary form-control">
                                    </div>
                                   
                                </form>
                                 <div class="col-md-2">
                                     <a href="<?php echo e(route('matchTeams')); ?>">   <input type="submit" value="Reset" class="btn btn-default form-control"> </a>
                                </div>
                               
                                </div>
                            </div>
                             
                            <table class="table table-striped table-hover table-bordered" id="">
                                <thead>
                                    <tr>
                                        <th>Sno.</th>
                                   <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th> <?php echo e(\Str::replaceFirst('_'," ",ucfirst($col_name))); ?></th> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <th>Action</th>
                                    </tr>
                                </thead>

                                <?php if($matchTeams->count()==0): ?>
                                <div class="alert alert-danger"><h2> Team not created yet! <h2> </div>
                                <?php endif; ?>
    <tbody>
         <?php $__currentLoopData = $matchTeams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td> <?php echo e((($matchTeams->currentpage()-1)*15)+(++$key)); ?></td>
            <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                   <td>  <?php echo $result->$col_name; ?> </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            <td> 
                

                <a href="#"  data-toggle="modal" data-target="#viewTeams_<?php echo e($result->id); ?>">
                    <button class="btn btn-success btn-xs">
                       View Teams
                    <i class="fa fa-fw fa-eye" title="edit"></i> 
                    </button>
                </a>


<div class="modal fade" id="viewTeams_<?php echo e($result->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg  " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Team List</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <form action="#"> 
      <div class="modal-body">

         <table class="table table-striped table-hover table-bordered" id="contact">
          <thead>
              <tr>
                  <th>Sno.</th>
                  <th> Player Name</th> 
                  <th> Role </th> 
                  <th> Captain </th>  
                  <th> Vice Captain </th>
                  <th> Trump </th>
              </tr>

          </thead>
          <tbody>
            <?php $__currentLoopData = $result->teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($key+1); ?> </td>
              <td><?php echo e($team->title); ?></td>
              <td><?php echo e($team->playing_role); ?></td>

              <td><?php if($result->captain==$team->pid): ?>
                    Yes
                    
                  <?php endif; ?> 
              </td>
              <td><?php if($result->vice_captain==$team->pid): ?>
                    Yes
                    
                  <?php endif; ?>  
              </td>
              <td><?php if($result->trump==$team->pid): ?>
                    Yes
                     
                  <?php endif; ?>  
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 
          </tbody>
      </table>  

        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button><!-- 
            <button type="submit" class="btn btn-success"> Cancel Selected Contest </button> -->
        </div>
      </div>
    </form>
</div>
</div>
</div>

                
                 <?php echo Form::close(); ?>


            </td>
           
        </tr>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    </tbody>
</table>
<span>
        Showing <?php echo e(($matchTeams->currentpage()-1)*$matchTeams->perpage()+1); ?> to <?php echo e($matchTeams->currentpage()*$matchTeams->perpage()); ?>

                            of  <?php echo e($matchTeams->total()); ?> entries </span>
                            
 <div class="center" align="center">  <?php echo $matchTeams->appends(['search' => isset($_GET['search'])?$_GET['search']:''])->render(); ?></div>
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
   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('packages::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/sportsfight.in/modules/Admin/views/matchContest/matchTeams.blade.php ENDPATH**/ ?>