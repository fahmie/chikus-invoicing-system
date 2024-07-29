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

<body class="layout-default has-drawer-opened">
    <div class="mdk-header-layout js-mdk-header-layout">
        <?php echo $__env->make('layouts._header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="mdk-header-layout__content pt-64px">
            <div class="mdk-drawer-layout js-mdk-drawer-layout">
                <div class="mdk-drawer-layout__content page">
                    <div class="container-fluid page__heading-container">
                        <?php echo $__env->yieldContent('page_header'); ?>
                    </div>

                    <div class="container-fluid page__container">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>

                <?php echo $__env->make('layouts._drawer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
   
    <?php echo $__env->make('layouts._js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts._flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\chikus\resources\views/layouts/app.blade.php ENDPATH**/ ?>