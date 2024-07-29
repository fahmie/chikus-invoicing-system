<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>

    <?php echo $__env->make('layouts._css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body class="layout-login-centered-boxed">
    <div class="layout-login-centered-boxed__form card">
        <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-2 navbar-light">
            <a href="<?php echo e(url('/login')); ?>" class="navbar-brand flex-column mb-2 align-items-center mr-0">
                <img class="navbar-brand-icon mr-0 mb-2" src="<?php echo e(asset('assets/images/fox-logo-black.svg')); ?>" width="25" alt="<?php echo e(config('app.name')); ?>">
                <span><?php echo e(config('app.name')); ?></span>
            </a>
        </div>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <?php echo $__env->make('layouts._js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\chikus\resources\views/layouts/auth.blade.php ENDPATH**/ ?>