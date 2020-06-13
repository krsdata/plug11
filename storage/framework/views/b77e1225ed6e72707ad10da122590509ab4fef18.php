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
                    
                      <?php echo $__env->make('packages::partials.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PROFILE SIDEBAR -->
                            <div class="profile-sidebar">
                                <!-- PORTLET MAIN -->
                                <div class="portlet light profile-sidebar-portlet bordered">
                                    <!-- SIDEBAR USERPIC -->
                                    <div class="profile-userpic">
                                    <?php if(!empty($user->profile_image)): ?>
                                    
                                     <img src="<?php echo e($user->profile_image); ?>" class="img-responsive" alt=""> </div>
                                    <?php else: ?>
                                     <img src="<?php echo e(URL::asset('assets/img/user.png')); ?>" class="img-responsive" alt=""> </div>
                                    <?php endif; ?>
                                      
                                    <!-- END SIDEBAR USERPIC -->
                                    <!-- SIDEBAR USER TITLE -->
                                    <div class="profile-usertitle">
                                        <div class="profile-usertitle-name"> <?php echo e($user->first_name); ?> </div>
                                        <div class="profile-usertitle-job"> <?php echo e($user->position); ?> </div>
                                    </div>
                                    <!-- END SIDEBAR USER TITLE -->
                                    <!-- SIDEBAR BUTTONS -->
                                    <div class="profile-userbuttons">
                                        <button type="button" class="btn btn-circle green btn-sm">Email</button>
                                        <button type="button" class="btn btn-circle red btn-sm">Message</button>
                                      <?php if($user->role_type==3): ?>
                                        <a href="<?php echo e(url('admin/mytask/'.$user->id)); ?>">
                                         <button type="button" class="btn btn-circle green btn-sm">Task</button>
                                         </a>
                                         <?php endif; ?>
                                    </div>
                                    <!-- END SIDEBAR BUTTONS -->
                                    <!-- SIDEBAR MENU -->
                                    <div class="profile-usermenu">
                                        <ul class="nav">
                                            <li>
                                               <a href="<?php echo e(url('admin/mytask/'.$user->id)); ?>">
                                                    <i class="icon-home"></i> Overview </a>
                                            </li>
                                            <li class="active">
                                                <a href="#">
                                                    <i class="icon-settings"></i> Account Settings </a>
                                            </li>
                                            <!-- <li>
                                                <a href="#">
                                                    <i class="icon-info"></i> Help </a>
                                            </li> -->
                                        </ul>
                                    </div>
                                    <!-- END MENU -->
                                </div>
                                <!-- END PORTLET MAIN -->
                                <!-- PORTLET MAIN -->
                                <div class="portlet light bordered">
                                    <!-- STAT -->
                                   
                                    <!-- END STAT -->
                                    <div>
                                        <h4 class="profile-desc-title">About <?php echo e($user->first_name); ?></h4>
                                          <div class="row list-separated profile-stat">
                                      <!--   <div class="col-md-4 col-sm-4 col-xs-6">
                                            <div class="uppercase profile-stat-title"> 37 </div>
                                            <div class="uppercase profile-stat-text"> Projects </div>
                                        </div> -->
                                        <!-- <div class="col-md-4 col-sm-4 col-xs-6">
                                            <div class="uppercase profile-stat-title"> 0 </div>
                                            <div class="uppercase profile-stat-text"> Tasks </div>
                                        </div> -->
                                      <!--   <div class="col-md-4 col-sm-4 col-xs-6">
                                            <div class="uppercase profile-stat-title"> 61 </div>
                                            <div class="uppercase profile-stat-text"> Uploads </div>
                                        </div> -->
                                    </div>
                                        <span class="profile-desc-text"><?php echo e($user->about_me); ?></span>
                                        <div class="margin-top-20 profile-desc-link">
                                            <i class="fa fa-phone"></i>
                                            <?php echo e($user->phone); ?>

                                        </div>
                                       <!--  <div class="margin-top-20 profile-desc-link">
                                            <i class="fa fa-twitter"></i>
                                            <a href="http://www.twitter.com/keenthemes/">@keenthemes</a>
                                        </div>
                                        <div class="margin-top-20 profile-desc-link">
                                            <i class="fa fa-facebook"></i>
                                            <a href="http://www.facebook.com/keenthemes/">keenthemes</a>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- END PORTLET MAIN -->
                            </div>
                            <!-- END BEGIN PROFILE SIDEBAR -->
                            <!-- BEGIN PROFILE CONTENT -->
                            <div class="profile-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet light bordered">
                                            <div class="portlet-title tabbable-line">
                                                <div class="caption caption-md">
                                                    <i class="icon-globe theme-font hide"></i>
                                                    <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                                </div>
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                                    </li>
                                                   
                                                    <!-- <li>
                                                        <a href="#tab_1_4" data-toggle="tab">  Payment Info</a>
                                                    </li> -->
                                                </ul>
                                            </div>
                                   <?php echo Form::model($user, ['method' => 'PATCH', 'route' => ['user.update', $user->id],'enctype'=>'multipart/form-data']); ?>

                                   <input type="hidden" name="role" value="<?php echo e($_REQUEST['role_type']); ?>"> 
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            <!-- PERSONAL INFO TAB --> 
                                                <div class="margin-top-10">
                                                    <?php if(count($errors) > 0): ?>
                                                      <div class="alert alert-danger">
                                                          <ul>
                                                              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                  <li><?php echo $error; ?></li>
                                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                          </ul>
                                                      </div>
                                                    <?php endif; ?>
                                                </div>

                                            <?php echo $__env->make('packages::users.formTab1', compact('user'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                            <?php echo Form::close(); ?> 
                                            <!-- END PERSONAL INFO TAB --> 
                                            <?php echo $__env->make('packages::users.formTab2', compact('user'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <!-- END CHANGE AVATAR TAB -->
                                            <!-- CHANGE PASSWORD TAB -->
                                            <!-- END CHANGE PASSWORD TAB -->
                                            <!-- PRIVACY SETTINGS TAB --> 
                                            <?php echo $__env->make('packages::users.formTab4', compact('user'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
                                            <!-- END PRIVACY SETTINGS TAB --> 

                                           
                                        </div>

                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            
            
            <!-- END QUICK SIDEBAR -->
        </div>
        

        
<?php $__env->stopSection(); ?>
<?php echo $__env->make('packages::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/sportsfight.in/modules/Admin/views/users/edit.blade.php ENDPATH**/ ?>