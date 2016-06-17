<?php
/*
{
"MenuName":"数据库备份/还原",
"MenuSort":"97",
"Children":"",
"Author"  :"Uni707",
"version" :"1.0",
"icons"   :"fa-save"
}
*/

class Database_do extends CMS_System{
    
	public function __construct(){
		parent::__construct();
        
    }
    
    public function index(){
        
       $this->main();
    }
	public function main(){
        
       $this->board($this->sys("database","backup","data"));
	   
    }
	
	public function table($data=NULL){
		
		$folder=scandir(FCPATH."backup/");
		
		foreach($folder as $key => $val){
			if($folder[$key] === "." or $folder[$key] === ".."){
				unset($folder[$key]); 
			}else{
				$folder[$key]=array(
				"file"=>$val,
				"size"=>number_format(filesize(FCPATH.'backup/'.$folder[$key]) / 1048576, 2) . ' MB'
				);
			};
			
			
		}
		rsort($folder);
		echo $this->sys("public","backup_table",$folder);
		
	}
	
	public function backup(){
		
		$prefs = array(
			'format'    => 'txt',  
		);
		$this->load->dbutil();
		$backup = $this->dbutil->backup($prefs);
		
		file_put_contents(FCPATH.'backup/'.date("YmdHis").'.sql', $backup);
		
		echo json_encode(array("msg"=>"1"));

	}
	public function del(){

		$file=$_POST["file_name"];
		unlink(FCPATH.'backup/'.$file);
		echo json_encode(array("msg"=>"1"));
	}
	public function download($path=NULL){
		
		
			$file=$_POST["file_name"];
			$this->load->library('zip');
			$this->zip->read_file(FCPATH.'backup/'.$file);
			$this->zip->archive(FCPATH.'download/cache/'.$file.".zip");
			$this->zip->clear_data();
			echo json_encode(array("msg"=>$file.".zip"));

		
		
		//unlink(FCPATH.'backup/'.$file);
		
	}
	public function clear(){
		$files = glob(FCPATH.'download/cache/*.*');
		foreach($files as $file){
			if (is_file($file)){
				unlink($file);
			}
		}
	}
	
	public function turnback(){
		
		$file=$_POST["file_name"];
		
		if(!empty($file)){

		$templine = '';
		$lines = file(FCPATH.'backup/'.$file); 

		foreach ($lines as $line){

			if (substr($line, 0, 2) == '--' || $line == ''){
				continue;
			}

			$templine .= $line;

			if (substr(trim($line), -1, 1) == ';')
			{
				$this->db->query($templine);
				$templine = '';
			}
		}
		
		echo json_encode(array("msg"=>"1"));
		
		}else{
			echo "None set file name.";
		}
		
	}
    

}