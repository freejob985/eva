<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">
            <?php
            if($this->permission->method('doctor_list','read')->access() || $this->permission->method('doctor_list','update')->access() || $this->permission->method('doctor_list','delete')->access()){ 
            ?>
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("doctor") ?>"> 
                        <i class="fa fa-list"></i>  
                        <?php echo display('doctor_list') ?> 
                    </a>  
                </div>
            </div> 
            <?php } ?>

            <?php
            if($this->permission->method('add_doctor','create')->access()){
            ?>
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                        <?php echo form_open_multipart('doctor/create','class="form-inner"') ?> 

                            <?php echo form_hidden('user_id',$doctor->user_id) ?>

                            <div class="form-group row">
                                <label for="firstname" class="col-xs-3 col-form-label">
                                    <?php echo display('first_name')?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="firstname" type="text" class="form-control" id="firstname" placeholder="<?php echo display('first_name')?>" value="<?php echo $doctor->firstname ?>" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lastname" class="col-xs-3 col-form-label">
                                    <?php echo display('last_name') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="lastname" type="text" class="form-control" id="lastname" placeholder="<?php echo display('last_name') ?>" value="<?php echo $doctor->lastname ?>" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-xs-3 col-form-label">
                                    <?php echo display('email') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="email" class="form-control" type="text" placeholder="<?php echo display('email') ?>" id="email"  value="<?php echo $doctor->email ?>">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="password" class="col-xs-3 col-form-label">
                                    <?php echo display('password') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="password" class="form-control" type="password" placeholder="<?php echo display('password') ?>" id="password" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="department_id" class="col-xs-3 col-form-label">
                                    <?php echo display('department') ?> 
                                </label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('department_id', $department_list, $doctor->department_id, 'class="form-control" id="department_id"') ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="branch_id" class="col-xs-3 col-form-label">
                                    Branch <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <select name="branch_id" class="form-control" id="branch_id">
                                        <?php foreach ($branches as $branch) { ?>
                                            <option value="<?php echo $branch->id ?>" <?php echo ($doctor->branch_id == $branch->id) ? 'selected' : '' ?>>
                                                <?php echo $branch->name ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="specialization_id" class="col-xs-3 col-form-label">
                                    Specialization <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <select name="specialization_id" class="form-control" id="specialization_id">
                                        <?php foreach ($specializations as $specialization) { ?>
                                            <option value="<?php echo $specialization->id ?>" <?php echo ($doctor->specialization_id == $specialization->id) ? 'selected' : '' ?>>
                                                <?php echo $specialization->name ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="service_id" class="col-xs-3 col-form-label">
                                    Service <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <select name="service_id" class="form-control" id="service_id">
                                        <?php foreach ($services as $service) { ?>
                                            <option value="<?php echo $service->id ?>" <?php echo ($doctor->service_id == $service->id) ? 'selected' : '' ?>>
                                                <?php echo $service->service_name ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <!-- if representative picture is already uploaded -->
                            <?php if(!empty($doctor->picture)) {  ?>
                            <div class="form-group row">
                                <label for="picturePreview" class="col-xs-3 col-form-label"></label>
                                <div class="col-xs-9">
                                    <img src="<?php echo base_url($doctor->picture) ?>" alt="Picture" class="img-thumbnail" />
                                </div>
                            </div>
                            <?php } ?>

                            <div class="form-group row">
                                <label for="picture" class="col-xs-3 col-form-label">
                                    <?php echo display('picture') ?>
                                </label>
                                <div class="col-xs-9">
                                    <input type="file" name="picture" id="picture" value="<?php echo $doctor->picture ?>">
                                    <input type="hidden" name="old_picture" value="<?php echo $doctor->picture ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date_of_birth" class="col-xs-3 col-form-label">
                                    <?php echo display('date_of_birth') ?>
                                </label>
                                <div class="col-xs-9">
                                    <input name="date_of_birth" class="dropdown-month-years form-control" type="text" placeholder="<?php echo display('date_of_birth') ?>" id="date_of_birth" value="<?php echo $doctor->date_of_birth ?>" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">
                                    <?php echo display('sex')?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <div class="form-check">
                                        <label class="radio-inline">
                                        <input type="radio" name="sex" value="Male" <?php echo  set_radio('sex', 'Male', TRUE); ?> ><?php echo display('male')?>
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="sex" value="Female" <?php echo  set_radio('sex', 'Female'); ?> ><?php echo display('female')?>
                                        </label> 
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="blood_group" class="col-xs-3 col-form-label">
                                    <?php echo display('blood_group') ?>
                                </label>
                                <div class="col-xs-9"> 
                                    <?php
                                        $bloodList = array( 
                                            ''   => display('select_option'),
                                            'A+' => 'A+',
                                            'A-' => 'A-',
                                            'B+' => 'B+',
                                            'B-' => 'B-',
                                            'O+' => 'O+',
                                            'O-' => 'O-',
                                            'AB+' => 'AB+',
                                            'AB-' => 'AB-'
                                        );
                                        echo form_dropdown('blood_group', $bloodList, $doctor->blood_group, 'class="form-control" id="blood_group" ');
                                    ?>
                                </div>
                            </div>

                             <div class="form-group row">
                                <label for="designation" class="col-xs-3 col-form-label">
                                    <?php echo display('designation') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="designation" type="text" class="form-control" id="designation" placeholder="<?php echo display('designation') ?>" >
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="address" class="col-xs-3 col-form-label">
                                    <?php echo display('address') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <textarea name="address" class="form-control"  placeholder="<?php echo display('address') ?>" maxlength="140" rows="7" id="address"></textarea>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="phone" class="col-xs-3 col-form-label">
                                    <?php echo display('phone') ?> 
                                </label>
                                <div class="col-xs-9">
                                    <input name="phone" class="form-control" type="number" placeholder="<?php echo display('phone') ?>" id="phone" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile" class="col-xs-3 col-form-label">
                                    <?php echo display('mobile') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <input name="mobile" class="form-control" type="number" placeholder="<?php echo display('mobile') ?>" id="mobile">
                                </div>
                            </div>

                             <div class="form-group row">
                                <label for="career_title" class="col-xs-3 col-form-label">
                                    <?php echo display('career_title') ?> <i class="text-danger">*</i>
                                </label>
                                <div class="col-xs-9">
                                    <textarea name="career_title" class="form-control" placeholder="<?= display('career_title')?>" id="career_title" maxlength="255" rows="5"></textarea>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="short_biography" class="col-xs-3 col-form-label">
                                    <?php echo display('short_biography') ?>
                                </label>
                                <div class="col-xs-9">
                                    <textarea name="short_biography" class="tinymce form-control" placeholder="Address" id="short_biography" rows="7"></textarea>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="specialist" class="col-xs-3 col-form-label">
                                    <?php echo display('specialist') ?>
                                </label>
                                <div class="col-xs-9">
                                    <input type="text" name="specialist" class="form-control" placeholder="<?php echo display('specialist') ?>" id="specialist" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="degree" class="col-xs-3 col-form-label">
                                    <?php echo display('education_degree') ?>
                                </label>
                                <div class="col-xs-9">
                                    <textarea name="degree" class="tinymce form-control" placeholder="<?php echo display('education_degree') ?>" id="degree" maxlength="140" rows="7"></textarea>
                                </div>
                            </div> 

                            <?php if(empty($doctor->user_id)){ ?>
                                <div class="form-group row">
                                    <label for="language" class="col-xs-3 col-form-label">
                                        <?php echo display('language_proficiency') ?>
                                    </label>
                                    <div class="col-xs-9">
                                        
                                        <table id="fixTable" class="table table-striped">
                                            <tbody id="languages">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php }?>
 
                            <div class="form-group row">
                                <label class="col-sm-3">
                                    <?php echo display('status') ?>
                                </label>
                                <div class="col-xs-9">
                                    <div class="form-check">
                                        <label class="radio-inline">
                                        <input type="radio" name="status" value="1" <?php echo  set_radio('status', '1', TRUE); ?> >
                                            <?php echo display('active') ?>
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="status" value="0" <?php echo  set_radio('status', '0'); ?> >
                                            <?php echo display('inactive') ?>
                                        </label>
                                    </div>
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
                        </form>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <?php 
            }
            else{
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
                <?php
            }
            ?>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

    // #-------ADD OR REMOVE LANGUAGE ITEM--------#
    var languages_html = "<tr>"+
    "<td><input name=\"name[]\" class=\"form-control\" type=\"text\" placeholder=\"<?php echo display('language').' '.display('name') ?>\"></td>"+
     "<td><input name=\"rating[]\" class=\"form-control rate\" type=\"number\" placeholder=\"<?= display('rating_out_of_10')?>\"><br><label ><input name=\"type[]\" type=\"checkbox\" value=\"Native\"> <?php echo display('native')?></label> <label><input name=\"type[]\" type=\"checkbox\" value=\"Fluent\"> <?php echo display('fluent')?></label> <label><input name=\"type[]\" type=\"checkbox\" value=\"Beginner\"> <?php echo display('beginner')?></label></td>"+
    "<td><div class=\"btn btn-group\">"+
        "<button type=\"button\" class=\"addMore btn btn-sm btn-success\">+</button>"+
        "<button type=\"button\" class=\"remove btn btn-sm btn-danger\">-</button>"+
    "</div></td>"+
    "</tr>";

    $("#languages").append(languages_html);
    $('body').on('click', '.addMore', function() {
        $("#languages").append(languages_html); 
    });


    $('body').on('click', '.remove', function() {
       $(this).parent().parent().parent().remove();
    });

    $('.rate').change(function() {
      var n = $('.rate').val();
      if (n > 10)
        $('.rate').val(1);
    });


     // show dropdown month name and previous years
    $( ".dropdown-month-years" ).datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        yearRange: "-90:+0"
     });
    
});
</script>
