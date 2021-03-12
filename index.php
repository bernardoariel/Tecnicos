<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE); 
date_default_timezone_set('America/Argentina/Buenos_Aires');

#plantilla
require_once "controladores/plantilla.controlador.php";
#usuarios
require_once "controladores/usuarios.controlador.php";
require_once "modelos/usuarios.modelo.php";
#parametros
require_once "controladores/parametros.controlador.php";
require_once "modelos/parametros.modelo.php";
#clientes
require_once "controladores/clientes.controlador.php";
require_once "modelos/clientes.modelo.php";
#productos
require_once "controladores/productos.controlador.php";
require_once "modelos/productos.modelo.php";
#empresa
require_once "controladores/empresa.controlador.php";
require_once "modelos/empresa.modelo.php";
#empresa
require_once "controladores/servicios.controlador.php";
require_once "modelos/servicios.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();