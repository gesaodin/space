/**
* Fallecimiento en acto de servicio o Fuera
*/
var iFamiliares = 0;

Number.prototype.formatMoney = function(c, d, t){
var n = this, 
    c = isNaN(c = Math.abs(c)) ? 2 : c, 
    d = d == undefined ? "." : d, 
    t = t == undefined ? "," : t, 
    s = n < 0 ? "-" : "", 
    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };


function consultar() {
    var val = $("#id").val();
    ruta = sUrlP + "consultarBeneficiario/" + val;
    $.getJSON(ruta, function(data) {

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


        }

    ).done(function(msg) {}).fail(function(jqXHR, textStatus) {
        console.log(jqXHR);
    });

}


/**
*   Permite Realizar Carga Familiar
*   Segun sea el caso > 8 y menor que 11 en la 
*   tabla motivo (id)
*   @return html
*/
function seleccionarMotivo(){
    var motivo = $("#motivo_finiquito option:selected").val();

    if(motivo > 8 && motivo < 11){
        var val = $("#id").val();
        ruta = sUrlP + "obtenerFamiliares/" + val;    
        $.getJSON(ruta, function(data) {    
            sBoton = '<center><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-user-plus"></i> Agregar Familiar</button>';
            sTable = sBoton + '<br>';
            sTable += '<TABLE id="dbFamiliares" class="display compact table table-striped table-bordered" width="100%" cellspacing="0">';
            sTable += '<THEAD><TR><TH>Cedula</TH><TH>Nombre</TH><TH>Parentesco</TH>';
            sTable += '<TH>DIST. A.A</TH><TH>Capital Banco</TH><TH>Monto Dif. A.A.</TH>';
            sTable += '<TH>M. Act. Serv.</TH><TH>Dist.C.M</TH><TH>C.M</TH>';
            //sTable += '<TH>OPCIONES</TH>';
            sTable += '</TR></THEAD>';
            sCuerpo = '<TBODY>';
            $.each(data, function ( clv, valores ){
                iFamiliares++;
                sCuerpo += '<TR>';
                sCuerpo += '<TH>' + valores.cedula + '</TH>';
                sCuerpo += '<TD>' + valores.nombre + '</TD>';
                sCuerpo += '<TD>' + valores.parentesco + '</TD>';
                sCuerpo += '<TD><div class="input-group"><input class="form-control" style="width:45px" type="text" id="txtAA' + iFamiliares + '">';
                sCuerpo += '<span class="input-group-btn"><button type="button" class="btn btn-success btn-flat" onclick="CalcularAA(' + iFamiliares + ')">';
                sCuerpo += '<i class="fa fa-calculator"></i></button></span> </div></TD>';

                sCuerpo += '<TD><label id="lblCapital' + iFamiliares + '">0,00</label></TD>';
                sCuerpo += '<TD><label id="lblMonto' + iFamiliares + '">0,00</label></TD>';
                sCuerpo += '<TD><label id="lblMAct' + iFamiliares + '">0,00</label></TD>';
                 sCuerpo += '<TD><div class="input-group"><input class="form-control" style="width:45px" type="text" id="txtDist' + iFamiliares + '">';
                sCuerpo += '<span class="input-group-btn"><button type="button" class="btn btn-success btn-flat" onclick="CalcularDist(' + iFamiliares + ')">';
                sCuerpo += '<i class="fa fa-calculator"></i></button></span> </div></TD>';


                sCuerpo += '<TD><label id="lblMAct' + iFamiliares + '">0,00</label></TD>';
                //sCuerpo += '<TD>:-X</TD>';
                sCuerpo += '</TR>';
            });
            sTable += sCuerpo + '</TBODY>' + '</TABLE></center>';
            $("#tblFamiliares").html(sTable);
            $('#dbFamiliares').DataTable({
                "paging":   false,
                "ordering": false,
                "info":     false,
                "searching": false
                }
            );
            
        }

        ).done(function(msg) {}).fail(function(jqXHR, textStatus) {
            console.log(jqXHR);
        });
    }else{
        iFamiliares = 0;
        $("#tblFamiliares").html('');
    }


}

function CalcularAA(id){
    var calcCapital = $("#total_banco_calc").val();
    var calcDiferencia = $("#asignacion_diferencia_aux").val();
    
    var porcentaje = $("#txtAA" + id).val();

    var resultadoCapital = (calcCapital * porcentaje) / 100;
    var resultadoDiferencia = (calcDiferencia * porcentaje) / 100;
    
    alert(resultadoCapital);
    alert(resultadoDiferencia);


    $("#lblCapital" + id).text(parseFloat(resultadoCapital).toFixed(2));
    $("#lblMonto" + id).text(parseFloat(resultadoDiferencia).toFixed(2));
    
}

function consultarBeneficiarioFecha(){

    var val = $("#id").val();
    var fecha = $("#datepicker").val();
    var elem = fecha.split('/');
    dia = elem[0];
    mes = elem[1];
    ano = elem[2];
    var fech = ano + '-' + mes + '-' + dia;    
    ruta = sUrlP + "consultarBeneficiario/" + val  + "/" + fech;
    $.getJSON(ruta, function(data) {    
        $("#directiva").val(data.Componente.Grado.Directiva.nombre);    
        $("#asignacion_antiguedad").val(data.Calculo.asignacion_antiguedad);
        $("#anticipos").val(data.Calculo.anticipos);
        $("#embargos").val(data.Calculo.embargos);
        $("#asignacion_depositada").val(data.Calculo.asignacion_depositada);
        $("#monto_recuperar").val(data.Calculo.monto_recuperar);
        $("#asignacion_diferencia").val(data.Calculo.asignacion_diferencia);
        $("#asignacion_diferencia_aux").val(data.Calculo.asignacion_diferencia_aux);
        $("#comision_servicios").val(data.Calculo.comision_servicios);
        $("#total_banco").val(data.Calculo.saldo_disponible);
        $("#total_banco_calc").val(data.Calculo.saldo_disponible_aux);
        $("#total_banco_aux").val(data.Calculo.saldo_disponible_aux);
    }
    ).done(function(msg) {}).fail(function(jqXHR, textStatus) {
        console.log(jqXHR);
    });

}



function CalcularDeuda(){
    var totalBanco = $("#total_banco_aux").val();
    var deuda = $("#deuda").val();

    var resta = totalBanco - deuda;
    var resultado = parseFloat(resta).toFixed(2);
    $("#total_banco_calc").val(resultado);
    $("#total_banco").val(resultado);
}



function seleccionarPartida(){
    var val = $("#partida option:selected").val();
    ruta = sUrlP + "obtenerPartidaPresupuestaria/" + val;    
    $.getJSON(ruta, function(data) {    
        $("#proyecto").val(data.proyecto);
        $("#codigo_unidad_ejecutora").val(data.codigo_unidad_ejecutora);
    }

    ).done(function(msg) {}).fail(function(jqXHR, textStatus) {
        console.log(jqXHR);
    });
}

function imprimir(){
    var val = $("#id").val();
    URL = sUrlP + "hojavida/" + val;
    window.open(URL,"Hoja de Vida","toolbar=0,location=1,menubar=0,scrollbars=1,resizable=1,width=900,height=800")
}