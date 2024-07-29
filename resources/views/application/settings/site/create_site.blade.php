@extends('layouts.app', ['page' => 'settings'])

@section('title', __('Sites'))
    
@section('content')
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item">{{ __('messages.settings') }}</li>
                <li class="breadcrumb-item"><a href="{{ route('settings.site') }}">site</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Sites</li>
            </ol>
        </nav>
        <h1 class="m-0">Add Sites</h1>
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
                                    <strong class="headings-color">Add Sites</strong>
                                </p>
                            </div>
                        </div>

                        <form action="{{ route('settings.site.store') }}" method="POST" enctype="multipart/form-data">
                            @include('layouts._form_errors')
                            @csrf
                            
                            @include('application.settings.site._site_form')

                            <div class="form-group text-right mt-4">
                                <button type="submit" class="btn btn-primary">Add Sites</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

