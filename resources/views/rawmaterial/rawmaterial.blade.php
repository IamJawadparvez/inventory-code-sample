@extends('layout.main')

@section('content')


<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>Request raw material</h4>
                    </div>
                    <div class="card-body">



                           <div class="table-responsive">
                                <table id="product-data-table" class="table table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="not-exported"></th>
                                             <th>Supplier</th>
                                            <th>Item</th>
                                            <th>Total Quantity</th>
                                            <th>Request</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($purchase as $pur)

                                        <tr>
                                            <td></td>
                                
                                              <td>{{$pur->supplier_id}}</td>
                                                <td>{{$pur->item}}</td>
                                              <td>{{$pur->total_qty}}</td>

                                             <td>
                                                <form method="post" action="{{route('new_request_raw_material')}}">     
                                                    @csrf

                                                    <input type="hidden" name="item_id" value="{{$pur->item}}">
                                                    <input type="hidden" name="warehouse_id" value="{{$pur->warehouse_id}}">                                                    
                                                    <input type="number" name="requested_amount" class="form-control">
                                                    <input type="submit" class="btn btn-success" name="submit" value="Request">
                                                </form>
                                             </td>



                                        </tr>

                                        
                                       
                                     @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection