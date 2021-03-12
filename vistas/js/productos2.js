/*=============================================
CARGAR LA TABLA 
=============================================*/
var table = $('.tablaProductos').DataTable({
// 	"ajax":"ajax/datatable-vocabulario.ajax.php",
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

/*=============================================
EDITAR PRODUCTO VER
=============================================*/
$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function(){

	var idProductoVer = $(this).attr("idProducto");
  console.log("idProductoVer", idProductoVer);
	
	var datos = new FormData();

  datos.append("idProductoVer", idProductoVer);
  $.ajax({
      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
        console.log("respuesta", respuesta);
          
       $("#idProductoEditar").val(respuesta["id"]);
       $("#editarNombre").val(respuesta["nombre"]);
          
      }

  })

})
/*=============================================
AGREGAR PRODUCTO
=============================================*/
$("#crearProducto").on("click",function(){
  // TOMO LOS VALORES QUE VOY A AGREGAR DESDE LOS INPUTS
  var nuevoNombre = $('#nuevoNombre').val();
  // LOS CARGO EN EL FORMDATA DE UN AJAX
  var datos = new FormData();
  datos.append("nuevoNombre", nuevoNombre);
  //HAGO UN AJAX 
  $.ajax({
      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success:function(respuesta){

         switch (respuesta){
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
          case "error":
            swal({
              type: "error",
              title: "¡El productos no puede llevar caracteres especiales como ¬%&/()?¿!ª!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              focusConfirm:true
              }).then(function(result){
              if (result.value) {
                window.location = "productos";
              }
            })
            break;
            //SI EXISTE EN LA BD  
          case "duplicado":
            swal({
              type: "error",
              title: "¡Ya existe ese producto! Revise los datos",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              focusConfirm:true
              }).then(function(result){
              if (result.value) {
                // window.location = "clientes";
                $("#nuevoNombre").val("");
              }
            }) 
            break;
        }//switch  
      }//SUCCESS
  })//INICIO AJAX  
})
/*=============================================
EDITAMOS PRODUCTO PRODUCTO CON AJAX
=============================================*/
$("#editarProducto").on("click",function(){

    var editarNombre = $('#editarNombre').val();
    var idProductoEditar = $('#idProductoEditar').val();

    var datos = new FormData();
    datos.append("editarNombre", editarNombre);
    datos.append("idProductoEditar", idProductoEditar);

    $.ajax({

        url:"ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){
          console.log("respuesta", respuesta);
           switch (respuesta){
          //SI SE HA AGREGADO
          case "ok":
            swal({
            type: "success",
            title: "El producto ha sido MODIFICADO correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            animation: false,
            focusConfirm:true
            }).then(function(result){
              if (result.value) {
                window.location = "index.php?ruta=productos&orden=fechacreacion";
              }
            })
            break;
          //SI TIENE CARACTERES NO VALIDOS
          case "error":
            swal({
              type: "error",
              title: "¡El productos no puede llevar caracteres especiales como ¬%&/()?¿!ª!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              animation: false,
              focusConfirm:true
              }).then(function(result){
              if (result.value) {
                window.location = "productos";
              }
            })
            break;
            //SI EXISTE EN LA BD  
          case "duplicado":
            swal({
              type: "error",
              title: "¡Ya existe ese producto! Revise los datos",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              animation: false,
              focusConfirm:true
              }).then(function(result){
              if (result.value) {
                // window.location = "clientes";
                $("#nuevoNombre").val("");
                 document.body.style.paddingRight = "0px";
              }
            }) 
            break;
        }//switch  
          

        }

      })//ajax

 })

/*=============================================
ELIMINAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEliminarProducto", function(){
  // TOMO EL ID DE LO QUE ESTOY POR ELIMINAR
  var idProductoEliminar = $(this).attr("idProducto");
  console.log("idProductoEliminar", idProductoEliminar);
  // CARGO UN FORMDATA PARA EL AJAX
  var productos = new FormData();
  productos.append("idProductoVer", idProductoEliminar);
  // INICIO EL AJAX
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
      // HAGO UN SWALL   
        swal({
          title: '¿Está seguro de borrar '+respuesta["nombre"]+'?',
          text: "¡Si no lo está puede cancelar la accíón!",
          type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Cancelar',
              confirmButtonText: 'Si, borrar producto!',
              focusConfirm:true
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
                      if(respuesta=="ok"){
                        swal({
                          type: "success",
                          title: "El producto ha sido ELIMINADO correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar",
                          focusConfirm:true
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
                            confirmButtonText: "Cerrar",
                            focusConfirm:true
                            }).then(function(result){
                            if (result.value) {
                              window.location = "productos";
                            }
                          })//SWALL
                      }//IF
                    }//SUCCESS
                  })//AJAX
                }//result.value
              })//THEN
            }
          })//AJAX
})//FIN
	
/*=============================================
=HACER UN FOCO EN EL PRIMER INPUT nuevoCliente=
=============================================*/

$('#modalAgregarProducto').on('shown.bs.modal', function () {
     
   $('#nuevoNombre').focus();
   
})
/*=============================================
=HACER UN FOCO EN EL PRIMER INPUT editarNombre=
=============================================*/
$('#modalEditarProducto').on('shown.bs.modal', function () {
     
   $('#editarNombre').focus();

})

$("#editarNombre").keypress(function(e) {
  
  if(e.which == 13){

    e.preventDefault();
    $('#editarProducto').focus();

  }

});