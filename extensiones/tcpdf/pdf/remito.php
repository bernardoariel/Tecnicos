<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";


require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/empresa.controlador.php";
require_once "../../../modelos/empresa.modelo.php";

class imprimirRemito{

public $idventa;

public function traerImpresionRemito(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "id";
$valorVenta = $this->idventa;

$respuestaVenta = ControladorVentas::ctrMostrarRemitos($itemVenta, $valorVenta);
// echo '<pre>'; print_r($respuestaVenta); echo '</pre>';

$fecha = explode("-", $respuestaVenta["fecha"]);
$fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
$productos = json_decode($respuestaVenta["datos"], true);
$adeuda = number_format($respuestaVenta["total"],2);
// $impuesto = number_format($respuestaVenta["impuesto"],2);
$total = $adeuda;

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

// $itemCliente = "id";
// $valorCliente = $respuestaVenta["id_cliente"];

// $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

// $itemVendedor = "id";
// $valorVendedor = $respuestaVenta["id_vendedor"];

// $respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//TRAEMOS LA INFORMACIÓN DE LA EMPRESA
$itemEmpresa = "id";

$valorEmpresa = 1;
$respuestaEmpresa = ControladorEmpresa::ctrMostrarEmpresa($itemEmpresa, $valorEmpresa);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:150px"><img src="../../../$respuestaEmpresa[fotorecibo]"></td>

			<td style="background-color:white; width:140px">
				
				<div style="font-size:7px; text-align:right; line-height:15px;">
					
					<br>
					CUIT: $respuestaEmpresa[cuit]

					<br>
					Dirección: $respuestaEmpresa[direccion]

				</div>

			</td>

			<td style="background-color:white; width:140px">

				<div style="font-size:7px; text-align:right; line-height:15px;">
					
					<br>
					Teléfono: $respuestaEmpresa[telefono]
					
					<br>
					$respuestaEmpresa[email]

				</div>
				
			</td>

			<td style="background-color:white; width:110px; text-align:center;font-size:8px; color:red"><br><br>REMITO N.<br>$valorVenta</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">

				Cliente: $respuestaVenta[nombrecliente]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				Fecha: $fecha

			</td>

		</tr>

		

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------



foreach ($productos as $key => $item) {



$precioTotal = number_format($item["total"], 2);

$bloqueB = <<<EOF
	
	
	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:75px; text-align:center">
				$item[fecha]
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:95px; text-align:center">
				$item[codigo]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:75px; text-align:center">
				$item[nrofactura]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:200px; text-align:center"> 
				$item[detalle] $item[obs]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:85px; text-align:center">$ 
				$precioTotal
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloqueB, false, false, false, false, '');

}



$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td ></td>

			<td ></td>

		</tr>
		
		<tr>
		
			
			<td style="color:#333; background-color:white; width:340px; text-align:right">TOTAL: $ $total </td>

		

			

		</tr>

		
		

		


	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->Output('factura.pdf');

}

}

$factura = new imprimirRemito();
$factura -> idventa = $_GET["id"];
$factura -> traerImpresionRemito();

?>