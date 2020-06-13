 

<div class="form-body col-md-6">
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button> Please fill the required field! 
    </div> 
 
    <div class="form-group <?php echo e($errors->first('campaign_name', ' has-error')); ?>">
            <label class="control-label col-md-4">Campaign Name <span class="required"> * </span></label>
            <div class="col-md-7"> 
                <?php echo Form::text('campaign_name',null, ['class' => 'form-control','data-required'=>1]); ?> 
                
                <span class="help-block"><?php echo e($errors->first('campaign_name', ':message')); ?></span>
            </div>
    </div>  
       


        <div class="form-group <?php echo e($errors->first('start_date', ' has-error')); ?>  <?php if(session('field_errors')): ?> <?php echo e('has-group'); ?> <?php endif; ?>">
            <label class="col-md-4 control-label">Start Date 
                <span class="required"> * </span>
            </label>
            <div class="col-md-7"> 

                  <?php echo Form::text('start_date',null, ['id'=>'startdate','class' => 'form-control end_date','data-required'=>1,"size"=>"16","data-date-format"=>"dd-mm-yyyy","data-date-start-date"=>"+0d" ]); ?> 
                
                <span class="help-block"><?php echo e($errors->first('start_date', ':message')); ?></span>
            </div> 
        </div>

         <div class="form-group <?php echo e($errors->first('end_date', ' has-error')); ?>  <?php if(session('field_errors')): ?> <?php echo e('has-group'); ?> <?php endif; ?>">
            <label class="col-md-4 control-label">End Date 
                <span class="required"> * </span>
            </label>
            <div class="col-md-7"> 
                <?php echo Form::text('end_date',null, ['id'=>'enddate','class' => 'form-control end_date','data-required'=>1,"size"=>"16","data-date-format"=>"dd-mm-yyyy","data-date-start-date"=>"+0d" ]); ?> 


                
                <span class="help-block"><?php echo e($errors->first('end_date', ':message')); ?></span>
            </div> 
        </div>

        <div class="form-group <?php echo e($errors->first('reward_type', ' has-error')); ?>  <?php if(session('field_errors')): ?> <?php echo e('has-group'); ?> <?php endif; ?>">
            <label class="col-md-4 control-label">Reward Type
                <span class="required"> * </span>
            </label>
            <div class="col-md-7"> 

                <?php echo e(Form::select('reward_type',$status, isset($program->reward_type)?$program->reward_type:'', ['class' => 'form-control'])); ?>

                <span class="help-block"><?php echo e($errors->first('reward_type', ':message')); ?></span>
            </div> 
        </div>

         <div class="form-group <?php echo e($errors->first('amount', ' has-error')); ?>">
            <label class="control-label col-md-4">Fixed/Percentage Amt. <span class="required"> * </span></label>
            <div class="col-md-7"> 
                <?php echo Form::text('amount',null, ['class' => 'form-control','data-required'=>1,'onkeypress'=>'return isNumberKey(event)']); ?> 
                 
                <span class="help-block"><?php echo e($errors->first('amount', ':message')); ?></span>
            </div>
    </div>


</div>
<div class="form-body col-md-6">


    <div class="form-group <?php echo e($errors->first('promotion_type', ' has-error')); ?>  <?php if(session('field_errors')): ?> <?php echo e('has-group'); ?> <?php endif; ?>">
            <label class="col-md-4 control-label">Promotion Type
                <span class="required"> * </span>
            </label>
            <div class="col-md-7"> 

                <?php echo e(Form::select('promotion_type' , ['0'=>'Select Type','1'=>'Referral',2=>'Bonus'], $program->promotion_type,['class' => 'form-control'])); ?>

                <span class="help-block"><?php echo e($errors->first('promotion_type', ':message')); ?></span>
            </div> 
        </div>

     <div class="form-group <?php echo e($errors->first('trigger_condition', ' has-error')); ?>  <?php if(session('field_errors')): ?> <?php echo e('has-group'); ?> <?php endif; ?>">
            <label class="col-md-4 control-label">Trigger Condition
                <span class="required"> * </span>
            </label>
            <div class="col-md-7"> 

                <?php echo e(Form::select('trigger_condition', [0=>'Select Condition','1'=>'Sign Up',2=>'First Transaction'], $program->trigger_condition,['class' => 'form-control'])); ?>

                <span class="help-block"><?php echo e($errors->first('trigger_condition', ':message')); ?></span>
            </div> 
        </div>

     <div class="form-group <?php echo e($errors->first('status', ' has-error')); ?>  <?php if(session('field_errors')): ?> <?php echo e('has-group'); ?> <?php endif; ?>">
            <label class="col-md-4 control-label">Promotion Status
                <span class="required"> * </span>
            </label>
            <div class="col-md-7"> 

                <?php echo e(Form::select('status', [0=>'Select Status','1'=>'Active',2=>'Planned',3=>'Draft'], $program->status,['class' => 'form-control'])); ?>

                <span class="help-block"><?php echo e($errors->first('status', ':message')); ?></span>
            </div> 
        </div>
 
         <div class="form-group <?php echo e($errors->first('customer_type', ' has-error')); ?>">
            <label class="control-label col-md-4">Customer type </label>
            <div class="col-md-7"> 
                <?php echo e(Form::select('customer_type', [0=>'Select Customer Type','1'=>'Public'], $program->customer_type,['class' => 'form-control'])); ?>

                <span class="help-block"><?php echo e($errors->first('customer_type', ':message')); ?></span> 
            </div>
        </div> 
          <div class="form-group <?php echo e($errors->first('description', ' has-error')); ?>">
            <label class="control-label col-md-4">Description<span class="required"> </span></label>
            <div class="col-md-7"> 
                <?php echo Form::textarea('description',null, ['class' => 'form-control','data-required'=>1,'rows'=>3,'cols'=>5]); ?> 
                
                <span class="help-block"><?php echo e($errors->first('description', ':message')); ?></span>
            </div>
        </div> 


    
    
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
          <?php echo Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']); ?>



           <a href="<?php echo e(route('program')); ?>">
<?php echo Form::button('Back', ['class'=>'btn btn-warning text-white']); ?> </a>
        </div>
    </div>
</div>




<div class="form-body">

  <script type="text/javascript">
       <!--
       function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
       //-->
    </script>



</div> 

<?php /**PATH /var/www/sportsfight.in/modules/Admin/views/program/form.blade.php ENDPATH**/ ?>