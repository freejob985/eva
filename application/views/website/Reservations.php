<?php
$this->load->database();
?>

<style>
div#appointment-form {
    background: #f4f5f7;
}
.tab-content {
    padding-top: 20px;
}
.tab-pane {
    display: none;
}
.tab-pane.active {
    display: block;
}
.form-error {
    color: red;
    font-size: 12px;
}

.nav-tabs .nav-link.active {
    background-color: #037d71;
    color: #fff;
    padding: 7px;
}
.tab-pane {
    padding: 20px;
    border-top: none;
}

/* New styles for icons and radio buttons */
.nav-tabs .nav-link {
    display: flex;
    align-items: center;
}

.nav-tabs .nav-link i {
    margin-right: 5px;
}

.payment-method-label {
    display: flex;
    align-items: center;
    cursor: pointer;
    padding: 5px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.payment-method-label img {
    width: 60px;
    margin-left: 10px;
}

.payment-method-radio {
    display: none;
}

.payment-method-radio:checked + .payment-method-label {
    background-color: #e6f7ff;
}
.appointment.text-center {
    display: none;
}
</style>

<style>
.time-row {
    display: flex;
    justify-content: flex-start;
    margin-bottom: 10px;
}

.time-slot {
    margin-right: 10px;
    display: inline-block;
}

.time-label {
    display: block;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    text-align: center;
    width: 60px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
}

.time-slot input[type="radio"] {
    display: none;
}

.time-slot input[type="radio"]:checked + .time-label {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}


.time-slot.booked {
    opacity: 0.5;
}

.booked-text {
    color: red;
    font-size: 0.8em;
    margin-left: 5px;
}

</style>


<div id="appointment-form" class="appointment-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 ">
                <div class="form-container">
                  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="step-1-tab" data-toggle="tab" href="#step-1" role="tab" aria-controls="step-1" aria-selected="true"><i class="fas fa-clipboard-list"></i> Service</a>
        <a class="nav-item nav-link" id="step-2-tab" data-toggle="tab" href="#step-2" role="tab" aria-controls="step-2" aria-selected="false"><i class="far fa-clock"></i> Time</a>
        <a class="nav-item nav-link" id="step-3-tab" data-toggle="tab" href="#step-3" role="tab" aria-controls="step-3" aria-selected="false"><i class="fas fa-user-edit"></i> Details</a>
        <a class="nav-item nav-link" id="step-4-tab" data-toggle="tab" href="#step-4" role="tab" aria-controls="step-4" aria-selected="false"><i class="fas fa-credit-card"></i> Payment</a>
    </div>
</nav>


                    <!-- Message & exception -->
                    <div class="col-sm-12">
                        <?php if ($this->session->flashdata('success') != null) {  ?>
                        <div class="alert alert-success"> 
                            <?php echo $this->session->flashdata('success'); ?> 
                        </div> 
                        <?php } ?>
                        
                        <?php if ($this->session->flashdata('exception') != null) {  ?>
                        <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('exception'); ?>
                        </div>
                        <?php } ?> 
                    </div>

<?= form_open_multipart('Home/add_patient_and_appointment','id="appointmentForm"', 'method="post"') ?> 

                    <div class="tab-content" id="nav-tabContent">
                        <!-- Step 1: Service -->
                        <div class="tab-pane active" id="step-1" role="tabpanel" aria-labelledby="step-1-tab">
                            <div class="form-group">
                                <label>Department Name *</label>
                                <?php echo form_dropdown('department_id',$department_list,'','class="form-control basic-single" id="departmentId" required') ?>
                                <span class="form-error" id="departmentError"></span>
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
    <span class="form-error" id="branchError"></span>
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
    <span class="form-error" id="serves_id"></span>
</div>



<div class="form-group">
    <label><?= display('doctor_name')?>*</label>
    <?php echo form_dropdown('doctor_id', [], '', 'class="form-control basic-single" id="doctorId" required') ?>
    <span class="form-error" id="doctorError"></span>
</div>



                            <button type="button" class="btn btn-primary" id="nextStep1">Next</button>
                        </div>

                        <!-- Step 2: Time -->
                   <!-- Step 2: Time -->
<div class="tab-pane" id="step-2" role="tabpanel" aria-labelledby="step-2-tab">
    <!-- <div class="form-group">
        <label>Appointment Date *</label>
        <input type="text" class="form-control datepicker" name="date" id="date1" placeholder="Appointment Date" autocomplete="off" required>
        <span class="form-error" id="dateError"></span>
    </div> -->
    <div class="form-group">
        <label>Available Booking Times *</label>
          <div id="availableTimesContainer"></div>

    </div>
    <button type="button" class="btn btn-secondary" id="prevStep2">Previous</button>
    <button type="button" class="btn btn-primary" id="nextStep2">Next</button>
</div>


                        <!-- Step 3: Details -->
                        <div class="tab-pane" id="step-3" role="tabpanel" aria-labelledby="step-3-tab">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>First Name *</label>
                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" required>
                                    <span class="form-error" id="firstNameError"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Last Name *</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" required>
                                    <span class="form-error" id="lastNameError"></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Email Address *</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
                                    <span class="form-error" id="emailError"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Phone No</label>
                                    <input type="tel" class="form-control" name="mobile" id="phone" placeholder="Phone No">
                                    <span class="form-error" id="phoneError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>birthday *</label>
                                <input type="date" class="form-control" name="date_of_birth" id="birthday" required>
                                <span class="form-error" id="serialError"></span>
                            </div>
                            <!-- <div class="form-group">
                                <label>Serial No *</label>
                                <input type="text" class="form-control" name="serial_no" id="serialNo" required>
                                <span class="form-error" id="serialError"></span>
                            </div> -->
                            <div class="form-group">
                                <label>Problem</label>
                                <textarea class="form-control" name="problem" id="problem1" rows="3"></textarea>
                            </div>
                            <button type="button" class="btn btn-secondary" id="prevStep3">Previous</button>
                            <button type="button" class="btn btn-primary" id="nextStep3">Next</button>
                        </div>

<div class="tab-pane fade" id="step-4" role="tabpanel" aria-labelledby="step-4-tab">
    <div class="form-group">
        <label>Method of Payment *</label>
        <div>
            <input class="payment-method-radio" type="radio" name="payment_method" id="payOnDelivery" value="pay_on_delivery" checked>
            <label class="payment-method-label" for="payOnDelivery">
                Pay on Delivery
                <img src="https://img.freepik.com/premium-vector/cash-delivery_569841-143.jpg" alt="Pay on Delivery">
            </label>
        </div>
        <div>
            <input class="payment-method-radio" type="radio" name="payment_method" id="payPal" value="paypal">
            <label class="payment-method-label" for="payPal">
                PayPal
                <img src="https://imagedelivery.net/6Fk5TIReezmxFLHacB1A6g/07cca6d5-772f-470e-066c-9f2340c96800/public" alt="PayPal">
            </label>
        </div>
    </div>
    <button type="button" class="btn btn-secondary" id="prevStep4">Previous</button>
    <button type="submit" class="btn btn-primary" >Finish</button>
</div>

                    </div>

                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Include Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Include Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Include Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>





<script type="text/javascript">
$(document).ready(function() {
    function validateStep1() {
        var valid = true;
        if ($('#departmentId').val() === '') {
            $('#departmentError').text('Department Name is required.');
            valid = false;
        } else {
            $('#departmentError').text('');
        }
        if ($('#branchId').val() === '') {
            $('#branchError').text('Branch is required.');
            valid = false;
        } else {
            $('#branchError').text('');
        }
        if ($('#serves').val() === '') {
            $('#servesError').text('Serves is required.');
            valid = false;
        } else {
            $('#servesError').text('');
        }
        if ($('#doctor_id').val() === '') {
            $('#doctorError').text('Doctor Name is required.');
            valid = false;
        } else {
            $('#doctorError').text('');
        }
        return valid;
    }

    function validateStep2() {
        var valid = true;
        if ($('#date1').val() === '') {
            $('#dateError').text('Appointment Date is required.');
            valid = false;
        } else {
            $('#dateError').text('');
        }
        return valid;
    }

    function validateStep3() {
        var valid = true;
        if ($('#firstname').val() === '') {
            $('#firstNameError').text('First Name is required.');
            valid = false;
        } else {
            $('#firstNameError').text('');
        }
        if ($('#lastname').val() === '') {
            $('#lastNameError').text('Last Name is required.');
            valid = false;
        } else {
            $('#lastNameError').text('');
        }
        if ($('#email').val() === '') {
            $('#emailError').text('Email is required.');
            valid = false;
        } else {
            $('#emailError').text('');
        }
        if ($('#serialNo').val() === '') {
            $('#serialError').text('Serial No is required.');
            valid = false;
        } else {
            $('#serialError').text('');
        }
        return valid;
    }

    function goToStep(step) {
        $('.nav-tabs .nav-item').removeClass('active');
        $('.tab-pane').removeClass('active show');
        $('#step-' + step + '-tab').addClass('active');
        $('#step-' + step).addClass('active show');
    }

    $('#nextStep1').click(function() {
        if (validateStep1()) {
            goToStep(2);
        }
    });

    $('#nextStep2').click(function() {
        if (validateStep2()) {
            goToStep(3);
        }
    });

    $('#nextStep3').click(function() {
        if (validateStep3()) {
            goToStep(4);
        }
    });

    $('#prevStep2').click(function() {
        goToStep(1);
    });

    $('#prevStep3').click(function() {
        goToStep(2);
    });

    $('#prevStep4').click(function() {
        goToStep(3);
    });

    //check patient id
    $('#patient_id').keyup(function(){
        var pid = $(this);

        $.ajax({
            url  : '<?= base_url('website/appointment/check_patient/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                patient_id : pid.val()
            },
            success : function(data) 
            {
                if (data.status == true) {
                    pid.next().text(data.message).addClass('text-success').removeClass('text-danger');
                } else if (data.status == false) {
                    pid.next().text(data.message).addClass('text-danger').removeClass('text-success');
                } else {
                    pid.next().text(data.message).addClass('text-danger').removeClass('text-success');
                }
            }, 
            error : function()
            {
                alert('failed');
            }
        });
    });
 
    //department_id
    $("#department_id").change(function(){
        var output = $('.doctor_error'); 
        var doctor_list = $('#doctor_id');
        var available_day = $('#available_day');

        $.ajax({
            url  : '<?= base_url('website/appointment/doctor_by_department/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                department_id : $(this).val()
            },
            success : function(data) 
            {
                if (data.status == true) {
                    doctor_list.html(data.message);
                    available_day.html(data.available_days);
                    output.html('');
                } else if (data.status == false) {
                    doctor_list.html('');
                    output.html(data.message).addClass('text-danger').removeClass('text-success');
                } else {
                    doctor_list.html('');
                    output.html(data.message).addClass('text-danger').removeClass('text-success');
                }
            }, 
            error : function()
            {
            //    alert('failed');
            }
        });
    }); 

    //doctor_id
    $("#doctor_id").change(function(){
        var doctor_id = $('#doctor_id'); 
        var output = $('#available_days'); 

        $.ajax({
            url  : '<?= base_url('website/appointment/schedule_day_by_doctor/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                doctor_id : $(this).val()
            },
            success : function(data) 
            {
                if (data.status == true) {
                    output.html(data.message).addClass('text-success').removeClass('text-danger');
                } else if (data.status == false) {
                    output.html(data.message).addClass('text-danger').removeClass('text-success');
                } else {
                    output.html(data.message).addClass('text-danger').removeClass('text-success');
                }
            }, 
            error : function()
            {
                alert('failed');
            }
        });
    });

    //date
    $("#date").change(function(){
        var date        = $('#date'); 
        var serial_preview   = $('#serial_preview'); 
        var doctor_id   = $('#doctor_id'); 
        var schedule_id = $("#schedule_id"); 
        var patient_id  = $("#patient_id"); 
 
        $.ajax({
            url  : '<?= base_url('website/appointment/serial_by_date/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                doctor_id  : doctor_id.val(),
                patient_id : patient_id.val(), 
                date : $(this).val()
            },
            success : function(data) 
            { 
                if (data.status == true) {
                    //set schedule id
                    schedule_id.val(data.schedule_id); 
                    serial_preview.html(data.message);
                } else if (data.status == false) {
                    schedule_id.val('');
                    serial_preview.html(data.message).addClass('text-danger').removeClass('text-success');
                } else {
                    schedule_id.val('');
                    serial_preview.html(data.message).addClass('text-danger').removeClass('text-success');
                }
            }, 
            error : function()
            {
                alert('failed');
            }
        });
    });

    //======for new patient appointment======//
    //department_id
    $("#departmentId").change(function(){
        var output = $('.doctorError'); 
        var doctor_list = $('#doctorId');
        var available_day = $('#availableDay');

        $.ajax({
            url  : '<?= base_url('website/appointment/doctor_by_department/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                department_id : $(this).val()
            },
            success : function(data) 
            {
                if (data.status == true) {
                    doctor_list.html(data.message);
                    available_day.html(data.available_days);
                    output.html('');
                } else if (data.status == false) {
                    doctor_list.html('');
                    output.html(data.message).addClass('text-danger').removeClass('text-success');
                } else {
                    doctor_list.html('');
                    output.html(data.message).addClass('text-danger').removeClass('text-success');
                }
            }, 
            error : function()
            {
                alert('failed');
            }
        });
    }); 

     //doctor_id

    //serial_no 
    $("body").on('click','.serial_no',function(){
        var serial_no = $(this).attr('data-item');
        $("#serial_no").val(serial_no);
        $("#serialNo").val(serial_no);
        $('.serial_no').removeClass('btn-danger').addClass('btn-primary').not(".disabled");
        $(this).removeClass('btn-primary').addClass('btn-danger').not(".disabled");
    });

    $( ".datepicker-avaiable-days" ).datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        showButtonPanel: false,
        minDate: 0,  
        // beforeShowDay: DisableDays 
     });

    // for search input field show hide
    if(document.getElementById('customCheck2').checked) {
    $("#txtSearch").show();
    } else {
        $("#txtSearch").hide();
    }

    $('#customCheck2').click(function() {
      $("#txtSearch").toggle(this.checked);
    });

    //search patient by full name or mobile number
    $('#textSearch').keyup(function(){
        var search = $(this).val();
        //alert(search);
        $.ajax({
            url  : '<?= base_url('website/appointment/search_patient/') ?>',
            type : 'post',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                query : search
            },
            success : function(data) 
            {
                //alert(data);
                $('#valid_patient').html(data);
            }, 
        });
    });

});

// patient id throw in patient field
function patientInfo(id){
     $(".patient").val(id);
}
</script>
<script>
$(document).ready(function() {
    function validateStep1() {
        var valid = true;
        if ($('#departmentId').val() === '') {
            $('#departmentError').text('Department Name is required.');
            valid = false;
        } else {
            $('#departmentError').text('');
        }
        if ($('#branchId').val() === '') {
            $('#branchError').text('Branch is required.');
            valid = false;
        } else {
            $('#branchError').text('');
        }
        if ($('#serves').val() === '') {
            $('#servesError').text('Serves is required.');
            valid = false;
        } else {
            $('#servesError').text('');
        }
        if ($('#doctor_id').val() === '') {
            $('#doctorError').text('Doctor Name is required.');
            valid = false;
        } else {
            $('#doctorError').text('');
        }
        return valid;
    }

    function validateStep2() {
        var valid = true;
        if ($('#date1').val() === '') {
            $('#dateError').text('Appointment Date is required.');
            valid = false;
        } else {
            $('#dateError').text('');
        }
        return valid;
    }

    function validateStep3() {
        var valid = true;
        if ($('#firstname').val() === '') {
            $('#firstNameError').text('First Name is required.');
            valid = false;
        } else {
            $('#firstNameError').text('');
        }
        if ($('#lastname').val() === '') {
            $('#lastNameError').text('Last Name is required.');
            valid = false;
        } else {
            $('#lastNameError').text('');
        }
        if ($('#email').val() === '') {
            $('#emailError').text('Email is required.');
            valid = false;
        } else {
            $('#emailError').text('');
        }
        if ($('#serialNo').val() === '') {
            $('#serialError').text('Serial No is required.');
            valid = false;
        } else {
            $('#serialError').text('');
        }
        return valid;
    }

    function goToStep(step) {
        $('.nav-tabs .nav-item').removeClass('active');
        $('.tab-pane').removeClass('active show');
        $('#step-' + step + '-tab').addClass('active');
        $('#step-' + step).addClass('active show');
    }

    $('#nextStep1').click(function() {
        if (validateStep1()) {
            goToStep(2);
        }
    });

    $('#nextStep2').click(function() {
        if (validateStep2()) {
            goToStep(3);
        }
    });

    $('#nextStep3').click(function() {
        if (validateStep3()) {
            goToStep(4);
        }
    });

    $('#prevStep2').click(function() {
        goToStep(1);
    });

    $('#prevStep3').click(function() {
        goToStep(2);
    });

    $('#prevStep4').click(function() {
        goToStep(3);
    });

    // Rest of your existing JavaScript code...

    // Initialize datepicker
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        showButtonPanel: false,
        minDate: 0
    });

    // Form submission
    $('#appointmentForm').submit(function(e) {
        e.preventDefault();
        if (validateStep1() && validateStep2() && validateStep3()) {
            // Perform form submission
            this.submit();
        } else {
            alert('Please fill all required fields correctly.');
        }
    });
});
</script>

<script>
$(document).ready(function() {
    // Function to filter doctors based on selected fields
    function filterDoctors() {
        var branchId = $('#branchId').val();
        var servesId = $('#serves').val();
        $.ajax({
            url: '<?= base_url('home/filter_doctors') ?>',
            type: 'POST',
            dataType: 'JSON',
            data: {
                branchId: branchId,
                servesId: servesId
            },
            success: function(data) {
                console.log(data);

                // Clear previous errors
                $('#branchError').text('');
                $('#servesError').text('');
                $('#doctorError').text('');

                if (data.status === true) {
                    $('#doctorId').html(data.doctors);
                } else if (data.errors) {
                    if (data.errors.branch) {
                        $('#branchError').text(data.errors.branch);
                    }
                    if (data.errors.serves) {
                        $('#servesError').text(data.errors.serves);
                    }
                    if (data.errors.doctor) {
                        $('#doctorError').text(data.errors.doctor);
                    }
                }
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error:", {
                    xhr: xhr, 
                    status: status, 
                    error: error
                });
                alert('Failed to filter doctors.');
            }
        });
    }

    // Trigger the filter function when any of the two fields change
    $('#branchId, #serves').change(function() {
        filterDoctors();
    });
});

</script>

<script type="text/javascript">
$(document).ready(function() {
    // عند تغيير الخدمة المختارة
    $('#serves').change(function() {
        var servesId = $(this).val();

        if (servesId) {
            $.ajax({
                url: '<?= base_url('home/get_service_details') ?>',
                type: 'POST',
                data: { serves_id: servesId },
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        // عرض الأوقات المتاحة في الحقل المحدد
                        $('#availableTimesContainer').html(response.available_times.join('<br>'));
                    } else {
                      //  alert(response.message);
                        $('#serves_id').html("There are no appointments available for this service.");



                    }
                },
                error: function(xhr, status, error) {
                    console.log("AJAX Error:", {
                        xhr: xhr,
                        status: status,
                        error: error
                    });
               //     alert('Failed to fetch service details.');
                }
            });
        } else {
            // Clear the available times if no service is selected
            $('#availableTimesContainer').html('');
        }
    });
});
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>


<script>
    // تهيئة مكتبة intl-tel-input
    var input = document.querySelector("#phone");
    var iti = window.intlTelInput(input, {
        initialCountry: "auto", // تلقائياً يستخدم بلد المستخدم
        geoIpLookup: function(callback) {
            fetch('https://ipinfo.io/json')
                .then(response => response.json())
                .then(data => callback(data.country))
                .catch(() => callback('us'));
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });
</script>

