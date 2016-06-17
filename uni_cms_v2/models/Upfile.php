<?php
class Upfile extends CI_Model {
	
	public function image_item($name="images",$save_path="./images/upload/"){

		
		 $this->load->library('upload');

		 $len=count($_FILES[$name]["name"]);
		 $name_item=array();
		 
		 for ($i = 0; $i < $len; $i++) {
				$name_item[$i]=date("Ymd")."000".$i.uniqid();
		 }

		 $this->upload->initialize(array(
				"file_name"     => $name_item ,
				"upload_path"   => $save_path,
				"allowed_types" => 'gif|jpg|png',
				"max_size"		=> 2048
			));


			if($this->upload->do_multi_upload($name) === FALSE){
				
				return $this->upload->display_errors();
				
			}
			
			$back_data = $this->upload->get_multi_upload_data();
			
			$path_item=array();
			
			foreach($back_data as $key => $val){
				array_push( $path_item , base_url()."images/upload/".$val['raw_name'].$val['file_ext'] );
				
			}
			
			return $path_item;

	}
	
	public function image_single($name=""){
		
		$config['upload_path']      = './images/upload/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']     = 2046;
        $config['max_width']        = 0;
        $config['max_height']       = 0;
		$config['file_name']       = date("Ymd").uniqid();
		

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($name))
        {
            $msg = array('error' => $this->upload->display_errors());
			
			return FALSE;
        }
        else
        {
			
			$data=$this->upload->data();
			$link=base_url()."images/upload/".$data['raw_name'].$data['file_ext'];
			
			return $link;
        }
		
		
	}


}
