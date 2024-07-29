@extends('layouts.app', ['page' => 'settings'])

@section('title', 'roles')
    
@section('content')
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item">{{ __('messages.settings') }}</li>
                <li class="breadcrumb-item"><a href="{{ route('settings.role') }}">Role Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Role</li>
            </ol>
        </nav>
        <h1 class="m-0">Role Management</h1>
    </div>
 
    <div class="row">
        <div class="col-lg-3">
            @include('application.settings._aside', ['tab' => 'roles'])
        </div>
        <div class="col-lg-9">
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        <div class="form-row align-items-center mb-4">
                            <div class="col">
                                <p class="h4 mb-0">
                                    <strong class="headings-color">Create Roles</strong>
                                </p>
                            </div>
                        </div>

                        <form action="{{ route('settings.role.store') }}" method="POST">
                            @include('layouts._form_errors')
                            @csrf
                            
                            @include('application.settings.role._form')

                            <div class="form-group text-right mt-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

