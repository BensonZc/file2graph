<?php
require_once './phpexcel/PHPExcel.php';

class Upload extends CI_Controller {
 
        function __construct(){
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->model('commondata');
			$this->load->library('session');
        }
 
        function index(){ 
                $this->load->view('upload_form', array('error' => ' ' ));
        }

        function do_upload(){
			$hide = $this->input->post('hidden');
                
			$config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'csv|txt|xlsx';
            $config['max_size'] = '0';
            $config['max_width']  = '0';
            $config['max_height']  = '0';
				
				
            $this->load->library('upload', $config);
			
			if($hide == $this->session->userdata('conn')){
				if (!$this->upload->do_upload()){
					$error = array('error' => $this->upload->display_errors());
					$this->load->view('upload_form', $error);
				} else {
					/**
					upload data array
					[file_name] upload file name
					[file_type] upload file type
					[file_path] upload file absolute path
					[full_path] absolute path contains file name
					...
					http://codeigniter.org.cn/user_guide/libraries/file_uploading.html
					**/
					$upload_data = $this->upload->data();
					
					if($upload_data['file_ext'] == '.csv'){
						//csv data 
						$objReader = new PHPExcel_Reader_CSV();
						$objReader->setInputEncoding('gb2312');
						$objReader->setDelimiter(";");
						$objReader->setLineEnding("\r\n" );
						$objPHPcsv = $objReader->load('./uploads/' . $upload_data['file_name']);
						$objSheet = $objPHPcsv->getActiveSheet();
							
						$statementList = array();
						$horizontal = array();
							
						for($i=1;$i<=$objSheet->getHighestRow();$i++){
							$row = $objSheet->getCell('A'.$i)->getValue();
							$row = explode(",", $row);
							
							if($i==1){
								$horizontal = $row;
							}else{
								array_push($statementList, $row);
							}
						}
							
						/**
						1.create a table for upload file
						if table existed,not create table.return false,nothing to do.
						if table isn't existed ,create table. return true,insert data to DB.
						**/
						$tablename = str_replace(".","_",$upload_data['file_name']) . "_table";
						$data['return1'] = $this->commondata->create_table($horizontal, $tablename);
						if($data['return1']){
							$viewdata['return1'] = "table is created success.";
							$dbdata = $this->commondata->insert_data($horizontal, $statementList, $tablename);
						}else{
							$viewdata['return1'] = "table is create falied.because table is existed.";
						}
						 
						for($i=0;$i<count($horizontal);$i++){
							$horizontal[$i] = str_replace(" ","",$horizontal[$i]);
						}
						
						$upload_file_data = array('upload_data' => $statementList, 'table_name' => $tablename, 'horizontal' => $horizontal, 'upload_file_name' => $upload_data['file_name']);
						$this->load->view('upload_data_select', $upload_file_data);
                    }else if($upload_data['file_ext'] == '.xlsx'){
						$PHPExcel = new PHPExcel();
						$PHPReader = new PHPExcel_Reader_Excel2007();
						$PHPExcel = $PHPReader->load('./uploads/' . $upload_data['file_name']);
						
						$currentSheet = $PHPExcel->getSheet(0);
						
						$allColumn = $currentSheet->getHighestColumn();
						$allRow = $currentSheet->getHighestRow();
						
						$statementList = array();
						$horizontal = array();
						
						$all = array();
						for($currentRow = 1 ; $currentRow <= $allRow ; $currentRow++){
							$flag = 0;
							$col = array();
							for($currentColumn='A'; $this->getascii($currentColumn) <= $this->getascii($allColumn) ; $currentColumn++){
								$address = $currentColumn.$currentRow;   
								$string = $currentSheet->getCell($address)->getValue();
								$col[$flag] = $string;
								$flag++;
            				}
							$all[] = $col;
						}
						
						$horizontal = $all[0];
						array_shift($all);
						$statementList = $all;
						
						$tablename = str_replace(".","_",$upload_data['file_name']) . "_table";
						$data['return1'] = $this->commondata->create_table($horizontal, $tablename);
						if($data['return1']){
							$viewdata['return1'] = "table is created success.";
							$dbdata = $this->commondata->insert_data($horizontal, $statementList, $tablename);
						}else{
							$viewdata['return1'] = "table is create falied.because table is existed.";
						}
						
						$upload_file_data = array('upload_data' => $statementList, 'table_name' => $tablename, 'horizontal' => $horizontal,  'upload_file_name' => $upload_data['file_name']);
						$this->load->view('upload_data_select', $upload_file_data);
					}
                } 
			}else{
				echo "<script>alert('please do not refresh repeat.');</script>";
			}
			$this->session->sess_destroy();
        }
		
		public function getascii($ch) {
			if(strlen($ch) == 1)
				return ord( $ch)-65;
			return ord($ch[1])-38;
		}
}
?>
