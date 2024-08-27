<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">
            <?php if($this->permission->method('specialization','create')->access() || $this->permission->method('specialization','update')->access()){ ?>
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("specialization") ?>"> 
                        <i class="fa fa-list"></i>  
                        Specialization List
                    </a>  
                </div>
            </div> 

            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open('specialization/save','class="form-inner"') ?> 

                            <?php echo form_hidden('id', $specialization->id) ?>

                            <div class="form-group row">
                                <label for="name" class="col-xs-3 col-form-label">
                                    Specialization Name <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="name" type="text" class="form-control" id="name" placeholder="Specialization Name" value="<?php echo $specialization->name ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-xs-3 col-form-label">
                                    Description
                                </label>
                                <div class="col-xs-9">
                                    <textarea name="description" class="form-control" id="description" placeholder="Description"><?php echo $specialization->description ?></textarea>
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
