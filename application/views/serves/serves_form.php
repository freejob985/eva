<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">
            <?php
            if($this->permission->method('serves','create')->access() || $this->permission->method('serves','update')->access()){
            ?>
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("serves") ?>"> 
                        <i class="fa fa-list"></i>  
                        <?php echo display('serve_list') ?> 
                    </a>  
                </div>
            </div> 

            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open_multipart('serves/save','class="form-inner"') ?> 

                            <?php echo form_hidden('id', $serve->id) ?>

                            <div class="form-group row">
                                <label for="service_name" class="col-xs-3 col-form-label">
                                    <?php echo display('service_name') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="service_name" type="text" class="form-control" id="service_name" placeholder="<?php echo display('service_name') ?>" value="<?php echo $serve->service_name ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="branch_id" class="col-xs-3 col-form-label">
                                    <?php echo display('branch') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <select name="branch_id" class="form-control" id="branch_id">
                                        <?php foreach ($branches as $branch) { ?>
                                            <option value="<?php echo $branch->id ?>" <?php echo ($serve->branch_id == $branch->id) ? 'selected' : '' ?>><?php echo $branch->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="doctor_device_id" class="col-xs-3 col-form-label">
                                    <?php echo display('doctor_device') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <select name="doctor_device_id" class="form-control" id="doctor_device_id">
                                        <?php foreach ($doctors_devices as $doctor_device) { ?>
                                            <option value="<?php echo $doctor_device->id ?>" <?php echo ($serve->doctor_device_id == $doctor_device->id) ? 'selected' : '' ?>><?php echo $doctor_device->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="booking_date" class="col-xs-3 col-form-label">
                                    <?php echo display('booking_date') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="booking_date" type="date" class="form-control" id="booking_date" value="<?php echo $serve->booking_date ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="booking_time" class="col-xs-3 col-form-label">
                                    <?php echo display('booking_time') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="booking_time" type="time" class="form-control" id="booking_time" value="<?php echo $serve->booking_time ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="duration" class="col-xs-3 col-form-label">
                                    <?php echo display('duration') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="duration" type="number" class="form-control" id="duration" placeholder="<?php echo display('duration') ?>" value="<?php echo $serve->duration ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-xs-3 col-form-label">
                                    <?php echo display('price') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="price" type="text" class="form-control" id="price" placeholder="<?php echo display('price') ?>" value="<?php echo $serve->price ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="code" class="col-xs-3 col-form-label">
                                    <?php echo display('code') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="code" type="text" class="form-control" id="code" placeholder="<?php echo display('code') ?>" value="<?php echo $serve->code ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="discount_price" class="col-xs-3 col-form-label">
                                    <?php echo display('discount_price') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="discount_price" type="text" class="form-control" id="discount_price" placeholder="<?php echo display('discount_price') ?>" value="<?php echo $serve->discount_price ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <div class="ui buttons">
                                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                                        <div class="or"></div>
                                        <button class="ui positive button"><?php echo display('save') ?></button>
                                    </div>
                                </div>
                            </div>

                        <?php echo form_close() ?>

                    </div>
                </div>
            </div>
            <?php } else { ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4><?php echo display('you_do_not_have_permission_to_access_please_contact_with_administrator');?>.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
