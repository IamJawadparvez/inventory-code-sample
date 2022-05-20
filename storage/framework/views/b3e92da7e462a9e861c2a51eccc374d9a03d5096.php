<?php $__env->startSection('content'); ?>


<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12  bs-linebreak">
                <h1> Add New Shipment</h1>

                <form method="Post" action="<?php echo e(route('save-issue-shipment')); ?>">
                    <?php echo csrf_field(); ?>
                <div class="card">
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Date</label>
                                <input class="form-control" type="date" name="date" value="<?php echo e(date('Y-m-d')); ?>">
                            </div>

                            <div class="col-md-6">
                                <label>Select Warehouse</label>
                                <select class="form-control" required name="warehouse">
                                    <option value="<?php echo e(NULL); ?>">Select</option>
                                    <?php $__currentLoopData = $warehouse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($w->id); ?>"><?php echo e($w->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            
                                      
                            
                        </div>

                    
                    
                        <div class="row" id="products_div">


                            <div class="col-md-12" id="final_product">
                                <div class="row">
                                    <input type="hidden" name="current_shipment_row" value="1" id="current_shipment_row">

                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('file.category')); ?> *</strong> </label>
                                        <div class="input-group">



                                            <select  name="main_category[]" class="form-control show_category" data-id="subcategory1" id="category1">

                                                
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

                                <div class="col-md-3">
                                    <label class="col-md-12"><strong><?php echo e(trans('file.actions')); ?> *</strong> </label>
                                  <button type="button" data-value='1' class="btn btn-success add_new">Add</button>  
                                  <button type="button" class="btn btn-danger remove_product_row">Remove</button>
                                  <button type="button" class="btn btn-primary remove_product_row">Get <DATA></DATA></button>
                                </div>

                            </div>
                                
                                <div class="clearfix"></div> 

                             <div class="row" id="subcategory1">
                                    


                             </div>


                        </div>
                        


                         


                    </div>


                    <div class="row">






                        <div class="row" class="col-md-12" id="Shippingcheckbox">
                                     <div class="col-md-4 mt-3">
                                    <input name="promotion" type="checkbox" id="promotion">&nbsp;
                                    <label><strong> <?php echo e(trans('file.Add Shipping Agent')); ?></strong></label>
                                </div>


                                    <div class="col-md-4 d-none shippingfield" >
                                          <div class="form-group">
                                            <label>
                                                <strong><?php echo e(trans('file.Shiping Agent')); ?></strong>
                                            </label>
                                            <!-- <input type="number" name="order_discount" class="form-control" step="any" /> -->
                                          <select  class="form-control" name="shipmentagentname">
                                            <?php $__currentLoopData = $shipmentagent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option value="<?php echo e($agent->id); ?>"><?php echo e($agent->name); ?></option>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          </select>
                                      

                                        </div>
                                    </div>
                                    <div class="col-md-4 d-none shippingfield">
                                        <div class="form-group">
                                            <label> 
                                                <strong><?php echo e(trans('file.Attach Document')); ?></strong>
                                            </label>
                                            <input type="file"  name="attach_document"  class="form-control" step="any" />
                                        </div>
                                    </div>


                                    <div class="col-md-4 d-none shippingfield">
                                        <div class="form-group">
                                            <label> 
                                                <strong><?php echo e(trans('file.Driver Name')); ?></strong>
                                            </label>
                                            <input type="text" placeholder="Driver Name" name="driver_name"  class="form-control" step="any" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-none shippingfield">
                                        <div class="form-group">
                                            <label> 
                                                <strong><?php echo e(trans('file.Driver Contact Detail')); ?></strong>
                                            </label>
                                            <input type="text" placeholder="Driver Contact" name="driver_contact"  class="form-control" step="any" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-none shippingfield">
                                        <div class="form-group">
                                            <label> 
                                                <strong><?php echo e(trans('file.Vechile Details')); ?></strong>
                                            </label>
                                            <input type="text" placeholder="vechile Detail" name="vechile_detail"  class="form-control" step="any" />
                                        </div>
                                    </div>
                                </div>
                             </div>






                           <div class="row">

                            <div class="col-md-6">
                                <label>Description</label>
                                <input class="form-control" type="text" name="description" placeholder="Description">
                            </div>
                            <div class="col-md-6">
                                <label> Selected Product</label>
                                <input class="form-control" type="text" name="selected_product" placeholder="Selected Product">
                            </div>

                            <div class="col-md-12" style="text-align: center;margin-top: 10px">
                                <button  type="submit" class="btn btn-primary">Send for Approval</button>
                                 <button class="btn btn-primary">Save Draft</button>
                            </div>

                            </div>
                   


                    </div>

                </form>




                </div>
          

            </div>
        </div>
</section>

   








<script type="text/javascript">







    $("#promotion").click(function(){


 if($(this).prop("checked") == true){
            
               $(".shippingfield").removeClass('d-none');
            }
            else if($(this).prop("checked") == false){
               $(".shippingfield").addClass('d-none');
            }

});


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

    $('.check_quantity').keyup(function(){

        val = $(this).val();
        id = $(this).data('value');        
        quantity = $('.quantity'+id).val();
        total = $('.total'+id).val();
        if(quantity <= total){
        remaining = total - quantity;  
        $('.remaining'+id).val(remaining);
        }else if(quantity > total){
          $('.quantity'+id).val(total);      
        }
    

    });

        $(document).ready(function() {
        $(".check_quantity").on("focus", function() {
            $(this).on("keydown", function(event) {
                if (event.keyCode === 38 || event.keyCode === 40) {
                    check_quantity(this);
                }   
             });
           });
        });

    function check_quantity(th) {

        val = $(th).val();
        id = $(th).data('value');        
        quantity = $('.quantity'+id).val();
        total = $('.total'+id).val();
        remaining = total - quantity;  
        $('.remaining'+id).val(remaining);

                if(quantity <= total){
        remaining = total - quantity;  
        $('.remaining'+id).val(remaining);

            
        }else if(quantity > total){
                      $('.quantity'+id).val(total);      
        }

    }


    $('.add_new').click(function(){

        all_values = [];
        $('.show_category').each(function(){


            v = $(this).val();
            all_values.push(v);

        });

        value = $('#current_shipment_row').val();
         value = Number(value) + 1;
         $.ajax({
                type:'GET',
                url:'<?php echo e(route("add-shipment-data")); ?>',
                data:{value:value,all_values:all_values},
                success: function( msg ) {

                    $('#final_product').append(msg);

                }
            });

       
        $('#current_shipment_row').val(value);

    });

     $('.remove_product_row').click(function(){


    $('.new_product_row').last().remove();


  })  

    $('.show_category').change(function(){

        cl = $(this).data('id');
        $('.'+cl).hide();
        id = $(this).attr('id');
        div = $('#'+id+' option:Selected').data('div');
        value = $('#'+id+' option:Selected').val();

        $('.'+cl).each(function(){

            if($(this).attr('id')==div){
                    $(this).show();                
            }

        });

        td_d = '<table class="table table-bordered">';
         $.ajax({
                type:'GET',
                url:'<?php echo e(route("get_production_data")); ?>',
                data:{value:value},
                success: function( msg ) {

                    for(i=0;i<1;i++){


                         td_d = td_d + `<tr><th></th>`;


                            for (var key in msg[i]) {
                                if (msg[i].hasOwnProperty(key)) {
                                    if(key!='id'){
                                        td_d = td_d + `<th>`+key+`</th>`;                                        
                                    }

                                    //alert(key + " -> " + msg[i][key]);
                                }
                            }
                      td_d = td_d + `</tr>`;                  
                    }

                if(msg.length==0){
               td_d=td_d+`<tr><td>No Data Exist</td></tr>`;
                }else{

                    for(i=0;i<msg.length;i++){


                         td_d = td_d + `<tr><td><input type="checkbox" data-id="selected_production`+i+`" onclick="select_checkbox(this)" class="select_production" name="select_productio[]]"></td>`;


                            for (var key in msg[i]) {
                                if (msg[i].hasOwnProperty(key)) {
                                      x = '';    
                                    if(key=='id'){
                                        x = `<span  style="display:block;"><input type="checkbox" id="selected_production`+i+`" style="display:block;" value="`+msg[i][key]+`" class="selected_production" name="selected_production[]"></span>`;
                                    }

                                    st = '';

                                     if(key=='id'){

                                        st = 'style="display:none;"';

                                     }


                                      var cname = msg[i][key];

                                        for(tr=0;tr<production_subcategory.length;tr++){

                                            if(production_subcategory[tr].id==msg[i][key]){

                                                cname = production_subcategory[tr].name;

                                            }

                                        }



                                    td_d = td_d + `<td `+st+`>`+cname+` `+x+`</td>`;
                                    //alert(key + " -> " + msg[i][key]);
                                }
                            }

                      td_d = td_d + `</tr>`;                            
                    }
                }
                      td_d = td_d + `</table>`;
                    $('#'+cl).html(td_d);

                }
            });



    });


function show_category(th) {


        
        cl = $(th).data('id');
        $('.'+cl).hide();
        id = $(th).attr('id');
        div = $('#'+id+' option:Selected').data('div');
        ct=$(th).data('value');
        value = $('#'+id+' option:Selected').val();

        $('.'+cl).each(function(){

            if($(this).attr('id')==div){
                    $(this).show();                
            }

        });

        td_d = '<table class="table">';
         $.ajax({
                type:'GET',
                url:'<?php echo e(route("get_production_data")); ?>',
                data:{value:value},
                success: function( msg ) {

                    for(i=0;i<1;i++){


                         td_d = td_d + `<tr><th></th>`;


                            for (var key in msg[i]) {
                                if (msg[i].hasOwnProperty(key)) {
                                    if(key!='id'){
                                        td_d = td_d + `<th>`+key+`</th>`;                                        
                                    }

                                    //alert(key + " -> " + msg[i][key]);
                                }
                            }
                      td_d = td_d + `</tr>`;                  
                    }

                  
                    for(i=0;i<msg.length;i++){


                         td_d = td_d + `<tr><td><input type="checkbox" data-id="selected_production`+i+`_`+ct+`" onclick="select_checkbox(this)" class="select_production" name="select_productio[]]"></td>`;


                            for (var key in msg[i]) {
                                if (msg[i].hasOwnProperty(key)) {
                                      x = '';    
                                    if(key=='id'){
                                        x = `<span  style="display:block;"><input type="checkbox" id="selected_production`+i+`_`+ct+`" style="display:block;" value="`+msg[i][key]+`" class="selected_production" name="selected_production[]"></span>`;
                                    }

                                    st = '';

                                     if(key=='id'){

                                        st = 'style="display:none;"';

                                     }


                                      var cname = msg[i][key];

                                        for(tr=0;tr<production_subcategory.length;tr++){

                                            if(production_subcategory[tr].id==msg[i][key]){

                                                cname = production_subcategory[tr].name;

                                            }

                                        }

                                    td_d = td_d + `<td `+st+`>`+cname+` `+x+`</td>`;
                                    //alert(key + " -> " + msg[i][key]);
                                }
                            }

                      td_d = td_d + `</tr>`;                            
                    }
                      td_d = td_d + `</table>`;
                    $('#'+cl).html(td_d);

                }
            });



}

function select_checkbox(th) {

    id = $(th).data('id');

    if($('#' + id).is(":checked")){
     $('#'+id).prop('checked',false);
    }else{
         $('#'+id).prop('checked',true);
    }
   

}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>