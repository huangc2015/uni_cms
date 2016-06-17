<?php
/*
{
"MenuName":"目录管理",
"MenuSort":"1",
"Children":"",
"Author"  :"Uni707",
"version" :"1.0",
"icons"   :"fa-th-list"
}
*/

class Dir_do extends CMS_System{
    
    private $post;
    
	public function __construct(){
		parent::__construct();
        $this->post=array(
                            "post1"=>$this->input->post("post1"),
        //....
        );
        
        
    }
    
    public function index(){
        
       $this->board($this->sys("dir","panel","data"));
	   
    }
	public function json(){
        
      echo json_encode(array("list"=>"100"));
    }
	public function read_dir_list(){
		
		$tree = $this->Direct->read_all_by_tree();
		$tree = $this->sys("public","dir_tree",$tree);
		
		echo $tree;
		
	}
	
	public function type_list(){
		
		$data = $this->sys("public","type_list");	
		echo $data;
		
	}
	
	public function read_one($id=0){
		
		if($id === 0){return FALSE;}
		$this->Direct->id=$id;
		echo json_encode($this->Direct->read_one());

    }
    public function add_one(){
		
		$new = array(
					"title"=>$_POST["title"],
					"pid"=>$_POST["pid"],
					"type"=>$_POST["type"],
					"status"=>$_POST["status"]				
		);
		
		if($new['pid']==="0"){
			$new["lv"]="1";
		}else{
			$this->Direct->id=$new['pid'];
			$i=$this->Direct->read_one();
			
			$new["lv"]=(int)$i["lv"]+1;
			
			if($new["lv"]>3){
				echo json_encode(array("msg"=>"0"));
				EXIT;
			}
		}
		
		
		
	
		$this->Direct->pid=$new['pid'];
		$this->Direct->lv=$new['lv'];
		$this->Direct->title=$new['title'];
		$this->Direct->type=$new['type'];
		$this->Direct->status=$new['status'];
	
		if($this->Direct->add()){
			echo json_encode(array("msg"=>"1"));
		}else{
			echo json_encode(array("msg"=>"0"));
		}
        
	}
	public function del_one($id=0){
		
		if($id === 0){echo json_encode(array("msg"=>"0"));}
		$this->Direct->id=$id;
		
		if($this->Direct->del()){
			echo json_encode(array("msg"=>"1"));
		}else{
			echo json_encode(array("msg"=>"0"));
		}

    }
	
	public function modify(){
		
		$new = array(
					"id"=>$_POST["id"],
					"title"=>$_POST["title"],
					"pid"=>$_POST["pid"],
					"type"=>$_POST["type"],
					"status"=>$_POST["status"]
		);
		
		if($new["id"] === 0){echo json_encode(array("msg"=>"0"));}
		
		$this->Direct->id=$new["id"];
		//$this->Direct->pid=$new['pid'];
		//$this->Direct->lv=$new['lv'];
		$this->Direct->title=$new['title'];
		$this->Direct->type=$new['type'];
		$this->Direct->status=$new['status'];
		
		if($this->Direct->update()){
			echo json_encode(array("msg"=>"1","id"=>$new["id"]));
		}else{
			echo json_encode(array("msg"=>"0"));
		}

		
	}
	public function move($action="",$id=0){
		
		if($id === 0){echo json_encode(array("msg"=>"0"));}
		
		$this->Direct->id=$id;
		
		if($this->Direct->exchange($action)){
			echo json_encode(array("msg"=>"1","id"=>$id));
		}else{
			echo json_encode(array("msg"=>"0"));
		}

	}

}