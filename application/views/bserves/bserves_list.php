<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">
            <?php if($this->permission->method('bserves','create')->access()) { ?>
            <div class="panel-heading no-print">
                <div class="btn-group">
                    <a class="btn btn-success" href="<?php echo base_url("bserves/create") ?>"> 
                        <i class="fa fa-plus"></i> 
                        <?php echo display('add_bserve') ?> 
                    </a>
                </div>
            </div>
            <?php } ?>

            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
    <th>Serial</th>
    <th>Service Name</th>
    <th>Branch</th>
    <th>Doctor Device</th>
    <th>Booking Date</th>
    <th>Booking Time</th>
    <th>Duration</th>
    <th>Price</th>
    <th>Discount Price</th>
    <th>Action</th>
</tr>

                    </thead>
              <tbody>
    <?php if (!empty($bserves)) { ?>
        <?php $sl = 1; ?>
        <?php foreach ($bserves as $bserve) { ?>
            <tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>">
                <td><?php echo $sl; ?></td>
                <td><?php echo $bserve->service_name; ?></td>
                <td><?php echo $bserve->branch_name; ?></td>
                <td><?php echo $bserve->doctor_device_name; ?></td>
                <td><?php echo $bserve->booking_date; ?></td>
                <td><?php echo $bserve->booking_time; ?></td>
                <td><?php echo $bserve->duration; ?></td>
                <td><?php echo $bserve->price; ?></td>
                <td><?php echo $bserve->discount_price; ?></td>
                <td class="center">
                    <a href="<?php echo base_url("bserves/edit/$bserve->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                    <a href="<?php echo base_url("bserves/delete/$bserve->id") ?>" onclick="return confirm('Are you sure?')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
