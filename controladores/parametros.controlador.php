<?php 


class ControladorParametros{

	/*=============================================
	MOSTRAR PARAMETROS
	=============================================*/

	static public function ctrMostrarParametros($item, $valor){

		$tabla = "parametros";

		$respuesta = ModeloParametros::mdlMostrarParametros($tabla, $item, $valor);

		return $respuesta;

	}
}


?>
