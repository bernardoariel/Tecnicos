<?php

class ControladorServicios{

 /*=============================================
  MOSTRAR SERVICIOS
 =============================================*/

 static public function ctrMostrarServicios($item, $valor, $orden, $forma, $estado) {

       $tabla = "servicios";

       $respuesta = ModeloServicios::mdlMostrarServicios($tabla, $item, $valor, $orden, $forma, $estado);

       return $respuesta;
 }

 /*=============================================
	CREAR CLIENTES
 =============================================*/

 static public function ctrNuevoServicio($datos){

       if (!empty($datos)) { //controlo si viene cargado con datos
             
              //valido la entrada
              $item = "nombre";
              $valor = "CARACTERES_ESPECIALES";
              // CONSULTO LOS CARACTERES ESPECIALES EN LA BD
              $caracteresESPECIALES = ModeloServicios::mdlMostrarCaracteresEspeciales("parametros", $item, $valor);
              // CONSULTO LOS CARACTERES ESPECIALES EN LA BD
              $CARACTERES = $caracteresESPECIALES["valor"];

              if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ' . $CARACTERES . ']+$/', $datos["cliente"]) &&
                     preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ' . $CARACTERES . ']+$/', $datos["producto"]) &&
                     preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ' . $CARACTERES . ']+$/', $datos["producto_info"]) &&
                     preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ' . $CARACTERES . ']+$/', $datos["problema"])
              ) {

                     $tabla = "servicios";

                    $respuesta = ModeloServicios::mdlNuevoServicio($tabla, $datos);

                     //doy la respuesta ok/error
                     return  $respuesta;

              } else {

                     $cliente = $datos["cliente"];
                     $producto = $datos["producto"];
                     $producto_info = $datos["producto_info"];
                     $problema = $datos["problema"];

                     for ($i = 0; $i < strlen($cliente); $i++) {
                     # code...
                            if (!preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ' . $CARACTERES . ']+$/', $cliente[$i])) {

                                   //error de validacion preg_match
                                   return "charset CLIENTE: " . $cliente[$i];
                            }
                      }

                     for ($i = 0; $i < strlen($producto); $i++) {
                     # code...
                            if (!preg_match('/^[#\.\-a-zA-Z0-9 ' . $CARACTERES . ']+$/', $producto[$i])) {

                            //error de validacion preg_match
                                   return "charset PRODUCTO: " . $producto[$i];
                            }
                     }

                     for ($i = 0; $i < strlen($producto_info); $i++) {
                     # code...
                            if (!preg_match('/^[#\.\-a-zA-Z0-9 ' . $CARACTERES . ']+$/', $producto_info[$i])) {

                            //error de validacion preg_match
                                   return "charset OBS del Producto: " . $producto_info[$i];
                            }
                     }

                     for ($i = 0; $i < strlen($problema); $i++) {
                     # code...
                            if (!preg_match('/^[#\.\-a-zA-Z0-9 ' . $CARACTERES . ']+$/', $problema[$i])) {

                            //error de validacion preg_match
                                   return "charset PROBLE;A: " . $problema[$i];
                            }
                     }
              }
       }
 }

 /*=============================================
	EDITAR SERVICIO
=============================================*/
 static public function ctrEditarServicio($datos)
 {

  if (!empty($datos)) { //controlo si viene cargado con datos

   //valido la entrada
   $item = "nombre";
   $valor = "CARACTERES_ESPECIALES";
   // CONSULTO LOS CARACTERES ESPECIALES EN LA BD
   $caracteresESPECIALES = ModeloServicios::mdlMostrarCaracteresEspeciales("parametros", $item, $valor);
   // CONSULTO LOS CARACTERES ESPECIALES EN LA BD
   $CARACTERES = $caracteresESPECIALES["valor"];

   if (
    preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ' . $CARACTERES . ']+$/', $datos["producto"]) &&
    preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ' . $CARACTERES . ']+$/', $datos["producto_info"]) &&
    preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ' . $CARACTERES . ']+$/', $datos["problema"])
   ) {

    $tabla = "servicios";

    $respuesta = ModeloServicios::mdlEditarServicio($tabla, $datos);

    //doy la respuesta ok/error
    return  $respuesta;
   } else {


    $producto = $datos["producto"];
    $producto_info = $datos["producto_info"];
    $problema = $datos["problema"];



    for ($i = 0; $i < strlen($producto); $i++) {
     # code...
     if (!preg_match('/^[#\.\-a-zA-Z0-9 ' . $CARACTERES . ']+$/', $producto[$i])) {

      //error de validacion preg_match
      return "charset PRODUCTO: " . $producto[$i];
     }
    }

    for ($i = 0; $i < strlen($producto_info); $i++) {
     # code...
     if (!preg_match('/^[#\.\-a-zA-Z0-9 ' . $CARACTERES . ']+$/', $producto_info[$i])) {

      //error de validacion preg_match
      return "charset OBS del Producto: " . $producto_info[$i];
     }
    }

    for ($i = 0; $i < strlen($problema); $i++) {
     # code...
     if (!preg_match('/^[#\.\-a-zA-Z0-9 ' . $CARACTERES . ']+$/', $problema[$i])) {

      //error de validacion preg_match
      return "charset PROBLE;A: " . $problema[$i];
     }
    }
   }
  }
 }
 /*=============================================
	ELIMINAR SERVICIO
	=============================================*/
 static public function ctrEliminarServicio($item, $valor)
 {

  if (isset($item)) {

   $tabla = "servicios";
   $datos = $valor;

   $respuesta = ModeloServicios::mdlEliminarServicio($tabla, $datos);

   return $respuesta;
  }
 }

 /*=============================================
	ENVIAR A REPARAR SERVICIO
	=============================================*/

 static public function ctrEnviarRepararServicio($datos)
 {

  $tabla = "servicios";

  $respuesta = ModeloServicios::mdlEnviarRepararServicio($tabla, $datos);

  return $respuesta;
 }


 /*=============================================
	MODIFICAR SERVICIO
	=============================================*/

 static public function ctrModificarServicio($datos){

  $tabla = "servicios";

  $respuesta = ModeloServicios::mdlModificarServicio($tabla, $datos);

  return $respuesta;
 }
 
 static public function ctrMostrarServiciosDelDia($estado,$fecha){

       $tabla = "servicios";

       $respuesta = ModeloServicios::mdlMostrarServiciosDelDia($tabla,$estado,$fecha);

       return $respuesta;
 }
}