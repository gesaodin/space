var Anticipo = {};
Anticipo['monto'] = 0;

$('#reporteAnticipo').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false
    }
);



$( "#id" ).keypress(function( event ) {
  if ( event.which == 13 ) {
    $("#btnMedida").focus();
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

            $("#medidas_judiciales").val(data.Calculo.embargos);
            $("#medidas_judiciales_aux").val(data.Calculo.embargos_aux);

            listar(data.HistorialOrdenPagos);
            var monto = data.Calculo.saldo_disponible_aux;
            var saldo =  (Number(monto) * 75)/100;
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
    var t = $('#reporteAnticipo').DataTable();
    t.clear().draw();
    $.each(data, function (clave, valor){
        var monto = Number(valor.monto);
        var sBoton = '<div class="btn-group">';
        var sAcciones = '';
        if(valor.estatus == 100){
            if(valor.movimiento == 0 )sBoton += '<button type="button" class="btn btn-info" title="Punto de Cuenta" onclick="PuntoCuenta(\'' + valor.id + '\')"><i class="fa fa-print" ></i></button>';                
            /**
            Buscar Archivos Viejos del sistema
            sAcciones = '<ul class="dropdown-menu" role="menu">';
            sAcciones += '<li><a href="#!" target="_top" onclick="HojaVida(\'' + valor.cedula_beneficiario + '\')">Hoja de Vida (PRINT)</a></li>';
            sAcciones += '<li><a href="#!" target="_top" onclick="OrdenPagoAnticipo(\'' + valor.cedula_beneficiario + '\')">Orden de Pago</a></li>';
            sAcciones += '<li><a href="#!" target="_top" onclick="PuntoCuenta(\'' + valor.cedula_beneficiario + '\')">Punto de Cuenta</a></li>';
            
            sAcciones += '</ul>';
            **/
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
}