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
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i> <?php echo e(trans("file.Add Category")); ?></button>&nbsp;
                      <div class="table-responsive">
        <table id="category-table" class="table table-striped" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported">ID</th>
                    <th><?php echo e(trans('file.category')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
            </thead>

             <tbody>
            
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <tr>
                <td><?php echo e($cat->id); ?></td>
                <td><?php echo e($cat->name); ?></td>
                <td>
                
                  <a class="btn btn-success" href="<?php echo e(route('production.subcategories',['id'=>$cat->id])); ?>">Subcategories</a>


                </td>
              </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
        </table>

       
    </div>

<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Category')); ?></h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
          <form method="post" action="<?php echo e(url('production-categories-save')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label><strong><?php echo e(trans('file.name')); ?> *</strong></label>
                <?php echo e(Form::text('name',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => 'Type category name...'))); ?>

            </div>


            <div class="form-group">       
              <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
            </div>
          </form>
        </div>

      </div>
    </div>
</div>


<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
        <?php echo e(Form::open(['route' => ['category.update', 1], 'method' => 'PUT'] )); ?>

      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Update Category')); ?></h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
          <div class="form-group">
            <label><strong><?php echo e(trans('file.name')); ?> *</strong></label>
            <?php echo e(Form::text('name',null, array('required' => 'required', 'class' => 'form-control'))); ?>

        </div>
            <input type="hidden" name="category_id">
        <div class="form-group">
            <label><strong><?php echo e(trans('file.Parent Category')); ?></strong></label>
            <select name="parent_id" class="form-control selectpicker" id="parent">
                <option value="">No <?php echo e(trans('file.parent')); ?></option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group">       
            <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
          </div>
        </div>
      <?php echo e(Form::close()); ?>

    </div>
  </div>
</div>


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