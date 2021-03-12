/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarComprobante", function(){

	var idComprobante = $(this).attr("idComprobante");
	console.log("idComprobante", idComprobante);

	var datos = new FormData();
	datos.append("idComprobante", idComprobante);

	$.ajax({
		url: "ajax/comprobantes.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
     		
     		console.log("respuesta", respuesta);

     		$("#editarRegistro").val(respuesta["numero"]);
     		$("#idComprobante").val(respuesta["id"]);
     		
			
     	}

	})


})

