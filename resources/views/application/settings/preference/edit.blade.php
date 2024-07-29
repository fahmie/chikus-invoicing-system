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
                        <form action="{{route('settings.preferences.update',$id)}}" method="POST" enctype="multipart/form-data">
                            @include('layouts._form_errors')
                            @csrf
                        
                
                            @include('application.settings.preference._form')
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection

