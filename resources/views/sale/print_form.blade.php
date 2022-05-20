<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{url('public/logo', $general_setting->site_logo)}}" />
    <title>{{$general_setting->site_title}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <style type="text/css">
        * {
            font-size: 14px;
            line-height: 24px;
            font-family: 'Ubuntu', sans-serif;
            text-transform: capitalize;
        }
        .btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor:pointer;
        }

        .btn-info {
            background-color: #999;
            color: #FFF;
        }

        .btn-primary {
            background-color: #6449e7;
            color: #FFF;
            width: 100%;
        }
        td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }
        tr {border-bottom: 1px dotted #ddd;}
        td,th {padding: 7px 0;}

        table {width: 100%;}
        tfoot tr th:first-child {text-align: left;}

        .centered {
            text-align: center;
            align-content: center;
        }
        small{font-size:11px;}

        @media print {
            * {
                font-size:12px;
                line-height: 20px;
            }
            td,th {padding: 5px 0;}
            .hidden-print {
                display: none !important;
            }
            @page { margin: 0; } body { margin: 0.5cm; margin-bottom:1.6cm; } 
        }
    </style>
  </head>
<body>

<div style="max-width:400px;margin:0 auto">
    @if(preg_match('~[0-9]~', url()->previous()))
        @php $url = '../../pos'; @endphp
    @else
        @php $url = url()->previous(); @endphp
    @endif
    <div class="hidden-print">
        <table>
            <tr>
                <td><a href="{{$url}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> {{trans('file.Back')}}</a> </td>
                <td><button onclick="window.print();" class="btn btn-primary"><i class="fa fa-print"></i> {{trans('file.Print')}}</button></td>
            </tr>
        </table>
        <br>
    </div>
        
    <div id="receipt-data">
        <div class="centered">
            @if($general_setting->site_logo)
                <img src="{{url('public/logo', $general_setting->site_logo)}}" height="42" width="42" style="margin:10px 0;filter: brightness(0);">
            @endif
            
                       <p>{{trans('file.Address')}}: {{$warehouse->address}}
                <br>{{trans('file.Phone Number')}}: {{$warehouse->phone}}
            </p>
        </div>
        <p>{{trans('file.Date')}}: {{$data->created_at}}<br>
            {{trans('file.reference')}}: {{$data->reference_no}}<br>
            {{trans('file.customer')}}: {{$customer->name}}
        </p>
        <table>
            
            <tfoot>
                <tr>
                    <th colspan="2">{{trans('file.Total')}}</th>
                    <th style="text-align:right">{{number_format((float)$data->total_price, 2, '.', '')}}</th>
                </tr>
                @if($data->order_tax)
                <tr>
                    <th colspan="2">{{trans('file.Order Tax')}}</th>
                    <th style="text-align:right">{{number_format((float)$data->order_tax, 2, '.', '')}}</th>
                </tr>
                @endif
                @if($data->order_discount)
                <tr>
                    <th colspan="2">{{trans('file.Order Discount')}}</th>
                    <th style="text-align:right">{{number_format((float)$data->order_discount, 2, '.', '')}}</th>
                </tr>
                @endif
                @if($data->coupon_discount)
                <tr>
                    <th colspan="2">{{trans('file.Coupon Discount')}}</th>
                    <th style="text-align:right">{{number_format((float)$data->coupon_discount, 2, '.', '')}}</th>
                </tr>
                @endif
                @if($data->shipping_cost)
                <tr>
                    <th colspan="2">{{trans('file.Shipping Cost')}}</th>
                    <th style="text-align:right">{{number_format((float)$data->shipping_cost, 2, '.', '')}}</th>
                </tr>
                @endif
                <tr>
                    <th colspan="2">{{trans('file.grand total')}}</th>
                    <th style="text-align:right">{{number_format((float)$data->grand_total, 2, '.', '')}}</th>
                </tr>
                <tr>
                    @if($general_setting->currency_position == 'prefix')
                    <th class="centered" colspan="3">{{trans('file.In Words')}}: <span>{{$general_setting->currency}}</span> <span>{{str_replace("-"," ",$numberInWords)}}</span></th>
                    @else
                    <th class="centered" colspan="3">{{trans('file.In Words')}}: <span>{{str_replace("-"," ",$numberInWords)}}</span> <span>{{$general_setting->currency}}</span></th>
                    @endif
                </tr>
            </tfoot>
        </table>
            
        
        </div>
       
        <table class="table table-responsive">
               
                 <tbody>
                            
                        @foreach($array as $arr)
                         @php $ctnamedata = DB::table('production_categories')->where('id',$arr['caid'])->first();@endphp
                        <tr>
                            <th colspan="4">{{$ctnamedata->name}}</th>
                        </tr>

                        <tr>    

                            @foreach($arr['catname'] as $ct)

                                <th style="width: 100px;">{{$ct}}</th>

                            @endforeach
                            <th style="width: 100px;">Price</th>
                        </tr>

                            @foreach($items as $it)

                                        @php $data = DB::table('productions')->where('id',$it->item_id)->first(); 

                                            $categories = unserialize($data->subcategory);

                                            $value = unserialize($data->value);                                            
                                        @endphp
                                        @if($data->category==$arr['caid'])
                                        <tr>
                                        @foreach($categories as $key => $ct)

                                            @php $ctdata = DB::table('production_subcategories')->where('id',$ct)->first(); @endphp

                                                @if($ctdata->type=='select')    
                                                        @php $stdata = DB::table('production_subcategories')->where('id',$value[$key])->first(); @endphp    
                                                   @php $dataname = $stdata->name; @endphp

                                                @else
                                                   @php $dataname = $value[$key]; @endphp
                                                @endif  

                                                    <td style="text-align: center;">{{$dataname}}</td>


                                        @endforeach
                                        <td style="text-align: center;">{{$it->price}}</td>

                                    </tr>
                                    @endif
                                        
                            @endforeach



                        @endforeach

                    </tbody>
        </table>
        <!-- <div class="centered" style="margin:30px 0 50px">
            <small>{{trans('file.Invoice Generated By')}} {{$general_setting->site_title}}.
            {{trans('file.Developed By')}} LionCoders</strong></small>
        </div> -->
    </div>
</div>

<script type="text/javascript">
    function auto_print() {     
       // window.print()
    }
    setTimeout(auto_print, 1000);
</script>

</body>
</html>
