{{-- <div class="form-group">
    <label>{{ __('messages.profile_image') }}</label><br>
    <input id="avatar" name="avatar" class="d-none" type="file" onchange="changePreview(this);">
    <label for="avatar">
        <div class="media align-items-center">
            <div class="mr-3">
                <div class="avatar avatar-xl">
                    <img id="file-prev" src="{{ $member->avatar }}" class="avatar-img rounded">
                </div>
            </div>
            <div class="media-body">
                <a class="btn btn-sm btn-light choose-button">{{ __('messages.choose_photo') }}</a>
            </div>
        </div>
    </label> 
</div> --}}

<div class="row">
    <div class="col-sm-4">
        <div class="form-group required">
            <label for="username">{{ __('messages.username') }}</label>
            <input name="username" type="text" class="form-control" placeholder="{{ __('messages.username') }}" value="{{ $member->username }}" required>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group required">
            <label for="first_name">{{ __('messages.first_name') }}</label>
            <input name="first_name" type="text" class="form-control" placeholder="{{ __('messages.first_name') }}" value="{{ $member->first_name }}" required>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group required">
            <label for="last_name">{{ __('messages.last_name') }}</label>
            <input name="last_name" type="text" class="form-control" placeholder="{{ __('messages.last_name') }}" value="{{ $member->last_name }}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group required">
            <label for="email">{{ __('messages.email') }}</label>
            <input name="email" type="email" class="form-control" placeholder="{{ __('messages.email') }}" value="{{ $member->email }}" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="phone">{{ __('messages.phone') }}</label>
            <input name="phone" type="text" class="form-control" placeholder="{{ __('messages.phone') }}" value="{{ $member->phone }}">
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-sm-6">
        <div class="form-group {{ $member->id == null ? 'required' : '' }}">
            <label for="password">{{ __('messages.password') }}</label>
            <input name="password" type="password" class="form-control" placeholder="{{ __('messages.password') }}">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group {{ $member->id == null ? 'required' : '' }}">
            <label for="password_confirmation">{{ __('messages.confirm_password') }}</label>
            <input name="password_confirmation" type="password" class="form-control" placeholder="{{ __('messages.confirm_password') }}">
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-sm-6">
        <div class="form-group required">
            <label for="site">{{ __('Sites') }}</label>
            <select name="sites_id"  class="form-control" required>
            @foreach ($sites as $site)
             <option value="{{ $site->id}}" @if(isset($member) && $member->sites_id == $site->id) selected @endif>{{$site->name}}</option>
            @endforeach
            </select>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group required">
            <label for="role">{{ __('messages.role') }}</label>
            <select name="roles"  class="form-control" required>
            @foreach ($roles as $role)
             <option value="{{ $role->name}}" @if(isset($member) && $member->roles == $role->name) selected @endif>{{$role->name}}</option>
            @endforeach
            </select>
        </div>
    </div>
</div>


