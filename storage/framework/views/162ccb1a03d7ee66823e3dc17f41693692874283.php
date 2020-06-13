 

<div class="form-body">
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button> Please fill the required field! </div>
  <!--   <div class="alert alert-success display-hide">
        <button class="close" data-close="alert"></button> Your form validation is successful! </div>
-->
        <?php if($match): ?>  

        <div class="form-group <?php echo e($errors->first('is_free', ' has-error')); ?>">
            <label class="control-label col-md-3">Free Contest Type</label>
            <div class="col-md-4"> 
                <select name="is_free" class="form-control">
                    <option value="0">False</option>
                    <option value="1">True</option>
                </select>
                
                <span class="help-block"><?php echo e($errors->first('is_free', ':message')); ?></span>
            </div>
        </div>

         <div class="form-group <?php echo e($errors->first('match_id', ' has-error')); ?>">
            <label class="control-label col-md-3">Match ID </label>
            <div class="col-md-4"> 
                <?php echo Form::text('match_id',$match, ['class' => 'form-control']); ?> 
                
                <span class="help-block"><?php echo e($errors->first('match_id', ':message')); ?></span>
            </div>
        </div> 
        <?php endif; ?>


        <div class="form-group <?php echo e($errors->first('contest_type', ' has-error')); ?>">
            <label class="control-label col-md-3">Contest type <span class="required"> * </span></label>
            <div class="col-md-4"> 
                

                 <?php echo e(Form::select('contest_type',$contest_type, isset($defaultContest->contest_type)?$defaultContest->contest_type:'', ['class' => 'form-control'])); ?>


                
                <span class="help-block"><?php echo e($errors->first('contest_type', ':message')); ?></span>
            </div>
        </div> 


         <div class="form-group <?php echo e($errors->first('entry_fees', ' has-error')); ?>">
            <label class="control-label col-md-3">Entry fees </label>
            <div class="col-md-4"> 
                <?php echo Form::text('entry_fees',null, ['class' => 'form-control']); ?> 
                
                <span class="help-block"><?php echo e($errors->first('entry_fees', ':message')); ?></span>
            </div>
        </div> 
         <div class="form-group <?php echo e($errors->first('total_spots', ' has-error')); ?>">
            <label class="control-label col-md-3">Total spots </label>
            <div class="col-md-4"> 
                <?php echo Form::text('total_spots',null, ['class' => 'form-control']); ?> 
                
                <span class="help-block"><?php echo e($errors->first('total_spots', ':message')); ?></span>
            </div>
        </div> 


        <div class="form-group <?php echo e($errors->first('prize_percentage', ' has-error')); ?>">
            <label class="control-label col-md-3">Prize percentage </label>
            <div class="col-md-4"> 
                <?php echo Form::text('prize_percentage',null, ['class' => 'form-control']); ?> 
                
                <span class="help-block"><?php echo e($errors->first('prize_percentage', ':message')); ?></span>
            </div>
        </div> 

        <div class="form-group <?php echo e($errors->first('first_prize', ' has-error')); ?>">
            <label class="control-label col-md-3">First Prize </label>
            <div class="col-md-4"> 
                <?php echo Form::text('first_prize',null, ['class' => 'form-control']); ?> 
                
                <span class="help-block"><?php echo e($errors->first('first_prize', ':message')); ?></span>
            </div>
        </div> 

        <div class="form-group <?php echo e($errors->first('winner_percentage', ' has-error')); ?>">
            <label class="control-label col-md-3">Winner Percentage</label>
            <div class="col-md-4"> 
                <?php echo Form::text('winner_percentage',null, ['class' => 'form-control']); ?> 
                
                <span class="help-block"><?php echo e($errors->first('winner_percentage', ':message')); ?></span>
            </div>
        </div> 
           

       <div class="form-group <?php echo e($errors->first('cancellation', ' has-error')); ?>">
            <label class="control-label col-md-3">Cancellation</label>
            <div class="col-md-4"> 
                <?php echo Form::text('cancellation',null, ['class' => 'form-control']); ?> 
                
                <span class="help-block"><?php echo e($errors->first('cancellation', ':message')); ?></span>
            </div>
        </div>

        <div class="form-group <?php echo e($errors->first('total_winning_prize', ' has-error')); ?>">
            <label class="control-label col-md-3">Total Winning Prize</label>
            <div class="col-md-4"> 
                <?php echo Form::text('total_winning_prize',null, ['class' => 'form-control']); ?> 
                <span class="help-block"><?php echo e($errors->first('total_winning_prize', ':message')); ?></span>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-3 col-md-9">
              <?php echo Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']); ?>



               <a href="<?php echo e(route('defaultContest')); ?>">
    <?php echo Form::button('Back', ['class'=>'btn btn-warning text-white']); ?> </a>
            </div>
        </div>
    </div>
<?php /**PATH /var/www/sportsfight.in/modules/Admin/views/defaultContest/form.blade.php ENDPATH**/ ?>