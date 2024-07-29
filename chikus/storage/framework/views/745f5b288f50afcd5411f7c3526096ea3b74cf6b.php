<?php $__env->startSection('title', __('messages.preferences')); ?>
    
<?php $__env->startSection('content'); ?>
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item"><?php echo e(__('messages.settings')); ?></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('messages.preferences')); ?></li>
            </ol>
        </nav>
        <h1 class="m-0"><?php echo e(__('messages.preferences')); ?></h1>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <?php echo $__env->make('application.settings._aside', ['tab' => 'preferences'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-lg-9">
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        <form action="<?php echo e(route('settings.preferences.update')); ?>" method="POST">
                            <?php echo $__env->make('layouts._form_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo csrf_field(); ?>
                            
                            <div class="row"> 
                                <div class="col-12">
                                    <p class="h5 mb-0">
                                        <strong class="headings-color"><?php echo e(__('messages.preferences')); ?></strong>
                                    </p>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col"> 
                                    <div class="form-group">
                                        <label for="currency_id"><?php echo e(__('messages.currency')); ?></label>
                                        <select name="currency_id" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="currency_id" required>
                                            <option disabled selected><?php echo e(__('messages.select_currency')); ?></option>
                                            <?php $__currentLoopData = get_currencies_select2_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($option['id']); ?>" <?php echo e($currentCompany->getSetting('currency_id') == $option['id'] ? 'selected=""' : ''); ?>><?php echo e($option['text']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="langugage"><?php echo e(__('messages.language')); ?></label>
                                        <select id="langugage" name="langugage" data-toggle="select" data-minimum-results-for-search="-1" class="form-control select2-hidden-accessible" data-select2-id="langugage">
                                            <option disabled selected><?php echo e(__('messages.select_language')); ?></option>
                                            <?php $__currentLoopData = get_languages_select2_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($language['id']); ?>" selected><?php echo e($language['text']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="timezone"><?php echo e(__('messages.timezone')); ?></label>
                                        <select id="timezone" name="timezone" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="timezone">
                                            <option disabled selected><?php echo e(__('messages.select_timezone')); ?></option>
                                            <?php $__currentLoopData = get_timezones_select2_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timezone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($timezone['id']); ?>" <?php echo e($currentCompany->getSetting('timezone') == $timezone['id'] ? 'selected=""' : ''); ?>><?php echo e($timezone['text']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="date_format"><?php echo e(__('messages.date_format')); ?></label>
                                        <select id="date_format" name="date_format" data-toggle="select" data-minimum-results-for-search="-1" class="form-control select2-hidden-accessible" data-select2-id="date_format">
                                            <option disabled selected><?php echo e(__('messages.select_date_format')); ?></option>
                                            <?php $__currentLoopData = get_date_formats_select2_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date_format): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($date_format['id']); ?>" <?php echo e($currentCompany->getSetting('date_format') == $date_format['id'] ? 'selected=""' : ''); ?>><?php echo e($date_format['text']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <p class="h6 mb-3">
                                        <strong class="headings-color"><?php echo e(__('messages.financial_year')); ?></strong>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="financial_month_starts"><?php echo e(__('messages.month_starts')); ?></label>
                                        <select id="financial_month_starts" name="financial_month_starts" data-minimum-results-for-search="-1" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="financial_month_starts">
                                            <option disabled selected><?php echo e(__('messages.select_month_starts')); ?></option>
                                            <?php $__currentLoopData = get_months_select2_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($month['id']); ?>" <?php echo e($currentCompany->getSetting('financial_month_starts') == $month['id'] ? 'selected=""' : ''); ?> ><?php echo e($month['text']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="financial_month_ends"><?php echo e(__('messages.month_ends')); ?></label>
                                        <select id="financial_month_ends" name="financial_month_ends" data-minimum-results-for-search="-1" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="financial_month_ends">
                                            <option disabled selected><?php echo e(__('messages.select_month_ends')); ?></option>
                                            <?php $__currentLoopData = get_months_select2_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($month['id']); ?>" <?php echo e($currentCompany->getSetting('financial_month_ends') == $month['id'] ? 'selected=""' : ''); ?>><?php echo e($month['text']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-right mt-5">
                                <button type="submit" class="btn btn-primary"><?php echo e(__('messages.update_settings')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', ['page' => 'settings'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/settings/preference/index.blade.php ENDPATH**/ ?>