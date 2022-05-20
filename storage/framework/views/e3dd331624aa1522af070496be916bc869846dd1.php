<?php $__env->startSection('content'); ?>


<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4><?php echo e(trans('file.Production List')); ?></h4>
                    </div>
                    <div class="card-body">

                 <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <?php $i = 0 ;?>
                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php

                      $name = strtolower($cat->name);
                      $name = str_replace(' ','_',$name);

                    ?>
                    <a class="nav-item nav-link <?php if($i==0) echo 'active' ?>" id="nav-<?php echo e($name); ?>-tab" data-toggle="tab" href="#nav-<?php echo e($name); ?>" role="tab" aria-controls="nav-<?php echo e($name); ?>" aria-selected="true"><?php echo e($cat->name); ?></a>
                    <?php $i++ ;?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">

                   <?php $i = 0 ;?>
                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php

                      $name = strtolower($cat->name);
                      $name = str_replace(' ','_',$name);

                    ?>

                    <?php $allheads = DB::table('production_subcategories')->where('category_id',$cat->id)->where('parent_id',NULL)->select('id','name')->get(); ?>

                        <div class="tab-pane fade show <?php if($i==0) echo 'active' ?>" id="nav-<?php echo e($name); ?>" role="tabpanel" aria-labelledby="nav-<?php echo e($name); ?>-tab">


                            <table class="table table-striped" id="production_table_fabric" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th><?php echo e(trans('file.id')); ?></th>
                                        <th><?php echo e(trans('file.Production Date')); ?></th>
                                        <?php $__currentLoopData = $allheads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $head): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <th><?php echo e($head->name); ?></th>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <th><?php echo e(trans('file.Status')); ?></th>
                                        <th><?php echo e(trans('file.Action')); ?></th>
                                    </tr>
                                </thead>
                            

                            <tbody>
                              <?php 
                              $weight=0;
                               $boxes=0;
                                $isolation_peices=0;
                              ?>

                               <?php $__currentLoopData = $production; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                               <?php if($pro->category==$cat->id): ?>
                               <?php
                                  $subcategory = unserialize($pro->subcategory);
                                  $value = unserialize($pro->value); 
                                  $x = 0;
                                ?>

                                <tr>
                                  <td><?php echo e($pro->id); ?></td>
                                  <td><?php echo e($pro->created_at); ?></td>

                                   <?php $__currentLoopData = $subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $subcat = DB::table('production_subcategories')->where('category_id',$cat->id)->where('id',$sub)->first(); ?>

                                    <?php if(!empty($subcat)): ?>

                                     <?php if($subcat->type=='select'): ?>
                                      <?php $valx = DB::table('production_subcategories')->where('category_id',$cat->id)->where('id',$value[$x])->first() ?>  

                                      <?php $val = $valx->name; ?>
                                     <?php else: ?>
                                      <?php $val = $value[$x]; ?>
                                    <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if($subcat->name=='weight' || $subcat->name=='Weight'): ?>

                                        <?php $weight = $weight + $val; ?>

                                    <?php endif; ?>

                                    <?php if($subcat->name=='Boxes' || $subcat->name=='boxes'): ?>

                                        <?php $boxes = $boxes + $val; ?>

                                    <?php endif; ?>

                                     <?php if($subcat->name=='Pieces' || $subcat->name=='pieces'): ?>

                                        <?php $isolation_peices = $isolation_peices + $val; ?>

                                    <?php endif; ?>


                                  <td><?php echo e($val); ?></td>                                  
                                        <?php $x++ ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                   <td><?php if($pro->status==0): ?><?php echo e('Avaiable in Production'); ?> <?php else: ?> <?php echo e('Send To Store '); ?> <?php endif; ?></td>
                                   <td>
                                       
                            <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <a href="<?php echo e(route('ProductionApproved',['id'=>$pro->id])); ?>" type="button" data-id="21" class="open-EditCategoryDialog btn btn-link" ><i class="fa fa-edit"></i> Send to Store</a>
                                </li>
                                 <li>
                                    <a href="" type="button" data-id="21" class="open-EditCategoryDialog btn btn-link" ><i class="fa fa-edit"></i> Edit</a>
                                </li>
                                <li class="divider"></li><form method="POST" action="http://localhost/inventory/category/21" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="Y39l3WylxG74kaRAe1A9FjKWxLyba5DlmLo96TA6">
                                <li>
                                  <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="fa fa-trash"></i> Delete</button> 
                                </li></form>
                            </ul>
                        </div>





                                   </td>
                                </tr>
                               <?php endif; ?>
                               
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    

                               <?php if($cat->name=='Fabric' || $cat->name=='fabric'): ?>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong><?php echo e($weight); ?></strong></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>

                               <?php endif; ?>



                               <?php if($cat->name=='Masks' || $cat->name=='masks' || $cat->name=='Mask' || $cat->name=='mask'): ?>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td> 
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                   
                                    <td>Total Boxes : </td>
                                    <td><strong><?php echo e($boxes); ?></strong></td>

                                </tr>

                               <?php endif; ?>

                               <?php if($cat->name=='Isolation Gown' || $cat->name=='isolation gown'): ?>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <td><strong>Total : <?php echo e($isolation_peices); ?></strong></td>
                                    <td></td>
                                    <td></td>
                                    
                                    <td></td>
                                    <td></td>

                                </tr>

                               <?php endif; ?>


                            </tbody>    
                            </table>



                        </div>

                    <?php $i++ ;?>
                   
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 


                </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
        all_permission = 'dummy';
        $('#production_table_fabric').DataTable( {

        'language': {
            /*'searchPlaceholder': "<?php echo e(trans('file.Type Product Name or Code...')); ?>",*/
            'lengthMenu': '_MENU_ <?php echo e(trans("file.records per page")); ?>',
             "info":      '<?php echo e(trans("file.Showing")); ?> _START_ - _END_ (_TOTAL_)',
            "search":  '<?php echo e(trans("file.Search")); ?>',
            'paginate': {
                    'previous': '<?php echo e(trans("file.Previous")); ?>',
                    'next': '<?php echo e(trans("file.Next")); ?>'
            }
        },
        order:[['2', 'asc']],
        'columnDefs': [
            {
                "orderable": false,
                'targets': [0, 1, 9]
            },
            {
                'checkboxes': {
                   'selectRow': true
                },
                'targets': [0]
            }
        ],
        'select': { style: 'multi', selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                text: '<?php echo e(trans("file.PDF")); ?>',
                exportOptions: {
                    columns: ':visible:not(.not-exported)',
                    rows: ':visible',
                    stripHtml: false
                },
                customize: function(doc) {
                    for (var i = 1; i < doc.content[1].table.body.length; i++) {
                        if (doc.content[1].table.body[i][0].text.indexOf('<img src=') !== -1) {
                            var imagehtml = doc.content[1].table.body[i][0].text;
                            var regex = /<img.*?src=['"](.*?)['"]/;
                            var src = regex.exec(imagehtml)[1];
                            var tempImage = new Image();
                            tempImage.src = src;
                            var canvas = document.createElement("canvas");
                            canvas.width = tempImage.width;
                            canvas.height = tempImage.height;
                            var ctx = canvas.getContext("2d");
                            ctx.drawImage(tempImage, 0, 0);
                            var imagedata = canvas.toDataURL("image/png");
                            delete doc.content[1].table.body[i][0].text;
                            doc.content[1].table.body[i][0].image = imagedata;
                            doc.content[1].table.body[i][0].fit = [30, 30];
                        }
                    }
                },
            },
            {
                extend: 'csv',
                text: '<?php echo e(trans("file.CSV")); ?>',
                exportOptions: {
                    columns: ':visible:not(.not-exported)',
                    rows: ':visible',
                    format: {
                        body: function ( data, row, column, node ) {
                            if (column === 0 && (data.indexOf('<img src=') !== -1)) {
                                var regex = /<img.*?src=['"](.*?)['"]/;
                                data = regex.exec(data)[1];                 
                            }
                            return data;
                        }
                    }
                }
            },
            {
                extend: 'print',
                text: '<?php echo e(trans("file.Print")); ?>',
                exportOptions: {
                    columns: ':visible:not(.not-exported)',
                    rows: ':visible',
                    stripHtml: false
                }
            },
            {
                text: '<?php echo e(trans("file.delete")); ?>',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    if(user_verified == '1') {
                        product_id.length = 0;
                        $(':checkbox:checked').each(function(i){
                            if(i){
                                var product_data = $(this).closest('tr').data('product');
                                product_id[i-1] = product_data[12];
                            }
                        });
                        if(product_id.length && confirmDelete()) {
                            $.ajax({
                                type:'POST',
                                url:'products/deletebyselection',
                                data:{
                                    productIdArray: product_id
                                },
                                success:function(data){
                                    dt.rows({ page: 'current', selected: true }).deselect();
                                    dt.rows({ page: 'current', selected: true }).remove().draw(false);
                                }
                            });
                        }
                        else if(!product_id.length)
                            alert('No product is selected!');
                    }
                    else
                        alert('This feature is disable for demo!');
                }
            },
            {
                extend: 'colvis',
                text: '<?php echo e(trans("file.Column visibility")); ?>',
                columns: ':gt(0)'
            },
        ],
    } );


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>