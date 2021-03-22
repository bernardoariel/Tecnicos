$("#btn-inicioClientes").click(function() {
  
	window.location = "clientes";

 })

 $("#btn-inicioProductos").click(function() {
  
	window.location = "productos";
    
 })

 $("#btn-inicioServicios").click(function() {
  
	window.location = "servicios";
    
 })

 $(document).ready(function() {
  $('#selectCliente').select2({
    width: '100%',
    placeholder: 'Seleccione al Cliente',
    language: {
      noResults: function() {
        
        return '<button id="no-results-btn" class="btn btn-danger btn-flat btn-xs btn-block" onclick="noResultsButtonClicked()">Agregar Cliente Nuevo</a>';
      },
    },
    escapeMarkup: function(markup) {
      return markup;
    },
  });
});

function noResultsButtonClicked() {
  
  	$("#servicioCliente").val($(".select2-search__field").val());
	  $("#servicioTelefono").val("0000000000");
	  $("#servicioCliente").focus();
    $("#servicioCliente").select();
    $("#idCLienteServicio").val("0");
    $('.select2-container').remove();
    $('#divSelect').remove();

    
    
}

$("#modalAgregarServicio").on("hidden.bs.modal", function () {
  // Aquí va el código a disparar en el evento
  location.reload();
    

});

