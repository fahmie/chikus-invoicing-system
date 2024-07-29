<div id="header" class="mdk-header js-mdk-header m-0">
    <div class="mdk-header__bg">
        <div class="mdk-header__bg-front"></div>
        <div class="mdk-header__bg-rear"></div>
    </div>
    <div class="mdk-header__content">
        <div class="navbar navbar-expand-sm navbar-main navbar-light bg-white pr-0 mdk-header--fixed" id="navbar"
            data-primary="data-primary">
            <div class="container-fluid p-0">
                <button class="navbar-toggler navbar-toggler-right d-block d-md-none" type="button"
                    data-toggle="sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="{{ route('dashboard') }}" class="navbar-brand">
                    @if(!empty($currentCompany->avatar))
                    <img class="navbar-brand-icon" src="{{$currentCompany->avatar}}" width="80">
                    @elseif(empty($currentCompany->avatar))
                    <img class="navbar-brand-icon" src="<?php echo asset("storage/logo/ModkhaGroup.png")?>" width="80">
                    @endif
                </a>

                <ul class="nav navbar-nav ml-auto d-none d-md-flex">
                    <!-- <li class="nav-item">
                        <a href="https://docs-foxtrot.varuscreative.com/" target="_blank" class="nav-link">
                            <i class="material-icons">help_outline</i> {{ __('messages.get_help') }}
                        </a>
                    </li> -->
                </ul>

                <ul class="nav navbar-nav d-none d-sm-flex border-left navbar-height align-items-center">
                    <li class="nav-item dropdown">
                        <a href="#account_menu" class="nav-link dropdown-toggle" data-toggle="dropdown"
                            data-caret="false">
                            <!-- <img src="{{ $authUser->avatar }}" class="rounded-circle" width="32"> -->
                            <span class="ml-1 d-flex-inline">
                                <span class="text-light">{{ $authUser->username }}</span>
                            </span>
                        </a>
                        <div id="account_menu" class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-item-text dropdown-item-text--lh">
                                <div><strong>{{ $authUser->username }}</strong></div>
                            </div>
                            <div class="dropdown-divider"></div>
                             @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin")
                            <a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a>
                            <a class="dropdown-item" href="{{ route('settings.company') }}">{{ __('messages.company') }}</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('settings.account') }}">{{ __('messages.my_profile') }}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}">{{ __('messages.logout') }}</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
