<?php
class CommonData extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->dbforge();
	}
	
	public function create_table($horizontal, $tablename){
		$tabletype = array('type' => 'VARCHAR', 'constraint' => '100',);
		for($i=0;$i<count($horizontal);$i++){
			$horizontal[$i] = str_replace(" ","",$horizontal[$i]);
			$fields[$horizontal[$i]] = array('type' => 'VARCHAR', 'constraint' => '100',);
		}
		
		if(!$this->db->table_exists($tablename)){
			$this->dbforge->add_field($fields);
			$this->dbforge->create_table($tablename);
			return True;
		}else{
			return False;
		}
	}

	public function insert_data($horizontal, $data, $tablename){
		for($i=0;$i<count($horizontal);$i++){
			$horizontal[$i] = str_replace(" ","",$horizontal[$i]);
			for($j=0;$j<count($data);$j++){
				$insertdata[$j][$horizontal[$i]] = $data[$j][$i];
			}
		}
		$this->db->insert_batch($tablename, $insertdata);
	}
	
	public function get_all_data($tablename){
		$query = $this->db->get($tablename);
		return $query->result_array();
	}
	
	public function get_table_fields($tablename){
		$query = $this->db->list_fields($tablename);
		return $query;
	}
	
	public function get_table_data($tablename, $tablefields){
		$this->db->select($tablefields);
		$query = $this->db->get($tablename);
		return $query->result_array();
	}
	
	public function get_table_sql($sql){
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_all_sum($tablename, $tablefields){
		$fields = "";
		for($i=0;$i<count($tablefields);$i++){
			if($i == 0){
				
			}else if($i == count($tablefields) - 1){
				$fields = $fields . $tablefields[$i];
			}else{
				$fields = $fields . $tablefields[$i] . " + ";
			}
		}
		$sql = "select sum(" . $fields . ") allsum from " . $tablename;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_all_row_sum($tablename, $tablefields){
		$fields = '';
		for($i=0;$i<count($tablefields);$i++){
			if($i == 0){
			
			}else if($i == count($tablefields) - 1){
				$fields = $fields . $tablefields[$i];
			}else{
				$fields = $fields . $tablefields[$i] . " + ";
			}
		}
		$sql = "select " . $tablefields[0] . " rowname, (" . $fields . ") rowsum from " . $tablename;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_all_column_sum($tablename, $tablefields){
		$fields = '';
		for($i=0;$i<count($tablefields);$i++){
			if($i==0){
			}else if($i == count($tablefields) - 1){
				$fields = $fields . "sum(" . $tablefields[$i] . ") " . $tablefields[$i];
			}else{
				$fields = $fields . "sum(" . $tablefields[$i] . ") " . $tablefields[$i] . ",";
			}
		}
		$sql = "select " . $fields . " from " . $tablename;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_some_row_sum($tablename, $tablefields, $tablerows){
		$fields = '';
		for($i=0;$i<count($tablefields);$i++){
			if($i == 0){
			
			}else if($i == count($tablefields) - 1){
				$fields = $fields . $tablefields[$i];
			}else{
				$fields = $fields . $tablefields[$i] . " + ";
			}
		}
		$sql = "select " . $tablefields[0] . " rowname, (" . $fields . ") rowsum from " . $tablename . " where " . $tablefields[0] . " in (" . $tablerows . ")";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	
}
?>