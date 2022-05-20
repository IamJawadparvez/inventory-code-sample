<?php $__env->startSection('content'); ?>


<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4><?php echo e(trans('file.request')); ?></h4>
                    </div>
                    <div class="card-body">



                           <div class="table-responsive">
                                <table id="product-data-table" class="table table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="not-exported"><?php echo e(trans('file.id')); ?></th>
                                            <th><?php echo e(trans('file.order_id')); ?></th>
                                            <th><?php echo e(trans('file.warehouse')); ?></th>
                                            <th><?php echo e(trans('file.item')); ?></th>
                                            <th><?php echo e(trans('file.Quantity')); ?></th>
                                           
                                            <th><?php echo e(trans('file.status')); ?></th>
                                            <th><?php echo e(trans('file.action')); ?></th>
                                        
                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <tr>
                                                <td><?php echo e($wr->id); ?></td>
                                                <td>#<?php echo e(substr($wr->order_id, 0,7)); ?></td>
                                                <td><?php echo e($wr->warehouse->name); ?></td>
                                                <td><?php echo e(isset($wr->rawmaterial)?$wr->rawmaterial->product_name:""); ?></td>
                                                <td><?php echo e($wr->quantity); ?></td>
                                            
                                                <td>
                                                        
                                                   <?php if($wr->status==0): ?>
                                                
                                                   <button class="btn btn-warning">Pending</button>
                                                    <?php else: ?>

                                                    <button class="btn btn-success">Confirmed</button>

                                                   <?php endif; ?>     

                                                </td>

                                                <td>
                                                        
                                                        <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                               <li>
                                                        <a href="<?php echo e(route('ProductionRequest',['id'=>$wr->id])); ?>" class="btn btn-link"><i class="fa fa-edit"> Edit</i></a>
                                                    </li>



                                                    <li>
                                                        <a href="<?php echo e(route('approverequest',['id'=>$wr->id])); ?>" class="btn btn-link"><i class="fa fa-edit"> Approve Order</i></a>
                                                    </li>
                                                    <li class="divider"></li><form method="POST" action="<?php echo e(route('rejectrequest',['id'=>$wr->id])); ?>" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="GXig4RESobOA4tWeGQk104fsMYMkIdrfBNeiaYen">
                                                    <li>
                                                        <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="fa fa-trash"></i> Delete</button>
                                                    </li></form>
                                                </ul>
                                            </div>

                                                </td>
                                            </tr>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                    
                                </table>
                            </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>