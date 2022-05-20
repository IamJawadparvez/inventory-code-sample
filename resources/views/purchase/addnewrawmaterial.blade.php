@extends('layout.main')

@section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Add Raw Material')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        <form id="raw_material-form" method="POST" action="{{route('saverawmaterial')}}" enctype="multipart/form-data">
                        @csrf

                            <div class="row">
                                


                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Ware House')}} *</strong> </label>
                                        <div class="input-group">
                                            <select name="store_id"  class="form-control selectpicker" id="store_id">
                                                <option value="{{NULL}}">Choose</option>
                                                @foreach($warehouse as $war)
                                                <option value="{{$war->id}}">{{$war->name}}</option>
                                                @endforeach
                                             
                                            </select>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Purchase Category')}} *</strong> </label>
                                        <div class="input-group">
                                            <select name="purchase_category" required class="form-control selectpicker" id="purchase_category">
                                                <option value="Null"> Choose</option>
                                            @foreach($purchase as $p)
                                            <option value="{{$p->id}}">{{$p->name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.SubCategory')}} *</strong> </label>
                                     <select name="subcategory" id="purchase_subcategory"   class="form-control">
                                        <option></option>
                                         
                                     </select>
                                        <span class="validation-msg" id="name-error"></span>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Product  Name')}} *</strong> </label>
                                        <div class="input-group" class="form-control">
                                            <input type="text" name="productname" class="form-control" id="code" aria-describedby="code" required>
                                           
                                        </div>
                                        <span class="validation-msg" id="code-error"></span>
                                    </div>
                                </div>
                               
                            
                               
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Brand')}}</strong> </label>
                                        <div class="input-group">
                                          <select name="brand" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Brand...">
                                            @foreach($brand as $b)
                                            <option value="{{$b->id}}">{{$b->title}}</option>
                                            @endforeach
                                          
                                          </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                                <label><strong>{{trans('file.Product Unit')}} *</strong> </label>
                                                <div class="input-group">
                                                  <select required data-live-search="true" data-live-search-style="begins" class="form-control selectpicker" name="product_unit">
                                                    <option value="" disabled selected>Select Product Unit...</option>
                                                 @foreach($unit as $u)
                                                 <option value="{{$u->id}}">{{$u->unit_name}}</option>
                                                 @endforeach
                                                  </select>
                                              </div>
                                              <span class="validation-msg"></span>
                                        </div>

                                        <div id="alert-qty" class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{trans('file. Quantity')}}</strong> </label>
                                        <input type="number" name="alert_quantity" class="form-control" step="any">
                                    </div>
                                </div>
                              
                                <div id="unit" class="col-md-12">
                                    <div class="row ">
                                      


                                   <!-- <div id="cost" class="col-md-4">
                                     <div class="form-group">
                                        <label><strong>{{trans('file.Product Cost')}} *</strong> </label>
                                        <input type="number" name="product_cost" required class="form-control" step="any">
                                        <span class="validation-msg"></span>
                                    </div>
                                </div> -->
                                  



                                                                   
                                    </div>                                
                                </div>
                              
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Product Image')}}</strong> </label> <i class="fa fa-question-circle" data-toggle="tooltip" title="{{trans('file.You can upload multiple image. Only .jpeg, .jpg, .png, .gif file can be uploaded. First image will be base image.')}}"></i>
                                        <div id="imageUpload" class="dropzone"></div>
                                        <span class="validation-msg" id="image-error"></span>
                                    </div>
                                </div>                            
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Product Details')}}</strong></label>
                                        <textarea name="product_details" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="{{trans('file.submit')}}" id="submit-btn" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

    $("ul#purchase").siblings('a').attr('aria-expanded','true');
    $("ul#purchase").addClass("show");
    $("ul#purchase #purchase-add").addClass("active");

    $("#digital").hide();
    $("#combo").hide();
    $("#variant-section").hide();
    $("#promotion_price").hide();
    $("#start_date").hide();
    $("#last_date").hide();

    $('[data-toggle="tooltip"]').tooltip(); 

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#genbutton').on("click", function(){
      $.get('gencode', function( data){
        $("input[name='code']").val(data);
      });
    });

    $('.selectpicker').selectpicker({
      style: 'btn-link',
    });

    tinymce.init({
      selector: 'textarea',
      height: 130,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor textcolor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code wordcount'
      ],
      toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
      branding:false
    });

    $('select[name="type"]').on('change', function() {
        if($(this).val() == 'combo'){
            $("input[name='cost']").prop('required',false);
            $("select[name='unit_id']").prop('required',false);
            hide();
            $("#combo").show(300);
            $("input[name='price']").prop('disabled',true);
            $("#is-variant").prop("checked", false);
            $("#variant-section, #variant-option").hide(300);
        }
        else if($(this).val() == 'digital'){
            $("input[name='cost']").prop('required',false);
            $("select[name='unit_id']").prop('required',false);
            $("input[name='file']").prop('required',true);
            hide();
            $("#digital").show(300);
            $("#combo").hide(300);
            $("input[name='price']").prop('disabled',false);
            $("#is-variant").prop("checked", false);
            $("#variant-section, #variant-option").hide(300);
        }
        else if($(this).val() == 'standard'){
            $("input[name='cost']").prop('required',true);
            $("select[name='unit_id']").prop('required',true);
            $("input[name='file']").prop('required',false);
            $("#cost").show(300);
            $("#unit").show(300);
            $("#alert-qty").show(300);
            $("#variant-option").show(300);
            $("#digital").hide(300);
            $("#combo").hide(300);
            $("input[name='price']").prop('disabled',false);
        }
    });

    $('select[name="unit_id"]').on('change', function() {
        
        unitID = $(this).val();
        if(unitID) {
            populate_category(unitID);
        }else{    
            $('select[name="sale_unit_id"]').empty();
            $('select[name="purchase_unit_id"]').empty();
        }                        
    });
    <?php $productArray = []; ?>
   

    var lims_productcodeSearch = $('#lims_productcodeSearch');

    lims_productcodeSearch.autocomplete({
        source: function(request, response) {
            var matcher = new RegExp(".?" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(lims_product_code, function(item) {
                return matcher.test(item);
            }));
        },
        select: function(event, ui) {
            var data = ui.item.value;
            $.ajax({
                type: 'GET',
                url: 'search',
                data: {
                    data: data
                },
                success: function(data) {
                    var flag = 1;
                    $(".product-id").each(function() {
                        if ($(this).val() == data[4]) {
                            alert('Duplicate input is not allowed!')
                            flag = 0;
                        }
                    });
                    $("input[name='product_code_name']").val('');
                    if(flag){
                        var newRow = $("<tr>");
                        var cols = '';
                        cols += '<td>' + data[0] +' [' + data[1] + ']</td>';
                        cols += '<td><input type="number" class="form-control qty" name="product_qty[]" value="1" step="any"/></td>';
                        cols += '<td><input type="number" class="form-control unit_price" name="unit_price[]" value="' + data[3] + '" step="any"/></td>';
                        cols += '<td><button type="button" class="ibtnDel btn btn-sm btn-danger">X</button></td>';
                        cols += '<input type="hidden" class="product-id" name="product_id[]" value="' + data[4] + '"/>';

                        newRow.append(cols);
                        $("table.order-list tbody").append(newRow);
                        calculate_price();
                    }
                }
            });
        }
    });







    myDropzone = new Dropzone('div#imageUpload', {
        addRemoveLinks: true,
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 100,
        maxFilesize: 12,
        paramName: 'image',
        clickable: true,
        method: 'POST',
        url: '{{route('products.store')}}',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            return time + file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        init: function () {
            var myDropzone = this;
        }
      
      
    });


    $('#purchase_category').change(function(){


            val = $('#purchase_category option:Selected').val();         

            $.ajax({

            url: '{{route("getpurchasesubcategory")}}',
            type: "GET",
            dataType: "json",
            data : {'id':val},
            success:function(data) {
                  $('#purchase_subcategory').empty();
                  $.each(data, function(key, value) {

                      $('#purchase_subcategory').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                  });
                  $('.selectpicker').selectpicker('refresh');
            },
        });     

        });

</script>
@endsection
