@extends('layout.main')

@section('content')


<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.request')}}</h4>
                    </div>
                    <div class="card-body">



                           <div class="table-responsive">
                                <table id="product-data-table" class="table table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="not-exported">{{trans('file.id')}}</th>
                                            <th>{{trans('file.order_id')}}</th>
                                            <th>{{trans('file.warehouse')}}</th>
                                            <th>{{trans('file.item')}}</th>
                                            <th>{{trans('file.Quantity')}}</th>
                                           
                                            <th>{{trans('file.status')}}</th>
                                            <th>{{trans('file.action')}}</th>
                                        
                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                        @foreach($data as $wr)
                                             <tr>
                                                <td>{{$wr->id}}</td>
                                                <td>#{{substr($wr->order_id, 0,7)}}</td>
                                                <td>{{$wr->warehouse->name}}</td>
                                                <td>{{isset($wr->rawmaterial)?$wr->rawmaterial->product_name:""}}</td>
                                                <td>{{$wr->quantity}}</td>
                                            
                                                <td>
                                                        
                                                   @if($wr->status==0)
                                                
                                                   <button class="btn btn-warning">Pending</button>
                                                    @else

                                                    <button class="btn btn-success">Confirmed</button>

                                                   @endif     

                                                </td>

                                                <td>
                                                        
                                                        <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                               <li>
                                                        <a href="{{route('ProductionRequest',['id'=>$wr->id])}}" class="btn btn-link"><i class="fa fa-edit"> Edit</i></a>
                                                    </li>



                                                    <li>
                                                        <a href="{{route('approverequest',['id'=>$wr->id])}}" class="btn btn-link"><i class="fa fa-edit"> Approve Order</i></a>
                                                    </li>
                                                    <li class="divider"></li><form method="POST" action="{{route('rejectrequest',['id'=>$wr->id])}}" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="GXig4RESobOA4tWeGQk104fsMYMkIdrfBNeiaYen">
                                                    <li>
                                                        <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="fa fa-trash"></i> Delete</button>
                                                    </li></form>
                                                </ul>
                                            </div>

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