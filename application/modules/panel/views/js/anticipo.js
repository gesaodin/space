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
            
            $("#garantias").val(data.Calculo.garantias);
            $("#garantias_aux").val(data.Calculo.garantias_aux);

            $("#anticipos").val(data.Calculo.anticipos);
            $("#anticipos_aux").val(data.Calculo.anticipos_aux);

            $("#saldo_disponible").val(data.Calculo.saldo_disponible);
            $("#saldo_disponible_aux").val(data.Calculo.saldo_disponible_aux);

            $("#medidas_judiciales").val(data.Calculo.medida_judicial_activas);
            $("#medidas_judiciales_aux").val(data.Calculo.medida_judicial_activas_aux);

            listar(data.HistorialOrdenPagos);

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
    var t = $('#reporteAnticipo').DataTable();
    t.clear().draw();
    $.each(data, function (clave, valor){
        var monto = Number(valor.monto);
        var sBoton = '<div class="btn-group">';
        var sAcciones = '';
        if(valor.estatus == '100'){
            sBoton += '<button type="button" class="btn btn-info" title="Imprimir"><i class="fa fa-print" ></i></button>';                
            sBoton += '<button aria-expanded="false" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">';
            sBoton += '<span class="caret"></span>';
            sBoton += '<span class="sr-only">Toggle Dropdown</span>';
            sBoton += '</button>';

            sAcciones = '<ul class="dropdown-menu" role="menu">';
            sAcciones += '<li><a href="#!" target="_top" onclick="HojaVida(\'' + valor.cedula_beneficiario + '\')">Hoja de Vida (PRINT)</a></li>';
            sAcciones += '<li><a href="#!" target="_top" onclick="OrdenPagoAnticipo(\'' + valor.cedula_beneficiario + '\')">Orden de Pago</a></li>';
            sAcciones += '<li><a href="#!" target="_top" onclick="PuntoCuenta(\'' + valor.cedula_beneficiario + '\')">Punto de Cuenta</a></li>';
            
            sAcciones += '</ul>';
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

function OrdenPagoAnticipo(id){    
    URL = sUrlP + "ordenpago/" + id;
    window.open(URL,"Orden de Pago","toolbar=0,location=1,menubar=0,scrollbars=1,resizable=1,width=900,height=800")
}

function PuntoCuenta(id){    
    URL = sUrlP + "puntocuenta/" + id;
    window.open(URL,"Punto de Cuenta","toolbar=0,location=1,menubar=0,scrollbars=1,resizable=1,width=900,height=800")
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
    //$("#id").focus();
}

function calcularPorcentaje(){
    var porcentaje = Number($("#porcentaje").val());

    if(porcentaje > 75 || porcentaje == 0){
        var boton = '<button type="button" class="btn btn-success pull-right" onclick="continuar()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Continuar</button>';
        $("#divContinuar").html(boton);
        $("#porcentaje").val('');
        $("#txtMensaje").html('El porcentaje no puede ser mayor al 75% o estar en cero'); 
        $("#logMensaje").modal('show');

        $("#controles").hide();
    }else{
        var boton = '<button type="button" class="btn btn-danger pull-right" onclick="continuar()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;No</button>';
            boton += '<button type="button" class="btn btn-success" onclick="continuarAnticipo()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Si</button>';
        $("#divContinuar").html(boton);

        var disponible = Number($("#saldo_disponible_aux").val());
        var cantidad = (disponible * porcentaje) / 100;
        var resultado = parseFloat(cantidad).toFixed(2);
        $("#txtMensaje").html('Está seguro que desea efectuar el anticipo por Bs. ' + resultado); 
        $("#logMensaje").modal('show');
        $("#controles").hide();
        
    }
}

function calcularMonto(){
    monto = Number($("#monto").val());
    var disponible = Number($("#saldo_disponible_aux").val());
    
    var cantidad = (100 * monto) / disponible;
    if(cantidad > 75 || cantidad == 0){
        var boton = '<button type="button" class="btn btn-success pull-right" onclick="continuar()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Continuar</button>';
        $("#divContinuar").html(boton);
        $("#txtMensaje").html('El Monto no puede ser mayor al 75% o estar en cero'); 
        $("#logMensaje").modal('show');
        $("#controles").hide();
    }else{
       var boton = '<button type="button" class="btn btn-danger pull-right" onclick="continuar()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;No</button>';
            boton += '<button type="button" class="btn btn-success" onclick="continuarAnticipo()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Si</button>';
        $("#divContinuar").html(boton);

        
        $("#txtMensaje").html('Está seguro que desea efectuar el anticipo por Bs. ' + monto); 
        $("#logMensaje").modal('show');
        $("#controles").hide(); 
    }
}

function continuarAnticipo(){

}