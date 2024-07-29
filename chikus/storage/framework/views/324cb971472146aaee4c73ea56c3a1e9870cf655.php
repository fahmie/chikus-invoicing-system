<?php $__env->startSection('title', __('messages.login')); ?>

<?php $__env->startSection('content'); ?>
<h1 class="text-center h6 mb-4"><?php echo e(__('messages.login_to_your_account')); ?></h1>

<form action="<?php echo e(route('login')); ?>" method="POST" novalidate>
    <?php echo csrf_field(); ?>
    <div class="form-group">
        <label class="text-label" for="email"><?php echo e(__('messages.email')); ?>:</label>
        <div class="input-group input-group-merge">
            <input id="email" name="email" type="email"
                class="form-control form-control-prepended <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                placeholder="user@example.com" value="<?php echo e(old('email')); ?>" autocomplete="email"
                autofocus required>
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="far fa-envelope"></span>
                </div>
            </div>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

    </div>
    <div class="form-group">
        <label class="text-label" for="password"><?php echo e(__('messages.password')); ?>:</label>
        <div class="input-group input-group-merge">
            <input id="password" name="password" type="password"
                class="form-control form-control-prepended <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                placeholder="<?php echo e(__('messages.enter_your_password')); ?>" required autocomplete="current-password">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fa fa-key"></span>
                </div>
            </div>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-block btn-primary" type="submit"><?php echo e(__('messages.login')); ?></button>
    </div>

    <div class="form-group text-center">
        <div class="custom-control custom-checkbox">
            <input id="remember" name="remember" type="checkbox" class="custom-control-input" checked="">
            <label class="custom-control-label" for="remember"><?php echo e(__('messages.remember_me')); ?></label>
        </div>
    </div>

    <div class="form-group text-center">
        <a href="<?php echo e(route('password.request')); ?>"><?php echo e(__('messages.forgot_your_password')); ?></a> <br>
    </div>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/auth/login.blade.php ENDPATH**/ ?>