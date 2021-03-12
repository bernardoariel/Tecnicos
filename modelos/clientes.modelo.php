<?php

require_once "conexion.php";

class ModeloClientes{

	static public function mdlMostrarClientes($tabla, $item, $valor, $orden, $forma){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			if($orden == null){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla order by nombre $forma");

				$stmt -> execute();

				return $stmt -> fetchAll();

			}else{

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla order by $orden $forma");

				$stmt -> execute();

				return $stmt -> fetchAll();
			}

		}

		$stmt -> close();

		$stmt = null;

	}
	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function mdlEditarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, direccion = :direccion , telefono = :telefono, obs =:editarObs WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":editarObs", $datos["editarObs"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}
		

		$stmt->close();
		$stmt = null;

	}
	/*=============================================
	CREAR CLIENTE
	=============================================*/

	static public function mdlNuevoCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO `clientes`(`nombre`, `direccion`, `telefono`, `obs`) VALUES
					 (:nombre,:direccion,:telefono,:obs)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":obs", $datos["obs"], PDO::PARAM_STR);

			   
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function mdlEliminarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}




	
	/*=============================================
	MOSTRAR CLIENTES SIN INCLUIR EL REGISTRO QUE INGRESO
	=============================================*/

	static public function mdlMostrarClientesNotIN($tabla, $idCliente , $nombreCliente){

			// echo "SELECT * FROM $tabla WHERE id NOT IN (".$idProducto.") AND nombre = '$nombreProducto'";
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id NOT IN (".$idCliente.") AND nombre = :nombreCliente");

			$stmt -> bindParam(":nombreCliente", $nombreCliente, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}
	/*=============================================
	MOSTRAR PARAMETROS
	=============================================*/

	static public function mdlMostrarCaracteresEspeciales($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item order by id desc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
			

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla order by id desc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}
}