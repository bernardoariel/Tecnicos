$("#modalStockaCero").click(function() {
  
	swal({

		title: '¿Está seguro de llevar a cero el stock de los productos?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, eliminar Stock!'
        }).then(function(result) {

        if (result.value) {

        	window.location = "index.php?ruta=inicio&stock=0";

        }

	})

 })