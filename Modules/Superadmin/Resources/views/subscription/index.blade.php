 

<!-- Main content -->
<section class="content">

    @include('superadmin::layouts.partials.currency')

    <div class="row">

        <div class="col-md-4">
            <div class="productCard startDate panel text-center">
                <div class="card-content">
                    <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                            <div class="media-body">
                                <h4>@lang('superadmin::lang.start_date')</h4>
                                <h1 class="">{{ date('d', strtotime($active->start_date)) }}</h1>
                                <span>{{ date('Y-m', strtotime($active->start_date)) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="productCard endDate panel text-center">
                <div class="card-content">
                    <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                            <div class="media-body">
                                <h4>@lang('superadmin::lang.end_date')</h4>
                                <h1 class="">{{ date('d', strtotime($active->end_date)) }}</h1>
                                <span>{{ date('Y-m', strtotime($active->end_date)) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="productCard startDate panel text-center">
                <div class="card-content">
                    <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                            <div class="media-body">
                                <h4>@lang('superadmin::lang.remaining')</h4>
                                <h1 class="">{{ \Carbon::today()->diffForHumans($active->end_date) }}</h1>
                                <span>days</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <br>

    <ul class="nav nav-pills mb-3 setting-tabs w3-padding w3-white w3-round w3-block new-shadow" id="pills-tab" role="tablist">
        <li class="nav-item active">
            <a class="nav-link " id="pills-home-tab" href="#subTab1" data-toggle="tab" aria-expanded="false">
                @lang('superadmin::lang.all_subscriptions')</a>
        </li>
        <li class="nav-item  ">
            <a class="nav-link " id="pills-profile-tab" href="#subTab2" data-toggle="tab"
                aria-expanded="true" aria-controls="pills-profile" aria-selected="false">
                @lang('superadmin::lang.packages')</a>
        </li>
    </ul>
	<br>

    <div class="nav-tabs-custom w3-round-xlarge" style="background: transparent;padding: 0px" >

        <div class="tab-content w3-round-xlarge " style="background: transparent;padding: 0px">
            <div class="tab-pane active w3-white w3-card" id="subTab1" >
				<div class="table-responsive w3-light-gray">
					<!-- location table-->
					<table data-title="@lang('superadmin::lang.all_subscriptions')" class="table table-bordered table-hover" id="all_subscriptions_table">
						<thead>
							<tr>
								<th>@lang( 'superadmin::lang.package_name' )</th>
								<th>@lang( 'superadmin::lang.start_date' )</th>
								<th>@lang( 'superadmin::lang.trial_end_date' )</th>
								<th>@lang( 'superadmin::lang.end_date' )</th>
								<th>@lang( 'superadmin::lang.price' )</th>
								<th>@lang( 'superadmin::lang.paid_via' )</th>
								<th>@lang( 'superadmin::lang.payment_transaction_id' )</th>
								<th>@lang( 'sale.status' )</th>
								<th>@lang( 'lang_v1.created_at' )</th>
								<th>@lang( 'business.created_by' )</th>
								<th>@lang('messages.action')</th>
							</tr>
						</thead>
					</table>
				</div>
            </div>

            <div class="tab-pane" id="subTab2"  style="background: transparent;padding: 0px"  >
				<div style="background: transparent;padding: 0px" 
				class="sub-slider owl-carousel owl-theme owl-loaded owl-drag"  >
					@include('superadmin::subscription.partials.packages')
				</div>
            </div>
        </div>
    </div>


    <div class="box hidden">
        <div class="box-header">
            <h3 class="box-title">@lang('superadmin::lang.active_subscription')</h3>
        </div>

        <div class="box-body">
            @if (!empty($active))
                <div class="col-md-4">
                    <div class="box box-success">
                        <div class="box-header with-border text-center">
                            <h2 class="box-title">
                                {{ $active->package_details['name'] }}
                            </h2>

                            <div class="box-tools pull-right">
                                <span class="badge bg-green">
                                    @lang('superadmin::lang.running')
                                </span>
                            </div>

                        </div>
                        <div class="box-body text-center">
                            @lang('superadmin::lang.start_date') : {{ @format_date($active->start_date) }} <br />
                            @lang('superadmin::lang.end_date') : {{ @format_date($active->end_date) }} <br />

                            @lang('superadmin::lang.remaining', ['days' =>
                            \Carbon::today()->diffInDays($active->end_date)])

                        </div>
                    </div>
                </div>
            @else
                <h3 class="text-danger">@lang('superadmin::lang.no_active_subscription')</h3>
            @endif

            @if (!empty($nexts))
                <div class="clearfix"></div>
                @foreach ($nexts as $next)
                    <div class="col-md-4">
                        <div class="box box-success">
                            <div class="box-header with-border text-center">
                                <h2 class="box-title">
                                    {{ $next->package_details['name'] }}
                                </h2>
                            </div>
                            <div class="box-body text-center">
                                @lang('superadmin::lang.start_date') : {{ @format_date($next->start_date) }} <br />
                                @lang('superadmin::lang.end_date') : {{ @format_date($next->end_date) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            @if (!empty($waiting))
                <div class="clearfix"></div>
                @foreach ($waiting as $row)
                    <div class="col-md-4">
                        <div class="box box-success">
                            <div class="box-header with-border text-center">
                                <h2 class="box-title">
                                    {{ $row->package_details['name'] }}
                                </h2>
                            </div>
                            <div class="box-body text-center">
                                @if ($row->paid_via == 'offline')
                                    @lang('superadmin::lang.waiting_approval')
                                @else
                                    @lang('superadmin::lang.waiting_approval_gateway')
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
     
 
</section> 
 

<script type="text/javascript">
	setTimeout(function(){
		$('.sub-slider').owlCarousel({
			loop:true,
			margin:10,
			autoplay:true,
			autoplayTimeout:1000,
			autoplayHoverPause:true,
			center:true,
			nav:true,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:3
				},
				1000:{
					items:3
				}
			}
		})
	}, 1000);

    $(document).ready(function() {
        $('#all_subscriptions_table').DataTable({
            //processing: true,
            serverSide: true,
			@include("layouts.partials.datatable_plugin") 
            ajax: '{{ action('\Modules\Superadmin\Http\Controllers\SubscriptionController@allSubscriptions') }}',
            columns: [{
                    data: 'package_name',
                    name: 'P.name'
                },
                {
                    data: 'start_date',
                    name: 'start_date'
                },
                {
                    data: 'trial_end_date',
                    name: 'trial_end_date'
                },
                {
                    data: 'end_date',
                    name: 'end_date'
                },
                {
                    data: 'package_price',
                    name: 'package_price'
                },
                {
                    data: 'paid_via',
                    name: 'paid_via'
                },
                {
                    data: 'payment_transaction_id',
                    name: 'payment_transaction_id'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'created_by',
                    name: 'created_by'
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false
                },
            ],
            "fnDrawCallback": function(oSettings) {
                __currency_convert_recursively($('#all_subscriptions_table'), true);
            }
        });
    });
</script> 
