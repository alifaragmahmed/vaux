@inject('request', 'Illuminate\Http\Request')

@if($request->segment(1) == 'pos' && ($request->segment(2) == 'create' || $request->segment(3) == 'edit'))
    @php
        $pos_layout = true;
    @endphp
@else
    @php
        $pos_layout = false;
    @endphp
@endif

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{in_array(session()->get('user.language', config('app.locale')), config('constants.langs_rtl')) ? 'rtl' : 'ltr'}}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') - {{ Session::get('business.name') }}</title>
        
        @include('layouts.partials.css')

        @yield('css') 
        @include('layouts.partials.new_css')
        
        <!-- Not required if jQuery is already loaded -->
        
        <script src="{{ url('/') }}/supportboard/js/min/jquery.min.js"></script>
        <script id="sbinit" src="{{ url('/') }}/supportboard/js/main.js"></script>
    </head>

    <body class="@if($pos_layout) hold-transition lockscreen @else hold-transition sidebar-mini @endif">
        <a class="thetop"></a>

        <div class="full-content">

            <div class="loader w3-modal" style="padding-top: 20%;z-index: 999999999999999999" >
                
                <div class="text-center">
                    <i class="fa fa-spin fa-spinner w3-text-white w3-xxlarge"></i>
                </div>
            </div>

            

            <script type="text/javascript">
                if(localStorage.getItem("upos_sidebar_collapse") == 'true'){
                    var body = document.getElementsByTagName("body")[0];
                    body.className += " sidebar-collapse";
                }
            </script>
            @if(!$pos_layout) 
                @include('layouts.partials.sidebar')
            @else
                @include('layouts.partials.header-pos')
            @endif

            <!-- Content Wrapper. Contains page content -->
            <div class="@if(!$pos_layout) content-wrapper @endif main">
                <!-- empty div for vuejs -->
                <div id="app">
                    @yield('vue')
                </div>
                <!-- Add currency related field-->
                <input type="hidden" id="__code" value="{{session('currency')['code']}}">
                <input type="hidden" id="__symbol" value="{{session('currency')['symbol']}}">
                <input type="hidden" id="__thousand" value="{{session('currency')['thousand_separator']}}">
                <input type="hidden" id="__decimal" value="{{session('currency')['decimal_separator']}}">
                <input type="hidden" id="__symbol_placement" value="{{session('business.currency_symbol_placement')}}">
                <input type="hidden" id="__precision" value="{{config('constants.currency_precision', 2)}}">
                <input type="hidden" id="__quantity_precision" value="{{config('constants.quantity_precision', 2)}}">
                <!-- End of currency related field-->

                @if (session('status'))
                    <input type="hidden" id="status_span" data-status="{{ session('status.success') }}" data-msg="{{ session('status.msg') }}">
                @endif
                <div class="main">
                    
                    <!-- ------------ top nav ------------- -->
                    @include('layouts.partials.header')

                    @php 
                    $business_id = request()->session()->get('user.business_id');
                    $business = App\Business::where('id', $business_id)->first();
                    $settings = json_decode($business->pos_settings);
                    //dump($settings);
                    @endphp
                    <input type="hidden" id="amount_rounding_method_input" value="{{ $settings->amount_rounding_method }}">


                    @yield('content')
                    
                    @if(!$pos_layout)
                        @include('layouts.partials.footer')
                    @else
                        @include('layouts.partials.footer_pos')
                    @endif
                </div>

                <div class='scrolltop no-print'>
                    <div class='scroll icon'><i class="fas fa-angle-up"></i></div>
                </div>

                @if(config('constants.iraqi_selling_price_adjustment'))
                    <input type="hidden" id="iraqi_selling_price_adjustment">
                @endif

                <!-- This will be printed -->
                <section class="invoice print_section" id="receipt_section">
                </section>
                
            </div>
            @include('home.todays_profit_modal')

            @include("home.export")
            @include("home.import")
            @include("superadmin::layouts.partials.currency")
            <!-- /.content-wrapper -->


            <audio id="success-audio">
              <source src="{{ asset('/audio/success.ogg?v=' . $asset_v) }}" type="audio/ogg">
              <source src="{{ asset('/audio/success.mp3?v=' . $asset_v) }}" type="audio/mpeg">
            </audio>
            <audio id="error-audio">
              <source src="{{ asset('/audio/error.ogg?v=' . $asset_v) }}" type="audio/ogg">
              <source src="{{ asset('/audio/error.mp3?v=' . $asset_v) }}" type="audio/mpeg">
            </audio>
            <audio id="warning-audio">
              <source src="{{ asset('/audio/warning.ogg?v=' . $asset_v) }}" type="audio/ogg">
              <source src="{{ asset('/audio/warning.mp3?v=' . $asset_v) }}" type="audio/mpeg">
            </audio>
        </div>

        @if(!empty($__additional_html))
            {!! $__additional_html !!}
        @endif

        <script>
            // intialize 
            var setting = '';
            console.log(setting);
        </script>

        @include('layouts.partials.javascripts')
        @include('layouts.partials.new_javascript')
        @yield('javascript')

        <div class="modal fade view_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel"></div>

        @if(!empty($__additional_views) && is_array($__additional_views))
            @foreach($__additional_views as $additional_view)
                @includeIf($additional_view)
            @endforeach
        @endif

        <script>
            $('.setting-tabs li').addClass('nav-item');
            $('.setting-tabs li a').addClass('nav-link');
        </script>


        {!! Tutorial::autoload() !!}
    </body>

</html>
