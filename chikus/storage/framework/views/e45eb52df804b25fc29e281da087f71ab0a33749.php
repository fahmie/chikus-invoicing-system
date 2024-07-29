<form action="" method="GET">
    <div class="card card-form d-flex flex-column flex-sm-row">
        <div class="card-form__body card-body-form-group flex">
            <div class="row">
                <div class="col-sm-auto">
                    <div class="form-group">
                        <label for="filter[payment_number]"><?php echo e(__('messages.payment_number')); ?></label>
                        <input name="filter[payment_number]" type="text" class="form-control" value="<?php echo e(Request::get("filter")==['payment_number']); ?>" placeholder="<?php echo e(__('messages.search')); ?>">
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="form-group">
                        <label for="filter[payment_method_id]"><?php echo e(__('messages.payment_method')); ?></label>
                        <select id="filter[payment_method_id]" name="filter[payment_method_id]" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="filter[payment_method_id]">
                            <option selected value=""><?php echo e(__('messages.payment_type')); ?></option>
                            <?php $__currentLoopData = get_payment_methods_select2_array($currentCompany->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($option['id']); ?>" <?php echo e(isset(Request::get("filter")['payment_method_id']) && Request::get("filter")['payment_method_id'] == $option['id'] ? 'selected=""' : ''); ?>><?php echo e($option['text']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
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
                    <a href="<?php echo e(route('payments')); ?>"><?php echo e(__('messages.clear_filters')); ?></a>
                </div>
            </div>
        </div>
        <button type="submit" class="btn bg-white border-left border-top border-top-sm-0 rounded-top-0 rounded-top-sm rounded-left-sm-0">
            <i class="material-icons text-primary icon-20pt">refresh</i>
            <?php echo e(__('messages.filter')); ?>

        </button>
    </div>
</form>
<?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/payments/_filters.blade.php ENDPATH**/ ?>