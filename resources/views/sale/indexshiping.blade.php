@extends('layout.main')

@section('content')


<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                <div class="row" style="margin-bottom: 2%; ">
                    <a class="btn btn-primary" href="{{route('AddShipment')}}" role="button"> Add Shipment</a>
                
                    
                </div>

            </div>

                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Shipment')}}</h4>
                    </div>
                    <div class="card-body">



                           <div class="table-responsive">
                                <table id="product-data-table" class="table table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                           <th>{{trans('file.ProductionCategory ID')}}</th>
                                            <th class="not-exported"></th>
                                            <th>{{trans('file.Customer Name')}}</th>
                                            <th>{{trans('file.Driver Name')}}</th>
                                            <th>{{trans('file.Vechile No')}}</th>
                                            <th>{{trans('file.Driver No')}}</th>
                                            <th>{{trans('file.Quantity')}}</th>
                                            
                                  
                                            <th class="not-exported">{{trans('file.action')}}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($shipment as $ship)
                                    <tr>
                                        <td>{{$ship->productioncategory_id}}</td>
                                        <td></td>
                                         <td>{{$ship->customer_name}}</td>
                                          <td>{{$ship->driver_name}}</td>
                                           <td>{{$ship->quantity}}</td>
                                             <td>{{$ship->vechile_no}}</td>
                                               <td>{{$ship->driver_no}}</td>





                          <td><div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                               
                                <li class="divider"></li>
                                <form method="POST" action="http://localhost/SalePro2/sales/category/21" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="z9sPjZIzf3mW2y3oLeieokBt9LyBU1XacfDtOUjv">
                                <li>
                                  <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="fa fa-trash"></i> Delete</button> 
                                </li></form>
                            </ul>
                        </div></td>


                                    </tr>
                                    @endforeach

                                        
                                      
                                    </tbody>
                                    
                                </table>
                            </div>


                    </div>




<div id="purchase-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="container mt-3 pb-2 border-bottom">
            <div class="row">
                <div class="col-md-3">
                    <button id="print-btn" type="button" class="btn btn-default btn-sm d-print-none"><i class="fa fa-print"></i> {{trans('file.Print')}}</button>
                </div>
                <div class="col-md-6">
                    <h3 id="exampleModalLabel" class="modal-title text-center container-fluid">{{$general_setting->site_title}}</h3>
                </div>
                <div class="col-md-3">
                    <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close d-print-none"><span aria-hidden="true">×</span></button>
                </div>
                <div class="col-md-12 text-center">
                    <i style="font-size: 15px;">{{trans('file.Shipment Details')}}</i>
                </div>
            </div>
        </div>
            <div id="purchase-content" class="modal-body"></div>
            <br>
            <table class="table table-bordered product-purchase-list">
                <thead>
                    <th>#</th>
                    <th>{{trans('file.product')}}</th>
                    <th>Qty</th>
                    <th>{{trans('file.Unit Cost')}}</th>
                    <th>{{trans('file.Tax')}}</th>
                    <th>{{trans('file.Discount')}}</th>
                    <th>{{trans('file.Subtotal')}}</th>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div id="purchase-footer" class="modal-body"></div>
      </div>
    </div>
</div>





                </div>
            </div>
        </div>
    </div>
</section>

@endsection