/*=============================================
CARGAR LA TABLA 
=============================================*/
var table = $('.tablaServicios').DataTable({
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

$("#dataTables_length").remove();

$('#selectCliente').select2({}).focus(function () { $(this).select2('focus'); });

// on first focus (bubbles up to document), open the menu
$(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
       
       $(this).closest(".select2-container").siblings('select:enabled').select2('open');
 
       $(".select2-selection__rendered").hide();

});

// steal focus during close - only capture once and stop propogation
$('select.select2').on('select2:closing', function (e) {
       
       $(e.target).data("select2").$selection.one('focus focusin', function (e) {
              
              e.stopPropagation();

       });    

});

 
// $(".textoNumero").numeric();
/*=============================================
=HACER UN FOCO EN EL PRIMER INPUT nuevoCliente=
=============================================*/
$('#modalAgregarServicio').on('shown.bs.modal', function () {

       $('#selectCliente').focus();

})

$('#modalSelectServicio').on('shown.bs.modal', function () {

       $('#selectCliente').focus();
	
})

$('#modalTerminarServicio').on('shown.bs.modal', function () {

       $('#servicioProductoInfoTerminar').focus();
  
})

/*=============================================
          AL PRESIONAR ENTER --NUEVO--
=============================================*/
$(".select2").keypress(function(e) {
  
       if(e.which == 13){

              e.preventDefault();
    
              $(this).val('2').trigger('change.select2');

       }

});

$("#selectCliente").change(function(){

	$("#selectCliente .select2-selection__rendered").show();
    //alert($(this).val());
    var idVerClienteEditar = $(this).val();
    console.log('idVerClienteEditar: ', idVerClienteEditar);
    if(idVerClienteEditar==0){

      $("#servicioCliente").val("INGRESE EL NOMBRE");
      $("#servicioTelefono").val("0000000000");
      $("#servicioCliente").focus();
      $("#servicioCliente").select();
      $("#idCLienteServicio").val("0");
      idVerClienteEditar=1;

	  }else{
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
		        $("#servicioCliente").val(respuesta["nombre"]);
		        $("#servicioTelefono").val(respuesta["telefono"]);
		        $("#servicioTelefono").select();
				    $("#servicioTelefono").focus();
	
		      }//SUCESS
		})//AJAX
	}//IF

	// $("#modalSelectServicio").modal('toggle');
    $(this).parent().remove();
});

$("#selectCliente2").change(function(){

	$("#selectCliente2 .select2-selection__rendered").show();
	//alert($(this).val());
	var idVerClienteEditar = $(this).val();

	if(idVerClienteEditar==1){

		$("#servicioCliente").val("INGRESE EL NOMBRE");
		$("#servicioTelefono").val("0000000000");
		$("#servicioCliente").focus();



	}else{
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
		        $("#servicioCliente").val(respuesta["nombre"]);
		        $("#servicioTelefono").val(respuesta["telefono"]);
		        $("#servicioTelefono").select();
				    $("#servicioTelefono").focus();
	
		      }//SUCESS
		})//AJAX
	}//IF

	$("#modalSelectServicio").modal('toggle');

});
$("#bsqCliente").on("click", function(){

	$("#modalSelectServicio").modal('toggle');

})


/*=============================================
EDITAMOS PRODUCTOS CON AJAX
=============================================*/
$("#btnCrearServicio").on("click", function(){
	
	var servicioCliente = $("#servicioCliente").val();
  var servicioTelefono = $("#servicioTelefono").val(); 
  var servicioProductoId = $("#servicioProducto").val();
	var servicioProblema = $("#servicioProblema").val(); 
	var servicioProductoInfo = $("#servicioProductoInfo").val(); 
	var servicioIdUsuario = $("#servicioIdUsuario").val(); 
  var servicioPresupuesto = $("#servicioPresupuesto").val();
  var idCLienteServicio =	$("#idCLienteServicio").val();


  // LOS CARGO EN EL FORMDATA DE UN AJAX
	var datos = new FormData();
	datos.append("servicioCliente", servicioCliente);
	datos.append("servicioTelefono", servicioTelefono);
	datos.append("servicioProductoId", servicioProductoId);
	datos.append("servicioProblema", servicioProblema);
	datos.append("servicioProductoInfo", servicioProductoInfo);
	datos.append("servicioIdUsuario", servicioIdUsuario);
  datos.append("servicioPresupuesto", servicioPresupuesto);
  datos.append("idCLienteServicio", idCLienteServicio);

	$.ajax({
      url:"ajax/servicios.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success:function(respuesta){
          console.log("respuesta--2", respuesta);
          let subrespuesta = respuesta.substr(0, 7);

          switch (subrespuesta){
              //SI SE HA AGREGADO
              case "ok":
                swal({
                type: "success",
                title: "El Servicio ha sido AGREGADO correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                focusConfirm:true
                }).then(function(result){
                  if (result.value) {
                    window.location = "index.php?ruta=servicios&orden=fechacreacion&vista=pendientes";
                  }
                })
                break;
              //SI TIENE CARACTERES NO VALIDOS
              case "charset":
                let posrespuesta = respuesta.substr(7, 15);
                swal({
                  type: "error",
                  title: "¡El Servicio no puede llevar caracteres especiales como "+posrespuesta,
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  focusConfirm:true
                  }).then(function(result){
                  if (result.value) {
                    window.location = "index.php?ruta=servicios&vista=pendientes";
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
ELIMINAR SERVICIOS
=============================================*/

$(".tablaServicios tbody").on("click", "button.btnEliminarServicio", function(){

  var idServicioEliminar = $(this).attr("idServicio");
  console.log("idServicioEliminar", idServicioEliminar);

  var servicios = new FormData();
  servicios.append("idVerServicioEditar",  $(this).attr("idServicio"));
  servicios.append("idSercicioEstado",  1);

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
      	 swal({
              title: '¿Está seguro de eliminar el servicio de '+respuesta["cliente"]+' \n'+respuesta["producto"]+'?',
              text: "¡Si no lo está puede cancelar la accíón!",
              type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  cancelButtonText: 'Cancelar',
                  confirmButtonText: 'Si, borrar servicio!'
                  }).then(function(result) {
                  if (result.value) {
                    var datos = new FormData();
                    datos.append("idServicioEliminar", idServicioEliminar);
                    datos.append("nombreServicioProducto", respuesta["producto"]);

                    $.ajax({
                        url:"ajax/servicios.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success:function(respuesta){
                          console.log("respuesta", respuesta);
                          if(respuesta=="ok"){
                            swal({
                              type: "success",
                              title: "El servicio ha sido ELIMINADO correctamente",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                if (result.value) {
                                  window.location = "index.php?ruta=servicios&vista=pendiente";
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
                                  window.location = "index.php?ruta=servicios&vista=pendiente";
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
VER SERVICIOS
=============================================*/
$(".tablaServicios").on("click", ".btnVerServicioEditar", function(){
  //TOMO LA VARIABLE DEL BOTON
  var idVerServicioEditar = $(this).attr("idServicio");
  console.log("idVerServicioEditar", idVerServicioEditar);
  
  // LOS CARGO EN EL FORMDATA DE UN AJAX
  var datos = new FormData();
  datos.append("idVerServicioEditar", idVerServicioEditar);
  datos.append("idSercicioEstado", 1);
  //HAGO UN AJAX CON JSON
  $.ajax({
      url:"ajax/servicios.ajax.php",
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
        $("#idServicioEditar").val(respuesta["id"]);
        $("#servicioClienteEditar").val(respuesta["cliente"]);
        $("#servicioTelefonoEditar").val(respuesta["telefono"]);
        $("#servicioProblemaEditar").val(respuesta["problema"]);
        $("#servicioProductoInfoEditar").val(respuesta["producto_info"]);
        $("#servicioIdUsuarioEditar").val(respuesta["id_usuario_creacion"]);
        $("#servicioPresupuestoEditar").val(respuesta["presupuesto"]);
        $("#editarProductoSelect").html(respuesta["producto"]);
		    $("#editarProductoSelect").val(respuesta["id_producto"]);
      }//SUCESS
  })//AJAX

})

/*=============================================
EDITAMOS CLIENTE CON AJAX
=============================================*/
$("#btnEditarServicio").on("click", function(){
      //TOMO LA VARIABLE DEL BOTON
      var idServicio = $("#idServicioEditar").val();
      var editarServicioTelefono = $("#servicioTelefonoEditar").val(); 
      var servicioProductoEditarId =$("#servicioProductoEditar").val();
      var editarServicioProblema = $("#servicioProblemaEditar").val();
      var editarServicioInfoProducto = $("#servicioProductoInfoEditar").val();
      var servicioPresupuestoEditar = $("#servicioPresupuestoEditar").val();

      console.log("idServicio", idServicio);
      console.log("editarServicioTelefono", editarServicioTelefono);
      console.log("editarServicioProblema", editarServicioProblema);
      console.log("servicioProductoEditarId", servicioProductoEditarId);
      console.log("editarServicioInfoProducto", editarServicioInfoProducto);
      console.log("servicioPresupuestoEditar", servicioPresupuestoEditar);
      console.log("servicioPresupuestoEditar", servicioPresupuestoEditar);
      // LOS CARGO EN EL FORMDATA DE UN AJAX
      var datos = new FormData();
      datos.append("idServicio", idServicio);
      datos.append("editarServicioTelefono", editarServicioTelefono);
      datos.append("servicioProductoEditarId", servicioProductoEditarId);
      datos.append("editarServicioProblema",editarServicioProblema);
      datos.append("editarServicioInfoProducto", editarServicioInfoProducto);
      datos.append("servicioPresupuestoEditar", servicioPresupuestoEditar);
      
      //HAGO UN AJAX SIN JSON
       $.ajax({
          url:"ajax/servicios.ajax.php",
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
                      title: "El Servicio ha sido MODIFICADO correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar",
                      focusConfirm:true
                      }).then(function(result){
                            if (result.value) {
                                window.location = "index.php?ruta=servicios&orden=fechacreacion&vista=pendientes";
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
                            window.location = "index.php?ruta=servicios&vista=pendientes";
                        }
                      })
                    break;
                //SI EXISTE EN LA BD  
                case "duplica":
                  swal({
                    type: "error",
                    title: "¡Ya existe ese Servicio! Revise los datos",
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

/*===========================================================
=            cambiar el color de la primera fila            =
===========================================================*/
function cambiarColor(){
  
  $("#tdpendientes-1").css("background-color","#F9F9F9");
  $("#tdpendientes-2").css("background-color","#F9F9F9");
  $("#tdpendientes-3").css("background-color","#F9F9F9");
  $("#tdpendientes-4").css("background-color","#F9F9F9");
  $("#tdpendientes-5").css("background-color","#F9F9F9");
  $("#tdpendientes-6").css("background-color","#F9F9F9");
  $("#tdpendientes-7").css("background-color","#F9F9F9");
  $("#tdpendientes-8").css("background-color", "#F9F9F9");

}

setTimeout(cambiarColor,5000);


$(".tablaServicios tbody").on("click", "button.btnReparar", function(){

  var idServicioEnviarReparar = $(this).attr("idServicio");
  var idServicioUsuarioReparar = $(this).attr("idUsuario");
  console.log("idServicioEnviarReparar", idServicioEnviarReparar);

  var servicios = new FormData();
  servicios.append("idVerServicioEditar",  $(this).attr("idServicio"));
  servicios.append("idSercicioEstado",  1);

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

         swal({

              title: '¿Repara '+respuesta["producto"]+' \n'+respuesta["cliente"]+'?',
              text: "¡Si no lo está puede cancelar la accíón!",
              type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  cancelButtonText: 'Cancelar',
                  confirmButtonText: 'Si, Enviar al servicio tecnico!'
                  }).then(function(result) {
                  if (result.value) {

                    var datos = new FormData();
                    datos.append("idServicioUsuarioReparar", idServicioUsuarioReparar);
                    datos.append("idServicioCambiarEstado", idServicioEnviarReparar);
                    datos.append("idServicioEstado", 2);//enviamos el 2
                    

                    $.ajax({

                        url:"ajax/servicios.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success:function(respuesta){
                          console.log("respuesta", respuesta);

                          if(respuesta=="ok"){

                            swal({
                              type: "success",
                              title: "Enviado al Servicio Tecnico",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                
                                if (result.value) {

                                  window.location = "index.php?ruta=servicios&vista=reparacion";

                                }

                              })
                            
                            }else{
                              swal({
                                type: "error",
                                title: "No se puede Enviar",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                if (result.value) {

                                  window.location = "index.php?ruta=servicios&vista=reparacion";
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
$(".tablaServicios tbody").on("click", "button.btnAPendiente", function(){

  var idServicioEnviarReparar = $(this).attr("idServicio");
  var idServicioUsuarioReparar = $(this).attr("idUsuario");


  var servicios = new FormData();


 servicios.append("idVerServicioEditar",  $(this).attr("idServicio"));
  servicios.append("idSercicioEstado",  2);

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

         swal({

              title: 'Devuelve '+respuesta["producto"]+' \n'+respuesta["cliente"]+'?\n - - a Pendientes - -',
              text: "¡Si no lo está puede cancelar la accíón!",
              type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  cancelButtonText: 'Cancelar',
                  confirmButtonText: 'Si, devolver a pendiente!'
                  }).then(function(result) {
                  
                  if (result.value) {

                    var datos = new FormData();
                    datos.append("idServicioUsuarioReparar", idServicioUsuarioReparar);
                    datos.append("idServicioCambiarEstado", idServicioEnviarReparar);
                    datos.append("idServicioEstado", 1);//enviamos el 2
                    
                    $.ajax({

                        url:"ajax/servicios.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success:function(respuesta){
                          console.log("respuesta", respuesta);

                          if(respuesta=="ok"){

                            swal({
                              type: "success",
                              title: "El Trabajo se ha enviado a Pendientes",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                
                                if (result.value) {

                                  window.location = "index.php?ruta=servicios&vista=pendientes";

                                }

                              })
                            
                            }else{
                              swal({
                                type: "error",
                                title: "No se puede Enviar",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result){
                                if (result.value) {
                                  window.location = "index.php?ruta=servicios&vista=pendientes";
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


$(".tablaServicios tbody").on("click", "button.btnTerminarServicio", function(){
  //tomo el valor del servicio...
  $('#idServicioTerminar').val($(this).attr("idServicio"));
  
  var idServicioEnviarReparar = $(this).attr("idServicio");
  var idServicioUsuarioReparar = $(this).attr("idUsuario");

  var servicios = new FormData();

  servicios.append("idVerServicioEditar",  $(this).attr("idServicio"));
  servicios.append("idSercicioEstado",  2);

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

        $("#servicioClienteTerminar").val(respuesta["cliente"]);
        $("#servicioProductoTerminar").val(respuesta["producto"]);
        $("#servicioProblemaTerminar").val(respuesta["problema"]);
        $("#servicioPresupuestoTerminar").val(respuesta["presupuesto"]);
        $("#servicioPrecioTerminar").val(respuesta["precio"]);
        $("#servicioProductoInfoTerminar").val(respuesta["reparacion"]);


      }//success
  })//ajax
 
})


$(".btnModalTerminarServicio").on("click",function(){
  let idEstadoTerminar = $(this).attr("estadoterminar");
  

  var servicioPrecioTerminar =  $("#servicioPrecioTerminar").val();
  var servicioProductoInfoTerminar = $("#servicioProductoInfoTerminar").val();
  var servicioIdUsuarioTerminar = $("#servicioIdUsuarioTerminar").val();
  var idServicioTerminar = $("#idServicioTerminar").val();
  
  console.log("servicioPrecioTerminar", servicioPrecioTerminar);
  console.log("servicioProductoInfoTerminar", servicioProductoInfoTerminar);
  console.log("servicioIdUsuarioTerminar", servicioIdUsuarioTerminar);
  console.log("idServicioTerminar", idServicioTerminar);


  var servicios = new FormData();
  servicios.append("servicioPrecioTerminar",  servicioPrecioTerminar);
  servicios.append("servicioProductoInfoTerminar",  servicioProductoInfoTerminar);
  servicios.append("servicioIdUsuarioTerminar",  servicioIdUsuarioTerminar);
  servicios.append("idServicioTerminar",  idServicioTerminar);
  servicios.append("estadoTerminar", $(this).attr("estadoTerminar"));
 
  $.ajax({
      url:"ajax/servicios.ajax.php",
      method: "POST",
      data: servicios,
      cache: false,
      contentType: false,
      processData: false,

      success:function(respuesta){
      console.log('respuesta: ', respuesta);

       if(respuesta=="ok"){
          
        if(idEstadoTerminar==2){

          mensaje = "Se ha agregado algunos datos a este servicio";

        }else{
          
            mensaje =  "El servicio ha sido completado correctamente";
        }
          swal({
            type: "success",
            title: mensaje,
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                                  
              if (result.value) {

                if(idEstadoTerminar==2){

                  window.location = "index.php?ruta=servicios&vista=reparacion";

                }else{

                  window.location = "index.php?ruta=servicios&vista=terminado";

                }
                

              }

            })
       }
          

      }//success
  })//ajax
})


$(".tablaServicios tbody").on("click", "button.btnAServicio", function () {
      
  var idServicioCambiarEstado = $(this).attr("idServicio");
  console.log('idServicioCambiarEstado: ', idServicioCambiarEstado);
  var idServicioUsuarioReparar = $(this).attr("idUsuario");


  var servicios = new FormData();
  servicios.append("idVerServicioEditar",  $(this).attr("idServicio"));
  servicios.append("idSercicioEstado",  3);

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
  
        swal({

          title: '¿Devuelve el/la '+respuesta["producto"]+' \n'+respuesta["cliente"]+'?\n - Al Servicio Tecnico -',
          text: "¡Si no lo está puede cancelar la accíón!",
          type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Cancelar',
              confirmButtonText: 'Si, lo saco de terminado!'
              }).then(function(result) {
               
                if (result.value) {

                  var datos = new FormData();
                  datos.append("idServicioCambiarEstado", idServicioCambiarEstado);
                  datos.append("idServicioUsuarioReparar", idServicioUsuarioReparar);
                  datos.append("idServicioEstado", 2); //enviamos el 2
                  $.ajax({
                    url: "ajax/servicios.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (respuesta) {
                      console.log("respuesta", respuesta);
                
                      if (respuesta == "ok") {
                        swal({
                          type: "success",
                          title: "El Trabajo ha sido Enviado al Servicio Tecnico",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar",
                        }).then(function (result) {
                          if (result.value) {
                            window.location = "index.php?ruta=servicios&vista=reparacion";
                          }
                        });
                      } else {
                        swal({
                          type: "error",
                          title: "No se puede Enviar",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar",
                        }).then(function (result) {
                          if (result.value) {
                            window.location = "index.php?ruta=servicios&vista=reparacion";
                          }
                        });
                      }
                    }, //sucess
                  }); //ajax
                }
             
              })

      }
  })

})

$(".tablaServicios tbody").on("click", "button.btnEntregado", function () {
  var idServicioCambiarEstado = $(this).attr("idServicio");
  var idServicioUsuarioReparar = $(this).attr("idUsuario");

  var datos = new FormData();
  datos.append("idServicioCambiarEstado", idServicioCambiarEstado);
  datos.append("idServicioUsuarioReparar", idServicioUsuarioReparar);
  datos.append("idServicioEstado", 4); //enviamos el 2
  
  $.ajax({
    url: "ajax/servicios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      console.log("respuesta", respuesta);

      if (respuesta == "ok") {
        swal({
          type: "success",
          title: "El servicio Ha sido entregado",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
        }).then(function (result) {
          if (result.value) {
            window.location = "index.php?ruta=servicios&vista=terminado";
          }
        });
      } else {
        swal({
          type: "error",
          title: "No se puede Enviar",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
        }).then(function (result) {
          if (result.value) {
            window.location = "index.php?ruta=servicios&vista=terminado";
          }
        });
      }
    }, //sucess
  }); //ajax
})

$("#literminado").on("click", ()=>{
 
  $("#literminado").css({"border-top-color":"#00B74A"});
  $("#lipendientes").css({"border-top-color":"#FFF"});
  $("#lireparacion").css({"border-top-color":"#FFF"});

});

$("#lipendientes").on("click", ()=>{

  $("#lipendientes").css({"border-top-color":"#1266F1"});
  
  $("#literminado").css({"border-top-color":"#FFF"});
  $("#lireparacion").css({"border-top-color":"#FFF"});

})

$("#lireparacion").on("click", ()=>{

  $("#lireparacion").css({"border-top-color":"#FFA900"});
  $("#lipendientes").css({"border-top-color":"#FFF"});
  $("#literminado").css({"border-top-color":"#FFF"});

})