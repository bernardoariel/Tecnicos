<?php

require_once "../../controladores/servicios.controlador.php";
require_once "../../modelos/servicios.modelo.php";
require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
require_once "../../controladores/reportes.controlador.php";

$tServEstado=$_GET["tServEstado"];
$tServFecha1=$_GET["tServFecha1"];
$tServFecha2=$_GET["tServFecha2"];

$reporte = ControladorReportes::ctrReportes($tServEstado,$tServFecha1,$tServFecha2);


