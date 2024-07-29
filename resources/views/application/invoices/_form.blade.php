
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<style>
    @media screen and (max-width: 736px) {
        .custom{
            flex-basis: none !important;
        }  
        .td-custom{
            padding: 0 !important;
        }
        .mob{
            padding: 0 !important;
        }
        [dir=ltr] .pl-4, [dir=ltr] .px-4{
            padding: 0 !important;
        }
        [dir=ltr] .pr-4, [dir=ltr] .px-4{
            padding: 0 !important;
        }

     
    } 
    @media screen and (max-width: 1024px) {
        .custom{
            flex-basis: none !important;
        }  
        .td-custom{
            padding: 0 !important;
        }
        .mob{
            padding: 0 !important;
        }
        [dir=ltr] .pl-4, [dir=ltr] .px-4{
            padding: 0 !important;
        }
        [dir=ltr] .pr-4, [dir=ltr] .px-4{
            padding: 0 !important;
        }

    }
    .select2-container .select2-selection--single .select2-selection__rendered{
        overflow: hidden !important;
        white-space: nowrap !important;
    }
    .select-custom{
        font-size: 1rem;
        line-height: 1.5;
        display: block;
        width: 100%;
        height: calc(2.40625rem + 2px);
        padding: 0.5rem 0.75rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        color: #495057;
        border: 1px solid #DBDFE4;
        border-radius: 0.25rem;
        background: none !important;
        background-clip: padding-box;
        box-sizing: border-box;
        cursor: pointer;
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>
<div class="card card-form">
    <div class="row no-gutters card-form__body card-body bg-white">

        <div class="col-xl-3 pr-2 mob">
            <div class="form-group required">
                <label for="customer">Contract Name</label>
                <select id="client" name="client_id" data-toggle="select">
                    <option disabled selected>Select Contract Name</option>
                    @foreach ($client as $client)
                    <option value="{{ $client->id}}" @if(isset($invoice) && $invoice->client_id == $client->id) selected @endif>{{$client->company_name}}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" id="transporter" name="transporter" value="">
            <div class="form-group required">
                <label for="customer">Transporter Name</label>
                <select id="transporter_id" name="transporter_id" data-toggle="select" disabled>
                    <option disabled selected>Select Transporter Name</option>
                </select>
            </div>
            <div id="div_trans" class="form-group required">
                <label for="customer">Dropoff Location</label>
                <select id="location_id" name="location_id" data-toggle="select" disabled>
                    <option disabled selected>Select Dropoff Location</option>
                </select>
            </div>
        </div>
        
        <div class="col-xl-3 pr-4 pl-4 mob">
            
            <div class="form-group required">
                <label for="customer">Driver Name & IC</label>
                <select id="driver_id" name="driver_id" data-toggle="select">
                    <option disabled selected>Select Driver</option>
                    @foreach ($drivers as $drivers)
                    <option value="{{ $drivers->id}}" @if(isset($invoice) && $invoice->driver_id == $drivers->id) selected @endif>{{$drivers->name}} | {{$drivers->ic}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group required">
                <label for="invoice_date">{{ __('messages.invoice_date') }}</label>
                <!-- <input name="invoice_date" type="text" class="form-control input" data-enable-time=true data-toggle="flatpickr" data-flatpickr-default-date="{{ $invoice->invoice_date ?? now() }}" readonly="readonly" required> -->
                <input name="invoice_date" readonly="readonly" type="text" maxlength="6" class="form-control form-control-prepended"  value="<?php echo date("Y/m/d") ?>">
            </div>
           
        </div>

        <div class="col-xl-3 pl-4">
            <div class="form-group required">
                <label for="customer">Lorry Plate No.</label>
                <select id="plate_number_id" name="plate_number_id" data-toggle="select">
                    <option disabled selected>Select Plate No.</option>
                </select>
            </div>
             <input type="hidden" id="plate_number" name="plate_number" value="">
            <div class="form-group required">
                <label for="due_date">{{ __('messages.due_date') }}</label>
                <!-- <input name="due_date" type="text" class="form-control input" data-toggle="flatpickr" data-flatpickr-default-date="{{ $invoice->due_date ?? now() }}" readonly="readonly" required> -->
                <input name="due_date" readonly="readonly" type="text" maxlength="6" class="form-control form-control-prepended"  value="<?php echo date("Y/m/d") ?>"> 
            </div>
            
            
        </div>
        <div class="col-xl-3 pl-4">
            <div class="form-group">
                <label for="reference_number">{{ __('messages.reference_number') }}</label>
                <div class="input-group input-group-merge">
                    <?php
                    $date=date('YmdHis');
                    $invoice_num = preg_replace("/[^\d]/", "", $invoice->invoice_num);
                    $reference = $invoice_num.$date;
                    if(!empty($invoice->reference_number))
                    {
                    ?>
                        <input name="reference_number" readonly="readonly" type="text" maxlength="6" class="form-control form-control-prepended"  value="{{  isset($invoice) ? $invoice->reference_number : ''}}" autocomplete="off">
                    <?php
                    }else{
                    ?>
                        <input name="reference_number" readonly="readonly" type="text" maxlength="6" class="form-control form-control-prepended"  value="{{  $reference }}" autocomplete="off">
                    <?php
                    }
                    ?>
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            #
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group required"> 
                <label for="invoice_number">{{ __('messages.invoice_number') }}</label>
                <div class="input-group input-group-merge">
                    <input name="invoice_prefix" readonly="readonly" type="hidden" value="{{ $invoice->invoice_prefix }}">
                    @php
                        $date=date('dmY');
                    @endphp
                    <input name="invoice_number" readonly="readonly" type="text" maxlength="6" class="form-control form-control-prepended" value="{{$invoice->invoice_num }}" autocomplete="off" required>
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            INV-CT-{{$date}}/
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="col-12 mt-5">
            <hr>
        </div>

        <div class="col-xl-8 mt-5 pr-4">
        <div class="card card-body shadow-none border">
            <div class="table-responsive" data-toggle="lists">
                <table class="table table-xl mb-0 thead-border-top-0 table-striped">
                    <thead>
                        <tr> 
                            @if($tax_per_item and $discount_per_item)
                                <th class="w-30">{{ __('messages.product') }}</th>
                                <th class="w-20">{{ __('messages.taxes') }}</th>
                                <th class="w-20">{{ __('Quantity/Tan') }}</th>
                                <!-- <th class="w-10">{{ __('messages.unit') }}</th> -->
                                <th class="w-25">{{ __('messages.price') }}</th>
                                <th class="w-15">{{ __('messages.discount') }}</th>
                                <th class="text-right w-25">{{ __('messages.amount') }}</th>
                            @elseif($tax_per_item and !$discount_per_item)
                                <th class="w-30">{{ __('messages.product') }}</th>
                                <th class="w-25">{{ __('messages.taxes') }}</th>
                                <th class="w-20">{{ __('Quantity/Tan') }}</th>
                                <!-- <th class="w-15">{{ __('messages.unit') }}</th> -->
                                <th class="w-25">{{ __('messages.price') }}</th>
                                <th class="text-right w-25">{{ __('messages.amount') }}</th>
                            @elseif(!$tax_per_item and $discount_per_item)
                                <th class="w-30">{{ __('messages.product') }}</th>
                                <th class="w-20">{{ __('Quantity/Tan') }}</th>
                                <!-- <th class="w-10">{{ __('messages.unit') }}</th> -->
                                <th class="w-25">{{ __('messages.price') }}</th>
                                <th class="w-30">{{ __('messages.discount') }}</th>
                                <th class="text-right w-25">{{ __('messages.amount') }}</th>
                            @elseif(!$tax_per_item and !$discount_per_item)
                                <th class="w-30">{{ __('messages.product') }}</th>
                                <th class="w-20">{{ __('Quantity/Tan') }}</th>
                                <!-- <th class="w-15">{{ __('messages.unit') }}</th> -->
                                <th class="w-25">{{ __('messages.price') }}</th>
                                <th class="text-right w-25">{{ __('messages.amount') }}</th>
                            @endif
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="list" id="items">
                        <tr id="product_row_template" class="d-none">
                            <td>
                                <select name="product[]" class="form-control priceListener" required>
                                    <option disabled selected>{{ __('messages.select_product') }}</option>
                                </select>
                            </td>
                            @if($tax_per_item)
                                <td>
                                    <select name="taxes[]" multiple class="form-control priceListener">
                                        @foreach(get_tax_types_select2_array($currentCompany->id) as $option)
                                            <option value="{{ $option['id'] }}" data-percent="{{ $option['percent'] }}">{{ $option['text'] }}</option>
                                        @endforeach
                                    </select> 
                                </td>
                            @endif
                            <td>
                                <input name="quantity[]" type="number" class="form-control priceListener" value="" required>
                            </td>
                            <!-- <td> -->
                                <!-- <select name="unit[]"class="form-control priceListener" required>
                                    <option disabled selected>Lori</option>
                                    <option disabled selected>Tanah</option>
                                </select> -->
                                <!-- <input name="unit[]" type="number" class="form-control priceListener" value="1" required> -->
                            <!-- </td> -->
                            <td>
                                <input name="price[]" type="text" class="form-control price_input priceListener" autocomplete="off" value="0" required>
                            </td>
                            @if($discount_per_item)
                                <td>
                                    <div class="input-group input-group-merge">
                                        <input name="discount[]" type="number" class="form-control form-control-prepended priceListener" value="0">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                %
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            @endif
                            <td class="text-right">
                                <p class="mb-1">
                                    <input type="text" name="total[]" class="price_input price-text amount_price" value="0" readonly>
                                </p>
                                <div class="tax_list"></div>
                            </td>
                            <td>
                                {{-- <a onclick="removeRow(this)"  style="cursor: pointer;">
                                    <i class="material-icons icon-16pt">clear</i>
                                </a> --}}
                            </td>
                        </tr>
                        @if($invoice->items->count() > 0)
                            @foreach($invoice->items as $item)
                                <tr>
                                    <td>
                                        <select name="product[]" required>
                                            <option value="{{ $item->product_id }}" selected="">{{ $item->product->name }}</option>
                                        </select>
                                    </td>
                                    @if($tax_per_item)
                                        <td>
                                            <select name="taxes[]" multiple class="form-control priceListener">
                                                @foreach(get_tax_types_select2_array($currentCompany->id) as $option)
                                                    <option value="{{ $option['id'] }}" data-percent="{{ $option['percent'] }}" {{ $item->hasTax($option['id']) ? 'selected=""' : '' }}>{{ $option['text'] }}</option>
                                                @endforeach
                                            </select> 
                                        </td>
                                    @endif
                                    <td>
                                        <input name="quantity[]" type="number" class="form-control priceListener" value="{{ $item->quantity }}" required>
                                    </td>
                                    <td>
                                        <input name="price[]" type="text" class="form-control price_input priceListener" autocomplete="off" value="{{ $item->price }}" required>
                                    </td>
                                    @if($discount_per_item)
                                        <td>
                                            <div class="input-group input-group-merge">
                                                <input name="discount[]" type="number" class="form-control form-control-prepended priceListener" value="{{ $item->discount_val }}">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        %
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                    <td class="text-right">
                                        <p class="mb-1">
                                            <input type="text" name="total[]" class="price_input price-text amount_price" value="{{ $item->total }}" readonly>
                                        </p>
                                        <div class="tax_list"></div>
                                    </td>
                                    <td>
                                        <a onclick="removeRow(this)"  style="cursor: pointer;">
                                            <i class="material-icons icon-16pt">clear</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="row card-body pagination-light justify-content-center text-center">
                {{-- <button id="add_product_row" type="button" class="btn btn-light">
                    <i class="material-icons icon-16pt">add</i> {{ __('messages.add_product') }}
                </button> --}}
            </div>
            </div>
        </div>

        <div class="col-xl-4 mt-5 pl-4 ">
            <!-- <div class="col-md-12"> -->
                <!-- <div class="col-md-4" style="margin: auto;"> -->
                    <div class="card card-body shadow-none border">

                        <div class="d-flex align-items-center mb-3">
                            <div class="h6 mb-0 w-50">
                                <strong class="text-muted">{{ __('messages.sub_total') }}</strong>
                            </div>
                            <div class="ml-auto h6 mb-0">
                                <input id="sub_total" name="sub_total" type="text" class="price_input price-text w-100 fs-inherit" value="{{ $invoice->sub_total ?? 0 }}" readonly>
                            </div>
                        </div>

                        @if($tax_per_item == false)
                            <div class="row mb-1">
                                <div class="col-12 h6 mb-1">
                                    <strong class="text-muted">{{ __('messages.taxes') }}</strong>
                                </div>
                                <div class="col-12 h6 mb-0">
                                    <div class="form-group">
                                        <select id="total_taxes" name="total_taxes[]" data-toggle="select" multiple class="form-control priceListener" data-select2-id="total_taxes">
                                            @foreach(get_tax_types_select2_array($currentCompany->id) as $option)
                                                <option value="{{ $option['id'] }}" data-percent="{{ $option['percent'] }}" {{ $invoice->hasTax($option['id']) ? 'selected=""' : '' }}>{{ $option['text'] }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="total_tax_list"></div>

                        @if($discount_per_item == false)
                            <div class="row mt-2 mb-1">
                                <div class="col-12 h6 mb-1">
                                    <strong class="text-muted">{{ __('messages.discount') }}</strong>
                                </div>
                                <div class="col-12 h6 mb-0">
                                    <div class="form-group">
                                        <div class="input-group input-group-merge">
                                            <input id="total_discount" name="total_discount" type="number" class="form-control form-control-prepended priceListener" value="{{ $invoice->discount_val ?? 0 }}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    %
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <hr>
                        <div class="d-flex align-items-center mb-3">
                            <div class="h5 mb-0">
                                <strong class="text-muted">{{ __('messages.total') }}</strong>
                            </div>
                            <div class="ml-auto h5 mb-0">
                                <input id="grand_total" name="grand_total" type="text" class="price_input price-text w-100 fs-inherit" value="{{ $invoice->total ?? 0 }}" readonly>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
            </div>
        <input type="hidden" id="drafs_input" name="drafs_input" value="1">
        <div class="col-12 text-center float-right mt-3">
            <a href="{{ route('invoices') }}" type="button" class="btn btn-primary draf_form_button">Back</a>
            <button type="button" id="create_invoices" class="btn btn-primary save_form_button">{{ __('messages.save_invoice') }}</button>
        </div>
    </div>
</div>
<script>
    n =  new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    document.getElementById("date").innerHTML = d + "/" + m + "/" + y;
    document.getElementById("date2").innerHTML = d + "/" + m + "/" + y;
</script>