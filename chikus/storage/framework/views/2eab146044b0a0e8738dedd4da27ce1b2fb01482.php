<form action="" method="GET">
    <div class="card card-form d-flex flex-column flex-sm-row">
        <div class="card-form__body card-body-form-group flex">
            <div class="row">
                <div class="col-sm-auto">
                    <div class="form-group">
                        <label for="filter[display_name]"><?php echo e(__('messages.display_name')); ?></label>
                        <input name="filter[display_name]" type="text" class="form-control" value="<?php echo e(Request::get("filter")==['display_name']); ?>" placeholder="<?php echo e(__('messages.search')); ?>">
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="form-group">
                        <label for="filter[contact_name]"><?php echo e(__('messages.contact_name')); ?></label>
                        <input name="filter[contact_name]" type="text" class="form-control" value="<?php echo e(Request::get("filter")==['contact_name']); ?>" placeholder="<?php echo e(__('messages.search')); ?>">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <a href="<?php echo e(route('vendors')); ?>"><?php echo e(__('messages.clear_filters')); ?></a>
                </div>
            </div>
        </div>
        <button type="submit" class="btn bg-white border-left border-top border-top-sm-0 rounded-top-0 rounded-top-sm rounded-left-sm-0">
            <i class="material-icons text-primary icon-20pt">refresh</i>
            <?php echo e(__('messages.filter')); ?>

        </button>
    </div>
</form><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/vendors/_filters.blade.php ENDPATH**/ ?>