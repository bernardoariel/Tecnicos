var tServEstado = 0;
var tServFecha1 = null;//"2021-03-29";
var tServFecha2 = null;//"2021-03-29";
/*=============================================
CARGAR LA TABLA 
=============================================*/
var table = $('.tablaServiciosTodos').DataTable({
   "ajax":"ajax/tabla-tls.ajax.php?tServEstado="+tServEstado+"&tServFecha1="+tServFecha1+"&tServFecha2="+tServFecha1,
 
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

// $('.tablaServiciosTodos').DataTable( {
//     initComplete: function () {
//         this.api().columns().every( function () {
//             var column = this;
//             var select = $('<select><option value=""></option></select>')
//                 .appendTo( $(column.footer()).empty() )
//                 .on( 'change', function () {
//                     var val = $.fn.dataTable.util.escapeRegex(
//                         $(this).val()
//                     );

//                     column
//                         .search( val ? '^'+val+'$' : '', true, false )
//                         .draw();
//                 } );

//             column.data().unique().sort().each( function ( d, j ) {
//                 select.append( '<option value="'+d+'">'+d+'</option>' )
//             } );
//         } );
//     }
// } );
$(".dataTables_length").remove();
// $("#DataTables_Table_0_filter").children().addClass("pull-left");
$("#DataTables_Table_0_filter").children().children().removeClass("input-sm");
$("#DataTables_Table_0_filter").children().children().addClass("input-lg");





// for (let sec of estados){
//   var op = document.createElement('option'); 
//   select.appendChild(op); 

//   op.innerHTML = `${sec}`;                      
// }
$("#selectModo").on("change",function(){

  tServEstado = $(this).val();
  table.clear().draw();

  urlNueva="ajax/tabla-tls.ajax.php?tServEstado="+tServEstado+"&tServFecha1="+tServFecha1+"&tServFecha2="+tServFecha1;

  table.ajax.url( urlNueva).load();


})



$("#btnxls").on("click",function(){
  
  window.location = "vistas/modulos/reportes.php?ruta=reportes&tServEstado="+tServEstado+"&tServFecha1="+tServFecha1+"&tServFecha2="+tServFecha1;

})

// $("#btnBuscar").on("click",function(){

//   alert(tServEstado+"-"+tServFecha1+"-"+tServFecha2)
// })
     
     
/*=============================================
CRGAR LOS DATOS JASON
=============================================*/

  
  var datos = new FormData();
  datos.append("sinParametro2s", "sinParametros");
  //HAGO UN AJAX CON JSON
  $.ajax({
      url:"ajax/tabla-tls.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      // dataType:"json",
      success:function(respuesta){
        console.log("respuesta", respuesta);
      }
  
})
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