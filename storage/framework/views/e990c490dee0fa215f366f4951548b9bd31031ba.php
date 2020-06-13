 
    <?php $__env->startSection('header'); ?>
    <h1>Dashboard</h1>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('content'); ?> 
      <?php echo $__env->make('partials.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- Left side column. contains the logo and sidebar -->
    


  <!--Section: Content-->
  <section  id="termscondition" data-aos="fade-up">
      <div class="container my-5">
           <div class="row justify-content-end">
					<div class="col-md-12 ">
						<div class="heading-section text-center ftco-animate">
							<span class="subheading">Change Password</span>
                        <h2 class="mb-4" style="text-decoration: underline">Change Password</h2></div>       	
				</div>
				<div class="col-md-12">
          
  <div class=" " style="border:1px solid #ccc; padding: 50px">
 
  <?php if(session('status')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('status')); ?> 
        <?php Session::pull('status'); ?>
    </div>
<?php endif; ?>

 
  <?php if(session('status_1')): ?>
    <div class="alert alert-info">
        <?php echo e(session('status_1')); ?>

        <?php Session::pull('status_1'); ?>
    </div>
<?php endif; ?>
  <form method="POST" action="<?php echo e(url('changePasswordToken')); ?>" accept-charset="UTF-8" class="" id="users_form"> 
      <?php echo csrf_field(); ?>
     <div class="form-group ">
        <label class="control-label ">Password</label>
        <input type="text"  class="form-control" name="password"> 
    </div>
    <input type="hidden" name="token" value="<?php echo e($token??''); ?>">
     
     <div class="form-group ">
       <input type="submit" name="submit" value="sumit"   class=" btn btn-info">
     </div>
  </div>
</form>
                  
                                
        </div>
      </div>
		    </div>
        </div>
	</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/sportsfight.in/resources/views/changePassword.blade.php ENDPATH**/ ?>