<?php if(count($errors) > 0): ?>
    <div class="alert alert-danger alert-noborder">
        <button data-dismiss="alert" class="close" type="button"><span>×</span><span class="sr-only"><?php echo e(__('messages.close')); ?></span></button>
        <strong><?php echo e(__('messages.fix_errors')); ?></strong>
        <br><br>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/layouts/_form_errors.blade.php ENDPATH**/ ?>