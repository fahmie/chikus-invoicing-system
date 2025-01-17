@extends('layouts.app', ['page' => 'transporter'])

@section('title', __('Update Transporter'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('transporter') }}">{{ __('Transporter') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Update Transporter') }}</li>
                </ol>
            </nav>
            <h1 class="m-0 h3">{{ __('Update Transporter') }}</h1>
        </div>
    </div>
@endsection
 
@section('content') 
    <form action="{{ route('transporter.update', $transporter->id) }}" method="POST">
        @include('layouts._form_errors')
        @csrf
        
        @include('application.transporter._form')
    </form>
@endsection

@section('page_body_scripts')
    @include('application.transporter._js')
    <script>
        $(document).ready(function() {
            setupCustomer();

            $('tbody tr').each(function(index, element) {
                var row = $(element);

                // If the row is template just continue
                if(row.attr('id') === 'product_row_template') return;

                var productInput = row.find('[name="product[]"]');
                initializeProductSelect2(productInput);

                var taxInput = row.find('[name="taxes[]"]');
                initializeTaxSelect2(taxInput);
            });
            
            initializePriceListener();
            calculateRowPrice();
        });
    </script>
@endsection