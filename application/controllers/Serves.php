<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Serves extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Serves_model');
        $this->load->model('Branches_model'); // لجلب الفروع
        $this->load->model('Doctors_model'); // لجلب الأطباء أو الأجهزة

        if ($this->session->userdata('isLogIn') == false) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['module'] = display("serves");
        $data['title'] = display('serve_list');
        $data['serves'] = $this->Serves_model->read_all();
        $data['content'] = $this->load->view('serves/serves_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function create()
    {
        $data['module'] = display("serves");
        $data['title'] = display('add_serve');
        $data['branches'] = $this->Branches_model->read_all(); // جلب الفروع
        $data['doctors_devices'] = $this->Doctors_model->read_all(); // جلب الأطباء أو الأجهزة
        $data['serve'] = (object) array(
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
        $data['content'] = $this->load->view('serves/serves_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function save()
    {
        $this->form_validation->set_rules('service_name', display('service_name'), 'required|max_length[255]');
        $this->form_validation->set_rules('branch_id', display('branch'), 'required');
        $this->form_validation->set_rules('doctor_device_id', display('doctor_device'), 'required');
        $this->form_validation->set_rules('booking_date', display('booking_date'), 'required');
        $this->form_validation->set_rules('booking_time', display('booking_time'), 'required');
        $this->form_validation->set_rules('duration', display('duration'), 'required|integer');
        $this->form_validation->set_rules('price', display('price'), 'required|decimal');
        $this->form_validation->set_rules('code', display('code'), 'required|max_length[50]');
        $this->form_validation->set_rules('discount_price', display('discount_price'), 'required|decimal');

        $data['serve'] = (object) $postData = [
            'id' => $this->input->post('id', true),
            'service_name' => $this->input->post('service_name', true),
            'branch_id' => $this->input->post('branch_id', true),
            'doctor_device_id' => $this->input->post('doctor_device_id', true),
            'booking_date' => $this->input->post('booking_date', true),
            'booking_time' => $this->input->post('booking_time', true),
            'duration' => $this->input->post('duration', true),
            'price' => $this->input->post('price', true),
            'code' => $this->input->post('code', true),
            'discount_price' => $this->input->post('discount_price', true),
        ];

        if ($this->form_validation->run() === true) {
            if (empty($postData['id'])) {
                if ($this->Serves_model->create($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            } else {
                if ($this->Serves_model->update($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
            redirect('serves');
        } else {
            $data['branches'] = $this->Branches_model->read_all();
            $data['doctors_devices'] = $this->Doctors_model->read_all();
            $data['content'] = $this->load->view('serves/serves_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }

    public function edit($id = null)
    {
        $data['module'] = display("serves");
        $data['title'] = display('edit_serve');
        $data['branches'] = $this->Branches_model->read_all(); // جلب الفروع
        $data['doctors_devices'] = $this->Doctors_model->read_all(); // جلب الأطباء أو الأجهزة
        $data['serve'] = $this->Serves_model->read_by_id($id);
        $data['content'] = $this->load->view('serves/serves_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function delete($id = null)
    {
        if ($this->Serves_model->delete($id)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('serves');
    }
}
?>
