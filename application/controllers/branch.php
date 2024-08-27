<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Branch extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Branches_model');

        if ($this->session->userdata('isLogIn') == false) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['module'] = display("branches");
        $data['title'] = display('branch_list');
        $data['branches'] = $this->Branches_model->read_all();
        $data['content'] = $this->load->view('branch/branches_list', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function create()
    {

        $data['module'] = display("branches");
        $data['title'] = display('add_branch');
        $data['branch'] = (object) array('id' => '', 'name' => '', 'phone' => '', 'address' => '');

        $data['content'] = $this->load->view('branch/branches_form', $data, true);

        $this->load->view('layout/main_wrapper', $data);
    }

    public function save()
    {
        $this->form_validation->set_rules('name', display('branch_name'), 'required|max_length[100]');

        $data['branch'] = (object) $postData = [
            'id' => $this->input->post('id', true),
            'name' => $this->input->post('name', true),
            'phone' => $this->input->post('phone', true),
            'address' => $this->input->post('address', true)
        ];

        if ($this->form_validation->run() === true) {
            if (empty($postData['id'])) {
                if ($this->Branches_model->create($postData)) {
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            } else {
                if ($this->Branches_model->update($postData)) {
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    $this->session->set_flashdata('exception', display('please_try_again'));
                }
            }
            redirect('branch');
        } else {
            $data['content'] = $this->load->view('branch/branches_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }

    public function edit($id = null)
    {
        $data['module'] = display("branches");
        $data['title'] = display('edit_branch');
        $data['branch'] = $this->Branches_model->read_by_id($id);
        $data['content'] = $this->load->view('branch/branches_form', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function delete($id = null)
    {
        if ($this->Branches_model->delete($id)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('branch');
    }
}
?>
