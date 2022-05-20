<?php $__env->startSection('content'); ?>
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4><?php echo e(trans('file.Add Shipment')); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                        <form  method="Post" action="<?php echo e(route('createshipping')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('file.Production Name')); ?> *</strong> </label>
                                        <div class="input-group">
                                            <select name="production_id" required class="form-control selectpicker">
                                                <option value="<?php echo e(NULL); ?>">Choose</option>
                                                 <?php $__currentLoopData = $productioncategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               <option value="<?php echo e($pc->id); ?>"><?php echo e($pc->name); ?></option>


                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('file.Customer Name')); ?> *</strong> </label>
                                        <div class="input-group">
                                           <input type="text" name=" customername" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('file.Driver Name')); ?> *</strong> </label>
                                        <input type="text" name="drivername" class="form-control"  aria-describedby="name" required>
                                        <span class="validation-msg" id="name-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('file.Vechile No')); ?> *</strong> </label>
                                        <div class="input-group">
                                            <input type="text" name="vechile_no" class="form-control" aria-describedby="code" required>
                                           
                                        </div>
                                        <span class="validation-msg" id="code-error"></span>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('file.Driver No')); ?> *</strong> </label>
                                        <div class="input-group">
                                         <input type="text" name="driver_no" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('file.Quantity')); ?> *</strong> </label>
                                        <div class="input-group">
                                         <input type="text" name="quantity" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                                          
                                
                            </div>
                            <div class="form-group">
                                <input type="submit"  value="submit" class="btn btn-primary">
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