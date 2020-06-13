
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
                                        <span class="caption-subject font-red sbold uppercase"><?php echo e($heading); ?>s</span>
                                    </div>
                                    <div class="col-md-2 pull-right">
                                            <div style="width: 150px;" class="input-group"> 
                                                <a href="<?php echo e(route('bankAccount')); ?>">
                                                    <button  class="btn btn-success"><i class="fa fa-plus-circle"></i> Verify bank details </button> 
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
                                            <form action="<?php echo e(route('documents')); ?>" method="get" id="filter_data">
                                             
                                            <div class="col-md-3">
                                                <input value="<?php echo e((isset($_REQUEST['search']))?$_REQUEST['search']:''); ?>" placeholder="Search by  name" type="text" name="search" id="search" class="form-control" >
                                            </div>
                                            <div class="col-md-2">
                                                <input type="submit" value="Search" class="btn btn-primary form-control">
                                            </div>
                                           
                                        </form>
                                         <div class="col-md-2">
                                             <a href="<?php echo e(route('documents')); ?>">   <input type="submit" value="Reset" class="btn btn-default form-control"> </a>
                                        </div>
                                       
                                        </div>
                                    </div>
                                     
                                    <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th> Sno. </th>
                                                <th> User Details </th> 
                                                <th> Document Type </th> 
                                                <th> Document Numebr</th> 
                                                <th> Image </th> 
                                                <th> Status </th> 
                                                <th>Action</th>
                                                <th>Created date</th> 
                                               <!--  <th>Action</th>  -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                 <td>   <?php echo e((($documents->currentpage()-1)*15)+(++$key)); ?> 
                                                </td>
                                                <td>  
                                                    <?php if(isset($result->user)): ?>
                                                    <?php echo e($result->user->first_name); ?>

                                                     <!-- | <?php echo e($result->user->email); ?>  -->
                                                <?php endif; ?>
                                            </td>  
                                                <td>  <?php echo e($result->doc_type); ?> </td> 
                                                 <td>  <?php echo e($result->doc_number); ?> </td> 
                                                <td>
                                                  <?php if($result->doc_type=='adharcard'): ?>
                                                
                                                <img src="<?php echo e($result->doc_url_front); ?>" width="100px" height="50px;"  data-toggle="modal" data-target="#doc_url_front_<?php echo e($result->id); ?>">  


                                                 <!-- Modal -->
  <div class="modal fade" id="doc_url_front_<?php echo e($result->id); ?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo e($result->doc_type); ?></h4>
        </div>
        <div class="modal-body">
          <img src="<?php echo e($result->doc_url_back); ?>" width="100%" height="500px" >
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


                                                   
                                                  <img src="<?php echo e($result->doc_url_back); ?>" width="100px" height="50px;" data-toggle="modal" data-target="#doc_url_back_<?php echo e($result->id); ?>">  



  <!-- Modal -->
  <div class="modal fade" id="doc_url_back_<?php echo e($result->id); ?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo e($result->doc_type); ?></h4>
        </div>
        <div class="modal-body">
          <img src="<?php echo e($result->doc_url_back); ?>" width="100%" height="500px" >
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


                                                <?php else: ?>
                                                  <?php if($result->doc_type=='pancard'): ?>
                                                 
  <img src="<?php echo e($result->doc_url_front); ?>" width="100px" height="50px;" data-toggle="modal" data-target="#doc_url_front<?php echo e($result->id); ?>">  
                                                  <!-- Modal -->
  <div class="modal fade" id="doc_url_front<?php echo e($result->id); ?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo e($result->doc_type); ?></h4>
        </div>
        <div class="modal-body">
          <img src="<?php echo e($result->doc_url_front); ?>" width="100%" height="500px" >
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


                                                  <?php else: ?>
                                                    NA
                                                  <?php endif; ?>

                                                <?php endif; ?>

                                                </td>
                                                <td> 
                                                  <?php if($result->status==2): ?> Approved
                                                  <?php elseif($result->status==3): ?> Rejected
                                                  <?php else: ?>
                                                  Pending
                                                  <?php endif; ?> 

                                                 </td>
                                                 <td>
                                                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="getCategory('<?php echo e($result->id); ?>','<?php echo e($result->status); ?>')" >Approve</button>
                                                    
                                                    <?php if($result->status==2): ?>
                                                    <span class="glyphicon glyphicon-ok"></span>
                                                    <?php endif; ?>
                                                    <ion-icon name="close-circle-outline"></ion-icon>
                                                  </td>
                                                <td>
                                                        <?php echo Carbon\Carbon::parse($result->created_at)->format('d-m-Y');; ?>

                                                </td>
                                                    
                                                <td>  
                                                        <?php echo Form::open(array('class' => 'form-inline pull-left deletion-form', 'method' => 'DELETE',  'id'=>'deleteForm_'.$result->id, 'route' => array('documents.destroy', $result->id))); ?>

                                                       <!--  <button class='delbtn btn btn-danger btn-xs' type="submit" name="remove_levels" value="delete" id="<?php echo e($result->id); ?>"><i class="fa fa-fw fa-trash" title="Delete"></i></button> -->
                                                        
                                                         <?php echo Form::close(); ?>


                                                    </td>
                                               
                                            </tr>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                        </tbody>
                                    </table>
<span>
  Showing <?php echo e(($documents->currentpage()-1)*$documents->perpage()+1); ?> to <?php echo e($documents->currentpage()*$documents->perpage()); ?>

  of  <?php echo e($documents->total()); ?> entries 
</span>

                                     <div class="center" align="center">  <?php echo $documents->appends(['search' => isset($_GET['search'])?$_GET['search']:''])->render(); ?></div>
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
        
        <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Are you sure want to approve?</h4>
      </div>
      <form method="post">
      <div class="modal-body">   
        <div class="form-group">
          <input type="hidden" name="doc_id" id="doc_id">
            <label for="sel1">Select Status:</label>
        <select class="form-control" id="document_status" name="document_status">
          <option value="0">Select Status</option>
          <option value="2">Approved</option>
          <option value="3">Rejected</option> 
        </select>
      </div>
      <div class="form-group">
      <label for="comment">Note:</label>
      <textarea class="form-control" rows="5" id="notes" name="notes"></textarea>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-danger"  > Save </button>
      </div>
      </form>
    </div>
  </div>
</div>
notes

<script type="text/javascript">
    
    function getCategory(doc_id,status) {
        document.getElementById("doc_id").value  = doc_id;
        var doc_id = $("#document_status option[value='"+status+"']").attr("selected","selected");

    }
</script><?php /**PATH /var/www/sportsfight.in/modules/Admin/views/documents/home.blade.php ENDPATH**/ ?>