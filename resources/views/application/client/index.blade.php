<style>
@media screen and (max-width: 736px) {
    .btn{
        font-size: 12px !important;
        line-height: 1em !important;
    }
    
}
</style>
@extends('layouts.app', ['page' => 'client'])

@section('title', __('Client'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Client</li>
                </ol>
            </nav>
            <h1 class="m-0">Clients or Contracts</h1>
        </div>
        <a href="{{ route('client.create') }}" class="btn btn-success ml-3"><i class="material-icons">add</i> Add Client/Contract</a>
    </div>
@endsection

@section('content')
    @include('application.client._filters')

    <div class="card">
        @include('application.client._table')
    </div>
@endsection
