<?php

class ControladorPlantilla{

	static public function ctrPlantilla(){

		include "vistas/plantilla.php";

	}	

	static public function consultarMes($mes){

		switch ($mes) {
			case '01':
				return "ENERO";
				break;
			case '02':
				return "FEBRERO";
				break;
			case '03':
				return "MARZO";
				break;
			case '04':
				return "ABRIL";
				break;
			case '05':
				return "MAYO";
				break;				
			case '06':
				return "JUNIO";
				break;					
			case '07':
				return "JULIO";
				break;						
			case '08':
				return "AGOSTO";
				break;
			case '09':
				return "SEPTIEMBRE";
				break;
			case '10':
				return "OCTUBRE";
				break;
			case '11':
				return "NOVIEMBRE";
				break;
			case '12':
				return "DICIEMBRE";
				break;
						
		}
	}


}