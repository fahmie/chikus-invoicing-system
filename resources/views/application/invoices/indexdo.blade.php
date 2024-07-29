<style>
    .badge {
    padding: 1px 9px 2px;
    font-size: 12.025px;
    font-weight: bold;
    white-space: nowrap;
    color: #ffffff;
    background-color: #dbdfe4;
    -webkit-border-radius: 9px;
    -moz-border-radius: 9px;
    border-radius: 10px;
    }
    .badge:hover {
    color: #ffffff;
    text-decoration: none;
    cursor: pointer;
    }
    .badge-error {
    background-color: #b94a48;
    }
    .badge-error:hover {
    background-color: #953b39;
    }
    .badge-warning {
    background-color: #f89406;
    }
    .badge-warning:hover {
    background-color: #c67605;
    }
    .badge-success {
    background-color: #468847;
    }
    .badge-success:hover {
    background-color: #356635;
    }
    .badge-info {
    background-color: #3a87ad;
    }
    .badge-info:hover {
    background-color: #2d6987;
    }
    .badge-inverse {
    background-color: #333333;
    }
    .badge-inverse:hover {
    background-color: #1a1a1a;
    }
</style>
@extends('layouts.app', ['page' => 'do'])

@section('title', __('Delivery Order'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Delivery Order</li>
                </ol>
            </nav>
            <h1 class="m-0">Delivery Order</h1>
        </div>
        {{-- <a href="{{ route('invoices.create') }}" class="btn btn-success ml-3">
            <i class="material-icons">add</i> 
            Contract
        </a>
        <a href="{{ route('invoices.createcash') }}" class="btn btn-success ml-3">
            <i class="material-icons">add</i> 
            Cash
        </a> --}}
    </div>
@endsection

@section('content')
    @include('application.invoices._filters2')

    <div class="card">
        <div class="card-header bg-white p-0">
            <div class="row no-gutters flex nav">
            
                <a href="{{ route('do', 'due') }}" class="col-sm-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'due' ? 'active' : '' }}">
                    <span class="card-header__title m-0">
                        Pending
                    </span>
                </a>
                <a href="{{ route('do', 'all') }}" class="col-sm-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'all' ? 'active' : '' }}">
                    <span class="card-header__title m-0">
                    Arrived
                    <!-- <span class="badge" style="margin-left: 10px; border-radius: 10px;">1</span> -->
                    </span>
                
                    
                </a>
            </div>
        </div>

        @include('application.invoices._table2')
    </div>
@endsection
