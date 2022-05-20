@extends('layout.main')

@section('content')


<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Store List')}}</h4>
                    </div>
                    <div class="card-body">

                 <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    @php $i = 0 ;@endphp
                    @foreach($category as $cat)
                    @php

                      $name = strtolower($cat->name);
                      $name = str_replace(' ','_',$name);

                    @endphp
                    <a class="nav-item nav-link <?php if($i==0) echo 'active' ?>" id="nav-{{$name}}-tab" data-toggle="tab" href="#nav-{{$name}}" role="tab" aria-controls="nav-{{$name}}" aria-selected="true">{{$cat->name}}</a>
                    @php $i++ ;@endphp
                    @endforeach 

                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">

                   @php $i = 0 ;@endphp
                    @foreach($category as $cat)
                    @php

                      $name = strtolower($cat->name);
                      $name = str_replace(' ','_',$name);

                    @endphp

                    @php $allheads = DB::table('production_subcategories')->where('category_id',$cat->id)->where('parent_id',NULL)->select('id','name')->get(); @endphp

                        <div class="tab-pane fade show <?php if($i==0) echo 'active' ?>" id="nav-{{$name}}" role="tabpanel" aria-labelledby="nav-{{$name}}-tab">


                            <table class="table table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>{{trans('file.id')}}</th>
                                        <th>{{trans('file.Production Date')}}</th>
                                        @foreach($allheads as $head)

                                        <th>{{$head->name}}</th>

                                        @endforeach
                                        <th>{{trans('file.Status')}}</th>
                                         <th>{{trans('file.Recieved Date')}}</th>
                                        <th>{{trans('file.Action')}}</th>
                                    </tr>
                                </thead>
                            

                            <tbody>
                              
                               @foreach($production as $pro)
                               @if($pro->category==$cat->id)
                               @php
                                  $subcategory = unserialize($pro->subcategory);
                                  $value = unserialize($pro->value); 
                                  $x = 0;
                                @endphp

                                <tr>
                                  <td>{{$pro->id}}</td>
                                  <td>{{$pro->created_at}}</td>

                                   @foreach($subcategory as $sub)
                                @php $subcat = DB::table('production_subcategories')->where('category_id',$cat->id)->where('id',$sub)->first(); @endphp

                                    @if(!empty($subcat))

                                     @if($subcat->type=='select')
                                      @php $valx = DB::table('production_subcategories')->where('category_id',$cat->id)->where('id',$value[$x])->first() @endphp  

                                      @php $val = $valx->name; @endphp
                                     @else
                                      @php $val = $value[$x]; @endphp
                                    @endif
                                    @endif

                                 
                                  <td>{{isset($val)?$val:''}}</td>                                  
                                @php $x++ @endphp
                                @endforeach

                                    
                                   <td>@if($pro->store_status==0){{'Pending For Approveal'}} @else {{'Stock Received in Store'}} @endif</td>
                                   <td>{{$pro->store_received_date}}</td>
                                   <td>
                                       
                            <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <a href="{{route('StoreApproved',['id'=>$pro->id])}}" type="button" data-id="21"  class="open-EditCategoryDialog btn btn-link" data-target="#editModal"><i class="fa fa-edit"></i> Approved</button>
                                </li>

                                 <li>
                                    <a href="{{route('StoreApproved',['id'=>$pro->id])}}" type="button" data-id="21"  class="open-EditCategoryDialog btn btn-link" data-target="#editModal"><i class="fa fa-edit"></i>Received Date</button>
                                </li>
                                <li class="divider"></li><form method="POST" action="http://localhost/inventory/category/21" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="Y39l3WylxG74kaRAe1A9FjKWxLyba5DlmLo96TA6">
                                <li>
                                  <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="fa fa-trash"></i> Delete</button> 
                                </li></form>
                            </ul>
                        </div>





                                   </td>
                                </tr>
                                  @endif
                               @endforeach    


                            </tbody>    
                            </table>



                        </div>

                    @php $i++ ;@endphp
                   
                    @endforeach 


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
            /*'searchPlaceholder': "{{trans('file.Type Product Name or Code...')}}",*/
            'lengthMenu': '_MENU_ {{trans("file.records per page")}}',
             "info":      '{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)',
            "search":  '{{trans("file.Search")}}',
            'paginate': {
                    'previous': '{{trans("file.Previous")}}',
                    'next': '{{trans("file.Next")}}'
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
                text: '{{trans("file.PDF")}}',
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
                text: '{{trans("file.CSV")}}',
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
                text: '{{trans("file.Print")}}',
                exportOptions: {
                    columns: ':visible:not(.not-exported)',
                    rows: ':visible',
                    stripHtml: false
                }
            },
            {
                text: '{{trans("file.delete")}}',
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
                text: '{{trans("file.Column visibility")}}',
                columns: ':gt(0)'
            },
        ],
    } );


</script>
@endsection