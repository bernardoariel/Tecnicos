<?php

require_once "conexion.php";

class ModeloGastos{



	/*=============================================
	MOSTRAR Gastos
	=============================================*/

	static public function mdlMostrarGastos($tabla, $item){

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

	/*=============================================
	CREAR GASTO
	=============================================*/

	static public function mdlCrearGasto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre,obs,importe) VALUES (:nombre,:obs,:importe)");

	
		$stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
		$stmt->bindParam(":obs", $datos['obs'], PDO::PARAM_STR);
		$stmt->bindParam(":importe", $datos['importe'], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function mdlEditarGasto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET categoria = :categoria WHERE id = :id");

		$stmt -> bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function mdlBorrarGasto($tabla, $datos){
		echo '<pre>'; print_r($datos); echo '</pre>';

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

}

