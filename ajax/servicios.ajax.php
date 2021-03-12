<?php
require_once "../controladores/servicios.controlador.php";
require_once "../modelos/servicios.modelo.php";

class AjaxServicios{

      #variables  para mostrar los valores
      public $idVerServicioEditar;
      public $idSercicioEstado;
      /*=============================================
      VER SERVICIO PARA EDITAR
      =============================================*/
      public function ajaxVerServicio() {

            $item = "id";
            $valor = $this->idVerServicioEditar;
            $orden = null;
            $forma = "ASC";
            $estado = $this->idSercicioEstado;
            $servicios = ControladorServicios::ctrMostrarServicios($item, $valor, $orden, $forma, $estado);

            echo json_encode($servicios);
      }

      /*=============================================
      NUEVO SERVICIO 
      =============================================*/
      public $servicioCliente;
      public $servicioTelefono;
      public $servicioProducto;
      public $servicioProblema;
      public $servicioProductoInfo;
      public $servicioIdUsuario;
      public $servicioPresupuesto;
      public function ajaxNuevoServicio() {

            if(is_null($this->servicioPresupuesto)){

            $presupuesto = 0;

            } else{

            $presupuesto = $this->servicioPresupuesto;
            
            }    

            $datos = array(
                  "cliente" => strtoupper($this->servicioCliente),
                  "telefono" => $this->servicioTelefono,
                  "producto" => strtoupper($this->servicioProducto),
                  "producto_info" => strtoupper($this->servicioProductoInfo),
                  "problema" => strtoupper($this->servicioProblema),
                  "id_usuario_creacion" => $this->servicioIdUsuario,
                  "presupuesto" => $presupuesto           
            );

            $respuesta = ControladorServicios::ctrNuevoServicio($datos);

            echo $respuesta;

      }

      /*=============================================
      ELIMINAR SERVICIO
      =============================================*/
      public $idServicioEliminar;

      public function ajaxEliminarServicio(){

            $item = "id";
            $valor = $this->idServicioEliminar;

            $respuesta = ControladorServicios::ctrEliminarServicio($item, $valor);

            echo $respuesta;
      }

      /*=============================================
      EDITAR SERVICIO 
      =============================================*/
      public $idServicio;

      public $editarServicioTelefono;
      public $servicioProductoEditar;
      public $editarServicioProblema;
      public $editarServicioInfoProducto;
      public $servicioPresupuestoEditar;
      public function ajaxEditarServicio(){

            if (is_null($this->servicioPresupuestoEditar)){

            $presupuesto = 0;

            } else {

            $presupuesto = $this->servicioPresupuestoEditar;

            }    

            $datos = array(
                  "id" => $this->idServicio,
                  "telefono" => strtoupper($this->editarServicioTelefono),
                  "producto" => strtoupper($this->servicioProductoEditar),
                  "problema" => strtoupper($this->editarServicioInfoProducto),
                  "producto_info" => strtoupper($this->editarServicioProblema),
                  "presupuesto" => $presupuesto
            );

            $respuesta = ControladorServicios::ctrEditarServicio($datos);
            echo $respuesta;

       }

       /*=============================================
      CAMBIAR ESTADO
      =============================================*/
      public $idServicioEnviarReparar;
      public $idServicioUsuarioReparar;
      public $idServicioEstado;
      public function ajaxCambiarEstadoServicio(){

            $datos = array(
                  "id" => $this->idServicioCambiarEstado,
                  "id_usuario" => $this->idServicioUsuarioReparar,
                  "estado" => $this->idServicioEstado
            );

            $respuesta = ControladorServicios::ctrEnviarRepararServicio($datos);

            echo $respuesta;
      }
 /*=============================================
  AGREGAR INFO AL ESTADO DOS
  =============================================*/
 public $idServicioTerminar;
 public $servicioPrecioTerminar;
 public $servicioProductoInfoTerminar;
 public $servicioIdUsuarioTerminar;
 public $estadoTerminar;
 public function ajaxModificarServicio(){

      $datos = array(
      "id" => $this->idServicioTerminar,
      "precio" => $this->servicioPrecioTerminar,
      "reparacion" => $this->servicioProductoInfoTerminar,
      "id_usuario" => $this->servicioIdUsuarioTerminar,
      "estado" => $this->estadoTerminar
      );

      $respuesta = ControladorServicios::ctrModificarServicio($datos);

      echo $respuesta;
 }

}

/*=============================================
VER SERVICIO
=============================================*/
if (isset($_POST["idVerServicioEditar"])) {

 $verServicio = new AjaxServicios();
 $verServicio->idVerServicioEditar = $_POST["idVerServicioEditar"];
 $verServicio->idSercicioEstado = $_POST["idSercicioEstado"];
 $verServicio->ajaxVerServicio();
}
/*=============================================
AGREGAR SERVICIO
=============================================*/

if (isset($_POST["servicioCliente"])) {

       $crearServicio = new AjaxServicios();
       $crearServicio->servicioCliente = $_POST["servicioCliente"];
       $crearServicio->servicioTelefono = $_POST["servicioTelefono"];
       $crearServicio->servicioProducto = $_POST["servicioProducto"];
       $crearServicio->servicioProblema = $_POST["servicioProblema"];
       $crearServicio->servicioProductoInfo = $_POST["servicioProductoInfo"];
       $crearServicio->servicioIdUsuario = $_POST["servicioIdUsuario"];
       $crearServicio->servicioPresupuesto = $_POST["servicioPresupuesto"];

       $crearServicio->ajaxNuevoServicio();
}

/*=============================================
ELIMINAR PRODUCTO
=============================================*/

if (isset($_POST["idServicioEliminar"])) {

 $eliminarServicio = new AjaxServicios();
 $eliminarServicio->idServicioEliminar = $_POST["idServicioEliminar"];
 $eliminarServicio->ajaxEliminarServicio();
}
/*=============================================
EDITAR SERVICIO
=============================================*/

if (isset($_POST["idServicio"])) {

 $editarServicio = new AjaxServicios();
 $editarServicio->idServicio = $_POST["idServicio"];
 $editarServicio->editarServicioTelefono = $_POST["editarServicioTelefono"];
 $editarServicio->servicioProductoEditar = $_POST["servicioProductoEditar"];
 $editarServicio->editarServicioProblema = $_POST["editarServicioProblema"];
 $editarServicio->editarServicioInfoProducto = $_POST["editarServicioInfoProducto"];
$editarServicio->servicioPresupuestoEditar = $_POST["servicioPresupuestoEditar"];
 $editarServicio->ajaxEditarServicio();
}
/*=============================================
ELIMINAR PRODUCTO
=============================================*/

if (isset($_POST["idServicioCambiarEstado"])) {

 $repararServicio = new AjaxServicios();
 $repararServicio->idServicioCambiarEstado = $_POST["idServicioCambiarEstado"];
 $repararServicio->idServicioUsuarioReparar = $_POST["idServicioUsuarioReparar"];
 $repararServicio->idServicioEstado = $_POST["idServicioEstado"];
 $repararServicio->ajaxCambiarEstadoServicio();
}
/*=============================================
MODIFICAR SERVICIO TERMINAR - EDITAR ESTADO 2 / 3
=============================================*/

if (isset($_POST["idServicioTerminar"])) {

 $modificarServicio = new AjaxServicios();
 $modificarServicio->idServicioTerminar = $_POST["idServicioTerminar"];
 $modificarServicio->servicioPrecioTerminar = $_POST["servicioPrecioTerminar"];
 $modificarServicio->servicioProductoInfoTerminar = $_POST["servicioProductoInfoTerminar"];
 $modificarServicio->estadoTerminar = $_POST["estadoTerminar"];

 $modificarServicio->ajaxModificarServicio();
}
