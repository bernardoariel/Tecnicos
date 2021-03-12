/*=============================================
CARGAR LA TABLA 
=============================================*/


/*=============================================
SELECCIONO La Venta
=============================================*/
$(".tablaSeleccionarVentas").on("click", ".btnSeleccionarFacturaRemito", function(){

    $(this).css("background-color", "#000000");

    var idVenta = $(this).attr("idventa");

    var datos = new FormData();
    datos.append("idVenta", idVenta);

    $.ajax({

      url:"ajax/ventaSeleccionada.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
    
      success:function(respuesta){
        // console.log("respuesta", respuesta);

        var mostrarSeleccion = new FormData();
        mostrarSeleccion.append("mostrarSeleccion", 1);

        $.ajax({

          url:"ajax/mostrarVentasSeleccionada.ajax.php",
          method: "POST",
          data: mostrarSeleccion,
          cache: false,
          contentType: false,
          processData: false,
          dataType:"json",
          success:function(respuesta){
            
            // console.log("respuestaaaa", respuesta);
            
            miarrayTotal='';
            nro =0;
            for (var i = 0; i < respuesta.length; i++) {
              
              nro = parseInt(i) + parseInt(1);

              miarray = '<tr>'+
                        '<td>'+nro +'</td>'+
                        '<td>'+respuesta[i]['nrofc']+'</td>'+
                        '<td>'+respuesta[i]['nombre']+'</td>'+
                        '<td>'+respuesta[i]['detalle']+'</td>'+
                      '</tr>';
             
              miarrayTotal=miarrayTotal+miarray ;  

            }

            $("#datosFcSeleccionadas").html(miarrayTotal);
 
          }

       })
       
      }

    })
   
   

})

$("#imprimirEtiqueta").on("click", function(){
  
  

  var ultimoRemito = new FormData();
  ultimoRemito.append("ultimoRemito", 1);

  $.ajax({//TOMO EL ULTIMO REMITO Y LE SUMO UNO

    url:"ajax/remitos.ajax.php",
    method: "POST",
    data: ultimoRemito,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(ultimoRemito){
      console.log("ultimoRemito", ultimoRemito);

      remitoNuevoValor = parseInt(ultimoRemito["numero"])+parseInt(1);

      var nuevoRemito = new FormData();
      nuevoRemito.append("nuevoRemito", remitoNuevoValor);

      $.ajax({//AGREGO UN NUEVO REMITO EN LA TABLA NROCOMPROBANTE

        url:"ajax/remitos.ajax.php",
        method: "POST",
        data: nuevoRemito,
        cache: false,
        contentType: false,
        processData: false,
        // dataType:"json",
        success:function(nuevoRemito){
          console.log("nuevoRemito", nuevoRemito);
          
          var remito = new FormData();
          remito.append("remito", remitoNuevoValor);

          $.ajax({//AGREGO UN NUEVO REMITO EN LA TABLA NROCOMPROBANTE

            url:"ajax/remitos.ajax.php",
            method: "POST",
            data: remito,
            cache: false,
            contentType: false,
            processData: false,
            // dataType:"json",
            success:function(res){
              console.log("res", res);

             window.location = "remitos";

              
           
            }
          
          })
       
        }
      
      })

   
    }
  
  })

 })

/*=============================================
IMPRIMIR REMITO
=============================================*/

$(".tablas").on("click", ".btnImprimirRemito", function(){

  var idventa = $(this).attr("idventa");
 


    window.open("extensiones/tcpdf/pdf/remito.php?id="+idventa, "_blank");

  
  

})
/*=============================================
IMPRIMIR REMITO
=============================================*/

$(".tablas").on("click", ".btnImprimirRemito2", function(){

  var idventa = $(this).attr("idventa");
 


    window.open("extensiones/tcpdf/pdf/remitosinimporte.php?id="+idventa, "_blank");

  
  

})