<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.4.95/css/materialdesignicons.css">
<style>
    ul.about {
        list-style: none;
        color: black;
        padding: 0;
    }
    li.about-items {
        margin: 10px;
        font-size: 14px;
        text-transform: uppercase;
        /* font-family: sans-serif; */
        /* font-weight: 400; */
    }
    li.about-items i {
    color:#607d8b;
    }
    span.about-item-name {
        width: 174px;
        display: inline-flex;
        margin-left: 10px;
    }
    span.about-item-detail {
        display: inline-flex;
        /* width: calc(100% - 160px); */
        width: calc(100% - 213px);
        margin-left: 10px;
    }
</style>
@extends('layouts.app', ['page' => 'inventory_management'])

@section('title', __('Details Inventory'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('managements.index') }}">{{__('Inventory Management')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('Inventory Details')}}</li>
                </ol>
            </nav>
            <h1 class="m-0">Inventory Details</h1>
        </div>
    </div>
@endsection
 
@section('content')
{{-- <div class="row">
    <div class="col-12 mb-3">
        @if(Auth::user()->roles =="superadmin" || Auth::user()->roles =="admin_company")
            <div class="float-right">
                <a href="{{ route('transporter.edit', $transporter->id) }}" class="btn btn-primary">
                    <i class="material-icons">edit</i> 
                    {{ __('messages.edit') }}
                </a>
                <a href="{{ route('transporter.delete', $transporter->id) }}" class="btn btn-danger delete-confirm">
                    <i class="material-icons">delete</i> 
                    {{ __('messages.delete') }}
                </a>
            </div>
        @endif
    </div>
</div> --}}

<div class="card card-form">

    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">Inventory details</strong></p>
            <p class="text-muted">Basic Inventory information</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <ul class="about">
                <li class="about-items"><i class="mdi mdi-google-maps icon-sm "></i><span class="about-item-name">Site:</span><span class="about-item-detail">{{ $inventory->sites->name }}</span></li>
                <li class="about-items"><i class="mdi mdi-office-building icon-sm "></i><span class="about-item-name">Supplier Name:</span><span class="about-item-detail">{{ $inventory->suppliers->name }}</span> </li>
                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i><span class="about-item-name">Product Name:</span><span class="about-item-detail">{{ $inventory->products->name }}</span></li>
                <li class="about-items"><i class="mdi mdi-phone icon-sm "></i><span class="about-item-name">Date:</span><span class="about-item-detail">{{ $inventory->date }}</span></li>
                <li class="about-items"><i class="mdi mdi-calendar-clock icon-sm "></i><span class="about-item-name">Time:</span><span class="about-item-detail">{{ $inventory->time }}</span></li>      
                <li class="about-items"><i class="mdi mdi-account-box-outline icon-sm "></i><span class="about-item-name">Customer Name:</span><span class="about-item-detail">{{ $inventory->customer_name }}</span></li>
                <li class="about-items"><i class="mdi mdi-office-building icon-sm "></i><span class="about-item-name">Customer Address:</span><span class="about-item-detail">{{ $inventory->customer_address }}</span> </li>
                <li class="about-items"><i class="mdi mdi-phone icon-sm  icon-sm "></i><span class="about-item-name">Customer Phone:</span><span class="about-item-detail">{{ $inventory->customer_phone }}</span></li>
                <li class="about-items"><i class="mdi-email icon-sm "></i><span class="about-item-name">Customer Email</span><span class="about-item-detail">{{ $inventory->customer_email }}</span></li>
                <li class="about-items"><i class="mdi mdi-flag icon-sm "></i><span class="about-item-name">Customer Contary</span><span class="about-item-detail">{{ $inventory->contary->name }}</span></li>      
            </ul>
        </div>
    </div>
</div>

@endsection
