 <?php $__env->startSection('content'); ?>
<?php if(session()->has('message')): ?>
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo session()->get('message'); ?></div> 
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>

<section>
    <div class="container-fluid">
    
            <a href="<?php echo e(route('sales.create')); ?>" class="btn btn-info"><i class="fa fa-plus"></i> <?php echo e(trans('file.Add Sale')); ?></a>&nbsp;
            <a href="<?php echo e(url('sales/sale_by_csv')); ?>" class="btn btn-primary"><i class="fa fa-file"></i> <?php echo e(trans('file.Import Sale')); ?></a>
        
    </div>
    <div class="table-responsive">
        <table id="sale-table" class="table table-striped sale-list" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th><?php echo e(trans('file.Date')); ?></th>
                    <th><?php echo e(trans('file.reference')); ?></th>
                    <th><?php echo e(trans('file.Biller')); ?></th>
                    <th><?php echo e(trans('file.customer')); ?></th>
                    <th><?php echo e(trans('file.Sale Status')); ?></th>
                    <th><?php echo e(trans('file.Payment Status')); ?></th>
                    <th><?php echo e(trans('file.grand total')); ?></th>
                    <th><?php echo e(trans('file.Paid')); ?></th>
                    <th><?php echo e(trans('file.Due')); ?></th>
                    <th class="not-exported"><?php echo e(trans('file.action')); ?></th>
                </tr>
            </thead>
            
            <tfoot class="tfoot active">
                <th></th>
                <th><?php echo e(trans('file.Total')); ?></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tfoot>
        </table>
    </div>
</section>

<div id="sale-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="container mt-3 pb-2 border-bottom">
                <div class="row">
                    <div class="col-md-3">
                        <button id="print-btn" type="button" class="btn btn-default btn-sm d-print-none"><i class="fa fa-print"></i> <?php echo e(trans('file.Print')); ?></button>
                        
                        <?php echo e(Form::open(['route' => 'sale.sendmail', 'method' => 'post', 'class' => 'sendmail-form'] )); ?>

                            <input type="hidden" name="sale_id">
                            <button class="btn btn-default btn-sm d-print-none"><i class="fa fa-envelope"></i> <?php echo e(trans('file.Email')); ?></button>
                        <?php echo e(Form::close()); ?>

                    </div>
                    <div class="col-md-6">
                        <h3 id="exampleModalLabel" class="modal-title text-center container-fluid"><?php echo e($general_setting->site_title); ?></h3>
                    </div>
                    <div class="col-md-3">
                        <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close d-print-none"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="col-md-12 text-center">
                        <i style="font-size: 15px;"><?php echo e(trans('file.Sale Details')); ?></i>
                    </div>
                </div>
            </div>
            <div id="sale-content" class="modal-body">
            </div>
            <br>
            <table class="table table-bordered product-sale-list">
                <thead>
                    <th>#</th>
                    <th><?php echo e(trans('file.product')); ?></th>
                    <th><?php echo e(trans('file.Qty')); ?></th>
                    <th><?php echo e(trans('file.Unit Price')); ?></th>
                    <th><?php echo e(trans('file.Tax')); ?></th>
                    <th><?php echo e(trans('file.Discount')); ?></th>
                    <th><?php echo e(trans('file.Subtotal')); ?></th>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div id="sale-footer" class="modal-body"></div>
        </div>
    </div>
</div>

<div id="view-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.All')); ?> <?php echo e(trans('file.Payment')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover payment-list">
                    <thead>
                        <tr>
                            <th><?php echo e(trans('file.date')); ?></th>
                            <th><?php echo e(trans('file.reference')); ?></th>
                            <th><?php echo e(trans('file.Account')); ?></th>
                            <th><?php echo e(trans('file.Amount')); ?></th>
                            <th><?php echo e(trans('file.Paid By')); ?></th>
                            <th><?php echo e(trans('file.action')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="add-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Payment')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <?php echo Form::open(['route' => 'sale.add-payment', 'method' => 'post', 'files' => true, 'class' => 'payment-form' ]); ?>

                    <div class="row">
                        <input type="hidden" name="balance">
                        <div class="col-md-6">
                            <label><strong><?php echo e(trans('file.Recieved Amount')); ?> *</strong></label>
                            <input type="text" name="paying_amount" class="form-control numkey" step="any" required>
                        </div>
                        <div class="col-md-6">
                            <label><strong><?php echo e(trans('file.Paying Amount')); ?> *</strong></label>
                            <input type="text" id="amount" name="amount" class="form-control"  step="any" required>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label><strong><?php echo e(trans('file.Change')); ?> : </strong></label>
                            <p class="change ml-2">0.00</p>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label><strong><?php echo e(trans('file.Paid By')); ?></strong></label>
                            <select name="paid_by_id" class="form-control">
                                <option value="1">Cash</option>
                                <option value="2">Gift Card</option>
                                <option value="3">Credit Card</option>
                                <option value="4">Cheque</option>
                                <option value="5">Paypal</option>
                                <option value="6">Deposit</option>
                            </select>
                        </div>
                    </div>
                    <div class="gift-card form-group">
                        <label><strong> <?php echo e(trans('file.Gift Card')); ?> *</strong></label>
                        <select id="gift_card_id" name="gift_card_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Gift Card...">
                            <?php 
                                $balance = [];
                                $expired_date = [];
                            ?>
                           <!--  -->
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <div class="card-element" class="form-control">
                        </div>
                        <div class="card-errors" role="alert"></div>
                    </div>
                    <div id="cheque">
                        <div class="form-group">
                            <label><strong><?php echo e(trans('file.Cheque Number')); ?> *</strong></label>
                            <input type="text" name="cheque_no" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong> <?php echo e(trans('file.Account')); ?></strong></label>
                        <select class="form-control selectpicker" name="account_id">
                      
                        </select>
                    </div>
                    <div class="form-group">
                        <label><strong><?php echo e(trans('file.Payment Note')); ?></strong></label>
                        <textarea rows="3" class="form-control" name="payment_note"></textarea>
                    </div>

                    <input type="hidden" name="sale_id">

                    <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>

<div id="edit-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Update Payment')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <?php echo Form::open(['route' => 'sale.update-payment', 'method' => 'post', 'class' => 'payment-form' ]); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <label><strong><?php echo e(trans('file.Recieved Amount')); ?> *</strong></label>
                            <input type="text" name="edit_paying_amount" class="form-control numkey"  step="any" required>
                        </div>
                        <div class="col-md-6">
                            <label><strong><?php echo e(trans('file.Paying Amount')); ?> *</strong></label>
                            <input type="text" name="edit_amount" class="form-control"  step="any" required>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label><strong><?php echo e(trans('file.Change')); ?> : </strong></label>
                            <p class="change ml-2">0.00</p>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label><strong><?php echo e(trans('file.Paid By')); ?></strong></label>
                            <select name="edit_paid_by_id" class="form-control selectpicker">
                                <option value="1">Cash</option>
                                <option value="2">Gift Card</option>
                                <option value="3">Credit Card</option>
                                <option value="4">Cheque</option>
                                <option value="5">Paypal</option>
                                <option value="6">Deposit</option>
                            </select>
                        </div>
                    </div>
                    <div class="gift-card form-group">
                        <label><strong> <?php echo e(trans('file.Gift Card')); ?> *</strong></label>
                        <select id="gift_card_id" name="gift_card_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Gift Card...">
                      
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <div class="card-element" class="form-control">
                        </div>
                        <div class="card-errors" role="alert"></div>
                    </div>
                    <div id="edit-cheque">
                        <div class="form-group">
                            <label><strong><?php echo e(trans('file.Cheque Number')); ?> *</strong></label>
                            <input type="text" name="edit_cheque_no" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong> <?php echo e(trans('file.Account')); ?></strong></label>
                        <select class="form-control selectpicker" name="account_id">
                       
                        </select>
                    </div>
                    <div class="form-group">
                        <label><strong><?php echo e(trans('file.Payment Note')); ?></strong></label>
                        <textarea rows="3" class="form-control" name="edit_payment_note"></textarea>
                    </div>

                    <input type="hidden" name="payment_id">

                    <button type="submit" class="btn btn-primary"><?php echo e(trans('file.update')); ?></button>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>

<div id="add-delivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(trans('file.Add Delivery')); ?></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <?php echo Form::open(['route' => 'delivery.store', 'method' => 'post', 'files' => true]); ?>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><strong><?php echo e(trans('file.Delivery Reference')); ?></strong></label>
                        <p id="dr"></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><strong><?php echo e(trans('file.Sale Reference')); ?></strong></label>
                        <p id="sr"></p>
                    </div>
                    <div class="col-md-12 form-group">
                        <label><strong><?php echo e(trans('file.Status')); ?> *</strong></label>
                        <select name="status" required class="form-control selectpicker">
                            <option value="1"><?php echo e(trans('file.Packing')); ?></option>
                            <option value="2"><?php echo e(trans('file.Delivering')); ?></option>
                            <option value="3"><?php echo e(trans('file.Delivered')); ?></option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2 form-group">
                        <label><strong><?php echo e(trans('file.Delivered By')); ?></strong></label>
                        <input type="text" name="delivered_by" class="form-control">
                    </div>
                    <div class="col-md-6 mt-2 form-group">
                        <label><strong><?php echo e(trans('file.Recieved By')); ?> </strong></label>
                        <input type="text" name="recieved_by" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label><strong><?php echo e(trans('file.customer')); ?> *</strong></label>
                        <p id="customer"></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><strong><?php echo e(trans('file.Attach File')); ?></strong></label>
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label><strong><?php echo e(trans('file.Address')); ?> *</strong></label>
                        <textarea rows="3" name="address" class="form-control" required></textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><strong><?php echo e(trans('file.Note')); ?></strong></label>
                        <textarea rows="3" name="note" class="form-control"></textarea>
                    </div>
                </div>
                <input type="hidden" name="reference_no">
                <input type="hidden" name="sale_id">
                <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>