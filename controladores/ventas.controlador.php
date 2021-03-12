<?php

class ControladorVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVentas($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR REMITOS
	=============================================*/
	static public function ctrMostrarRemitos($item, $valor){

		$tabla = "remitos";

		$respuesta = ModeloVentas::mdlMostrarRemitos($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrMostrarVentasClientes($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentasClientes($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarGastitos($item, $valor){

		$tabla = "gastos";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearVenta(){

		
		if(isset($_POST["nuevaVenta"])){

			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/

			$listaProductos = json_decode($_POST["listaProductos"], true);
			

			// $totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {

				// TRAER EL STOCK
				$tablaProductos = "productos";

			    $item = "id";
			    $valor = $value["id"];
			    $orden = "id";

				$stock = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);
				
				// VER QUE TIPO DE STOCK TIENE
				$item = "id";
			    $valor = $stock["id_categoria"];

			    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
			    echo '<pre>'; print_r($categorias); echo '</pre>';

				// SUMAR UNA VENTA
			    $item1a = "ventas";
				$valor1a = $value["cantidad"] + $stock["ventas"];

				$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);
				
				if($categorias["movimiento"]=="SI"){
					// SUMAR STOCK
				    $item1b = "stock";
					$valor1b = $stock["stock"]-$value["cantidad"];

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $value["id"]);
					
				} 

			}
			

			$tablaClientes = "clientes";

			$item = "id";
			$valor = $_POST["seleccionarCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);
			

			$item1a = "compras";
			$valor1a = $traerCliente["compras"]+1;

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

			$item1b = "ultima_compra";

			
			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$valor1b = $fecha.' '.$hora;

			$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

			/*=============================================
			FORMATEO LOS DATOS
			=============================================*/	

			$fecha = explode("-",$_POST["fecha"]); //15-05-2018
			$fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];

			if ($_POST["listaMetodoPago"]=="CTA.CORRIENTE"){
				
				$adeuda=$_POST["totalVenta"];

				$fechapago="0000-00-00";
				
			}else{
				
				$adeuda=0;

				$fechapago = $fecha;
			}

			

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "ventas";



			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "fecha"=>$fecha,
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["nuevaVenta"],
						   "nrofc"=>$_POST["nrocomprobante"],
						   "detalle"=>strtoupper($_POST["busqueda"]),
						   "productos"=>$_POST["listaProductos"],
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"],
						   "adeuda"=>$adeuda,
						   "obs"=>strtoupper($_POST["obs"]),
						   "metodo_pago"=>$_POST["listaMetodoPago"],
						   "fechapago"=>$fechapago);

			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

			if($respuesta == "ok"){

				/*=============================================
				COMPARA EL NUMERO DE COMPROBANTE
				=============================================*/
				 $nrofc = intval($_POST["nrocomprobante"]);

				 //ULTIMO NUMERO DE COMPROBANTE
				  $item = "nombre";
				  $valor = "REGISTRO";

				  $nroComprobante = ControladorVentas::ctrUltimoComprobante($item, $valor);
				  
				  
				
				  if($nrofc==$nroComprobante["numero"]){

				  	$tabla="nrocomprobante";

					$nrofc=$nrofc+1;

				  	$datos = array("nombre"=>$valor,
						   "numero"=>$nrofc);

				  	
				  	ModeloVentas::mdlAgregarNroComprobante($tabla, $datos);
				  }

				  
				  $nroComprobante = substr($_POST["nuevaVenta"],8);

				  //ULTIMO NUMERO DE COMPROBANTE
				  $item = "nombre";
				  $valor = "FC";

				  $registro = ControladorVentas::ctrUltimoComprobante($item, $valor);
				  
				  
				
				  if($nroComprobante==$registro["numero"]){

				  	$tabla="nrocomprobante";

					$nroComprobante=$nroComprobante+1;

				  	$datos = array("nombre"=>$valor,
						   "numero"=>$nroComprobante);

				  	
				  	ModeloVentas::mdlAgregarNroComprobante($tabla, $datos);
				  }




				echo'<script>

				localStorage.removeItem("rango");

				

								window.location = "ventas";


				</script>';


			}

		 }

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function ctrEditarVenta(){

		if(isset($_POST["editarVenta"])){
			

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "ventas";

			$item = "codigo";
			$valor = $_POST["editarVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			$productos =  json_decode($traerVenta["productos"], true);

			$totalProductosComprados = array();

			foreach ($productos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);
				
				$tablaProductos = "productos";

				$item = "id";
				$valor = $value["id"];
				$orden = "id";

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

				// VER QUE TIPO DE STOCK TIENE
				$item = "id";
			    $valor = $traerProducto["id_categoria"];

			    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

				$item1a = "ventas";
				$valor1a = $traerProducto["ventas"] - $value["cantidad"];

				$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				if($categorias["movimiento"]=="SI"){

					$item1b = "stock";
					$valor1b = $value["cantidad"] + $traerProducto["stock"];

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
				}

			}

			$tablaClientes = "clientes";

			$itemCliente = "id";
			$valorCliente = $_POST["seleccionarCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

			$item1a = "compras";
			$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/

			$listaProductos_2 = json_decode($_POST["listaProductos"], true);

			$totalProductosComprados_2 = array();

			foreach ($listaProductos_2 as $key => $value) {

				array_push($totalProductosComprados_2, $value["cantidad"]);
				
				$tablaProductos_2 = "productos";

				$item_2 = "id";
				$valor_2 = $value["id"];
				$orden = "id";

				$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2, $orden);

				// VER QUE TIPO DE STOCK TIENE
				$item = "id";
			    $valor = $traerProducto_2["id_categoria"];

			    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

				$item1a_2 = "ventas";
				$valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];

				$nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

				if($categorias["movimiento"]=="SI"){
					$item1b_2 = "stock";
					$valor1b_2 = $value["stock"];

					$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);
				}

			}

			$tablaClientes_2 = "clientes";

			$item_2 = "id";
			$valor_2 = $_POST["seleccionarCliente"];

			$traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);

			$item1a_2 = "compras";
			$valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];

			$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);

			$item1b_2 = "ultima_compra";

			date_default_timezone_set('America/Bogota');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$valor1b_2 = $fecha.' '.$hora;

			$fechaCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["editarVenta"],
						   "productos"=>$_POST["listaProductos"],
						   "detalle"=>$_POST["busqueda"],
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"],
						   "adeuda"=>$_POST["totalVenta"],
						   "obs"=>$_POST["obs"],
						   "fechapago"=>"0000-00-00",
						   "metodo_pago"=>$_POST["listaMetodoPago"]);


			$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				

								window.location = "ventas";

							

				</script>';

			}

		}

	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function ctrEliminarVenta(){

		if(isset($_GET["idVenta"])){

			$tabla = "ventas";

			$item = "id";
			$valor = $_GET["idVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA COMPRA
			=============================================*/

			$tablaClientes = "clientes";

			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloVentas::mdlEliminarVenta($tabla, $itemVentas, $valorVentas);

			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {
				
				if($value["id_cliente"] == $traerVenta["id_cliente"]){

					array_push($guardarFechas, $value["fecha"]);

				}

			}

			if(count($guardarFechas) > 1){

				if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}else{

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}


			}else{

				$item = "ultima_compra";
				$valor = "0000-00-00 00:00:00";
				$valorIdCliente = $traerVenta["id_cliente"];

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

			}

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/

			$productos =  json_decode($traerVenta["productos"], true);

			$totalProductosComprados = array();

			foreach ($productos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);
				
				$tablaProductos = "productos";

				$item = "id";
				$valor = $value["id"];
				$orden = "id";

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

				$item1a = "ventas";
				$valor1a = $traerProducto["ventas"] - $value["cantidad"];

				$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["cantidad"] + $traerProducto["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "clientes";

			$itemCliente = "id";
			$valorCliente = $traerVenta["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

			$item1a = "compras";
			$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

			/*=============================================
			ELIMINAR VENTA
			=============================================*/

			$respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET["idVenta"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La venta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}		
		}

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}
	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasVentasCobrados($fechaInicial, $fechaFinal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechasVentasCobrados($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasVentasNroFc($fechaInicial, $fechaFinal, $nrofc){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechasVentasNroFc($tabla, $fechaInicial, $fechaFinal, $nrofc);

		return $respuesta;
		
	}

	/*=============================================
	LISTADO DE ETIQUETAS
	=============================================*/	

	static public function ctrEtiquetasVentas(){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlEtiquetasVentas($tabla);

		return $respuesta;
		
	}

	/*=============================================
	LISTADO DE REMITOS
	=============================================*/	

	static public function ctrRemitosVentas(){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRemitosVentas($tabla);

		return $respuesta;
		
	}
	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasVentasCtaCorriente($fechaInicial, $fechaFinal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::RangoFechasVentasCtaCorriente($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	SELECCIONO UNA FACTURA PARA LA ETIQUETA
	=============================================*/
	static public function ctrSeleccionarVenta($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSeleccionarVenta($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MUESTRO LAS FACTURAS SELECCIONADAS
	=============================================*/
	static public function ctrMostrarFacturasSeleccionadas($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarFacturasSeleccionadas($tabla, $item, $valor);

		return $respuesta;

	}
	/*=============================================
	BORRAR LAS FACTURAS SELECCIONADAS
	=============================================*/
	static public function ctrBorrarFacturasSeleccionadas($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlBorrarFacturasSeleccionadas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	BORRAR PAGO DE LAS FACTURAS
	=============================================*/
	static public function ctrEliminarPago(){

		if(isset($_GET["idPago"])){

			$tabla = "ventas";

			$valor =$_GET["idPago"];

			$respuesta = ModeloVentas::mdlEliminarPago($tabla,$valor);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El pago ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}		
		}

	}
	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	static public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = "ventas";

			$fechaInicial = null;
            $fechaFinal = null;

         	$respuesta = ControladorVentas::ctrRangoFechasVentasCtaCorriente($fechaInicial, $fechaFinal);

         	
			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

					<tr>
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>	
					<td style='font-weight:bold; border:1px solid #eee;'>CODIGO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>
					
					<td style='font-weight:bold; border:1px solid #eee;'>REPUESTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>GABRIEL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>GANANCIA</td>
					
					<td style='font-weight:bold; border:1px solid #eee;'></td>
					<td style='font-weight:bold; border:1px solid #eee;'>VALIDACION</td>
						
					</tr>");
			$i=2;
			foreach ($respuesta as $row => $item){
				$i++;
				$cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
				$vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);
				
			    echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["fecha"]."</td> 
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td>
			 			<td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$item["total"]."</td>");

			 	$productos =  json_decode($item["productos"], true);
			 	
			 	$gp = 0;
			 	$servicioLocal = 0;
			 	$repuesto = 0;
			 	
			 	foreach ($productos as $key => $valueProductos) {

			 		switch ($valueProductos['id']) {
			 			case 23:
			 				# code...
			 			    $gp += intval($valueProductos['total']);
			 				break;
			 			case 22:
			 				# code...
			 			    $servicioLocal += intval($valueProductos['total']);
			 				break;
			 			default:
			 				# code...
			 				$repuesto += intval($valueProductos['total']);
			 				break;
			 		}
			 			
		 		
		 			
			 	}
			 	$validacion = $item["total"] - $repuesto - $servicioLocal - $gp;

			 	echo utf8_decode("<td style='border:1px solid #eee;'>".$repuesto."</td><td style='border:1px solid #eee;'>".$gp."</td><td style='border:1px solid #eee;'>".$servicioLocal."</td><td style='border:1px solid #eee;'>   </td><td style='border:1px solid #eee;'>".$validacion."</td>
						
		 			</tr>
					
		 			");


			}
		
			echo utf8_decode("<tr></tr>
							  
					<tr>
					<td style='font-weight:bold; border:1px solid #eee;'></td>	
					<td style='font-weight:bold; border:1px solid #eee;'></td>
					<td style='font-weight:bold; border:1px solid #eee;'></td>
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>
					
					<td style='font-weight:bold; border:1px solid #eee;'>REPUESTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>GABRIEL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>GANANCIA</td>
					
					<td style='font-weight:bold; border:1px solid #eee;'></td>
					<td style='font-weight:bold; border:1px solid #eee;'>VALIDACION</td>
						
					</tr>	
					<tr>
						<td colspan='2' style='font-weight:bold;pull-right'>SUBTOTALES<td>
						
						<td style='font-weight:bold;'>=SUMA(D2:D$i)</td>
						<td style='font-weight:bold;'>=SUMA(E2:E$i)</td>
						<td style='font-weight:bold;'>=SUMA(F2:F$i)</td>
						<td style='font-weight:bold;'>=SUMA(G2:G$i)</td>
						<td><td>
						<td style='font-weight:bold;'>=SUMA(I2:I$i)</td>
					</tr>

					");

			echo utf8_decode("<tr></tr>");

          	$item = null;
            $valor = null;

            $gastos = ControladorVentas::ctrMostrarGastitos($item, $valor);
          	$p=$i+2;
            $g=$i+5;
            foreach ($gastos as $key => $value2) {

            	switch ($value2['nombre']) {
            		case 'COMPRA':
            			# code...
            			$compra = $value2['importe'];
            			$ariel = 0;
            			$gabriel = 0;
            			break;
            		case 'ARIEL':
            			# code...
            			$compra = 0;
            			$ariel = $value2['importe'];
            			$gabriel = 0;
            			break;
            		case 'GABRIEL':
            			# code...
            			$compra = 0;
            			$ariel = 0;
            			$gabriel = $value2['importe'];
            			break;
            		
            		
            	}
           		
           		$g++;
		         echo utf8_decode("<tr>
							<td style='font-weight:bold; border:1px solid #eee;'></td>	
							<td style='font-weight:bold; border:1px solid #eee;'>".$value2['nombre']."</td>
							<td style='font-weight:bold; border:1px solid #eee;'>".$value2['obs']."</td>
							<td style='font-weight:bold; border:1px solid #eee;'>".(-1)*$value2['importe']."</td>
							
							<td style='font-weight:bold; border:1px solid #eee;'>".(-1)*$compra."</td>
							<td style='font-weight:bold; border:1px solid #eee;'>".(-1)*$gabriel."</td>
							<td style='font-weight:bold; border:1px solid #eee;'>".(-1)*$ariel."</td>
							
							<td style='font-weight:bold; border:1px solid #eee;'></td>
							<td style='font-weight:bold; border:1px solid #eee;'></td></tr>");
		     }

			echo utf8_decode("<tr></tr>
							  <tr></tr>
							  <tr></tr>

					<tr>
						<td colspan='2'><td>
						
						<td style='font-weight:bold;color:red'>=SUMA(D$p:D$g)</td>
						<td style='font-weight:bold;color:red'>=SUMA(E$p:E$g)</td>
						<td style='font-weight:bold;color:red'>=SUMA(F$p:F$g)</td>
						<td style='font-weight:bold;color:red'>=SUMA(G$p:G$g)</td>
						<td style='font-weight:bold;color:red'><td>
						<td style='font-weight:bold;color:red'>=SUMA(I$p:I$g)</td>
					</tr>

					<tr>
					<td  border:1px solid #eee;'>FECHA</td>	
					<td style='font-weight:bold; border:1px solid #eee;'>CODIGO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>
					
					<td style='font-weight:bold; border:1px solid #eee;'>REPUESTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>GABRIEL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>GANANCIA</td>
					
					<td style='font-weight:bold; border:1px solid #eee;'></td>
					<td style='font-weight:bold; border:1px solid #eee;'>VALIDACION</td>
						
					</tr>");
			echo "</table>";

		}

	}


	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	static public function ctrSumaTotalVentas(){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;

	}

	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	static public function ctrSumaTotalVentasEntreFechas($fechaInicial,$fechaFinal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentasEntreFechas($tabla,$fechaInicial,$fechaFinal);

		return $respuesta;

	}

	static public function ctrUltimoComprobante($item,$valor){

		$tabla = "nrocomprobante";

		$respuesta = ModeloVentas::mdlUltimoComprobante($tabla, $item, $valor);
		
		return $respuesta;
				
		
	} 

	#ACTUALIZAR PRODUCTO EN CTA_ART_TMP
	#---------------------------------
	static public function ctrAgregarTabla($datos){

		
		echo '<table class="table table-bordered">
                <tbody>
                    <tr>
                      <th style="width: 10px;">#</th>
                      <th style="width: 10px;">Cantidad</th>
                      <th style="width: 400px;">Articulo</th>
                      <th style="width: 70px;">Precio</th>
                      <th style="width: 70px;">Total</th>
                      <th style="width: 10px;">Opciones</th> 
                    </tr>';
		
			echo "<tr>
					
					<td>1.</td>
					<td><span class='badge bg-red'>".$datos['cantidadProducto']."</span></td>
					<td>".$datos['productoNombre']."</td>
					<td style='text-align: right;'>$ ".$datos['precioVenta'].".-</td>
					<td style='text-align: right;'>$ ".$datos['cantidadProducto']*$datos['precioVenta'].".-</td>
					<td><button class='btn btn-link btn-xs' data-toggle='modal' data-target='#myModalEliminarItemVenta'><span class='glyphicon glyphicon-trash'></span></button></td>
					
				  </tr>";
				
		echo '</tbody></table>';
				
		
	}

	/*=============================================
	REALIZAR Pago
	=============================================*/

	static public function ctrRealizarPago($redireccion){

		if(isset($_POST["nuevoPago"])){

			$adeuda = $_POST["adeuda"]-$_POST["nuevoPago"];

			$tabla = "ventas";

			

			$fechaPago = explode("-",$_POST["fechaPago"]); //15-05-2018
  	        $fechaPago = $fecha[2]."-".$fecha[1]."-".$fecha[0];

			

			$datos = array("id"=>$_POST["idPago"],
						   "adeuda"=>$adeuda,
						   "fecha"=>$_POST["fechaPago"]);

		
			
			$respuesta = ModeloVentas::mdlRealizarPago($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "'.$redireccion.'";

								}
							})

				</script>';

			}	
		}


	}
	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrHistorial(){

		// FACTURAS
		$tabla = "cta";
		$respuesta = ModeloVentas::mdlHistorial($tabla);
		

		foreach ($respuesta as $key => $value) {

			// veo los items de la factura
			$tabla = "ctaart";
			$repuestos = ModeloVentas::mdlHistorialCta_art($tabla,$value['idcta']);
			
			$productos='';

			for($i = 0; $i < count($repuestos)-1; $i++){
				
				$productos = '{"id":"'.$repuestos[$i]["idarticulo"].'",
			      "descripcion":"'.$repuestos[$i]["nombre"].'",
			      "cantidad":"'.$repuestos[$i]["cantidad"].'",
			      "precio":"'.$repuestos[$i]["precio"].'",
			      "total":"'.$repuestos[$i]["precio"].'"},';
			}

			$productos = $productos . '{"id":"'.$repuestos[count($repuestos)-1]["idarticulo"].'",
			      "descripcion":"'.$repuestos[count($repuestos)-1]["nombre"].'",
			      "cantidad":"'.$repuestos[count($repuestos)-1]["cantidad"].'",
			      "precio":"'.$repuestos[count($repuestos)-1]["precio"].'",
			      "total":"'.$repuestos[count($repuestos)-1]["precio"].'"}';

			$productos ="[".$productos."]";
			
			echo '<pre>'; print_r($productos); echo '</pre>';
			
			// datos para cargar la factura
			$tabla = "ventas";
			$datos = array("id_vendedor"=>1,
						   "fecha"=>$value['fecha'],
						   "id_cliente"=>$value["idcliente"],
						   "codigo"=>$key,
						   "nrofc"=>$value["nrofc"],
						   "detalle"=>strtoupper($value["obs"]),
						   "productos"=>$productos,
						   "impuesto"=>0,
						   "neto"=>0,
						   "total"=>$value["importe"],
						   "adeuda"=>$value["adeuda"],
						   "obs"=>"",
						   "metodo_pago"=>$value["detallepago"],
						   "fechapago"=>$value['fecha']);

			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);
			

		}
		
		return $respuesta;

		
		
	}



}

