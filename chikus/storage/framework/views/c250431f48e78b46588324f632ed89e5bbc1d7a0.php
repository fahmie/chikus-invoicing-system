<?php $__env->startSection('title', __('messages.account_settings')); ?>
    
<?php $__env->startSection('content'); ?>
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item"><?php echo e(__('messages.settings')); ?></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('messages.account_settings')); ?></li>
            </ol>
        </nav>
        <h1 class="m-0"><?php echo e(__('messages.account_settings')); ?></h1>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <?php echo $__env->make('application.settings._aside', ['tab' => 'account'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-lg-9">
            
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        <form action="<?php echo e(route('settings.account.update')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo $__env->make('layouts._form_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label><?php echo e(__('messages.profile_image')); ?></label><br>
                                <input id="avatar" name="avatar" class="d-none" type="file" onchange="changePreview(this);">
                                <label for="avatar">
                                    <div class="media align-items-center">
                                        <div class="mr-3">
                                            <div class="avatar avatar-xl">
                                                <img id="file-prev" src="<?php echo e($authUser->avatar); ?>" class="avatar-img rounded">
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
                                        <label for="first_name"><?php echo e(__('messages.first_name')); ?></label>
                                        <input name="first_name" type="text" class="form-control" placeholder="<?php echo e(__('messages.first_name')); ?>" value="<?php echo e($authUser->first_name); ?>" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group required">
                                        <label for="last_name"><?php echo e(__('messages.last_name')); ?></label>
                                        <input name="last_name" type="text" class="form-control" placeholder="<?php echo e(__('messages.last_name')); ?>" value="<?php echo e($authUser->last_name); ?>" required>
                                    </div>
                                </div>
                            </div>
            
                            <div class="row">
                                <div class="col">
                                    <div class="form-group required">
                                        <label for="email"><?php echo e(__('messages.email')); ?></label>
                                        <input name="email" type="email" class="form-control" placeholder="<?php echo e(__('messages.email')); ?>" value="<?php echo e($authUser->email); ?>" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="phone"><?php echo e(__('messages.phone')); ?></label>
                                        <input name="phone" type="text" class="form-control" placeholder="<?php echo e(__('messages.phone')); ?>" value="<?php echo e($authUser->phone); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <p class="mb-1"><strong class="headings-color"><?php echo e(__('messages.update_password')); ?></strong></p>
                                    <p class="text-muted"><?php echo e(__('messages.update_password_description')); ?></p>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="old_password"><?php echo e(__('messages.old_password')); ?></label>
                                        <input name="old_password" type="password" class="form-control" placeholder="<?php echo e(__('messages.old_password')); ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="new_password"><?php echo e(__('messages.new_password')); ?></label>
                                        <input name="new_password" type="password" class="form-control" placeholder="<?php echo e(__('messages.new_password')); ?>">
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
            
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', ['page' => 'settings'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/settings/account/index.blade.php ENDPATH**/ ?>