<div class="row">
    <div class="col-sm-6">
        <div class="form-group required">
            <label for="name">{{ __('Supplier Name') }}</label>
            <input name="name" type="text" class="form-control" placeholder="Supplier Name" value="{{  isset($supplier) ? $supplier->name : '' }}" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group required">
            <label for="address">{{ __('Address') }}</label>
            <input name="address" type="text" class="form-control" placeholder="Address" value="{{  isset($supplier) ? $supplier->address : '' }}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group required">
            <label for="email">{{ __('messages.email') }}</label>
            <input name="email" type="email" class="form-control" placeholder="{{ __('messages.email') }}" value="{{  isset($supplier) ? $supplier->email : '' }}" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="phone">{{ __('messages.phone') }}</label>
            <input name="phone" type="text" class="form-control" placeholder="{{ __('messages.phone') }}" value="{{  isset($supplier) ? $supplier->phone : '' }}">
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-sm-6">
        <div class="form-group required">
            <label for="site">{{ __('Sites') }}</label>
            <select name="sites_id"  class="form-control" required>
                @foreach ($sites as $site)
                 <option value="{{ $site->id}}" @if(isset($supplier) && $supplier->sites_id == $site->id) selected @endif>{{$site->name}}</option>
                @endforeach
                </select>
        </div>
    </div>
</div>


