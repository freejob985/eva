<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">
            <?php if($this->permission->method('serves','create')->access()) { ?>
            <div class="panel-heading no-print">
                <div class="btn-group">
                    <a class="btn btn-success" href="<?php echo base_url("serves/create") ?>"> 
                        <i class="fa fa-plus"></i> 
                        <?php echo display('add_serve') ?> 
                    </a>
                </div>
            </div>
            <?php } ?>

            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('service_name') ?></th>
                            <th><?php echo display('branch') ?></th>
                            <th><?php echo display('doctor_device') ?></th>
                            <th><?php echo display('booking_date') ?></th>
                            <th><?php echo display('booking_time') ?></th>
                            <th><?php echo display('duration') ?></th>
                            <th><?php echo display('price') ?></th>
                            <th><?php echo display('discount_price') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($serves)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($serves as $serve) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $serve->service_name; ?></td>
                                    <td><?php echo $serve->branch_name; ?></td>
                                    <td><?php echo $serve->doctor_device_name; ?></td>
                                    <td><?php echo $serve->booking_date; ?></td>
                                    <td><?php echo $serve->booking_time; ?></td>
                                    <td><?php echo $serve->duration; ?></td>
                                    <td><?php echo $serve->price; ?></td>
                                    <td><?php echo $serve->discount_price; ?></td>
                                    <td class="center">
                                        <a href="<?php echo base_url("serves/edit/$serve->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo base_url("serves/delete/$serve->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
