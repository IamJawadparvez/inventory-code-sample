<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="<?php echo e(url('public/logo', $general_setting->site_logo)); ?>" />
    <title><?php echo e($general_setting->site_title); ?></title>
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

        @media  print {
            * {
                font-size:12px;
                line-height: 20px;
            }
            td,th {padding: 5px 0;}
            .hidden-print {
                display: none !important;
            }
            @page  { margin: 0; } body { margin: 0.5cm; margin-bottom:1.6cm; } 
        }
    </style>
  </head>
<body>

<div style="max-width:400px;margin:0 auto">
    <?php if(preg_match('~[0-9]~', url()->previous())): ?>
        <?php $url = '../../pos'; ?>
    <?php else: ?>
        <?php $url = url()->previous(); ?>
    <?php endif; ?>
    <div class="hidden-print">
        <table>
            <tr>
                <td><a href="<?php echo e($url); ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> <?php echo e(trans('file.Back')); ?></a> </td>
                <td><button onclick="window.print();" class="btn btn-primary"><i class="fa fa-print"></i> <?php echo e(trans('file.Print')); ?></button></td>
            </tr>
        </table>
        <br>
    </div>
        
    <div id="receipt-data">
        <div class="centered">
            <?php if($general_setting->site_logo): ?>
                <img src="<?php echo e(url('public/logo', $general_setting->site_logo)); ?>" height="42" width="42" style="margin:10px 0;filter: brightness(0);">
            <?php endif; ?>
            
                       <p><?php echo e(trans('file.Address')); ?>: <?php echo e($warehouse->address); ?>

                <br><?php echo e(trans('file.Phone Number')); ?>: <?php echo e($warehouse->phone); ?>

            </p>
        </div>
        <p><?php echo e(trans('file.Date')); ?>: <?php echo e($data->created_at); ?><br>
            <?php echo e(trans('file.reference')); ?>: <?php echo e($data->reference_no); ?><br>
            <?php echo e(trans('file.customer')); ?>: <?php echo e($customer->name); ?>

        </p>
        <table>
            
            <tfoot>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.Total')); ?></th>
                    <th style="text-align:right"><?php echo e(number_format((float)$data->total_price, 2, '.', '')); ?></th>
                </tr>
                <?php if($data->order_tax): ?>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.Order Tax')); ?></th>
                    <th style="text-align:right"><?php echo e(number_format((float)$data->order_tax, 2, '.', '')); ?></th>
                </tr>
                <?php endif; ?>
                <?php if($data->order_discount): ?>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.Order Discount')); ?></th>
                    <th style="text-align:right"><?php echo e(number_format((float)$data->order_discount, 2, '.', '')); ?></th>
                </tr>
                <?php endif; ?>
                <?php if($data->coupon_discount): ?>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.Coupon Discount')); ?></th>
                    <th style="text-align:right"><?php echo e(number_format((float)$data->coupon_discount, 2, '.', '')); ?></th>
                </tr>
                <?php endif; ?>
                <?php if($data->shipping_cost): ?>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.Shipping Cost')); ?></th>
                    <th style="text-align:right"><?php echo e(number_format((float)$data->shipping_cost, 2, '.', '')); ?></th>
                </tr>
                <?php endif; ?>
                <tr>
                    <th colspan="2"><?php echo e(trans('file.grand total')); ?></th>
                    <th style="text-align:right"><?php echo e(number_format((float)$data->grand_total, 2, '.', '')); ?></th>
                </tr>
                <tr>
                    <?php if($general_setting->currency_position == 'prefix'): ?>
                    <th class="centered" colspan="3"><?php echo e(trans('file.In Words')); ?>: <span><?php echo e($general_setting->currency); ?></span> <span><?php echo e(str_replace("-"," ",$numberInWords)); ?></span></th>
                    <?php else: ?>
                    <th class="centered" colspan="3"><?php echo e(trans('file.In Words')); ?>: <span><?php echo e(str_replace("-"," ",$numberInWords)); ?></span> <span><?php echo e($general_setting->currency); ?></span></th>
                    <?php endif; ?>
                </tr>
            </tfoot>
        </table>
            
        
        </div>
       
        <table class="table table-responsive">
               
                 <tbody>
                            
                        <?php $__currentLoopData = $array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php $ctnamedata = DB::table('production_categories')->where('id',$arr['caid'])->first();?>
                        <tr>
                            <th colspan="4"><?php echo e($ctnamedata->name); ?></th>
                        </tr>

                        <tr>    

                            <?php $__currentLoopData = $arr['catname']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <th style="width: 100px;"><?php echo e($ct); ?></th>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <th style="width: 100px;">Price</th>
                        </tr>

                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php $data = DB::table('productions')->where('id',$it->item_id)->first(); 

                                            $categories = unserialize($data->subcategory);

                                            $value = unserialize($data->value);                                            
                                        ?>
                                        <?php if($data->category==$arr['caid']): ?>
                                        <tr>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php $ctdata = DB::table('production_subcategories')->where('id',$ct)->first(); ?>

                                                <?php if($ctdata->type=='select'): ?>    
                                                        <?php $stdata = DB::table('production_subcategories')->where('id',$value[$key])->first(); ?>    
                                                   <?php $dataname = $stdata->name; ?>

                                                <?php else: ?>
                                                   <?php $dataname = $value[$key]; ?>
                                                <?php endif; ?>  

                                                    <td style="text-align: center;"><?php echo e($dataname); ?></td>


                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <td style="text-align: center;"><?php echo e($it->price); ?></td>

                                    </tr>
                                    <?php endif; ?>
                                        
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
        </table>
        <!-- <div class="centered" style="margin:30px 0 50px">
            <small><?php echo e(trans('file.Invoice Generated By')); ?> <?php echo e($general_setting->site_title); ?>.
            <?php echo e(trans('file.Developed By')); ?> LionCoders</strong></small>
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
