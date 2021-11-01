@php

    $exportType = getPages(); 
    $exportOption = [
      "pdf", "csv", "excel", "copy"
    ];

@endphp

<div class="modal animate__animated animate__zoomIn" style="display: none" id="exportModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true" style="display: block; padding-right: 16px;">
    <div class="modal-dialog modal-dialog-centered " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Export data</h5>
      
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row mb-3">
        <div class="col-12 w3-padding"> 
          <small>Please choose the type of data you want to export.</small><br>
       </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-3 col-12 pt-2">
              <h6> Data type</h6>
            </div>
            <div class="col-md-9 col-12 exportChecks">
              <!--
                <div class="form-check my-2">
                <input class="form-check-input" type="radio" value="red" name="flexRadioDefault" id="flexRadioDefault1" checked="checked">
                <label class="form-check-label lable-fontt" for="flexRadioDefault1">
                 Products 
                </label>
                <div class="red box" style="display: none;"><small>Your product information, including item name, description, price, etc., but not inventory/stock on hand.</small></div>
              </div>
              <div class="form-check my-2">
                <input class="form-check-input" type="radio" value="green" name="flexRadioDefault" id="flexRadioDefault2">
                <label class="form-check-label lable-fontt" for="flexRadioDefault2">
                 Stock levels 
                </label>
                <div class="green box" style="display: none;"><small>Your product inventory/stock information - the quantity you have in stock of each item in each location.</small></div>
              </div>
              <div class="form-check my-2">
                <input class="form-check-input" type="radio" value="blue" name="flexRadioDefault" id="flexRadioDefault3">
                <label class="form-check-label lable-fontt" for="flexRadioDefault3">
                 Customers 
                </label>
                <div class="blue box" style="display: block;"><small>Your list of customers, including their contact info, addresses, payment information, and more.</small></div>
              </div>
            -->
              
              <div class="form-group my-2">
                <select name="" id="exportTypeSelect">
                    @foreach($exportType as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                <div class="green box" style="display: none;"><small>Your product inventory/stock information - the quantity you have in stock of each item in each location.</small></div>
              </div>
              
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-3 col-12 pt-2">
                <h6>Export Option</h6>
            </div>

            <div class="form-group my-2 col-md-9">
                <select name="" id="exportOptionSelect">
                    @foreach ($exportOption as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
                <div class="green box" style="display: none;"><small>Your product inventory/stock
                        information -
                        the quantity you have in stock of each item in each location.</small></div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" onclick="makeExport($('#exportTypeSelect').val(), $('#exportOptionSelect').val())" id="exportBtn" >Export </button>
        </div>
      </div>
    </div>
    </div>
