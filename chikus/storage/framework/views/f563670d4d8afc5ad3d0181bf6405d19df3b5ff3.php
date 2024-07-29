<form action="" method="GET">
    <div class="card card-form d-flex flex-column flex-sm-row">
        <div class="card-form__body card-body-form-group flex">
            <div class="row">
                <div class="col-sm-auto">
                    <div class="form-group">
                        <label for="filter[name]"><?php echo e(__('messages.name')); ?></label>
                        <input name="filter[name]" type="text" class="form-control" value="<?php echo e(Request::get("filter")==['name']); ?>" placeholder="<?php echo e(__('messages.name')); ?>">
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="form-group">
                        <label for="filter[unit_id]"><?php echo e(__('messages.product_unit')); ?></label>
                        <select id="filter[unit_id]" name="filter[unit_id]" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="filter[unit_id]">
                            <option selected value=""><?php echo e(__('messages.select_unit')); ?></option>
                            <?php $__currentLoopData = get_product_units_select2_array($currentCompany->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($option['id']); ?>" <?php echo e(isset(Request::get("filter")['unit_id']) && Request::get("filter")['unit_id'] == $option['id'] ? 'selected=""' : ''); ?>><?php echo e($option['text']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <a href="<?php echo e(route('products')); ?>"><?php echo e(__('messages.clear_filters')); ?></a>
                </div>
            </div>
        </div>
        <button type="submit" class="btn bg-white border-left border-top border-top-sm-0 rounded-top-0 rounded-top-sm rounded-left-sm-0">
            <i class="material-icons text-primary icon-20pt">refresh</i>
            <?php echo e(__('messages.filter')); ?>

        </button>
    </div>
</form><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/products/_filters.blade.php ENDPATH**/ ?>