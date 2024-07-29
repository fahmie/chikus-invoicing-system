<?php $__env->startSection('title', __('messages.team')); ?>
    
<?php $__env->startSection('content'); ?>
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item"><?php echo e(__('messages.settings')); ?></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('messages.team')); ?></li>
            </ol>
        </nav> 
        <h1 class="m-0"><?php echo e(__('messages.team')); ?></h1>
    </div>
 
    <div class="row">
        <div class="col-lg-3">
            <?php echo $__env->make('application.settings._aside', ['tab' => 'team'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-lg-9">
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        
                        <div class="form-row align-items-center mb-4">
                            <div class="col">
                                <p class="h4 mb-0">
                                    <strong class="headings-color"><?php echo e(__('messages.team_members')); ?></strong>
                                </p>
                            </div>
                            <div class="col-auto">
                                <a href="<?php echo e(route('settings.team.createMember')); ?>" class="btn btn-primary text-white">
                                    <?php echo e(__('messages.add_member')); ?>

                                </a>
                            </div>
                        </div>

                        <div class="form-row align-items-center mb-3">
                            <div class="col-auto">
                                <div class="avatar">
                                    <img src="<?php echo e($authUser->avatar); ?>" class="avatar-img rounded-circle border-xl">
                                </div>
                            </div>
                            <div class="col">
                                <div class="font-weight-bold"><?php echo e($authUser->full_name); ?> (<?php echo e(__('messages.you')); ?>)</div>
                                <p class="small text-muted mb-0 text-uppercase">
                                    <strong><?php echo e($authUser->getRoleNames()->first()); ?></strong>
                                </p>
                            </div>
                            <div class="col-auto"></div>
                        </div>

                        <?php $__currentLoopData = $currentCompany->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($authUser->id == $user->id): ?>
                                <?php continue; ?>
                            <?php endif; ?>
                            <hr>
                            <div class="form-row align-items-center mb-3">
                                <div class="col-auto">
                                    <div class="avatar">
                                        <img src="<?php echo e($user->avatar); ?>" class="avatar-img rounded-circle border-xl">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="font-weight-bold"><?php echo e($user->full_name); ?></div>
                                    <p class="small text-muted mb-0 text-uppercase">
                                        <strong><?php echo e($user->getRoleNames()->first()); ?></strong>
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <?php if($authUser->hasRole(['admin', 'super_admin'])): ?>
                                        <a href="<?php echo e(route('settings.team.editMember', $user->uid)); ?>" class="btn btn-light text-primary">
                                            <i class="material-icons">edit</i>
                                            <?php echo e(__('messages.edit')); ?>

                                        </a>
                                        <a href="<?php echo e(route('settings.team.deleteMember', $user->uid)); ?>" class="btn btn-light text-danger delete-confirm">
                                            <i class="material-icons">delete</i>
                                            <?php echo e(__('messages.delete')); ?>

                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', ['page' => 'settings'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/settings/team/index.blade.php ENDPATH**/ ?>