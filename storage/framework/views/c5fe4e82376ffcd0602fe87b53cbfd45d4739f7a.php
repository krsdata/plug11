<div class="form-body">
<div class="alert alert-danger display-hide">
    <button class="close" data-close="alert"></button> Please fill the required field! </div> 
    <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="form-group <?php echo e($errors->first($col_name, ' has-error')); ?>  <?php if(session('field_errors')): ?> <?php echo e('has-error'); ?> <?php endif; ?>">
        <label class="control-label col-md-3">  <?php echo e($col_name); ?> <span class="required"> * </span></label>
        <div class="col-md-4"> 
            <?php echo Form::text($col_name,null, ['class' => 'form-control','data-required'=>1]); ?> 
            
            <span class="help-block" style="color:red"><?php echo e($errors->first($col_name, ':message')); ?> </span>
        </div>
    </div>  
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
          <?php echo Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']); ?>



       <a href="<?php echo e(route('match')); ?>">
<?php echo Form::button('Back', ['class'=>'btn btn-warning text-white']); ?> </a>
    </div>
</div>
</div>


<?php /**PATH /var/www/sportsfight.in/modules/Admin/views/match/form.blade.php ENDPATH**/ ?>