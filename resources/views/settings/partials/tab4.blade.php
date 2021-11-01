
          <div class="tab-pane fade" id="tab_4" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="product-items">
              <div class="row">
               
                @can_bt(['modifier_set'])
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4>Modifier Sets</h4>
                            <span>Summary or breakdown of products and how well
                              they have been selling.</span>
                            <div class="media_btns">
                              <button class="btn border_btn" 
                              onclick="loadSetting('{{ url('/modules/modifiers') }}')">
                              {{ __('messages.manage') }}
                            </button>
                            
                            <button class="btn border_btn" 
                            onclick="loadAddSetting('{{ url('/modules/modifiers') }}')">
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

                @can_bt(['tables'])
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4>Tables</h4>
                            <span>Summary or breakdown of products and how well
                              they have been selling.</span>
                            <div class="media_btns">
                              <button class="btn border_btn" 
                              onclick="loadSetting('{{ url('/modules/tables') }}')">
                              {{ __('messages.manage') }}
                            </button>
                            
                            <button class="btn border_btn" 
                            onclick="loadAddSetting('{{ url('/modules/tables') }}')">
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

                
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4>Categories</h4>
                            <span>Summary or breakdown of products and how well
                              they have been selling.</span>
                            <div class="media_btns">
                              <button class="btn border_btn" 
                              onclick="loadSetting('{{ url('/taxonomies?type=product') }}')">
                              {{ __('messages.manage') }}
                            </button>
                            
                            <button class="btn border_btn" 
                            onclick="loadAddSetting('{{ url('/taxonomies?type=product') }}')">
                              @lang( 'messages.add' )
                            </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> 

                @can_bt(['variation'])
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4>Variations</h4>
                            <span>Summary or breakdown of products and how well
                              they have been selling.</span>
                            <div class="media_btns">
                              <button class="btn border_btn" 
                              onclick="loadSetting('{{ url('/variation-templates') }}')">
                              {{ __('messages.manage') }}
                            </button>
                            
                            <button class="btn border_btn" 
                            onclick="loadAddSetting('{{ url('/variation-templates') }}')">
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

                @can_bt(['warranties'])
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4>Warranties</h4>
                            <span>Summary or breakdown of products and how well
                              they have been selling.</span>
                            <div class="media_btns">
                              <button class="btn border_btn" 
                              onclick="loadSetting('{{ url('/warranties') }}')">
                              {{ __('messages.manage') }}
                            </button>
                            
                            <button class="btn border_btn" 
                            onclick="loadAddSetting('{{ url('/warranties') }}')">
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

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4>Units</h4>
                            <span>Summary or breakdown of products and how well
                              they have been selling.</span>
                            <div class="media_btns">
                              <button class="btn border_btn" 
                              onclick="loadSetting('{{ url('/units') }}')">
                              {{ __('messages.manage') }}
                            </button>
                            
                            <button class="btn border_btn" 
                            onclick="loadAddSetting('{{ url('/units') }}')">
                              @lang( 'messages.add' )
                            </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                @can_bt(['brands'])
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4>Brands</h4>
                            <span>Summary or breakdown of products and how well
                              they have been selling.</span>
                            <div class="media_btns">
                              <button class="btn border_btn" 
                              onclick="loadSetting('{{ url('/brands') }}')">
                              {{ __('messages.manage') }}
                            </button>
                            
                            <button class="btn border_btn" 
                            onclick="loadAddSetting('{{ url('/brands') }}')">
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


                @can_bt(['selling_price_group'])
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="productCard panel">
                    <div class="card-content">
                      <div class="card-body cleartfix">
                        <div class="media align-items-stretch">
                          <div class="media-body">
                            <h4>Selling Price Group</h4>
                            <span>Summary or breakdown of products and how well
                              they have been selling.</span>
                            <div class="media_btns">
                              <button class="btn border_btn" 
                              onclick="loadSetting('{{ url('/selling-price-group') }}')">
                              {{ __('messages.manage') }}
                            </button>
                            
                            <button class="btn border_btn" 
                            onclick="loadAddSetting('{{ url('/selling-price-group') }}')">
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

              </div>
            </div>
          </div>
