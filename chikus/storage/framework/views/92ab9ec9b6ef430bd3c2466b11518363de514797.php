<?php $__env->startSection('title', __('messages.create_payment')); ?>
    
<?php $__env->startSection('page_header'); ?>
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('payments')); ?>"><?php echo e(__('messages.payments')); ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('messages.create_payment')); ?></li>
                </ol>
            </nav>
            <h1 class="m-0"><?php echo e(__('messages.create_payment')); ?></h1>
        </div>
    </div>
<?php $__env->stopSection(); ?>
 
<?php $__env->startSection('content'); ?> 
    <form action="<?php echo e(route('payments.store')); ?>" method="POST">
        <?php echo $__env->make('layouts._form_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo csrf_field(); ?>
        
        <?php echo $__env->make('application.payments._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_body_scripts'); ?>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        $(document).ready(function(){
            $('#invoice_select').select2({
                placeholder: "<?php echo e(__('messages.select_invoice')); ?>",
                minimumResultsForSearch: -1
            })

            $("#customer").select2({
                placeholder: "<?php echo e(__('messages.customer')); ?>",
                ajax: { 
                    url: "<?php echo e(route('ajax.customers')); ?>",
                    type: "get",
                    dataType: "json",
                    delay: 250,
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                },
                templateSelection: function (data, container) {
                    $(data.element).attr('data-currency', JSON.stringify(data.currency));
                    return data.text;
                }
            });

            $("#customer").change(function() {
                var customer_id = $("#customer").val();
                var currency = $('#customer').find(':selected').data('currency');
                console.log(currency);
                setupPriceInput(currency);

                $.get("<?php echo e(route('ajax.invoices')); ?>", {customer_id: customer_id}, function(response) {
                    if(!jQuery.isEmptyObject(response)) {
                        $('#invoice_select').empty();
                        $('#invoice_select').select2({
                            placeholder: 'Select Invoice',
                            minimumResultsForSearch: -1,
                            data: response,
                            templateSelection: function (data, container) {
                                $(data.element).attr('data-due_amount', data.due_amount);
                                return data.text;
                            }
                        });

                        $('#amount').val($('#invoice_select').find(':selected').data('due_amount'));
                        $("#amount").focusout();
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['page' => 'payments'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/payments/create.blade.php ENDPATH**/ ?>