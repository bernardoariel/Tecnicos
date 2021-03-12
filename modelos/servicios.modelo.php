<?php

require_once "conexion.php";

class ModeloServicios
{

 /*=============================================
	MOSTRAR SERVICIOSD
	=============================================*/

 static public function mdlMostrarServicios($tabla, $item, $valor, $orden, $forma, $estado)
 {

  if ($item != null) {

   $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND estado=" . $estado);

   $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

   $stmt->execute();

   return $stmt->fetch();
  } else {

   if ($orden == null) {

    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado = " . $estado . " order by $orden $forma ");

    $stmt->execute();

    return $stmt->fetchAll();
   } else {

    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado = " . $estado . " order by $orden $forma");

    $stmt->execute();

    return $stmt->fetchAll();
   }
  }

  $stmt->close();

  $stmt = null;
 }
 /*=============================================
	CREAR SERVICIO
	=============================================*/

 static public function mdlNuevoServicio($tabla, $datos)
 {

  $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (`cliente`, `telefono`, `producto`, `producto_info`, `problema`,  `id_usuario_creacion`,`presupuesto`) VALUES(:cliente, :telefono, :producto, :producto_info, :problema, :id_usuario_creacion,:presupuesto)");

  $stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
  $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
  $stmt->bindParam(":producto", $datos["producto"], PDO::PARAM_STR);
  $stmt->bindParam(":producto_info", $datos["producto_info"], PDO::PARAM_STR);
  $stmt->bindParam(":problema", $datos["problema"], PDO::PARAM_STR);
  $stmt->bindParam(":id_usuario_creacion", $datos["id_usuario_creacion"], PDO::PARAM_INT);
  $stmt->bindParam(":presupuesto", $datos["presupuesto"], PDO::PARAM_STR);

  if ($stmt->execute()) {

   return "ok";
  } else {

   // return $stmt->errorInfo();
   return "error";
  }

  $stmt->close();
  $stmt = null;
 }

 /*=============================================
	BORRAR SERVICIO
	=============================================*/

 static public function mdlEliminarServicio($tabla, $datos)
 {

  $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

  $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

  if ($stmt->execute()) {

   return "ok";
  } else {

   return "error";
  }

  $stmt->close();

  $stmt = null;
 }

 /*=============================================
	EDITAR CLIENTE
	=============================================*/

 static public function mdlEditarServicio($tabla, $datos){

  $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  telefono = :telefono , producto = :producto, producto_info =:producto_info, problema =:problema, presupuesto =:presupuesto WHERE id = :id");

  $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
  $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
  $stmt->bindParam(":producto", $datos["producto"], PDO::PARAM_STR);
  $stmt->bindParam(":producto_info", $datos["producto_info"], PDO::PARAM_STR);
  $stmt->bindParam(":problema", $datos["problema"], PDO::PARAM_STR);
  $stmt->bindParam(":presupuesto", $datos["presupuesto"], PDO::PARAM_STR);

  if ($stmt->execute()) {

   return "ok";
  } else {

   return "error";
  }


  $stmt->close();
  $stmt = null;
 }




 /*=============================================
	MOSTRAR PARAMETROS
	=============================================*/

 static public function mdlMostrarCaracteresEspeciales($tabla, $item, $valor)
 {

  if ($item != null) {

   $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item order by id desc");

   $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

   $stmt->execute();

   return $stmt->fetch();
  } else {

   $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla order by id desc");

   $stmt->execute();

   return $stmt->fetchAll();
  }

  $stmt->close();

  $stmt = null;
 }
 /*=============================================
	EDITAR CLIENTE
	=============================================*/

 static public function mdlEnviarRepararServicio($tabla, $datos)
 {

  $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  estado = :estado , id_usuario = :id_usuario WHERE id = :id");

  $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
  $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
  $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);


  if ($stmt->execute()) {

   return "ok";
  } else {

   return "error";
  }


  $stmt->close();
  $stmt = null;
 }

 /*=============================================
	EDITAR CLIENTE
	=============================================*/

 static public function mdlModificarServicio($tabla, $datos)
 {

  $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  precio = :precio , reparacion = :reparacion, id_usuario=:id_usuario ,estado=:estado WHERE id = :id");

  $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
  $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
  $stmt->bindParam(":reparacion", $datos["reparacion"], PDO::PARAM_STR);
  $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
  $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

  if ($stmt->execute()) {

   return "ok";
  } else {

   return "error";
  }


  $stmt->close();
  $stmt = null;
 }
}
