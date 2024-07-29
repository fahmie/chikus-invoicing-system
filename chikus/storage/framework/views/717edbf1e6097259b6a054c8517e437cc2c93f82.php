<?php $__env->startSection('title', __('messages.product_settings')); ?>
    
<?php $__env->startSection('content'); ?>
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item"><?php echo e(__('messages.settings')); ?></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('messages.product_settings')); ?></li>
            </ol>
        </nav>
        <h1 class="m-0"><?php echo e(__('messages.product_settings')); ?></h1>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <?php echo $__env->make('application.settings._aside', ['tab' => 'product'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-lg-9">
            
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        <form action="<?php echo e(route('settings.product.update')); ?>" method="POST">
                            <?php echo $__env->make('layouts._form_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo csrf_field(); ?>

                            <div class="form-group mb-4">
                                <p class="h5 mb-0">
                                    <strong class="headings-color"><?php echo e(__('messages.product_settings')); ?></strong>
                                </p>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="discount_per_item"><?php echo e(__('messages.discount_per_item')); ?></label><br>
                                        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                            <input type="checkbox" name="discount_per_item" id="discount_per_item" <?php echo e($currentCompany->getSetting('discount_per_item') ? 'checked' : ''); ?> class="custom-control-input">
                                            <label class="custom-control-label" for="discount_per_item"><?php echo e(__('messages.yes')); ?></label>
                                        </div>
                                        <label for="discount_per_item" class="mb-0"><?php echo e(__('messages.yes')); ?></label>
                                        <small class="form-text text-muted">
                                            <?php echo e(__('messages.discount_per_item_description')); ?>

                                        </small>
                                    </div> 
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="tax_per_item"><?php echo e(__('messages.tax_per_item')); ?></label><br>
                                        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                            <input type="checkbox" name="tax_per_item" id="tax_per_item" <?php echo e($currentCompany->getSetting('tax_per_item') ? 'checked' : ''); ?> class="custom-control-input">
                                            <label class="custom-control-label" for="tax_per_item"><?php echo e(__('messages.yes')); ?></label>
                                        </div>
                                        <label for="tax_per_item" class="mb-0"><?php echo e(__('messages.yes')); ?></label>
                                        <small class="form-text text-muted">
                                            <?php echo e(__('messages.tax_per_item_description')); ?>

                                        </small>
                                    </div>
                                </div>
                            </div>
            
                            <div class="form-group text-right mt-4">
                                <button type="submit" class="btn btn-primary"><?php echo e(__('messages.update_settings')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">

                        <div class="form-row align-items-center mb-4">
                            <div class="col">
                                <p class="h5 mb-0">
                                    <strong class="headings-color"><?php echo e(__('messages.product_units')); ?></strong>
                                </p>
                            </div>
                            <div class="col-auto">
                                <a href="<?php echo e(route('settings.product.unit.create')); ?>" class="btn btn-light">
                                    <i class="material-icons icon-16pt">add</i>
                                    <?php echo e(__('messages.add_product_unit')); ?>

                                </a>
                            </div>
                        </div>

                        <?php echo $__env->make('application.settings.product.unit._table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', ['page' => 'settings'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/settings/product/index.blade.php ENDPATH**/ ?>