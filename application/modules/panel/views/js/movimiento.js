/**
* Reporte de Movimientos
*/

$('#reporteAnticipo').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false
    }
);


function cargarFechaSlash(fecha){
    var f = fecha.split('/');
    return f[2] + '-' + f[1] + '-' + f[0];
}


function consultar(){
	var ruta = sUrlP + "lstAnticipoFecha";
	var desde = cargarFechaSlash($("#datepicker").val());
	var hasta = cargarFechaSlash($("#datepicker1").val());
	var componente = $("#componente option:selected").val();

	$.ajax({
          type: "POST",
          //contentType: "application/json",
          //dataType: "json",
          data: {'data' : JSON.stringify({
            desde: desde, //Cedula de Identidad
            hasta: hasta, //5 Formato Moneda
            componente: componente, //9 Formato Moneda   
          })},
          url: ruta,
          success: function (data) {  
            
            $("#txtMensaje").html('Consulta Efectuada'); 

            var boton = '<button type="button" class="btn btn-success pull-right" onclick="continuarMovimiento()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Continuar</button>';
            $("#divContinuar").html(boton);
            $("#logMensaje").modal('show');


          },
          error: function(data){
            $("#txtMensaje").html(data); 
            var boton = '<button type="button" class="btn btn-success pull-right" onclick="continuarMovimiento()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Continuar</button>';
            $("#divContinuar").html(boton);

            $("#txtMensaje").html('Err. al procesar el finiquito'); 
            $("#logMensaje").modal('show');

          }
        });

}

function continuarMovimiento(){
	$("#logMensaje").modal('hide');
}
