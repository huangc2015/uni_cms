<?php
class Direct extends CI_Model {
	
	public $id;
	public $sorts;
	public $pid;
	public $lv;
	public $title;
	public $type;
	public $status;
	
	/*
	$this->Direct->id=
	$this->Direct->sorts=
	$this->Direct->pid=
	$this->Direct->lv=
	$this->Direct->title=
	$this->Direct->type=
	$this->Direct->status=
	
	$this->Direct->add();//all(dis-id)
	$this->Direct->del();//id
	$this->Direct->read();//id
	$this->Direct->read_all();//
	$this->Direct->update();//id,+-all
	*/

	public function add(){
	
		$pid_len="0";
		$query = $this->db->get_where('uni_dir',array('pid' => $this->pid ));
		$pid_sreach=$query->result_array();
		
		if(!empty($pid_sreach)){
		
		$pid_len=count($pid_sreach);

		}
		
		$insert  = array(
						'sort' => (int)$pid_len+1 ,
						'pid' => $this->pid ,
						'lv' => $this->lv ,
						'title' => $this->title ,
						'type' => $this->type ,
						'status' => $this->status
					);
					
		$this->db->insert('uni_dir', $insert);
		
		return TRUE;

	}
	
	public function del(){
		
		$id=$this->id;
		
		$query = $this->db->get_where('uni_dir',array('id' => $id ));
		$data_arr=$query->row_array();
		$pid=$data_arr["pid"];//0
		$sort=$data_arr["sort"];//3
		
		$query = $this->db->get_where('uni_dir',array('pid' => $pid,));
		$pid_sreach=$query->result_array();
		
		$pid_len=count($pid_sreach);//6
		
		if($pid_len>1){

			//delect before updata

			for($i=0; $i<($pid_len-(int)$sort); $i++){

			$this->db->where(array("pid"=>$pid,"sort"=>$sort+$i+1));
			$this->db->update('uni_dir', array('sort' => $sort+$i));
			
			}
		
		}
		
		$query = $this->db->get_where('uni_dir',array('id' => $id ));
		$index01=$query->row_array();
		
		switch($index01["lv"]){
			case "1":

				$query = $this->db->get_where('uni_dir',array('pid' => $id ));
				$item=$query->result_array();
				
				foreach($item as $key =>$val){
					$this->db->delete('uni_dir', array('pid' => $val["id"]));
				}
				
				$this->db->delete('uni_dir', array('pid' => $id ));
				$this->db->delete('uni_dir', array('id' => $id ));

				break;
				
			case "2":
				$this->db->delete('uni_dir', array('pid' => $id ));
				$this->db->delete('uni_dir', array('id' => $id ));
				break;
				
				
			case "3":
				$this->db->delete('uni_dir', array('id' => $id ));
				break;

			default:
				return FALSE;
				break;
		}
		
		return TRUE;

	}
	
	public function read_one(){
		
		$query = $this->db->get_where('uni_dir',array('id' => $this->id ));
		$index01=$query->row_array();
		
		return $index01;
		
	}
	
	
	public function read_all(){
		
		$this->db->order_by('sort','ASC');
		$query = $this->db->get_where('uni_dir');
		$index01=$query->result_array();
		
		return $index01;
		
	}
	
	public function read_all_by_tree(){
	
	//read lv 3 and sorting
	//read lv 2 and sorting
	//read lv 1 and sorting
	
	//lv2 foreach sreach this id from lv3 pid and insert lv2 sub element
	//lv1 foreach sreach this id from lv2 pid and insert lv1 sub element
	
	//output array	
	
	
		$data=$this->Direct->read_all();
		$lv01=array();
		$lv02=array();
		$lv03=array();
		foreach($data as $key){
			if($key["lv"]==="1"){
				array_push($lv01,$key);
			}
			if($key["lv"]==="2"){
				array_push($lv02,$key);
			}
			if($key["lv"]==="3"){
				array_push($lv03,$key);
			}
		}
		
		foreach($lv02 as $key =>$val){
			$lv02[$key]["son"]=array();
			$lv02[$key]["son_len"]=0;
		}
	
		foreach($lv03 as $key){
			foreach($lv02 as $key2 => $val){
				if($key["pid"]===$val["id"]){
					array_push($lv02[$key2]["son"],$key);
					$lv02[$key2]["son_len"]=$lv02[$key2]["son_len"]+1;
				}
			}
		}
		
		foreach($lv01 as $key =>$val){
			$lv01[$key]["son"]=array();
			$lv01[$key]["son_len"]=0;
		}
		
		foreach($lv02 as $key){
			foreach($lv01 as $key2 => $val){
				if($key["pid"]===$val["id"]){
					array_push($lv01[$key2]["son"],$key);
					$lv01[$key2]["son_len"]=$lv01[$key2]["son_len"]+1;
					
				}
			}
		}
		
		array_unshift($lv01,array("id"=>"0","sort"=>"0","pid"=>"","lv"=>"0","title"=>"首页","type"=>"0","status"=>"1","son"=>array(),"son_len"=>0));
		
		return $lv01;

	
	}
	
	public function update(){
		
		$data = array(
						'sort' => $this->sorts ,
						'pid' => $this->pid ,
						'lv' => $this->lv ,
						'title' => $this->title ,
						'type' => $this->type ,
						'status' => $this->status,
					);
		function is_empty($var)
		{
			if($var === NULL){
				return FALSE;
			}else{
				return TRUE;
			}
			
		}
		
		$data = array_filter($data,"is_empty");

		$this->db->where('id', $this->id);
		$this->db->update('uni_dir', $data);

		return TRUE;
	}
	
	public function exchange($action=NULL){
	
		//exchange
		
			$id=$this->id;
		
			if($action==="up"){
				$move=(-1);
			}
			
			if($action==="down"){
				$move=1;
			}
			
			$limit=FALSE;
			
			$query = $this->db->get_where('uni_dir',array('id' => $id ));
			$data_arr=$query->row_array();
			$pid=$data_arr["pid"];//0
			$sort_a=$data_arr["sort"];//2
			
			$query = $this->db->get_where('uni_dir',array('pid' => $pid,));
			$pid_sreach=$query->result_array();
			
			$pid_len=count($pid_sreach);//11
			
			
			if($sort_a + $move === 0){
			$limit=TRUE;
			}
			
			if($sort_a + $move > $pid_len){
			$limit=TRUE;
			}
			
			if(!$limit){
			
			$this->db->where(array("pid"=>$pid,"sort"=>$sort_a+$move));
			$this->db->update('uni_dir', array('sort' => $sort_a));
			
			$this->db->where(array("id"=>$id));
			$this->db->update('uni_dir', array('sort' => $sort_a+$move));
			
			}
			
			return TRUE;
	
	}
}
?>