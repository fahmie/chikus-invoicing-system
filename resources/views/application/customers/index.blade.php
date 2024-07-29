@extends('layouts.app', ['page' => 'customers'])

@section('title', "Completed Delivery")
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Completed Delivery</li>
                </ol>
            </nav>
            <h1 class="m-0">Completed Delivery</h1>
        </div>
    </div>
@endsection

@section('content')
    @include('application.customers._filters')

    <div class="card">
        @include('application.customers._table')
    </div>
@endsection
