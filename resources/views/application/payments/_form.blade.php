<div class="card card-form">
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">Receipt Details</strong></p>
            <p class="text-muted">Basic Receipt Information</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="payment_date">{{ __('messages.payment_date') }}</label>
                        <input name="payment_date" type="text" class="form-control input" data-toggle="flatpickr" data-flatpickr-default-date="{{ $payment->payment_date ?? now() }}" placeholder="{{ __('messages.payment_date') }}" readonly="readonly" required>
                    </div>
                </div>
                <div class="col"> 
                    <div class="form-group required">
                        <label for="payment_number">Cheque Number/Transaction Number</label>
                        <div class="input-group input-group-merge">
                            <input name="payment_prefix" type="hidden" value="{{ $payment->payment_prefix }}">
                            <input name="payment_number" type="text" maxlength="6" class="form-control form-control-prepended" value="" autocomplete="off" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <!-- {{ $payment->payment_prefix }} -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="customer">Contract Name</label>
                        <select id="customer" name="customer_id" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="customer">
                            <option disabled selected>Select Contract Name</option>
                            @if($payment->customer_id)
                                <option value="{{ $payment->customer_id }}" selected>{{ $payment->customer->display_name }}</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group required">
                        <label for="amount">Total Amount</label>
                        <input id="amount" name="amount" type="text" class="form-control" placeholder="RM" autocomplete="off" value="" required>
                    </div>
                </div>
            </div>

            <div class="row">
                
                <div class="col">
                    <div class="form-group required">
                        <label for="payment_method_id">{{ __('messages.payment_type') }}</label>
                        <select id="payment_method_id" name="payment_method_id" data-toggle="select" class="form-control select2-hidden-accessible" data-minimum-results-for-search="-1" data-select2-id="payment_method_id">
                            <option disabled selected>{{ __('messages.select_payment_type') }}</option>
                            @foreach(get_payment_methods_select2_array($currentCompany->id) as $option)
                                <option value="{{ $option['id'] }}" {{ $payment->payment_method_id == $option['id'] ? 'selected=""' : '' }}>{{ $option['text'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="table-responsive" data-toggle="lists">
                    <table class="table table-xl mb-0 thead-border-top-0 table-striped">
                        <thead>
                            <tr>
                                <th class="w-10">Mark</th>
                                <th class="w-30">Invoices</th>
                                <th class="w-30">Delivery Orders</th>
                                <th class="w-30">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="w-10">
                                    <div class="custom-control custom-checkbox mt-sm-2">
                                        <input type="checkbox" class="custom-control-input" type="checkbox" name="is_contract" id="is_contract" value="">
                                        <label class="custom-control-label" for="is_contract"></label>
                                    </div></td>
                                <td class="w-30">INV-CT01-291919</td>
                                <td class="w-30">DO-CT01-291919</td>
                                <td class="w-30">RM12</td>
                            </tr>
                            <tr>
                                <td class="w-10">
                                    <div class="custom-control custom-checkbox mt-sm-2">
                                        <input type="checkbox" class="custom-control-input" type="checkbox" name="is_contract" id="is_contract" value="">
                                        <label class="custom-control-label" for="is_contract"></label>
                                    </div></td>
                                <td class="w-30">INV-CT01-35456</td>
                                <td class="w-30">DO-CT01-35456</td>
                                <td class="w-30">RM12</td>
                            </tr>
                            <tr>
                                <td class="w-10">
                                    <div class="custom-control custom-checkbox mt-sm-2">
                                        <input type="checkbox" class="custom-control-input" type="checkbox" name="is_contract" id="is_contract" value="">
                                        <label class="custom-control-label" for="is_contract"></label>
                                    </div></td>
                                <td class="w-30">INV-CT01-42435</td>
                                <td class="w-30">DO-CT01-42435</td>
                                <td class="w-30">RM12</td>
                            </tr>
                            <tr>
                                <td class="w-10">
                                    <div class="custom-control custom-checkbox mt-sm-2">
                                        <input type="checkbox" class="custom-control-input" type="checkbox" name="is_contract" id="is_contract" value="">
                                        <label class="custom-control-label" for="is_contract"></label>
                                    </div></td>
                                <td class="w-30">INV-CT01-35722</td>
                                <td class="w-30">DO-CT01-35722</td>
                                <td class="w-30">RM12</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="notes">{{ __('messages.notes') }}</label>
                        <textarea name="notes" class="form-control" rows="4" placeholder="{{ __('messages.notes') }}">{{ $payment->notes }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="private_notes">{{ __('messages.private_notes') }}</label>
                        <textarea name="private_notes" class="form-control" rows="4" placeholder="{{ __('messages.private_notes') }}">{{ $payment->private_notes }}</textarea>
                    </div>
                </div>
            </div> -->

            <div class="form-group text-center mt-3">
                <button type="button" class="btn btn-primary form_with_price_input_submit">{{ __('messages.save_payment') }}</button>
            </div>
        </div>
    </div>
</div>
