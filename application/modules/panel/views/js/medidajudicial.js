var Anticipo = {};
Anticipo['monto'] = 0;

$('#reporteMedida').DataTable({
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
    ruta = sUrlP + "consultarBeneficiarioJudicial/" + val;
    $.getJSON(ruta, function(data) {
       
        if(data.fecha_retiro != null && data.fecha_retiro != ''){
            $("#id").val('');
            var boton = '<button type="button" class="btn btn-success pull-right" onclick="continuar()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Continuar</button>';
            $("#divContinuar").html(boton);
            $("#txtMensaje").html('El Beneficiario que intenta consultar ya se encuentra retirado, por favor consultarlo por finiquito'); 
            $("#logMensaje").modal('show');
            $("#controles").hide();
            //limpiar();
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
            //console.log(data.MedidaJudicial);
            listar(data.MedidaJudicial);
            
            

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
        
    });

}

function listar(data){
    var t = $('#reporteMedida').DataTable();
    t.clear().draw();
    //console.log(data);
    $.each(data, function (clave, valor){

        var monto = Number(valor.monto);
        var sBoton = '<div class="btn-group">';
        var sAcciones = '';
        
        sBoton += '<button type="button" class="btn btn-success" title="Ver Detalles"><i class="fa fa-search" ></i></button>'; 
        switch (valor.estatus){
            case '220':
                sBoton += '<button type="button" class="btn btn-warning" title="Inactivar"><i class="fa fa-mail-reply-all" ></i></button>';
                sBoton += '<button type="button" class="btn btn-info" title="Ejecutar"><i class="fa fa-cogs" ></i></button>'; 
                break;
            case '221':
                break;
            case '222':
                break;
            case '223':
                
                sBoton += '<button type="button" class="btn btn-danger" title="Suspender"><i class="fa fa-cogs" ></i></button>'; 
                break;
            default:
                break;
        }
        
        sBoton += '</div>';
        
        t.row.add( [
            sBoton,
            valor.tipo_nombre,
            valor.estatus_nombre,
            valor.fecha,
            valor.numero_oficio,
            valor.numero_expediente,
            valor.cedula_beneficiario,
            valor.nombre_beneficiario,
            valor.estado
        ] ).draw( false );
        
    });
}

function continuar(){
    $("#logMensaje").modal('hide');
}

function obtenerCiudades(){
    var i = 0;
    id = $("#estado option:selected").val();
    ruta = sUrlP + "obtenerCiudades/" + id;
    $("#ciudad option").remove();
    $("#municipio option").remove();

    $.getJSON(ruta, function(data) {
        $.each(data, function(d, v){            
            var opt = new Option(v.nombre, v.id);
            $("#ciudad").append(opt);
            i = v.id;
        });
        obtenerMunicipiosID(i);

    }).done(function(msg) {}).fail(function(jqXHR, textStatus) {
       $("#txtMensaje").html('No se encontraron ciudades'); 
       $("#logMensaje").modal('show');
    });
}

function obtenerMunicipios(){
    id = $("#ciudad option:selected").val();
    obtenerMunicipiosID(id);
}

function obtenerMunicipiosID(id){
    ruta = sUrlP + "obtenerMunicipios/" + id;
    $("#municipio option").remove();
    $.getJSON(ruta, function(data) {
        $.each(data, function(d, v){            
            var opt = new Option(v.nombre, v.id);
            $("#municipio").append(opt);           
        });
    }).done(function(msg) {}).fail(function(jqXHR, textStatus) {
       $("#txtMensaje").html('No se encontraron municipios'); 
       $("#logMensaje").modal('show');
    });
}
