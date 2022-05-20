@extends('layout.main') @section('content')
@if(session()->has('message'))
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div> 
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif

<section>
    <div class="container-fluid">
    
            <a href="{{route('sales.create')}}" class="btn btn-info"><i class="fa fa-plus"></i> {{trans('file.Add Sale')}}</a>&nbsp;
            <a href="{{url('sales/sale_by_csv')}}" class="btn btn-primary"><i class="fa fa-file"></i> {{trans('file.Import Sale')}}</a>
        
    </div>
    <div class="table-responsive">
        <table id="sale-table" class="table table-striped sale-list" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.Date')}}</th>
                    <th>{{trans('file.reference')}}</th>
                    <th>{{trans('file.Biller')}}</th>
                    <th>{{trans('file.customer')}}</th>
                    <th>{{trans('file.Sale Status')}}</th>
                    <th>{{trans('file.Payment Status')}}</th>
                    <th>{{trans('file.grand total')}}</th>
                    <th>{{trans('file.Paid')}}</th>
                    <th>{{trans('file.Due')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>
            
            <tfoot class="tfoot active">
                <th></th>
                <th>{{trans('file.Total')}}</th>
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
                        <button id="print-btn" type="button" class="btn btn-default btn-sm d-print-none"><i class="fa fa-print"></i> {{trans('file.Print')}}</button>
                        
                        {{ Form::open(['route' => 'sale.sendmail', 'method' => 'post', 'class' => 'sendmail-form'] ) }}
                            <input type="hidden" name="sale_id">
                            <button class="btn btn-default btn-sm d-print-none"><i class="fa fa-envelope"></i> {{trans('file.Email')}}</button>
                        {{ Form::close() }}
                    </div>
                    <div class="col-md-6">
                        <h3 id="exampleModalLabel" class="modal-title text-center container-fluid">{{$general_setting->site_title}}</h3>
                    </div>
                    <div class="col-md-3">
                        <button type="button" id="close-btn" data-dismiss="modal" aria-label="Close" class="close d-print-none"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="col-md-12 text-center">
                        <i style="font-size: 15px;">{{trans('file.Sale Details')}}</i>
                    </div>
                </div>
            </div>
            <div id="sale-content" class="modal-body">
            </div>
            <br>
            <table class="table table-bordered product-sale-list">
                <thead>
                    <th>#</th>
                    <th>{{trans('file.product')}}</th>
                    <th>{{trans('file.Qty')}}</th>
                    <th>{{trans('file.Unit Price')}}</th>
                    <th>{{trans('file.Tax')}}</th>
                    <th>{{trans('file.Discount')}}</th>
                    <th>{{trans('file.Subtotal')}}</th>
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
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.All')}} {{trans('file.Payment')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover payment-list">
                    <thead>
                        <tr>
                            <th>{{trans('file.date')}}</th>
                            <th>{{trans('file.reference')}}</th>
                            <th>{{trans('file.Account')}}</th>
                            <th>{{trans('file.Amount')}}</th>
                            <th>{{trans('file.Paid By')}}</th>
                            <th>{{trans('file.action')}}</th>
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
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Payment')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'sale.add-payment', 'method' => 'post', 'files' => true, 'class' => 'payment-form' ]) !!}
                    <div class="row">
                        <input type="hidden" name="balance">
                        <div class="col-md-6">
                            <label><strong>{{trans('file.Recieved Amount')}} *</strong></label>
                            <input type="text" name="paying_amount" class="form-control numkey" step="any" required>
                        </div>
                        <div class="col-md-6">
                            <label><strong>{{trans('file.Paying Amount')}} *</strong></label>
                            <input type="text" id="amount" name="amount" class="form-control"  step="any" required>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label><strong>{{trans('file.Change')}} : </strong></label>
                            <p class="change ml-2">0.00</p>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label><strong>{{trans('file.Paid By')}}</strong></label>
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
                        <label><strong> {{trans('file.Gift Card')}} *</strong></label>
                        <select id="gift_card_id" name="gift_card_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Gift Card...">
                            @php 
                                $balance = [];
                                $expired_date = [];
                            @endphp
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
                            <label><strong>{{trans('file.Cheque Number')}} *</strong></label>
                            <input type="text" name="cheque_no" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong> {{trans('file.Account')}}</strong></label>
                        <select class="form-control selectpicker" name="account_id">
                      
                        </select>
                    </div>
                    <div class="form-group">
                        <label><strong>{{trans('file.Payment Note')}}</strong></label>
                        <textarea rows="3" class="form-control" name="payment_note"></textarea>
                    </div>

                    <input type="hidden" name="sale_id">

                    <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<div id="edit-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Update Payment')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'sale.update-payment', 'method' => 'post', 'class' => 'payment-form' ]) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <label><strong>{{trans('file.Recieved Amount')}} *</strong></label>
                            <input type="text" name="edit_paying_amount" class="form-control numkey"  step="any" required>
                        </div>
                        <div class="col-md-6">
                            <label><strong>{{trans('file.Paying Amount')}} *</strong></label>
                            <input type="text" name="edit_amount" class="form-control"  step="any" required>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label><strong>{{trans('file.Change')}} : </strong></label>
                            <p class="change ml-2">0.00</p>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label><strong>{{trans('file.Paid By')}}</strong></label>
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
                        <label><strong> {{trans('file.Gift Card')}} *</strong></label>
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
                            <label><strong>{{trans('file.Cheque Number')}} *</strong></label>
                            <input type="text" name="edit_cheque_no" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong> {{trans('file.Account')}}</strong></label>
                        <select class="form-control selectpicker" name="account_id">
                       
                        </select>
                    </div>
                    <div class="form-group">
                        <label><strong>{{trans('file.Payment Note')}}</strong></label>
                        <textarea rows="3" class="form-control" name="edit_payment_note"></textarea>
                    </div>

                    <input type="hidden" name="payment_id">

                    <button type="submit" class="btn btn-primary">{{trans('file.update')}}</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<div id="add-delivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Delivery')}}</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'delivery.store', 'method' => 'post', 'files' => true]) !!}
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><strong>{{trans('file.Delivery Reference')}}</strong></label>
                        <p id="dr"></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><strong>{{trans('file.Sale Reference')}}</strong></label>
                        <p id="sr"></p>
                    </div>
                    <div class="col-md-12 form-group">
                        <label><strong>{{trans('file.Status')}} *</strong></label>
                        <select name="status" required class="form-control selectpicker">
                            <option value="1">{{trans('file.Packing')}}</option>
                            <option value="2">{{trans('file.Delivering')}}</option>
                            <option value="3">{{trans('file.Delivered')}}</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2 form-group">
                        <label><strong>{{trans('file.Delivered By')}}</strong></label>
                        <input type="text" name="delivered_by" class="form-control">
                    </div>
                    <div class="col-md-6 mt-2 form-group">
                        <label><strong>{{trans('file.Recieved By')}} </strong></label>
                        <input type="text" name="recieved_by" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label><strong>{{trans('file.customer')}} *</strong></label>
                        <p id="customer"></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><strong>{{trans('file.Attach File')}}</strong></label>
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label><strong>{{trans('file.Address')}} *</strong></label>
                        <textarea rows="3" name="address" class="form-control" required></textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><strong>{{trans('file.Note')}}</strong></label>
                        <textarea rows="3" name="note" class="form-control"></textarea>
                    </div>
                </div>
                <input type="hidden" name="reference_no">
                <input type="hidden" name="sale_id">
                <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>

@endsection