@extends('layouts.app', ['page' => 'settings'])

@section('title', __('messages.team'))
    
@section('content')
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item">{{ __('messages.settings') }}</li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.team') }}</li>
            </ol>
        </nav> 
        <h1 class="m-0">{{ __('messages.team') }}</h1>
    </div>
 
    <div class="row">
        <div class="col-lg-3">
            @include('application.settings._aside', ['tab' => 'team'])
        </div>
        <div class="col-lg-9">
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        
                        <div class="form-row align-items-center mb-4">
                            <div class="col">
                                <p class="h4 mb-0">
                                    <strong class="headings-color">{{ __('messages.team_members') }}</strong>
                                </p>
                            </div>
                            <div class="col-auto">
                                @if(Auth::user()->can('setting-team-create'))
                                <a href="{{ route('settings.team.createMember') }}" class="btn btn-primary text-white">
                                    {{ __('messages.add_member') }}
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-row align-items-center mb-3">
                            <div class="col-auto">
                                <div class="avatar">
                                    <img src="{{ $authUser->avatar }}" class="avatar-img rounded-circle border-xl">
                                </div>
                            </div>
                            <div class="col">
                                <div class="font-weight-bold">{{ $authUser->full_name }} ({{ __('messages.you') }})</div>
                                <p class="small text-muted mb-0 text-uppercase">
                                    <strong></strong>
                                </p>
                            </div>
                            <div class="col-auto"></div>
                        </div>

                        @foreach ($users as $user)
                            @if($authUser->id == $user->id)
                                @continue
                            @endif
                            <hr>
                            <div class="form-row align-items-center mb-3">
                                <div class="col-auto">
                                    <div class="avatar">
                                        <img src="{{ $user->avatar }}" class="avatar-img rounded-circle border-xl">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="font-weight-bold">{{ $user->full_name }}</div>
                                    <p class="small text-muted mb-0 text-uppercase">
                                        <strong></strong>
                                    </p>
                                </div>
                                <div class="col">
                                    <div class="font-weight-bold">{{ $user->sites->name }}</div>
                                    <p class="small text-muted mb-0 text-uppercase">
                                        <strong></strong>
                                    </p>
                                </div>
                                <div class="col">
                                    <div class="font-weight-bold">{{ $user->companyid->company->name }}</div>
                                    <p class="small text-muted mb-0 text-uppercase">
                                        <strong></strong>
                                    </p>
                                </div>
                                <div class="col-auto">

                                        @if(Auth::user()->can('setting-team-edit'))
                                        <a href="{{ route('settings.team.editMember', $user->uid) }}" class="btn btn-light text-primary">
                                            <i class="material-icons">edit</i>
                                            {{ __('messages.edit') }}
                                        </a>
                                        @endif
                                        @if(Auth::user()->can('setting-team-delete'))
                                        <a href="{{ route('settings.team.deleteMember', $user->uid) }}" class="btn btn-light text-danger delete-confirm">
                                            <i class="material-icons">delete</i>
                                            {{ __('messages.delete') }}
                                        </a>
                                         @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row card-body pagination-light justify-content-center text-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

