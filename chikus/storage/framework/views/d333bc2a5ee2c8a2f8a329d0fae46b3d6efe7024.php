<?php $__env->startSection('title', __('messages.company_settings')); ?>
    
<?php $__env->startSection('content'); ?>
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item"><?php echo e(__('messages.settings')); ?></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('messages.company_settings')); ?></li>
            </ol>
        </nav>
        <h1 class="m-0"><?php echo e(__('messages.company_settings')); ?></h1>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <?php echo $__env->make('application.settings._aside', ['tab' => 'company'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-lg-9">
            
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        <form action="<?php echo e(route('settings.company.update')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo $__env->make('layouts._form_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo csrf_field(); ?>
        
                            <div class="form-group">
                                <label><?php echo e(__('messages.company_logo')); ?></label><br>
                                <input id="avatar" name="avatar" class="d-none" type="file" onchange="changePreview(this);">
                                <label for="avatar">
                                    <div class="media align-items-center">
                                        <div class="mr-3">
                                            <div class="avatar avatar-xl">
                                                <img id="file-prev" src="<?php echo e($currentCompany->avatar); ?>" class="avatar-img rounded">
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <a class="btn btn-sm btn-light choose-button"><?php echo e(__('messages.choose_photo')); ?></a>
                                        </div>
                                    </div>
                                </label>
                            </div>
            
                            <div class="row">
                                <div class="col">
                                    <div class="form-group required">
                                        <label for="name"><?php echo e(__('messages.company_name')); ?></label>
                                        <input name="name" type="text" class="form-control" placeholder="<?php echo e(__('messages.company_name')); ?>" value="<?php echo e($currentCompany->name); ?>" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="billing[phone]"><?php echo e(__('messages.phone')); ?></label>
                                        <input name="billing[phone]" type="text" class="form-control" value="<?php echo e($currentCompany->billing->phone); ?>" placeholder="<?php echo e(__('messages.phone')); ?>">
                                    </div>
                                </div>
                            </div>
            
                            <div class="row">
                                <div class="col">
                                    <div class="form-group required">
                                        <label for="billing[country_id]"><?php echo e(__('messages.country')); ?></label>
                                        <select id="billing[country_id]" name="billing[country_id]" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="billing[country_id]" required>
                                            <option disabled selected><?php echo e(__('messages.select_country')); ?></option>
                                            <?php $__currentLoopData = get_countries_select2_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($option['id']); ?>" <?php echo e($currentCompany->billing->country_id == $option['id'] ? 'selected=""' : ''); ?>><?php echo e($option['text']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select> 
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="billing[state]"><?php echo e(__('messages.state')); ?></label>
                                        <input name="billing[state]" type="text" class="form-control" value="<?php echo e($currentCompany->billing->state); ?>" placeholder="<?php echo e(__('messages.state')); ?>">
                                    </div>
                                </div>
                            </div>
            
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="billing[city]"><?php echo e(__('messages.city')); ?></label>
                                        <input name="billing[city]" type="text" class="form-control" value="<?php echo e($currentCompany->billing->city); ?>" placeholder="<?php echo e(__('messages.city')); ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="billing[zip]"><?php echo e(__('messages.postal_code')); ?></label>
                                        <input name="billing[zip]" type="text" class="form-control" value="<?php echo e($currentCompany->billing->zip); ?>" placeholder="<?php echo e(__('messages.postal_code')); ?>">
                                    </div>
                                </div>
                            </div>
            
                            <div class="form-group required">
                                <label for="billing[address_1]"><?php echo e(__('messages.address')); ?></label>
                                <textarea name="billing[address_1]" class="form-control" rows="2" placeholder="<?php echo e(__('messages.address')); ?>" required><?php echo e($currentCompany->billing->address_1); ?></textarea>
                            </div>
            
                            <div class="form-group text-right mt-4">
                                <button type="submit" class="btn btn-primary"><?php echo e(__('messages.update_company')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', ['page' => 'settings'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/settings/company/index.blade.php ENDPATH**/ ?>