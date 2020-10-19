$( "#id" ).keypress(function( event ) {
  if ( event.which == 13 ) {    
    $("#numero_cuenta").focus();
  }
});

function consultar() {

    var val = $("#id").val();
    ruta = sUrlP + "consultarBeneficiario/" + val;
    $.getJSON(ruta, function(data) {
            $("#nombres").val(data.nombres);
            $("#apellidos").val(data.apellidos);
            
            $("#componente").val(data.Componente.nombre);
            $("#grado").val(data.Componente.Grado.nombre);
            console.log(data);

            var numero_cuenta = $("#numero_cuenta").val(data.numero_cuenta.substring(4, data.numero_cuenta.length));
            
                              
        }

    ).done(function(msg) {}).fail(function(jqXHR, textStatus) {
       $("#txtMensaje").html('No se encontro cédula de beneficiario'); 
       $("#logMensaje").modal('show');
       limpiar();
    });

}


function continuar(){
    $("#logMensaje").modal('hide');
}


function limpiar(){

    $("#grado").val('');   
    $("#componente").val('');
    $("#nombres").val('');
    $("#apellidos").val('');
    $("#numero_cuenta").val('');
    $("#cedula").val();
    $("#llave").val();
    $("#datepicker").val();
    
}

<<<<<<< HEAD
/*function actualizar(id){
    var boton = '<button type="button" class="btn btn-danger pull-right" onclick="continuar()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;No</button>';
            boton += '<button type="button" class="btn btn-success" onclick="actualizarechazos(\'' + id + '\')">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Si</button>';
    var msj = '¿Está seguro que desea rechazar está operación?';
    $("#divContinuar").html(boton);
    $("#txtMensaje").html(msj);
    $("#logMensaje").modal('show');
    $("#controles").hide();
  }*/
=======
>>>>>>> dbafbb890182489424b2af32fa1a5761e2e9f870

function actualizar(){

  var val = $("#cedula").val();
  var llave = $("#llave").val();

    ruta = sUrlP + "actualizarRechazos/" + val + "/" + llave;
    $.getJSON(ruta, function(data) {
            $("#cedula").val(data.cedula);
            $("#llave").val(data.codigo);
          console.log(data);                             
        }

    ).done(function(msg) {}).fail(function(jqXHR, textStatus) {
       $("#txtMensaje").html('Rechazo actulizado con exito!');
       $("#logMensaje").modal('show');
       limpiar();
    });
    
    
}

function actualizarfecha(){

    var fecha ="";
    var f = $("#datepicker").val();
    f = f.split('/');
        fecha = f[2] + '-' + f[1] + '-' + f[0];

    var llave = $("#llave").val();

    ruta = sUrlP + "actualizarFecha/" + fecha + "/" + llave;
    $.getJSON(ruta, function(data) {
            $("#fecha").val(data.f_contable);
            $("#llave").val(data.codigo);
          console.log(data);                             
        }

    ).done(function(msg) {}).fail(function(jqXHR, textStatus) {
       $("#txtMensaje").html('Fecha Valor Actualizada con exito!');
       $("#logMensaje").modal('show');
       limpiar();
    });
    
    
}