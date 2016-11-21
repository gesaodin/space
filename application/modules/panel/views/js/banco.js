$( "#id" ).keypress(function( event ) {
  if ( event.which == 13 ) {
    $("#btnActualizar").focus();
  }
});

function consultar() {

    var val = $("#id").val();
    $("#lblMedida").text('');
    ruta = sUrlP + "consultarBeneficiario/" + val;
    $.getJSON(ruta, function(data) {
            $("#nombres").val(data.nombres);
            $("#apellidos").val(data.apellidos);
            
            $("#componente").val(data.Componente.nombre);
            $("#grado").val(data.Componente.Grado.nombre);
            
            $("#numero_cuenta").val(data.numero_cuenta);
            
                   
        }

    ).done(function(msg) {}).fail(function(jqXHR, textStatus) {
       $("#txtMensaje").html('No se encontro cédula de beneficiario'); 
       $("#logMensaje").modal('show');
       limpiar();
    });

}

function cargarFecha(fecha){
    var f = fecha.split('-');
    return f[2] + '/' + f[1] + '/' + f[0];
}


function continuar(){
    $("#logMensaje").modal('hide');
    //$("#id").focus();
}