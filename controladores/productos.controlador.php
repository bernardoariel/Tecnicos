<?php

class ControladorProductos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProductos($item, $valor, $orden,$forma){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden,$forma);

		return $respuesta;

	}

	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrNuevoProducto($datos){

		if(!empty($datos)){
			//valido la entrada
			$item = "nombre";
			$valor = "CARACTERES_ESPECIALES";
			// CONSULTO LOS CARACTERES ESPECIALES EN LA BD
			$caracteresESPECIALES = ModeloProductos::mdlMostrarCaracteresEspeciales("parametros",$item, $valor);
			// CONSULTO LOS CARACTERES ESPECIALES EN LA BD
			$CARACTERES = $caracteresESPECIALES["valor"];
			$nombre = $datos["nombre"];

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ '.$CARACTERES.']+$/', $datos["nombre"])){

		   		$tabla = "productos";
							   
				$respuesta = ModeloProductos::mdlNuevoProducto($tabla, $datos);

				return $respuesta;

			}else{

				
				for ($i=0; $i < strlen($valor) ; $i++) { 
					# code...
					if(!preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ '.$CARACTERES.']+$/', $valor[$i])){

						//error de validacion preg_match
						return "charset NOMBRE: ".$valor[$i];
					}

				}

			}

		}

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarProducto($datos){

		if(!empty($datos)){
			//valido la entrada
			$item = "nombre";
			$valor = "CARACTERES_ESPECIALES";
			// CONSULTO LOS CARACTERES ESPECIALES EN LA BD
			$caracteresESPECIALES = ModeloProductos::mdlMostrarCaracteresEspeciales("parametros",$item, $valor);
			// CONSULTO LOS CARACTERES ESPECIALES EN LA BD
			$CARACTERES = $caracteresESPECIALES["valor"];
			$nombre = $datos["nombre"];

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ '.$CARACTERES.']+$/', $datos["nombre"])){

				$tabla = "productos";

				$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

				return $respuesta;

			}else{

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

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarProducto($item, $valor){

		if(isset($item)){

			$tabla ="productos";
			$datos = $valor;

			$respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

			return $respuesta;
			
		}		

	}

	
}