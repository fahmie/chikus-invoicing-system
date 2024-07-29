<?php $__env->startSection('title', __('messages.payment_settings')); ?>
    
<?php $__env->startSection('content'); ?>
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item"><?php echo e(__('messages.settings')); ?></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('messages.payment_settings')); ?></li>
            </ol>
        </nav>
        <h1 class="m-0"><?php echo e(__('messages.payment_settings')); ?></h1>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <?php echo $__env->make('application.settings._aside', ['tab' => 'payment'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-lg-9">
            
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        <form action="<?php echo e(route('settings.payment.update')); ?>" method="POST">
                            <?php echo $__env->make('layouts._form_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo csrf_field(); ?>

                            <div class="form-group mb-4">
                                <p class="h5 mb-0">
                                    <strong class="headings-color"><?php echo e(__('messages.payment_settings')); ?></strong>
                                </p>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-5">
                                    <div class="form-group required">
                                        <label for="payment_prefix"><?php echo e(__('messages.payment_prefix')); ?></label>
                                        <input name="payment_prefix" type="text" class="form-control" value="<?php echo e($currentCompany->getSetting('payment_prefix')); ?>" placeholder="<?php echo e(__('messages.payment_prefix')); ?>">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="payment_auto_archive"><?php echo e(__('messages.auto_archive')); ?></label><br>
                                        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                            <input type="checkbox" name="payment_auto_archive" id="payment_auto_archive" <?php echo e($currentCompany->getSetting('payment_auto_archive') ? 'checked' : ''); ?> class="custom-control-input">
                                            <label class="custom-control-label" for="payment_auto_archive"><?php echo e(__('messages.yes')); ?></label>
                                        </div>
                                        <label for="payment_auto_archive" class="mb-0"><?php echo e(__('messages.yes')); ?></label>
                                        <small class="form-text text-muted">
                                            <?php echo e(__('messages.auto_archive_description')); ?>

                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-5">
                                    <div class="form-group required">
                                        <label for="payment_color"><?php echo e(__('messages.payment_color')); ?></label>
                                        <input name="payment_color" type="color" class="form-control" value="<?php echo e($currentCompany->getSetting('payment_color')); ?>" placeholder="<?php echo e(__('messages.payment_color')); ?>">
                                    </div>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label for="payment_footer"><?php echo e(__('messages.footer')); ?></label>
                                <textarea name="payment_footer" class="form-control" rows="4" placeholder="<?php echo e(__('messages.footer')); ?>"><?php echo e($currentCompany->getSetting('payment_footer')); ?></textarea>
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

                        <div class="form-group mb-4">
                            <p class="h5 mb-0">
                                <strong class="headings-color"><?php echo e(__('messages.online_payment_gateways')); ?></strong>
                            </p>
                        </div>

                        <?php echo $__env->make('application.settings.payment.gateways._table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>
                </div>
            </div>

            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">

                        <div class="form-row align-items-center mb-4">
                            <div class="col">
                                <p class="h5 mb-0">
                                    <strong class="headings-color"><?php echo e(__('messages.payment_types')); ?></strong>
                                </p>
                            </div>
                            <div class="col-auto">
                                <a href="<?php echo e(route('settings.payment.type.create')); ?>" class="btn btn-light">
                                    <i class="material-icons icon-16pt">add</i>
                                    <?php echo e(__('messages.add_payment_type')); ?>

                                </a>
                            </div>
                        </div>

                        <?php echo $__env->make('application.settings.payment.types._table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', ['page' => 'settings'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/settings/payment/index.blade.php ENDPATH**/ ?>