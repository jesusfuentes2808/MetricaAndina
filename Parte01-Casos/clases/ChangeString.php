<?php
class ChangeString{
	
	
	public function __construct(){
		
	}
	
	public function build($texto){
		$arrayAbecedario = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');

		$arrayChar = str_split($texto);

		$cadena = "";
		for ($i=0;$i<count($arrayChar);$i++){
			$char = $arrayChar[$i];
			$flagMay = false;
			if($this->mayuscula($char)){
				$char = strtolower ($char);
				$flagMay = true;
			}
			
			if(is_numeric(array_search($char, $arrayAbecedario))){
				$indice = array_search($char, $arrayAbecedario);
				$indice = $indice+1;
				if(count($arrayAbecedario) == $indice) $indice = 0;
				$char = $arrayAbecedario[$indice];	
			}
			
			if($flagMay) $char = strtoupper($char);
			$cadena .= $char;
		}

		return $cadena;
	}

	private function mayuscula($char){
		if(ctype_upper($char)){
			return true;
		}
		return false;
	}
}



	