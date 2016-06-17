<?php 
if (!defined('BASEPATH')) exit('No direct access allowed.');
class Boot extends CI_Controller {
    
    public $var_global;


    public function assign($key,$val) {
        
        $this->smt->assign($key,$val);
    }
    
    private function ready(){
		
		foreach($this->var_global as $key => $val){
			$this->smt->assign($key,$val);
		}
		
	}
    public function display($html) {
        $this->smt->display($html);
    }
    public function sys($file=NULL,$pointer=NULL,$data=NULL){
		$this->smt->assign("pointer",$pointer);
		$this->smt->assign("data",$data);
        //$this->smt->assign("menu",$this->menu_ready());
        $this->var_global = array(
		"root"=>base_url(),
		"r1"=>$this->uri->segment(1, "null"),
		"r2"=>$this->uri->segment(2, "null"),
		"r3"=>$this->uri->segment(3, "null"),
		);
		$this->ready();
		return $this->smt->fetch("./sys/".$file.".html"); 
	}
    public function board($body=NULL){
        
        $head=$this->sys("frame","head");
        $foot=$this->sys("frame","foot");
        $menu=$this->sys("frame","menu",$this->menu_ready());
        
        $tip=$this->sys("frame","tip");
        
        echo $head.$tip.$menu.$body.$foot;
        
    }
    
    public function tpl($file=NULL,$pointer=NULL,$data=NULL){
		$this->smt->assign("pointer",$pointer);
		$this->smt->assign("data",$data);
		$this->ready();
		return $this->smt->fetch("./".$file.".html");
	}
    public function menu_ready(){
        
        
        $dir=scandir(FCPATH."controllers/cms");
        $menu_data=array();
        
        foreach($dir as $key => $val){  
            if($val === "." or $val === ".."){
                unset($dir[$key]); 
            }else{
               // $dir[$key]=pathinfo($val,PATHINFO_FILENAME);
                $file_name=pathinfo($val,PATHINFO_FILENAME);
                
                $file=file(FCPATH."controllers/cms/".$val);
                $head="";
                for($i=2;$i<10;$i++){
                    $head.=$file[$i];
                }
               
                $sub_node=json_decode($head,true);
                //$sub_node=$head;
                if($sub_node!=NULL){
                    $head=$sub_node;
                }else{
                    $head=array(
                    'MenuName' => "未知子程序",
                    'MenuSort' => "",
                    'Children' =>"",
                    'Author' => "",
                    'version' => "",
                    'icons' => ""
                    );
                }
                array_push($menu_data,array("url"=> $file_name,"node"=>$head));
                
                
            }
        }  
        
        function mysort($a,$b){
            if($a["node"]["MenuSort"]===$b["node"]["MenuSort"]){
                return 0;
            }
            if($a["node"]["MenuSort"]<$b["node"]["MenuSort"]){
                return -1;
            }else{
                return 1;
            }
            
        }
        usort($menu_data, "mysort");
      return $menu_data;
      }
}

class Front_Show extends Boot{

	public function __construct() {
			parent::__construct();
			
			if($this->session->userdata('is_login') === null){
			
				$this->session->set_userdata('is_login',TRUE);
				$data = array(
				'year' 	=> date("Y"),
				'month' => date("m"),
				'day' 	=> date("d"),
				'time'	=> date("H:i:s"),
				'ip' 	=> (isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"Unknow",
				'source' => (isset($_SERVER["HTTP_REFERER"]))?$_SERVER["HTTP_REFERER"]:"Unknow",
				'target' => (isset($_SERVER['REQUEST_URI']))?$_SERVER['REQUEST_URI']:"Unknow",
				'client' =>	(isset($_SERVER["HTTP_USER_AGENT"]))?$_SERVER["HTTP_USER_AGENT"]:"Unknow"
				);
				
				$this->db->insert('uni_vlog', $data);
			}
    }

}

class CMS_System extends Boot{
	
	public function __construct() {
			parent::__construct();

			if($this->User->login_check() != TRUE){
				redirect(base_url()."nf.html");
				exit;
			}

    }


}

?>