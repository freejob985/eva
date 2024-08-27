<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">
            <?php if($this->permission->method('branches','create')->access()) { ?>
            <div class="panel-heading no-print">
                <div class="btn-group">
                    <a class="btn btn-success" href="<?php echo base_url("branch/create") ?>"> <i class="fa fa-plus"></i> <?php echo display('add_branch') ?> </a>
                </div>
            </div>
            <?php } ?>

            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('branch_name') ?></th>
                            <th><?php echo display('phone') ?></th>
                            <th><?php echo display('address') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($branches)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($branches as $branch) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $branch->name; ?></td>
                                    <td><?php echo $branch->phone; ?></td>
                                    <td><?php echo $branch->address; ?></td>
                                    <td class="center">
                                        <a href="<?php echo base_url("branch/edit/$branch->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo base_url("branch/delete/$branch->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
