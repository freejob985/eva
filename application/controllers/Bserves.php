<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bserves extends CI_Controller
{




   public function __construct()
    {
        parent::__construct();
        $this->load->model('Bserves_model');
        $this->load->model('Branches_model');
        $this->load->model('Doctor_model');


        if ($this->session->userdata('isLogIn') == false) {
            redirect('login');
        }


    }

 public function index()
{
    // جلب بيانات bserves مع أسماء الفروع وأسماء الأجهزة أو الأطباء
    $this->db->select('bserves.*, branches.name as branch_name, user.firstname as doctor_device_name');
    $this->db->from('bserves');
    $this->db->join('branches', 'branches.id = bserves.branch_id', 'left');
    $this->db->join('user', 'user.user_id = bserves.doctor_device_id', 'left');
    $this->db->order_by('bserves.id', 'DESC');
    $query = $this->db->get();
    $data['bserves'] = $query->result();

    // إعداد البيانات للعرض في View
    $data['module'] = "bserves";
    $data['title'] = "Bserve List";
    $data['content'] = $this->load->view('bserves/bserves_list', $data, true);
    $this->load->view('layout/main_wrapper', $data);
}


    public function create()
    {


        $data['module'] = display("bserves");
        $data['title'] = display('add_bserve');
        $data['branches'] = $this->Branches_model->read_all(); // جلب الفروع

        $data['doctors_devices'] = $this->Doctor_model->read_all(); 

        $data['bserve'] = (object) array(
            'id' => '',
            'service_name' => '',
            'branch_id' => '',
            'doctor_device_id' => '',
            'booking_date' => '',
            'booking_time' => '',
            'duration' => '',
            'price' => '',
            'code' => '',
            'discount_price' => ''
        );

        $data['content'] = $this->load->view('bserves/bserves_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function save()
    {
        $this->form_validation->set_rules('service_name', 'service_name', 'required|max_length[100]');
        $this->form_validation->set_rules('branch_id','branch', 'required');
        $this->form_validation->set_rules('doctor_device_id','doctor_device', 'required');
        $this->form_validation->set_rules('booking_date', 'booking_date', 'required');
        $this->form_validation->set_rules('booking_time', 'booking_time', 'required');
 $this->form_validation->set_rules('closing_time', 'closing_time', 'required');
        $this->form_validation->set_rules('duration', 'duration', 'required|integer');
        $this->form_validation->set_rules('price', 'price', 'required');
        $this->form_validation->set_rules('code', 'code', 'required|max_length[100]');
        $this->form_validation->set_rules('discount_price', 'discount_price', 'required');

        $data['bserve'] = (object) $postData = [
            'id' => $this->input->post('id', true),
            'service_name' => $this->input->post('service_name', true),
            'branch_id' => $this->input->post('branch_id', true),
            'doctor_device_id' => $this->input->post('doctor_device_id', true),
            'booking_date' => $this->input->post('booking_date', true),
       'closing_time' => $this->input->post('closing_time', true),
            'booking_time' => $this->input->post('booking_time', true),
            'duration' => $this->input->post('duration', true),
            'price' => $this->input->post('price', true),
            'code' => $this->input->post('code', true),
            'discount_price' => $this->input->post('discount_price', true),
        ];
// dd();
        if ($this->form_validation->run() === true) {

            if (empty($postData['id'])) {
                if ($this->Bserves_model->create($postData)) {
// dd();
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            } else {
                if ($this->Bserves_model->update($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
// dd();
            redirect('bserves/index');


        } else {

            $data['branches'] = $this->Branches_model->read_all();
            $data['doctors_devices'] = $this->Doctor_model->read_all();
            $data['content'] = $this->load->view('bserves/bserves_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }

    }

    public function edit($id = null)
    {
        $data['module'] = display("bserves");
        $data['title'] = display('edit_bserve');

        $data['branches'] = $this->Branches_model->read_all(); // جلب الفروع
        $data['doctors_devices'] = $this->Doctor_model->read_all(); // جلب الأطباء أو الأجهزة
        $data['bserve'] = $this->Bserves_model->read_by_id($id);
        $data['content'] = $this->load->view('bserves/bserves_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function delete($id = null)
    {
        if ($this->Bserves_model->delete($id)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('bserves');
    }
}
?>
