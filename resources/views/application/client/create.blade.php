@extends('layouts.app', ['page' => 'client'])

@section('title', __('Create Client'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('client') }}">Client</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Client</li>
                </ol>
            </nav>
            <h1 class="m-0">Create Client/Contract</h1>
        </div>
    </div>
@endsection
 
@section('content') 
    <form action="{{ route('client.store') }}" method="POST">
        @include('layouts._form_errors')
        @csrf

        @include('application.client._form')
    </form>
@endsection
