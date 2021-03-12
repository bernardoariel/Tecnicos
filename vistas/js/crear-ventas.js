/*=============================================
CARGAR LA TABLA 
=============================================*/
var tablaBuscarCliente = $('.tablaBuscarClientes').DataTable({
//  "ajax":"ajax/datatable-vocabulario.ajax.php",
 "lengthMenu": [[5, 10, 25], [5, 10, 25]],
      "language": {
        "emptyTable":     "No hay datos disponibles en la tabla.",
        "info":           "Del _START_ al _END_ de _TOTAL_ ",
        "infoEmpty":      "Mostrando 0 registros de un total de 0.",
        "infoFiltered":     "6",
        "infoPostFix":      "(actualizados)",
        "lengthMenu":     "Mostrar _MENU_ registros",
        "loadingRecords":   "Cargando...",
        "processing":     "Procesando...",
        "search":       "Buscar:",
        "searchPlaceholder":  "Dato para buscar",
        "zeroRecords":      "No se han encontrado coincidencias.",
        "paginate": {
          "first":      "Primera",
          "last":       "Última",
          "next":       "Siguiente",
          "previous":     "Anterior"
        },
        "aria": {
          "sortAscending":  "Ordenación ascendente",
          "sortDescending": "Ordenación descendente"
        }
      }


})

$(document).ready(function() {
    $("#resultadoBusqueda").html('');
    listarProductos();
});

function buscar() {
    var textoBusqueda = $("input#busqueda").val();
 
     if (textoBusqueda != "") {
        $.post("ajax/buscar.modelos.ajax.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
            $("#resultadoBusqueda").html(mensaje);
            $("#resultadoBusqueda").css("margin-top","5px");
            
           
         }); 
     } else { 
        $("#resultadoBusqueda").html('<p>No hay resultados</p>');
        };
};

/*=============================================
HACER FOCO EN EL BUSCADOR CLIENTES
=============================================*/
$('#myModalClientes').on('shown.bs.modal', function () {
    
    $('#buscarclientetabla_filter label input').focus();
    $('#buscarclientetabla_filter label input').val('');
    tablaBuscarCliente.search('');
    tablaBuscarCliente.draw();
  
  })

/*=============================================
SELECCIONAR CLIENTE
=============================================*/
$(".tablaBuscarClientes").on("click", ".btnBuscarCliente", function(){

    var idCliente = $(this).attr("idCliente");
    var nombreCliente = $(this).attr("nombreCliente");
    
    $("#seleccionarCliente").val(idCliente);
    $("#nombrecliente").val(nombreCliente);

    $("#panel3nombrecliente").html(nombreCliente);
    // $("#panel3TipoCLiente").val(nombreCliente);

    var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({

      url:"ajax/tipoClientes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
        console.log("respuesta", respuesta);
        
        $("#panel3TipoCLiente").html(respuesta["nombre"]);
      }

    })
   
})

var tablaArticulo = $('#buscararticulotabla').DataTable({
      "lengthMenu": [[4, 10, 25], [4, 10, 25]],
      "language": {
        "emptyTable":     "No hay datos disponibles en la tabla.",
        "info":           "Del _START_ al _END_ de _TOTAL_ ",
        "infoEmpty":      "Mostrando 0 registros de un total de 0.",
        "infoFiltered":     "6",
        "infoPostFix":      "(actualizados)",
        "lengthMenu":     "Mostrar _MENU_ registros",
        "loadingRecords":   "Cargando...",
        "processing":     "Procesando...",
        "search":       "Buscar:",
        "searchPlaceholder":  "Dato para buscar",
        "zeroRecords":      "No se han encontrado coincidencias.",
        "paginate": {
          "first":      "Primera",
          "last":       "Última",
          "next":       "Siguiente",
          "previous":     "Anterior"
        },
        "aria": {
          "sortAscending":  "Ordenación ascendente",
          "sortDescending": "Ordenación descendente"
        }
      },
      
      
    });

/*=============================================
HACER FOCO EN EL PRODUCTOS
=============================================*/
$('#myModalProductos').on('shown.bs.modal', function () {
    
    $('#buscararticulotabla_filter label input').focus();
    $('#buscararticulotabla_filter label input').val('');
    tablaArticulo.search('');
    tablaArticulo.draw();
  
  })
/*=============================================
SI ENVIA EL FORUMLARIO
=============================================*/
$("#frmVenta").on("submit", function(){
  
  if($("#nombrecliente").val()==""){

    swal("Le Falta Seleccionar el nombre del Cliente", "Elija un Cliente por favor", "warning");
    

   return false;
    
  }
  
 })

/*=============================================
SELECCIONO EL PRODUCTO
=============================================*/
$(".tablaBuscarProductos").on("click", ".btnSeleccionarProducto", function(){

    var idProducto = $(this).attr("idProducto");
    var productoNombre = $(this).attr("productoNombre");
    var precioVenta = $(this).attr("precioVenta");

    //DATOS AJAX DE QUE SE REALIZO EL CAMBIO
    datos="<div class='alert alert-info' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>¡Bien hecho!</strong>Los datos han sido introducidos satisfactoriamente.";
    $("#datos_ajax_producto").html(datos);
    $("#datos_ajax_producto").hide(1000);
    //CIERRO LA TABLA
    $("#contenido_producto").hide(500);
    //MUESTRO LOS RESULATADOS
    $("#contenidoSeleccionado").show();
    //SELECCIONO EL INPUT DE LA CANTIDAD
    $("#cantidadProducto").val('1');
    $("#cantidadProducto").focus();
    $("#cantidadProducto").select();
    //ASIGNO A CADA INPUT EL VALOR OBTENIDO DE LOS PARAMETROS
    $("#idproducto").val(idProducto);
    $("#nombreProducto").val(productoNombre);
    $("#precioProducto").val(precioVenta);
})
/*=============================================
CUANDO ABRO EL MODAL DE PRODUCTOS
=============================================*/
$('#myModalProductos').on('shown.bs.modal', function () {
     
     $("#datos_ajax").show();
     //MUESTRO LOS RESULTADOS
      $("#contenido_producto").show();
      //ESCONDO EL PRODUCTO SELECCIONADO
      $("#contenidoSeleccionado").hide();
      //PONGO A CERO LOS VALUES
      $("#idproducto").val("");
      $("#nombreProducto").val("");
      $("#cantidadProducto").val("1");
      $("#precioProducto").val("");
   
})
/*=============================================
SELECCIONO EL MODELO
=============================================*/
$("#resultadoBusqueda").on("click", ".btnSeleccionarModelo", function(){


  var idModelo = $(this).attr("idModelo");
  var nombreModelo = $(this).attr("nombreModelo");
  // coloco el valor del modelo
  $("#busqueda").val(nombreModelo);
  $("#busqueda").select();
  $("#resultadoBusqueda").html("");
})

 //Date picker
 $('#datepicker').datepicker({
     autoclose: true
 })
/*=============================================
SELECCIONO EL PRODUCTO
=============================================*/
$("#grabarItem").on("click",function(){

    idProducto = $("#idproducto").val();
   
    cantidadProducto = $("#cantidadProducto").val();
    
    productoNombre = $("#nombreProducto").val();
  
    precioVenta = $("#precioProducto").val();

    precioVentaTotal = $("#totalVenta").val();

    precioVentaTotal=parseFloat(precioVentaTotal).toFixed(2);
    // precioVentaTotal = precioVentaTotal.toFixed(2);
    console.log("precioVentaTotal", parseFloat(precioVentaTotal).toFixed(2));

    console.log("cantidadProducto", cantidadProducto);


    if (cantidadProducto == 0 ){

      totalItem=precioVenta - precioVentaTotal;

      console.log("totalItem", parseFloat(totalItem).toFixed(2));

      cantidadProducto = 1;

      precioVenta = parseFloat(totalItem).toFixed(2);

    }
    
    $(".tablaProductosSeleccionados").append(
      '<tr>'+
          '<td>1.</td>'+
          '<td>'+

              
             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto"  value="'+cantidadProducto+'"  readonly>'+

            
          '</td>'+
          '<td>'+
          '<div class="input-group">'+
                
                // '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

                '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+productoNombre+'" readonly required>'+

              '</div>'+
          '</td>'+
          '<td>'+
          '<div class="input-group">'+

                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                   
                '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precioVenta+'" name="nuevoPrecioProducto" value="'+precioVenta+'" readonly required>'+
   
              '</div>'+
          '</td>'+
          '<td style="text-align: right;">'+
          '<div class="input-group">'+

                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                   
                '<input type="text" class="form-control nuevoTotalProducto" precioTotal="'+(cantidadProducto*precioVenta).toFixed(2)+'" name="nuevoTotalProducto" value="'+(cantidadProducto*precioVenta).toFixed(2)+'" readonly required>'+
   
              '</div>'+

          '</td>'+
          '<td>'+
          // <button class="btn btn-link btn-xs quitarProducto"><span class="glyphicon glyphicon-trash"></span></button>
          '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>'+
          '</td>'+
          
          '</tr>');

  listarProductos();

  $("#contenidoSeleccionado").hide();
  $("#contenido_producto").css("display","block");
  $('#buscararticulotabla_filter label input').focus();
  $('#buscararticulotabla_filter label input').val('');

})

/*=============================================
QUITAR EL PRODUCTO
=============================================*/


$(".tablaProductosSeleccionados").on("click", ".quitarProducto", function(){


$(this).parent().parent().parent().remove();
  
 listarProductos();

})

/*=============================================
LISTAR TODOS LOS  PRODUCTOS
=============================================*/

function listarProductos(){

  var listaProductos = [];
  

  var descripcion = $(".nuevaDescripcionProducto");

  var cantidad = $(".nuevaCantidadProducto");

  var precio = $(".nuevoPrecioProducto");

  var precioTotal = $(".nuevoTotalProducto");

  var totalVentas = 0;

  var cantidadItem = 1;

  var totalItems = 0;

  var i = 0;
  for(var i = 0; i < descripcion.length; i++){

    listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
                "descripcion" : $(descripcion[i]).val(),
                "cantidad" : $(cantidad[i]).val(),
                "precio" : $(precio[i]).attr("precioReal"),
                "total" : $(precioTotal[i]).val()});

   cantidadItem = Number($(cantidad[i]).val());
   total = Number($(precio[i]).val());
   totalItems= total*cantidadItem;
   totalVentas += totalItems;
  }
 $("#cantidadItems").html(i);
 $("#totalVentasMostrar").html(' $ '+totalVentas.toFixed(2)+'.-'); 
 $("#totalVenta").val(totalVentas.toFixed(2)); 
 $("#listaProductos").val(JSON.stringify(listaProductos)); 
 // console.log("listaProductos", listaProductos);
}

/*=============================================
BOTON EDITAR VENTA
=============================================*/

$(".tablas").on("click", ".btnEditarVenta", function(){

 

  var idVenta = $(this).attr("idVenta");
  console.log("idVenta", idVenta);

  window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;


})

/*=============================================
HACER FOCO EN NOMBRE DEL NUEVO CLIENTE
=============================================*/
$('#modalAgregarCliente').on('shown.bs.modal', function () {
   
  $('#nuevoCliente').focus();

})

/*=============================================
SELECCIONO EL PRODUCTO
=============================================*/
$("#guardarCliente").on("click",function(){

  var nombreCliente = $("#nuevoCliente").val();
  var nuevoDocumento = $("#nuevoDocumento").val();
  var nuevoCuit = $("#nuevoCuit").val();
  var nuevoTipoIva = $("#nuevoTipoIva").val();
  var nuevaDireccion = $("#nuevaDireccion").val();
  var nuevoTelefono = $("#nuevoTelefono").val();
  var nuevoTipoCliente = "1";
  var nuevoEmail = "EMAIL@EMAIL.COM";

  if($("#nuevoCliente").val()!=''){
    
    var datos = new FormData();

    if(nuevoDocumento.length < 1){nuevoDocumento="0";}
    if(nuevoCuit.length < 1){nuevoCuit="20";}
    if(nuevoTipoIva.length < 1){nuevoTipoIva="2";}
    if(nuevaDireccion.length < 1){nuevaDireccion=".";}
    if(nuevoTelefono.length < 1){nuevoTelefono="3704";}
    
    datos.append("nombreCliente", nombreCliente);
    console.log("nombreCliente", nombreCliente);
    datos.append("nuevoDocumento", nuevoDocumento);
    console.log("nuevoDocumento", nuevoDocumento);
    datos.append("nuevoCuit", nuevoCuit);
    console.log("nuevoCuit", nuevoCuit);
    datos.append("nuevoTipoIva", nuevoTipoIva);
    console.log("nuevoTipoIva", nuevoTipoIva);
    datos.append("nuevaDireccion", nuevaDireccion);
    console.log("nuevaDireccion", nuevaDireccion);
    datos.append("nuevoTelefono", nuevoTelefono);
    console.log("nuevoTelefono", nuevoTelefono);
    datos.append("nuevoTipoCliente", nuevoTipoCliente);
    console.log("nuevoTipoCliente", nuevoTipoCliente);
    datos.append("nuevoEmail", nuevoEmail);
    console.log("nuevoEmail", nuevoEmail);

    $.ajax({

      url:"ajax/clienteVenta.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
        console.log("respuesta", respuesta);
        
        swal({
          type: "success",
          title: "El cliente ha sido guardado correctamente",
          showConfirmButton: true,
          confirmButtonText: "Cerrar"
          }).then(function(result){
            
            if (result.value) {
   
              $("#seleccionarCliente").val(respuesta["id"]);
              $("#nombrecliente").val(respuesta["nombre"]);
            }

        })
       

      }

    })
  }
  
})

