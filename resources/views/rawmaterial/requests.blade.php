@extends('layout.main')

@section('content')


<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.request raw material')}}</h4>
                    </div>
                    <div class="card-body">



                           <div class="table-responsive">
                                <table id="product-data-table" class="table table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="not-exported">{{trans('file.id')}}</th>
                                            <th>{{trans('file.warehouse')}}</th>
                                            <th>{{trans('file.item')}}</th>
                                            <th>{{trans('file.total')}}</th>
                                            <th>{{trans('file.status')}}</th>
                                        
                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                        @foreach($data as $wr)

                                            <tr>
                                                <td>{{$wr->id}}</td>
                                                <td>{{$wr->warehouse_id}}</td>
                                                <td>{{$wr->item_id}}</td>
                                                <td>{{$wr->total}}</td>
                                                <td>
                                                        
                                                   @if($wr->status==0)
                                                    
                                                    {{'Pending'}}

                                                   @else

                                                   {{'Confirmed'}}

                                                   @endif     

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