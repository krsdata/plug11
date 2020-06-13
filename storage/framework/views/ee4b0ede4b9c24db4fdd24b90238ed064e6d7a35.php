<div class="form-body">
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button> Please fill the required field! </div>  
 	<div class="form-group <?php echo e($errors->first('title', ' has-error')); ?>  <?php if(session('field_errors')): ?> <?php echo e('has-error'); ?> <?php endif; ?>">
        <label class="control-label col-md-3"> Title <span class="required"> * </span></label>
        <div class="col-md-4"> 
            <?php echo Form::text('title',null, ['class' => 'form-control','data-required'=>1]); ?> 
            
            <span class="help-block" style="color:red"><?php echo e($errors->first('title', ':message')); ?> <?php if(session('field_errors')): ?> <?php echo e('The  apkUpdate name already been available!'); ?> <?php endif; ?></span>
        </div>
    </div> 

    <div class="form-group <?php echo e($errors->first('title', ' has-error')); ?>  <?php if(session('field_errors')): ?> <?php echo e('has-error'); ?> <?php endif; ?>">
        <label class="control-label col-md-3"> Version Code <span class="required"> * </span></label>
        <div class="col-md-4"> 
            <?php echo Form::text('version_code',null, ['class' => 'form-control','data-required'=>1]); ?> 
            example : 3.1
            <span class="help-block" style="color:red"><?php echo e($errors->first('version_code', ':message')); ?> <?php if(session('field_errors')): ?> <?php echo e('The  version_code  already been available!'); ?> <?php endif; ?></span>
        </div>
    </div> 
    <div class="form-group  <?php echo e($errors->first('photo', ' has-error')); ?>">
        <label class="control-label col-md-3"> Upload Apk<span class="required"> * </span></label>
        <div class="col-md-9">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                    <img src=" <?php echo e($url ?? 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'); ?>" alt=""> </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
                    <div>
                    <span class="btn default btn-file">
                        <span class="fileinput-new"> Select APK </span>
                        <span class="fileinput-exists"> Change </span>
                       
                        <?php echo Form::file('apk',null,['class' => 'form-control form-cascade-control input-small']); ?>

 
                          <span class="help-block" style="color:#e73d4a"><?php echo e($errors->first('apk', ':message')); ?></span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                </div>
            </div>
           
        </div>
    </div> 
   
    <div class="form-group <?php echo e($errors->first('description', ' has-error')); ?>">
        <label class="control-label col-md-3">Message<span class="required"> </span></label>
        <div class="col-md-4"> 
            <?php echo Form::textarea('message',null, ['class' => 'form-control','data-required'=>1,'rows'=>3,'cols'=>5]); ?> 
            
            <span class="help-block"><?php echo e($errors->first('message', ':message')); ?></span>
        </div>
    </div> 

     <div class="form-group <?php echo e($errors->first('description', ' has-error')); ?>">
        <label class="control-label col-md-3">Release notes<span class="required"> </span></label>
        <div class="col-md-4"> 
            <?php echo Form::textarea('release_notes',null, ['class' => 'form-control','data-required'=>1,'rows'=>3,'cols'=>5]); ?> 
            
            <span class="help-block"><?php echo e($errors->first('release_notes', ':message')); ?></span>
        </div>
    </div> 
    
    
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
          <?php echo Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']); ?>



           <a href="<?php echo e(route('apkUpdate')); ?>">
<?php echo Form::button('Back', ['class'=>'btn btn-warning text-white']); ?> </a>
        </div>
    </div>
</div> 
    <?php /**PATH /var/www/sportsfight.in/modules/Admin/views/apkUpdate/form.blade.php ENDPATH**/ ?>