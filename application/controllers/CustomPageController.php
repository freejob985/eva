<?php
// application/controllers/CustomPage.php

defined('BASEPATH') OR exit('No direct script access allowed');

class CustomPage extends CI_Controller {

    public function show()
    {
        $this->load->view('custom_page');
    }
}

?>