/*=============================================
CARGAR LA TABLA 
=============================================*/
var table = $('.tablaClientes').DataTable({
//  "ajax":"ajax/datatable-vocabulario.ajax.php",
 dom: 'lBfrtip',/*Bfrtip*/
      buttons: [
        {
          extend: 'colvis',
          columns: ':not(:first-child)',
        }
        ],
    "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último",
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

  }

})
/*===========================================================
=            cambiar el color de la primera fila            =
===========================================================*/
function cambiarColor(){
  
  $("#tdclientes-1").css("background-color","#F9F9F9");
  $("#tdclientes-2").css("background-color","#F9F9F9");
  $("#tdclientes-3").css("background-color","#F9F9F9");
  $("#tdclientes-4").css("background-color","#F9F9F9");
  $("#tdclientes-5").css("background-color","#F9F9F9");
  $("#tdclientes-6").css("background-color","#F9F9F9");
  $("#tdclientes-7").css("background-color","#F9F9F9");
  $("#tdclientes-8").css("background-color","#F9F9F9");
  $("#tdclientes-9").css("background-color","#F9F9F9");

}

setTimeout(cambiarColor,5000);


/*=============================================
VER CLIENTES
=============================================*/
$(".tablaClientes").on("click", ".btnVerClienteEditar", function(){
  //TOMO LA VARIABLE DEL BOTON
  var idVerClienteEditar = $(this).attr("idCliente");


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
        //VALIDAR EL EMAIL
        if(respuesta['email']==null){
          $("#editarEmail").val("No Posee");
        }else{
          $("#editarEmail").val(respuesta['email']);
        }
        if(respuesta['whatsapp']=="NO"){
          $("#editarWs").prop("checked",false);
        }else{
          $("#editarWs").prop("checked",true);
        }
        
        //VALIDAR EL TRUE

      }//SUCESS
  })//AJAX

})

/*=============================================
EDITAMOS CLIENTE CON AJAX
=============================================*/
$("#btnEditarCliente").on("click", function(){
  //TOMO LA VARIABLE DEL BOTON
  var idCliente = $("#idClienteEditar").val();
  var editarCliente = $("#editarCliente").val(); 
  var editarDireccion = $("#editarDireccion").val();
  var editarTelefono = $("#editarTelefono").val();
  var editarObs = $("#editarObs").val();
  
  let editarCodPais = $('#editarCodPais').val();
  let editarWs;
  if( $('#editarWs').is(':checked') ) {

    editarWs  = "SI";

  }else{

     editarWs ="NO";
    
  }
if($('#editarConsultaMail').val() == "si"){
    
    if($("#editarEmail").val().indexOf('@', 0) == -1 || $("#editarEmail").val().indexOf('.', 0) == -1) {
      
      swal({
        title: "Error!",
        text: "Ingrese un Correo Valido",
        icon: "danger",
        button: "Continuar",
      });

      return false;

    }

}
console.log('editarEmail: ', $('#editarEmail').val());  

 
  // LOS CARGO EN EL FORMDATA DE UN AJAX
  var datos = new FormData();
  datos.append("idCliente", idCliente);
  datos.append("editarCliente", editarCliente);
  datos.append("editarDireccion", editarDireccion);
  datos.append("editarTelefono", editarTelefono);
  datos.append("editarObs", editarObs);
  datos.append("editarCodPais", editarCodPais);
  datos.append("editarWs", editarWs);
  datos.append("editarEmail", $('#editarEmail').val());
  //HAGO UN AJAX SIN JSON
  $.ajax({
      url:"ajax/clientes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success:function(respuesta){
        console.log("respuesta", respuesta);
        let subrespuesta = respuesta.substr(0, 7);
        console.log("subrespuesta", subrespuesta);

        switch (subrespuesta){
          //SI SE HA AGREGADO
          case "ok":
            swal({
            type: "success",
            title: "El cliente ha sido MODIFICADO correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            focusConfirm:true
            }).then(function(result){
              if (result.value) {
                window.location = "index.php?ruta=clientes&orden=fechacreacion";
              }
            })
            break;
          //SI TIENE CARACTERES NO VALIDOS
          case "charset":
            let posrespuesta = respuesta.substr(7, 15);
            swal({
              type: "error",
              title: "¡El cliente no puede llevar caracteres especiales como "+posrespuesta,
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              focusConfirm:true
              }).then(function(result){
              if (result.value) {
                window.location = "clientes";
              }
            })
            break;
          //SI EXISTE EN LA BD  
          case "duplica":
            swal({
              type: "error",
              title: "¡Ya existe ese cliente! Revise los datos",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              focusConfirm:true
              }).then(function(result){
              if (result.value) {
                 // window.location = "clientes";
              }
            }) 
            break;
          default:
            swal({
              type: "error",
              title: "Error ",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              focusConfirm:true
              }).then(function(result){
                if (result.value) {
                  // window.location = "clientes";
                }
              })
              break;
        }//switch  
      }//SUCCESS
  })//INICIO AJAX
})

/*=============================================
AGREGAR CLIENTE
=============================================*/
$("#btnCrearCliente").on("click",function(){
  // TOMO LOS VALORES QUE VOY A AGREGAR DESDE LOS INPUTS
  let nuevoCliente= $('#nuevoCliente').val();
  let nuevaDireccion = $('#nuevaDireccion').val();
  let nuevoTelefono = $('#nuevoTelefono').val();
  let nuevoObs = $('#nuevoObs').val();
  let nuevoCodPais = $('#nuevoCodPais').val();
  let nuevoWs;
  if( $('#nuevoWs').is(':checked') ) {

    nuevoWs  = "SI";

  }else{

     nuevoWs ="NO";
    
  }


 
  var nuevoEmail = $('#nuevoEmail').val();
  
  // LOS CARGO EN EL FORMDATA DE UN AJAX
  var datos = new FormData();
  datos.append("nuevoCliente", nuevoCliente);
  datos.append("nuevaDireccion", nuevaDireccion);
  datos.append("nuevoTelefono", nuevoTelefono);
  datos.append("nuevoObs", nuevoObs);
  datos.append("nuevoCodPais", nuevoCodPais);
  datos.append("nuevoWs",nuevoWs );
  datos.append("nuevoEmail", nuevoEmail);
  //HAGO UN AJAX 
  $.ajax({
      url:"ajax/clientes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success:function(respuesta){
        console.log("respuesta", respuesta);
        
        let subrespuesta = respuesta.substr(0, 7);
        console.log("subrespuesta", subrespuesta);

        switch (subrespuesta){
          //SI SE HA AGREGADO
          case "ok":
            swal({
            type: "success",
            title: "El cliente ha sido AGREGADO correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            focusConfirm:true
            }).then(function(result){
              if (result.value) {
                window.location = "index.php?ruta=clientes&orden=fechacreacion";
              }
            })
            break;
          //SI TIENE CARACTERES NO VALIDOS
          case "charset":
            let posrespuesta = respuesta.substr(7, 15);
            swal({
              type: "error",
              title: "¡El cliente no puede llevar caracteres especiales como "+posrespuesta,
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              focusConfirm:true
              }).then(function(result){
              if (result.value) {
                // window.location = "clientes";
              }
            })
            break;
          //SI EXISTE EN LA BD  
          case "duplica":
            swal({
              type: "error",
              title: "¡Ya existe ese cliente! Revise los datos",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              focusConfirm:true
              }).then(function(result){
              if (result.value) {
                // window.location = "clientes";
              }
            }) 
            break;
          default:
            swal({
              type: "error",
              title: "Error ",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              focusConfirm:true
              }).then(function(result){
                if (result.value) {
                  window.location = "clientes";
                }
              })
              break;
        }//switch  
      }//SUCCESS
  })//INICIO AJAX

})


/*=============================================
ELIMINAR CLIENTES
=============================================*/

$(".tablaClientes tbody").on("click", "button.btnEliminarCliente", function(){

  var idClienteEliminar = $(this).attr("idCliente");

  var clientes = new FormData();
  clientes.append("idVerClienteEditar", idClienteEliminar);

  $.ajax({

      url:"ajax/clientes.ajax.php",
      method: "POST",
      data: clientes,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

            swal({

              title: '¿Está seguro de eliminar a '+respuesta["nombre"]+'?',
              text: "¡Si no lo está puede cancelar la accíón!",
              type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  cancelButtonText: 'Cancelar',
                  confirmButtonText: 'Si, borrar cliente!'
                  }).then(function(result) {
                  if (result.value) {

                    var datos = new FormData();

                    datos.append("idClienteEliminar", idClienteEliminar);

                    $.ajax({

                        url:"ajax/clientes.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success:function(respuesta){

                          if(respuesta=="ok"){

                            swal({
                              type: "success",
                              title: "El cliente ha sido ELIMINADO correctamente",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                
                                if (result.value) {

                                  window.location = "clientes";

                                }

                              })
                            
                            }else{

                              swal({
                                type: "error",
                                title: "No se puede Eliminar",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                if (result.value) {

                                  window.location = "clientes";
                                }
                              })
                            }
                        }//sucess

                    })//ajax
                  }//dentro del swal
            })//swal
      }//success
    })//ajax

})

/*=============================================
=HACER UN FOCO EN EL PRIMER INPUT nuevoCliente=
=============================================*/
$('#modalAgregarCliente').on('shown.bs.modal', function () {

   $('.inputNuevo').val("");//elimino el contenido
   $('#nuevoCliente').focus();
   
})
/*=============================================
=HACER UN FOCO EN EL PRIMER INPUT editarCliente=
=============================================*/
$('#modalEditarCliente').on('shown.bs.modal', function () {
     
   $('#editarCliente').focus();

})
/*=============================================
          AL PRESIONAR ENTER --NUEVO--
=============================================*/
$("#nuevoCliente").keypress(function(e) {
  
  if(e.which == 13){
    e.preventDefault();
    $('#nuevaDireccion').focus();
  }

});

$("#nuevaDireccion").keypress(function(e) {
  
  if(e.which == 13){
    e.preventDefault();
    $('#nuevoTelefono').focus();
  }

});

$("#nuevoTelefono").keypress(function(e) {
  
  if(e.which == 13){
    e.preventDefault();
    $('#nuevoObs').focus();
  }

});

$("#nuevoObs").keypress(function(e) {
  
  if(e.which == 13){
    e.preventDefault();
    $('#btnCrearCliente').focus();
  }

});
/*=============================================
          AL PRESIONAR ENTER --EDICION--
=============================================*/
$("#editarCliente").keypress(function(e) {
  
  if(e.which == 13){
    e.preventDefault();
    $('#editarDireccion').focus();
  }

});

$("#editarDireccion").keypress(function(e) {
  
  if(e.which == 13){
    e.preventDefault();
    $('#editarTelefono').focus();
  }

});

$("#editarTelefono").keypress(function(e) {
  
  if(e.which == 13){
    e.preventDefault();
    $('#editarObs').focus();
  }

});

$("#editarObs").keypress(function(e) {
  
  if(e.which == 13){
    e.preventDefault();
    $('#btnEditarCliente').focus();
  }

});

$("#nuevoChkCodPais").on("change", function(){
 
  let chk=document.getElementById("nuevoChkCodPais").checked

  if(chk){

    $("#nuevoCodPais").attr("readonly", true);
    
  }else{

    $("#nuevoCodPais").attr("readonly", false);
    $("#nuevoCodPais").focus();
  }
  
})
$("#nuevoConsultaMail").on("change", function(){
  
  if($(this).val()=="si"){
    $("#nuevoEmail").attr("readonly", false);
    $("#nuevoEmail").focus();
  }else{
    $("#nuevoEmail").attr("readonly", true);
   
  }

})

$("#editarChkCodPais").on("change", function(){
 
  

  if(chk){

    $("#editarCodPais").attr("readonly", true);
    
  }else{

    $("#editarCodPais").attr("readonly", false);
    $("#editarCodPais").focus();
  }
  
})
$("#editarConsultaMail").on("change", function(){
  
  if($(this).val()=="si"){

    $("#editarEmail").attr("readonly", false);
    $("#editarEmail").focus();
  }else{
    $("#editarEmail").attr("readonly", true);
    
  }

})

