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
                                        <span class="caption-subject font-red sbold uppercase"><?php echo e($heading ?? ''); ?></span>
                                    </div>
                                     
                                </div>
                                <div class="portlet-body table-responsive">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <form action="<?php echo e(route('user')); ?>" method="get" id="filter_data">
                                            <div class="col-md-2">
                                                <select name="status" class="form-control" onChange="SortByStatus('filter_data')">
                                                    <option value="">Search by Status</option>
                                                    <option value="active" <?php if($status==='active'): ?> selected  <?php endif; ?>>Active</option>
                                                    <option value="inActive" <?php if($status==='inActive'): ?> selected  <?php endif; ?>>Inactive</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <select name="role_type" class="form-control" onChange="SortByStatus('filter_data')">
                                                    <option value="">Search by Role</option>
                                                    <?php if($roles): ?>
                                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($role->id); ?>" <?php if($role_type==$role->id): ?> selected <?php endif; ?> ><?php echo e($role->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <input value="<?php echo e((isset($_REQUEST['search']))?$_REQUEST['search']:''); ?>" placeholder="search by Name/Email" type="text" name="search" id="search" class="form-control" >
                                            </div>
                                            <div class="col-md-2">
                                                <input type="submit" value="Search" class="btn btn-primary form-control">
                                            </div>
                                           
                                        </form>
                                         <div class="col-md-2">
                                             <a href="<?php echo e(route('clientuser')); ?>">   <input type="submit" value="Reset" class="btn btn-default form-control"> </a>
                                        </div>
                                       <div class="col-md-2 pull-right">
                                            <div style="width: 150px;" class="input-group"> 
                                                <a href="<?php echo e(route('user.create')); ?>">
                                                    <button class="btn  btn-primary"><i class="fa fa-user-plus"></i> Add User</button> 
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
                                    <?php if($users->count()==0): ?>
                                   
                                     <span class="caption-subject font-red sbold uppercase"> Record not found!</span>
                                    <?php else: ?> 
                                    <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                 <th> Sno. </th>
                                                <th> Full Name </th>
                                                <th> Email </th>
                                                 <th> Account Balance </th>
                                                <th> Phone </th>
                                                <th> <?php echo e(($heading=='Admin Users')?'User Type':''); ?> </th>
                                                <th>Signup Date</th>
                                                <th>Status</th>
                                                <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <tbody>

                                    
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                 <td> <?php echo e((($users->currentpage()-1)*15)+(++$key)); ?></td>
                                                <td> <?php echo e($result->first_name.'  '.$result->last_name); ?> </td>
                                                <td> <?php echo e($result->email); ?> </td>
                                                 <td> <?php echo e($result->balance); ?> INR </td>
                                                <td> <?php echo e($result->phone); ?> </td>
                                                <td class="center"> 
                                               
                                                    <?php if($result->role_type==3): ?>
                                                    <a href="#">
                                                        View Details
                                                        <i class="glyphicon glyphicon-eye-open" title="edit"></i> 

                                                    </a>
                                                    <?php else: ?>
                                                      <?php echo e(($result->role_type==1)?'admin':($result->role_type==2)?'Sales':($result->role_type==4)?'Support':'Admin'); ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php echo Carbon\Carbon::parse($result->created_at)->format('d-m-Y');; ?>

                                                </td>
                                                <td>
                                                    <span class="label label-<?php echo e(($result->status==1)?'success':'warning'); ?> status" id="<?php echo e($result->id); ?>"  data="<?php echo e($result->status); ?>"  onclick="changeStatus(<?php echo e($result->id); ?>,'user')" >
                                                            <?php echo e(($result->status==1)?'Active':'Inactive'); ?>

                                                        </span>
                                                </td>
                                                <td> 
                                                    <a href="<?php echo e(route('user.edit',$result->id)); ?>?role_type=<?php echo e($result->role_type); ?>">
                                                            <i class="fa fa-fw fa-pencil-square-o" title="edit"></i> 
                                                        </a>

                                                        <?php echo Form::open(array('class' => 'form-inline pull-left deletion-form', 'method' => 'DELETE',  'id'=>'deleteForm_'.$result->id, 'route' => array('user.destroy', $result->id))); ?>

                                                        <button class='delbtn btn btn-danger btn-xs' type="submit" name="remove_levels" value="delete" id="<?php echo e($result->id); ?>"><i class="fa fa-fw fa-trash" title="Delete"></i></button>
                                                        
                                                         <?php echo Form::close(); ?>


                                                    </td>
                                               
                                            </tr>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                         <?php endif; ?>   
                                        </tbody>
                                    </table>
                                    Showing <?php echo e(($users->currentpage()-1)*$users->perpage()+1); ?> to <?php echo e($users->currentpage()*$users->perpage()); ?>

                                    of  <?php echo e($users->total()); ?> entries
                                     <div class="center" align="center">  <?php echo $users->appends(['search' => isset($_GET['search'])?$_GET['search']:''])->render(); ?></div>
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

        <script type="text/javascript">
            
            function SortByStatus(filter_data) {
                $('#filter_data').submit();
            }
        </script>
        
<?php $__env->stopSection(); ?>
<?php echo $__env->make('packages::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/sportsfight.in/modules/Admin/views/users/user/index.blade.php ENDPATH**/ ?>