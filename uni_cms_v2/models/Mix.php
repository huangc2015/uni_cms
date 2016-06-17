<?php
class Mix extends CI_Model {
	
	
	public function nav(){
		
		
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
	
	public function my_page($main_data=NULL,$every_page_line=NULL,$now_page_num=NULL){
		
		$every_page_line=(int)$every_page_line;
		$now_page_num=(int)$now_page_num;
		
		//Pagination
		$line_count=count($main_data);

		$all_page_num=(int)ceil($line_count/$every_page_line);
		
		if($now_page_num>$all_page_num){
			
			return FALSE;
			
		}
	
		if($now_page_num === 1){
			
			$a=0;
			
		}elseif($now_page_num === $all_page_num){
			
			$a=$every_page_line*($now_page_num-1);
			
		}else{
			
			$a=$every_page_line*$now_page_num-$every_page_line;
			
		}

		switch($now_page_num){
			case 1:
			$page_up=1;
			$page_down=$all_page_num+1;
				break;
			case $all_page_num:
			$page_up=$now_page_num-1;
			$page_down=$all_page_num;
				break;
			default:
			$page_up=$now_page_num-1;
			$page_down=$all_page_num+1;
				break;
		}
		
		
		$page=array(
			"first"	=>	array("page_num"=>1,"now"=>""),
			"up"	=>	array("page_num"=>$page_up,"now"=>""),
			"item"	=>	array(),
			"down"	=>	array("page_num"=>$page_down,"now"=>""),
			"last"	=>	array("page_num"=>$all_page_num,"now"=>""),
		);
		
		
		for($i=1;$i<=$all_page_num;$i++){
			
			if($i === $now_page_num){
				array_push($page["item"],array("page_num"=>$i,"now"=>"hover"));
			}else{
				array_push($page["item"],array("page_num"=>$i,"now"=>""));
			}
		}
		
		$main_data=array_slice($main_data,$a,$every_page_line);
		
		return array("data"=>$main_data,"page"=>$page);
		
	}
}
?>