/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarGasto", function(){


	var idGasto = $(this).attr("idGasto");

	var datos = new FormData();
	datos.append("idGasto", idGasto);

	$.ajax({
		url: "ajax/gastos.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
     		console.log("respuesta", respuesta);



   //   		$("#editarCategoria").val(respuesta["categoria"]);
   //   		$("#idCategoria").val(respuesta["id"]);
     		
			// $("#editarMovimiento").html(respuesta["movimiento"]);
			// $("#editarMovimiento").val(respuesta["movimiento"]);
     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarGasto", function(){

	 var idGasto = $(this).attr("idGasto");
	 console.log("idGasto", idGasto);

	 swal({
	 	title: '¿Está seguro de borrar este Gasto?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar gasto!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=gastos&idGasto="+idGasto;

	 	}

	 })

})