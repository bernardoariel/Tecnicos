<?php
require_once "../controladores/servicios.controlador.php";
require_once "../modelos/servicios.modelo.php";
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

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
      public $servicioProductoId;
      public $servicioProblema;
      public $servicioProductoInfo;
      public $servicioIdUsuario;
      public $servicioPresupuesto;
      public $idCLienteServicio;
      public function ajaxNuevoServicio() {

            /**
             * 
             */
            if(is_null($this->servicioPresupuesto)){

                  $presupuesto = 0;

            } else{

                  $presupuesto = $this->servicioPresupuesto;
            
            }    

            /**
             * SE VERIFICA SI EXISTE AL CLIENTE
             */
            if($this->idCLienteServicio == 0){

                  /*=============================================
                  Mostramos ClienteNuevo STATIC
                  =============================================*/
                  $datos = array(
                  "cliente" => strtoupper($this->servicioCliente),
                  "telefono" => $this->servicioTelefono);

                  $clienteNuevo = ControladorClientes::ctrNuevoClienteServicios($datos);    
                  
                  $idCliente = $clienteNuevo;

            }else{

                  $idCliente = $this->idCLienteServicio;

            }
            /**
             * VER EL PRODUCTO
             */
            /*=============================================
                  Mostramos productos STATIC
            =============================================*/
            $item = "id";
            $valor = $this->servicioProductoId;
            $orden = null;
            $forma = "ASC";
         
            $productos = ControladorProductos::ctrMostrarProductos($item,$valor, $orden,$forma);

            /*=============================================
              SUMAMOS UNA VENTA
            =============================================*/
            $item = "id";
            $valor = $this->servicioProductoId;
            $modo = "+1";
            $servicios = ModeloServicios::mdlModificarVentas($item,$valor,$modo);

            if($servicios=="ok"){
                
                  $datos = array(
                        "id_cliente"=>$idCliente,
                        "cliente" => strtoupper($this->servicioCliente),
                        "telefono" => $this->servicioTelefono,
                        "id_producto" =>$this->servicioProductoId,
                        "producto" =>  $productos["nombre"],
                        "producto_info" => strtoupper($this->servicioProductoInfo),
                        "problema" => strtoupper($this->servicioProblema),
                        "id_usuario_creacion" => $this->servicioIdUsuario,
                        "presupuesto" => $presupuesto           
                  );
      
                  $respuesta = ControladorServicios::ctrNuevoServicio($datos);

                  echo $respuesta;

            }

            

      }

      /*=============================================
      ELIMINAR SERVICIO
      =============================================*/
      public $idServicioEliminar;
      public $nombreServicioProducto;
      public function ajaxEliminarServicio(){

            $item = "id";
            $valor = $this->idServicioEliminar;

            $respuesta = ControladorServicios::ctrEliminarServicio($item, $valor);

             /*=============================================
              SUMAMOS UNA VENTA
            =============================================*/
            $item = "nombre";
            $valor = $this->nombreServicioProducto;
            $modo = "-1";
            $servicios = ModeloServicios::mdlModificarVentas($item,$valor,$modo);

            echo $respuesta;


      }

      /*=============================================
      EDITAR SERVICIO 
      =============================================*/
      public $idServicio;

      public $editarServicioTelefono;
      public $servicioProductoEditarId;
      public $editarServicioProblemaId;
      public $editarServicioInfoProducto;
      public $servicioPresupuestoEditar;
      public function ajaxEditarServicio(){

            if (is_null($this->servicioPresupuestoEditar)){

                  $presupuesto = 0;

            } else {

                  $presupuesto = $this->servicioPresupuestoEditar;

            }    
            /**
             * VER EL PRODUCTO
             */
            /*=============================================
                  Mostramos productos STATIC
            =============================================*/
            $item = "id";
            $valor = $this->servicioProductoEditarId;
            $orden = null;
            $forma = "ASC";
 
            $productos = ControladorProductos::ctrMostrarProductos($item,$valor, $orden,$forma);
            
            $datos = array(
                  "id" => $this->idServicio,
                  "telefono" => strtoupper($this->editarServicioTelefono),
                  "id_producto" => $this->servicioProductoEditarId,
                  "producto" => strtoupper($productos["nombre"]),
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
      $crearServicio->servicioProductoId = $_POST["servicioProductoId"];
      $crearServicio->servicioProblema = $_POST["servicioProblema"];
      $crearServicio->servicioProductoInfo = $_POST["servicioProductoInfo"];
      $crearServicio->servicioIdUsuario = $_POST["servicioIdUsuario"];
      $crearServicio->servicioPresupuesto = $_POST["servicioPresupuesto"];
      $crearServicio->idCLienteServicio = $_POST["idCLienteServicio"];      
      $crearServicio->ajaxNuevoServicio();
}

/*=============================================
ELIMINAR PRODUCTO
=============================================*/

if (isset($_POST["idServicioEliminar"])) {

      $eliminarServicio = new AjaxServicios();
      $eliminarServicio->idServicioEliminar = $_POST["idServicioEliminar"];
      $eliminarServicio->nombreServicioProducto = $_POST["nombreServicioProducto"];
      $eliminarServicio->ajaxEliminarServicio();
}
/*=============================================
EDITAR SERVICIO
=============================================*/

if (isset($_POST["idServicio"])) {

      $editarServicio = new AjaxServicios();
      $editarServicio->idServicio = $_POST["idServicio"];
      $editarServicio->editarServicioTelefono = $_POST["editarServicioTelefono"];
      $editarServicio->servicioProductoEditarId = $_POST["servicioProductoEditarId"];
      $editarServicio->editarServicioProblema = $_POST["editarServicioProblema"];
      $editarServicio->editarServicioInfoProducto = $_POST["editarServicioInfoProducto"];
      $editarServicio->servicioPresupuestoEditar = $_POST["servicioPresupuestoEditar"];
      // $editarServicio->servicioPresupuestoEditar = $_POST["idCLienteServicio"];
      
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
