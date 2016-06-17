<?php
/*
{
"MenuName":"文档管理",
"MenuSort":"3",
"Children":"",
"Author"  :"Uni707",
"version" :"1.0",
"icons"   :"fa-folder-open-o"
}
*/

class Article_mg extends CMS_System{
    
    private $post;
    
	public function __construct(){
		parent::__construct();

    }
    
    public function index(){
        
        $this->list_item();
    }

    public function list_item(){

        $this->board($this->sys("article","list_item","data"));
        
    }
    

    public function read_by_dir($id=NULL){
		
		$this->Article->dirs=$id;
        echo $this->sys("public","dir_table",$this->Article->read_by_dir());
        
    }
	
	
	public function del(){
		
		$item = $_POST["item"];
		
		foreach($item as $key => $val){
			$this->Article->id=$val;
            $this->Article->del();
		}
		
		echo json_encode(array("msg"=>"1"));
		
	}
	
	public function move(){
		
		$item = $_POST["item"];
		$dir = $_POST["order"];
	
		foreach($item as $key => $val){
			$this->Article->id=$val;
			$this->Article->dirs=$dir;
			$this->Article->change_dir();
		}
		
		echo json_encode(array("msg"=>"1"));
		
		
	}
	
	public function show(){
		
		$item = $_POST["item"];
		$status = $_POST["order"];
		if($status === "show"){
			$status="0";
		}else{
			$status="1";
		}
	
		foreach($item as $key => $val){
			$this->Article->id=$val;
			$this->Article->status=$status;
			$this->Article->change_status();
		}
		
		echo json_encode(array("msg"=>"1"));
		
		
	}
	
    private function action($action=NULL){
        
        $input=$this->post;
        $feedback=array("msg"=>"0","msg"=>"Nothing");
        
        switch($action){

            case "del":
                    $this->Article->id=$input["id"];
                    $this->Article->del();
                    
                    $feedback=array("msg"=>"1","data"=>"");
                break;
            
            case "read_one":
                    $this->Article->id=$input["id"];
                    $this->Article->read_one();
                    
                    $feedback=array("msg"=>"1","data"=>"");
                break;
				
			case "move":
				$this->Article->id=				$input["id"];
                $this->Article->dirs=			$input["dir"];
				$this->Article->update();
				break;
				
            case "update":
					$this->Article->id=				$input["id"];
                    $this->Article->dirs=			$input["dir"];
    				$this->Article->type=			$input["type"];
    				$this->Article->title=			$input["title"];
    				$this->Article->author=			$input["author"];
    				$this->Article->add_time=		$input["add_time"];
    				$this->Article->edit_time=		$input["edit_time"];
    				$this->Article->thumb=          $input["thumb"];
    
    				$this->Article->description=	$input["description"];
    				$this->Article->content=		$input["content"];
    				$this->Article->status=			$input["status"];
    				
    				$this->Article->extend=			$input["extend"];
                    
                    $this->Article->update();
                    
                    $feedback=array("msg"=>"1","data"=>"");
                break;
            default:
                $feedback=array("msg"=>"0","msg"=>"Undefined action.");
              break;
       }
       
       return json_encode($feedback);
    }

}