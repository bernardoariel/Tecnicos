<?php

class ControladorGastos{

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarGastos($item, $valor){

		$tabla = "gastos";

		$respuesta = ModeloGastos::mdlMostrarGastos($tabla, $item);

		return $respuesta;

	}

	/*=============================================
	CREAR CATEGORIAS
	=============================================*/

	static public function ctrCrearGasto(){

		

		if(isset($_POST["importeGasto"])){

			$tabla = "gastos";

			$datos = array("nombre" => $_POST["tipoGasto"],
						   "obs" => $_POST["obsGasto"],
						   "importe" => $_POST["importeGasto"]);

			$respuesta = ModeloGastos::mdlCrearGasto($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La categoría ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "gastos";

								}
							})

				</script>';

			}

		}
	
	}		

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarGasto(){

		if(isset($_GET["idGasto"])){

			$tabla ="gastos";
			$datos = $_GET["idGasto"];
			

			$respuesta = ModeloGastos::mdlBorrarGasto($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "gastos";

									}
								})

					</script>';
			}
		 }
		
	}

	
}
