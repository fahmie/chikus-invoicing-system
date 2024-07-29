<style>
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
<div class="row">
    <div class="col-md-12 offset-md-3" style="margin-left: 0;">
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-4 card-body">
                    <h6><strong class="headings-color">Stock Details</strong></h6>
                    <p class="text-muted">Transaction to add on inventory at operation site</p>
                </div>
                <div class="col-lg-8 card-form__body card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label for="site">{{ __('Supplier') }}</label>
                                <select name="supplier_id" class="form-control" required>
                                    <option selected>Select Supplier</option>
                                    @foreach ($supplier as $supplier)
                                    <option value="{{ $supplier->id}}">{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label for="site">{{ __('Product Name') }}</label>
                                <select name="product_id" class="form-control" required>
                                    <option selected>Select Product</option>
                                    @foreach ($productinventory as $productinventory)
                                    <option value="{{ $productinventory->id}}">{{$productinventory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group required">
                                <label for="display_name">Date</label>
                                <!-- <input type="date" class="form-control" name="date" value="2011/08/19" id="example-date-input" required> -->
                                <input name="date" readonly="readonly" type="text" maxlength="6" class="form-control form-control-prepended" value="<?php echo date("Y/m/d") ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group required">
                                <label for="contact_name">Time</label>
                                <input type="time" name="time" class="form-control" value="13:45:00" id="example-time-input" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label for="phone">Quantity Stock</label>
                                <input type="number" pattern="[0-9]+([\.][0-9]+)?" step="0.01" class="form-control" name="stock_out" value="" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label for="site">{{ __('Sites') }}</label>
                                <select name="sites_id" class="form-control" required>
                                    @foreach ($sites as $site)
                                    <option value="{{ $site->id}}" @if(isset($member) && $member->sites_id == $site->id) selected @endif>{{$site->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group required">
                                <label for="customer_name">Customer Company Name</label>
                                <input type="text" class="form-control" name="customer_name" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label for="customer_email">Customer phone</label>
                                <input type="text" class="form-control" name="customer_phone" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label for="customer_email">Customer Email</label>
                                <input type="text" class="form-control" name="customer_email" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="customer_address">Customer Address</label>
                                <textarea class="form-control" name="customer_address" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label for="site">{{ __('Country') }}</label>
                                <select name="customer_country" data-toggle="select" class="form-control select2-hidden-accessible" required>
                                    @foreach ($country as $country)
                                    <option value="{{ $country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="description">Remarks</label>
                                <textarea class="form-control {{ $errors->has('description')? 'is-invalid': ''}}" name="remark" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center mt-5">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
