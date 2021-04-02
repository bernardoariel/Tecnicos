$(".btnVerEntregado").on("click", function(){
    var idServicioEntregado = $(this).attr("idServicioEntregado");
    console.log('idServicioEntregado: ', idServicioEntregado);
    var idServicioUsuarioReparar = $(this).attr("idUsuario");
  
    var servicios = new FormData();
  
    servicios.append("idVerServicioEditar",  idServicioEntregado);
    /**
     * 1:
     * 2:
     * 3:
     * 4:ENTREGADO
     */
    servicios.append("idSercicioEstado",  4);//4 es el valor de entregado
  
    $.ajax({
        url:"ajax/servicios.ajax.php",
        method: "POST",
        data: servicios,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
            console.log("respuesta", respuesta);
  
            $("#fechaIngresoTerminado").val(respuesta["fecha"].substr(0,10));
            $("#productoNombreTerminado").val(respuesta["producto"]);
            $("#problemaTerminado").val(respuesta["producto_info"]);
            $("#detallesTerminado").val(respuesta["problema"]);
            $("#presupuestoTerminado").val(respuesta["presupuesto"]);
            $("#fechaEntregaTerminado").val(respuesta["ultima_fecha"].substr(0,10));
            $("#reparacionTerminado").val(respuesta["reparacion"]);
            $("#precioTerminado").val(respuesta["precio"]);
            $("#tituloH4").text("Servicio Terminado de " + respuesta["cliente"]);

            //consultar tecnico
            var usuarios = new FormData();
            usuarios.append("idUsuarioServicio",  respuesta["id_usuario"]);//4 es el valor de entregado
            $.ajax({
                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: usuarios,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success:function(respuesta2){
                    console.log('respuesta: ', respuesta2);
                    $("#usuarioReparar").val(respuesta2["nombre"].toUpperCase());
          
                }//success
            })//ajax
  
        }//success
    })//ajax
})