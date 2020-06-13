
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
                                     <div class="col-md-2 pull-right">
                                            <div style="width: 150px;" class="input-group"> 
                                                <a href="<?php echo e(route('defaultContest.create')); ?>">
                                                    <button  class="btn btn-success"><i class="fa fa-plus-circle"></i> Create Contest</button> 
                                                </a>
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
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <form action="<?php echo e(route('defaultContest')); ?>" method="get" id="filter_data">
                                             
                                            <div class="col-md-3">
                                                <input value="<?php echo e((isset($_REQUEST['search']))?$_REQUEST['search']:''); ?>" placeholder="Search " type="text" name="search" id="search" class="form-control" >
                                            </div>
                                            <div class="col-md-2">
                                                <input type="submit" value="Search" class="btn btn-primary form-control">
                                            </div>
                                           
                                        </form>
                                         <div class="col-md-2">
                                             <a href="<?php echo e(route('defaultContest')); ?>">   <input type="submit" value="Reset" class="btn btn-default form-control"> </a>
                                        </div>
                                       
                                        </div>
                                    </div>
                                     
                                    <table class="table table-striped table-hover table-bordered" id="contact">
                                        <thead>
                                            <tr>
                                                 <th>Sno.</th>
                                                <th> Contest type </th>
                                                <th> Entry fees </th>
                                                <th> Total spots </th>
                                                <th> First prize </th>
                                                <th> Winner percentage </th>
                                                <th> Total winning prize </th> 
                                                  
                                                <th>Prize Breakup</th> 
                                                <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $defaultContest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <th>  <?php echo e(++$key); ?> </th>
                                                <td> <?php echo e($contest_type[$result->contest_type]); ?> </td>
                                                <td> <?php echo e($result->entry_fees); ?> </td>
                                                <td> <?php echo e($result->total_spots); ?> </td>
                                                <td> <?php echo e($result->first_prize); ?> </td>
                                                <td> <?php echo e($result->winner_percentage); ?> </td>
                                                <td> <?php echo e($result->total_winning_prize); ?> </td>

                                                <td>
                                                <a href="<?php echo e(route('defaultContest.show',$result->id)); ?>">Add Prize Breakup</a>
                                                </td>
                                                    
                                                <td> 
                                                    <a href="<?php echo e(route('defaultContest.edit',$result->id)); ?>">
                                                        <i class="fa fa-edit" title="edit"></i> 
                                                    </a>

                                                    <?php echo Form::open(array('class' => 'form-inline pull-left deletion-form', 'method' => 'DELETE',  'id'=>'deleteForm_'.$result->id, 'route' => array('defaultContest.destroy', $result->id))); ?>

                                                    <button class='delbtn btn btn-danger btn-xs' type="submit" name="remove_levels" value="delete" id="<?php echo e($result->id); ?>"><i class="fa fa-fw fa-trash" title="Delete"></i></button>
                                                    
                                                     <?php echo Form::close(); ?>


                                                </td>
                                               
                                            </tr>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                        </tbody>
                                    </table>
                                    <span>
                                     
                                     <div class="center" align="center">  <?php echo $defaultContest->appends(['search' => isset($_GET['search'])?$_GET['search']:''])->render(); ?></div>
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
        
      <?php /**PATH /var/www/sportsfight.in/modules/Admin/views/defaultContest/home.blade.php ENDPATH**/ ?>