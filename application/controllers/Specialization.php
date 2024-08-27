<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Specialization extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // تحميل المكتبات الضرورية
        $this->load->library(['session', 'form_validation']);
        $this->load->database();

        // التأكد من تسجيل الدخول
        if ($this->session->userdata('isLogIn') == false) {
            redirect('login');
        }
    }

    public function index()
    {
        // جلب جميع البيانات من جدول specialization
        $this->db->select('*');
        $this->db->from('specialization');
        $query = $this->db->get();
        $data['specializations'] = $query->result();

        // إعداد البيانات للعرض في View
        $data['module'] = "specialization";
        $data['title'] = "Specialization List";
        $data['content'] = $this->load->view('specialization/specialization_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function create()
    {
        // إعداد البيانات لعرض النموذج
        $data['module'] = "specialization";
        $data['title'] = "Add Specialization";
        $data['specialization'] = (object) array(
            'id' => '',
            'name' => '',
            'description' => ''
        );

        $data['content'] = $this->load->view('specialization/specialization_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function save()
    {
        // إعداد قواعد التحقق
        $this->form_validation->set_rules('name', 'Specialization Name', 'required|max_length[255]');
        $this->form_validation->set_rules('description', 'Description', 'max_length[1000]');

        if ($this->form_validation->run() === true) {
            $postData = [
                'name' => $this->input->post('name', true),
                'description' => $this->input->post('description', true)
            ];

            // إذا كان id موجودًا، سنقوم بتحديث السجل؛ إذا لم يكن موجودًا، سنقوم بإنشاء سجل جديد
            if (empty($this->input->post('id'))) {
                $this->db->insert('specialization', $postData);
                $this->session->set_flashdata('message', 'Save Successfully');
            } else {
                $this->db->where('id', $this->input->post('id', true));
                $this->db->update('specialization', $postData);
                $this->session->set_flashdata('message', 'Update Successfully');
            }

            redirect('specialization');
        } else {
            $this->create(); // إعادة عرض النموذج في حالة فشل التحقق
        }
    }

    public function edit($id = null)
    {

        // جلب السجل المطلوب تعديله من جدول specialization
        $this->db->where('id', $id);
        $data['specialization'] = $this->db->get('specialization')->row();

        // إعداد البيانات لعرض النموذج
        $data['module'] = "specialization";
        $data['title'] = "Edit Specialization";
        $data['content'] = $this->load->view('specialization/specialization_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function delete($id = null)
    {
        // حذف السجل من جدول specialization
        $this->db->where('id', $id);
        $this->db->delete('specialization');

        // إعداد رسالة الحذف
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', 'Delete Successfully');
        } else {
            $this->session->set_flashdata('exception', 'Please try again');
        }

        redirect('specialization');
    }
}
