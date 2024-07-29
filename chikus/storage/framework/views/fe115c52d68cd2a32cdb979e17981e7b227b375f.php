<div class="card card-form">
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color"><?php echo e(__('messages.payment_information')); ?></strong></p>
            <p class="text-muted"><?php echo e(__('messages.basic_payment_information')); ?></p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="payment_date"><?php echo e(__('messages.payment_date')); ?></label>
                        <input name="payment_date" type="text" class="form-control input" data-toggle="flatpickr" data-flatpickr-default-date="<?php echo e($payment->payment_date ?? now()); ?>" placeholder="<?php echo e(__('messages.payment_date')); ?>" readonly="readonly" required>
                    </div>
                </div>
                <div class="col"> 
                    <div class="form-group required">
                        <label for="payment_number"><?php echo e(__('messages.payment_number')); ?></label>
                        <div class="input-group input-group-merge">
                            <input name="payment_prefix" type="hidden" value="<?php echo e($payment->payment_prefix); ?>">
                            <input name="payment_number" type="text" maxlength="6" class="form-control form-control-prepended" value="<?php echo e($payment->payment_num); ?>" autocomplete="off" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <?php echo e($payment->payment_prefix); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="customer"><?php echo e(__('messages.customer')); ?></label>
                        <select id="customer" name="customer_id" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="customer">
                            <option disabled selected><?php echo e(__('messages.select_customer')); ?></option>
                            <?php if($payment->customer_id): ?>
                                <option value="<?php echo e($payment->customer_id); ?>" selected><?php echo e($payment->customer->display_name); ?></option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group required">
                        <label for="invoice_select"><?php echo e(__('messages.invoice')); ?></label>
                        <select id="invoice_select" name="invoice_id" data-toggle="select" class="form-control select2-hidden-accessible" data-minimum-results-for-search="-1" data-select2-id="invoice_select">
                            <option disabled selected><?php echo e(__('messages.select_invoice')); ?></option>
                            <?php if($payment->invoice_id): ?>
                                <option value="<?php echo e($payment->invoice_id); ?>" selected><?php echo e($payment->invoice->invoice_number); ?></option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="amount"><?php echo e(__('messages.amount')); ?></label>
                        <input id="amount" name="amount" type="text" class="form-control price_input" placeholder="<?php echo e(__('messages.amount')); ?>" autocomplete="off" value="<?php echo e($payment->amount ?? 0); ?>" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group required">
                        <label for="payment_method_id"><?php echo e(__('messages.payment_type')); ?></label>
                        <select id="payment_method_id" name="payment_method_id" data-toggle="select" class="form-control select2-hidden-accessible" data-minimum-results-for-search="-1" data-select2-id="payment_method_id">
                            <option disabled selected><?php echo e(__('messages.select_payment_type')); ?></option>
                            <?php $__currentLoopData = get_payment_methods_select2_array($currentCompany->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($option['id']); ?>" <?php echo e($payment->payment_method_id == $option['id'] ? 'selected=""' : ''); ?>><?php echo e($option['text']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="notes"><?php echo e(__('messages.notes')); ?></label>
                        <textarea name="notes" class="form-control" rows="4" placeholder="<?php echo e(__('messages.notes')); ?>"><?php echo e($payment->notes); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="private_notes"><?php echo e(__('messages.private_notes')); ?></label>
                        <textarea name="private_notes" class="form-control" rows="4" placeholder="<?php echo e(__('messages.private_notes')); ?>"><?php echo e($payment->private_notes); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group text-center mt-3">
                <button type="button" class="btn btn-primary form_with_price_input_submit"><?php echo e(__('messages.save_payment')); ?></button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/payments/_form.blade.php ENDPATH**/ ?>