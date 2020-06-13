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
 
        <!-- Main content -->
         <!-- Small boxes (Stat box) -->
              <div class="row">
                  <div class="col-md-12">
                     <div class="portlet light portlet-fit portlet-form bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings font-red"></i>
                                        <span class="caption-subject font-red sbold uppercase">Update Profile</span>
                                    </div>
                                    
                                </div>



                       <div class="panel panel-cascade">
                          <div class="panel-body ">
                              
                              <?php if($flash_alert_notice): ?>
                                   <div class="alert alert-success   bg-olive btn-flat margin alert-dismissable" style="margin:10px">
                                      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    <i class="icon fa fa-check"></i>  
                                      <?php echo e($flash_alert_notice); ?>

                                   </div>
                              <?php endif; ?>


                               <?php if($error_msg): ?>
                                   <div class="alert alert-danger  alert-dismissable" style="margin:10px">
                                      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                      <ul>
                                         <?php $__currentLoopData = $error_msg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                                         <li>        <?php echo e($value); ?> </li>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                      </ul> 
                                   </div>
                              <?php endif; ?>
                                      
                                <div class="row"> 
                                <div class="col-md-2"></div>   
                                  <div class="col-md-8"> 
                                    <form method="post" style="margin-top:30px;">
                                      <?php echo $__env->make('packages::users.admin.form', compact('users'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </form>
                                    
                                  </div>
                                </div>
                              </fieldset>  
                          </div>
                    </div>
                    </div>
                </div>            
              </div>  
            <!-- Main row --> 
          </section><!-- /.content -->
      </div> 
     <style type="text/css">
       .form-group{
          float: left;
          width: 100%;
       }  
     </style> 
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('packages::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/sportsfight.in/modules/Admin/views/users/admin/index.blade.php ENDPATH**/ ?>