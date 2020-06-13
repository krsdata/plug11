  <?php $__env->startSection('title', 'Dashboard'); ?>
    <?php $__env->startSection('header'); ?>
    <h1>Dashboard</h1>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('content'); ?> 
      <?php echo $__env->make('packages::partials.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php echo $__env->make('packages::partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     
            <!-- END SIDEBAR -->
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
                                        <span class="caption-subject font-red sbold uppercase"><?php echo e($heading); ?></span>
                                    </div>
                                    <div class="col-md-12 pull-right">
                                        <div class=" pull-right">
                                            <div   class="input-group"> 
                                                <a href="<?php echo e(route('match')); ?>">
                                                    <button  class="btn btn-success"><i class="fa fa-plus-circle"></i> Back </button> 
                                                </a> 
                                            </div>
                                        </div>
                                         
                                    </div>
                                        
                                     
                                </div>
                                  
                                    <?php if(Session::has('flash_alert_notice')): ?>
                                         <div class="alert alert-success alert-dismissable" style="margin:10px">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                          <i class="icon fa fa-check"></i>  
                                         <?php echo e(Session::get('flash_alert_notice')); ?> 
                                         </div>
                                    <?php endif; ?>
                                <div class="portlet-body"> 
                                    <table class="table table-striped table-hover table-bordered" id="contact">  
                                        <tbody>
                                            <?php $__currentLoopData = $match; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <?php if($key=='created_at'): ?> 
                                                <th>  Created Date </th>
                                                <td>  
                                                     <?php echo Carbon\Carbon::parse($result)->format('m-d-Y');; ?>


                                                </td> 
                                                 <?php else: ?>
                                                <th>  <?php echo e(str_replace('_',' ',ucfirst($key))); ?> </th>
                                                <td> <?php echo e(str_replace('_',' ',ucfirst($result))); ?> </td>
                                                 <?php endif; ?>  
                                            </tr>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                        </tbody>
                                    </table>  

                                    <table class="table table-striped table-hover table-bordered" id="contact">
                                        <thead>
                                            <tr> <td colspan="9">
                                               <b> <center> Contest List </center> </b>
                                            </td> </tr>
                                        </thead>
                                        <thead>
                                            <tr> 
                                                 <th> Ctrate contest Id </th>
                                                <th> Match Id </th>
                                                <th> contest_type</th> 
                                                <th> total_winning_prize </th> 
                                                <th> entry_fees </th> 
                                                <th> total_spots</th> 
                                                <th> filled_spot </th> 
                                                 <th> first_prize </th>  
                                                 <th> cancellation </th>   
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $conetst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                 <td> <?php echo e($result->id); ?> </td>
                                                 <td> <?php echo e($result->match_id); ?> </td>
                                                 <td> <?php echo e($result->contest_type); ?> </td>
                                                <td> <?php echo e($result->total_winning_prize); ?> </td>

                                                <td> <?php echo e($result->entry_fees); ?> </td>
                                                <td> <?php echo e($result->total_spots); ?> </td>
                                                <td> <?php echo e($result->filled_spot); ?> </td>
                                                <td> <?php echo e($result->first_prize); ?> </td>
                                                <td> <?php echo e($result->cancellation); ?> </td>
                                               
                                            </tr>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                        </tbody>
                                    </table>

                                      <table class="table table-striped table-hover table-bordered" id="contact">
                                        <thead>
                                            <tr> <td colspan="9">
                                               <b> <center> Player List </center> </b>
                                            </td> </tr>
                                        </thead>
                                        <thead>
                                            <tr>  <th> Sno.</th>
                                                 <th> Match Id </th>
                                                <th> PID</th> 
                                                <th> Player Team ID </th> 
                                                <th> Player Name </th> 
                                                <th> Country</th> 
                                                <th> Playing role </th> 
                                                 <th> Nationality </th>   
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $player; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td> <?php echo e(++$key); ?> </td>
                                                  <td> <?php echo e($result->match_id); ?> </td>
                                                 <td> <?php echo e($result->pid); ?> </td>
                                                <td> <?php echo e($result->team_id); ?> </td>

                                                <td> <?php echo e($result->title); ?> </td>
                                                <td> <?php echo e($result->country); ?> </td>
                                                <td> <?php echo e($result->playing_role); ?> </td>
                                                <td> <?php echo e($result->nationality); ?> </td> 
                                               
                                            </tr>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                        </tbody>
                                    </table>
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
<?php echo $__env->make('packages::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/sportsfight.in/modules/Admin/views/match/show.blade.php ENDPATH**/ ?>