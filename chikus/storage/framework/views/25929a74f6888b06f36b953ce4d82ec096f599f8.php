<div class="card card-form">
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color"><?php echo e(__('messages.expense_information')); ?></strong></p>
            <p class="text-muted"><?php echo e(__('messages.basic_expense_information')); ?></p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="form-group">
                <label><?php echo e(__('messages.receipt')); ?></label><br>
                <input type="file" onchange="changePreview(this);" class="d-none" name="receipt" id="receipt">
                <label for="receipt">
                    <div class="media align-items-center">
                        <div class="mr-3">
                            <div class="avatar avatar-xl">
                                <img id="file-prev" src="<?php echo e($expense->receipt ?? asset('assets/images/account-add-photo.svg')); ?>" class="avatar-img rounded">
                            </div>
                        </div>
                        <div class="media-body">
                            <a class="btn btn-sm btn-light choose-button"><?php echo e(__('messages.choose_file')); ?></a>
                        </div>
                    </div>
                </label><br>
                <?php if($expense->receipt): ?>
                    <a href="<?php echo e(route('expenses.download_receipt', $expense->id)); ?>" target="_blank" class="btn btn-sm btn-info text-white choose-button"><?php echo e(__('messages.download_receipt')); ?></a>
                <?php endif; ?>
            </div>
            
            <div class="row">
                <div class="col"> 
                    <div class="form-group required">
                        <label for="expense_category_id"><?php echo e(__('messages.category')); ?></label> 
                        <select id="expense_category_id" name="expense_category_id" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="expense_category_id" data-minimum-results-for-search="-1" required>
                            <option disabled selected><?php echo e(__('messages.select_category')); ?></option>
                            <?php $__currentLoopData = get_expense_categories_select2_array($currentCompany->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($option['id']); ?>" <?php echo e($expense->expense_category_id == $option['id'] ? 'selected=""' : ''); ?>><?php echo e($option['text']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col"> 
                    <div class="form-group">
                        <label for="vendor_id"><?php echo e(__('messages.vendor')); ?></label> 
                        <select name="vendor_id" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="vendor_id">
                            <option disabled selected><?php echo e(__('messages.select_vendor')); ?></option>
                            <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($vendor->id); ?>" <?php echo e($expense->vendor_id == $vendor->id ? 'selected=""' : ''); ?>><?php echo e($vendor->display_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col"> 
                    <div class="form-group required">
                        <label for="expense_date"><?php echo e(__('messages.expense_date')); ?></label>
                        <input name="expense_date" type="text"  class="form-control input" data-toggle="flatpickr" data-flatpickr-default-date="<?php echo e($expense->expense_date ?? now()); ?>" placeholder="<?php echo e(__('messages.expense_date')); ?>" readonly="readonly" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group required">
                        <label for="amount"><?php echo e(__('messages.amount')); ?></label>
                        <input name="amount" type="text" class="form-control price_input" placeholder="<?php echo e(__('messages.amount')); ?>" autocomplete="off" value="<?php echo e($expense->amount ?? 0); ?>" required>
                    </div>
                </div>
            </div>
 
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="notes"><?php echo e(__('messages.notes')); ?></label>
                        <textarea name="notes" class="form-control" cols="30" rows="3" placeholder="<?php echo e(__('messages.notes')); ?>"><?php echo e($expense->notes); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group text-center mt-3">
                <button type="button" class="btn btn-primary form_with_price_input_submit"><?php echo e(__('messages.save_expense')); ?></button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/expenses/_form.blade.php ENDPATH**/ ?>