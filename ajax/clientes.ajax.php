<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

  /*=============================================
  VER CLIENTE PARA EDITAR
  =============================================*/ 

  public $idVerClienteEditar;

  public function ajaxVerCliente(){

    $item = "id";
    $valor = $this->idVerClienteEditar;
    $orden = null;
    $forma = "ASC";
    $clientes = ControladorClientes::ctrMostrarClientes($item, $valor, $orden,$forma);

    
    echo json_encode($clientes);
    
  }

  /*=============================================
  EDITAR CLIENTE
  =============================================*/
  public $idCliente;
  public $editarCliente;
  public $editarDireccion;
  public $editarTelefono;
  public $editarObs;
  public $editarCodPais;
  public $editarWs;
  public $editarEmail;

  public function ajaxEditarCliente(){

    //VEO SI EXISTE
    $existe = ModeloClientes::mdlMostrarClientesNotIN("clientes",  $this->idCliente,strtoupper($this->editarCliente));
    
    
    if(empty($existe)){

      $datos = array("id"=>$this->idCliente,
                     "nombre" => strtoupper($this->editarCliente),
                     "direccion"=>strtoupper($this->editarDireccion),
                     "telefono"=>strtoupper($this->editarTelefono),
                     "obs"=>strtoupper($this->editarObs),
                     "cod_pais"=>$this->editarCodPais,
                     "whatsapp"=>$this->editarWs,
                     "email"=>strtoupper($this->editarEmail)
                    );

      $respuesta = ControladorClientes::ctrEditarCliente($datos);

      echo $respuesta;
        
    }else{

       echo "duplicado";

    }

  	
  }

  /*=============================================
  NUEVO CLIENTE 
  =============================================*/
  public $nuevoCliente;
  public $nuevaDireccion;
  public $nuevoTelefono;
  public $nuevoObs;
  public $nuevoCodPais;
  public $nuevoWs;
  public $nuevoEmail;

  public function ajaxNuevoCliente(){

  	$item = "nombre";
    $valor = $this->nuevoCliente;
    $orden = null;
    $forma = "ASC";

    //CONSULTO SI EXISTE ALGUN CLIENTE
    $clientes = ControladorClientes::ctrMostrarClientes($item, $valor,$orden,$forma);

    if(empty($clientes)){

      if(strlen($this->nuevoEmail)<3){

        $email = null;

      }else{

        $email =strtoupper($this->nuevoEmail);
        
      }
    	$datos = array("nombre" => strtoupper($this->nuevoCliente),
               	   "direccion"=>strtoupper($this->nuevaDireccion),
                    "cod_pais"=>strtoupper($this->nuevoCodPais),
               	   "telefono"=>strtoupper($this->nuevoTelefono),
               	   "email"=>$email,
               	   "whatsapp"=>strtoupper($this->nuevoWs),
               	   "obs"=>strtoupper($this->nuevoObs));

	  	$respuesta = ControladorClientes::ctrNuevoCliente($datos);

	    echo $respuesta;
	    
    }else{

    	echo "duplicado";
    }
  	
  }
  /*=============================================
  ELIMINAR cliente
  =============================================*/
  public $idClienteEliminar;

  public function ajaxEliminarCliente(){

    $item = "id";
    $valor = $this->idClienteEliminar;

    $respuesta = ControladorClientes::ctrEliminarCliente($item, $valor);
    
    echo $respuesta;
    
  }

}

/*=============================================
VER CLIENTE
=============================================*/	
if(isset($_POST["idVerClienteEditar"])){
	
	$verCliente = new AjaxClientes();
	$verCliente -> idVerClienteEditar = $_POST["idVerClienteEditar"];
	$verCliente -> ajaxVerCliente();

}
/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["editarCliente"])){
	
	$editarCliente = new AjaxClientes();
	$editarCliente -> idCliente = $_POST["idCliente"];
	$editarCliente -> editarCliente = $_POST["editarCliente"];
	$editarCliente -> editarDireccion = $_POST["editarDireccion"];
	$editarCliente -> editarTelefono = $_POST["editarTelefono"];
	$editarCliente -> editarObs = $_POST["editarObs"];
	$editarCliente -> editarCodPais = $_POST["editarCodPais"];
	$editarCliente -> editarWs = $_POST["editarWs"];
	$editarCliente -> editarEmail = $_POST["editarEmail"];

	$editarCliente -> ajaxEditarCliente();

}

/*=============================================
AGREGAR CLIENTE
=============================================*/	

if(isset($_POST["nuevoCliente"])){
	
	$editarCliente = new AjaxClientes();
	$editarCliente -> nuevoCliente = $_POST["nuevoCliente"];
	$editarCliente -> nuevaDireccion = $_POST["nuevaDireccion"];
	$editarCliente -> nuevoTelefono = $_POST["nuevoTelefono"];
	$editarCliente -> nuevoObs = $_POST["nuevoObs"];

  $editarCliente -> nuevoCodPais = $_POST["nuevoCodPais"];
  $editarCliente -> nuevoWs = $_POST["nuevoWs"];
  $editarCliente -> nuevoEmail = $_POST["nuevoEmail"];

	$editarCliente -> ajaxNuevoCliente();

}

/*=============================================
ELIMINAR cliente
=============================================*/ 

if(isset($_POST["idClienteEliminar"])){

  $eliminarProducto = new AjaxClientes();
  $eliminarProducto -> idClienteEliminar = $_POST["idClienteEliminar"];
  $eliminarProducto -> ajaxEliminarCliente();

}