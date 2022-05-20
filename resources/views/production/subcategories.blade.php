@extends('layout.main')
 @section('content')

@if($errors->has('name'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('name') }}</div>
@endif
@if(session()->has('message'))
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div> 
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif

<section>
    <div class="container-fluid">
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i> {{trans("file.Add Category")}}</button>&nbsp;

    </div>
    <div class="table-responsive">
        <table id="category-table" class="table table-striped" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported">ID</th>
                    <th>{{trans('file.category')}}</th>
                     <th>{{trans('file.category id')}}</th>
                     <th>{{trans('file.parent id')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>

             <tbody>
        		
        		@foreach($categories as $cat)

        			<tr>
        				<td>{{$cat->id}}</td>
        				<td>{{$cat->name}}</td>
                <td>{{$cat->category_id}}</td>
                <td>{{$cat->parent_id}}</td>
        				<td>
                

                </td>
        			</tr>

        		@endforeach

        </tbody>
        </table>

       
    </div>
</section>

<!-- Create Modal -->
<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Category')}}</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
          <form method="post" action="{{url('production-subcategories-save')}}">
          	@csrf
            <div class="form-group">
                <label><strong>{{trans('file.name')}} *</strong></label>
                {{Form::text('name',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => 'Type category name...'))}}
            </div>
            <input type="hidden" name="head_id" value="{{$id}}">
        
        <div class="form-group">
            <label><strong>{{trans('file.Parent Category')}}</strong></label>
            <select name="parent_id" class="form-control selectpicker" id="parent">
                <option value="{{NULL}}">No {{trans('file.parent')}}</option>
                @foreach($categories as $category)
                @if(empty($category->parent_id))
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endif  
                @endforeach
            </select>
        </div>

                <div class="form-group" id="input_type">
            <label><strong>{{trans('file.Input Type')}}</strong></label>
            <select name="input_type" class="form-control selectpicker" >
                <option value="">No {{trans('file.Type')}}</option>
                @php $input_types =['text','select']; @endphp
                @foreach($input_types as $input)
                <option value="{{$input}}">{{$input}}</option>
                @endforeach
            </select>
        </div>


            <div class="form-group">       
              <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
            </div>
          </form>
        </div>

      </div>
    </div>
</div>
<!-- Edit Modal -->
<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
        {{ Form::open(['route' => ['category.update', 1], 'method' => 'PUT'] ) }}
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Update Category')}}</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
          <div class="form-group">
            <label><strong>{{trans('file.name')}} *</strong></label>
            {{Form::text('name',null, array('required' => 'required', 'class' => 'form-control'))}}
        </div>
            <input type="hidden" name="category_id">
        <div class="form-group">
            <label><strong>{{trans('file.Parent Category')}}</strong></label>
            <select name="parent_id" class="form-control selectpicker" id="parent">
                <option value="">No {{trans('file.parent')}}</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">       
            <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
          </div>
        </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
<!-- Import Modal -->
<div id="importCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(['route' => 'category.import', 'method' => 'post', 'files' => true]) !!}
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Import Category')}}</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
           <p>{{trans('file.The correct column order is')}} (name*, parent_category) {{trans('file.and you must follow this')}}.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>{{trans('file.Upload CSV File')}} *</strong></label>
                        {{Form::file('file', array('class' => 'form-control','required'))}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong> {{trans('file.Sample File')}}</strong></label>
                        <a href="public/sample_file/sample_category.csv" class="btn btn-info btn-block btn-md"><i class="fa fa-download"></i>  {{trans('file.Download')}}</a>
                    </div>
                </div>
            </div>
            <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
        </div>
        {{ Form::close() }}
      </div>7
    </div>
</div>

<script type="text/javascript">
	
  $('#parent').change(function(){


      if($(this).val()=='' || $(this).val()==null){
        $('#input_type').show();
      }else{
        $('#input_type').hide();

      }


  });

</script>
@endsection