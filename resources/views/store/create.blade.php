@extends('layout.main')

@section('content')


<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.add_store')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>


                        <form id="product-form" method="Post" action="{{route('addstores')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Store Name')}} *</strong> </label>
                                        <div class="input-group">


                                        	<input type="text" required name="name" class="form-control">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Store Phone')}} *</strong> </label>
                                        <div class="input-group">


                                        	<input type="text" required name="phone" class="form-control">

                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Store Email')}} *</strong> </label>
                                        <div class="input-group">


                                        	<input type="email" required name="email" class="form-control">

                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Store Address')}} *</strong> </label>
                                        <div class="input-group">


                                        	<textarea type="text" required name="address" class="form-control"></textarea>

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