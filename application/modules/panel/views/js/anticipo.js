/**
*
*
*/
var Anticipo = {};

Anticipo['monto'] = 0;

//var fecha = '2016-11-03'; //Establece la fecha antes del y despues del
var porcentaje = 0; //Define el anticipo menor a la feha
//var anticipoF = 0; //Define el anticipo mayor igual a la fecha
var porcentajeMaximo = 75; //Establece el porcentaje máximo permitido para un anticipo
var capital_banco = 0;
var garantias = 0;
var monto_disponible = 0;
var porcentaje =0;

$('#reporteAnticipo').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false
    }
);

$( "#id" ).keypress(function( event ) {
  if ( event.which == 13 ) {
    $("#nombres").focus();
  }
});

function consultar() {
    var val = $("#id").val();
    ruta = sUrlP + "consultarBeneficiario/" + val;
    $.getJSON(ruta, function(data) {

        if(data.fecha_retiro != null && data.fecha_retiro != ''){
            $("#id").val('');
            var boton = '<button type="button" class="btn btn-success pull-right" onclick="continuar()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Continuar</button>';
            $("#divContinuar").html(boton);
            $("#txtMensaje").html('El Beneficiario que intenta consultar ya se encuentra retirado, por favor consultarlo por finiquito');
            $("#logMensaje").modal('show');
            $("#controles").hide();
            limpiar();
        }else{
            $("#divBotones").show();
            $("#btnAnticipo").focus();
            $("#nombres").val(data.nombres);
            $("#apellidos").val(data.apellidos);
            $("#sexo").val(data.sexo);
            $("#componente").val(data.Componente.nombre);
            $("#grado").val(data.Componente.Grado.nombre);
            $("#fingreso").val(data.fecha_ingreso);
            $("#tservicio").val(data.tiempo_servicio);
            $("#nhijos").val(data.numero_hijos);
            $("#fuascenso").val(data.fecha_ultimo_ascenso);
            $("#noascenso").val(data.no_ascenso);
            $("#profesionalizacion").val(data.profesionalizacion);
            $("#arec").val(data.ano_reconocido);
            $("#mrec").val(data.mes_reconocido);
            $("#drec").val(data.dia_reconocido);
            $("#fecha_retiro").val(data.fecha_retiro);
            $("#fano").val(data.aguinaldos_aux);
            $("#vacaciones").val(data.vacaciones_aux);
            $("#numero_cuenta").val(data.numero_cuenta);
            $("#estatus").val(data.estatus_descripcion);

            $("#capital_banco").val(data.Calculo.capital_banco);
            $("#capital_banco_aux").val(data.Calculo.capital_banco_aux);
            capital_banco = data.Calculo.capital_banco_aux;

            $("#garantias").val(data.Calculo.garantias);
            $("#garantias_aux").val(data.Calculo.garantias_aux);
            garantias = data.Calculo.garantias_aux;

            $("#anticipos").val(data.Calculo.anticipos);
            $("#anticipos_aux").val(data.Calculo.anticipos_aux);
            anticipos = data.Calculo.anticipos_aux;

            $("#saldo_disponible").val(data.Calculo.saldo_disponible);
            $("#saldo_disponible_aux").val(data.Calculo.saldo_disponible_aux);

            $("#medidas_judiciales").val(data.Calculo.embargos);
            $("#medidas_judiciales_aux").val(data.Calculo.embargos_aux);

            $("#comision_servicios").val(data.Calculo.comision_servicios);
            $("#comision_servicios_aux").val(data.Calculo.comision_servicios_aux);
            comision_servicios = data.Calculo.comision_servicios_aux;

            listar(data.HistorialOrdenPagos);
            monto_disponible = data.Calculo.asignacion_depositada_aux;

            var saldo =  (Number(monto_disponible) * porcentajeMaximo)/100;
            var calculo = Number(saldo) - Number(data.Calculo.embargos_aux);
            if(calculo < 0){
                $("#divBotones").hide();
                var boton = '<button type="button" class="btn btn-danger pull-right" onclick="continuar()">';
                    boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Continuar</button>';
                var msj = 'El beneficiaio no puede solicitar anticipo porque excede el monto del capital en banco al aplicarle la Medida Judicial';
                $("#divContinuar").html(boton);
                $("#txtMensaje").html(msj);
                $("#logMensaje").modal('show');
            }


        }

    }).done(function(msg) {}).fail(function(jqXHR, textStatus) {
        $("#id").val('');
        var boton = '<button id="btnContinuar" type="button" class="btn btn-success pull-right" onclick="continuar()">';
        boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Continuar</button>';
        $("#divContinuar").html(boton);
        $("#txtMensaje").html('El Beneficiario que intenta consultar no se encuentra en nuestra base de datos');
        $("#logMensaje").modal('show');
        $("#controles").hide();
        $("#btnContinuar").focus();
        limpiar();
    });

}

function listar(data){
    anticipoI = 0; //Define el anticipo menor a la feha
    anticipoF = 0; //Define el anticipo mayor igual a la fecha
    var t = $('#reporteAnticipo').DataTable();
    t.clear().draw();
    $.each(data, function (clave, valor){
        var monto = Number(valor.monto);

        var sBoton = '<div class="btn-group">';
        var sAcciones = '';
        if(valor.estatus == 100){
           /* if(valor.fecha_creacion > fecha){
                anticipoF += monto;
            }else{
                anticipoI += monto;
            }*/
            if(valor.movimiento == 0 ){
                sBoton += '<button type="button" class="btn btn-info" title="Imprimir"><i class="fa fa-print" ></i></button>';
                sBoton += '<button aria-expanded="false" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">';
                sBoton += '<span class="caret"></span>';
                sBoton += '<span class="sr-only">Toggle Dropdown</span>';
                sBoton += '</button>';
                sAcciones = '<ul class="dropdown-menu" role="menu">';
                sAcciones += '<li><a href="#!" target="_top" onclick="HojaVida(\'' + $("#id").val() + '\')">Hoja de Vida (PRINT)</a></li>';
                sAcciones += '<li><a href="#!" target="_top" onclick="PuntoCuenta(\'' + valor.id + '\')">Punto de Cuenta</a></li>';

                sAcciones += '</ul>';
            }

        }else if(valor.estatus == '101'){
            if(valor.movimiento == 0 )sBoton += '<button type="button" class="btn btn-danger" title="Recharzar" onclick="rechazar(\'' + valor.id + '\')"><i class="fa fa-remove" ></i></button>';
        }
        sBoton += sAcciones + '</div>';


        t.row.add( [
            sBoton,
            estatus(valor.estatus),
            valor.fecha_creacion,
            valor.motivo,

            monto.formatMoney(2, ',', '.')
        ] ).draw( false );
    });
    //validarPorcentaje();

}

function rechazar(id){
    var boton = '<button type="button" class="btn btn-danger pull-right" onclick="continuar()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;No</button>';
            boton += '<button type="button" class="btn btn-success" onclick="rechazarAnticipo(\'' + id + '\')">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Si</button>';
    var msj = '¿Está seguro que desea rechazar está operación?';
    $("#divContinuar").html(boton);
    $("#txtMensaje").html(msj);
    $("#logMensaje").modal('show');
    $("#controles").hide();
}



function estatus(cod){
    var texto = '';
    switch (cod){
        case '100':
            texto = 'EJECUTADA';
            break;
        case '101':
            texto = 'PENDIENTE';
            break;
        case '102':
            texto = 'RECHAZADA';
            break;
        case '103':
            texto = 'REVERSADA';
            break;
    }
    return texto;
}

function HojaVida(id){
    URL = sUrlP + "hojavida/" + id;
    window.open(URL,"Hoja de Vida","toolbar=0,location=1,menubar=0,scrollbars=1,resizable=1,width=900,height=800")
}

function PuntoCuenta(id){
    URL = sUrlP + "puntocuenta/" + $("#id").val()  + "/" + id  ;
    window.open(URL,"Punto de Cuenta","toolbar=0,location=0,menubar=0,scrollbars=1,resizable=1,width=1100,height=600")
}

function limpiar(){
    $("#nombres").val('');
    $("#apellidos").val('');
    $("#sexo").val('');
    $("#componente").val('');
    $("#grado").val('');
    $("#fingreso").val('');
    $("#tservicio").val('');
    $("#nhijos").val('');
    $("#fuascenso").val('');
    $("#noascenso").val('');
    $("#profesionalizacion").val('');
    $("#arec").val('');
    $("#mrec").val('');
    $("#drec").val('');
    $("#fecha_retiro").val('');
    $("#fano").val('');
    $("#vacaciones").val('');
    $("#numero_cuenta").val('');
    $("#estatus").val('');
}

function continuar(){
    $("#logMensaje").modal('hide');
}


function validarPorcentaje(){
    var suma = Number(capital_banco) + Number(garantias);
    monto_disponible = parseFloat(suma).toFixed(2);


}

function calcularPorcentaje(){
    
    if($("#porcentaje").val() == '')return false;
    porcentaje = Number($("#porcentaje").val());
    var monto_resguardo = monto_disponible * 0.25;
    var medidas_judiciales_aux = Number($("#medidas_judiciales_aux").val());
    var disponible = monto_disponible;
    var msj = '';
    if(porcentaje > porcentajeMaximo || porcentaje == 0){
        var boton = '<button type="button" class="btn btn-success pull-right" onclick="continuar()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Continuar</button>';
        $("#divContinuar").html(boton);
        $("#porcentaje").val('');
        var valor_m = Number(monto_disponible);
        $("#txtMensaje").html('El porcentaje no puede ser mayor al ' + porcentajeMaximo + ' % o estar en cero ');
        $("#logMensaje").modal('show');
        $("#controles").hide();
    }else{ if(Number($("#medidas_judiciales_aux").val()) <= 0){
            
        $("#divContinuar").html(crearBoton());
        var cantidad = ((disponible * porcentaje) / 100)- Number($("#anticipos_aux").val());
        msj = 'Está seguro que desea efectuar el anticipo por Bs. ' + cantidad.formatMoney(2, ',', '.');
        var valor_m = Number(monto_disponible);
        
        msj += ' partiendo del monto disponible ' + valor_m.formatMoney(2, ',', '.');
        Anticipo['monto'] = parseFloat(cantidad).toFixed(2);

        if(cantidad < 1){
            var boton = '<button type="button" class="btn btn-danger pull-right" onclick="recargar()">';
                boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Continuar</button>';
            msj = 'El beneficiario no puede solicitar anticipo porque excede el monto del capital';
            $("#divContinuar").html(boton);
        }     

        }else{ if(medidas_judiciales_aux > monto_resguardo){
            var resta_medida = medidas_judiciales_aux - monto_resguardo;
            var cantidad1 = ((disponible * porcentaje) / 100) - Number($("#anticipos_aux").val()) - parseFloat(resta_medida).toFixed(2);
            
        $("#divContinuar").html(crearBoton());
        msj = ' if de medida judicial aux > monto resguardo Está seguro que desea efectuar el anticipo por Bs. ' + cantidad1.formatMoney(2, ',', '.');
        Anticipo['monto'] = parseFloat(cantidad1).toFixed(2);
        } else{
             var cantidad1 = ((disponible * porcentaje) / 100) - Number($("#anticipos_aux").val()) - Number($("#medidas_judiciales_aux").val());
              
        $("#divContinuar").html(crearBoton());
            msj = ' else de medida judicial aux > monto resguardo Está seguro que desea efectuar el anticipo por Bs. ' + cantidad1.formatMoney(2, ',', '.');
         Anticipo['monto'] = parseFloat(cantidad1).toFixed(2);
        }
       
        }

    }
        $("#txtMensaje").html(msj);
        $("#logMensaje").modal('show');
        $("#controles").hide();

} 

function crearBoton(){
     var boton = '<button type="button" class="btn btn-danger pull-right" onclick="continuar()">\
        <i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;No</button>\
        <button type="button" class="btn btn-success" onclick="continuarAnticipo(101)">\
        <i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Si</button>';
    return boton;
}

function calcularMonto(){
    if($("#monto").val() == '')return false;
    monto = Number($("#monto").val());
    var monto_resguardo = monto_disponible * 0.25;
    var medidas_judiciales_aux = Number($("#medidas_judiciales_aux").val());

    
    var monto2= Number($("#medidas_judiciales_aux").val())+ Number($("#anticipos_aux").val()) + monto;
    var disponible = Number(monto_disponible); 

    
    var cantidad = Number(((parseFloat(disponible).toFixed(2) * porcentajeMaximo)/100) - Number($("#medidas_judiciales_aux").val())- Number($("#anticipos_aux").val()));
    porcentaje = ((monto2 / disponible)*100);
    
    
    if (porcentaje> porcentajeMaximo || porcentaje == 0) {
        var boton = '<button type="button" class="btn btn-success pull-right" onclick="continuar()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Continuar</button>';
        $("#divContinuar").html(boton);
        $("#txtMensaje").html('El Monto no puede ser mayor al ' +porcentaje + ' % o estar en cero');
        $("#logMensaje").modal('show');
        $("#controles").hide();

    } else{
        var boton = '<button type="button" class="btn btn-danger pull-right" onclick="continuar()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;No</button>';
            boton += '<button type="button" class="btn btn-success" onclick="continuarAnticipo(101)">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Si</button>';
        $("#porcentaje").val(parseFloat(porcentaje).toFixed(2));
         Anticipo['monto'] = parseFloat(monto).toFixed(2); 
        $("#divContinuar").html(boton);
        $("#txtMensaje").html('Está seguro que desea efectuar el anticipo por Bs. ' + monto.formatMoney(2, ',', '.')+ ' que representa el '+parseFloat(porcentaje).toFixed(0)+'%');
        $("#logMensaje").modal('show');
        $("#controles").hide();

}

}

/*function calcularMonto(){
    if($("#monto").val() == '')return false;
    monto = Number($("#monto").val());

    var monto2= Number($("#medidas_judiciales_aux").val())+ Number($("#anticipos_aux").val()) + monto;
    var disponible = Number(monto_disponible); 

    
    var cantidad = Number(((parseFloat(disponible).toFixed(2) * porcentajeMaximo)/100) - Number($("#medidas_judiciales_aux").val())- Number($("#anticipos_aux").val()));
    porcentaje = ((monto2 / disponible)*100);
    
    
    if (porcentaje> porcentajeMaximo || porcentaje == 0) {
        var boton = '<button type="button" class="btn btn-success pull-right" onclick="continuar()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Continuar</button>';
        $("#divContinuar").html(boton);
        $("#txtMensaje").html('El Monto no puede ser mayor al ' +porcentaje + ' % o estar en cero');
        $("#logMensaje").modal('show');
        $("#controles").hide();

    } else{
        var boton = '<button type="button" class="btn btn-danger pull-right" onclick="continuar()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;No</button>';
            boton += '<button type="button" class="btn btn-success" onclick="continuarAnticipo(101)">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Si</button>';
        $("#porcentaje").val(parseFloat(porcentaje).toFixed(2));
         Anticipo['monto'] = parseFloat(monto).toFixed(2); 
        $("#divContinuar").html(boton);
        $("#txtMensaje").html('Está seguro que desea efectuar el anticipo por Bs. ' + monto.formatMoney(2, ',', '.')+ ' que representa el '+parseFloat(porcentaje).toFixed(0)+'%');
        $("#logMensaje").modal('show');
        $("#controles").hide();

}

}*/

function cargar(){
    if (Anticipo['monto'] > 0){
        Anticipo['id'] = $("#id").val();
        Anticipo['motivo'] = 'Anticipo - ' + $("#motivo_medida option:selected").text();
        Anticipo['porcentaje'] = $('#porcentaje').val();//se agrega para mostrar el porcentaje en el punto de cuenta

        Anticipo['tipo'] = 1;
        Anticipo['nombre'] = $('#nombres').val();
        Anticipo['apellido'] = $('#apellidos').val();

    }

}
function continuarAnticipo(estatus){
    Anticipo['estatus'] = estatus;
    cargar();

    $("#myModal").modal('hide');
    $.ajax({
              url: sUrlP + "crearOrdenPago",
              type: "POST",
              data: {'data' : JSON.stringify({
                Anticipo: Anticipo
              })},
              success: function (data) {
                var boton = '<button type="button" class="btn btn-success pull-right" onclick="recargar()">';
                    boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Continuar</button>';
                $("#divContinuar").html(boton);
                $("#txtMensaje").html(data);
                $("#logMensaje").modal('show');

              },
              error: function(data){
                $("#txtMensaje").html('Ocurrio un error en la conexion');
                $("#logMensaje").modal('show');

              }
            });
}

function rechazarAnticipo(id){

    $("#myModal").modal('hide');
    $.ajax({
              url: sUrlP + "rechazarAnticipo",
              type: "POST",
              data: {'data' : JSON.stringify({
                id: id
              })},
              success: function (data) {
                var boton = '<button type="button" class="btn btn-success pull-right" onclick="recargar()">';
                    boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Continuar</button>';
                $("#divContinuar").html(boton);
                $("#txtMensaje").html(data);
                $("#logMensaje").modal('show');

              },
              error: function(data){
                $("#txtMensaje").html('Ocurrio un error en la conexion');
                $("#logMensaje").modal('show');

              }
            });
}

function recargar(){
    URL = sUrlP + "anticipo";
    $(location).attr('href', URL);
}
