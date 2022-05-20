 <?php $__env->startSection('content'); ?>

<?php if($errors->has('name')): ?>
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e($errors->first('name')); ?></div>
<?php endif; ?>
<?php if(session()->has('message')): ?>
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message')); ?></div> 
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>

<section>
   <div class="container-fluid">
    <div class="row">
       <div class="col-md-12">
          <div>
        <div class="container" style="margin-bottom: 3%;">
            <div class="row"><!-- 
                <a href="" ><i class="btn btn-info">Add Purchase Category</i></a> -->



                 <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i> <?php echo e(trans("file.Add Category")); ?></button>
                
            </div>
        </div>
    
    </div>
         <div class="card">
  
   
    <div class="table-responsive">
        <table id="category-table" class="table table-striped" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th><?php echo e(trans('file.category')); ?></th>
                    <th><?php echo e(trans('file.Parent Category')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $purchasecategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td></td>
                    <td><?php echo e($pc->name); ?></td>
                      <td><?php echo e($pc->parent_id); ?></td>
                        <td><div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <button type="button" data-id="<?php echo e($pc->id); ?>" data-parentid="<?php echo e($pc->parent_id); ?>" data-name="<?php echo e($pc->name); ?>" class="open-EditCategoryDialog btn btn-link" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i> Edit</button>
                                </li>
                                <li class="divider"></li><form method="POST" action="http://localhost/SalePro2/sales/category/21" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="z9sPjZIzf3mW2y3oLeieokBt9LyBU1XacfDtOUjv">
                                <li>
                                  <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="fa fa-trash"></i> Delete</button> 
                                </li></form>
                            </ul>
                        </div></td>



                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
            

        </table>
      </div>
    </div>
      </div>
    </div>
  </div>
</section>



<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
    
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Category')); ?></h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>


          <form method="post" action="<?php echo e(route('AddPurchase')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label><strong><?php echo e(trans('file.name')); ?> *</strong></label>
                <?php echo e(Form::text('name',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => 'Type category name...'))); ?>

            </div>
            <div class="form-group">
                <label><strong><?php echo e(trans('file.Parent Category')); ?></strong></label>

          <!--     <input type="text" name="purchasecategory" class="form-control"> -->
     
          <select class="form-control" name="parent_id">
          <option value="<?php echo e(Null); ?>"> Choose Parent</option>
                 <?php $__currentLoopData = $purchase; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       
        <option value="<?php echo e($p->id); ?>"><?php echo e($p->name); ?></option>             
      
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>

            </div>                
            <div class="form-group">       
              <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
</div>








<div id="editModal" tabindex="-1" role="dialog"   aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
    
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Edit Category')); ?></h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>


          <form method="post" action="">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label><strong><?php echo e(trans('file.name')); ?> *</strong></label>
           <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label><strong><?php echo e(trans('file.Parent Category')); ?></strong></label>

          <!--     <input type="text" name="purchasecategory" class="form-control"> -->
     
          <select class="form-control" name="parent_id" id="parentid">
            <option value="<?php echo e(Null); ?>">Select Parent</option>
                 <?php $__currentLoopData = $purchase; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <option value="<?php echo e($p->id); ?>"><?php echo e($p->name); ?></option>             
      
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>

            </div>                
            <div class="form-group">       
              <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
</div>



<script type="text/javascript">
    
$('.open-EditCategoryDialog').click(function(){

id=$(this).data('id');
//alert(id);
name=$(this).data('name');
parent_id=$(this).data('parentid');
//alert(parent_id);

$('#name').val(name);
$('#parentid').val(parent_id);

})





</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>