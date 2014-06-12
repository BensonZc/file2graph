<?php
class FileManager extends CI_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
 
	function index(){ 
		$this->load->view('upload_data_graph', array('error' => ' ' ));
	}
	
	function new_table(){
		//create a table for upload file
		echo 'This is create a table';
		
	}
}
?>