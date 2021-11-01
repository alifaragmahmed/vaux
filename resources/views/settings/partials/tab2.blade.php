<div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="pills-profile-tab">
    <div class="product-items">
        <div class="row">

            @can_bt(['woocommerce_integeration'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel ">
                    <div class="row">
                        <div class="col-md-4"> 
                            <div 
                            style="height: 100px;width: 100px;border-radius: 7px;background-image: url({{ url('/images/icons/woo.png') }});background-size: cover;background-position: center"  >

                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4>WooCommerce</h4>
                            <span>Sync your sales orders with WooCommerce. Avoid double entry and save valuable
                                time.</span>
                            <div class="media_btns">
                                <button class="btn border_btn" data-toggle="modal" data-target="#wooCommerce_model">
                                    Set Up
                                </button>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            @endcan_bt

            @can_bt(['email_integeration'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel ">
                    <div class="row">
                        <div class="col-md-4"> 
                            <div 
                            style="height: 100px;width: 100px;border-radius: 7px;background-image: url({{ url('/images/icons/email.png') }});background-size: cover;background-position: center"  >

                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4>{{ __('business.email') }}</h4>
                            <span>Sync your sales orders with WooCommerce. Avoid double entry and save valuable
                                time.</span>
                            <div class="media_btns">
                                <button class="btn border_btn"
                                    onclick="loadSetting('{{ url('/notification-templates?type=email') }}')">
                                    Set Up
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endcan_bt

            
            @can_bt(['sms_integeration'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel ">
                    <div class="row">
                        <div class="col-md-4"> 
                            <div 
                            style="height: 100px;width: 100px;border-radius: 7px;background-image: url({{ url('/images/icons/sms.png') }});background-size: cover;background-position: center"  >

                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4>SMS</h4>
                            <span>Sync your sales orders with WooCommerce. Avoid double entry and save valuable
                                time.</span>
                            <div class="media_btns">
                                <button class="btn border_btn"
                                onclick="loadSetting('{{ url('/notification-templates?type=sms') }}')">
                                    Set Up
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endcan_bt

            
            @can_bt(['whatsapp_integeration'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel ">
                    <div class="row">
                        <div class="col-md-4"> 
                            <div 
                            style="height: 100px;width: 100px;border-radius: 7px;background-image: url({{ url('/images/icons/whatsapp.png') }});background-size: cover;background-position: center"  >

                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4>Whatsapp</h4>
                            <span>Sync your sales orders with WooCommerce. Avoid double entry and save valuable
                                time.</span>
                            <div class="media_btns">
                                <button class="btn border_btn" 
                                onclick="loadSetting('{{ url('/notification-templates?type=whatsapp') }}')">
                                    Set Up
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endcan_bt


        </div>
    </div>
</div>
