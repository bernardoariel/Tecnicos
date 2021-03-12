/*=============================================
CARGAR LA TABLA 
=============================================*/
var table = $('.tablaProductos').DataTable({
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
  
  $("#tdproducto-1").css("background-color","#F9F9F9");
  $("#tdproducto-2").css("background-color","#F9F9F9");
  $("#tdproducto-3").css("background-color","#F9F9F9");

}

setTimeout(cambiarColor,5000);

/*=============================================
VER PRODUCTOS
=============================================*/
$(".tablaProductos").on("click", ".btnVerProductoEditar", function(){
  //TOMO LA VARIABLE DEL BOTON
  var idVerProductoEditar = $(this).attr("idProducto");
  console.log("idVerProductoEditar", idVerProductoEditar);
  // LOS CARGO EN EL FORMDATA DE UN AJAX
  var datos = new FormData();
  datos.append("idVerProductoEditar", idVerProductoEditar);
  //HAGO UN AJAX CON JSON
  $.ajax({
      url:"ajax/productos.ajax.php",
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
        $("#idProductoEditar").val(respuesta["id"]);
        $("#editarProducto").val(respuesta["nombre"]);
      }//SUCESS
  })//AJAX

})

/*=============================================
EDITAMOS PRODUCTOS CON AJAX
=============================================*/
$("#btnEditarProducto").on("click", function(){
  //TOMO LA VARIABLE DEL BOTON
  var idProducto = $("#idProductoEditar").val();
  console.log("idProducto", $("#idProductoEditar").val());
  var editarProducto = $("#editarProducto").val(); 
  // LOS CARGO EN EL FORMDATA DE UN AJAX
  var datos = new FormData();
  datos.append("idProducto", idProducto);
  datos.append("editarProducto", editarProducto);
  //HAGO UN AJAX SIN JSON
  $.ajax({
      url:"ajax/productos.ajax.php",
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
            title: "El producto ha sido MODIFICADO correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            focusConfirm:true
            }).then(function(result){
              if (result.value) {
                window.location = "index.php?ruta=productos&orden=fechacreacion";
              }
            })
            break;
          //SI TIENE CARACTERES NO VALIDOS
          case "charset":
            let posrespuesta = respuesta.substr(7, 15);
            swal({
              type: "error",
              title: "¡El producto no puede llevar caracteres especiales como "+posrespuesta,
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
              title: "¡Ya existe ese producto! Revise los datos",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              focusConfirm:true
              }).then(function(result){
              if (result.value) {
                 window.location = "clientes";
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
AGREGAR PRODUCTO
=============================================*/
$("#btnCrearProducto").on("click",function(){
  // TOMO LOS VALORES QUE VOY A AGREGAR DESDE LOS INPUTS
  var nuevoProducto= $('#nuevoProducto').val();
  // LOS CARGO EN EL FORMDATA DE UN AJAX
  var datos = new FormData();
  datos.append("nuevoProducto", nuevoProducto);
  //HAGO UN AJAX 
  $.ajax({
      url:"ajax/productos.ajax.php",
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
            title: "El producto ha sido AGREGADO correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            focusConfirm:true
            }).then(function(result){
              if (result.value) {
                window.location = "index.php?ruta=productos&orden=fechacreacion";
              }
            })
            break;
          //SI TIENE CARACTERES NO VALIDOS
          case "charset":
            let posrespuesta = respuesta.substr(7, 15);
            swal({
              type: "error",
              title: "¡El producto no puede llevar caracteres especiales como "+posrespuesta,
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              focusConfirm:true
              }).then(function(result){
              if (result.value) {
                // window.location = "productos";
              }
            })
            break;
          //SI EXISTE EN LA BD  
          case "duplica":
            swal({
              type: "error",
              title: "¡Ya existe ese producto! Revise los datos",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              focusConfirm:true
              }).then(function(result){
              if (result.value) {
                // window.location = "productos";
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
                  window.location = "productos";
                }
              })
              break;
        }//switch  
      }//SUCCESS
  })//INICIO AJAX

})


/*=============================================
ELIMINAR PRODUCTOS
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEliminarProducto", function(){

  var idProductoEliminar = $(this).attr("idProducto");
  console.log("idProductoEliminar", idProductoEliminar);

  var productos = new FormData();
  productos.append("idVerProductoEditar", idProductoEliminar);

  //HAGO UN AJAX CON JSON
  $.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: productos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
        console.log("respuesta", respuesta);

            swal({

              title: '¿Está seguro de eliminar a '+respuesta["nombre"]+'?',
              text: "¡Si no lo está puede cancelar la accíón!",
              type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  cancelButtonText: 'Cancelar',
                  confirmButtonText: 'Si, borrar producto!'
                  }).then(function(result) {
                  if (result.value) {

                    var datos = new FormData();

                    datos.append("idProductoEliminar", idProductoEliminar);

                    $.ajax({

                        url:"ajax/productos.ajax.php",
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
                              title: "El poroducto ha sido ELIMINADO correctamente",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                
                                if (result.value) {

                                  window.location = "productos";

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

                                  window.location = "productos";
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
=HACER UN FOCO EN EL PRIMER INPUT nuevoProducto=
=============================================*/
$('#modalAgregarProducto').on('shown.bs.modal', function () {

   $('.inputNuevo').val("");//elimino el contenido
   $('#nuevoProducto').focus();
   
})
/*=============================================
=HACER UN FOCO EN EL PRIMER INPUT editarProducto=
=============================================*/
$('#modalEditarProducto').on('shown.bs.modal', function () {
     
   $('#editarProducto').focus();

})
/*=============================================
          AL PRESIONAR ENTER --NUEVO--
=============================================*/
$("#nuevoProducto").keypress(function(e) {
  
  if(e.which == 13){
    e.preventDefault();
    $('#btnCrearProducto').focus();
  }

});


/*=============================================
          AL PRESIONAR ENTER --EDICION--
=============================================*/
$("#editarProducto").keypress(function(e) {
  
  if(e.which == 13){
    e.preventDefault();
    $('#btnEditarProducto').focus();
  }

});





