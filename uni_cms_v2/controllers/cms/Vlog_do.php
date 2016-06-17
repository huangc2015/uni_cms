<?php
/*
{
"MenuName":"访客追踪",
"MenuSort":"4",
"Children":"",
"Author"  :"Uni707",
"version" :"1.0",
"icons"   :"fa-eye"
}
*/

class Vlog_do extends CMS_System{
    
    private $post;
    
	public function __construct(){
		parent::__construct();
        $this->post=array(
                            "post1"=>$this->input->post("post1"),
        //....
        );
        
        
    }
    
    public function index(){
        
       $this->panel();
    }
	public function panel(){
        
       $this->board($this->sys("vlog","log_list","data"));
    }
	
	public function day(){
        
       $query = $this->db->get_where('uni_vlog',array('year' => date("Y"),'month' => date("m"),'day' => date("d") ));
	   $index01=$query->result_array();
	   
	   echo $this->sys("public","vlog_table",$index01);
	   
    }
	
	public function month(){
        
       $query = $this->db->get_where('uni_vlog',array('year' => date("Y"),'month' => date("m")));
	   $index01=$query->result_array();
	   
	   echo $this->sys("public","vlog_table",$index01);
	   
    }
	
	public function week(){
        
       
	   $week_day=date("w");
	   if(date("w")==="0"){$weekday=7;}
	   $week_day_start=date("d")-$week_day;
	   
	   if($week_day_start>0){
		   
		 $query = $this->db->get_where('uni_vlog',array('year' => date("Y"),'month' => date("m"),"day >=" => $week_day_start));
		 
	   }else{
		   
		 $query = $this->db->get_where('uni_vlog',array('year' => date("Y"),'month' => date("m"),"day >=" => "1"));
		 
	   }
	   
	  
	   $index01=$query->result_array();
	   
	   
	   echo $this->sys("public","vlog_table",$index01);
	   
    }
	
	public function all(){
		$query = $this->db->get_where('uni_vlog');
		$index01=$query->result_array();
		echo $this->sys("public","vlog_table",$index01);
	}
	
	public function clear(){
		
			$this->db->truncate("uni_vlog");
			echo json_encode(array("msg"=>"1"));
	}
	public function download(){
		
		$this->load->dbutil();
		$query = $this->db->query("SELECT * FROM uni_vlog");
		$csv=$this->dbutil->csv_from_result($query);
		file_put_contents(FCPATH."download/cache/vlog.csv",$csv);
		echo json_encode(array("msg"=>"1","url"=>base_url()."download/cache/vlog.csv"));
	}
	


}