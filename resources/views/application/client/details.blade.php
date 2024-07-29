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
@extends('layouts.app', ['page' => 'client'])

@section('title', __('client_details'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('client') }}">Client</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Client Details</li>
                </ol>
            </nav>
            <h1 class="m-0">Client Details</h1>
        </div>
    </div>
@endsection
 
@section('content')
<div class="row">
    <div class="col-12 mb-3">
            <div class="float-right">
                @if (Auth::user()->can('client-contract-edit'))
                <a href="{{ route('client.edit', $client->id) }}" class="btn btn-primary">
                    <i class="material-icons">edit</i> 
                    {{ __('messages.edit') }}
                </a>
                @endif
                @if (Auth::user()->can('client-contract-delete'))
                <a href="{{ route('client.delete', $client->id) }}" class="btn btn-danger delete-confirm">
                    <i class="material-icons">delete</i> 
                    {{ __('messages.delete') }}
                </a>
                @endif
            </div>
    </div>
</div>

<div class="card card-form">

    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">Client details</strong></p>
            <p class="text-muted">Basic client/contract information</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <ul class="about">
                <li class="about-items"><i class="mdi mdi-account icon-sm "></i><span class="about-item-name">Company Name:</span><span class="about-item-detail">{{ $client->company_name }}</span></li>
                <li class="about-items"><i class="mdi mdi-office-building icon-sm "></i><span class="about-item-name">Company No:</span><span class="about-item-detail">{{ $client->company_no }}</span> </li>
                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i><span class="about-item-name">Address:</span><span class="about-item-detail">{{ $client->address }}</span></li>
                <li class="about-items"><i class="mdi mdi-account-tie icon-sm "></i><span class="about-item-name">Project Manager Name:</span><span class="about-item-detail">{{ $client->project_manager_name }}</span></li>
                <li class="about-items"><i class="mdi mdi-phone icon-sm "></i><span class="about-item-name">Phone:</span><span class="about-item-detail">{{ $client->phone }}</span></li>
                <li class="about-items"><i class="mdi mdi-truck-fast icon-sm "></i><span class="about-item-name">Delivery Location:</span><span class="about-item-detail">{{ $client->delivery_location }}</span></li>
                <li class="about-items"><i class="mdi mdi-truck-fast icon-sm "></i><span class="about-item-name">Delivery Location:</span><span class="about-item-detail">@if($client->transport == 1) Client's Own Transport @else 3rd Party Transportation Service @endif</span></li>
                <li class="about-items"><i class="mdi mdi-calendar-clock icon-sm "></i><span class="about-item-name">Date Register:</span><span class="about-item-detail">{{ $client->created_at }}</span></li>           
            </ul>
        </div>
    </div>

    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">Product details</strong></p>
            <p class="text-muted">Product client/contract information</p>
        </div>
        <div class="col-lg-8 card-form__body card-body" id="parentdivslot">
            @if(!empty($product))
                @foreach($product as $key => $product)  
                <ul class="about">
                    <li class="about-items"><i class="mdi mdi-folder-plus icon-sm "></i><span class="about-item-name">Product Name:</span><span class="about-item-detail">{{  $product->name }}</span></li>          
                    <li class="about-items"><i class="mdi mdi-cash icon-sm "></i><span class="about-item-name">Price:</span><span class="about-item-detail">RM {{  $product->price/100 }}</span></li>          
                </ul>
                @endforeach
            @endif
        </div>
    </div> 
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">Client account</strong></p>
            <p class="text-muted">Add client/contract account</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <ul class="about">
                @if(!empty($client->user))
                <li class="about-items"><i class="mdi mdi-account-card-details icon-sm "></i><span class="about-item-name">First Name:</span><span class="about-item-detail">{{  $client->user->first_name }}</span></li>
                <li class="about-items"><i class="mdi mdi-account-card-details icon-sm "></i><span class="about-item-name">Last Name:</span><span class="about-item-detail">{{ $client->user->last_name }}</span> </li>
                <li class="about-items"><i class="mdi mdi-mail-ru icon-sm "></i><span class="about-item-name">Email:</span><span class="about-item-detail">{{ $client->email }}</span></li>  
                @else
                <li class="about-items"><i class="mdi mdi-account-card-details icon-sm "></i><span class="about-item-name">First Name:</span><span class="about-item-detail"></span></li>
                <li class="about-items"><i class="mdi mdi-account-card-details icon-sm "></i><span class="about-item-name">Last Name:</span><span class="about-item-detail"></span> </li>
                <li class="about-items"><i class="mdi mdi-mail-ru icon-sm "></i><span class="about-item-name">Email:</span><span class="about-item-detail">{{ $client->email }}</span></li> 
                @endif                     
            </ul>
        </div>
    </div> 
</div>

@endsection
