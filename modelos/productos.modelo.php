<?php

require_once "conexion.php";

class ModeloProductos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProductos($tabla, $item, $valor, $orden, $forma){


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
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlNuevoProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre) VALUES (:nombre)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	
	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre =:nombre WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProducto($tabla, $datos){

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
	MOSTRAR PRODUCTOSSIN INCLUIR EL REGISTRO QUE INGRESO
	=============================================*/

	static public function mdlMostrarProductosNotIN($tabla, $idProducto , $nombreProducto){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id NOT IN (".$idProducto.") AND nombre = :nombreProducto");

		$stmt -> bindParam(":nombreProducto", $nombreProducto, PDO::PARAM_STR);

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