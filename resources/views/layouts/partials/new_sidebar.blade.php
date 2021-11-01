@php
$enabled_modules = !empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];
@endphp
@php($moduleUtil = new \App\Utils\ModuleUtil())

<div class="mobile-sidebar new-shadow " >
    
</div>

<aside class="main-sidebar ">

    <section class="sidebar">

        <div class="logo w3-block" style="display: block!important">
            <img src="{{ asset('/images/logo.png') }}" alt="">
            
            <div class="w3-padding w3-tiny" id="nav-icon3">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="text-left w3-text-white w3-padding btn" id="mobileToggle" >
                <i class="fas fa fa-bars w3-large  "></i>
            </div>
        </div>

        <!--Sidebar Menu-->

        <ul class="sidebar-menu tree w3-animate-left" data-widget="tree">
            @can('superadmin')
            <li class="">
                <a class="sidemen-item-a" href="/superadmin">
                    <img class="fa sidebar-img" src="{{ asset('/images/menu/superadmin.png') }}" alt="">
                    <span>{{ __('superadmin') }}</span>
                </a>
            </li>
            @endcan
            <li class="">
                <a class="sidemen-item-a" href="{{ action('HomeController@index') }}">
                    <img class="fa sidebar-img" src="{{ asset('/images/menu/1.svg') }}" alt="">
                    <span>{{ __('home.home') }}</span>
                </a>
            </li>
            @can_bt(["export_to_file"])
            <li class="">
                <a href="#" class="sidemen-item-a" data-toggle="modal" data-target="#exportModel">
                    <img class="fa sidebar-img" src="{{ asset('/images/menu/import.svg') }}" alt="">
                    <span>{{ __('messages.exports') }}</span>
                </a>
            </li>
            @endcan_bt
            @can_bt(["import_from_file"])
            <li class="">
                <a href="#" class="sidemen-item-a" data-toggle="modal" data-target="#importModel">
                    <img class="fa sidebar-img" src="{{ asset('/images/menu/import.svg') }}" alt="">
                    <span>{{ __('messages.imports') }}</span>
                </a>
            </li>
            @endcan_bt

            @if (auth()->user()->can('supplier.view') ||
    auth()->user()->can('customer.view'))
                <li class="treeview" id="tour_step4">
                    <a class="sidemen-item-a" href="#">
                        <img class="fa sidebar-img" src="{{ asset('/images/menu/3.svg') }}" alt="">
                        <span>Contacts</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if (auth()->user()->can('supplier.view'))
                            <li>
                                <a href="{{ action('ContactController@index', ['type' => 'supplier']) }}"><i
                                        class="fa fas fa-star"></i>
                                    <span>{{ __('report.supplier') }}</span>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->can('customer.view'))
                            <li>
                                <a href="{{ action('ContactController@index', ['type' => 'customer']) }}"><i
                                        class="fa fas fa-star"></i>
                                    <span>{{ __('report.customer') }}</span>
                                </a>
                            </li>

                            @can_bt(["customer_group"])
                            <li>
                                <a href="{{ action('CustomerGroupController@index') }}"><i
                                        class="fa fas fa-users"></i>
                                    <span>{{ __('lang_v1.customer_groups') }}</span>
                                </a>
                            </li>
                            @endcan_bt
                        @endif
                    </ul>
                </li>
            @endif

            @if (auth()->user()->can_access_custom('products_main', 'empty'))
                @if (auth()->user()->can('product.view') ||
    auth()->user()->can('product.create'))
                    <li class="treeview" id="tour_step5">
                        <a class="sidemen-item-a" href="#">
                            <img class="fa sidebar-img" src="{{ asset('/images/menu/4.svg') }}" alt="">
                            <span>Products</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @if (auth()->user()->can('product.view'))
                                <li>
                                    <a href="{{ action('ProductController@index') }}"><i class="fa fas fa-list"></i>
                                        <span>
                                            {{ __('lang_v1.list_products') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->can('product.create'))
                                <li>
                                    <a href="{{ action('ProductController@create') }}"><i
                                            class="fa fas fa-plus-circle"></i>
                                        <span>
                                            {{ __('product.add_product') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
            @endif

            
            @can_bt(["shipping"])
            <li class="treeview" id="tour_step5">
                <a class="sidemen-item-a" href="#">
                    <img class="fa sidebar-img" src="{{ asset('/images/menu/7.svg') }}" alt="">
                    <span>{{__('shipping.shippings')}}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ action('ShippingCompanyController@index') }}"><i class="fa fas fa-truck"></i>
                            <span>
                                @lang('shipping.list_shipping_companies')</span>
                        </a>
                    </li>
                    @if (auth()->user()->can('access_shipping') &&
    auth()->user()->can_access_custom('sells_shipments'))
                        <li>
                            <a href="{{ action('SellController@shipments') }}"><i class="fa fas fa-truck"></i>
                                <span>{{ __('lang_v1.shipments') }}</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            @endcan_bt
            {{-- @if ($moduleUtil->hasThePermissionInSubscription(request()->session()->get('business.id'), 'manufacturing_module',)) --}}
            
            @can_bt(["manufacturing"])
                <li>
                    <a class="sidemen-item-a"
                        href="{{ action('\Modules\Manufacturing\Http\Controllers\RecipeController@index') }}"
                        style="">
                        <img class="fa sidebar-img" src="{{ asset('/images/menu/5.svg') }}" alt="">
                        <span>Manufacturing</span>
                    </a>
                </li> 
            @endcan_bt
            {{-- <li>
                <a class="sidemen-item-a" href="{{ url('/') }}/repair/dashboard" style="background-color:">
                    <img class="fa sidebar-img" src="{{ asset('/images/menu/6.svg') }}" alt="">
                    <span>Repair</span>
                </a>
            </li> --}}

            @if (auth()->user()->can_access_custom('purchases_main', 'empty'))
                @if (in_array('purchases', $enabled_modules) &&
    (auth()->user()->can('purchase.view') ||
        auth()->user()->can('purchase.create') ||
        auth()->user()->can('purchase.update')))
                    <li class="treeview" id="tour_step6">
                        <a class="sidemen-item-a" href="#">
                            <img class="fa sidebar-img" src="{{ asset('/images/menu/7.svg') }}" alt="">
                            <span>{{ __('purchase.purchases') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @if ((auth()->user()->can('purchase.view') ||
        auth()->user()->can('view_own_purchase')) &&
    auth()->user()->can_access_custom('purchases_list'))
                                <li>
                                    <a href="{{ action('PurchaseController@index') }}"><i class="fa fas fa-list"></i>
                                        <span>{{ __('purchase.list_purchase') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->can('purchase.create') &&
    auth()->user()->can_access_custom('purchases_add'))
                                <li>
                                    <a href="{{ action('PurchaseController@create') }}"><i
                                            class="fa fas fa-plus-circle"></i>
                                        <span>{{ __('purchase.add_purchase') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->can('purchase.update') && auth()->user()->can_access_custom('purchases_return'))
                                <li>
                                    <a href="{{ action('PurchaseReturnController@index') }}"><i
                                            class="fa fas fa-undo"></i>
                                        <span>{{ __('lang_v1.list_purchase_return') }}</span>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif
            @endif

            @if (auth()->user()->can_access_custom('sells_main', 'empty'))
                @if (auth()->user()->can('sell.view') ||
    auth()->user()->can('sell.create') ||
    auth()->user()->can('direct_sell.access') ||
    auth()->user()->can('view_own_sell_only') ||
    auth()->user()->can('access_sell_return'))
                    <li class="treeview" id="tour_step7">
                        <a class="sidemen-item-a" href="#">
                            <img class="fa sidebar-img" src="{{ asset('/images/menu/8.svg') }}" alt="">
                            <span>{{ __('sale.sale') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @if ((auth()->user()->can('direct_sell.access') ||
        auth()->user()->can('view_own_sell_only')) &&
    auth()->user()->can_access_custom('sells_all_sales'))
                                <li>
                                    <a href="{{ action('SellController@index') }}">
                                        <i class="fa fas fa-list"></i> <span>{{ __('lang_v1.all_sales') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (in_array('add_sale', $enabled_modules) &&
    auth()->user()->can('direct_sell.access') &&
    auth()->user()->can_access_custom('sells_add_sale'))
                                <li>
                                    <a href="{{ action('SellController@create') }}"><i
                                            class="fa fas fa-plus-circle"></i>
                                        <span>{{ __('sale.add_sale') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->can('sell.view') &&
    auth()->user()->can_access_custom('sells_pos_list'))
                                <li>
                                    <a href="{{ action('SellPosController@index') }}"><i class="fa fas fa-list"></i>
                                        <span>{{ __('sale.list_pos') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->can('sell.create') &&
    auth()->user()->can_access_custom('sells_pos_create'))
                                @if (in_array('pos_sale', $enabled_modules))
                                    <li>
                                        <a href="{{ action('SellPosController@create') }}"><i
                                                class="fa fas fa-plus-circle"></i>
                                            <span>{{ __('sale.pos_sale') }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endif

                            @if (auth()->user()->can('list_drafts') &&
    auth()->user()->can_access_custom('sells_list_drafts'))
                                <li>
                                    <a href="{{ action('SellController@getDrafts') }}"><i
                                            class="fa fas fa-pen-square"></i>
                                        <span>{{ __('lang_v1.list_drafts') }}</span></a>
                                </li>
                            @endif

                            @if (in_array('add_sale', $enabled_modules) &&
    auth()->user()->can('direct_sell.access') &&
    auth()->user()->can_access_custom('sells_add_quotation'))
                                <li>
                                    <a href="{{ action('SellController@create', ['status' => 'quotation']) }}"><i
                                            class="fa fas fa-plus-circle"></i>
                                        <span>{{ __('lang_v1.add_quotation') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->can('list_quotations') &&
    auth()->user()->can_access_custom('sells_list_quotations'))
                                <li>
                                    <a href="{{ action('SellController@getQuotations') }}"><i
                                            class="fa fas fa-pen-square"></i>
                                        <span>{{ __('lang_v1.list_quotations') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->can('access_sell_return') &&
    auth()->user()->can_access_custom('sells_list_sell_return'))
                                <li>
                                    <a href="{{ action('SellReturnController@index') }}"><i
                                            class="fa fas fa-undo"></i>
                                        <span>{{ __('lang_v1.list_sell_return') }}</span>
                                    </a>
                                </li>
                            @endif 

                            @can_bt(['subscription'])
                            @if (in_array('subscription', $enabled_modules) &&
    auth()->user()->can('direct_sell.access') &&
    auth()->user()->can_access_custom('sells_subscrptions'))
                                <li>
                                    <a href="{{ action('SellPosController@listSubscriptions') }}"><i
                                            class="fa fas fa-recycle"></i>
                                        <span>{{ __('lang_v1.subscriptions') }}</span>
                                    </a>
                                </li>
                            @endif
                            @endcan_bt

                        </ul>
                    </li>
                @endif
            @endif


            @if (auth()->user()->can('account.access') &&
    in_array('account', $enabled_modules))
                <li class="treeview">
                    <a class="sidemen-item-a" href="#">
                        <img class="fa sidebar-img" src="{{ asset('/images/menu/8.svg') }}" alt="">
                        <span>{{ __('lang_v1.payment_accounts') }}</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ action('AccountController@index') }}"><i class="fa fas fa-list"></i>
                                <span>{{ __('account.list_accounts') }}</span>
                            </a>
                        </li>
                        @can_bt(['balance_sheet'])
                        <li>
                            <a href="{{ action('AccountReportsController@balanceSheet') }}"><i
                                    class="fa fas fa-list"></i>
                                <span>{{ __('account.balance_sheet') }}</span>
                            </a>
                        </li>
                        @endcan_bt
                        @can_bt(['trial_balance'])
                        <li>
                            <a href="{{ action('AccountReportsController@trialBalance') }}"><i
                                    class="fa fas fa-list"></i>
                                <span>{{ __('account.trial_balance') }}</span>
                            </a>
                        </li>
                        @endcan_bt
                        @can_bt(['cash_flow'])
                        <li>
                            <a href="{{ action('AccountController@cashFlow') }}"><i class="fa fas fa-list"></i>
                                <span>{{ __('lang_v1.cash_flow') }}</span>
                            </a>
                        </li>
                        @endcan_bt
                        @can_bt(['payment_account_report'])
                        <li>
                            <a href="{{ action('AccountReportsController@paymentAccountReport') }}"><i
                                    class="fa fas fa-list"></i>
                                <span>{{ __('account.payment_account_report') }}</span>
                            </a>
                        </li>
                        @endcan_bt

                    </ul>
                </li>
            @endif


            @can_bt(['stock_transfers'])
            @if (canAccessModule('stock_transfers'))
                @if (in_array('stock_transfers', $enabled_modules) &&
    (auth()->user()->can('purchase.view') ||
        auth()->user()->can('purchase.create')))
                    <li class="treeview">
                        <a class="sidemen-item-a" href="#">
                            <img class="fa sidebar-img" src="{{ asset('/images/menu/9.svg') }}" alt="">
                            <span>{{ __('lang_v1.stock_transfers') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @if (auth()->user()->can('purchase.view'))
                                <li>
                                    <a href="{{ url('/') }}/stock-transfers"><i class="fa fas fa-list"></i>
                                        <span> {{ __('lang_v1.list_stock_transfers') }} </span>
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->can('purchase.create'))
                                <li>
                                    <a href="{{ url('/') }}/stock-transfers/create"><i
                                            class="fa fas fa-plus-circle"></i>
                                        <span>{{ __('lang_v1.add_stock_transfer') }}</span>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif
            @endif
            @endcan_bt


            @can_bt(['stock_adujstments'])
            @if (canAccessModule('stock_adujstments'))
                @if (in_array('stock_adjustment', $enabled_modules) &&
    (auth()->user()->can('purchase.view') ||
        auth()->user()->can('purchase.create')))
                    <li class="treeview">
                        <a class="sidemen-item-a" href="#">
                            <img class="fa sidebar-img" src="{{ asset('/images/menu/10.svg') }}" alt="">
                            <span>{{ __('stock_adjustment.stock_adjustment') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @if (auth()->user()->can('purchase.view'))
                                <li>
                                    <a href="{{ url('/') }}/stock-adjustments"><i class="fa fas fa-list"></i>
                                        <span>{{ __('stock_adjustment.list') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->can('purchase.create'))
                                <li>
                                    <a href="{{ url('/') }}/stock-adjustments/create"><i
                                            class="fa fas fa-plus-circle"></i>
                                        <span>{{ __('stock_adjustment.add') }}</span>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif
            @endif
            @endcan_bt
 

            @if (auth()->user()->can_access_custom('reports_main', 'empty'))
                @if (auth()->user()->can('purchase_n_sell_report.view') ||
    auth()->user()->can('contacts_report.view') ||
    auth()->user()->can('stock_report.view') ||
    auth()->user()->can('tax_report.view') ||
    auth()->user()->can('trending_product_report.view') ||
    auth()->user()->can('sales_representative.view') ||
    auth()->user()->can('register_report.view') ||
    auth()->user()->can('expense_report.view'))
                    <li class="treeview" id="tour_step8">
                        <a class="sidemen-item-a" href="#">
                            <img class="fa sidebar-img" src="{{ asset('/images/menu/13.svg') }}" alt="">
                            <span>{{ __('report.reports') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can_bt(['profit_loss_report', 'purchase_sell_report', 'expense_report', 'sale_representative_report', 'sell_payment_report'])
                            @if (auth()->user()->can('profit_loss_report.view') ||
                                auth()->user()->can('purchase_n_sell_report.view') ||
                                auth()->user()->can('tax_report.view') ||
                                auth()->user()->can('expense_report.view') || 
                                auth()->user()->can('purchase_n_sell_report.view') ||
                                auth()->user()->can('sales_representative.view'))
                                <li>
                                    <a href="{{ url('/') }}/reports/pages/sale-report"><i
                                            class="fa fas fa-file-invoice-dollar"></i>
                                        <span>@lang('business.sale')</span>
                                    </a>
                                </li>
                            @endif
                            @endcan_bt

                            @can_bt(['stock_report'])
                            @if (auth()->user()->can('stock_report.view'))
                                <li>
                                    <a href="{{ url('/') }}/reports/pages/stock-report"><i
                                            class="fa fas fa-file-invoice-dollar"></i>
                                        <span>{{ __('report.stock_report') }}</span>
                                    </a>
                                </li>
                            @endif
                            @endcan_bt

                            @can_bt(['purchase_payment_report', 'purchase_sell_report'])
                            @if (auth()->user()->can('purchase_n_sell_report.view'))
                                <li>
                                    <a href="{{ url('/') }}/reports/pages/purchase-report"><i
                                            class="fa fas fa-file-invoice-dollar"></i>
                                        <span>{{ __('purchase.purchases') }}</span>
                                    </a>
                                </li>
                            @endif
                            @endcan_bt

                            @if (auth()->user()->can('register_report.view') ||
    auth()->user()->can('trending_product_report.view') ||
    auth()->user()->can('contacts_report.view'))
                                <li>
                                    <a href="{{ url('/') }}/reports/pages/other-report"><i
                                            class="fa fas fa-file-invoice-dollar"></i>
                                        <span>{{ __('messages.other') }}</span>
                                    </a>
                                </li>
                            @endif


                            <li>
                                <a href="#"><i class="fa fas fa-file-invoice-dollar"></i>
                                    <span>{{ __('messages.activity_logs') }}</span>
                                </a>
                            </li>

                            <li>
                                <a href="#"><i class="fa fas fa-file-invoice-dollar"></i>
                                    <span>{{ __('messages.tax_report') }}</span>
                                </a>
                            </li>

                            <li>
                                <a href="#"><i class="fa fas fa-file-invoice-dollar"></i>
                                    <span>{{ __('messages.manufacturing_report') }}</span>
                                </a>
                            </li>


                            <!--
                            @if (auth()->user()->can('profit_loss_report.view') && auth()->user()->can_access_custom('reports_profit_loss'))
                                <li >
                                    <a href="{{ url('/') }}/reports/profit-loss"><i
                                                class="fa fas fa-file-invoice-dollar"></i>
                                        <span>{{ __('report.profit_loss') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->can('purchase_n_sell_report.view'))

                                @if (auth()->user()->can_access_custom('reports_items'))
                                    <li>
                                        <a href="{{ url('/') }}/reports/items-report"><i
                                                    class="fa fas fa-tasks"></i>
                                            <span>{{ __('lang_v1.items_report') }}</span>
                                        </a>
                                    </li>
                                @endif

                                @if (auth()->user()->can('register_report.view') &&
    auth()->user()->can_access_custom('reports_register'))
                                    <li>
                                        <a href="{{ url('/') }}/reports/register-report"><i
                                                    class="fa fas fa-briefcase"></i>
                                            <span>{{ __('report.register_report') }}</span>
                                        </a>
                                    </li>
                                @endif

                                @if (in_array('expenses', $enabled_modules) &&
    auth()->user()->can('expense_report.view') &&
    auth()->user()->can_access_custom('reports_expense'))
                                    <li>
                                        <a href="{{ url('/') }}/reports/expense-report"><i
                                                    class="fa fas fa-search-minus"></i>
                                            <span>{{ __('report.expense_report') }}</span>
                                        </a>
                                    </li>
                                @endif

                            @endif

                            @if (auth()->user()->can('purchase_n_sell_report.view'))

                                @if (auth()->user()->can_access_custom('reports_sell_payment'))
                                    <li>
                                        <a href="{{ url('/') }}/reports/sell-payment-report"><i
                                                    class="fa fas fa-search-dollar"></i>
                                            <span>{{ __('lang_v1.sell_payment_report') }}</span>
                                        </a>
                                    </li>
                                @endif

                                @if (auth()->user()->can_access_custom('reports_purchase_payment'))
                                    <li>
                                        <a href="{{ url('/') }}/reports/purchase-payment-report"><i
                                                    class="fa fas fa-search-dollar"></i>
                                            <span>{{ __('lang_v1.purchase_payment_report') }}</span>
                                        </a>
                                    </li>
                                @endif

                                @if (auth()->user()->can_access_custom('reports_product_purchase'))
                                    <li>
                                        <a href="{{ url('/') }}/reports/product-sell-report"><i
                                                    class="fa fas fa-arrow-circle-up"></i>
                                            <span>{{ __('lang_v1.product_sell_report') }}</span>
                                        </a>
                                    </li>
                                @endif

                                @if (auth()->user()->can_access_custom('reports_product_purchase'))
                                    <li>
                                        <a href="{{ url('/') }}/reports/product-purchase-report"><i
                                                    class="fa fas fa-arrow-circle-down"></i>
                                            <span>{{ __('lang_v1.product_purchase_report') }}</span>
                                        </a>
                                    </li>
                                @endif

                            @endif

                            @if (auth()->user()->can('trending_product_report.view') &&
    auth()->user()->can_access_custom('reports_trending_products'))
                                <li>
                                    <a href="{{ url('/') }}/reports/trending-products"><i
                                                class="fa fas fa-chart-line"></i>
                                        <span>{{ __('report.trending_products') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if ((in_array('purchases', $enabled_modules) || in_array('add_sale', $enabled_modules) || in_array('pos_sale', $enabled_modules)) &&
    auth()->user()->can('purchase_n_sell_report.view') &&
    auth()->user()->can_access_custom('reports_pruchases_sale'))
                                <li>
                                    <a href="{{ url('/') }}/reports/purchase-sell"><i
                                                class="fa fas fa-exchange-alt"></i>
                                        <span>{{ __('report.purchase_sell_report') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->can('stock_report.view') &&
    auth()->user()->can_access_custom('reports_stock'))
                                @if (in_array('stock_adjustment', $enabled_modules) &&
    auth()->user()->can_access_custom('reports_stock_adjustment'))
                                    <li>
                                        <a href="{{ url('/') }}/reports/stock-adjustment-report"><i
                                                    class="fa fas fa-sliders-h"></i>
                                            <span>{{ __('report.stock_adjustment_report') }}</span>
                                        </a>
                                    </li>
                                @endif

                                @if (session('business.enable_lot_number') == 1 &&
    auth()->user()->can_access_custom('reports_stock'))
                                    <li>
                                        <a href="{{ url('/') }}/reports/lot-report"><i
                                                    class="fa fas fa-hourglass-half"></i>
                                            <span>{{ __('lang_v1.lot_report') }}</span>
                                        </a>
                                    </li>
                                @endif

                                @if (session('business.enable_product_expiry') == 1 &&
    auth()->user()->can_access_custom('reports_stock'))
                                    <li>
                                        <a href="{{ url('/') }}/reports/stock-expiry"><i
                                                    class="fa fas fa-calendar-times"></i>
                                            <span>{{ __('report.stock_expiry_report') }}</span>
                                        </a>
                                    </li>
                                @endif

                                @if (auth()->user()->can('stock_report.view') &&
    auth()->user()->can_access_custom('reports_stock'))
                                    <li>
                                        <a href="{{ url('/') }}/reports/stock-report"><i
                                                    class="fa fas fa-hourglass-half"></i>
                                            <span>{{ __('report.stock_report') }}</span>
                                        </a>
                                    </li>
                                @endif

                            @endif

                            @if (auth()->user()->can('contacts_report.view') &&
    auth()->user()->can_access_custom('reports_supplier_customer'))

                                @if (auth()->user()->can_access_custom('reports_customer_groups'))
                                    <li>
                                        <a href="{{ url('/') }}/reports/customer-group"><i
                                                    class="fa fas fa-users"></i>
                                            <span>{{ __('lang_v1.customer_groups_report') }}</span>
                                        </a>
                                    </li>
                                @endif

                                <li>
                                    <a href="{{ url('/') }}/reports/customer-supplier"><i
                                                class="fa fas fa-address-book"></i>
                                        <span>{{ __('report.contacts') }}</span>
                                    </a>
                                </li>
                            @endif


                            @if (auth()->user()->can('tax_report.view') &&
    auth()->user()->can_access_custom('reports_tax'))
                                <li>
                                    <a href="{{ url('/') }}/reports/tax-report"><i class="fa fas fa-percent"></i>
                                        <span>{{ __('report.tax_report') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->can('sales_representative.view') &&
    auth()->user()->can_access_custom('reports_sales'))
                                <li>
                                    <a href="{{ url('/') }}/reports/sales-representative-report"><i
                                                class="fa fas fa-user"></i>
                                        <span>{{ __('report.sales_representative') }}</span>
                                    </a>
                                </li>
                            @endif

                            -->

                        </ul>
                    </li>
                @endif
            @endif

            <!--
            <li>
                <a class="sidemen-item-a" href="{{ url('/') }}/notification-templates">
                    <img class="fa sidebar-img" src="{{ asset('/images/menu/16.svg') }}" alt="">
                    <span>Notification Templates</span>
                </a>
            </li>
        -->


            @if (auth()->user()->can('business_settings.access') ||
    auth()->user()->can('barcode_settings.access') ||
    auth()->user()->can('invoice_settings.access') ||
    auth()->user()->can('tax_rate.view') ||
    auth()->user()->can('tax_rate.create') ||
    auth()->user()->can('access_package_subscriptions'))
                <li id="tour_step3">
                    <a href="#" -href="{{ url('/') }}/settings" class="sidemen-item-a">
                        <img class="fa sidebar-img" src="{{ asset('/images/menu/18.svg') }}" alt="">
                        <span>{{ __('business.settings') }}</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>

                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ url('/') }}/settings" id="tour_step2"><i class="fa fas fa-cogs"></i>
                                <span>{{ __('business.settings') }}</span>
                            </a>
                        </li> 

                        @can_bt(['kitchen'])
                        @if (in_array('kitchen', $enabled_modules))
                            <li>
                                <a href="{{ action('Restaurant\KitchenController@index') }}"><i
                                        class="fa fas fa-cogs"></i>
                                    <span>{{ __('restaurant.kitchen') }}</span>
                                </a>
                            </li>
                        @endif
                        @endcan_bt

                        @can_bt(['restaurant_order'])
                        @if (in_array('service_staff', $enabled_modules))
                            <li>
                                <a href="{{ action('Restaurant\OrderController@index') }}"><i
                                        class="fa fas fa-cogs"></i>
                                    <span>{{ __('restaurant.orders') }}</span>
                                </a>
                            </li>
                        @endif
                        @endcan_bt

                        <!--
                        @if (auth()->user()->can('business_settings.access'))
                            <li>
                                <a href="{{ url('/') }}/business/settings" id="tour_step2"><i
                                            class="fa fas fa-cogs"></i>
                                    <span>Business Settings</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('/') }}/business/settings" id="tour_step2"><i
                                            class="fa fas fa-cogs"></i>
                                    <span>Business Settings</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('/') }}/business-location"><i class="fa fas fa-map-marker"></i>
                                    <span>Business Locations</span>
                                </a>
                            </li>
                        @endif


                        @if (auth()->user()->can('invoice_settings.access'))
                            <li>
                                <a href="{{ url('/') }}/invoice-schemes"><i class="fa fas fa-file"></i> <span>Invoice
                                Settings</span>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->can('barcode_settings.access'))
                            <li>
                                <a href="{{ url('/') }}/barcodes"><i class="fa fas fa-barcode"></i> <span>Barcode
                                Settings</span>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->can('access_printers'))
                            <li>
                                <a href="{{ url('/') }}/printers"><i class="fa fas fa-share-alt"></i> <span>Receipt
                                Printers</span>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->can('tax_rate.view') ||
    auth()->user()->can('tax_rate.create'))
                            <li>
                                <a href="{{ url('/') }}/tax-rates"><i class="fa fas fa-bolt"></i> <span>Tax
                                Rates</span>
                                </a>
                            </li>
                        @endif

                        @if (in_array('types_of_service', $enabled_modules) &&
    auth()->user()->can('access_types_of_service'))
                            <li>
                                <a href="{{ url('/') }}/types-of-service"><i class="fa fas fa-user-circle"></i>
                                    <span>Types of service</span>
                                </a>
                            </li>
                        @endif

                        <li>
                            <a href="{{ url('/') }}/subscription"><i class="fa fas fa-sync"></i> <span>Package
                                Subscription</span>
                            </a>
                        </li>
                    -->

                    </ul>
                </li>
            @endif
            {{-- <li>
                <a class="sidemen-item-a" href="{{ url('/') }}/crm/dashboard">
                    <img class="fa sidebar-img" src="{{ asset('/images/menu/19.svg') }}" alt="">
                    <span>CRM</span>
                </a>
            </li> --}}
            {{-- <li>
                <a class="sidemen-item-a" href="{{ url('/') }}/hrm/dashboard" style="">
                    <img class="fa sidebar-img" src="{{ asset('/images/menu/21.svg') }}" alt="">
                    <span>HRM</span>
                </a>
            </li> --}}
            @if (auth()->user()->can('superadmin'))
                @if ($moduleUtil->hasThePermissionInSubscription(request()->session()->get('business.id'), 'project_module'))
                    <li>
                        <a class="sidemen-item-a" href="{{ url('/') }}/project/project?project_view=list_view"
                            style="">
                            <img class="fa sidebar-img" src="{{ asset('/images/menu/20.svg') }}" alt="">
                            <span>Project</span>
                        </a>
                    </li>
                @endif
                @if ($moduleUtil->hasThePermissionInSubscription(
        request()->session()->get('business.id'),
        'essentials_module',
    ))
                    <li>
                        <a class="sidemen-item-a" href="{{ url('/') }}/essentials/todo" style="">

                            <img class="fa sidebar-img" src="{{ asset('/images/menu/22.svg') }}" alt="">
                            <span>Essentials</span>
                        </a>
                    </li>
                @endif
                @if ($moduleUtil->hasThePermissionInSubscription(
        request()->session()->get('business.id'),
        'woocommerce_module',
    ))
                    <li>
                        <a class="sidemen-item-a" href="{{ url('/') }}/woocommerce" style="">
                            <img class="fa sidebar-img" src="{{ asset('/images/menu/23.svg') }}" alt="">
                            <span>Woocommerce</span>
                        </a>
                    </li>
                @endif
            @endif

        </ul>


    </section>
</aside>
