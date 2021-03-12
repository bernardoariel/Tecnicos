<?php

require_once "conexion.php";

class ModeloVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarVentas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarRemitos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id desc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id desc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarVentasClientes($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(fecha,codigo, id_cliente, id_vendedor,detalle, productos,nrofc, impuesto, neto, total,adeuda,observaciones,metodo_pago,fechapago) VALUES (:fecha,:codigo, :id_cliente, :id_vendedor,:detalle, :productos,:nrofc, :impuesto, :neto, :total,:adeuda,:obs, :metodo_pago,:fechapago)");

		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":nrofc", $datos["nrofc"], PDO::PARAM_STR);
		$stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":adeuda", $datos["adeuda"], PDO::PARAM_STR);
		$stmt->bindParam(":obs", $datos["obs"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":fechapago", $datos["fechapago"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlEditarVenta($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  id_cliente = :id_cliente, id_vendedor = :id_vendedor, productos = :productos,detalle = :detalle, impuesto = :impuesto, neto = :neto, total= :total,adeuda =:adeuda,observaciones =:obs, metodo_pago = :metodo_pago,fechapago = :fechapago WHERE codigo = :codigo");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":adeuda", $datos["adeuda"], PDO::PARAM_STR);
		$stmt->bindParam(":obs",$datos["obs"], PDO::PARAM_STR);
		$stmt->bindParam(":fechapago", $datos["fechapago"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	

	/*=============================================
	SELECCIONAR VENTA
	=============================================*/

	static public function mdlSeleccionarVenta($tabla,$item, $datos){

		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  seleccionado = 1 WHERE id =:id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarFacturasSeleccionadas($tabla, $item, $valor){

		

		$stmt = Conexion::conectar()->prepare("SELECT ventas.id as id,ventas.nrofc as nrofc,ventas.detalle as detalle,ventas.observaciones as obs,ventas.productos as productos,ventas.fecha as fecha,clientes.nombre as nombre,clientes.id as id_cliente, ventas.codigo as codigo, ventas.total as total FROM ventas,clientes WHERE seleccionado = 1 and clientes.id = ventas.id_cliente ORDER BY ventas.id ASC");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		
		$stmt -> close();

		$stmt = null;

	}
	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlBorrarFacturasSeleccionadas($tabla, $item, $valor){

		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET seleccionado = 0 ");

		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;


	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function mdlEliminarVenta($tabla, $datos){

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
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC limit 60");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%' ORDER BY id DESC limit 60");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			// $fechaFinal = new DateTime();
			// $fechaFinal->add(new DateInterval('P1D'));
			// $fechaFinal2 = $fechaFinal->format('Y-m-d');
			// echo "SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' ORDER BY id DESC";
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' ORDER BY id DESC");
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	static public function mdlRangoFechasVentasCobrados($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC limit 60");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechapago like '%$fechaFinal%' ORDER BY id DESC limit 60");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaFinal = new DateTime();
			$fechaFinal->add(new DateInterval('P1D'));
			$fechaFinal2 = $fechaFinal->format('Y-m-d');

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechapago BETWEEN '$fechaInicial' AND '$fechaFinal2' ORDER BY id DESC");
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasVentasNroFc($tabla, $fechaInicial, $fechaFinal, $nrofc){
		

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where nrofc='".$nrofc."' ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%' and $nrofc ='".$nrofc."' ORDER BY id DESC");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaFinal = new DateTime();
			$fechaFinal->add(new DateInterval('P1D'));
			$fechaFinal2 = $fechaFinal->format('Y-m-d');

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal2' and $nrofc ='".$nrofc."' ORDER BY id DESC");
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	RANGO FECHAS clientes que deben
	=============================================*/	

	static public function RangoFechasVentasCtaCorriente($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where adeuda > 0 ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE adeuda > 0 and fecha like '%$fechaFinal%' ORDER BY id DESC");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaFinal = new DateTime();
			$fechaFinal->add(new DateInterval('P1D'));
			$fechaFinal2 = $fechaFinal->format('Y-m-d');

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE adeuda > 0 AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal2' ORDER BY id DESC ");
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}
	/*=============================================
	LISTADO DE ETIQUETAS
	=============================================*/	

	static public function mdlEtiquetasVentas($tabla){

		

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha DESC limit 30");

		$stmt -> execute();

		return $stmt -> fetchAll();	

		$stmt -> close();

		$stmt = null;



	}

	/*=============================================
	LISTADO DE ETIQUETAS
	=============================================*/	

	static public function mdlRemitosVentas($tabla){

		

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE remito IS NULL ORDER BY fecha DESC limit 500");

		$stmt -> execute();

		return $stmt -> fetchAll();	

		$stmt -> close();

		$stmt = null;



	}
	/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaTotalVentas($tabla){	

		// VENTAS DEL DIA

		$fechaFinal = new DateTime();
		
		$fechaFinal2 = $fechaFinal->format('Y-m-d');

		$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla where fecha='".$fechaFinal2."'");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaTotalVentasEntreFechas($tabla,$fechaInicial,$fechaFinal){	

		// VENTAS DEL DIA

		$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla where fecha BETWEEN '".$fechaInicial."' and '".$fechaFinal."'");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlUltimoComprobante($tabla, $item, $valor){

		
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();
		

		$stmt->close();

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlAgregarNroComprobante($tabla, $datos){
		

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET numero = :numero WHERE nombre = :nombre");

		
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":numero", $datos["numero"], PDO::PARAM_INT);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlAgregarRemito($tabla, $datos){
		

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idremito, idcliente, nombrecliente, datos, total,fecha) VALUES (:idremito,:id_cliente, :nombre_cliente, :datos, :total, :fecha)");

		$stmt->bindParam(":idremito", $datos["idremito"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre_cliente", $datos["nombre_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":datos", $datos["datos"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlRealizarPago($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE ventas SET adeuda = ".$datos["adeuda"].", fechapago='".$datos["fecha"]."' WHERE id = ".$datos["id"]);

		// $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		// $stmt->bindParam(":adeuda", $datos["adeuda"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlAgregarRemitoFC($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET remito = ".$datos["remito"]." WHERE id = ".$datos["id"]);

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":remito", $datos["remito"], PDO::PARAM_INT);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlHistorial($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where tipo='FC' ");

			$stmt -> execute();

			return $stmt -> fetchAll();	

	}

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlHistorialCta_art($tabla, $idcta){

		 // echo "SELECT * FROM $tabla where idcta=".$idcta;
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where idcta=".$idcta);

		$stmt -> execute();

		return $stmt -> fetchAll();

		
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ELIMINAR PAGO
	=============================================*/

	static public function mdlEliminarPago($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  fechapago = '0000-00-00', adeuda = total WHERE id = :id");

		
		$stmt->bindParam(":id", $valor, PDO::PARAM_INT);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	
}