<form action="" method="GET">
    <div class="card card-form d-flex flex-column flex-sm-row">
        <div class="card-form__body card-body-form-group flex">
            <div class="row">
                <div class="col-sm-auto">
                    <div class="form-group">
                        <label for="filter[invoice_number]"><?php echo e(__('messages.invoice_number')); ?></label>
                        <input name="filter[invoice_number]" type="text" class="form-control" value="<?php echo e(Request::get("filter")==['invoice_number']); ?>" placeholder="<?php echo e(__('messages.search')); ?>">
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="form-group">
                        <label for="filter[from]"><?php echo e(__('messages.from')); ?></label>
                        <input name="filter[from]" type="text" class="form-control" data-toggle="flatpickr" data-flatpickr-default-date="<?php echo e(Request::get("filter")['from'] ?? ''); ?>" readonly="readonly" placeholder="<?php echo e(__('messages.from')); ?>">
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="form-group">
                        <label for="filter[to]"><?php echo e(__('messages.to')); ?></label>
                        <input name="filter[to]" type="text" class="form-control" data-toggle="flatpickr" data-flatpickr-default-date="<?php echo e(Request::get("filter")['to'] ?? ''); ?>" readonly="readonly" placeholder="<?php echo e(__('messages.to')); ?>">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <a href="<?php echo e(route('invoices')); ?>"><?php echo e(__('messages.clear_filters')); ?></a>
                </div>
            </div>
        </div>
        <button type="submit" class="btn bg-white border-left border-top border-top-sm-0 rounded-top-0 rounded-top-sm rounded-left-sm-0">
            <i class="material-icons text-primary icon-20pt">refresh</i>
            <?php echo e(__('messages.filter')); ?>

        </button>
    </div>
</form>
<?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/invoices/_filters.blade.php ENDPATH**/ ?>