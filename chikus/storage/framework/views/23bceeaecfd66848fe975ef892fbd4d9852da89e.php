<script>
    <?php $__currentLoopData = ['danger', 'warning', 'success', 'info', 'error', 'warning']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(Session::has('alert-' . $msg)): ?>
            $(document).ready(function() {
                Swal.fire({
                    title: "<?php echo e(preg_replace('/[\r\n]+/', ' ', Session::get('alert-' . $msg))); ?>",
                    icon: "<?php echo e($msg); ?>",
                    allowOutsideClick: true,
                    confirmButtonColor: '#308AF3',
                    confirmButtonText: "<?php echo e(__('messages.ok')); ?>"
                })
            }); 
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</script><?php /**PATH C:\xampp\htdocs\chikus\resources\views/layouts/_flash.blade.php ENDPATH**/ ?>