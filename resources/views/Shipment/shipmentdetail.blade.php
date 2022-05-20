@extends('layout.main')

@section('content')


<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Shipment Detail')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>


                        <form id="product-form" method="Post" action="{{route('ShipmentSave')}}">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="production_id" value="{{$data->id}}">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Vechile Number')}} *</strong> </label>
                                        <div class="input-group">


                                        	<input type="text" required name="vechile_no" class="form-control">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Driver Name')}} *</strong> </label>
                                        <div class="input-group">


                                        	<input type="text" required name="driver_name" class="form-control">

                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Delivery Challan No')}} *</strong> </label>
                                        <div class="input-group">


                                        	<input type="text" required name="delivery_no" class="form-control">

                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Gate Pass')}} *</strong> </label>
                                        <div class="input-group">


                                        	<input type="text" required name="gate_pass" class="form-control"></textarea>

                                        </div>
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

@endsection