@extends('layout.main')

@section('content')


<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.add_production')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>


                        <form method="Post" action="{{route('addproduction')}}">

                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.category')}} *</strong> </label>
                                        <div class="input-group">



                                        	<select  name="main_category" class="form-control" id="category">

                                        		
                                        		<option value="{{NULL}}">Choose</option>
                                        		@foreach($category as $cat)
                                        		@php

												                      $name = strtolower($cat->name);
												                      $name = str_replace(' ','_',$name);

												                    @endphp
                                        			<option data-div="{{$name}}" value="{{$cat->id}}">{{$cat->name}}</option>
                                        		@endforeach

                                        	</select>

                                        </div>
                                    </div>
                                </div>


                            @foreach($category as $cat)


                            	@php

												                      $name = strtolower($cat->name);
												                      $name = str_replace(' ','_',$name);

												                    @endphp


                            	<div class="col-md-12 category_divs" id="{{$name}}" style="display: none">

								<div class="row">

									@foreach($cat->subcategory as $sc)

									<input type="hidden" name="category{{$cat->id}}[]" value="{{$sc->id}}">
									<div class="col-md-3">
	                                    <div class="form-group">
	                                        <label><strong>{{trans('file.'.$sc->name)}} *</strong> </label>
	                                        <div class="input-group">

	                                        	@if($sc->type=='select')
	                                        	<select name="subcategory{{$cat->id}}[]" class="form-control sub_cat_color">

	                                        			
	                                        		<option value="{{NULL}}">Choose</option>
	                                        		@foreach($sc->cat_values as $values)
	                                        		<option value="{{$values->id}}">{{$values->name}}</option>

	                                        		@endforeach

	                                        	</select>
	                                        	@else
	                                        	<input type="text" name="subcategory{{$cat->id}}[]" class="form-control">
	                                        	@endif


	                                        </div>
	                                    </div>
	                                </div>



									@endforeach


                            	</div>



							</div>

                            @endforeach	



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
<script type="text/javascript">
		
	$('#category').change(function(){

		div = $('#category option:Selected').data('div');			
		$('.category_divs').hide();

		$('#'+div).show();

	});


</script>
@endsection
