<div class="tab-pane" id="tab_1_2">  
<div class="portlet light bordered">
 <div class="portlet-title">
            <div class="caption">
                <i class="icon-social-dribbble font-green"></i>
                <span class="caption-subject font-green bold uppercase">Picture / Logo
                </span>
            </div> 
        </div>
<input type="hidden" name="tab" value="avtar">
    <div class="form-group">
        <div class="clearfix margin-top-10">
                 <label class="control-label">
                 <p> <b>Profile Image</b> </p></label>
                 
        </div>
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                 <?php if(!$user->profile_image): ?>
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> 
                        <?php else: ?>
                         <img src="<?php echo e($user->profile_image); ?>" alt="profile_image"> 
                        <?php endif; ?>
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
            </div>
            <div>
                <span class="btn default btn-file">
                <span class="fileinput-new"> Select image </span>
                <span class="fileinput-exists"> Change </span>
                       
                <?php echo Form::file('profile_image',null,['class' => 'form-actionsontrol form-cascade-control input-small']); ?> 
                </span>
                <span class="help-block" style="color:#e73d4a"><?php echo e($errors->first('profile_image', ':message')); ?></span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove    
                    </a>
            </div>
        </div>
         
            </div>
             <div class="form-group">
                
                <div class="clearfix margin-top-10">
                    <span class="label label-danger">NOTE! </span>
                    <span> 
                    <br>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                </div>
            </div>

            <div class="margin-top-10"> 
                 <button type="submit" class="btn green" value="avtar" name="submit"> Save Changes </button>
                <button type="submit" class="btn default"> Cancel </button>
            </div> 
           <!--  <?php echo Form::close(); ?> -->
            </div>
          
</div><?php /**PATH /var/www/sportsfight.in/modules/Admin/views/users/formTab2.blade.php ENDPATH**/ ?>