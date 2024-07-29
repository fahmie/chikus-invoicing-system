<div class="row">
    <div class="col-sm-6">
        <div class="form-group required">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control" placeholder="Chikus" value="{{  isset($sites) ? $sites->name : '' }}" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group required">
        <label for="company">{{ __('Company') }}</label>
        <select name="company_id"  class="form-control" required>
        @foreach ($company as $company)
         <option value="{{ $company->id}}" @if(isset($sites) && $sites->company_id == $company->id) selected @endif>{{$company->name}}</option>
        @endforeach
        </select>
    </div>
</div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group required">
            <label for="email">{{ __('messages.email') }}</label>
            <input name="email" type="email" class="form-control" placeholder="{{ __('messages.email') }}" value="{{  isset($sites) ? $sites->email : '' }}" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="phone">{{ __('messages.phone') }}</label>
            <input name="phone" type="text" class="form-control" placeholder="{{ __('messages.phone') }}" value="{{  isset($sites) ? $sites->phone : '' }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group required">
            <label for="address">Address</label>
            <input name="address" type="text" class="form-control" placeholder="Chikus" value="{{  isset($sites) ? $sites->address : '' }}" required>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-sm-4">
        <div class="form-group required">
            <label for="poskod">poskod</label>
            <input name="poskod" type="text" class="form-control" placeholder="66200" value="{{  isset($sites) ? $sites->poskod : '' }}">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group required">
            <label for="city">City</label>
            <input name="city" type="text" class="form-control" placeholder="Tanjung Malim" value="{{  isset($sites) ? $sites->city : '' }}">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group required">
            <label for="state">State</label>
            <input name="state" type="text" class="form-control" placeholder="Perak" value="{{  isset($sites) ? $sites->state : '' }}">
        </div>
    </div>
</div>

