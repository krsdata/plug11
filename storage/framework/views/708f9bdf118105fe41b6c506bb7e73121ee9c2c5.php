
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
                                                <a href="<?php echo e(route('updatePlayerPoints.create')); ?>">
                                                    <button class="btn btn-success"><i class="fa fa-plus-circle"></i> Add Points</button> 
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
                                <div class="portlet-body table-responsive">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <form action="<?php echo e(route('updatePlayerPoints')); ?>" method="get" id="filter_data">
                                             
                                            <div class="col-md-3">
                                                <input value="<?php echo e((isset($_REQUEST['search']))?$_REQUEST['search']:''); ?>" placeholder="Search by  Match Id or PID" type="text" name="search" id="search" class="form-control" >
                                            </div>
                                            <div class="col-md-2">
                                                <input type="submit" value="Search" class="btn btn-primary form-control">
                                            </div>
                                           
                                        </form>
                                         <div class="col-md-2">
                                             <a href="<?php echo e(route('updatePlayerPoints')); ?>">   <input type="submit" value="Reset" class="btn btn-default form-control"> </a>
                                        </div>
                                       
                                        </div>
                                    </div>
                                     <div class="" id="update_msg"></div>
                                    <table class="table table-striped table-hover table-bordered" id="editable">
                                        <thead>
                                            <tr>
                                        <th style="display: none;">#</th>

                                           <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <th>

                            <?php echo e(\Str::replaceFirst('_'," ",ucfirst($col_name))); ?>

                             
                                                </th> 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
            <?php $__currentLoopData = $updatePlayerPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr> 
                     <td class="tabledit-view-mode" style="display: hidden"><?php echo e($result->id); ?></td>
                    <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <td class="tabledit-view-mode"><?php echo $result->$col_name; ?>

                            <?php if($col_name=='pid'): ?>
                             <a href="<?php echo e(route('updatePlayerPoints.edit',$result->id)); ?>">
                            <i class="fa fa-fw fa-edit" title="edit"></i>
                        </a>
                            <?php endif; ?>
                           </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   
                        
                    <td> 
                       <!--  <a href="<?php echo e(route('updatePlayerPoints.edit',$result->id)); ?>">
                            <button class="btn btn-success btn-xs">
                            <i class="fa fa-fw fa-edit" title="edit"></i> 
                            </button>
                        </a>
 
                        <hr> -->
                        <?php echo Form::open(array('class' => 'form-inline pull-left deletion-form', 'method' => 'DELETE',  'id'=>'deleteForm_'.$result->id, 'route' => array('updatePlayerPoints.destroy', $result->id))); ?>

                        <button class='delbtn btn btn-danger btn-xs' type="submit" name="remove_levels" value="delete" id="<?php echo e($result->id); ?>"><i class="fa fa-fw fa-trash" title="Delete"></i></button>
                        
                         <?php echo Form::close(); ?>


                    </td>
                   
                </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </tbody>
        </table>
<span>
  Showing <?php echo e(($updatePlayerPoints->currentpage()-1)*$updatePlayerPoints->perpage()+1); ?> to <?php echo e($updatePlayerPoints->currentpage()*$updatePlayerPoints->perpage()); ?>

  of  <?php echo e($updatePlayerPoints->total()); ?> entries 
</span>

         <div class="center" align="center">  <?php echo $updatePlayerPoints->appends(['search' => isset($_GET['search'])?$_GET['search']:''])->render(); ?></div>
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
        




<style type="text/css">
     .mt-100 {
     margin-top: 100px
 }

 .container-fluid {
     margin-top: 50px
 }

 body {
     background-color: #f2f7fb
 }

 .card {
     border-radius: 5px;
     -webkit-box-shadow: 0 0 5px 0 rgba(43, 43, 43, 0.1), 0 11px 6px -7px rgba(43, 43, 43, 0.1);
     box-shadow: 0 0 5px 0 rgba(43, 43, 43, 0.1), 0 11px 6px -7px rgba(43, 43, 43, 0.1);
     border: none;
     margin-bottom: 30px;
     -webkit-transition: all 0.3s ease-in-out;
     transition: all 0.3s ease-in-out
 }

 .card .card-header {
     background-color: transparent;
     border-bottom: none;
     position: relative
 }

 .card .card-block {
 }

 .table-responsive {
     display: inline-block;
     width: 100%;
     overflow-x: auto
 }

 .card .card-block table tr {
     padding-bottom: 20px
 }

 .table>thead>tr>th {
     border-bottom-color: #ccc
 }

 .table2 th {
     padding: 1.25rem 0.75rem
 }

 td,
 th {
     white-space: nowrap
 }

 .tabledit-input:disabled {
     display: none
 }

</style>
<?php /**PATH /var/www/sportsfight.in/modules/Admin/views/updatePlayerPoints/home.blade.php ENDPATH**/ ?>