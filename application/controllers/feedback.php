<?php
class FeedBack extends CI_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->database();
	}
	
	/*
	function index(){ 
		$this->load->view('upload_form', array('error' => ' ' ));
	}
	*/
	
	function sendFeedBack(){
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$message = $this->input->post('message');
		
		/*insert feedback data*/
		$data = array(
			'name' => $name,
			'email' => $email,
			'message' => $message
		);
		
		$this->db->insert('feedbacktable', $data);
		$returnData['return'] = 'thanks for your feedback.';
		$this->load->view('upload_form', $returnData);
	}
}
?>