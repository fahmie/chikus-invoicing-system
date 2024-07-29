<div class="card card-form">
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color"><?php echo e(__('messages.customer_information')); ?></strong></p>
            <p class="text-muted"><?php echo e(__('messages.basic_customer_information')); ?></p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="display_name"><?php echo e(__('messages.display_name')); ?></label>
                        <input name="display_name" type="text" class="form-control" placeholder="<?php echo e(__('messages.display_name')); ?>" value="<?php echo e($customer->display_name); ?>" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group required">
                        <label for="contact_name"><?php echo e(__('messages.contact_name')); ?></label>
                        <input name="contact_name" type="text" class="form-control" placeholder="<?php echo e(__('messages.contact_name')); ?>" value="<?php echo e($customer->contact_name); ?>" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="email"><?php echo e(__('messages.email')); ?></label>
                        <input name="email" type="email" class="form-control" placeholder="<?php echo e(__('messages.email')); ?>" value="<?php echo e($customer->email); ?>" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="phone"><?php echo e(__('messages.phone')); ?></label>
                        <input name="phone" type="text" class="form-control" placeholder="<?php echo e(__('messages.phone')); ?>" value="<?php echo e($customer->phone); ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="currency_id"><?php echo e(__('messages.currency')); ?></label> 
                        <select name="currency_id" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="currency_id" required>
                            <option disabled selected><?php echo e(__('messages.select_currency')); ?></option>
                            <?php $__currentLoopData = get_currencies_select2_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($option['id']); ?>" <?php echo e($customer->currency_id == $option['id'] ? 'selected=""' : ''); ?>><?php echo e($option['text']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="website"><?php echo e(__('messages.website')); ?></label>
                        <input name="website" type="text" class="form-control" placeholder="<?php echo e(__('messages.website')); ?>" value="<?php echo e($customer->website); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color"><?php echo e(__('messages.billing_address')); ?></strong></p>
            <p class="text-muted"><?php echo e(__('messages.customer_billing_address')); ?></p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <p class="row"><strong class=" col headings-color"><?php echo e(__('messages.billing_address')); ?></strong></p>
            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="billing[name]"><?php echo e(__('messages.name')); ?></label>
                        <input name="billing[name]" type="text" class="form-control" placeholder="<?php echo e(__('messages.address_name')); ?>" value="<?php echo e($customer->billing->name); ?>" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="billing[phone]"><?php echo e(__('messages.phone')); ?></label>
                        <input name="billing[phone]" type="text" class="form-control" value="<?php echo e($customer->billing->phone); ?>" placeholder="<?php echo e(__('messages.phone')); ?>">
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
                                <option value="<?php echo e($option['id']); ?>" <?php echo e($customer->billing->country_id == $option['id'] ? 'selected=""' : ''); ?>><?php echo e($option['text']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="billing[state]"><?php echo e(__('messages.state')); ?></label>
                        <input name="billing[state]" type="text" class="form-control" value="<?php echo e($customer->billing->state); ?>" placeholder="<?php echo e(__('messages.state')); ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="billing[city]"><?php echo e(__('messages.city')); ?></label>
                        <input name="billing[city]" type="text" class="form-control" value="<?php echo e($customer->billing->city); ?>" placeholder="<?php echo e(__('messages.city')); ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="billing[zip]"><?php echo e(__('messages.postal_code')); ?></label>
                        <input name="billing[zip]" type="text" class="form-control" value="<?php echo e($customer->billing->zip); ?>" placeholder="<?php echo e(__('messages.postal_code')); ?>">
                    </div>
                </div>
            </div>

            <div class="form-group required">
                <label for="billing[address_1]"><?php echo e(__('messages.address')); ?></label>
                <textarea name="billing[address_1]" class="form-control" rows="2" placeholder="<?php echo e(__('messages.address')); ?>" required><?php echo e($customer->billing->address_1); ?></textarea>
            </div>
        </div>
    </div>

    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color"><?php echo e(__('messages.shipping_address')); ?></strong></p>
            <p class="text-muted"><?php echo e(__('messages.customer_shipping_address')); ?></p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <p class="row"><strong class=" col headings-color"><?php echo e(__('messages.shipping_address')); ?></strong></p>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="shipping[name]"><?php echo e(__('messages.name')); ?></label>
                        <input name="shipping[name]" type="text" class="form-control" value="<?php echo e($customer->shipping->name); ?>" placeholder="<?php echo e(__('messages.address_name')); ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="shipping[phone]"><?php echo e(__('messages.phone')); ?></label>
                        <input name="shipping[phone]" type="text" class="form-control" value="<?php echo e($customer->shipping->phone); ?>" placeholder="<?php echo e(__('messages.phone')); ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="shipping[country_id]"><?php echo e(__('messages.country')); ?></label>
                        <select id="shipping[country_id]" name="shipping[country_id]" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="shipping[country_id]">
                            <option disabled selected><?php echo e(__('messages.select_country')); ?></option>
                            <?php $__currentLoopData = get_countries_select2_array(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($option['id']); ?>" <?php echo e($customer->shipping->country_id == $option['id'] ? 'selected=""' : ''); ?>><?php echo e($option['text']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="shipping[state]"><?php echo e(__('messages.state')); ?></label>
                        <input name="shipping[state]" type="text" class="form-control" value="<?php echo e($customer->shipping->state); ?>" placeholder="<?php echo e(__('messages.state')); ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="shipping[city]"><?php echo e(__('messages.city')); ?></label>
                        <input name="shipping[city]" type="text" class="form-control" value="<?php echo e($customer->shipping->city); ?>" placeholder="<?php echo e(__('messages.city')); ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="shipping[zip]"><?php echo e(__('messages.postal_code')); ?></label>
                        <input name="shipping[zip]" type="text" class="form-control" value="<?php echo e($customer->shipping->zip); ?>" placeholder="<?php echo e(__('messages.postal_code')); ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="shipping[address_1]"><?php echo e(__('messages.address')); ?></label>
                <textarea name="shipping[address_1]" class="form-control" rows="2" placeholder="<?php echo e(__('messages.address')); ?>"><?php echo e($customer->shipping->address_1); ?></textarea>
            </div>

            <div class="form-group text-center mt-5">
                <button type="submit" class="btn btn-primary"><?php echo e(__('messages.save_customer')); ?></button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\chikus\resources\views/application/customers/_form.blade.php ENDPATH**/ ?>