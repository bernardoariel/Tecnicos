<?php

require_once "../controladores/servicios.controlador.php";
require_once "../modelos/servicios.modelo.php";
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";


class AjaxMensajes{

      #variables  para mostrar los valores
      public $idServicioMensaje;
      public $servicioMensaje;
      /*=============================================
      VER SERVICIO PARA EDITAR
      =============================================*/
      public function ajaxMensaje() {

            $item = "id";
            $valor = $this->idServicioMensaje;
            $orden = null;
            $forma = "ASC";
            $estado = 4;
            $servicios = ControladorServicios::ctrMostrarServicios($item, $valor, $orden, $forma, $estado);

            $item = "id";
            $valor = $servicios["id_cliente"];//->nuevoCliente;
            $orden = null;
            $forma = "ASC";

            //CONSULTO SI EXISTE ALGUN CLIENTE
            $clientes = ControladorClientes::ctrMostrarClientes($item, $valor,$orden,$forma);

            if($clientes["whatsapp"]=="TRUE"){

                $telefono =  str_replace("(", "", $clientes["telefono"]);
                $telefono =  str_replace(")", "", $telefono);
                $telefono = str_replace("-", "", $telefono);
                $telefono = str_replace(" ", "", $telefono);
                $telefono = str_replace(" ", "", $telefono);
                $mensajeTexto ='Hola '.$clientes["nombre"].' ya esta terminado el trabajo de: '.$servicios["producto"];
                $mensajeTexto = str_replace(" ", "%20", $mensajeTexto);
                
                $mensaje = new stdClass();
                $mensaje->mensaje=$mensajeTexto;
                $mensaje->telefono=$clientes["cod_pais"].$telefono;

                echo json_encode($mensaje);
            }
            
      
            
      }

     
}

/*=============================================
VER MENSAJE
=============================================*/
if (isset($_POST["idServicioMensaje"])){

      $verServicio = new AjaxMensajes();
      $verServicio->idServicioMensaje = $_POST["idServicioMensaje"];
      $verServicio->servicioMensaje = $_POST["servicioMensaje"];
      $verServicio->ajaxMensaje();
}