
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
                                       <!--  <div class="col-md-2 pull-right">
                                            <div style="width: 150px;" class="input-group"> 
                                                <a href="<?php echo e(route('wallets.create')); ?>">
                                                    <button class="btn btn-success"><i class="fa fa-plus-circle"></i> Add <?php echo e($heading); ?></button> 
                                                </a>
                                            </div>
                                        </div>  -->
                                     
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
                                            <form action="<?php echo e(route('wallets')); ?>" method="get" id="filter_data">
                                             
                                            <div class="col-md-3">
                                                <input value="<?php echo e((isset($_REQUEST['search']))?$_REQUEST['search']:''); ?>" placeholder="Search by  name,email" type="text" name="search" id="search" class="form-control" >
                                            </div>
                                            <div class="col-md-2">
                                                <input type="submit" value="Search" class="btn btn-primary form-control">
                                            </div>
                                           
                                        </form>
                                         <div class="col-md-2">
                                             <a href="<?php echo e(route('wallets')); ?>">   <input type="submit" value="Reset" class="btn btn-default form-control"> </a>
                                        </div>
                                       
                                        </div>
                                    </div>
                                     
                                    <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th>Sno.</th>
                                           <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <th> <?php echo e(ucfirst($col_name)); ?></th> 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
            <?php $__currentLoopData = $wallets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
                <tr>
                    <td> <?php echo e((($wallets->currentpage()-1)*15)+(++$key)); ?></td>
                    <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                           <td>  <?php echo $result->$col_name; ?> </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    <td> 
                        <a href="<?php echo e(route('wallets.edit',$result->id)); ?>">
                            <button class="btn btn-success btn-xs">
                            <i class="fa fa-fw fa-edit" title="edit"></i> 
                            </button>
                        </a>

                        <a href="<?php echo e(route('paymentsHistory','search='.$result->user_id)); ?>">
                            <button class="btn btn-success btn-xs">
                                Payments History
                            <i class="fa fa-fw fa-eye" title="edit"></i> 
                            </button>
                        </a>
 
                        
                         <?php echo Form::close(); ?>


                    </td>
                   
                </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </tbody>
        </table>
<span>
  Showing <?php echo e(($wallets->currentpage()-1)*$wallets->perpage()+1); ?> to <?php echo e($wallets->currentpage()*$wallets->perpage()); ?>

  of  <?php echo e($wallets->total()); ?> entries 
</span>
         <div class="center" align="center">  <?php echo $wallets->appends(['search' => isset($_GET['search'])?$_GET['search']:''])->render(); ?></div>
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
        <?php /**PATH /var/www/sportsfight.in/modules/Admin/views/wallets/home.blade.php ENDPATH**/ ?>