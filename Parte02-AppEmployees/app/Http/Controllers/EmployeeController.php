<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\ArrayToXml\ArrayToXml;
use Response;

class EmployeeController extends Controller
{
    
    private $employees = null;

    /**
     * Ubica el archivo employees.json dentro de la estructura del proyecto 
     * para después leer el contenido y convertirlo en un array php
     *
     * @return void 
     */
	public function __construct(){
		$path = storage_path() ."\\json\\employees.json";	
		$this->employees = json_decode(file_get_contents($path), true);	
	}

	/**
     * Carga el listado total de empleados que se encuentran en el archivo employees.json
     *
     * @return vista con listado de empleados
     */
    public function index(){
    	$employees = $this->employees;
    	return view('employees.index',compact('employees'));
    }

    /**
     * Realiza la búsqueda de empleados a través del email del listado en el archivo employees.json
     *
     * @param Request $request contiene la variable get "email", con este criterio se realiza el filtrado
     * @return JSON filtrado de empleados por email 
     */
    public function buscador(Request $request){
    	$buscador = $request->input('email');
    	$employees = $this->employees;
    	$filterEmployees = array();

    	// En el caso que el campo email llegue vacío, se retorna el lsitado total de empleados,
    	// Sino se realiza el filtrado por el criterio de búsqueda
    	if(trim($buscador)==""){
    		$filterEmployees = $employees;
    	}else{
			
			foreach ($employees as $key => $value) {
				//validación por filtro de email
				if(str_contains($value['email'], $buscador)){
					$filterEmployees[] = $value;
				}
			}
    	}
		
		//Retorno del filtro de empleados en formato JSON
		return response()->json($filterEmployees);
    }

    /**
     * Realiza la búsqueda de empleados a través del id del listado en el archivo employees.json
     *
     * @param Request $request contiene la variable get "id", con este criterio se realiza el filtrado
     * @return vista de detalle de empleado a través del id
     */
    public function detalle(Request $request){
		$buscador = $request['id'];
		$employees = $this->employees;
		$filterEmployees = array();
		
		//Se realiza el filtrado por el criterio de búsqueda, en este caso por el id de empleado
		foreach ($employees as $key => $value) {
			if(str_contains($value['id'], $buscador)){
				$filterEmployees[] = $value;
			}
		}
		
		//Retorno del detalle de empleados y la vista que muestra los datos
		return view('employees.detail',compact('filterEmployees'));
    }

    /**
     * Realiza la búsqueda de empleados a través de un rango de salarios del listado en el archivo employees.json;
     * además, realiza acciones para onvertir los datos en formato xml a través de la librería ArrayToXml
     *
     * @param Request $request contiene las variables get "min" y "max", con este criterio se realiza el filtrado
     * @return XML filtrado de empleados por el rango de salarios 
     */
    public function xml(Request $request){
    	$min=$request['min'];
		$max=$request['max'];
    	
		$employees = $this->employees;
		
		//Se realiza el filtrado por el criterio de búsqueda, en este caso por el rango de salario
		$filterEmployees = array();
		foreach ($employees as $key => $value) {
			$salary = preg_replace("/[^0-9.]/", "", $value['salary']);
			$salary = floatval($salary);
			if($salary >= $min && $salary <= $max){
				$filterEmployees[] = $value;
			}
		}
		
		//Se organiza la información para que los skills tengan el formato correcto y la librería genere el resultado esperado
		$filterone = array();
		foreach ($filterEmployees as $key => $value) {
			$filterone[$value['id']]= $filterEmployees[$key]['skills'];
		}


		//Se organiza la información para que los skills tengan el formato correcto y la librería genere el resultado esperado
		foreach ($filterEmployees as $key => $value) {
			$id = $value["id"];
			foreach ($filterone as $keyinner => $valueinner) {
				if($id == $keyinner){
					$filterEmployees[$key]['skills'] = array('detail'=>$valueinner);
				}
			}
		}

		//Se organiza la información para que los nodos se formen correctamente
		$root['employee'] = $filterEmployees;
		$result = ArrayToXml::convert($root,'employees');

		//Retorno del detalle de empleados por rango de salario y la vista en formato XML
		return Response::make($result, '200')->header('Content-Type', 'text/xml');
    }
}



