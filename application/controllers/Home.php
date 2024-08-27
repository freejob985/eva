<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array( 
            'website/about_model',
            'website/home_model',
            'website/department_model',
            'website/testimonial_model',
            'website/appointment_instruction_model',
            'website/partner_model',
            'website/doctor_model',
            'website/news_model',
            'website/menu_model',
'Branches_model',
      'appointment_model',
            'department_model', 'patient_model'
        ));  
    }  
  
    public function index()
    {


        $data['title'] = display('home'); 
        #-----------Setting-------------# 
        $data['setting'] = $this->home_model->setting(); 
        // redirect if website status is disabled
        if ($data['setting']->status == 0) 
            redirect(base_url('login'));
        $data['basics'] = $this->home_model->basic_setting();  
        #-----------Section-------------# 
        $sections = $this->home_model->sections();
        $dataSection = array();
        if(!empty($sections)):
            foreach ($sections as $section) {
                $dataSection[$section->name] = array(
                    'name'            => $section->name,
                    'title'           => $section->title,
                    'description'     => $section->description
                );
            }
        endif; 
        $data['section'] = $dataSection;

       #--------get all home data---------#
       $data['languageList'] = $this->home_model->languageList(); 
       $data['parent_menu'] = $this->menu_model->get_parent_menu();
       $data['about'] = $this->about_model->read();
       $data['sliders'] = $this->home_model->get_sliders();
       $data['departments'] = $this->department_model->read();
       $data['deptsFooter'] = $this->department_model->read_footer();
       $data['sliderDepart'] = $this->department_model->read_home_slider();
       $data['department_list'] = $this->department_model->department_list();
       $data['testimonial'] = $this->testimonial_model->read_active();
       $data['instruction'] = $this->appointment_instruction_model->read_active_instuction();
       $data['partners'] = $this->partner_model->read_active();
       $data['doctors'] = $this->doctor_model->read_home();  
       $data['latest_news'] = $this->news_model->read_news();
       #-----------------------------------#

       $data['content'] = $this->load->view('website/includes/home',$data,true);
       $this->load->view('website/index', $data);
    }


    public function Reservations()
    {


        $data['title'] = display('home'); 
        #-----------Setting-------------# 
        $data['setting'] = $this->home_model->setting(); 
        // redirect if website status is disabled
        if ($data['setting']->status == 0) 
            redirect(base_url('login'));
        $data['basics'] = $this->home_model->basic_setting();  
        #-----------Section-------------# 
        $sections = $this->home_model->sections();
        $dataSection = array();
        if(!empty($sections)):
            foreach ($sections as $section) {
                $dataSection[$section->name] = array(
                    'name'            => $section->name,
                    'title'           => $section->title,
                    'description'     => $section->description
                );
            }
        endif; 
        $data['section'] = $dataSection;

       #--------get all home data---------#
       $data['languageList'] = $this->home_model->languageList(); 
       $data['parent_menu'] = $this->menu_model->get_parent_menu();
       $data['about'] = $this->about_model->read();
       $data['sliders'] = $this->home_model->get_sliders();
       $data['departments'] = $this->department_model->read();
       $data['deptsFooter'] = $this->department_model->read_footer();
       $data['sliderDepart'] = $this->department_model->read_home_slider();
       $data['department_list'] = $this->department_model->department_list();
       $data['Branches_model'] = $this->Branches_model->read_all();

       $data['testimonial'] = $this->testimonial_model->read_active();
       $data['instruction'] = $this->appointment_instruction_model->read_active_instuction();
       $data['partners'] = $this->partner_model->read_active();
       $data['doctors'] = $this->doctor_model->read_home();  

       $data['latest_news'] = $this->news_model->read_news();
       #-----------------------------------#

       $data['content'] = $this->load->view('website/Reservations',$data,true);
       $this->load->view('website/index', $data);
    }




public function filter_doctors() {
    $branch_id = $this->input->post('branchId');
    $serves_id = $this->input->post('servesId');
    $errors = [];

    // Validate inputs
    if (empty($branch_id) && empty($serves_id)) {
        $errors['branch'] = 'Please select at least a branch or service.';
        echo json_encode(['status' => false, 'errors' => $errors]);
        return;
    }

    $this->db->select('user_id, firstname, lastname');
    $this->db->from('user');
    $this->db->where('user_role', '2'); // Assuming 2 is the role for doctors

    // Conditionally add where clauses
    if (!empty($branch_id)) {
        $this->db->where('branch_id', $branch_id);
    }
    
    if (!empty($serves_id)) {
        $this->db->where('service_id', $serves_id);
    }

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $options = '<option value="">Select doctor</option>';
        foreach ($query->result() as $doctor) {
            $options .= '<option value="' . $doctor->user_id . '">' . $doctor->firstname . ' ' . $doctor->lastname . '</option>';
        }
        echo json_encode(['status' => true, 'doctors' => $options]);
    } else {
        echo json_encode(['status' => false, 'errors' => ['doctor' => 'No doctors available for the selected criteria.']]);
    }
}



//=================================================================================
public function get_service_details() {
    $service_id = $this->input->post('serves_id');
 $doctorId = $this->input->post('doctorId');



    $this->load->database();
    $this->db->select('booking_date, booking_time, closing_time, duration, doctor_device_id');
    $this->db->from('bserves');
    $this->db->where('id', $service_id);
    $query = $this->db->get();

    // التحقق من وجود بيانات
    if ($query->num_rows() > 0) {
        $service_details = $query->row_array();

        // حساب الأوقات المتاحة بناءً على البيانات المسترجعة
        $available_times = $this->getAvailableBookingTimes(
            $service_details['booking_time'], 
            $service_details['booking_date'], 
            $service_details['duration'], 
            $service_details['closing_time'],
            $service_id,
           $doctorId,
        );

        // إرجاع الأوقات المتاحة على شكل JSON
        echo json_encode([
            'status' => true,
            'available_times' => $available_times
        ]);
    } else {
        // التعامل مع حالة عدم وجود بيانات
        echo json_encode([
            'status' => false,
            'message' => 'No service details found.'
        ]);
    }
}



public function get_appointment_times($service_id, $doctor_id) {
    $this->db->select('appointment_time');
    $this->db->from('appointment');
    $this->db->where('service_id', $service_id);
    $this->db->where('doctor_id', $doctor_id);
    $query = $this->db->get();
    
    if ($query->num_rows() > 0) {
        // تحويل النتيجة إلى مصفوفة تحتوي فقط على قيم 'appointment_time' كنصوص
        return array_column($query->result_array(), 'appointment_time');
    } else {
        return [];
    }
}
private function getAvailableBookingTimes($booking_time, $booking_date, $duration, $closing_time, $service_id, $doctor_id) {
    // جلب المواعيد المحجوزة
    $booked_times = $this->get_appointment_times($service_id, $doctor_id);


    $available_times = [];
    $row_count = 0;
    $start_time = new DateTime("$booking_date $booking_time");
    $end_time = new DateTime("$booking_date $closing_time");
    
    while ($start_time < $end_time) {
        $time_value = $start_time->format('H:i');
        
        if ($row_count % 10 == 0) {
            $available_times[] = "<div class='time-row'>";
        }

        // التحقق مما إذا كان الوقت محجوزًا
        $is_booked = in_array($time_value, $booked_times, true);

        if ($is_booked) {
            $available_times[] = "<div class='time-slot booked'>
                <input type='radio' id='time_$time_value' name='appointment_time' value='$time_value' disabled>
                <label class='time-label' for='time_$time_value'>$time_value <span class='booked-text'>محجوز</span></label>
            </div>";
        } else {
            $available_times[] = "<div class='time-slot'>
                <input type='radio' id='time_$time_value' name='appointment_time' value='$time_value'>
                <label class='time-label' for='time_$time_value'>$time_value</label>
            </div>";
        }

        if ($row_count % 10 == 9) {
            $available_times[] = "</div>";
        }
        
        $row_count++;
        $start_time->modify("+$duration minutes");
    }
    
    if ($row_count % 10 != 0) {
        $available_times[] = "</div>";
    }
    
    return $available_times;
}
// ====================================
    public function add_patient_and_appointment() {

        // Set validation rules for the form
    $formData = $this->input->post();

        $this->form_validation->set_rules('branch_id', 'الفرع', 'required');
        $this->form_validation->set_rules('serves_id', 'الخدمة', 'required');
        $this->form_validation->set_rules('doctor_id', 'الطبيب', 'required');
        $this->form_validation->set_rules('appointment_time', 'وقت الموعد', 'required');
        $this->form_validation->set_rules('mobile', 'الهاتف', 'required');
    $this->form_validation->set_rules('email', 'البريد الإلكتروني', 'required|valid_email');
        $this->form_validation->set_rules('date_of_birth', 'عيد الميلاد', 'required');
        $this->form_validation->set_rules('payment_method', 'طريقة الدفع', 'required');

// dd(
// $this->get_appointment_times($this->input->post('serves_id'),$this->input->post('doctor_id'))
// );
        if ($this->form_validation->run() == FALSE) {

            // Validation failed, return to the form with errors
                    redirect('/Home/Reservations');
        } else {
            // Prepare patient data
            $postPatient = array(
                'patient_id' => uniqid('P'), // Generate a unique patient ID
                'firstname' =>$this->input->post('firstname'),
                'lastname' =>$this->input->post('lastname'),
                'mobile' => $this->input->post('mobile'),
                'email' => $this->input->post('email'),
                'date_of_birth' => $this->input->post('date_of_birth'),
                'create_date' => date('Y-m-d'),
                'created_by' => $this->session->userdata('user_id') ?? 1,
                'status' => 1
            );

            // Insert patient data
            $insert_patient = $this->db->insert('patient', $postPatient);

            if ($insert_patient) {
                // Prepare appointment data after successfully adding the patient
                $appointment_data = array(
                    'appointment_id' => uniqid(), // Generate a unique ID
                    'patient_id' => $postPatient['patient_id'],
                    'doctor_id' => $this->input->post('doctor_id'),
  'department_id' => $this->input->post('department_id'),
                    'schedule_id' => $this->generate_schedule_id($this->input->post('appointment_time'), $this->input->post('doctor')), // Generate schedule_id based on selected time and doctor
                    'serial_no' => $this->generate_serial_no($this->input->post('appointment_time'), $this->input->post('doctor')), // Generate serial number
                    'date' => date('Y-m-d', strtotime($this->input->post('appointment_time'))),
                    'problem' => $this->input->post('problem'),
                    'created_by' => $this->session->userdata('user_id') ?? 1,
                    'create_date' => date('Y-m-d H:i:s'),
                    'status' => 'pending',
                    'branch_id' => $this->input->post('branch_id'),
                    'service_id' => $this->input->post('serves_id'),
                    'appointment_time' => $this->input->post('appointment_time'),
                    'payment_method' => $this->input->post('payment_method')
                );

                // Insert the appointment
                $this->db->insert('appointment', $appointment_data);
                $insert_id = $this->db->insert_id();

                if ($insert_id) {
                    // Successful insertion, set success message and redirect to home page
                    $this->session->set_flashdata('success', 'The patient has been added and the appointment has been booked successfully.');
                    redirect('/Home/Reservations');
                } else {
                    // Failed insertion
                    $this->session->set_flashdata('error', 'Failed to book appointment. Please try again.');
                    redirect('/Home/Reservations');
                }
            } else {
                // Failed to create patient
                $this->session->set_flashdata('error', 'Failed to add patient data. Please try again.');
                    redirect('/Home/Reservations');
            }
        }
    }

    // Helper functions
    private function generate_schedule_id($appointment_time, $doctor_id) {
        return md5($appointment_time . $doctor_id);
    }

    private function generate_serial_no($appointment_time, $doctor_id) {
        return substr(md5($appointment_time . $doctor_id), 0, 10);
    }


// =================================================================================================

//   public function submit_appointment() {
//         // Set validation rules
//         $this->form_validation->set_rules('branch', 'الفرع', 'required');
//         $this->form_validation->set_rules('service', 'الخدمة', 'required');
//         $this->form_validation->set_rules('doctor', 'الطبيب', 'required');
//         $this->form_validation->set_rules('appointment_time', 'وقت الموعد', 'required');
//         $this->form_validation->set_rules('fullName', 'الاسم الكامل', 'required');
//         $this->form_validation->set_rules('phone', 'الهاتف', 'required');
//         $this->form_validation->set_rules('email', 'البريد الإلكتروني', 'required|valid_email');
//         $this->form_validation->set_rules('birthday', 'عيد الميلاد', 'required');
//         $this->form_validation->set_rules('payment', 'طريقة الدفع', 'required');

//         if ($this->form_validation->run() == FALSE) {
//             // Validation failed, return to form with errors
//             $this->load->view('appointment_form');
//         } else {
//             // Validation passed, process the form data
//             $appointment_data = array(
//                 'appointment_id' => uniqid(), // Generate a unique ID
//                 'patient_id' => $this->session->userdata('user_id') ?? null, // Assuming you have user sessions
//                 'department_id' => null, // You may need to add this field to your form
//                 'doctor_id' => $this->input->post('doctor'),
//                 'schedule_id' => null, // You may need to generate this based on the selected time
//                 'serial_no' => null, // You may need to generate this
//                 'date' => date('Y-m-d', strtotime($this->input->post('appointment_time'))),
//                 'problem' => $this->input->post('notes'),
//                 'created_by' => $this->session->userdata('user_id') ?? 1, // Assuming you have user sessions
//                 'create_date' => date('Y-m-d H:i:s'),
//                 'status' => 'pending',
//                 'branch_id' => $this->input->post('branch'),
//                 'service_id' => $this->input->post('service'),
//                 'appointment_time' => $this->input->post('appointment_time'),
//                 'patient_name' => $this->input->post('fullName'),
//                 'phone' => $this->input->post('phone'),
//                 'email' => $this->input->post('email'),
//                 'birthday' => $this->input->post('birthday'),
//                 'payment_method' => $this->input->post('payment')
//             );

//             // Insert the appointment using Query Builder
//             $this->db->insert('appointment', $appointment_data);
//             $insert_id = $this->db->insert_id();

//             if ($insert_id) {
//                 // Successful insertion, redirect to home page
//                 $this->session->set_flashdata('success', 'تم حجز الموعد بنجاح.');
//                 redirect('home');
//             } else {
//                 // Failed insertion
//                 $this->session->set_flashdata('error', 'فشل في حجز الموعد. يرجى المحاولة مرة أخرى.');
//                 $this->load->view('appointment_form');
//             }
//         }
//     }

private function is_email_unique($email) {
    $query = $this->db->get_where('patient', ['email' => $email]);
    return $query->num_rows() == 0;
}


public function submit_appointment() {
    // Set validation rules
    $this->form_validation->set_rules('branch', 'الفرع', 'required');
    $this->form_validation->set_rules('service', 'الخدمة', 'required');
    $this->form_validation->set_rules('doctor', 'الطبيب', 'required');
    $this->form_validation->set_rules('appointment_time', 'وقت الموعد', 'required');
    $this->form_validation->set_rules('fullName', 'الاسم الكامل', 'required');
    $this->form_validation->set_rules('phone', 'الهاتف', 'required');
    $this->form_validation->set_rules('email', 'البريد الإلكتروني', 'required|valid_email|callback_is_email_unique');
    $this->form_validation->set_rules('birthday', 'عيد الميلاد', 'required');
    $this->form_validation->set_rules('payment', 'طريقة الدفع', 'required');

    if ($this->form_validation->run() == FALSE) {
        // Validation failed, return to form with errors
        $this->load->view('website/index');
    } else {
        // Prepare patient data
        $postPatient = array(
            'patient_id' => uniqid('P'), // Generate a unique patient ID
            'firstname' => explode(' ', $this->input->post('fullName'))[0],
            'lastname' => explode(' ', $this->input->post('fullName'), 2)[1] ?? '',
            'mobile' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'birthday' => $this->input->post('birthday'),
            'create_date' => date('Y-m-d'),
            'created_by' => $this->session->userdata('user_id') ?? 1,
            'status' => 1
        );

        // Insert patient data
        if ($this->patient_model->create($postPatient)) {
            // Prepare appointment data
            $appointment_data = array(
                'appointment_id' => uniqid(), // Generate a unique ID
                'patient_id' => $postPatient['patient_id'],
                'doctor_id' => $this->input->post('doctor'),
                'schedule_id' => $this->generate_schedule_id($this->input->post('appointment_time'), $this->input->post('doctor')), // Generate schedule_id based on selected time and doctor
                'serial_no' => $this->generate_serial_no($this->input->post('appointment_time'), $this->input->post('doctor')), // Generate serial number
                'date' => date('Y-m-d', strtotime($this->input->post('appointment_time'))),
                'problem' => $this->input->post('notes'),
                'created_by' => $this->session->userdata('user_id') ?? 1,
                'create_date' => date('Y-m-d H:i:s'),
                'status' => 'pending',
                'branch_id' => $this->input->post('branch'),
                'service_id' => $this->input->post('service'),
                'appointment_time' => $this->input->post('appointment_time'),
                'payment_method' => $this->input->post('payment')
            );

            // Check if the appointment already exists
            $appointment_exists = $this->check_appointment_exists($appointment_data['doctor_id'], $appointment_data['schedule_id'], $appointment_data['date']);
            if ($appointment_exists) {
                $this->session->set_flashdata('error', 'تم حجز هذا الموعد مسبقًا.');
                $this->load->view('website/index');
                return;
            }

            // Insert the appointment using Query Builder
            $this->db->insert('appointment', $appointment_data);
            $insert_id = $this->db->insert_id();

            if ($insert_id) {
                // Successful insertion, send confirmation SMS
                // $this->send_confirmation_sms($appointment_data);

                // Set success message and redirect to home page
                $this->session->set_flashdata('success', 'تم حجز الموعد بنجاح.');
                redirect('home');
            } else {
                // Failed insertion
                $this->session->set_flashdata('error', 'فشل في حجز الموعد. يرجى المحاولة مرة أخرى.');
                $this->load->view('website/index');
            }
        } else {
            // Failed to create patient
            $this->session->set_flashdata('error', 'فشل في إضافة بيانات المريض. يرجى المحاولة مرة أخرى.');
            $this->load->view('website/index');
        }
    }
}




private function check_appointment_exists($doctor_id, $schedule_id, $date) {
    // Check if an appointment already exists for the given doctor, schedule, and date
    $query = $this->db->get_where('appointment', array(
        'doctor_id' => $doctor_id,
        'schedule_id' => $schedule_id,
        'date' => $date
    ));
    return $query->num_rows() > 0;
}

private function send_confirmation_sms($appointment_data) {
    // Load SMS gateway settings
    $gateway = $this->db->select('*')->from('sms_gateway')->where('default_status', 1)->get()->row();

    if ($gateway) {
        $this->load->library('smsgateway');

        // Create SMS template
        $message = "تم حجز موعدك بنجاح مع د. " . $appointment_data['doctor_id'] . " في " . $appointment_data['appointment_time'];

        // Send SMS
        $this->smsgateway->send([
            'apiProvider' => $gateway->provider_name,
            'username' => $gateway->user,
            'password' => $gateway->password,
            'from' => $gateway->authentication,
            'to' => $appointment_data['phone'],
            'message' => $message
        ]);

        // Log SMS info
        $this->db->insert('sms_info', array(
            'doctor_id' => $appointment_data['doctor_id'],
            'patient_id' => $appointment_data['patient_id'],
            'phone_no' => $appointment_data['phone'],
            'appointment_id' => $appointment_data['appointment_id'],
            'appointment_date' => $appointment_data['date'],
            'status' => 0,
            'sms_counter' => 0
        ));
    }
}

// ===============================================================================================
    public function testx()
    {
        $data['title'] = display('home'); 
        #-----------Setting-------------# 
        $data['setting'] = $this->home_model->setting(); 
        // redirect if website status is disabled
        if ($data['setting']->status == 0) 
            redirect(base_url('login'));
        $data['basics'] = $this->home_model->basic_setting();  
        #-----------Section-------------# 
        $sections = $this->home_model->sections();
        $dataSection = array();
        if(!empty($sections)):
            foreach ($sections as $section) {
                $dataSection[$section->name] = array(
                    'name'            => $section->name,
                    'title'           => $section->title,
                    'description'     => $section->description
                );
            }
        endif; 
        $data['section'] = $dataSection;

       #--------get all home data---------#
       $data['languageList'] = $this->home_model->languageList(); 
       $data['parent_menu'] = $this->menu_model->get_parent_menu();
       $data['about'] = $this->about_model->read();
       $data['sliders'] = $this->home_model->get_sliders();
       $data['departments'] = $this->department_model->read();
       $data['deptsFooter'] = $this->department_model->read_footer();
       $data['sliderDepart'] = $this->department_model->read_home_slider();
       $data['department_list'] = $this->department_model->department_list();
       $data['testimonial'] = $this->testimonial_model->read_active();
       $data['instruction'] = $this->appointment_instruction_model->read_active_instuction();
       $data['partners'] = $this->partner_model->read_active();
       $data['doctors'] = $this->doctor_model->read_home();  
       $data['latest_news'] = $this->news_model->read_news();
       #-----------------------------------#

       $data['content'] = $this->load->view('website/includes/home',$data,true);
       $this->load->view('website/index', $data);
    }


    public function sub_menu($id=null){
      return $this->db->select("ws_menu.id, content.url, ws_menu.name, ws_menu.parent_id")
                      ->from('ws_page_content as content')
                      ->join('ws_menu', 'ws_menu.id=content.menu_id', 'left')
                      ->where('ws_menu.status', 1)
                      ->where('ws_menu.parent_id', $id)
                      ->order_by('ws_menu.position','asc')
                      ->get()
                      ->result();
    }


    public function chane_language(){

      $language = $this->input->post('userLang');
          $cookie = array(
              'name'   => 'Lng',
              'value'  => $language,
              'expire' => 31536000,
              'domain' => ''
          );
          $this->input->set_cookie($cookie);
    }

    public function deleteCookie(){
          delete_cookie('Lng');
    }


}
