<script type="text/javascript">
    function removeBtn(id)
    {
        document.getElementById(id).remove();
    }
</script>

<?php if($prizeBreakup->count()>0): ?>
<?php $__currentLoopData = $prizeBreakup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
    <input type="hidden" name="prize_break" value="prize_break">
      
<div class="form-group col-md-12  pull-right priz-breakup" id="remove_<?php echo e($result->id); ?>">
    <input type="hidden" name="prize_break_id[]" value="<?php echo e($result->id); ?>">
    <div class="form-group <?php echo e($errors->first('total_spots', ' has-error')); ?> col-md-3">
        <label class=" col-md-12 pull-left"> Rank   from </label>
        <div class="col-md-12"> 
            <?php echo Form::text('rank_from[]',$result->rank_from, ['class' => 'form-control required' ]); ?> 
            
            <span class="help-block"><?php echo e($errors->first('expected_amount', ':message')); ?></span>
        </div>
    </div> 

    <div class="form-group <?php echo e($errors->first('total_spots', ' has-error')); ?> col-md-3">
        <label class="  col-md-12"> Rank upto</label>
        <div class="col-md-12"> 
            <?php echo Form::text('rank_upto[]',$result->rank_upto, ['class' => 'form-control required']); ?> 
             
        </div>
    </div> 

    <div class="form-group <?php echo e($errors->first('total_spots', ' has-error')); ?> col-md-3">
        <label class=" col-md-12"> Prize amount</label>
        <div class="col-md-12"> 
            <?php echo Form::text('prize_amount[]',$result->prize_amount, ['class' => 'form-control required']); ?> 
            
            <span class="help-block"><?php echo e($errors->first('expected_amount', ':message')); ?></span>
        </div>
    </div>

    <div class="form-group <?php echo e($errors->first('total_spots', ' has-error')); ?> col-md-3">
        <label class=" col-md-12"> </label>
        <div class="col-md-12"> 
                <button class="btn btn-danger" onclick="removeBtn('remove_<?php echo e($result->id); ?>')">Remove</button>      
        </div>
    </div>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    
<?php for($i=1;$i<=$rank_list;$i++): ?>

<input type="hidden" name="prize_break" value="prize_break">
<div class="form-group col-md-12  pull-right priz-breakup">

    <div class="form-group <?php echo e($errors->first('total_spots', ' has-error')); ?> col-md-3">
        <label class=" col-md-12 pull-left"> Rank   from </label>
        <div class="col-md-12"> 
            <?php echo Form::text('rank_from[]',$i, ['class' => 'form-control required' ]); ?> 
            
            <span class="help-block"><?php echo e($errors->first('expected_amount', ':message')); ?></span>
        </div>
    </div> 

    <div class="form-group <?php echo e($errors->first('total_spots', ' has-error')); ?> col-md-3">
        <label class="  col-md-12"> Rank upto</label>
        <div class="col-md-12"> 
            <?php echo Form::text('rank_upto[]',1, ['class' => 'form-control required']); ?> 
             
        </div>
    </div> 

    <div class="form-group <?php echo e($errors->first('total_spots', ' has-error')); ?> col-md-3">
        <label class=" col-md-12"> Prize amount</label>
        <div class="col-md-12"> 
            <?php echo Form::text('prize_amount[]',$i, ['class' => 'form-control required']); ?> 
            
            <span class="help-block"><?php echo e($errors->first('expected_amount', ':message')); ?></span>
        </div>
    </div>  
</div>
<?php endfor; ?>
<?php endif; ?>

<?php if($rank_list>$prizeBreakup->count() && $prizeBreakup->count()): ?>
<?php for($i=1;$i<=($rank_list-$prizeBreakup->count());$i++): ?>

<input type="hidden" name="prize_break" value="prize_break">
<div class="form-group col-md-12  pull-right priz-breakup" id="remove_<?php echo e($i); ?>">

    <div class="form-group <?php echo e($errors->first('total_spots', ' has-error')); ?> col-md-3">
        <label class=" col-md-12 pull-left"> Rank   from </label>
        <div class="col-md-12"> 
            <?php echo Form::text('rank_from[]',null, ['class' => 'form-control required' ]); ?> 
            
            <span class="help-block"><?php echo e($errors->first('expected_amount', ':message')); ?></span>
        </div>
    </div> 

    <div class="form-group <?php echo e($errors->first('total_spots', ' has-error')); ?> col-md-3">
        <label class="  col-md-12"> Rank upto</label>
        <div class="col-md-12"> 
            <?php echo Form::text('rank_upto[]',null, ['class' => 'form-control required']); ?> 
             
        </div>
    </div> 

    <div class="form-group <?php echo e($errors->first('total_spots', ' has-error')); ?> col-md-3">
        <label class=" col-md-12"> Prize amount</label>
        <div class="col-md-12"> 
            <?php echo Form::text('prize_amount[]',null, ['class' => 'form-control required']); ?> 
            
            <span class="help-block"><?php echo e($errors->first('expected_amount', ':message')); ?></span>
        </div>
    </div>  

    <div class="form-group <?php echo e($errors->first('total_spots', ' has-error')); ?> col-md-3">
        <label class=" col-md-12"> </label>
        <div class="col-md-12"> 
                <button class="btn btn-danger" onclick="removeBtn('remove_<?php echo e($i); ?>')">Remove</button>      
        </div>
    </div>

</div>
<?php endfor; ?>
<?php endif; ?>
<?php /**PATH /var/www/sportsfight.in/modules/Admin/views/defaultContest/addPrizeForm.blade.php ENDPATH**/ ?>