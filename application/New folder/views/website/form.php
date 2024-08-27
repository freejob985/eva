<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حجز موعد</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
    <style>
        .step {
            display: none;
            color: white;
        }
        .step.active {
            display: grid;
            gap: 20px;
        }
        .step.flex-active {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .input-field {
            width: 100%;
        }
        .full-width {
            grid-column: 1 / -1;
        }
        .buttons {
            margin-top: 20px;
        }
        .tabs {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            background-color: #dc7f9d;
            margin-bottom: 20px;
        }
        .tab {
            text-align: center;
            padding: 10px;
            cursor: pointer;
            border: 1px solid #ccc;
            color: white;
        }
        .tab.active {
            background-color: #ccc;
        }
        .tab i {
            margin-right: 5px;
        }
        .time-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .time-box {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
            cursor: pointer;
        }
        .time-box.selected {
            background-color: #dc7f9d;
        }
        .details-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        select#branch, select#service, select#doctor {
            width: 100%;
        }
        .error {
            color: red;
            font-size: 0.8em;
        }
    </style>
</head>
<body>
   <form id="multiStepForm" action="<?php echo site_url('Appointment/submit_appointment'); ?>" method="post">
        <div class="tabs">
            <span class="tab active"><i class="fas fa-hospital-user"></i> الخدمة</span>
            <span class="tab"><i class="fas fa-clock"></i> وقت</span>
            <span class="tab"><i class="fas fa-user-edit"></i> تفاصيل</span>
            <span class="tab"><i class="fas fa-credit-card"></i> طرق الدفع</span>
            <span class="tab"><i class="fas fa-check-circle"></i> تم</span>
        </div>

        <div class="step active">
            <div class="input-field">
                <label for="branch">الفرع:</label>
                <select id="branch" name="branch" required>
                    <option value="">اختر الفرع</option>
                    <option value="branch1">فرع 1</option>
                    <option value="branch2">فرع 2</option>
                    <option value="branch3">فرع 3</option>
                </select>
                <?php echo form_error('branch', '<div class="error">', '</div>'); ?>
            </div>
            <div class="input-field">
                <label for="service">الخدمة:</label>
                <select id="service" name="service" required>
                    <option value="">اختر الخدمة</option>
                    <option value="service1">خدمة 1</option>
                    <option value="service2">خدمة 2</option>
                    <option value="service3">خدمة 3</option>
                </select>
                <?php echo form_error('service', '<div class="error">', '</div>'); ?>
            </div>
            <div class="input-field">
                <label for="doctor">الطبيب:</label>
                <select id="doctor" name="doctor" required>
                    <option value="">اختر الطبيب</option>
                    <option value="doctor1">طبيب 1</option>
                    <option value="doctor2">طبيب 2</option>
                    <option value="doctor3">طبيب 3</option>
                </select>
                <?php echo form_error('doctor', '<div class="error">', '</div>'); ?>
            </div>
        </div>

        <div class="step">
            <h2>وقت</h2>
            <div class="time-grid">
                <div class="time-box" onclick="selectTime(this)">
                    <i class="fas fa-clock"></i>
                    <span>10:15 ص</span>
                </div>
                <div class="time-box" onclick="selectTime(this)">
                    <i class="fas fa-clock"></i>
                    <span>11:15 ص</span>
                </div>
                <div class="time-box" onclick="selectTime(this)">
                    <i class="fas fa-clock"></i>
                    <span>12:15 م</span>
                </div>
            </div>
            <input type="hidden" id="appointment_time" name="appointment_time" required>
            <?php echo form_error('appointment_time', '<div class="error">', '</div>'); ?>
        </div>

        <div class="step">
            <div class="details-grid">
                <div class="input-field">
                    <label for="fullName">الاسم الكامل:</label>
                    <input type="text" id="fullName" name="fullName" required>
                    <?php echo form_error('fullName', '<div class="error">', '</div>'); ?>
                </div>
                <div class="input-field">
                    <label for="phone">الهاتف/ واتس اب:</label>
                    <input type="tel" id="phone" name="phone" required>
                    <?php echo form_error('phone', '<div class="error">', '</div>'); ?>
                </div>
                <div class="input-field">
                    <label for="email">البريد الإلكتروني:</label>
                    <input type="email" id="email" name="email" required>
                    <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                </div>
                <div class="input-field">
                    <label for="birthday">عيد الميلاد:</label>
                    <input type="date" id="birthday" name="birthday" required>
                    <?php echo form_error('birthday', '<div class="error">', '</div>'); ?>
                </div>
            </div>
            <div class="full-width">
                <label for="notes">ملاحظات:</label>
                <textarea id="notes" name="notes" class="full-width"></textarea>
            </div>
        </div>

        <div class="step">
            <div class="full-width">
                <h2 style="color: white;">طرق الدفع</h2>
                <label><input type="radio" name="payment" value="local" required> الدفع محلياً</label>
                <?php echo form_error('payment', '<div class="error">', '</div>'); ?>
            </div>
        </div>

        <div class="step">
            <div class="full-width">
                <h2 style="color: white;">تم</h2>
                <p>شكرًا لك على تقديم التفاصيل الخاصة بك. سنقوم بالاتصال بك قريبًا.</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
        </div>

        <div class="buttons">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">السابق</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">التالي</button>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
    var currentStep = 0;
    showStep(currentStep);

    function showStep(n) {
        var steps = document.getElementsByClassName("step");
        var tabs = document.getElementsByClassName("tab");
        for (var i = 0; i < steps.length; i++) {
            steps[i].style.display = "none";
            steps[i].classList.remove("active");
            steps[i].classList.remove("flex-active");
            tabs[i].className = tabs[i].className.replace(" active", "");
        }
        if (n == 0) {
            steps[n].classList.add("flex-active");
        } else {
            steps[n].classList.add("active");
        }
        steps[n].style.display = "grid";
        tabs[n].className += " active";

        document.getElementById("prevBtn").style.display = (n == 0) ? "none" : "inline";
        document.getElementById("nextBtn").innerHTML = (n == steps.length - 1) ? "إرسال" : "التالي";
    }

    function nextPrev(n) {
        var steps = document.getElementsByClassName("step");
        if (n == 1 && !validateForm()) return false;
        steps[currentStep].style.display = "none";
        currentStep = currentStep + n;
        if (currentStep >= steps.length) {
            document.getElementById("multiStepForm").submit();
            return false;
        }
        showStep(currentStep);
    }

    function validateForm() {
        var valid = true;
        var x = document.getElementsByClassName("step")[currentStep];
        var y = x.querySelectorAll("input[required], textarea[required], select[required]");
        for (var i = 0; i < y.length; i++) {
            if (y[i].value == "") {
                y[i].className += " invalid";
                valid = false;
            } else {
                y[i].className = y[i].className.replace(" invalid", "");
            }
        }
        if (!valid) {
            alert("الرجاء ملء جميع الحقول المطلوبة.");
        }
        return valid;
    }

    function selectTime(element) {
        var timeBoxes = document.getElementsByClassName("time-box");
        for (var i = 0; i < timeBoxes.length; i++) {
            timeBoxes[i].classList.remove("selected");
        }
        element.classList.add("selected");
        document.getElementById('appointment_time').value = element.querySelector('span').innerText;
    }

    // Initialize phone input
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        initialCountry: "sa", // Set initial country to Saudi Arabia
        separateDialCode: true,
        preferredCountries: ["sa", "ae", "kw", "bh", "om", "qa"] // Preferred Gulf countries
    });

    // Validate phone number on form submission
    document.getElementById("multiStepForm").addEventListener("submit", function(event) {
        var iti = window.intlTelInputGlobals.getInstance(input);
        if (!iti.isValidNumber()) {
            alert("الرجاء إدخال رقم هاتف صحيح.");
            event.preventDefault();
        }
    });

    // Custom validation for email
    document.getElementById("email").addEventListener("blur", function() {
        var email = this.value;
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(email)) {
            this.classList.add("invalid");
            alert("الرجاء إدخال بريد إلكتروني صحيح.");
        } else {
            this.classList.remove("invalid");
        }
    });

    // Prevent future dates for birthday
    document.getElementById("birthday").max = new Date().toISOString().split("T")[0];

    // Initialize tabs
    var tabs = document.getElementsByClassName("tab");
    for (var i = 0; i < tabs.length; i++) {
        tabs[i].addEventListener("click", function() {
            var tabIndex = Array.prototype.indexOf.call(tabs, this);
            if (validateForm()) {
                showStep(tabIndex);
                currentStep = tabIndex;
            }
        });
    }

    // Show success message on form submission
    document.getElementById("multiStepForm").addEventListener("submit", function(event) {
        if (validateForm()) {
            event.preventDefault();
            alert("تم إرسال الحجز بنجاح!");
            // Here you can add AJAX to submit the form without page reload
            // After successful submission:
            showStep(4); // Show the success step
        }
    });
</script>
</body>
</html>
