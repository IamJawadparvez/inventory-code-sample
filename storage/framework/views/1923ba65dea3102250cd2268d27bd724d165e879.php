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
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i> <?php echo e(trans("file.Add Category")); ?></button>&nbsp;

    </div>
    <div class="table-responsive">
        <table id="category-table" class="table table-striped" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported">ID</th>
                    <th><?php echo e(trans('file.category')); ?></th>
                     <th><?php echo e(trans('file.category id')); ?></th>
                     <th><?php echo e(trans('file.parent id')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
            </thead>

             <tbody>
        		
        		<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        			<tr>
        				<td><?php echo e($cat->id); ?></td>
        				<td><?php echo e($cat->name); ?></td>
                <td><?php echo e($cat->category_id); ?></td>
                <td><?php echo e($cat->parent_id); ?></td>
        				<td>
                

                </td>
        			</tr>

        		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
        </table>

       
    </div>
</section>

<!-- Create Modal -->
<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Category')); ?></h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
          <form method="post" action="<?php echo e(url('production-subcategories-save')); ?>">
          	<?php echo csrf_field(); ?>
            <div class="form-group">
                <label><strong><?php echo e(trans('file.name')); ?> *</strong></label>
                <?php echo e(Form::text('name',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => 'Type category name...'))); ?>

            </div>
            <input type="hidden" name="head_id" value="<?php echo e($id); ?>">
        
        <div class="form-group">
            <label><strong><?php echo e(trans('file.Parent Category')); ?></strong></label>
            <select name="parent_id" class="form-control selectpicker" id="parent">
                <option value="<?php echo e(NULL); ?>">No <?php echo e(trans('file.parent')); ?></option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(empty($category->parent_id)): ?>
                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                <?php endif; ?>  
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

                <div class="form-group" id="input_type">
            <label><strong><?php echo e(trans('file.Input Type')); ?></strong></label>
            <select name="input_type" class="form-control selectpicker" >
                <option value="">No <?php echo e(trans('file.Type')); ?></option>
                <?php $input_types =['text','select']; ?>
                <?php $__currentLoopData = $input_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($input); ?>"><?php echo e($input); ?></option>
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
<!-- Edit Modal -->
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
<!-- Import Modal -->
<div id="importCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <?php echo Form::open(['route' => 'category.import', 'method' => 'post', 'files' => true]); ?>

        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Import Category')); ?></h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
           <p><?php echo e(trans('file.The correct column order is')); ?> (name*, parent_category) <?php echo e(trans('file.and you must follow this')); ?>.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong><?php echo e(trans('file.Upload CSV File')); ?> *</strong></label>
                        <?php echo e(Form::file('file', array('class' => 'form-control','required'))); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong> <?php echo e(trans('file.Sample File')); ?></strong></label>
                        <a href="public/sample_file/sample_category.csv" class="btn btn-info btn-block btn-md"><i class="fa fa-download"></i>  <?php echo e(trans('file.Download')); ?></a>
                    </div>
                </div>
            </div>
            <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
        </div>
        <?php echo e(Form::close()); ?>

      </div>7
    </div>
</div>

<script type="text/javascript">
	
  $('#parent').change(function(){


      if($(this).val()=='' || $(this).val()==null){
        $('#input_type').show();
      }else{
        $('#input_type').hide();

      }


  });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>