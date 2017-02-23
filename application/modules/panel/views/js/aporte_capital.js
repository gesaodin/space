$('#reportearchivos').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false
    }
);
var _E = false; //Estatus
var _ID = 0; //Id de Instalacion
var _ZIP = ""; //Archivo comprimido
var _DATA = {};


function PrepararIndices(){
	
	var fde = "";
	var fha = "";
    var val = $("#directiva").val();
	verdad = true;
		
	fe = $("#datepicker").val(); //
	

    f = $("#datepicker1").val();
    fx = $("#datepicker2").val();
    if (f != ""){
    	verdad = false;    	
        f = f.split('/');
        fde = f[2] + '-' + f[1] + '-' + f[0];        
        if(fde != ""){        
            fx = fx.split('/');
            if(fx != ""){
                fha = fx[2] + '-' + fx[1] + '-' + fx[0];
            }else {
                $("#txtMensaje").html('Debe seleccionar una fecha limite');
				$("#logMensaje").modal('show');
				return false;
            }
        }else{ //En caso de que no exista fecha desde 
        	if ($('#datepicker1').val() == ""){
				$("#txtMensaje").html('Debe seleccionar una fecha');
				$("#logMensaje").modal('show');
				return false;
			}
	
        }
    }

	if ($('#directiva option:selected').val() == "0"){
		$("#txtMensaje").html('Debe seleccionar una directiva');
		$("#logMensaje").modal('show');
		return false;
	}
	
	
	if (fe == ""){
		$("#txtMensaje").html('Debe seleccionar una fecha');
		$("#logMensaje").modal('show');
		return false;
	}else{
    	fecha = fe.split('/');
    	fe = fecha[2] + '-' + fecha[1] + '-' + fecha[0];
    }



	_DATA = {
		id : val, 
		fe : fe,
		com: $('#componente option:selected').val(),
	    gra: $('#grado option:selected').val(),
	    fde: fde,
        fha: fha
	};
	boton = CrearBotones();
	$("#divContinuar").html(boton);
    $("#txtMensaje").html('Si ya antes ha generado los indices recientemente no se requiere de generarlos nuevamente. Esta seguro que desea generar los indices, recuerde este proceso puede tardar varios segundos. Por favor espere'); 
    $("#logMensaje").modal('show');
}

function ProcesarIndices(id){

	$("#logMensaje").modal('hide');
	$('#cargando').show();

	$.get(sUrlP + "PrepararIndices/" + id).done(function (data){
		$('#obse').val(data.m);
		$('#detalle').show();
		$('#cargando').hide();
		$('#generar').show();
		$('#preparar').hide();

		$("#datepicker").prop('disabled', true);
		$("#datepicker1").prop('disabled', true);
		$("#datepicker2").prop('disabled', true);
		$("#directiva").prop('disabled', true);
		$("#componente").prop('disabled', true);
		$("#grado").prop('disabled', true);
	});

}

function CrearBotones(){
	var boton = '<button id="btnContinuar" type="button" class="btn btn-success pull-right" onclick="ProcesarIndices(1)">';
    boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Si</button>';
    boton += '<button id="btnContinuar" type="button" class="btn btn-danger" onclick="ProcesarIndices(0)">';
    boton += '<i class="glyphicon glyphicon-remove"></i>&nbsp;&nbsp;No</button>';
    return boton;
}

function GenerarAporte(){


	var t = $('#reportearchivos').DataTable();
    t.clear().draw();
	$('#cargando').show();
	console.log (_DATA);
	url = sUrlP + "GenerarCalculoAporteCapital/";
	$.post(url, {data: JSON.stringify(_DATA)}, function (data){
		console.log(data);
		
		$('#obse').val(data.m);
		$('#generar').hide();
		$('#descargar').show();
		
		_ZIP = data.z;
		acc = 0;
		j = data.json;
		console.log(j.f + ' ' + j.l);
		
		t.row.add([
				acc,
				j.p + ' ' + j.f.substring(0,10) + '...',
				j.l,
				j.t,
				j.g + 'Bs.',
				j.d + 'Bs.'
			]
		).draw(false);
		
		$('#cargando').hide();
	});
		

}

function DescargarAportes(){
	location.href = sUrl + 'tmp/' + _ZIP;
}



function continuar(){
    $("#logMensaje").modal('hide');
}

function cargarGrado(){
    $("#grado").html('');
    $("#grado").append('<option value=99>Todos los grados</option>');

    id = $("#componente option:selected").val();    
    ruta = sUrlP + "cargarGradoComponente/" + id;

    $.getJSON(ruta, function(data) {    
        $.each(data, function(d, v){
            var opt = new Option(v.nombre, v.codigo);
            $("#grado").append(opt);
        });
    }).done(function(msg) {}).fail(function(jqXHR, textStatus) {
       $("#txtMensaje").html('No se encontro cédula de beneficiario');
       $("#logMensaje").modal('show');
       limpiar();
    });
}
