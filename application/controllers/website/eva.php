<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class eva extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'website/about_model',
			'setting_model'
		)); 
 
		if ($this->session->userdata('isLogIn') == false) 
		redirect('login'); 
	}
 


	public function eva_about(){
		$data['module'] = display("website");
		$data['title'] = display('about');
		#-------------------------------#
		$data['abouts'] = $this->about_model->read_all();
		$data['content'] = $this->load->view('eva/pag/about',$data,true);
		$this->load->view('eva/pag/about',$data);
	} 


	public function eva_partners(){
		$data['module'] = display("website");
		$data['title'] = display('about');
		#-------------------------------#
		$data['abouts'] = $this->about_model->read_all();
		$data['content'] = $this->load->view('eva/pag/eva_partners',$data,true);
		$this->load->view('eva/pag/eva_partners',$data);
	} 


	public function eva_blog(){
		$data['module'] = display("website");
		$data['title'] = display('about');
		#-------------------------------#
		$data['abouts'] = $this->about_model->read_all();
		$data['content'] = $this->load->view('eva/pag/eva_blog',$data,true);
		$this->load->view('eva/pag/eva_blog',$data);
	} 


	public function eva_branches(){
		$data['module'] = display("website");
		$data['title'] = display('about');
		#-------------------------------#
		$data['abouts'] = $this->about_model->read_all();
		$data['content'] = $this->load->view('eva/pag/eva_branches',$data,true);
		$this->load->view('eva/pag/eva_branches',$data);
	} 


	public function eva_doctors(){
		$data['module'] = display("website");
		$data['title'] = display('about');
		#-------------------------------#
		$data['abouts'] = $this->about_model->read_all();
		$data['content'] = $this->load->view('eva/pag/eva_doctors',$data,true);
		$this->load->view('eva/pag/eva_doctors',$data);
	} 



	public function eva_reserve(){
		$data['module'] = display("website");
		$data['title'] = display('about');
		#-------------------------------#
		$data['abouts'] = $this->about_model->read_all();
		$data['content'] = $this->load->view('eva/pag/eva_reserve',$data,true);
		$this->load->view('eva/pag/eva_reserve',$data);
	} 


	public function eva_contact(){
		$data['module'] = display("website");
		$data['title'] = display('about');
		#-------------------------------#
		$data['abouts'] = $this->about_model->read_all();
		$data['content'] = $this->load->view('eva/pag/eva_contact',$data,true);
		$this->load->view('eva/pag/eva_contact',$data);
	} 


//-------------------

	public function divide1(){
		$data['module'] = display("website");
		$data['title'] = display('about');
		#-------------------------------#
		$data['abouts'] = $this->about_model->read_all();
		$data['content'] = $this->load->view('eva/pag/divide1',$data,true);
		$this->load->view('eva/pag/divide1',$data);
	} 
	public function divide2(){
		$data['module'] = display("website");
		$data['title'] = display('about');
		#-------------------------------#
		$data['abouts'] = $this->about_model->read_all();
		$data['content'] = $this->load->view('eva/pag/divide2',$data,true);
		$this->load->view('eva/pag/divide2',$data);
	} 
	public function divide3(){
		$data['module'] = display("website");
		$data['title'] = display('about');
		#-------------------------------#
		$data['abouts'] = $this->about_model->read_all();
		$data['content'] = $this->load->view('eva/pag/divide3',$data,true);
		$this->load->view('eva/pag/divide3',$data);
	} 
	public function divide4(){
		$data['module'] = display("website");
		$data['title'] = display('about');
		#-------------------------------#
		$data['abouts'] = $this->about_model->read_all();
		$data['content'] = $this->load->view('eva/pag/divide4',$data,true);
		$this->load->view('eva/pag/divide4',$data);
	} 


	public function divide5(){
		$data['module'] = display("website");
		$data['title'] = display('about');
		#-------------------------------#
		$data['abouts'] = $this->about_model->read_all();
		$data['content'] = $this->load->view('eva/pag/divide5',$data,true);
		$this->load->view('eva/pag/divide5',$data);
	} 


	public function team(){
		$data['module'] = display("website");
		$data['title'] = display('about');
		#-------------------------------#
		$data['abouts'] = $this->about_model->read_all();
		$data['content'] = $this->load->view('eva/pag/team',$data,true);
		$this->load->view('eva/pag/team',$data);
	} 


	public function Dammam(){
		$data['module'] = display("website");
		$data['title'] = display('about');
		#-------------------------------#
		$data['abouts'] = $this->about_model->read_all();
		$data['content'] = $this->load->view('eva/pag/Dammam',$data,true);
		$this->load->view('eva/pag/Dammam',$data);
	} 






	public function offer1(){
		$data['module'] = display("website");
		$data['title'] = display('about');
		#-------------------------------#
		$data['abouts'] = $this->about_model->read_all();
		$data['content'] = $this->load->view('eva/pag/offer1',$data,true);
		$this->load->view('eva/pag/offer1',$data);
	} 

	public function offer2(){
		$data['module'] = display("website");
		$data['title'] = display('about');
		#-------------------------------#
		$data['abouts'] = $this->about_model->read_all();
		$data['content'] = $this->load->view('eva/pag/offer2',$data,true);
		$this->load->view('eva/pag/offer2',$data);
	} 








}

