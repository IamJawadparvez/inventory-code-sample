<style type="text/css">
    

</style>
<?php $__env->startSection('content'); ?>


<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1>ISSUE PRODUCT FROM WAREHOUSE</h1>
                <form method="post" action="<?php echo e(route('save-issue-request')); ?>">
                    <?php echo csrf_field(); ?>
                <div class="card">
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Date</label>
                                <input class="form-control" type="date" name="date" value="<?php echo e(date('Y-m-d')); ?>">
                            </div>
                            <div class="col-md-4">
                                <label>Select Warehouse</label>
                                <select class="form-control" required name="warehouse">
                                    <option value="<?php echo e(NULL); ?>">Select</option>
                                    <?php $__currentLoopData = $warehouse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($w->id); ?>"><?php echo e($w->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Select Section</label>
                                <select class="form-control" required name="section">
                                    <option value="<?php echo e(NULL); ?>">Select</option>
                                    <option value="Cutting">Cutting</option>                                    
                                </select>
                            </div>
                        </div>


                    </div>

                    <div class="card-body">
                        <div id="products_div">
                        <div class="row">
                            <div class="col-md-4">
                            <label>Products</label>
                                <select class="form-control select-product product_select1" data-id='1' name="product[]">
                                 <option value="<?php echo e(NULL); ?>">Choose</option>
                                <?php $__currentLoopData = $rawmaterial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option data-cost='<?php echo e($f->product_cost); ?>' data-alert_quantity='<?php echo e($f->alert_quantity); ?>' value="<?php echo e($f->id); ?>"><?php echo e($f->product_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Quantity</label>
                                <input class="form-control check_quantity quantity1" onkeyup="check_quantity(this);" data-value='1' type="text" name="quantity[]" placeholder="Qty">
                            </div>
                            

                            <div class="col-md-2">
                                <label>Total</label>
                                <input class="form-control total1" readonly type="number" name="total[]" placeholder="Total">
                            </div>

                            <div class="col-md-2">
                                <label>Remaining</label>
                                <input class="form-control remaining1" readonly type="number" name="remaining[]" placeholder="Remaining">
                            </div>

                            <div class="col-md-2">
                                  <button type="button" data-value='1' class="btn btn-success add_new">Add</button>  
                                  <button type="button" class="btn btn-danger remove_product_row">Remove</button>
                            </div>

                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-12">
                                <label>Description</label>
                                <input class="form-control" type="text" name="description" placeholder="Description">
                            </div>

                            <div class="col-md-12" style="text-align: center;margin-top: 10px">
                                <button class="btn btn-primary">Confirm Add New Issue</button>
                            </div>

                    </div>


                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>
</section>








<script type="text/javascript">
    var products = <?php echo json_encode($rawmaterial->toArray()); ?>;
    $('.select-product').change(function(){

        val = $(this).val();
        id = $(this).data('id');
        cost = $(".product_select"+id+" option:selected" ).data('cost');
        alert_quantity = $(".product_select"+id+" option:selected" ).data('alert_quantity');  


        $('.total'+id).val(alert_quantity);
        $('.remaining'+id).val(alert_quantity);

    });

    function select_product(th) {

        val = $(th).val();
        id = $(th).data('id');

        cost = $(".product_select"+id+" option:selected" ).data('cost');
        alert_quantity = $(".product_select"+id+" option:selected" ).data('alert_quantity');  


        $('.total'+id).val(alert_quantity);
        $('.remaining'+id).val(alert_quantity);

    }

    // $('.check_quantity').keyup(function(){

    //     val = $(this).val();

    //     id = $(this).data('value');        
    //     quantity = $('.quantity'+id).val();
    //     total = $('.total'+id).val();
    //     if(quantity <= total){
    //     remaining = total - quantity;  
    //     $('.remaining'+id).val(remaining);
    //     }else if(quantity > total){
    //       $('.quantity'+id).val(total);      
    //     }
    

    // });


    function check_quantity(th) {

        val = $(th).val();
      //  alert(val);
        id = $(th).data('value');        
        quantity = $('.quantity'+id).val();
        total = $('.total'+id).val();
        remaining = total - quantity;  
        $('.remaining'+id).val(remaining);

        if(val > total){
            $(th).val(total);
                $('.remaining'+id).val(0);
        }else if(val < 0){
            $(th).val(1);
                $('.remaining'+id).val(remaining - 2);
        }else{

            if(remaining < 0){
                $('.remaining'+id).val(0);
            }else{

            if(quantity <= total){
            remaining = total - quantity;  
            $('.remaining'+id).val(remaining);

                
            }else if(quantity > total){
                $('.quantity'+id).val(total);      
            }


            }        


        }

    }


    $('.add_new').click(function(){

        id = $(this).data('value');
        id = id + 1;
        $(this).data('value',id);
        data = '<option value="<?php echo e(NULL); ?>">Choose</option>';

        for(i=0;i<products.length;i++){
            chkid = -1;
            $('.select-product').each(function(){
                if($(this).val()==products[i].id){
                    chkid = products[i].id;
                }
            })

            if(chkid==-1){
            data = data + '<option data-cost='+products[i].product_cost+' data-alert_quantity='+products[i].alert_quantity+' value='+products[i].id+'>'+products[i].product_name+'</option>';                
            }


        }

        x = `<div class="row new_product_row">
                            <div class="col-md-4">
                            <label>Products</label>
                                

                                 <select onchange='select_product(this);' class="form-control select-product product_select`+id+`" data-id=`+id+` name="product[]">
                                            `+data+`</select>
                            </div>
                            <div class="col-md-2">
                                <label>Quantity</label>
                                <input onkeyup='check_quantity(this);' class="form-control check_quantity quantity`+id+`" data-value='`+id+`' type="text" name="quantity[]" placeholder="Qty">
                            </div>
                            

                            <div class="col-md-2">
                                <label>Total</label>
                                <input class="form-control total`+id+`" readonly type="number" name="total[]" placeholder="Total">
                            </div>

                            <div class="col-md-2">
                                <label>Remaining</label>
                                <input class="form-control remaining`+id+`" readonly type="number" name="remaining[]" placeholder="Remaining">
                            </div>

                            <div class="col-md-2">
                                
                            </div>

                        </div>`;
    

            $('#products_div').append(x);                        

    });

     $('.remove_product_row').click(function(){


    $('.new_product_row').last().remove();


  })  

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>