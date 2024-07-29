@extends('layouts.app', ['page' => 'drivers'])

@section('title', __('Drivers'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lorry Drivers</li>
                </ol>
            </nav>
            <h1 class="m-0">Lorry Drivers</h1>
        </div>
        <a href="{{ route('driver.create') }}" class="btn btn-success ml-3"><i class="material-icons">add</i> Add Lorry Driver</a>
    </div>
@endsection

@section('content')
    @include('application.drivers._filters')

    <div class="card">
        @include('application.drivers._table')
    </div>
@endsection
