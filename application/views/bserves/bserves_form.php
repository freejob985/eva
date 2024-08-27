<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">
            <?php
            if($this->permission->method('bserves','create')->access() || $this->permission->method('bserves','update')->access()){
            ?>
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("bserves") ?>"> 
                        <i class="fa fa-list"></i>  
                        Bserve List
                    </a>  
                </div>
            </div> 

            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open_multipart('bserves/save','class="form-inner"') ?> 

                            <?php echo form_hidden('id', $bserve->id) ?>

                            <div class="form-group row">
                                <label for="service_name" class="col-xs-3 col-form-label">
                                    Service Name <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="service_name" type="text" class="form-control" id="service_name" placeholder="Service Name" value="<?php echo $bserve->service_name ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="branch_id" class="col-xs-3 col-form-label">
                                    Branch <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <select name="branch_id" class="form-control" id="branch_id">
                                        <?php foreach ($branches as $branch) { ?>
                                            <option value="<?php echo $branch->id ?>" <?php echo ($bserve->branch_id == $branch->id) ? 'selected' : '' ?>><?php echo $branch->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="doctor_device_id" class="col-xs-3 col-form-label">
                                    Doctor Device <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <select name="doctor_device_id" class="form-control" id="doctor_device_id">
                                        <?php foreach ($doctors_devices as $doctor_device) { ?>
                                            <option value="<?php echo $doctor_device->user_id ?>" <?php echo ($bserve->doctor_device_id == $doctor_device->user_id) ? 'selected' : '' ?>><?php echo $doctor_device->firstname ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="booking_date" class="col-xs-3 col-form-label">
                                    Booking Date <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="booking_date" type="date" class="form-control" id="booking_date" value="<?php echo $bserve->booking_date ?>">
                                </div>
                            </div>

<div class="form-group row">
                                <label for="booking_date" class="col-xs-3 col-form-label">
                                    closing time <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="closing_time" type="time" class="form-control" id="closing_time" value="<?php echo $bserve->closing_time ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="booking_time" class="col-xs-3 col-form-label">
                                    Booking Time <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="booking_time" type="time" class="form-control" id="booking_time" value="<?php echo $bserve->booking_time ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="duration" class="col-xs-3 col-form-label">
                                    Duration <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="duration" type="number" class="form-control" id="duration" placeholder="Duration" value="<?php echo $bserve->duration ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-xs-3 col-form-label">
                                    Price <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="price" type="text" class="form-control" id="price" placeholder="Price" value="<?php echo $bserve->price ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="code" class="col-xs-3 col-form-label">
                                    Code <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="code" type="text" class="form-control" id="code" placeholder="Code" value="<?php echo $bserve->code ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="discount_price" class="col-xs-3 col-form-label">
                                    Discount Price <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="discount_price" type="text" class="form-control" id="discount_price" placeholder="Discount Price" value="<?php echo $bserve->discount_price ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <div class="ui buttons">
                                        <button type="reset" class="ui button">Reset</button>
                                        <div class="or"></div>
                                        <button class="ui positive button">Save</button>
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
                                <h4>You do not have permission to access. Please contact with administrator.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
