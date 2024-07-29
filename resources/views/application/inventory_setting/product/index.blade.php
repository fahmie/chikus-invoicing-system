@extends('layouts.app', ['page' => 'inventory_setting'])

@section('title',__('Supplier Settings'))

@section('content')
<div class="page__heading">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item">{{ __('Inventory Setting') }}</li>
                <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">{{ __('Product Setting') }}</a></li>
        </ol>
    </nav>
    <h1 class="m-0">{{ __('Product Settings') }}</h1>
</div>

<div class="row">
    <div class="col-lg-3">
        @include('application.inventory_setting._aside', ['tab' => 'products'])
    </div>
    <div class="col-lg-9">
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col card-form__body card-body bg-white">

                    <div class="form-row align-items-center mb-4">
                        <div class="col">
                            <p class="h4 mb-0">
                                <strong class="headings-color">{{ __('Products') }}</strong>
                            </p>
                        </div>
                        <div class="col-auto">
                            @if(Auth::user()->can('product-inventory-create'))
                            <a href="{{ route('productInventory.create') }}" class="btn btn-primary text-white">
                                {{ __('Add Products') }}
                            </a>
                            @endif
                        </div>
                    </div>
                    @include('application.inventory_setting.product._table')
                </div>
            </div>
            <div class="row card-body pagination-light justify-content-center text-center">

            </div>
        </div>
    </div>
</div>
@endsection
