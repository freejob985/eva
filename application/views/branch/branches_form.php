<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">
            <?php
            if ($this->permission->method('branches','create')->access() || $this->permission->method('branches','update')->access()) {
            ?>
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("branch") ?>"> 
                        <i class="fa fa-list"></i>  
                        <?php echo display('branch_list') ?> 
                    </a>  
                </div>
            </div> 

            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open_multipart('branch/save', 'class="form-inner"') ?> 

                            <?php echo form_hidden('id', $branch->id) ?>

                            <div class="form-group row">
                                <label for="name" class="col-xs-3 col-form-label">
                                    <?php echo display('branch_name') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="name" type="text" class="form-control" id="name" placeholder="<?php echo display('branch_name') ?>" value="<?php echo $branch->name ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-xs-3 col-form-label"><?php echo display('phone') ?></label>
                                <div class="col-xs-9">
                                    <input name="phone" type="text" class="form-control" id="phone" placeholder="<?php echo display('phone') ?>" value="<?php echo $branch->phone ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-xs-3 col-form-label"><?php echo display('address') ?></label>
                                <div class="col-xs-9">
                                    <textarea name="address" class="form-control" id="address" placeholder="<?php echo display('address') ?>"><?php echo $branch->address ?></textarea>
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
            <?php 
            } else { // Else part for if condition 
            ?>
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
