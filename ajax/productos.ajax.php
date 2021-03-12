<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos{

  /*=============================================
  VER CLIENTE PARA EDITAR
  =============================================*/ 

  public $idVerProductoEditar;

  public function ajaxVerProducto(){

    $item = "id";
    $valor = $this->idVerProductoEditar;
    $orden = null;
    $forma = "ASC";
    $clientes = ControladorProductos::ctrMostrarProductos($item, $valor, $orden,$forma);

    
    echo json_encode($clientes);
    
  }

  /*=============================================
  EDITAR CLIENTE
  =============================================*/
  public $idProducto;
  public $editarProducto;

  public function ajaxEditarProducto(){

    //VEO SI EXISTE
    $existe = ModeloProductos::mdlMostrarProductosNotIN("productos",  $this->idProducto,strtoupper($this->editarProducto));


    if(empty($existe)){

      $datos = array("id"=>$this->idProducto,
                     "nombre" => strtoupper($this->editarProducto));

      $respuesta = ControladorProductos::ctrEditarProducto($datos);

      echo $respuesta;
        
    }else{

       echo "duplicado";

    }

    
  }

  /*=============================================
  NUEVO PRODUCTO 
  =============================================*/
  public $nuevoProducto;

  public function ajaxNuevoProducto(){

    $item = "nombre";
    $valor = $this->nuevoProducto;
    $orden = null;
    $forma = "ASC";
    //CONSULTO SI EXISTE ALGUN PRODUCTO
    $productos = ControladorProductos::ctrMostrarProductos($item, $valor,$orden,$forma);

    if(empty($productos)){

      $datos = array("nombre" => strtoupper($this->nuevoProducto));

      $respuesta = ControladorProductos::ctrNuevoProducto($datos);

      echo $respuesta;
      
    }else{

      echo "duplicado";
    }
    
  }
  /*=============================================
  ELIMINAR PRODUCTO
  =============================================*/
  public $idProductoEliminar;

  public function ajaxEliminarProducto(){

    $item = "id";
    $valor = $this->idProductoEliminar;

    $respuesta = ControladorProductos::ctrEliminarProducto($item, $valor);
    
    echo $respuesta;
    
  }

}

/*=============================================
VER PRODUCTO
=============================================*/ 
if(isset($_POST["idVerProductoEditar"])){
  
  $verProducto = new AjaxProductos();
  $verProducto -> idVerProductoEditar = $_POST["idVerProductoEditar"];
  $verProducto -> ajaxVerProducto();

}
/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["editarProducto"])){
  
  $editarElProducto = new AjaxProductos();
  $editarElProducto -> idProducto = $_POST["idProducto"];
  $editarElProducto -> editarProducto = $_POST["editarProducto"];
  $editarElProducto -> ajaxEditarProducto();

}

/*=============================================
AGREGAR PRODUCTO
=============================================*/ 

if(isset($_POST["nuevoProducto"])){
  
  $crearProducto = new AjaxProductos();
  $crearProducto -> nuevoProducto = $_POST["nuevoProducto"];
  
  $crearProducto -> ajaxNuevoProducto();

}

/*=============================================
ELIMINAR PRODUCTO
=============================================*/ 

if(isset($_POST["idProductoEliminar"])){

  $eliminarProducto = new AjaxProductos();
  $eliminarProducto -> idProductoEliminar = $_POST["idProductoEliminar"];
  $eliminarProducto -> ajaxEliminarProducto();

}