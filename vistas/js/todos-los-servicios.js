/*=============================================
VER CLIENTES
=============================================*/
$(".tablaServicios").on("click", ".btnVerCLiente", function(){
    //TOMO LA VARIABLE DEL BOTON
    var idVerClienteEditar = $(this).attr("idCliente");
    idVerClienteEditar
  
    // LOS CARGO EN EL FORMDATA DE UN AJAX
    var datos = new FormData();
    datos.append("idVerClienteEditar", idVerClienteEditar);
    //HAGO UN AJAX CON JSON
    $.ajax({
        url:"ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
          // VEO LA RESPUESTA
          console.log("respuesta", respuesta);       
          //CARGO LA RESPUESTA EN LOS INPUT
          $("#idClienteEditar").val(respuesta["id"]);
          $("#editarCliente").val(respuesta["nombre"]);
          $("#editarDireccion").val(respuesta["direccion"]);
          $("#editarTelefono").val(respuesta["telefono"]);
          $("#editarObs").val(respuesta["obs"]);
        }//SUCESS
    })//AJAX
  
  })