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
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i> {{trans("file.Add Category")}}</button>&nbsp;
                      <div class="table-responsive">
        <table id="category-table" class="table table-striped" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported">ID</th>
                    <th>{{trans('file.category')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>

             <tbody>
            
            @foreach($categories as $cat)

              <tr>
                <td>{{$cat->id}}</td>
                <td>{{$cat->name}}</td>
                <td>
                
                  <a class="btn btn-success" href="{{route('production.subcategories',['id'=>$cat->id])}}">Subcategories</a>


                </td>
              </tr>

            @endforeach

        </tbody>
        </table>

       
    </div>

<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Category')}}</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
          <form method="post" action="{{url('production-categories-save')}}">
            @csrf
            <div class="form-group">
                <label><strong>{{trans('file.name')}} *</strong></label>
                {{Form::text('name',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => 'Type category name...'))}}
            </div>


            <div class="form-group">       
              <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
            </div>
          </form>
        </div>

      </div>
    </div>
</div>


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
