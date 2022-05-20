@extends('layout.main')

@section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Add Shipment')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        <form  method="Post" action="{{route('createshipping')}}">
                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Production Name')}} *</strong> </label>
                                        <div class="input-group">
                                            <select name="production_id" required class="form-control selectpicker">
                                                <option value="{{NULL}}">Choose</option>
                                                 @foreach($productioncategories as $pc)
                                               <option value="{{$pc->id}}">{{$pc->name}}</option>


                                                @endforeach
                                            
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Customer Name')}} *</strong> </label>
                                        <div class="input-group">
                                           <input type="text" name=" customername" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Driver Name')}} *</strong> </label>
                                        <input type="text" name="drivername" class="form-control"  aria-describedby="name" required>
                                        <span class="validation-msg" id="name-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Vechile No')}} *</strong> </label>
                                        <div class="input-group">
                                            <input type="text" name="vechile_no" class="form-control" aria-describedby="code" required>
                                           
                                        </div>
                                        <span class="validation-msg" id="code-error"></span>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Driver No')}} *</strong> </label>
                                        <div class="input-group">
                                         <input type="text" name="driver_no" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Quantity')}} *</strong> </label>
                                        <div class="input-group">
                                         <input type="text" name="quantity" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                                          
                                
                            </div>
                            <div class="form-group">
                                <input type="submit"  value="submit" class="btn btn-primary">
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
