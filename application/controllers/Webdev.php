<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webdev extends CI_Controller {

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
        // تحميل عرض (View) عند زيارة مسار /webdev
        $this->load->view('webdev_view');
    }

    public function create()
    {
        // منطق لإنشاء سجل جديد
        // يمكنك تحميل عرض (View) هنا إذا لزم الأمر
        $this->load->view('create_view');
    }

    public function edit($id)
    {
        // منطق لتحرير سجل بناءً على $id
        // يمكنك تحميل عرض (View) هنا إذا لزم الأمر
        $data['id'] = $id;
        $this->load->view('edit_view', $data);
    }

    public function delete($id)
    {
        // منطق لحذف سجل بناءً على $id
        // إعادة التوجيه إلى مسار أو عرض بعد الحذف
        redirect('webdev');
    }
}
