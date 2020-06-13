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
                                        <span class="caption-subject font-red sbold uppercase">Payments History</span>
                                    </div>
                                      
                                     
                                </div>
                                  
                                    <?php if(Session::has('flash_alert_notice') || isset($msg)): ?>
                                         <div class="alert alert-success alert-dismissable" style="margin:10px">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                          <i class="icon fa fa-check"></i>  
                                         <?php echo e(Session::get('flash_alert_notice')); ?> 
                                         <?php echo e($msg??null); ?>

                                         </div>
                                    <?php endif; ?>
                                <div class="portlet-body table-responsive">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <form action="<?php echo e(route('paymentsHistory')); ?>" method="get" id="filter_data">
                                             
                                            <div class="col-md-3">
                                                <input value="<?php echo e((isset($_REQUEST['search']))?$_REQUEST['search']:''); ?>" placeholder="Search by  name" type="text" name="search" id="search" class="form-control" >
                                            </div>
                                            <div class="col-md-2">
                                                <input type="submit" value="Search" class="btn btn-primary form-control">
                                            </div>
                                           
                                        </form>
                                         <div class="col-md-2">
                                             <a href="<?php echo e(route('paymentsHistory')); ?>">   <input type="submit" value="Reset" class="btn btn-default form-control"> </a>
                                        </div>
                                       
                                        </div>
                                    </div>
                                     
                                    <table class="table-responsive table  table-condensed table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th> Sno. </th>
                                                <th> Txt ID </th>
                                                <th> Name </th>
                                                <th>Type</th>
                                                <th>   Amount </th>  
                                                <th> Status</th>
                                                <th>Date</th>  
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php if($transaction->count()==0): ?>
                                          <div class="alert alert-danger alert-dismissable" style="margin:10px">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                          <i class="icon fa fa-check"></i>  
                                            No Payment request found
                                         </div>
                                          
                                          <?php endif; ?>
                                        <?php $__currentLoopData = $transaction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                 <td>   <?php echo e((($transaction->currentpage()-1)*15)+(++$key)); ?> 
                                                </td>
                                                <td><?php echo e($result->transaction_id); ?> </td>
                                                <td> 

                                                   Name: <?php echo e($result->name); ?>,<br>
                                                   Email : <?php echo e($result->email); ?>

                                                   <br>
                                                   Phone : <?php echo e($result->phone); ?> </td>
                                                
                                                 <td><?php echo e($result->payment_type_string); ?> </td>
                                                 <td><?php echo e($result->amount); ?> </td>

                                                 <td><?php echo e($result->payment_status); ?>

                                                 </td>                         
                                                
                                                <td>
                                                        <?php echo Carbon\Carbon::parse($result->updated_at)->format('d-m-Y h:i:s');; ?>

                                                </td>
                                                
                                               
                                            </tr>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                        </tbody>
                                    </table>
<span>
  Showing <?php echo e(($transaction->currentpage()-1)*$transaction->perpage()+1); ?> to <?php echo e($transaction->currentpage()*$transaction->perpage()); ?>

  of  <?php echo e($transaction->total()); ?> entries 
</span>

                                     <div class="center" align="center">  <?php echo $transaction->appends(['search' => isset($_GET['search'])?$_GET['search']:''])->render(); ?></div>
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
        <h4 class="modal-title">Add Fund to Editor Wallets</h4>
      </div>
      <form method="post">
      <div class="modal-body">
        <input type="hidden" name="payment_id" value="" id="payment_id"> 
         <label>Amount</label>
         <input type="number" class="form-control" required="" readonly="" name="amount" id="amount">
         <label>Remarks</label>
         <textarea class="form-control"  required="" name="remarks" id="service_charge"></textarea>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-danger"  > Save </button>
      </div>
      </form>
    </div>

  </div>
</div>



<script type="text/javascript">
    
    function payment(payment_id,amount) {
        document.getElementById("payment_id").value     = payment_id;
        document.getElementById("amount").value         = amount;


    }
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('packages::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/sportsfight.in/modules/Admin/views/payments/paymentHistory.blade.php ENDPATH**/ ?>