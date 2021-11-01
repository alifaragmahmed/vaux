@extends('layouts.app')
@section('title', __('lang_v1.edit_purchase_return'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
<br>
    <h1>@lang('lang_v1.edit_purchase_return')</h1>
</section>

<!-- Main content -->
<section class="content no-print">
	{!! Form::open(['url' => action('CombinedPurchaseReturnController@update'), 'method' => 'post', 'id' => 'purchase_return_form', 'files' => true ]) !!}
	<div class="box box-solid w3-padding">
		<div class="box-body">
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<input type="hidden" name="purchase_return_id" value="{{$purchase_return->id}}">
						<input type="hidden" id="location_id" value="{{$purchase_return->location_id}}">
						{!! Form::label('supplier_id', __('purchase.supplier') . ':*') !!}
						<div class="input-"> 
							{!! Form::select('contact_id', [ $purchase_return->contact_id => $purchase_return->contact->name], $purchase_return->contact_id, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'supplier_id']); !!}
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						{!! Form::label('ref_no', __('purchase.ref_no').':') !!}
						{!! Form::text('ref_no', $purchase_return->ref_no, ['class' => 'form-control']); !!}
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						{!! Form::label('transaction_date', __('messages.date') . ':*') !!}
						<div class="input-"> 
							{!! Form::text('transaction_date', @format_datetime($purchase_return->transaction_date), ['class' => 'form-control', 'readonly', 'required']); !!}
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
	                <div class="form-group">
	                    {!! Form::label('document', __('purchase.attach_document') . ':') !!}
	                    {!! Form::file('document', ['id' => 'upload_document', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); !!}
	                    <p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])
	                    @includeIf('components.document_help_text')</p>
	                </div>
	            </div>
			</div>
		</div>
	</div> <!--box end-->
	<div class="box box-solid w3-padding">
		<div class="box-header">
        	<div class="w3-xlarge text-center">{{ __('stock_adjustment.search_products') }}</div>
       	</div>
		<div class="box-body">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-6">
					<div class="form-group">
						<div class="input-">
							<span class="input-group-addon hidden">
								<i class="fa fa-search"></i>
							</span>
							{!! Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product_for_purchase_return', 'placeholder' => __('stock_adjustment.search_products')]); !!}
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<input type="hidden" id="product_row_index" value="{{$row_index}}">
					<div class="form-group">
						{!! Form::label('tax_id', __('purchase.purchase_tax') . ':') !!}
						<select name="tax_id" id="tax_id" class="form-control select2" placeholder="'Please Select'">
							<option value="" data-tax_amount="0" data-tax_type="fixed" selected>@lang('lang_v1.none')</option>
							@foreach($taxes as $tax)
								<option value="{{ $tax->id }}" data-tax_amount="{{ $tax->amount }}" data-tax_type="{{ $tax->calculation_type }}" @if($purchase_return->tax_id == $tax->id) selected @endif>{{ $tax->name }}</option>
							@endforeach
						</select>
						{!! Form::hidden('tax_amount', $purchase_return->tax_amount, ['id' => 'tax_amount']); !!}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<input type="hidden" id="total_amount" name="final_total" value="{{$purchase_return->final_total}}">
					<div class="table-responsive">
					<table class="table table-bordered table-striped table-condensed" 
					id="purchase_return_product_table">
						<thead>
							<tr>
								<th class="text-center">	
									@lang('sale.product')
								</th>
								@if(session('business.enable_lot_number'))
									<th>
										@lang('lang_v1.lot_number')
									</th>
								@endif
								@if(session('business.enable_product_expiry'))
									<th>
										@lang('product.exp_date')
									</th>
								@endif
								<th class="text-center">
									@lang('sale.qty')
								</th>
								<th class="text-center">
									@lang('sale.unit_price')
								</th>
								<th class="text-center">
									@lang('sale.subtotal')
								</th>
								<th class="text-center"><i class="fa fa-trash" aria-hidden="true"></i></th>
							</tr>
						</thead>
						<tbody>
							@foreach($purchase_lines as $purchase_line)
								@include('purchase_return.partials.product_table_row', ['product' => $purchase_line, 'row_index' => $loop->index, 'edit' => true])

								@php
									$row_index = $loop->iteration;
								@endphp
							@endforeach
						</tbody>
					</table>
					</div>
				</div>  
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="text-center"><b>@lang('stock_adjustment.total_amount'):</b> <span id="total_return" class="display_currency">{{$purchase_return->final_total}}</span></div>
				</div>
			</div>
		</div>
	</div> <!--box end-->
	<div class="">
		<div class="text-center">
			<button type="button" id="submit_purchase_return_form" style="float: none" class="add_btn">@lang('messages.update')</button>
		</div>
	</div>
	{!! Form::close() !!}
</section>
@stop
@section('javascript')
	<script src="{{ asset('js/purchase_return.js?v=' . $asset_v) }}"></script>
	<script type="text/javascript">
		__page_leave_confirmation('#purchase_return_form');
	</script>
@endsection