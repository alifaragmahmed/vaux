@extends('layouts.app')
@section('title', __('product.add_new_product'))

@section('css')
    <style>
        .col-lg-4,
        .col-md-4,
        .col-sm-4 {
            min-height: 84px;
        }

        .tax-field {
            display: none
        }

        .add-product-price-table tr::first-line {
            background-color: white!important;
            color: black!important;
        }

        .more-info {
            display: none;
        }

        input[type=text], input[type=number] {
            background-color: #f1f5f8;
        }
    </style>
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('product.add_new_product')</h1> 
    </section>

    <!-- Main content -->
    <section class="content">
        @php
            $form_class = empty($duplicate_product) ? 'create' : '';
        @endphp

        <div class="w3-">
            {!! Form::open(['url' => action('ProductController@store'), 'method' => 'post', 'id' => 'product_add_form', 'class' => 'product_form form' . $form_class, 'files' => true, ]) !!}
            @component('components.widget', ['class' => 'box-primary w3-padding'])
                <div class="w3-padding">
                    <div class="row">
                        
                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                            <div class="form-group">
                                {!! Form::label('name', __('product.product_name') . ':*') !!}
                                {!! Form::text('name', !empty($duplicate_product->name) ? $duplicate_product->name : null, ['class' => 'form-control', 'required', 'placeholder' => __('product.product_name')]) !!}
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                            <div class="form-group">
                                {!! Form::label('sku', __('product.sku') . ':') !!} @show_tooltip(__('tooltip.sku'))
                                <div class="input-group"> 
                                    {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => __('product.sku')]) !!}
                                    <span class="input-group-btn" style="padding-left: 3px">
                                        <button type="button"   
                                            onclick="$('input[name=sku]').val(createSku($('.category-pr-' + $('select[name=category_id]').val()).val()))"
                                            class="btn btn-default add_select_btn  w3-round btn-modal new-theme" >
                                            <i class="fa fa-magic text-primary fa-lg w3-text-white"></i>
                                        </button>
                                    </span>
                                </div> 
                            </div>
                        </div>

                        @can_bt(['product.barcode_type'])
                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding hidden"> 
                            <div class="form-group">
                                {!! Form::label('barcode_type', __('product.barcode_type') . ':*') !!}
                                {!! Form::select('barcode_type', $barcode_types, !empty($duplicate_product->barcode_type) ? $duplicate_product->barcode_type : $barcode_default, ['class' => 'form-control select2', 'required']) !!}
                            </div>
                        </div>
                        @endcan_bt

                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                            <div class="form-group">
                                {!! Form::label('unit_id', __('product.unit') . ':*') !!}
                                <div class="input-group">
                                    {!! Form::select('unit_id', $units, !empty($duplicate_product->unit_id) ? $duplicate_product->unit_id : session('business.default_unit'), ['class' => 'form-control select2', 'required']) !!}
                                    <span class="input-group-btn" style="padding-left: 3px">
                                        <button type="button" @if (!auth()->user()->can('unit.create')) disabled @endif
                                            class="btn btn-default add_select_btn w3-round btn-modal new-theme"
                                            data-href="{{ action('UnitController@create', ['quick_add' => true]) }}"
                                            title="@lang('unit.add_unit')" data-container=".view_modal"><i
                                                class="fa fa-plus-circle text-primary fa-lg w3-text-white"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>


                        @can_bt(['product.sub_unit'])
                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                            <div class="form-group">
                                {!! Form::label('sub_unit_ids', __('lang_v1.related_sub_units') . ':') !!} @show_tooltip(__('lang_v1.sub_units_tooltip'))
                                {!! Form::select('sub_unit_ids[]', [], !empty($duplicate_product->sub_unit_ids) ? $duplicate_product->sub_unit_ids : null, ['class' => 'form-control select2', 'multiple', 'id' => 'sub_unit_ids']) !!}
                            </div>
                        </div>
                        @endcan_bt
 
                        @can_bt(['product.brand'])
                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                            <div class="form-group">
                                {!! Form::label('brand_id', __('product.brand') . ':') !!}
                                <div class="input-group">
                                    {!! Form::select('brand_id', $brands, !empty($duplicate_product->brand_id) ? $duplicate_product->brand_id : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']) !!}
                                    <span class="input-group-btn" style="padding-left: 3px">
                                        <button type="button" @if (!auth()->user()->can('brand.create')) disabled @endif
                                            class="btn add_select_btn w3-round btn-modal new-theme"
                                            data-href="{{ action('BrandController@create', ['quick_add' => true]) }}"
                                            title="@lang('brand.add_brand')" data-container=".view_modal"><i
                                                class="fa fa-plus-circle text-primary fa-lg w3-text-white"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endcan_bt
 
                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                            <div class="form-group">
                                @foreach($categories as $key => $value)
                                @php
                                    $item = App\Category::find($key);
                                @endphp
                                    <input type="hidden" class="category-pr-{{ $item->id }}" value="{{ $item->short_code }}"  >
                                @endforeach
                                {!! Form::label('category_id', __('product.category') . ':') !!}
                                {!! Form::select('category_id', $categories, !empty($duplicate_product->category_id) ? $duplicate_product->category_id : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']) !!}
                            </div>
                        </div>
                        
                        @can_bt(['product.sub_category'])
                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                            <div class="form-group">
                                {!! Form::label('sub_category_id', __('product.sub_category') . ':') !!}
                                {!! Form::select('sub_category_id', $sub_categories, !empty($duplicate_product->sub_category_id) ? $duplicate_product->sub_category_id : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']) !!}
                            </div>
                        </div>
                        @endcan_bt
                        

                        @php
                            $default_location = null;
                            if (count($business_locations) == 1) {
                                $default_location = array_key_first($business_locations->toArray());
                            }
                        @endphp
                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                            <div class="form-group">
                                {!! Form::label('product_locations', __('business.business_locations') . ':') !!} @show_tooltip(__('lang_v1.product_location_help'))
                                {!! Form::select('product_locations[]', $business_locations, $default_location, ['class' => 'form-control select2', 'multiple', 'id' => 'product_locations', 'required' => 'required']) !!}
                            </div>
                        </div>
 
                        
                        @can_bt(['product.warranty'])
                            <div class="col-lg-4 col-md-4 col-sm-4 w3-padding">
                                <div class="form-group">
                                    {!! Form::label('warranty_id', __('lang_v1.warranty') . ':') !!}
                                    {!! Form::select('warranty_id', $warranties, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]) !!}
                                </div>
                            </div>
                        @endcan_bt
 
                        <div class="col-lg-4 col-md-4 col-sm-4 w3-padding @if (!empty($duplicate_product) && $duplicate_product->enable_stock == 0) hide @endif"
                            style="display: none"
                            id="alert_quantity_div">
                            <div class="form-group">
                                {!! Form::label('alert_quantity', __('product.alert_quantity') . ':') !!} @show_tooltip(__('tooltip.alert_quantity'))
                                {!! Form::number('alert_quantity', !empty($duplicate_product->alert_quantity) ? $duplicate_product->alert_quantity : null, ['class' => 'form-control', 'placeholder' => __('product.alert_quantity'), 'min' => '0']) !!}
                            </div>
                        </div> 

                        <!-- include module fields -->
                        @if (!empty($pos_module_data))
                            @foreach ($pos_module_data as $key => $value)
                                @if (!empty($value['view_path']))
                                    @includeIf($value['view_path'], ['view_data' => $value['view_data']])
                                @endif
                            @endforeach
                        @endif

                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                            <div class="form-group">
                                {!! Form::label('image', __('lang_v1.product_image') . ':') !!}
                                {!! Form::file('image', ['id' => 'upload_image', 'accept' => 'image/*']) !!}
                                <small>
                                    <b>@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') /
                                        1000000)]) - </b>
                                    <b>@lang('lang_v1.aspect_ratio_should_be_1_1')</b>
                                </small>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                            <div class="form-group">
                                <br>
                                <label>
                                    {!! Form::checkbox('enable_stock', 1, !empty($duplicate_product) ? $duplicate_product->enable_stock : true, ['class' => 'input-icheck2', 'id' => 'enable_stock']) !!} <strong>@lang('product.manage_stock')</strong>
                                </label>@show_tooltip(__('tooltip.enable_stock')) <p class="help-block">
                                    <i>@lang('product.enable_stock_help')</i>
                                </p>
                            </div>
                        </div>
                        
                        @can_bt(['product.brochure'])
                        <div class="col-lg-4 col-md-4 col-sm-4 w3-padding">
                            <div class="form-group">
                                {!! Form::label('product_brochure', __('lang_v1.product_brochure') . ':') !!}
                                {!! Form::file('product_brochure', ['id' => 'product_brochure', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]) !!}
                                <small>
                                    <p class="help-block">
                                        @lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') /
                                        1000000)])
                                        @includeIf('components.document_help_text')
                                    </p>
                                </small>
                            </div>
                        </div>  
                        @endcan_bt

                        <div class="col-lg-12 col-md-12 col-sm-12 w3-padding">
                            <div class="form-group">
                                {!! Form::label('product_description', __('lang_v1.product_description') . ':') !!}
                                {!! Form::textarea('product_description', !empty($duplicate_product->product_description) ? $duplicate_product->product_description : null, ['class' => 'form-control']) !!}
                            </div>
                        </div>  

                </div>
            @endcomponent

            @component('components.widget', ['class' => 'box-primary w3-padding'])
                <div class="row">


                    <div class="w3-padding">
                        <div class="row">
                            <div class="col-md-6 @if (!session('business.enable_price_tax')) hide @endif">
                                <div class="form-group" style="" >
                                    {!! Form::label('tax_type', __('product.selling_price_tax_type') . ':*') !!}
                                    {!! Form::select('tax_type', ['inclusive' => __('product.inclusive'), 'exclusive' => __('product.exclusive')], !empty($duplicate_product->tax_type) ? $duplicate_product->tax_type : 'exclusive', ['class' => 'form-control select2', 'required', 'onchange' => 'this.value > 0? $(".tax-field").show() : $(".tax-field").hide()']) !!}
                                </div>
                            </div> 
          
                            <div class="col-md-6 tax- ">
                                <div class="form-group" style="" >
                                    {!! Form::label('type', __('product.product_type') . ':*') !!} @show_tooltip(__('tooltip.product_type'))
                                    {!! Form::select('type', $product_types, !empty($duplicate_product->type) ? $duplicate_product->type : null, ['class' => 'form-control select2', 'required', 'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add', 'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0']) !!}
                                </div>
                            </div> 
                        </div>
                    </div>
                    <br>

                    <div class="tax- form-group col-sm-12" id="product_form_part">
                        @include('product.partials.single_product_form_part', ['profit_percent' => $default_profit_percent])
                    </div>

                    <input type="hidden" id="variation_counter" value="1">
                    <input type="hidden" id="default_profit_percent" value="{{ $default_profit_percent }}">

                </div>
            @endcomponent 
            <div class="w3-padding" style="text-align: center;">
                <button class="btn w3-dark-gray" type="button" onclick="$('.more-info').slideToggle(400)" >more information</button>
                <hr>
            </div>

            @component('components.widget', ['class' => 'box-primary w3-padding more-info'])
                <div class="row">
                    @if (session('business.enable_product_expiry'))

                        @if (session('business.expiry_type') == 'add_expiry')
                            @php
                                $expiry_period = 12;
                                $hide = true;
                            @endphp
                        @else
                            @php
                                $expiry_period = null;
                                $hide = false;
                            @endphp
                        @endif
                        <div class="col-lg-4 col-md-4 col-sm-6 @if ($hide) hide @endif">
                            <div class="form-group">
                                <div class="multi-input">
                                    {!! Form::label('expiry_period', __('product.expires_in') . ':') !!}<br>
                                    {!! Form::text('expiry_period', !empty($duplicate_product->expiry_period) ? @num_format($duplicate_product->expiry_period) : $expiry_period, ['class' => 'form-control pull-left input_number', 'placeholder' => __('product.expiry_period'), 'style' => 'width:60%;']) !!}
                                    {!! Form::select('expiry_period_type', ['months' => __('product.months'), 'days' => __('product.days'), '' => __('product.not_applicable')], !empty($duplicate_product->expiry_period_type) ? $duplicate_product->expiry_period_type : 'months', ['class' => 'form-control select2 pull-left', 'style' => 'width:40%;', 'id' => 'expiry_period_type']) !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    @can_bt(['product.imei'])
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="form-group">
                            <br>
                            <label>
                                {!! Form::checkbox('enable_sr_no', 1, !empty($duplicate_product) ? $duplicate_product->enable_sr_no : false, ['class' => 'input-icheck2']) !!} <strong>@lang('lang_v1.enable_imei_or_sr_no')</strong>
                            </label> @show_tooltip(__('lang_v1.tooltip_sr_no'))
                        </div>
                    </div>
                    @endcan_bt
 
                        <!--
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="form-group">
                                <br>
                                <label>
                                    {!! Form::checkbox('not_for_selling', 1, !empty($duplicate_product) ? $duplicate_product->not_for_selling : false, ['class' => 'input-icheck2']) !!} <strong>@lang('lang_v1.not_for_selling')</strong>
                                </label> @show_tooltip(__('lang_v1.tooltip_not_for_selling'))
                            </div>
                        </div>
                    --> 

                    @can_bt(['product.woocommerce'])
                    @include('layouts.partials.module_form_part') 
                    @endcan_bt

                    <!-- Rack, Row & position number -->
                    @canaccessmodule('rack_row_position_details')
                    {{-- @if (session('business.enable_racks') || session('business.enable_row') || session('business.enable_position'))
                        <div class="col-md-12">
                            <h4>@lang('lang_v1.rack_details'):
                                @show_tooltip(__('lang_v1.tooltip_rack_details'))
                            </h4>
                        </div>
                        @foreach ($business_locations as $id => $location)
                            <div class="col-sm-3">
                                <div class="form-group">
                                    {!! Form::label('rack_' . $id, $location . ':') !!}

                                    @if (session('business.enable_racks'))
                                        {!! Form::text('product_racks[' . $id . '][rack]', !empty($rack_details[$id]['rack']) ? $rack_details[$id]['rack'] : null, ['class' => 'form-control', 'id' => 'rack_' . $id, 'placeholder' => __('lang_v1.rack')]) !!}
                                    @endif

                                    @if (session('business.enable_row'))
                                        {!! Form::text('product_racks[' . $id . '][row]', !empty($rack_details[$id]['row']) ? $rack_details[$id]['row'] : null, ['class' => 'form-control', 'placeholder' => __('lang_v1.row')]) !!}
                                    @endif

                                    @if (session('business.enable_position'))
                                        {!! Form::text('product_racks[' . $id . '][position]', !empty($rack_details[$id]['position']) ? $rack_details[$id]['position'] : null, ['class' => 'form-control', 'placeholder' => __('lang_v1.position')]) !!}
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif --}}
                    @endcanaccessmodule
                    @can_bt(['product.weight'])
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="form-group">
                            {!! Form::label('weight', __('lang_v1.weight') . ':') !!}
                            {!! Form::text('weight', !empty($duplicate_product->weight) ? $duplicate_product->weight : null, ['class' => 'form-control', 'placeholder' => __('lang_v1.weight')]) !!}
                        </div>
                    </div> 
                    @endcan_bt

                    @php
                        $custom_labels = json_decode(session('business.custom_labels'), true);

                        $product_custom_field1 = !empty($custom_labels['product']['custom_field_1']) ? $custom_labels['product']['custom_field_1'] : __('lang_v1.product_custom_field1');
                        $product_custom_field2 = !empty($custom_labels['product']['custom_field_2']) ? $custom_labels['product']['custom_field_2'] : __('lang_v1.product_custom_field2');
                        $product_custom_field3 = !empty($custom_labels['product']['custom_field_3']) ? $custom_labels['product']['custom_field_3'] : __('lang_v1.product_custom_field3');
                        $product_custom_field4 = !empty($custom_labels['product']['custom_field_4']) ? $custom_labels['product']['custom_field_4'] : __('lang_v1.product_custom_field4');
                    @endphp
                    <!--custom fields-->
                    <div class="clearfix"></div>
                    @if (!empty($custom_labels['product']['custom_field_1']))
                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('product_custom_field1', $product_custom_field1 . ':') !!}
                            {!! Form::text('product_custom_field1', !empty($duplicate_product->product_custom_field1) ? $duplicate_product->product_custom_field1 : null, ['class' => 'form-control', 'placeholder' => $product_custom_field1]) !!}
                        </div>
                    </div>
                    @endif

                    @if (!empty($custom_labels['product']['custom_field_2']))
                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('product_custom_field2', $product_custom_field2 . ':') !!}
                            {!! Form::text('product_custom_field2', !empty($duplicate_product->product_custom_field2) ? $duplicate_product->product_custom_field2 : null, ['class' => 'form-control', 'placeholder' => $product_custom_field2]) !!}
                        </div>
                    </div>
                    @endif

                    @if (!empty($custom_labels['product']['custom_field_3']))
                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('product_custom_field3', $product_custom_field3 . ':') !!}
                            {!! Form::text('product_custom_field3', !empty($duplicate_product->product_custom_field3) ? $duplicate_product->product_custom_field3 : null, ['class' => 'form-control', 'placeholder' => $product_custom_field3]) !!}
                        </div>
                    </div>
                    @endif


                    @if (!empty($custom_labels['product']['custom_field_4']))
                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('product_custom_field4', $product_custom_field4 . ':') !!}
                            {!! Form::text('product_custom_field4', !empty($duplicate_product->product_custom_field4) ? $duplicate_product->product_custom_field4 : null, ['class' => 'form-control', 'placeholder' => $product_custom_field4]) !!}
                        </div>
                    </div>
                    @endif

                    <div class="col-sm-3 @if (!session('business.enable_price_tax')) hide @endif">
                        <div class="form-group" style="max-width: 350px;margin: auto" >
                            {!! Form::label('tax', __('product.applicable_tax') . ':') !!}
                            {!! Form::select('tax', $taxes, !empty($duplicate_product->tax) ? $duplicate_product->tax : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2'], $tax_attributes) !!}
                        </div>
                    </div> 
                    <!--custom fields--> 
                    <!--custom fields--> 
                </div>
            @endcomponent


            <div class="row">
                <div class="col-sm-12">
                    <input type="hidden" name="submit_type" id="submit_type">
                    <div class="text-center">
                        <div class="btn-group">
                            <!--
                            @if ($selling_price_group_count)
                                <button type="submit" value="submit_n_add_selling_prices"
                                    class="btn btn-warning submit_product_form">@lang('lang_v1.save_n_add_selling_price_group_prices')</button>
                            @endif

                            @can('product.opening_stock')
                                <button id="opening_stock_button" @if (!empty($duplicate_product) && $duplicate_product->enable_stock == 0) disabled @endif type="submit" value="submit_n_add_opening_stock"
                                    class="btn bg-purple submit_product_form">@lang('lang_v1.save_n_add_opening_stock')</button>
                            @endcan

                            <button type="submit" value="save_n_add_another"
                                class="btn bg-maroon submit_product_form">@lang('lang_v1.save_n_add_another')</button>
                            -->

                            <button type="submit" value="submit"
                                class="btn btn-primary submit_product_form">@lang('messages.save')</button>
                        </div>

                    </div>
                </div>
            </div>
            {!! Form::close() !!}

        </div>

    </section>
    <!-- /.content -->

    @include("product.product_steps")
@endsection

@section('javascript')
    @php $asset_v = env('APP_VERSION'); @endphp
    <script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            __page_leave_confirmation('#product_add_form');
            onScan.attachTo(document, {
                suffixKeyCodes: [13], // enter-key expected at the end of a scan
                reactToPaste: true, // Compatibility to built-in scanners in paste-mode (as opposed to keyboard-mode)
                onScan: function(sCode, iQty) {
                    $('input#sku').val(sCode);
                },
                onScanError: function(oDebug) {
                    console.log(oDebug);
                },
                minLength: 2,
                ignoreIfFocusOn: ['input', '.form-control']
                // onKeyDetect: function(iKeyCode){ // output all potentially relevant key events - great for debugging!
                //     console.log('Pressed: ' + iKeyCode);
                // }
            });



            $('#enable_stock').iCheck('update', function() {
                if ($('#enable_stock').iCheck('check')) {
                    $('#alert_quantity_div').show();
                } else {
                    $('#alert_quantity_div').hide();
                }
            });

            $('select[name=repair_model_id]').parent().parent().addClass('w3-padding');

            $('.customcheck').parent()[0].className = "col-lg-4 col-md-4 col-sm-6 w3-padding";

            $('form').addClass('form');

            // convert form to ajax
            formAjax(false, function(r){
                var product = r.data;
                // add step1 content
                $.get("{{ url('/products/add-selling-prices') }}/"+product.id,function(res){
                    $('#step1').html(res);
                    //
                    formAjax(true, null, "#selling_price_form");
                });

                $.get("{{ url('/opening-stock/add') }}/"+product.id,function(res){
                    res = res.replace(/modal/g, '_modal');
                    $('#step2').html(res);
                    //
                    formAjax(true, null, "#add_opening_stock_form");
                });

                $('.product-steps').show();
                $('.first-nav').click();
            }, '#product_add_form');
        }); 

    </script>
@endsection