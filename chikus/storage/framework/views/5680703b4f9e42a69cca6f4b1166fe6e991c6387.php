<!-- Stylesheets -->
<link type="text/css" href="<?php echo e(asset('assets/vendor/simplebar.min.css')); ?>" rel="stylesheet">
<link type="text/css" href="<?php echo e(asset('assets/css/app.css?v=1.0.0')); ?>" rel="stylesheet">
<link type="text/css" href="<?php echo e(asset('assets/css/vendor-material-icons.css')); ?>" rel="stylesheet">
<link type="text/css" href="<?php echo e(asset('assets/css/vendor-fontawesome-free.css')); ?>" rel="stylesheet">
<link type="text/css" href="<?php echo e(asset('assets/css/vendor-select2.css')); ?>" rel="stylesheet">
<link type="text/css" href="<?php echo e(asset('assets/vendor/select2/select2.min.css')); ?>" rel="stylesheet">
<link type="text/css" href="<?php echo e(asset('assets/css/vendor-flatpickr.css')); ?>" rel="stylesheet">
<link type="text/css" href="<?php echo e(asset('assets/css/vendor-flatpickr-airbnb.css')); ?>" rel="stylesheet">

<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="<?php echo e(asset('assets/images/favicon.ico')); ?>" />

<!-- company based preferences -->
<?php echo app(\Coderello\SharedData\SharedData::class)->render(); ?>
<!-- END company based preferences -->

<!-- page based scripts & styles -->
<?php echo $__env->yieldContent('page_head_scripts'); ?>
<!-- END page based scripts & styles -->
<?php /**PATH C:\xampp\htdocs\chikus\resources\views/layouts/_css.blade.php ENDPATH**/ ?>