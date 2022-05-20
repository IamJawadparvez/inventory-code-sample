@extends('layout.main') @section('content')

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
    <div class="row">
       <div class="col-md-12">
          <div>
        <div class="container" style="margin-bottom: 3%;">
            <div class="row"><!-- 
                <a href="" ><i class="btn btn-info">Add Purchase Category</i></a> -->



                 <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i> {{trans("file.Add Category")}}</button>
                
            </div>
        </div>
    
    </div>
         <div class="card">
  
   
    <div class="table-responsive">
        <table id="category-table" class="table table-striped" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.category')}}</th>
                    <th>{{trans('file.Parent Category')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchasecategory as $pc)
                <tr>
                    <td></td>
                    <td>{{$pc->name}}</td>
                      <td>{{$pc->parent_id}}</td>
                        <td><div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <button type="button" data-id="{{$pc->id}}" data-parentid="{{$pc->parent_id}}" data-name="{{$pc->name}}" class="open-EditCategoryDialog btn btn-link" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i> Edit</button>
                                </li>
                                <li class="divider"></li><form method="POST" action="http://localhost/SalePro2/sales/category/21" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="z9sPjZIzf3mW2y3oLeieokBt9LyBU1XacfDtOUjv">
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
</section>



<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
    
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Category')}}</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>


          <form method="post" action="{{route('AddPurchase')}}">
            @csrf
            <div class="form-group">
                <label><strong>{{trans('file.name')}} *</strong></label>
                {{Form::text('name',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => 'Type category name...'))}}
            </div>
            <div class="form-group">
                <label><strong>{{trans('file.Parent Category')}}</strong></label>

          <!--     <input type="text" name="purchasecategory" class="form-control"> -->
     
          <select class="form-control" name="parent_id">
          <option value="{{Null}}"> Choose Parent</option>
                 @foreach($purchase as $p)
       
        <option value="{{$p->id}}">{{$p->name}}</option>             
      
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








<div id="editModal" tabindex="-1" role="dialog"   aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
    
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Edit Category')}}</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>


          <form method="post" action="">
            @csrf
            <div class="form-group">
                <label><strong>{{trans('file.name')}} *</strong></label>
           <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label><strong>{{trans('file.Parent Category')}}</strong></label>

          <!--     <input type="text" name="purchasecategory" class="form-control"> -->
     
          <select class="form-control" name="parent_id" id="parentid">
            <option value="{{Null}}">Select Parent</option>
                 @foreach($purchase as $p)

        <option value="{{$p->id}}">{{$p->name}}</option>             
      
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



<script type="text/javascript">
    
$('.open-EditCategoryDialog').click(function(){

id=$(this).data('id');
//alert(id);
name=$(this).data('name');
parent_id=$(this).data('parentid');
//alert(parent_id);

$('#name').val(name);
$('#parentid').val(parent_id);

})





</script>

@endsection