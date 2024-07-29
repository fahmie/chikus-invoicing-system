@extends('layouts.app', ['page' => 'inventory_setting'])

@section('title', __('messages.team'))
    
@section('content')
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item">{{ __('Inventory Setting') }}</li>
                <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">{{ __('Product Setting') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Product') }}</li>
            </ol>
        </nav>
        <h1 class="m-0">Edit Supplier</h1>
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
                                    <strong class="headings-color">Edit Product</strong>
                                </p>
                            </div>
                        </div>

                        <form action="{{route('productInventory.update', $productInventory->id)}}" method="POST" enctype="multipart/form-data">
                            @include('layouts._form_errors')
                            @csrf
                            @method('PUT')
                            
                            @include('application.inventory_setting.product._form')

                            <div class="form-group text-right mt-4">
                                <button type="submit" class="btn btn-primary">{{ __('Update Product') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

