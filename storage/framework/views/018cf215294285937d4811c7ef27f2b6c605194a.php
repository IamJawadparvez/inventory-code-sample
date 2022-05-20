<?php $__env->startSection('content'); ?>


<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4><?php echo e(trans('file.add_store')); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>


                        <form id="product-form" method="Post" action="<?php echo e(route('addstores')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('file.Store Name')); ?> *</strong> </label>
                                        <div class="input-group">


                                        	<input type="text" required name="name" class="form-control">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('file.Store Phone')); ?> *</strong> </label>
                                        <div class="input-group">


                                        	<input type="text" required name="phone" class="form-control">

                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('file.Store Email')); ?> *</strong> </label>
                                        <div class="input-group">


                                        	<input type="email" required name="email" class="form-control">

                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('file.Store Address')); ?> *</strong> </label>
                                        <div class="input-group">


                                        	<textarea type="text" required name="address" class="form-control"></textarea>

                                        </div>
                                    </div>
                                </div>

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>