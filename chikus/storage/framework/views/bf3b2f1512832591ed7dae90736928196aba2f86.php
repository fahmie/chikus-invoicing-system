<?php if($customers->count() > 0): ?>
    <div class="table-responsive">
        <table class="table mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th class="w-30px" class="text-center"><?php echo e(__('messages.#id')); ?></th>
                    <th><?php echo e(__('messages.display_name')); ?></th>
                    <th><?php echo e(__('messages.contact_name')); ?></th>
                    <th class="w-50px"><?php echo e(__('messages.invoices')); ?></th>
                    <th class="text-center"><?php echo e(__('messages.amount_due')); ?></th>
                    <th class="text-center width: 120px;"><?php echo e(__('messages.created_at')); ?></th>
                    <th class="w-50px"><?php echo e(__('messages.view')); ?></th>
                </tr>
            </thead>
            <tbody class="list" id="customers">
                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="badge badge-light">#<?php echo e($customer->id); ?></div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="material-icons icon-16pt mr-1 text-primary">business</i>
                                    <a href="<?php echo e(route('customers.details', $customer->id)); ?>"><?php echo e($customer->display_name); ?></a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <small class="text-muted">
                                    <i class="material-icons icon-16pt mr-1">pin_drop</i>
                                    <?php echo e($customer->displayShortAddress('billing')); ?>

                                </small>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="material-icons icon-16pt mr-1 text-muted">person</i>
                                    <p class="text-muted mb-0"><?php echo e($customer->contact_name); ?></p>
                                </div>
                            </div> 
                            <div class="d-flex align-items-center">
                                <small class="text-muted">
                                    <i class="material-icons icon-16pt mr-1">email</i>
                                    <?php echo e($customer->email); ?>

                                </small>
                            </div>
                            
                        </td>
                        <td class="w-80px" class="text-center">
                            <i class="material-icons icon-16pt text-muted mr-1">receipt</i>
                            <a class="text-muted"><?php echo e($customer->invoices()->count()); ?></a>
                        </td>
                        <td class="text-center">
                            <strong><?php echo e(money($customer->invoice_due_amount, $customer->currency->code)); ?></strong>
                        </td>
                        <td class="text-center"><i class="material-icons icon-16pt text-muted-light mr-1">today</i> <?php echo e($customer->created_at->format('Y-m-d')); ?></td>
                        <td><a href="<?php echo e(route('customers.details', $customer->id)); ?>" class="btn btn-sm btn-link"><i class="material-icons icon-16pt">arrow_forward</i></a> </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
        <?php echo e($customers->links()); ?>

    </div>
<?php else: ?>
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">account_box</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4"><?php echo e(__('messages.no_customers_yet')); ?></p>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/customers/_table.blade.php ENDPATH**/ ?>