<div class="card card-form">
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">Client details</strong></p>
            <p class="text-muted">Basic client/contract information</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="display_name">Company Name</label>
                        <input name="display_name" type="text" class="form-control" placeholder="E.g.: Modkha Marine Sdn. Bhd." value="{{ $vendor->display_name }}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group required">
                        <label for="contact_name">Company No.</label>
                        <input name="contact_name" type="text" class="form-control" placeholder="E.g.: 12345678A" value="{{ $vendor->contact_name }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="email">Company Address</label>
                        <input name="email" type="email" class="form-control" placeholder="E.g.: 18, Star Central, 63000 Cyberjaya" value="{{ $vendor->email }}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group required">
                        <label for="phone">Project Manager Name</label>
                        <input name="phone" type="text" class="form-control" placeholder="E.g.: Ali bin Abu" value="{{ $vendor->phone }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="website">Phone Number</label>
                        <input name="website" type="text" class="form-control" placeholder="E.g.: 0123456789" value="{{ $vendor->website }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group required">
                        <label for="website">Email</label>
                        <input name="website" type="text" class="form-control" placeholder="E.g.: ali@modkha.com" value="{{ $vendor->website }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="website">Delivery Location</label>
                        <input name="website" type="text" class="form-control" placeholder="E.g.: Trong Perak" value="{{ $vendor->website }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group required">
                        <label for="website">Price Per Tonne (RM)</label>
                        <input name="website" type="text" class="form-control" placeholder="E.g: 16" value="{{ $vendor->website }}">
                    </div>
                </div>
            </div>
            <div class="form-group text-center mt-5">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>

    {{-- <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">{{ __('messages.billing_address') }}</strong></p>
            <p class="text-muted">{{ __('messages.vendor_billing_address') }}</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <p class="row"><strong class=" col headings-color">{{ __('messages.billing_address') }}</strong></p>
            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="billing[name]">{{ __('messages.name') }}</label>
                        <input name="billing[name]" type="text" class="form-control" placeholder="{{ __('messages.name') }}" value="{{ $vendor->billing->name }}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="billing[phone]">{{ __('messages.phone') }}</label>
                        <input name="billing[phone]" type="text" class="form-control" value="{{ $vendor->billing->phone }}" placeholder="{{ __('messages.phone') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="billing[country_id]">{{ __('messages.country') }}</label>
                        <select id="billing[country_id]" name="billing[country_id]" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="billing[country_id]" required>
                            <option disabled selected>{{ __('messages.select_country') }}</option>
                            @foreach(get_countries_select2_array() as $option)
                                <option value="{{ $option['id'] }}" {{ $vendor->billing->country_id == $option['id'] ? 'selected=""' : '' }}>{{ $option['text'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="billing[state]">{{ __('messages.state') }}</label>
                        <input name="billing[state]" type="text" class="form-control" value="{{ $vendor->billing->state }}" placeholder="{{ __('messages.state') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="billing[city]">{{ __('messages.city') }}</label>
                        <input name="billing[city]" type="text" class="form-control" value="{{ $vendor->billing->city }}" placeholder="{{ __('messages.city') }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="billing[zip]">{{ __('messages.postal_code') }}</label>
                        <input name="billing[zip]" type="text" class="form-control" value="{{ $vendor->billing->zip }}" placeholder="{{ __('messages.postal_code') }}">
                    </div>
                </div>
            </div>

            <div class="form-group required">
                <label for="billing[address_1]">{{ __('messages.address') }}</label>
                <textarea name="billing[address_1]" class="form-control" rows="2" placeholder="{{ __('messages.address') }}" required>{{ $vendor->billing->address_1 }}</textarea>
            </div>

            
        </div>
    </div> --}}
</div>
