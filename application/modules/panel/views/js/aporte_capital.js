$('#reporte').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false
    }
);
var _E = false; //Estatus
var _ID = 0; //Id de Instalacion
var _ZIP = ""; //Archivo comprimido


function PrepararIndices(){
	
	if ($('#datepicker1').val() == ""){
		$("#txtMensaje").html('Debe seleccionar una fecha');
		$("#logMensaje").modal('show');
		return false;
	}
	if ($('#directiva option:selected').val() == "0"){
		$("#txtMensaje").html('Debe seleccionar una directiva');
		$("#logMensaje").modal('show');
		return false;
	}

	$('#cargando').show();
	$.get(sUrlP + "PrepararIndices/").done(function (data){
		
		$('#obse').val(data.m);
		$('#detalle').show();
		$('#cargando').hide();
		$('#generar').show();
		$('#preparar').hide();
		$("#datepicker1").prop('disabled', true);
		$("#directiva").prop('disabled', true);
	});

}

function GenerarAporte(){
	id = Number($('#directiva option:selected').val());
	fe = $('#datepicker1').val();
	f  = fe.split("/");
	$('#cargando').show();
	if (id != 0){
		data = {
			id : id, 
			fe : f[2] + '-' + f[1] + '-' + f[0]
		};
		url = sUrlP + "GenerarCalculoAporteCapital/";
		$.post(url, data, function (data){
			
			$('#obse').val(data.m);
			$('#generar').hide();
			$('#descargar').show();
			$('#cargando').hide();
			_ZIP = data.z;
		}).done(function (data){

		});
	}
}

function DescargarAportes(){
	location.href = sUrl + 'tmp/' + _ZIP;
}

function continuar(){
    $("#logMensaje").modal('hide');
}