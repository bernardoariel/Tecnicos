<?php

class ControladorClientes{

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($item, $valor, $orden,$forma){

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor,$orden,$forma);

		return $respuesta;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarCliente($datos){

		if(!empty($datos)){//controlo si viene cargado con datos
			//valido la entrada
			$item = "nombre";
			$valor = "CARACTERES_ESPECIALES";
			// CONSULTO LOS CARACTERES ESPECIALES EN LA BD
			$caracteresESPECIALES = ModeloClientes::mdlMostrarCaracteresEspeciales("parametros",$item, $valor);
			// CONSULTO LOS CARACTERES ESPECIALES EN LA BD
			$CARACTERES = $caracteresESPECIALES["valor"];

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ '.$CARACTERES.']+$/', $datos["nombre"]) &&		   
			   preg_match('/^[#\.\-a-zA-Z0-9 '.$CARACTERES.']+$/', $datos["direccion"])){

			   	$tabla = "clientes";
	   
			   	$datos = array("id"=>$datos["id"],
			   				   "nombre"=>strtoupper($datos["nombre"]),
					           "direccion"=>strtoupper($datos["direccion"]),
					           "telefono"=>$datos["telefono"],
					           "editarObs"=>strtoupper($datos["obs"]));

			  	$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);
			   	//doy la respuesta ok/error
			   	return $respuesta;

			}else{

				$nombre = $datos["nombre"];
				$direccion = $datos["direccion"];
				
				for ($i=0; $i < strlen($nombre) ; $i++) { 
					# code...
					if(!preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ '.$CARACTERES.']+$/', $nombre[$i])){

						//error de validacion preg_match
						return "charset NOMBRE: ".$nombre[$i];
					}

				}

				for ($i=0; $i < strlen($direccion) ; $i++) { 
					# code...
					if(! preg_match('/^[#\.\-a-zA-Z0-9 '.$CARACTERES.']+$/', $direccion[$i])){

						//error de validacion preg_match
						return "charset DIRECCION: ".$direccion[$i];
					}

				}

			}

		}

	}
	/*=============================================
	CREAR CLIENTES
	=============================================*/

	static public function ctrNuevoCliente($datos){

		if(!empty($datos)){//controlo si viene cargado con datos
			//valido la entrada
			$item = "nombre";
			$valor = "CARACTERES_ESPECIALES";
			// CONSULTO LOS CARACTERES ESPECIALES EN LA BD
			$caracteresESPECIALES = ModeloClientes::mdlMostrarCaracteresEspeciales("parametros",$item, $valor);
			// CONSULTO LOS CARACTERES ESPECIALES EN LA BD
			$CARACTERES = $caracteresESPECIALES["valor"];

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ '.$CARACTERES.']+$/', $datos["nombre"]) &&		   
			   preg_match('/^[#\.\-a-zA-Z0-9 '.$CARACTERES.']+$/', $datos["direccion"])){

				
			   	$tabla = "clientes";

			   	// $datos = array("nombre"=>strtoupper($_POST["nuevoCliente"]),
				// 	           "direccion"=>strtoupper($_POST["nuevaDireccion"]),
				// 	           "telefono"=>$_POST["nuevoTelefono"],
				// 	           "obs"=>strtoupper($_POST["nuevoObs"]));
			    
			    $respuesta = ModeloClientes::mdlNuevoCliente($tabla, $datos);
			  	//doy la respuesta ok/error
			    return $respuesta;

			}else{

				$nombre = $datos["nombre"];
				$direccion = $datos["direccion"];
				
				for ($i=0; $i < strlen($nombre) ; $i++) { 
					# code...
					if(!preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ '.$CARACTERES.']+$/', $nombre[$i])){

						//error de validacion preg_match
						return "charset NOMBRE: ".$nombre[$i];
					}

				}

				for ($i=0; $i < strlen($direccion) ; $i++) { 
					# code...
					if(! preg_match('/^[#\.\-a-zA-Z0-9 '.$CARACTERES.']+$/', $direccion[$i])){

						//error de validacion preg_match
						return "charset DIRECCION: ".$direccion[$i];
					}

				}
				
				
			}

		}

	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/
	static public function ctrEliminarCliente($item, $valor){

		if(isset($item)){

			$tabla ="clientes";
			$datos = $valor;

			$respuesta =ModeloClientes::mdlEliminarCliente($tabla, $datos);

			return $respuesta;
			
		}		

	}
	/*=============================================
	CREAR CLIENTES
	=============================================*/

	static public function ctrNuevoClienteServicios($datos){

		if(!empty($datos)){//controlo si viene cargado con datos
			//valido la entrada
			$item = "nombre";
			$valor = "CARACTERES_ESPECIALES";
			// CONSULTO LOS CARACTERES ESPECIALES EN LA BD
			$caracteresESPECIALES = ModeloClientes::mdlMostrarCaracteresEspeciales("parametros",$item, $valor);
			// CONSULTO LOS CARACTERES ESPECIALES EN LA BD
			$CARACTERES = $caracteresESPECIALES["valor"];

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ '.$CARACTERES.']+$/', $datos["cliente"])){

			   	$tabla = "clientes";

			   	$datos = array("nombre"=>strtoupper($datos["cliente"]),
					           "direccion"=>".",
					           "telefono"=>$datos["telefono"],
					           "obs"=>".");
			    
			    $respuesta = ModeloClientes::mdlNuevoClienteServicios($tabla, $datos);
			  	//doy la respuesta ok/error
			    return $respuesta;

			}else{

				$nombre = $datos["nombre"];
				
				for ($i=0; $i < strlen($nombre) ; $i++) { 
					# code...
					if(!preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ '.$CARACTERES.']+$/', $nombre[$i])){

						//error de validacion preg_match
						return "charset NOMBRE: ".$nombre[$i];
					}

				}
			
			}

		}

	}
	
	
}

