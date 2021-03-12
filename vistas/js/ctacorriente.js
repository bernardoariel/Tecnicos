/*=============================================
SELECCIONO EL PRODUCTO
=============================================*/
$("#btn-pagartodo").on("click",function(){

    var datos = new FormData();
    datos.append("todos", "todos");

  	$.ajax({

	    url:"ajax/ctacorriente.ajax.php",
	    method: "POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,

    	success:function(respuesta){
        
        }
})
})