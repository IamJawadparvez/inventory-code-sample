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
                                            <th class="not-exported"></th>
                                            <th>{{trans('file.name')}}</th>
                                            <th>{{trans('file.phone')}}</th>
                                            <th>{{trans('file.email')}}</th>
                                            <th>{{trans('file.address')}}</th>
                                            <th class="not-exported">{{trans('file.action')}}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                        @foreach($warehouses as $wr)

                                            <tr>
                                                <td>{{$wr->id}}</td>
                                                <td>{{$wr->name}}</td>
                                                <td>{{$wr->phone}}</td>
                                                <td>{{$wr->email}}</td>
                                                <td>{{$wr->address}}</td>
                                              <td><div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                                    <li>
                                                        <!--  <button type="button" data-id="21" class="open-EditCategoryDialog btn btn-link" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i> Request For Raw Material </button> -->
                                                        <a href="{{route('warehouse_list',['id'=>$wr->id])}}" class="btn btn-link"><i class="fa fa-edit"> Request Raw Material</i></a>
                                                    </li>
                                                    <li class="divider"></li><form method="POST" action="http://localhost/SalePro2/sales/category/21" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="GXig4RESobOA4tWeGQk104fsMYMkIdrfBNeiaYen">
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
                </div>
            </div>
        </div>
    </div>
</section>

@endsection