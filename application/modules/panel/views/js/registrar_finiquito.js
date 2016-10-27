/**
* Fallecimiento en acto de servicio o Fuera
*/
var iFamiliares = 0;
var fallecimiento_actoservicio = 0; //Acto de Servicio
var fallecimiento_fueraservicio = 0; //Fuera de Servicio

$('#reporteFiniquitos').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false
        }
    );

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

    iFamiliares = 0;
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

        fallecimiento_actoservicio = data.Calculo.fallecimiento_actoservicio_aux;
        fallecimiento_fueraservicio = data.Calculo.fallecimiento_fueraservicio_aux;
    }).done(function(msg) {}).fail(function(jqXHR, textStatus) {
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
        $("#monto_asignacion").val(fallecimiento_actoservicio);
        if(motivo == 9 ) $("#monto_asignacion").val(fallecimiento_fueraservicio);

        $("#divMontoAsignacion").show();
        var val = $("#id").val();
        ruta = sUrlP + "obtenerFamiliares/" + val;    
        $.getJSON(ruta, function(data) {    
            sBoton = '<center><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-user-plus"></i> Agregar Familiar</button>';
            sTable = sBoton + '<br>';
            sTable += '<TABLE id="dbFamiliares" class="display compact table table-striped table-bordered" width="100%" cellspacing="0">';
            sTable += '<THEAD><TR>';
            sTable += '<TH>#</TH>';
            sTable += '<TH>Cedula</TH>';
            sTable += '<TH>Nombre</TH>';
            sTable += '<TH>Parentesco</TH>';
            sTable += '<TH>DIST. C.B</TH>';
            sTable += '<TH>Capital Banco</TH>';
            sTable += '<TH>Monto Dif. A.A.</TH>';
            sTable += '<TH>DIST. M.</TH>';
            sTable += '<TH>M. Act. Serv.</TH>';
            //sTable += '<TH>Dist.C.M</TH>';
            sTable += '<TH>C.M</TH>';
            //sTable += '<TH>OPCIONES</TH>';
            sTable += '</TR></THEAD>';
            sCuerpo = '<TBODY>';
            $.each(data, function ( clv, valores ){
                iFamiliares++;
                sCuerpo += '<TR>';
                sCuerpo += '<TH><label id="lblPosicion' + iFamiliares + '">' + iFamiliares + '</label></TH>';
                sCuerpo += '<TH><label id="lblCedula' + iFamiliares + '">' + valores.cedula + '</label></TH>';
                sCuerpo += '<TD><label id="lblNombre' + iFamiliares + '">' + valores.nombre + '</label></TD>';
                sCuerpo += '<TD><label id="lblParentesco' + iFamiliares + '">' + valores.parentesco + '</label></TD>';
                //Input
                sCuerpo += '<TD><div class="input-group"><input class="form-control" style="width:50px" type="text" id="txtAA' + iFamiliares + '">';
                sCuerpo += '<span class="input-group-btn"><button type="button" class="btn btn-success btn-flat" onclick="CalcularAA(' + iFamiliares + ')">';
                sCuerpo += '<i class="fa fa-calculator"></i></button></span> </div></TD>';
                //
                sCuerpo += '<TD style="text-align: right"><label id="lblCapital_aux' + iFamiliares + '">0.00</label><label style="display:none" id="lblCapital' + iFamiliares + '">0.00</label></TD>';
                //Input
                
                sCuerpo += '<TD style="text-align: right"><label id="lblMonto_aux' + iFamiliares + '">0.00</label><label style="display:none" id="lblMonto' + iFamiliares + '">0.00</label></TD>';
                //Input
                sCuerpo += '<TD><div class="input-group"><input class="form-control" style="width:50px" type="text" id="txtM' + iFamiliares + '">';
                sCuerpo += '<span class="input-group-btn"><button type="button" class="btn btn-success btn-flat" onclick="CalcularM(' + iFamiliares + ')">';
                sCuerpo += '<i class="fa fa-calculator"></i></button></span> </div></TD>';

                sCuerpo += '<TD style="text-align: right"><label id="lblMAct_aux' + iFamiliares + '">0.00</label><label style="display:none" id="lblMAct' + iFamiliares + '">0.00</label></TD>';
                //Input
                /**
                sCuerpo += '<TD><div class="input-group"><input class="form-control" style="width:50px" type="text" id="txtDist' + iFamiliares + '">';
                sCuerpo += '<span class="input-group-btn"><button type="button" class="btn btn-success btn-flat" onclick="CalcularDist(' + iFamiliares + ')">';
                sCuerpo += '<i class="fa fa-calculator"></i></button></span> </div></TD>';
                **/
                //
                sCuerpo += '<TD style="text-align: right"><label id="lblCm_aux' + iFamiliares + '">0.00</label><label style="display:none"  id="lblCm' + iFamiliares + '">0.00</label></TD>';
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

    var suma = 0;
    var calcCapital = parseFloat($("#total_banco_calc").val());
    var calcDiferencia = parseFloat($("#asignacion_diferencia_aux").val()); 
    var calcMontoCM = parseFloat($("#asignacion_causa_aux").val()); 
    
    for (var i = 1; i <= iFamiliares; i++) {
        if($("#txtAA" + i).val() != ""){
            var por = parseFloat($("#txtAA" + i).val());      
            suma += por;    
        }
    }

    if(suma <= 100){
        var porcentaje = Number($("#txtAA" + id).val());
        var resultadoCapital = (calcCapital * porcentaje) / 100;
        var resultadoDiferencia = (calcDiferencia * porcentaje) / 100;
        var resultadoMontoAsignacion = (Number(calcMontoCM) * Number(porcentaje)) / 100;

        //------------
        numero = resultadoCapital;
        $("#lblCapital_aux" + id).text(numero.formatMoney(2, ',', '.'));
        $("#lblCapital" + id).text(parseFloat(resultadoCapital).toFixed(2));

        //------------
        numero = resultadoDiferencia;
        $("#lblMonto_aux" + id).text(numero.formatMoney(2, ',', '.'));
        $("#lblMonto" + id).text(parseFloat(resultadoDiferencia).toFixed(2));

        
        //------------
        numero = resultadoMontoAsignacion;
        $("#lblCm_aux" + id).text(numero.formatMoney(2, ',', '.'));
        $("#lblCm" + id).text(parseFloat(resultadoMontoAsignacion).toFixed(2));   

    }else{
        alert('Distribución del porcentaje no puede ser mayor al 100%');
    }
        
}






function CalcularM(id){
    var suma = 0;
    var calcMontoAsignacion = parseFloat($("#monto_asignacion").val());        
    for (var i = 1; i <= iFamiliares; i++) {
        if($("#txtM" + i).val() != ""){
            var por = parseFloat($("#txtM" + i).val());      
            suma += por;    
        }
    }
    if(suma <= 100){
        var porcentaje = $("#txtM" + id).val();
        var resultadoMontoAsignacion = (calcMontoAsignacion * porcentaje) / 100;
        //------------
        numero = resultadoMontoAsignacion;
        $("#lblMAct_aux" + id).text(numero.formatMoney(2, ',', '.'));
        $("#lblMAct" + id).text(parseFloat(resultadoMontoAsignacion).toFixed(2));    
    }else{
        alert('Distribución del porcentaje no puede ser mayor al 100%');
    }
        
}

/**
function CalcularDist(id){
    var suma = 0;
    var calcMontoAsignacion = parseFloat($("#asignacion_causa_aux").val());  
    for (var i = 1; i <= iFamiliares; i++) {
        if($("#txtDist" + i).val() != ""){
            var por = parseFloat($("#txtDist" + i).val());      
            suma += por;    
        }
    }
    if(suma <= 100){
        var porcentaje = $("#txtDist" + id).val();
        var resultadoMontoAsignacion = (Number(calcMontoAsignacion) * Number(porcentaje)) / 100;
        //------------
        numero = resultadoMontoAsignacion;
        $("#lblCm_aux" + id).text(numero.formatMoney(2, ',', '.'));
        $("#lblCm" + id).text(parseFloat(resultadoMontoAsignacion).toFixed(2));    
    }else{
        alert('Distribución del porcentaje no puede ser mayor al 100%');
    }
}
**/








function registrarFamiliar(){
    var t = $('#dbFamiliares').DataTable();
    var cedula = $('#fcedula').val();
    var nombre = $('#fnombres').val();
    var parentesco = $('#fparentesco').val();

    iFamiliares++;

    sCajaAA = '<div class="input-group"><input class="form-control" style="width:50px" type="text" id="txtAA' + iFamiliares + '">';
    sCajaAA += '<span class="input-group-btn"><button type="button" class="btn btn-success btn-flat" onclick="CalcularAA(' + iFamiliares + ')">';
    sCajaAA += '<i class="fa fa-calculator"></i></button></span> </div>';


    sDistM = '<div class="input-group"><input class="form-control" style="width:50px" type="text" id="txtM' + iFamiliares + '">';
    sDistM += '<span class="input-group-btn"><button type="button" class="btn btn-success btn-flat" onclick="CalcularM(' + iFamiliares + ')">';
    sDistM += '<i class="fa fa-calculator"></i></button></span> </div>';


    sDist = '<div class="input-group"><input class="form-control" style="width:50px" type="text" id="txtDist' + iFamiliares + '">';
    sDist += '<span class="input-group-btn"><button type="button" class="btn btn-success btn-flat" onclick="CalcularDist(' + iFamiliares + ')">';
    sDist += '<i class="fa fa-calculator"></i></button></span> </div>';


    t.row.add( [
            '<label id="lblPosicion' + iFamiliares + '">' + iFamiliares + '</label>',
            '<label id="lblCedula' + iFamiliares + '">' + cedula + '</label>',
            '<label id="lblNombre' + iFamiliares + '">' + nombre + '</label>',
            '<label id="lblParentesco' + iFamiliares + '">' + parentesco + '</label>',
            sCajaAA,
            '<p style="text-align:right"><label id="lblCapital_aux' + iFamiliares + '">0.00</label><label style="display:none" id="lblCapital' + iFamiliares + '">0.00</label></p>',
            '<p style="text-align:right"><label id="lblMonto_aux' + iFamiliares + '">0.00</label><label style="display:none" id="lblMonto' + iFamiliares + '">0.00</label></p>',
            //sDistM,
            '<p style="text-align:right"><label id="lblMAct_aux' + iFamiliares + '">0.00</label><label style="display:none" id="lblMAct' + iFamiliares + '">0.00</label></p>',
            sDist,
            '<label id="lblCm' + iFamiliares + '">0.00</label>'

        ] ).draw( false );
         
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
        $("#monto_recuperar_aux").val(data.Calculo.monto_recuperar_aux);

        fallecimiento_actoservicio = data.Calculo.fallecimiento_actoservicio_aux;
        fallecimiento_fueraservicio = data.Calculo.fallecimiento_fueraservicio_aux;
        CalcularDeuda();
    }
    ).done(function(msg) {}).fail(function(jqXHR, textStatus) {
        console.log(jqXHR);
    });

}



function CalcularDeuda(){
    var totalBanco = Number($("#total_banco_aux").val());
    var intereses = Number($("#intereses").val());
    var deuda = Number($("#deuda").val());
    
    if(intereses != ''){
        var resta = totalBanco - deuda + intereses;
        var resultado = parseFloat(resta).toFixed(2);
        $("#total_banco_calc").val(resultado);
        numero = resta;
        $("#total_banco").val(numero.formatMoney(2, ',', '.'));
        
    }else{
        var resta = totalBanco - deuda;
        var resultado = parseFloat(resta).toFixed(2);
        $("#total_banco_calc").val(resultado);
        numero = resta;
        $("#total_banco").val(numero.formatMoney(2, ',', '.'));
    }   
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


function cargarPersona(){
    var val = $("#fcedula").val();
    ruta = sUrlP + "cargarPersona/" + val;    
    $.getJSON(ruta, function(data) {
        $("#fnombres").val(data.nombre);
        $("#fparentesco").val(data.parentesco);
    }

    ).done(function(msg) {}).fail(function(jqXHR, textStatus) {
        console.log(jqXHR);
    });
}


function consultarFiniquitos(){
   var t = $('#reporteFiniquitos').DataTable();

    var val = $("#cedulaB").val();
    ruta = sUrlP + "consultarFiniquitos/" + val;  

    t.clear().draw();

    $.getJSON(ruta, function(data) {
        var cedula = data.cedula;
        var nombre = data.nombres + ' ' + data.apellidos;
        var componente = data.Componente.descripcion;
        var grado = data.Componente.Grado.nombre;
        var tiempo_servicio = data.tiempo_servicio;
        
        var arr = data.HistorialDetalleMovimiento;
        
        if(Array.isArray(arr) == false){
            
            $.each(arr[9], function ( clv, valores ){
                var fecha_creacion = valores.fecha_creacion;
                var fecha_contable = valores.fecha_contable;
                var monto = valores.monto;
                var observaciones = valores.observacion;
                var estatus = valores.tipo_texto;
                var sBoton = '<div class="btn-group">';
                
                if(estatus != 'Reverso') sBoton += '<button type="button" class="btn btn-danger" title="Reversar"><i class="fa fa-random"></i></button>';
                sBoton += '<button type="button" class="btn btn-info" title="Imprimir"><i class="fa fa-print" ></i></button>';                
                sBoton += '<button aria-expanded="false" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">';
                sBoton += '<span class="caret"></span>';
                sBoton += '<span class="sr-only">Toggle Dropdown</span>';
                sBoton += '</button>';                
                sAcciones = '<ul class="dropdown-menu" role="menu">';
                sAcciones += '<li><a href="#!" target="_top" onclick="HojaVida(\'' + cedula + '\')">Hoja de Vida (PRINT)</a></li>';
                sAcciones += '<li><a href="#!" target="_top" onclick="CartaBanco(\'' + cedula + '\')">Carta Banco</a></li>';
                sAcciones += '<li><a href="#!" target="_top" onclick="OrdenPago(\'' + cedula + '\')">Orden de Pago</a></li>';
                
                    
                sAcciones +='<li class="divider"></li>';
                sAcciones += '<li><a href="#!" target="_top" onclick="CapitalBanco(\'' + cedula + '\')">Capital en Banco</a></li>';
                sAcciones += '<li><a href="#!" target="_top" onclick="DiferenciaAntiguedad(\'' + cedula + '\')">Diferencia de Antiguedad</a></li>';
                sAcciones += '<li><a href="#!" target="_top" onclick="Indemnizacion(\'' + cedula + '\')">Indemnización AS/FS</a></li>';
                sAcciones += '<li><a href="#!" target="_top" onclick="CausaMuerte(\'' + cedula + '\')">Causa Muerte</a></li>';


                sAcciones += '</ul>';

                


                sBoton += sAcciones;
                // 
                sBoton += '</div>';
                $("#lblCedula").text(cedula);
                $("#lblBeneficiario").text(nombre);
                t.row.add( [
                    sBoton,
                    fecha_creacion,
                    //cedula,
                    //nombre,
                    componente,
                    grado,
                    tiempo_servicio,
                    monto,
                    fecha_contable,
                    observaciones,
                    estatus
                ] ).draw( false );
                
            });

        }else{
            alert('Beneficiario no posee finiquito');
        }
    }

    ).done(function(msg) {}).fail(function(jqXHR, textStatus) {
        alert('Beneficiario no esta registrado');
    });


}

function abrirModal(){
    $("#ModalImprimir").modal('show');
}

function HojaVida(id){    
    URL = sUrlP + "hojavida/" + id;
    window.open(URL,"Hoja de Vida","toolbar=0,location=1,menubar=0,scrollbars=1,resizable=1,width=900,height=800")
}

function CartaBanco(id){    
    URL = sUrlP + "cartaBanco/" + id;
    window.open(URL,"Carta Banco","toolbar=0,location=1,menubar=0,scrollbars=1,resizable=1,width=900,height=800")
}



function GuargarFiniquito(){ 

    ruta = sUrlP + "guardarFiniquito";
    i_d = $("#id").val(); //
    m_d = $("#deuda").val(); //Monto Por Deuda
    a_i = $("#intereses").val(); //Ajuste PorInteres
    t_b = $("#total_banco").val(); //Total en Banco
    t_bx = $("#total_banco_calc").val(); //Total en Banco
    a_a = $("#asignacion_diferencia").val(); //Diferencia Asignación Antiguedad
    a_ax = $("#asignacion_diferencia_aux").val(); //Diferencia Asignación Antiguedad
    p_p = $("#partida option:selected").val(); //Partida Presupuestaria
    m_f = $("#motivo_finiquito option:selected").val(); //Motivo de Finiquito
    m_ft = $("#motivo_finiquito option:selected").text(); //motivo_finiquito

    o_b = $("#o_b").val(); //Observaciones
    f_r = $("#datepicker").val(); //Fecha Retiro
    
    m_r = $("#monto_recuperar").val(); //Monto a Recuperar
    m_rx = $("#monto_recuperar_aux").val(); //Monto a Recuperar
    
    $.ajax({
      type: "POST",
      //contentType: "application/json",
      //dataType: "json",
      data: {'data' : JSON.stringify({
        i_d: i_d, //Cedula de Identidad
        t_b: t_b, //9 Formato Moneda
        t_bx: t_bx, //9 Fomato Cientifico
        a_i: a_i, //10
        a_a: a_a, //14 Formato Moneda       
        a_ax: a_ax, //14 Fomato Cientifico
        m_d: m_d, //15
        m_r: m_r, //16
        m_rx: m_rx, //16 Fomato Cientifico
        o_b: o_b,
        f_r: f_r,
        p_p: p_p,
        m_f: m_f,
        m_ft: m_ft        
      })},
      url: ruta,
      success: function (data) {  
        console.log(data);      
        alert(data);
      },
      error: function(){
        alert(2);
      }
    });



}