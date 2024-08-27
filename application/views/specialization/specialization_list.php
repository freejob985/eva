<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">
            <?php if($this->permission->method('specialization','create')->access()) { ?>
            <div class="panel-heading no-print">
                <div class="btn-group">
                    <a class="btn btn-success" href="<?php echo base_url("specialization/create") ?>"> 
                        <i class="fa fa-plus"></i> 
                        Add Specialization 
                    </a>
                </div>
            </div>
            <?php } ?>

            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Specialization Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($specializations)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($specializations as $specialization) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $specialization->name; ?></td>
                                    <td><?php echo $specialization->description; ?></td>
                                    <td class="center">
                                        <a href="<?php echo base_url("specialization/edit/$specialization->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo base_url("specialization/delete/$specialization->id") ?>" onclick="return confirm('Are you sure?')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?>
                        <?php } ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
