<?php
class Article extends CI_Model {
	
	public $id;
	public $dirs;
	public $type;
	public $title;
	public $author;
	public $add_time;
	public $edit_time;
	public $thumb;
	public $hits;
	public $description;
	public $content;
	public $extend;
	public $status;
	
	/*
	$this->Article->id=
	$this->Article->dirs=
	$this->Article->type=
	$this->Article->title=
	$this->Article->author=
	$this->Article->add_time=
	$this->Article->edit_time=
	$this->Article->thumb=
	$this->Article->hits=
	$this->Article->description=
	$this->Article->content=
	$this->Article->extend=
	$this->Article->status=
	
	$this->Article->add();//all(dis-id)
	$this->Article->del();//id
	$this->Article->read();//id
	$this->Article->read_all();//
	$this->Article->update();//id,+-all
	*/

	public function add(){
		
		$insert  = array(
						"dir"=> $this->dirs,
						"type"=> $this->type,
						"title"=> $this->title,
						"author"=> $this->author,
						"add_time"=> $this->add_time,
						"edit_time"=> $this->edit_time,
						"thumb"=> $this->thumb,
						"hits"=> $this->hits,
						"description"=> $this->description,
						"content"=> $this->content,
						"extend"=> $this->extend,
						"status"=> $this->status
					);
					
		$this->db->insert('uni_page', $insert);
		
		return TRUE;
	}
	
	public function del(){
		
		$this->db->delete('uni_page', array('id' => $this->id ));
		return TRUE;
		
	}
	
	public function read(){
		
		$query = $this->db->get_where('uni_page',array('id' => $this->id ));
		$index01=$query->row_array();
		
		return $index01;
		
	}
	public function read_by_dir(){
		
		$query = $this->db->get_where('uni_page',array('dir' => $this->dirs ));
		$index01=$query->result_array();
		
		return $index01;
		
	}
	
	public function read_all(){
		
		$query = $this->db->get_where('uni_page');
		$index01=$query->result_array();
		
		return $index01;
		
	}
	
	public function update(){
		
		$data = array(
						"dir"=> $this->dirs,
						"type"=> $this->type,
						"title"=> $this->title,
						"author"=> $this->author,
						"add_time"=> $this->add_time,
						"edit_time"=> date("Y-m-d H:i:s"),
						"thumb"=> $this->thumb,
						"hits"=> $this->hits,
						"description"=> $this->description,
						"content"=> $this->content,
						"extend"=> $this->extend,
						"status"=> $this->status
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
		$this->db->update('uni_page', $data);

		return TRUE;
	}
	public function change_dir(){
		
		$this->db->where('id', $this->id);
		$this->db->update('uni_page', array("dir"=>$this->dirs));
		return TRUE;
		
	}
	
	public function change_status(){
		
		$this->db->where('id', $this->id);
		$this->db->update('uni_page', array("status"=>$this->status));
		return TRUE;
		
	}
}
?>