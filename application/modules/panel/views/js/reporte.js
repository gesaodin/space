$('#reporte').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false
    }
);


function Consultar(){

	
    var t = $('#reporte').DataTable();

    var val = $("#id").val();
    ruta = sUrlP + "consultarBeneficiario/" + val;  

    t.clear().draw();

    $.getJSON(ruta, function(data) {
        var nombre = data.nombres + ' ' + data.apellidos;
        var componente = data.Componente.descripcion;
        var grado = data.Componente.Grado.nombre;
                
        var sBoton = '<div class="btn-group">';
        var sAcciones = '';
        if(data.estatus_activo == '201'){
            sBoton += '<button type="button" class="btn btn-warning" title="Paralizar" onclick="ventana(\'paralizar\')"><i class="fa fa-lock" ></i></button>';                                
            sBoton += '</button>';
        }else if(data.estatus_activo == '205'){
            sBoton += '<button type="button" class="btn btn-success" title="Desparalizar" onclick="ventana(\'activar\')"><i class="fa fa-unlock-alt" ></i></button>';                                
            sBoton += '</button>';
        }else{

        }
        sBoton += sAcciones + '</div>';        



        t.row.add( [
            sBoton,
            data.cedula,
            grado,
            componente,
            nombre,
            data.numero_cuenta,
            data.Calculo['asignacion_antiguedad'],
            data.fecha_ingreso,
            data.estatus_descripcion
        ] ).draw( false );
        ConsultarHistorialBeneficiario();

    }).done(function(msg) {}).fail(function(jqXHR, textStatus) {

        alert('Beneficiario no esta registrado');
    });
}

function ventana(fn){
    
    var boton = '<button type="button" class="btn btn-danger pull-right" onclick="continuar()">';
        boton += '<i class="glyphicon glyphicon-remove"></i>&nbsp;&nbsp;No&nbsp;&nbsp;</button>';
        boton += '<button type="button" class="btn btn-success" onclick="' + fn + '()">';
        boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Si&nbsp;&nbsp;</button>';
    $("#divContinuar").html(boton);
    $("#txtMensaje").html('Esta seguro que desea ' + fn + ' este beneficiario<br><br><input type="text" id="txtObservacion" class="form-control" placeholder="Observaciones"  >'); 
    $("#logMensaje").modal('show');
    
}

function continuar(){
    $("#logMensaje").modal('hide');
}

function activar(){
    var Paralizar = {};
    Paralizar['id'] = $("#id").val();
    Paralizar['motivo'] = $("#txtObservacion").val();
    Paralizar['estatus'] = '205';
    
    var boton = '<button type="button" class="btn btn-success pull-right" onclick="continuar()">';
        boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Continuar</button>';
    
    $("#divContinuar").html(boton);
    
    $.ajax({
              url: sUrlP + "paralizarDesparalizar",
              type: "POST",
              data: {'data' : JSON.stringify({
                Paralizar
              })},
              success: function (data) {  
               
                $("#txtMensaje").html(data);             
                $("#logMensaje").modal('show');
               
              },
              error: function(data){ 
               
                $("#txtMensaje").html(data); 
                $("#logMensaje").modal('show');
                 
              }
            });
    limpiar();
 
}

function desparalizar(){
    var Paralizar = {};
    Paralizar['id'] = $("#id").val();
    Paralizar['motivo'] = '';
    Paralizar['estatus'] = '201';
    
    var boton = '<button type="button" class="btn btn-success pull-right" onclick="continuar()">';
        boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Continuar</button>';
    
    $("#divContinuar").html(boton);
    
    $.ajax({
              url: sUrlP + "paralizarDesparalizar",
              type: "POST",
              data: {'data' : JSON.stringify({
                Paralizar
              })},
              success: function (data) {  
               
                $("#txtMensaje").html(data);             
                $("#logMensaje").modal('show');
               
              },
              error: function(data){ 
               
                $("#txtMensaje").html(data); 
                $("#logMensaje").modal('show');
                 
              }
            });
    limpiar();
 
}



function limpiar(){
    $("#id").val('');
    var t = $('#reporte').DataTable();
    t.clear().draw();
    


}