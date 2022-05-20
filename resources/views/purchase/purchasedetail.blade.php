<section>
    <div class="container-fluid">
        @if(in_array("purchases-add", $all_permission))
            <a href="{{route('purchases.create')}}" class="btn btn-info"><i class="fa fa-plus"></i> {{trans('file.Add Purchase')}}</a>&nbsp;
            <a href="{{url('purchases/purchase_by_csv')}}" class="btn btn-primary"><i class="fa fa-file"></i> {{trans('file.Import Purchase')}}</a>
        @endif
    </div>
    <div class="table-responsive">
        <table id="purchase-table" class="table table-striped purchase-list">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.WareHouse Name')}}</th>
                    <th>{{trans('file.Supplier Name')}}</th>
                    <th>{{trans('file.Product Name')}}</th>
                    <th>{{trans('file.Product Quantity')}}</th>
                    <th>{{trans('file.Product Cost')}}</th>
                    
                    <th>{{trans('file.Discount')}}</th>
                     <th>{{trans('file.Total')}}</th>
                     <th>{{trans('file.Paid Amount')}}</th>
                    <th>{{trans('file.Payment Status')}}</th>
                     <th>{{trans('file.Shipment Agent Name')}}</th>
                      <th>{{trans('file.Shipment Cost')}}</th>

                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>
            
         <tbody>
        @foreach($purchase as $pur)

          <tr>
              <td></td>
              <td>{{$pur->warehouse->name}}</td>
              <td>{{$pur->supplier->name}}</td>
              <td>{{$pur->material->product_name}}</td>
              <td>{{$pur->quantity}}</td>
              <td>{{$pur->product_cost}}</td>
              <td>{{$pur->discount}}</td>
              <td>{{$pur->total}}</td>
              <td>{{$pur->paid_amount}}</td>
              <td></td>
              <td>{{$pur->shipment->name}}</td>
              <td>{{$pur->shipping_cost}}</td>
              
          </tr>
        @endforeach
    </tbody>
        </table>
    </div>
</section>