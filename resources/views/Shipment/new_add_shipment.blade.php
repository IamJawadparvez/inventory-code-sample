                        <div class="row new_product_row">
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.category')}} *</strong> </label>
                                        <div class="input-group">



                                            <select  name="main_category[]" data-value="{{$value}}"  onchange="show_category(this);" class="form-control show_category" data-id="subcategory{{$value}}" id="category{{$value}}">

                                                
                                                <option value="{{NULL}}">Choose</option>
                                                @foreach($category as $cat)
                                                @if(!in_array($cat->id,$all_values))
                                                @php

                                                                      $name = strtolower($cat->name);
                                                                      $name = str_replace(' ','_',$name);

                                                                    @endphp
                                                    <option data-div="{{$name}}" data-class="show_filter{{$value}}" value="{{$cat->id}}">{{$cat->name}}</option>
                                                @endif

                                                @endforeach
                                                
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="clearfix"></div> 




                        </div>


                                 <div class="row" id="subcategory{{$value}}">
                                        
                                                @php $fl = 0; @endphp
                                                @foreach($category as $cat)
                                                @php
                                                $name = strtolower($cat->name);
                                                $name = str_replace(' ','_',$name);
                                                @endphp
                                                <div class="col-md-12 show_filter{{$value}}" id="{{$name}}" style="display: block">
                                                    <div class="row"> 
                                                    @foreach($cat->subcategory as $sb)
                                                     @php
                                                        $sbname = strtolower($sb->name);
                                                        $sbname = str_replace(' ','_',$sbname);
                                                        @endphp
                                                        <div class="col-md-2">
                                                              <label><strong>{{$sb->name}}</strong></label>  
                                                              <input type="text" name="{{$sbname}}" id="{{$sb->id}}" class="form-control {{$sbname}}_filter {{$name}}">
                                                        </div>
                                                                                                        
                                                    @endforeach
                                                    <div class="col-md-2">
                                                         <label class="col-md-12"><strong>Filter</strong></label>  
                                                        <input type="button" data-cat="{{$name}}" name="filter{{$name}}" data-id="{{$cat->id}}"  class="search_production btn btn-primary" onclick="search_production(this);" value="Filter">
                                                    </div>
                                                    </div>

                                                </div>

                                                @php $fl++; @endphp
                                                @endforeach
                            
                                </div>
                            