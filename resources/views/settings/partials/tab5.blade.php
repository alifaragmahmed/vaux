@php

$business_id = request()
    ->session()
    ->get('user.business_id');

$location = App\BusinessLocation::where('business_locations.business_id', $business_id)
    ->leftjoin('invoice_schemes as ic', 'business_locations.invoice_scheme_id', '=', 'ic.id')
    ->leftjoin('invoice_layouts as il', 'business_locations.invoice_layout_id', '=', 'il.id')
    ->leftjoin('invoice_layouts as sil', 'business_locations.sale_invoice_layout_id', '=', 'sil.id')
    ->leftjoin('selling_price_groups as spg', 'business_locations.selling_price_group_id', '=', 'spg.id')
    ->select(['business_locations.name', 'location_id', 'landmark', 'city', 'zip_code', 'state', 'country', 'business_locations.id', 'spg.name as price_group', 'ic.name as invoice_scheme', 'il.name as invoice_layout', 'sil.name as sale_invoice_layout', 'business_locations.is_active'])
    ->first();
@endphp


<div class="tab-pane fade active show" id="tab_5" role="tabpanel" aria-labelledby="pills-profile-tab">
    <div class="product-items w3-block">
        
        <div class="w3-white w3-padding w3-round panel w3-block">
            <div class="row">
                <div class="col-sm-12">
                    <div class="">
                        <h3>company details</h3>
                    </div>
                </div>
                <div class="col-sm-6 w3-padding">
                    <div class="w3-padding">
                        <div class="row w3-display-container">
                            <h6 class="w3-left" >
                                <b class="text-capitalize">{{ __( 'business.mobile' ) }}</b>
                            </h6>
                            @if(optional($location)->mobile)
                            <span class="w3-right" >{{ optional($location)->mobile }}</span>
                            @else
                            <span class="w3-right" >---</span>
                            @endif
                        </div> 
                        <div class="row w3-display-container">
                            <h6 class="w3-left" >
                                <b class="text-capitalize">{{ __( 'business.email' ) }}</b>
                            </h6>
                            @if(optional($location)->email)
                            <span class="w3-right" >{{ optional($location)->email }}</span>
                            @else
                            <span class="w3-right" >---</span>
                            @endif
                        </div> 
                        <div class=row "w3-display-container">
                            <h6 class="w3-left" >
                                <b class="text-capitalize">{{ __( 'business.website' ) }}</span>
                            </h6>
                            @if(optional($location)->website)
                            <span class="w3-right" >{{ optional($location)->website }}</span>
                            @else
                            <span class="w3-right" >---</span>
                            @endif
                        </div> 
                        <div class="row w3-display-container">
                            <h6 class="w3-left" >
                                <b class="text-capitalize">{{ __( 'business.country' ) }}</b>
                            </h6>
                            @if(optional($location)->country)
                            <span class="w3-right" >{{ optional($location)->country }}</span>
                            @else
                            <span class="w3-right" >---</span>
                            @endif
                        </div> 
                    </div>
                </div>
                <div class="col-sm-6 w3-padding">
                    <div class="w3-block w3-padding">
                        <div class="row w3-display-container">
                            <h6 class="w3-left" >
                                <b class="text-capitalize">{{ __( 'invoice.name' ) }}</b>
                            </h6>
                            @if(optional($location)->name)
                            <span class="w3-right" >{{ optional($location)->name }}</span>
                            @else
                            <span class="w3-right" >---</span>
                            @endif
                        </div> 
                        <div class="row w3-display-container">
                            <h6 class="w3-left" >
                                <b class="text-capitalize">{{ __( 'business.state' ) }}</b>
                            </h6>
                            @if(optional($location)->state)
                            <span class="w3-right" >{{ optional($location)->state }}</span>
                            @else
                            <span class="w3-right" >---</span>
                            @endif
                        </div> 
                        <div class="row w3-display-container">
                            <h6 class="w3-left" >
                                <b class="text-capitalize">{{ __( 'business.country' ) }}</b>
                            </h6>
                            @if(optional($location)->country)
                            <span class="w3-right" >{{ optional($location)->country }}</span>
                            @else
                            <span class="w3-right" >---</span>
                            @endif
                        </div> 
                        <div class="row w3-display-container">
                            <h6 class="w3-left" >
                                <b class="text-capitalize">{{ __( 'business.city' ) }}</b>
                            </h6>

                            @if(optional($location)->city)
                            <span class="w3-right" >{{ optional($location)->city }}</span>
                            @else
                            <span class="w3-right" >---</span>
                            @endif
                        </div> 
                    </div>
                </div>
                <div class="col-sm-12 w3-padding">
                    <div class="w3-">
                        <div class="media_btns">
                            <button 
                            class="btn border_btn" 
                            onclick="loadSettingWithoutPreview('{{ url('/business-location') }}', function(){ setTimeout(function(){$('#business_location_table_wrapper .edit-button').first().click();}, 2000); })"
                            data-toggle="modal" data-target="#edit_company_details_model">
                                Edit company details
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="w3-padding panel p-4">

            <div class="row">

                <div class="col-12">
                    <ul class="w3-row nav mb-3 inner_Tab_Style" id="pills-tab" role="tablist">
                        @if (auth()->user()->can('user.view'))
                        <li class="nav-item">
                            <a class="btn border_btn" id="user-page-tab" data-toggle="pill" href="#inner_tab_1"
                                role="tab" aria-controls="pills-home" aria-selected="true">
                                <span id="changeView" class="h-icon"><i class="fa fa-table"></i></span>
                                {{ __('user.users') }}</a>
                        </li>
                        @endif
                        
                        @if (auth()->user()->can('roles.view'))
                        <li class="nav-item">
                            <a class="btn border_btn" id="pills-profile-tab" data-toggle="pill" href="#inner_tab_2"
                                role="tab" aria-controls="pills-profile" aria-selected="false">
                                {{ __('user.roles') }}
                            </a>
                        </li>
                        @endif
                        
                        @can_bt(['sales_commission_agent'])
                        @if (auth()->user()->can('user.create'))
                        <li class="nav-item">
                            <a class="btn border_btn" id="pills-home-tab" data-toggle="pill" href="#inner_tab_3"
                                role="tab" aria-controls="pills-home" aria-selected="true">
                                {{ __('lang_v1.sales_commission_agents') }}</a>
                        </li>
                        @endif
                        @endcan_bt
                    </ul>
                    <hr>
                    <div class="tab-content" id="pills-tabContent">

                        @if (auth()->user()->can('user.view'))
                        <div class="tab-pane fade show" id="inner_tab_1" role="tabpanel">
                            @include("manage_user.index")
                        </div>
                        @endif

                        @if (auth()->user()->can('roles.view'))
                        <div class="tab-pane fade show" id="inner_tab_2" role="tabpanel">
                            @include("role.index")
                        </div>
                        @endif

                        @can_bt(['sales_commission_agent'])
                        @if (auth()->user()->can('user.create'))
                        <div class="tab-pane fade show" id="inner_tab_3" role="tabpanel">
                            @include("sales_commission_agent.index")
                        </div>
                        @endif
                        @endcan_bt
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
