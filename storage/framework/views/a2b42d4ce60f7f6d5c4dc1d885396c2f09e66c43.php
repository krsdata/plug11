<div class="tab-pane active" id="tab_1_1"> 
<div class="portlet light bordered">
 <div class="portlet-title">
            <div class="caption">
                <i class="icon-social-dribbble font-green"></i>
                <span class="caption-subject font-green bold uppercase">Personel Info
                </span>
            </div> 
        </div>
   

    <div class="form-group <?php echo e($errors->first('first_name', ' has-error')); ?>">
        <label class="control-label">First Name</label>
        <input type="text" placeholder="First Name" class="form-control" name="first_name" 
        value="<?php echo e(($user->first_name)?$user->first_name:old('first_name')); ?>"> </div>
    <div class="form-group <?php echo e($errors->first('last_name', ' has-error')); ?>" >
        <label class="control-label">Last Name</label>
        <input type="text" placeholder="Last Name" class="form-control" name="last_name" value="<?php echo e(($user->last_name)?$user->last_name:old('last_name')); ?>">  
    </div>
     <div class="form-group <?php echo e($errors->first('email', ' has-error')); ?>">
        <label class="control-label ">Email</label>
        <input type="email" placeholder="Email" class="form-control" name="email" value="<?php echo e(($user->email)?$user->email:old('email')); ?>"> 
    </div>
    <div class="form-group <?php echo e($errors->first('password', ' has-error')); ?>">
        <label class="control-label">Password</label>
        <input type="password" placeholder="******" class="form-control" name="password"> 
    </div>

    <?php if($user->role_type==3): ?>
     <div class="form-group <?php echo e($errors->first('password', ' has-error')); ?>">
        <label class="control-label">Role Type</label>
          <select name="role_type" class="form-control select2me">
               <option value="">Select Roles...</option>
                 <option value="3" selected="selected">Customer</option>
                
                </select>
                <span class="help-block"><?php echo e($errors->first('role_type', ':message')); ?></span>
    </div>

    <?php else: ?>
     <div class="form-group <?php echo e($errors->first('role_type', ' has-error')); ?>">
        <label class="control-label">Role Type</label>
          <select name="role_type" class="form-control select2me">
               <option value="">Select Roles...</option>
                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <option value="<?php echo e($value->id); ?>" <?php echo e(($value->id ==$role_id)?"selected":"selected"); ?>><?php echo e($value->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="help-block"><?php echo e($errors->first('role_type', ':message')); ?></span>
    </div>

    <?php endif; ?> 
   
 
    <div class="form-group <?php echo e($errors->first('about_me', ' has-error')); ?>">
        <label class="control-label">About</label>
        <textarea class="form-control" rows="3" placeholder="Basic detail" name="about_me"><?php echo e($user->about_me); ?></textarea>
    </div>

    <div class="form-group <?php echo e($errors->first('location', ' has-error')); ?>">
        <label class="control-label">Location</label>
        <textarea class="form-control" rows="3" placeholder="Address" name="location" ><?php echo e($user->location); ?></textarea>
    </div>
    <div class="form-group <?php echo e($errors->first('birthday', ' has-error')); ?>">
        <label class="control-label">Birthday</label>
        <input type="text" placeholder="Birthday" class="form-control" id="startdate" name="birthday" value="<?php echo e($user->birthday); ?>"> 
    </div>
     <div class="form-group <?php echo e($errors->first('phone', ' has-error')); ?>">
        <label class="control-label">Mobile Number</label>
        <input type="text" placeholder="Mobile or Phone" class="form-control phone" name="phone"  value="<?php echo e(($user->phone)?$user->phone:old('phone')); ?>"> </div>
    
    
      <?php if($user->role_type==3): ?>
      
<?php endif; ?>
    <?php if($user->role_type==3): ?>
     
 
    <?php endif; ?>
     <div class="margin-top-10">

                <button type="submit" class="btn green" value="personelInfo" name="submit"> Save </button>
                 <a href="<?php echo e(url(URL::previous())); ?>">
<?php echo Form::button('Cancel', ['class'=>'btn btn-warning text-white']); ?> </a>
            </div>  
</div>
</div><?php /**PATH /var/www/sportsfight.in/modules/Admin/views/users/formTab1.blade.php ENDPATH**/ ?>