<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">
            <?php
            if($this->permission->method('booking_services','create')->access() || $this->permission->method('booking_services','update')->access()){
            ?>
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("booking_services") ?>"> 
                        <i class="fa fa-list"></i>  
                        <?php echo display('booking_service_list') ?> 
                    </a>  
                </div>
            </div> 

            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open_multipart('booking_services/save','class="form-inner"') ?> 

                            <?php echo form_hidden('id', $booking_service->id) ?>

                            <div class="form-group row">
                                <label for="service_name" class="col-xs-3 col-form-label">
                                    <?php echo display('service_name') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="service_name" type="text" class="form-control" id="service_name" placeholder="<?php echo display('service_name') ?>" value="<?php echo $booking_service->service_name ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="branch_id" class="col-xs-3 col-form-label">
                                    <?php echo display('branch') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <select name="branch_id" class="form-control" id="branch_id">
                                        <?php foreach ($branches as $branch) { ?>
                                            <option value="<?php echo $branch->id ?>" <?php echo ($booking_service->branch_id == $branch->id) ? 'selected' : '' ?>><?php echo $branch->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="
