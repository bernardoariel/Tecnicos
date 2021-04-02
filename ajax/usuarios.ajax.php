<?php
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";


class AjaxUsuarios{

      #variables  para mostrar los valores
      public $idUsuarioServicio;
      /*=============================================
      VER USUARIO
      =============================================*/
      public function ajaxVerUsuario() {

            $item = "id";
            $valor = $this->idUsuarioServicio; 
            
            $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

            echo json_encode($usuarios);
      }

     
}

/*=============================================
VER USUARIO
=============================================*/
if (isset($_POST["idUsuarioServicio"])) {

      $verUsuario = new AjaxUsuarios();
      $verUsuario->idUsuarioServicio = $_POST["idUsuarioServicio"];
      $verUsuario->ajaxVerUsuario();
}
