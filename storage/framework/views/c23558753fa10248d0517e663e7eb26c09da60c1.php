<div class="form-group<?php echo e($errors->first('name', ' has-error')); ?>">
    <label class="control-label col-md-3"> Name 
      <span class="required">*</span>
      </label>
    <div class="col-md-4"> 
        <?php echo Form::text('name',$users->name, ['class' => 'form-control']); ?> 
          <span class="label label-danger"><?php echo e($errors->first('name', ':message')); ?></span>
    </div>
  </div> 

   <div class="form-group<?php echo e($errors->first('email', ' has-error')); ?>">
    <label class="control-label col-md-3"> Email <span class="required">*</span></label>
    <div class="col-md-4"> 
        <?php echo Form::text('email',$users->email, ['class' => 'form-control ']); ?> 
          <span class="label label-danger"><?php echo e($errors->first('email', ':message')); ?></span>
    </div>
  </div> 
   <div class="form-group<?php echo e($errors->first('password', ' has-error')); ?>">
    <label class="control-label col-md-3"> Password <span class="required">*</span></label>
    <div class="col-md-4"> 
        <?php echo Form::text('password',null, ['class' => 'form-control ','placeholder'=>'******']); ?> 
          <span class="label label-danger"><?php echo e($errors->first('password', ':message')); ?></span>
    </div>
  </div> 

  <div class="form-group">
      <label class="control-label col-md-3"></label>
      <div class="col-md-4">
          <?php echo Form::submit('Update', ['class'=>'btn btn-primary text-white']); ?>

          <a href="<?php echo e(url('admin')); ?>" 
          <?php echo Form::button('Back', ['class'=>'btn btn-warning text-white']); ?>

          </a>
      </div>
  </div> 
<?php /**PATH /var/www/sportsfight.in/modules/Admin/views/users/admin/form.blade.php ENDPATH**/ ?>