@extends('layouts.app', ['page' => 'settings'])

@section('title','Sites')
    
@section('content')
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item">{{ __('messages.settings') }}</li>
                <li class="breadcrumb-item active" aria-current="page">Sites Setting</li>
            </ol>
        </nav> 
        <h1 class="m-0">Sites Setting</h1>
    </div>
 
    <div class="row">
        <div class="col-lg-3">
            @include('application.settings._aside', ['tab' => 'site'])
        </div>
        <div class="col-lg-9">
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        
                        <div class="form-row align-items-center mb-4">
                            <div class="col">
                                <p class="h4 mb-0">
                                    <strong class="headings-color">Sites</strong>
                                </p>
                            </div>
                            <div class="col-auto">
                                @if(Auth::user()->can('setting-sites-create'))
                                <a href="{{ route('settings.site.create') }}" class="btn btn-primary text-white">
                                Add Sites
                                </a>
                                @endif
                            </div>
                        </div>

                        @foreach ($sites as $site)
                            <hr>
                            <div class="form-row align-items-center mb-3">
                                <div class="col">
                                    <div class="font-weight-bold">{{ $site->name }}</div>
                                    <p class="small text-muted mb-0 text-uppercase">
                                        <strong></strong>
                                    </p>
                                </div>
                                <div class="col">
                                    <div class="font-weight-bold">{{ $site->company->name }}</div>
                                    <p class="small text-muted mb-0 text-uppercase">
                                        <strong></strong>
                                    </p>
                                </div>
                                <div class="col-auto">

                                    @if(Auth::user()->can('setting-sites-edit'))
                                        <a href="{{ route('settings.site.edit', $site->id) }}" class="btn btn-light text-primary">
                                            <i class="material-icons">edit</i>
                                            {{ __('messages.edit') }}
                                        </a>
                                        @endif
                                        @if(Auth::user()->can('setting-sites-delete'))
                                        <a href="{{ route('settings.site.delete', $site->id) }}" class="btn btn-light text-danger delete-confirm">
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
                    {{ $sites->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

