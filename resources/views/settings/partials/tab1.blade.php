
          <div class="tab-pane fade" id="tab_1" role="tabpanel" aria-labelledby="pills-home-tab">
            
            <div class="product-items">
              <div class="row">

                @can_bt(['tax_rates'])
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4>{{ __('tax_rate.tax_rates') }}</h4>
                            <span>Define your taxing schemes to account for
                              different types of taxes on purchase and sales
                              orders (e.g., state taxes).</span>
                            <div class="media_btns">
                              <button class="btn border_btn" 
                              onclick="loadSetting('/tax-rates')"
                              >
                              {{ __('messages.manage') }}
                              </button>
                              
                              <button class="btn border_btn" 
                              onclick="loadAddSetting('/tax-rates')">
                                @lang( 'messages.add' )
                              </button>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endcan_bt

                @can_bt(['printers'])
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4>{{ __('printer.printers') }}</h4>
                            <span>Define your taxing schemes to account for
                              different types of taxes on purchase and sales
                              orders (e.g., state taxes).</span>
                            <div class="media_btns">
                              <button class="btn border_btn" 
                              onclick="loadSetting('/printers')"
                              >
                                {{ __('messages.manage') }}
                              </button>
                              
                              <button class="btn border_btn" 
                              onclick="loadAddSetting('/printers')">
                                @lang( 'messages.add' )
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endcan_bt
 
                @can_bt(['barcode_setting'])
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4>Barcodes Settings</h4>
                            <span>Define your taxing schemes to account for
                              different types of taxes on purchase and sales
                              orders (e.g., state taxes).</span>
                            <div class="media_btns">
                              <button class="btn border_btn"
                              onclick="loadSetting('/labels/show')" >
                                Generate Barcode
                              </button>
                              <button
                              class="btn border_btn"
                              onclick="loadSetting('/labels/show')" >
                                Print Barcode
                              </button>
                              <button class="btn border_btn"
                              onclick="loadSetting('/barcodes')" >
                                Barcode Setting
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endcan_bt
                
                @can_bt(['invoice_settings'])
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4>Invoice Settings </h4>
                            <span>Define your taxing schemes to account for
                              different types of taxes on purchase and sales
                              orders (e.g., state taxes).</span>
                            <div class="media_btns">
                              <button class="btn border_btn"
                              onclick="loadSetting('/invoice-schemes?tab=1')" >
                                Invoice Schemes
                              </button>
                              <button class="btn border_btn"
                              onclick="loadSetting('/invoice-schemes?tab=2')" >
                                Invoice Layouts
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endcan_bt

                @can_bt(['business_location'])
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4>{{ __('business.business_locations') }}</h4>
                            <span>Manage your business locations</span>
                            <div class="media_btns">
                              <button 
                              class="btn border_btn"
                              onclick="loadSetting('/business-location')"  >
                                {{ __('messages.manage') }}
                              </button>
                              
                              <button class="btn border_btn" 
                              onclick="loadAddSetting('/business-location')">
                                @lang( 'messages.add' )
                              </button>

                              <button class="btn red_border_btn m-user-delete">
                                <i class="fa fa-power-off"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endcan_bt
                
                @can_bt(['custom_field'])
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4>Custom Fields </h4>
                            <span>Customize Vaux to your specific needs.</span>
                            <div class="media_btns">
                              <button class="btn border_btn" 
                              onclick="loadSetting('/business/settings?setting_type=settings_custom_labels')">
                                Manage Custom Fields
                              </button>
                             
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endcan_bt
                
                @can_bt(['purchase_setting'])
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4> Purchase </h4>
                            <span>Customize Vaux to your specific needs.</span>
                            <div class="media_btns">
                              <button class="btn border_btn" 
                              onclick="loadSetting('/business/settings?setting_type=settings_purchase')">
                                Manage
                              </button>
                             
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endcan_bt
                
                @can_bt(['weighing_scale'])
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4> Weighing Scale barcode Setting </h4>
                            <span>Configure barcode as per your weighing scale.</span>
                            <div class="media_btns">
                              <button class="btn border_btn" 
                              onclick="loadSetting('/business/settings?setting_type=settings_weighing')"
                              >
                                Manage
                              </button>
                             

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endcan_bt

                
                @can_bt(['product_setting'])
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4>Product</h4>
                            <span>Configure barcode as per your weighing scale.</span>
                            <div class="media_btns">
                              <button class="btn border_btn" 
                              onclick="loadSetting('/business/settings?setting_type=settings_product')">
                                Manage
                              </button>
                             
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endcan_bt

                @can_bt(['discounts'])
                @if (auth()->user()->can('discount.access') && auth()->user()->can_access_custom('sells_disocunts')) 
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4> {{ __('Discounts') }}</h4>
                            <span>Configure barcode as per your weighing scale.</span>
                            <div class="media_btns">
                              <button class="btn border_btn" 
                              onclick="loadSetting('/discount')">
                                {{ __('Manage Discounts') }}
                              </button>
                             
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                @endcan_bt

                
                @can_bt(['expenses'])
            @if (canAccessModule('expenses'))
            @if (in_array('expenses', $enabled_modules) &&
(auth()->user()->can('expense.access') ||
    auth()->user()->can('view_own_expense')))
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4>@lang('expense.expenses')</h4>
                            <span>Configure barcode as per your weighing scale.</span>
                            <div class="media_btns">

                              <button class="btn border_btn"  onclick="loadSetting('/expenses')">
                                @lang("messages.manage")
                              </button>
                              
                              <a class="btn border_btn" href="{{action('ExpenseController@create')}}">
                                @lang("messages.add")
                              </a>
                             
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
            @endif
            @endcan_bt

                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4>Manage my data</h4>
                            <span>An important note: during data reset or replacement, you and your team members will
                              not have access to your Vaux accounts. You may need to restart Vaux Cloud when your
                              new data is ready.</span>
                            <div class="media_btns">
                              <button class="btn border_btn" data-toggle="modal" data-target="#backup_model">
                                Backup
                              </button>
                              <button class="btn red_border_btn" data-toggle="modal" data-target="#reset_data_model">
                                Reset Data
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                
              </div>
            </div>
          </div>
