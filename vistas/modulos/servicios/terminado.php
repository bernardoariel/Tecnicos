<?php
session_start();
  #clientes
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
#productos
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

#empresa
require_once "../../../controladores/servicios.controlador.php";
require_once "../../../modelos/servicios.modelo.php";
?>
<table class="table table-bordered table-striped dt-responsive tablaServiciosTerminado" width="100%">

 <thead>

  <tr>

   <th style="background-color:#C8E6C9">#</th>
   <th style="width: 100px;background-color:#C8E6C9">Cliente</th>
   <th style="width: 60px;background-color:#C8E6C9">Producto</th>
   <th style="width: 100px;background-color:#C8E6C9">Problema 1</th>
   <th style="width: 50px;background-color:#C8E6C9">Presupuesto</th>
   <th style="background-color:#C8E6C9">Reparacion</th>
   <th style="width: 50px;background-color:#C8E6C9">Precio</th>
   <th style="width: 100px;background-color:#C8E6C9">Acciones</th>

  </tr>

 </thead>

 <tbody>

  <?php

  $item = null;
  $valor = null;
  $orden = null;
  $forma = null;
  $estado = 3;
  if (isset($_GET["orden"])) {

   $orden = "fecha";//$_GET["orden"];
   $forma = "DESC";
  } else {

   $orden = "id";
   $forma = "ASC";
  }


  $serviciosTerminado = ControladorServicios::ctrMostrarServicios($item, $valor, $orden, $forma, $estado);


  foreach ($serviciosTerminado as $key => $value) {

   

    echo '<tr>

                    <td>' . ($key + 1) . '</td>

                    <td>' . $value["cliente"] . '</td>

                    <td>' . $value["producto"] . '</td>

                    <td>' . $value["problema"] . '</td>

                    <td>' . $value["presupuesto"] . '</td>

                    <td>' . $value["reparacion"] . '</td>

                    <td>' . $value["precio"] . '</td>

                    <td>';

    echo '<div class="btn-group">
                          
                  <button class="btn btn-info btnAServicio btn-flat" idServicio="' . $value["id"] . '" idUsuario="' . $_SESSION["id"] . '" title="Devolver a Servicio"><i class = "fa  fa-mail-reply-all" > </i> </button>
                  
                  <button class="btn btn-danger btnEntregado btn-flat" idServicio="' . $value["id"] . '" idUsuario="' . $_SESSION["id"] . '" title="Producto Entregado"><i class="fa  fa-external-link"></i></button>    
                          
           </div>';

    echo '</td>

                </tr>';
   
  } // foreach

  ?>

 </tbody>

</table>

<script>
/*=============================================
CARGAR LA TABLA 
=============================================*/
var table = $('.tablaServiciosTerminado').DataTable({
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

$("#tab1").children().children()[0].remove();
$(".tablaServiciosTerminado tbody").on("click", "button.btnAServicio", function () {
      
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

    $(".tablaServiciosTerminado tbody").on("click", "button.btnEntregado", function () {
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
            var mensaje = new FormData();
            mensaje.append("idServicioMensaje", idServicioCambiarEstado);
            mensaje.append("servicioMensaje", 4);//terminado
            $.ajax({
              url: "ajax/mensajes.ajax.php",
              method: "POST",
              data: mensaje,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success: function (respuesta) {
               
              console.log('respuesta: ', respuesta);
              window.open('https://api.whatsapp.com/send?phone='+respuesta['telefono']+'&text='+respuesta['mensaje']+'', '_blank');
              // window.location = "index.php?ruta=servicios&vista=terminado";
              }

            })
            
            
            
            
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
</script>