<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct($config = 'rest'){
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		
		parent::__construct();
	}

	public function home(){
		// $this->load->view('home');
		$results['test'] = [1,2,3,4,5];
		echo json_encode($results);
	}

	public function getallStudents(){
		$this->load->model('query');
		$response = $this->query->getallStudents();
		if($response){	
		$dataArray = array();
		foreach($response->result() as $data){
			array_push($dataArray,$data);
		}
		echo json_encode($dataArray);
		}
	 }
	public function deleteStudent(){
		$this->load->model('query');
		$response = $this->query->deleteStudent();
		if($response){
			redirect('welcome/getallStudents');
		}
	 }

	public function addStudent(){
		$this->load->model('query');
		$response = $this->query->addStudent();
		if($response){
			redirect('welcome/getallStudents');
		}
	}

	public function getEditBaseStudentDetails(){
		$this->load->model('query');
		$response = $this->query->getEditBaseStudentDetails();
		if($response){
			$editerUserDetailsArray = array();
			foreach($response->result() as $data){
				array_push($editerUserDetailsArray,$data);
			}
			echo json_encode($editerUserDetailsArray);
		}
	}

	public function updateStudent(){
		$this->load->model('query');
		$response = $this->query->updateStudent();
		if($response){
			redirect('welcome/getallStudents');
		}
	}
	
}
