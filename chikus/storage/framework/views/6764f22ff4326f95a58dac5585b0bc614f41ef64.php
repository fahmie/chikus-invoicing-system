<?php $__env->startSection('title', __('messages.invoice_settings')); ?>
    
<?php $__env->startSection('content'); ?>
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item"><?php echo e(__('messages.settings')); ?></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('messages.invoice_settings')); ?></li>
            </ol>
        </nav>
        <h1 class="m-0"><?php echo e(__('messages.invoice_settings')); ?></h1>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <?php echo $__env->make('application.settings._aside', ['tab' => 'invoice'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-lg-9">
            
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        <form action="<?php echo e(route('settings.invoice.update')); ?>" method="POST">
                            <?php echo $__env->make('layouts._form_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo csrf_field(); ?>

                            <div class="form-group mb-4">
                                <p class="h5 mb-0">
                                    <strong class="headings-color"><?php echo e(__('messages.invoice_settings')); ?></strong>
                                </p>
                                <p class="text-muted"><?php echo e(__('messages.customize_invoice_settings')); ?></p>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-5">
                                    <div class="form-group required">
                                        <label for="invoice_prefix"><?php echo e(__('messages.invoice_prefix')); ?></label>
                                        <input name="invoice_prefix" type="text" class="form-control" value="<?php echo e($currentCompany->getSetting('invoice_prefix')); ?>" placeholder="<?php echo e(__('messages.invoice_prefix')); ?>">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="invoice_auto_archive"><?php echo e(__('messages.auto_archive')); ?></label><br>
                                        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                            <input type="checkbox" name="invoice_auto_archive" id="invoice_auto_archive" <?php echo e($currentCompany->getSetting('invoice_auto_archive') ? 'checked' : ''); ?> class="custom-control-input">
                                            <label class="custom-control-label" for="invoice_auto_archive"><?php echo e(__('messages.yes')); ?></label>
                                        </div>
                                        <label for="invoice_auto_archive" class="mb-0"><?php echo e(__('messages.yes')); ?></label>
                                        <small class="form-text text-muted">
                                            <?php echo e(__('messages.auto_archive_description')); ?>

                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-5">
                                    <div class="form-group required">
                                        <label for="invoice_color"><?php echo e(__('messages.invoice_color')); ?></label>
                                        <input name="invoice_color" type="color" class="form-control" value="<?php echo e($currentCompany->getSetting('invoice_color')); ?>" placeholder="<?php echo e(__('messages.invoice_color')); ?>">
                                    </div>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label for="invoice_footer"><?php echo e(__('messages.footer')); ?></label>
                                <textarea name="invoice_footer" class="form-control" rows="4" placeholder="<?php echo e(__('messages.footer')); ?>"><?php echo e($currentCompany->getSetting('invoice_footer')); ?></textarea>
                            </div>
            
                            <div class="form-group text-right mt-4">
                                <button type="submit" class="btn btn-primary"><?php echo e(__('messages.update_settings')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', ['page' => 'settings'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/settings/invoice/index.blade.php ENDPATH**/ ?>