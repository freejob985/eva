<!-- ==================================================================================== -->
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <h2 class="semibold"><span><?= display('1')?></span><?= display('provide_your_primary_information_about_the_following_details')?></h2> 
                           <?= form_open_multipart('website/appointment/new_patient','id="appointmentForm"') ?> 
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label><?= display('first_name')?>*</label>
                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="<?= display('first_name')?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><?= display('last_name')?>*</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="<?= display('last_name')?>" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label><?= display('email')?>*</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="<?= display('email')?>" required>
                                    <label><?= display('please_provide_a_valid_email')?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><?= display('phone')?></label>
                                    <input type="text" class="form-control" name="mobile" id="phone1" placeholder="<?= display('phone')?>" required>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label> <?= display('department_name')?> *</label>
                                <?php echo form_dropdown('department_id',$department_list,'','class="form-control basic-single" id="departmentId"') ?>
                                <span class="doctorError"></span>
                            </div>

<div class="form-group">
    <label> Branch *</label>
    <?php
        $query = $this->db->get('branches');
        $branches = $query->result();
        
        $branch_options = array('' => 'Select Branch');
        foreach ($branches as $branch) {
            $branch_options[$branch->id] = $branch->name;
        }
        
        echo form_dropdown('branch_id', $branch_options, '', 'class="form-control basic-single" id="branchId"');
    ?>
    <span class="doctorError"></span>
</div>



<div class="form-group">
    <label> serves *</label>
    <?php
        $query = $this->db->get('bserves');
        $bserves = $query->result();
        
        $branch_options = array('' => 'Select serves');
        foreach ($bserves as $branch) {
            $branch_options[$branch->id] = $branch->service_name;
        }
        
        echo form_dropdown('serves_id', $branch_options, '', 'class="form-control basic-single" id="serves"');
    ?>
    <span class="doctorError"></span>
</div>









                            <h2 class="semibold"><span><?= display('2')?></span> <?= display('help_us_with_accurate_information_about_the_following_details')?></h2> 
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label> <?= display('doctor_name')?>*</label>
                                        <?php echo form_dropdown('doctor_id','','','class="form-control basic-single" id="doctorId"') ?>
                                     <p class="help-block" id="availableDays"></p>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><?= display('appointment_date')?> *</label>
                                    <input type="text" class="form-control datepicker" name="date" id="date1" placeholder="<?= display('appointment_date')?>" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label><?php echo display('serial_no') ?> <i class="text-danger">*</i></label>
                                <div id="serialPreview">
                                    <div class="btn btn-success disabled btn-sm"> 01</div>
                                    <div class="btn btn-success disabled btn-sm"> 02</div>
                                    <div class="btn btn-success disabled btn-sm"> 03</div>...
                                    <div class="slbtn btn btn-success disabled btn-sm"> N</div>

                                </div>
                                <input type="hidden" name="schedule_id" id="scheduleId"/>
                                <input type="hidden" name="serial_no" id="serialNo"/>
                            </div>

                            <div class="form-group">
                                <label><?= display('problem')?></label>
                                <textarea class="form-control" name="problem" id="problem1" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" required>
                                    <label class="custom-control-label" for="customCheck1"><?= display('i_consent_to_having_this_website_store_my_submitted_information_so_they_can_respond_to_my_inquiry')?></label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary"><?= display('book_appointment')?></button>
                           <?= form_close() ?>
                        </div>
                        
                        <!--  -->
                    </div>
<!-- ==================================================================================== -->