@extends('layout.main') @section('content')
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif
<style type="text/css">
    
    #myUL {
  /* Remove default list styling */
  list-style-type: block;
  padding: 0;
  margin: 0;
}

#myUL li a {
  border: 1px solid #ddd; /* Add a border to all links */
  margin-top: -1px; /* Prevent double borders */
  background-color: #f6f6f6; /* Grey background color */
  padding: 12px; /* Add some padding */
  text-decoration: none; /* Remove default text underline */
  font-size: 18px; /* Increase the font-size */
  color: black; /* Add a black text color */
  display: block; /* Make it into a block element to fill the whole list */
}

#myUL li a:hover:not(.header) {
  background-color: #eee; /* Add a hover effect to all links, except for headers */
}

</style>
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Add Purchase')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>





                        <form  method="post" action="{{route('PurchaseSave')}}" enctype="multipart/form-data">
                           @csrf


                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">




                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Warehouse')}} *</strong></label>
                                            <select required name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                                @foreach($lims_warehouse_list as $warehouse)
                                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>





                                   <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong>{{trans('file.PurchaseCategory')}} *</strong></label>
                                            <select class="form-control" id="category">
                                                <option>Select</option>
                                               @foreach($purchase as $p)
                                               <option value="{{$p->id}}">{{$p->name}}</option>
                                               @endforeach
                                            </select>
                                        </div>
                                    </div> 



                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong>{{trans('file.SubCategory')}} *</strong></label>
                                            <select class="form-control sub_cat_color">
                                              
                                            </select>
                                        </div>
                                    </div> 


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Supplier')}}</strong></label>
                                            <select name="supplier_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select supplier...">
                                                @foreach($lims_supplier_list as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->name .' ('. $supplier->company_name .')'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">  
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Purchase Status')}}</strong></label>
                                            <select name="status" class="form-control">
                                                <option value="Recieved">{{trans('file.Recieved')}}</option>
                                                <option value="Partial">{{trans('file.Partial')}}</option>
                                                <option value="Pending">{{trans('file.Pending')}}</option>
                                                <option value="Ordered">{{trans('file.Ordered')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Attach Document')}}</strong></label> <i class="fa fa-question-circle" data-toggle="tooltip" title="Only jpg, jpeg, png, gif, pdf, csv, docx, xlsx and txt file is supported"></i>
                                            <input type="file" name="document" class="form-control" >
                                            @if($errors->has('extension'))
                                                <span>
                                                   <strong>{{ $errors->first('extension') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Brand')}}</strong> </label>
                                        <div class="input-group">
                                          <select name="brand_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Brand...">

                                            @foreach($brand as $brands)
                                            <option value="{{$brands->id}}">{{$brands->title}}</option>

                                            @endforeach
                                           
                                          </select>
                                      </div>
                                    </div>
                                </div>
                                    <div class="col-md-12 mt-3">
                                        <label><strong>{{trans('file.Select Product')}}</strong></label>
                                        <div class="search-box input-group">
                                            <button class="btn btn-secondary"><i class="fa fa-barcode"></i></button>
                                            <input type="text" name="product_code_name" id="search" onkeyup="search1(this)" placeholder="Please type product code and select..." class="form-control" />

                                                <div class="col-md-12" id="filter_search">
                                                    <ul id="myUL" style="display: none">
                                                       
                                                    </ul>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <h5>{{trans('file.Order Table')}} *</h5>
                                        <div class="table-responsive mt-3">
                                            <table id="myTable" class="table table-hover order-list">
                                                <thead>
                                                    <tr>
                                                        <th>{{trans('file.name')}}</th>
                                                       <!--  <th>{{trans('file.WareHouse')}}</th> -->
                                                        <th>{{trans('file.Quantity')}}</th>
                                                        <th class="recieved-product-qty d-none">{{trans('file.Recieved')}}</th>
                                                        <th>{{trans('file.Product Cost')}}</th>
                                                    <!--     <th>{{trans('file.Discount')}}</th> -->
                                                        <th>{{trans('file.Subtotal')}}</th>
                                                        <th><i class="fa fa-trash"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                </tbody>
                                                <tfoot class="tfoot active">
                                                    <th>{{trans('file.Total')}}</th>
                                                    <th id="total_product_quantity"></th>
                                                    <th id="total_p_cost"></th>
                                                    <th id="total_product_cost">0</th>
                                                    <th></th>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_qty" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_discount" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_tax" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_cost" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="item" />
                                            <input type="hidden" name="order_tax" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="grand_total" />
                                            <input type="hidden" name="paid_amount" value="0.00" />
                                            <input type="hidden" name="payment_status" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3" id="Shippingcheckbox">
                                     <div class="col-md-4 mt-3">
                                    <input name="promotion" type="checkbox" id="promotion">&nbsp;
                                    <label><strong> {{trans('file.Add Shipping Agent')}}</strong></label>
                                </div>


                                    <div class="col-md-4 d-none shippingfield" >
                                          <div class="form-group">
                                            <label>
                                                <strong>{{trans('file.Shiping Agent')}}</strong>
                                            </label>
                                            <!-- <input type="number" name="order_discount" class="form-control" step="any" /> -->
                                          <select  class="form-control" name="shipmentagentname">
                                            @foreach($shipmentagent as $agent)
                                              <option value="{{$agent->id}}">{{$agent->name}}</option>
                                                  @endforeach
                                          </select>
                                      

                                        </div>
                                    </div>
                                    <div class="col-md-4 d-none shippingfield">
                                        <div class="form-group">
                                            <label> 
                                                <strong>{{trans('file.Shipping Cost')}}</strong>
                                            </label>
                                            <input type="number" value="0" name="shipping_cost" id="shipping_cost" class="form-control" step="any" />
                                        </div>
                                    </div>
                                    







                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Note')}}</strong></label>
                                            <textarea rows="5" class="form-control" name="note"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="submit-btn">{{trans('file.submit')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>




                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <table class="table table-bordered table-condensed totals">
            <td><strong>{{trans('file.Items')}}</strong>
                <span class="pull-right" id="item">0.00</span>
            </td>
            <td><strong>{{trans('file.Total')}}</strong>
                <span class="pull-right" id="subtotal">0.00</span>
            </td>
            <td><strong>{{trans('file.Order Tax')}}</strong>
                <span class="pull-right" id="order_tax">0.00</span>
            </td>
            <td><strong>{{trans('file.Order Discount')}}</strong>
                <span class="pull-right" id="order_discount">0.00</span>
            </td>
            <td><strong>{{trans('file.Shipping Cost')}}</strong>
                <span class="pull-right" id="shipping_cost">0.00</span>
            </td>
            <td><strong>{{trans('file.grand total')}}</strong>
                <span class="pull-right" id="grand_total">0.00</span>
            </td>
        </table>
    </div>
    <div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal-header" class="modal-title"></h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label><strong>{{trans('file.Quantity')}}</strong></label>
                            <input type="number" name="edit_qty" class="form-control" step="any">
                        </div>
                        <div class="form-group">
                            <label><strong>{{trans('file.Unit Discount')}}</strong></label>
                            <input type="number" name="edit_discount" class="form-control" step="any">
                        </div>
                        <div class="form-group">
                            <label><strong>{{trans('file.Unit Cost')}}</strong></label>
                            <input type="number" name="edit_unit_cost" class="form-control" step="any">
                        </div>
                        <?php
                $tax_name_all[] = 'No Tax';
                $tax_rate_all[] = 0;
                foreach($lims_tax_list as $tax) {
                    $tax_name_all[] = $tax->name;
                    $tax_rate_all[] = $tax->rate;
                }
            ?>
                            <div class="form-group">
                                <label><strong>{{trans('file.Tax Rate')}}</strong></label>
                                <select name="edit_tax_rate" class="form-control">
                                    @foreach($tax_name_all as $key => $name)
                                    <option value="{{$key}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label><strong>{{trans('file.Product Unit')}}</strong></label>
                                <select name="edit_unit" class="form-control">
                                </select>
                            </div>
                            <button type="button" name="update_btn" class="btn btn-primary">{{trans('file.update')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" name="j" id="selected" value="1">
<script type="text/javascript">


$("#promotion").click(function(){


 if($(this).prop("checked") == true){
            
               $(".shippingfield").removeClass('d-none');
            }
            else if($(this).prop("checked") == false){
               $(".shippingfield").addClass('d-none');
            }

});
    $("ul#purchase").siblings('a').attr('aria-expanded','true');
    $("ul#purchase").addClass("show");
    $("ul#purchase #purchase-create-menu").addClass("active");






    $('#category').change(function(){


            val = $('#category option:Selected').val();  
            $.ajax({
            url: '{{route("getpurchasesubcategory")}}',
            type: "GET",
            data:{'id':val},
            dataType: "json",
            success:function(data) {

                  $('.sub_cat_color').empty();
                  $.each(data, function(key, value) {
                      $('.sub_cat_color').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                  });
                  $('.selectpicker').selectpicker('refresh');
            },
        }); 


        }); 

$('#lims_productcodeSearch').keyup(function(){

  input = document.getElementById('lims_productcodeSearch');

    $('.all_categories').hide();
    var input, filter, ul, li, a, i, txtValue;


    filter = input.value.toUpperCase();

    if(filter!='' && filter!= ' '){
        ul = document.getElementById("myUL");
       // alert(ul);
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }

        }
    }else{
           
            $('.all_categories').hide();
    }

});

function change_input_quantity_ftn(th) {
    id = $(th).data('id');

    $(th).hide();
    $('.'+id).show();
}

function change_input_cost_ftn(th) {
    id = $(th).data('id');
   // alert(id);
    $(th).hide();   
    $('.'+id).show();
}

function quantity_class(th) {

    total = $(th).val();
    num = $(th).data('number');
    cost = $('.get_input_cost'+num).val();

    final = Number(total) * Number(cost);
    $('#final_cost'+num).html(final);

    get_subtotal();

    }


function cost_class(th) {


    cost = $(th).val();
    num = $(th).data('number');
    total = $('.get_input_quantity'+num).val();

    final = Number(total) * Number(cost);
    $('#final_cost'+num).html(final);

    get_subtotal();



}

var j = 1;
$('.get_product_data').click(function(){

});

function get_subtotal() {

    per_cost = 0;
    subtotal = 0;
    total_q = 0;    


    $('.final_cost').each(function(){

        subtotal = subtotal + Number($(this).html());
    });



    $('.total_cost').each(function(){

        per_cost = per_cost + Number($(this).val());

    });

    $('.quantity_class').each(function(){

        total_q = total_q + Number($(this).val());

    });    

    shiping = Number($('#shipping_cost').val());

    $('#total_product_cost').html(subtotal + shiping);
     $('#sub_total_cost').html(subtotal);
     $('#total_p_cost').html(per_cost);
     $('#total_product_quantity').html(total_q);
}


$('#shipping_cost').keyup(function(){

        get_subtotal();

});
</script>
<script type="text/javascript">
   

   function get_product_data(th){





    id = $(th).data('id');
    j = Number($('#selected').val());

    $.ajax({
                type:'GET',
                url:'{{route("get_raw_matetial_product")}}',
                data:{id:id
                },
                success: function( msg ) {

                    /*alert(msg.product_name);*/

                    x = `<tr>
                            <td><input type="hidden" name="product_name[]" value=`+j+`>`+msg.product_name+`</td>
                           

                            <td><span style="cursor:pointer;" onclick="change_input_quantity_ftn(this)" class="change_input_quantity`+j+`" data-id="get_input_quantity`+j+`">1</span>

                            <input type="number" style="display:none";  class="quantity_class get_input_quantity`+j+`" data-alert_quantity=`+msg.alert_quantity+` onkeyup="quantity_class(this)" data-total="get_total_cost`+j+`" data-cost="get_input_cost`+j+`" data-elem="change_input_quantity`+j+`" data-number="`+j+`" name="quantity[]" value="1">


                            </td> 

                            <td><span style="cursor:pointer" onclick="change_input_cost_ftn(this)" class="change_input_cost_ftn`+j+`" data-id="get_input_cost`+j+`"></span><input type="number" data-elem="change_input_cost_ftn`+j+`"   data-id="get_input_cost`+j+`" data-number="`+j+`" onkeyup="cost_class(this)" class="total_cost get_input_cost`+j+`" name="product_cost[]" value=`+msg.product_cost+`></td>

                            <td class="final_cost" id="final_cost`+j+`">0</td>
                            <td><input type="hidden" class="sub_total_cost get_total_cost`+j+`" name="total[]" value=`+msg.product_cost+`><span id="get_total_cost`+j+`">`+msg.product_cost+`</span></td>
                        `;

                    $('#tbody').append(x);     
                    j++;
                    $('#selected').val(j);
                    $('#filter_search').hide();      
                    get_subtotal();
                }
            });




   }

    function search1(th){
        val=$(th).val();
          $.ajax({
                type:'get',

                url:'{{route("get_rawmaterial_list")}}',
                data:{val:val
                },
                success: function( msg ) {
                    x = '';
                    for(i=0;i<msg.length;i++){

                        if(i==0){
                            x = `<li class="all_categories"><a style="cursor: pointer;" onclick="get_product_data(this)" class="get_product_data" data-id="`+msg[i].id+`">`+msg[i].product_name+`</a></li>`;
                        }else{
                            //x = x + `<li class="all_categories"><a style="cursor: pointer;" class="get_product_data" data-id="`+msg[i].id+`">`+msg[i].product_name+`</a></li>`;
                        }

                        $('#myUL').html(x);
                        $('#myUL').show();
                        $('#filter_search').show();
                    }

                }
            });
   
    }
    
   
</script>

@endsection @section('scripts')
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>

@endsection