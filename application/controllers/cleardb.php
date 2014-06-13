<?php
class ClearDB extends CI_Controller {

	public function deleteTableDaily(){
		$this->load->database();
		$query = $this->db->query("Select CONCAT('DROP TABLE ', table_name, ';' ) deletequery FROM information_schema.tables Where table_name LIKE '%\_table';");
		
		foreach ($query->result() as $row){
			echo $row->deletequery;
			$this->db->query($row->deletequery);
		}
	}
}
?>
