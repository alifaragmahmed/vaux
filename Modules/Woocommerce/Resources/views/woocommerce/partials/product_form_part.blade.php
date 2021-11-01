<div class="col-md-4 col-12">
    @php
    $is_disabled = !empty($product->woocommerce_disable_sync) ? true : false;
    if(empty($product) && !empty($duplicate_product->woocommerce_disable_sync)){
    $is_disabled = true;
    }
    @endphp
    <label class="customcheck">
        <a href="#"></a>
        {!! Form::checkbox('woocommerce_disable_sync', 1, $is_disabled, ['class' => 'input-icheck']); !!}
        <input type="hidden" name="woocommerce_disable_sync" value="0">
        <span class="checkmark"></span>
        <span class="fas fa-info-circle" data-toggle="tooltip"
            data-original-title="@lang('woocommerce::lang.woocommerce_disable_sync_help')"></span>
        <strong>@lang('woocommerce::lang.woocommerce_disable_sync')</strong>
        
    </label>
</div>
