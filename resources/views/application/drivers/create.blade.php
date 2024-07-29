
@extends('layouts.app', ['page' => 'drivers'])

@section('title', __('messages.create_customer'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('driver') }}">Lorry Drivers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Lorry Drivers</li>
                </ol>
            </nav>
            <h1 class="m-0">Create Lorry Drivers</h1>
        </div>
    </div>
@endsection
 
@section('content') 
    <form action="{{ route('driver.store') }}" method="POST" enctype="multipart/form-data">
    @include('layouts._form_errors')
        @csrf

        @include('application.drivers._form')
    </form>
@endsection
