 

<!-- Content Header (Page header) -->
<section class="content-header hidden">
    <h1>@lang('expense.expenses')</h1>
</section>


<div class="page-title hidden">
    @lang('expense.expenses')
</div> 

<!-- Main content -->
<section class="content">

    <div class="text-right">
        <button class="add_btn" onclick="$('.filter').slideToggle(500)" >
            <i class="fa fa-filter"></i> {{ __('report.filters') }}
        </button>
    </div>
    <br>
    <div class="filter w3-round w3-white w3-padding" style="display: none" >
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('location_id',  __('purchase.business_location') . ':') !!}
                    {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('expense_for', __('expense.expense_for').':') !!}
                    {!! Form::select('expense_for', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('expense_contact_filter',  __('contact.contact') . ':') !!}
                    {!! Form::select('expense_contact_filter', $contacts, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('expense_category_id',__('expense.expense_category').':') !!}
                    {!! Form::select('expense_category_id', $categories, null, ['placeholder' =>
                    __('report.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'expense_category_id']); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('expense_date_range', __('report.date_range') . ':') !!}
                    {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'expense_date_range', 'readonly']); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('expense_payment_status',  __('purchase.payment_status') . ':') !!}
                    {!! Form::select('expense_payment_status', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
                </div>
            </div>
        </div>
    </div> 
    <br>
 
    <div class=""> 
                 @can('expense.access') 
                        <div class="w3-display-topright">
                            <a class="add_btn" href="{{action('ExpenseController@create')}}">
                            <i class="fa fa-plus"></i> @lang('messages.add')</a>
                        </div>
                        <br> 
                        <br> 
                        <br> 
                @endcan
                <div class="table-responsive w3-light-gray">
                    <table data-title="{{ __('expense.all_expenses') }}" class="table table-bordered table-striped" id="expense_table">
                        <thead>
                            <tr>
                                <th>@lang('messages.action')</th>
                                <th>@lang('messages.date')</th>
                                <th>@lang('purchase.ref_no')</th>
                                <th>@lang('lang_v1.recur_details')</th>
                                <th>@lang('expense.expense_category')</th>
                                <th>@lang('business.location')</th>
                                <th>@lang('sale.payment_status')</th>
                                <th>@lang('product.tax')</th>
                                <th>@lang('sale.total_amount')</th>
                                <th>@lang('purchase.payment_due')
                                <th>@lang('expense.expense_for')</th>
                                <th>@lang('contact.contact')</th>
                                <th>@lang('expense.expense_note')</th>
                                <th>@lang('lang_v1.added_by')</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-gray font-17 text-center footer-total">
                                <td colspan="6"><strong>@lang('sale.total'):</strong></td>
                                <td id="footer_payment_status_count"></td>
                                <td></td>
                                <td><span class="display_currency" id="footer_expense_total" data-currency_symbol ="true"></span></td>
                                <td><span class="display_currency" id="footer_total_due" data-currency_symbol ="true"></span></td>
                                <td colspan="4"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div> 
    </div>

</section>
<!-- /.content -->
<!-- /.content -->
<div class="modal fade payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div> 
 <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script> 
