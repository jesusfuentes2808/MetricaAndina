<?php
class ClearPar{
	
	public function __construct(){
		
	}

	public function build($texto){

		$a = mb_substr_count($texto,"()");
		$i = 1;
		$cadena = "";
		while ($i <= $a) {
			$cadena.="()";
			$i++;
		}

		return $cadena;
	}

}