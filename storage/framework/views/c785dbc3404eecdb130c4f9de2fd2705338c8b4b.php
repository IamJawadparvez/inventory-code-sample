<?php $__env->startSection('content'); ?>


<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4><?php echo e(trans('file.add_production')); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>


                        <form method="Post" action="<?php echo e(route('addproduction')); ?>">

                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('file.category')); ?> *</strong> </label>
                                        <div class="input-group">



                                        	<select  name="main_category" class="form-control" id="category">

                                        		
                                        		<option value="<?php echo e(NULL); ?>">Choose</option>
                                        		<?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        		<?php

												                      $name = strtolower($cat->name);
												                      $name = str_replace(' ','_',$name);

												                    ?>
                                        			<option data-div="<?php echo e($name); ?>" value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                                        		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        	</select>

                                        </div>
                                    </div>
                                </div>


                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                            	<?php

												                      $name = strtolower($cat->name);
												                      $name = str_replace(' ','_',$name);

												                    ?>


                            	<div class="col-md-12 category_divs" id="<?php echo e($name); ?>" style="display: none">

								<div class="row">

									<?php $__currentLoopData = $cat->subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

									<input type="hidden" name="category<?php echo e($cat->id); ?>[]" value="<?php echo e($sc->id); ?>">
									<div class="col-md-3">
	                                    <div class="form-group">
	                                        <label><strong><?php echo e(trans('file.'.$sc->name)); ?> *</strong> </label>
	                                        <div class="input-group">

	                                        	<?php if($sc->type=='select'): ?>
	                                        	<select name="subcategory<?php echo e($cat->id); ?>[]" class="form-control sub_cat_color">

	                                        			
	                                        		<option value="<?php echo e(NULL); ?>">Choose</option>
	                                        		<?php $__currentLoopData = $sc->cat_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                                        		<option value="<?php echo e($values->id); ?>"><?php echo e($values->name); ?></option>

	                                        		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	                                        	</select>
	                                        	<?php else: ?>
	                                        	<input type="text" name="subcategory<?php echo e($cat->id); ?>[]" class="form-control">
	                                        	<?php endif; ?>


	                                        </div>
	                                    </div>
	                                </div>



									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            	</div>



							</div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	



                            </div>
                            <div class="form-group">
                                <input type="submit" value="<?php echo e(trans('file.submit')); ?>" id="submit-btn" class="btn btn-primary">
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
		
	$('#category').change(function(){

		div = $('#category option:Selected').data('div');			
		$('.category_divs').hide();

		$('#'+div).show();

	});


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>