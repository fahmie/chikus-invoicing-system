@extends('layouts.app', ['page' => 'settings'])

@section('title', __('messages.preferences'))
    
@section('content')
<div class="page__heading">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
            <li class="breadcrumb-item">{{ __('messages.settings') }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.company_settings') }}</li>
        </ol>
    </nav>
    <h1 class="m-0">{{ __('messages.preferences') }}</h1>
    </div>
 
    <div class="row">
        <div class="col-lg-3">
            @include('application.settings._aside', ['tab' => 'preferences'])
        </div>
        <div class="col-lg-9">
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        
                        <div class="form-row align-items-center mb-4">
                            <div class="col">
                                <p class="h4 mb-0">
                                    <strong class="headings-color">{{ __('messages.preferences') }}</strong>
                                </p>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('settings.preferences.create') }}" class="btn btn-primary text-white">
                                Add Preferences
                                </a>
                            </div>
                        </div>

                        @foreach ($company as $companys)
                            <hr>
                            <div class="form-row align-items-center mb-3">
                                <div class="col">
                                    <div class="font-weight-bold">{{ $companys->name }}</div>
                                    <p class="small text-muted mb-0 text-uppercase">
                                        <strong></strong>
                                    </p>
                                </div>
                                <div class="col-auto">

                                    @if(Auth::user()->roles =="admin" || Auth::user()->roles =="superadmin")
                                        <a href="{{ route('settings.preferences.edit', $companys->id) }}" class="btn btn-light text-primary">
                                            <i class="material-icons">edit</i>
                                            {{ __('messages.edit') }}
                                        </a>
                                        <a href="{{ route('settings.company.delete', $companys->id) }}" class="btn btn-light text-danger delete-confirm">
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
                    {{ $company->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection

