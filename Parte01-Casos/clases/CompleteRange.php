<?php
class CompleteRange{
	
	public function __construct(){
		
	}

	public function build($array){
	
		$minimo = min($array);
		$maximo = max($array);
		
		$rtnArray= array();
		for($i=$minimo; $i<= $maximo; $i++){
			if(in_array($i,$array)){
				$rtnArray[] = $array[array_search($i,$array)];
			}else{
				$rtnArray[] = $i;
			}
		}
		
		return $rtnArray;
	}
}