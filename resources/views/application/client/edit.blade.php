@extends('layouts.app', ['page' => 'client'])

@section('title', __('messages.update_vendor'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('client') }}">Client</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Client</li>
                </ol>
            </nav>
            <h1 class="m-0 h3">Update Client/Contract</h1>
        </div>
        <a href="{{ route('client.delete', $client->id) }}" class="btn btn-danger ml-3 delete-confirm">
            <i class="material-icons">delete</i> 
            Delete Client
        </a>
    </div>
@endsection
 
@section('content') 
    <form action="{{ route('client.update', $client->id) }}" method="POST">
        @include('layouts._form_errors')
        @csrf
        
        @include('application.client._form')
    </form>
@endsection