<style>
    .badge {
    padding: 1px 9px 2px;
    font-size: 12.025px;
    font-weight: bold;
    white-space: nowrap;
    color: #ffffff;
    background-color: #dc303078;
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
@extends('layouts.app', ['page' => 'receipts'])

@section('title', __('messages.receipts'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Receipts</li>
                </ol>
            </nav>
            <h1 class="m-0">Receipts</h1>
        </div>
        <a href="{{ route('receipts.createreceipts') }}" class="btn btn-success ml-3">
            <i class="material-icons">add</i> 
            Create Receipt
        </a>
    </div>
@endsection

@section('content')
    @include('application.invoices._filters3')

    <div class="card">
        <div class="card-header bg-white p-0">
            <div class="row no-gutters flex nav">
                <a href="{{ route('receipts', 'all') }}" class="col-sm-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'all' ? 'active' : '' }}">
                    <span class="card-header__title m-0">
                    All
                    </span> 
                </a>
                <a href="{{ route('receipts', 'contract') }}" class="col-sm-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'contract' ? 'active' : '' }}">
                    <span class="card-header__title m-0">
                        Contract
                    </span>
                </a>
                <a href="{{ route('receipts') }}" class="col-sm-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'cash' ? 'active' : '' }}">
                    <span class="card-header__title m-0">
                        Cash
                    </span>
                </a>
            </div>
        </div>
        <form action="{{ route('receipts.storereceipts') }}" method="POST">
            @csrf
            
            @include('application.invoices._table3')
        </form>
 
    </div>
@endsection
