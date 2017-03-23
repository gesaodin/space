


_INTERFAZ = '';
_PRV = {};
_PRIVILEGIO = {};

 $(function () {

 	cargarMenu();
 	var t = $('#reporteUPP').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false
    });    
    t.clear().draw();
 });



function actualizarClave(){

    var val = $("#clave").val();

    if(val != ''){
	    ruta = sUrlP + "actualizarClave/" + val;
	    $.get(ruta, function(data) {
	        var boton = '<button type="button" class="btn btn-success pull-right" onclick="principal()">';
	            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Ok</button>';
	        $("#divContinuar").html(boton);
	        $("#txtMensaje").html(data); 
	        $("#logMensaje").modal('show');
	        $("#controles").hide();
	        $("#clave").val('');

	    }).done(function(msg) {}).fail(function(jqXHR, textStatus) {
	        
	    });

    }
}


function cUsers(){
	
	var url = sUrlP + 'obtenerMHijos/' + $("#cmbUsuarios option:selected").val();
	$("#cmbMenu").html('');
	$.post(url).done(function (data){

		$.each(data, function (x,y){		
			$("#cmbMenu").append('<optgroup label="' + x + '">');

            $.each(y, function(c, v){ 
				$("#cmbMenu").append('<option value="' + v.oid + '">' + v.desc + '</option>');
			});    
            
		});

	});

}

function cargarMenu(){
	var url = sUrlP + 'listarMenu';
	
	$("#menu").html('<option value=0>Seleccionar...</option>');	
	$.post(url).done(function (data){
		$.each(data, function (x,y){			
			$("#menu").append('<option value="' + y.oid + '">' + y.nomb + '</option>');            
		});

	});	
}

function cargarSubMenu(){
	var url = sUrlP + 'listarSubMenu/' + $("#menu option:selected").val();
	$("#submenu").html('<option value=0>Seleccionar...</option>');
	$.post(url).done(function (data){

		$.each(data, function (x,y){
			$("#submenu").append('<option value="' + y.oid + '|' + y.url + '">' + y.obse + '</option>');            
		});
	});	
}


/**
* Perfil
*
*/
function cargarPerfil(){
	var id = $("#submenu option:selected").val();
	var u = id.split("|");
	var url = sUrlP + 'listarPerfilPrivilegios/' + u[1];
	
	$("#perfil").html('<option value=0>Seleccionar...</option>');
	$("#privilegio").html('<option value=0>Seleccionar...</option>');
	$.post(url).done(function (data){
		_PRIVILEGIO = data;
		$.each(data, function (x,y){
			$("#perfil").append('<option value="' +  y[0].oidp + '">' + x + '</option>');            
		});
	});	

}

/**
*	Privilegio	
*
*/
function cargarPrivilegios(){

	//$("#privilegio").html('<option value=0>Seleccionar...</option>');
	$.each(_PRIVILEGIO, function (x,y){
		$.each(y, function(p, q){
			//$("#privilegio").append('<option value="' + q.cod + '">' + q.nomb + '</option>');
			activar(q.cod, q.nomb);
		});
		

	});
}

function removerMenu(){
	var id = $("#cmbMenu option:selected").val();
	var uid = $("#cmbUsuarios option:selected").val();

	var texto = $("#cmbMenu option:selected").text();
	var boton = '<button type="button" class="btn btn-danger pull-right" onclick="continuar()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;No</button>';
            boton += '<button type="button" class="btn btn-success" onclick="desactivar(' + uid +  ',' + id +  ')">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Si</button>';
    var msj = '¿Está seguro que desea desactivar ' + texto + '?';
    $("#divContinuar").html(boton);
    $("#txtMensaje").html(msj);
    $("#logMensaje").modal('show');
}

function desactivar(uid, idm){
	alert(uid + ' ->  ' + idm);
}

function agregarMenu(){
	var uid = $("#cmbUsuarios option:selected").val();
	var idm = $("#menu option:selected").val();
	var ids = $("#submenu option:selected").val();
	var idp = $("#perfil option:selected").val();
	var idpr = $("#privilegio option:selected").val();

	var texto = $("#submenu option:selected").text();
	var boton = '<button type="button" class="btn btn-danger pull-right" onclick="continuar()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;No</button>';
            boton += '<button type="button" class="btn btn-success" onclick="activar()">';
            boton += '<i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;Si</button>';
    var msj = '¿Está seguro que desea activar ' + texto + '?';
    $("#divContinuar").html(boton);
    $("#txtMensaje").html(msj);
    $("#logMensaje").modal('show');
}

function continuar(){
    $("#logMensaje").modal('hide');
}

function activar(idpr, idprt){
	
   	t = $('#reporteUPP').DataTable();
    var uid = $("#cmbUsuarios option:selected").val();
	var idm = $("#menu option:selected").val();
	var ids = $("#submenu option:selected").val();
	var idst = $("#submenu option:selected").text();
	var idp = $("#perfil option:selected").val();
	var idpt = $("#perfil option:selected").text();
	//var idpr = $("#privilegio option:selected").val();
	//var idprt = $("#privilegio option:selected").text();
	var s = ids.split("|");
    

   
    
   
    t.row.add( [
       '<input type="checkbox">',
       //idst,
       //idpt,
       idprt,
       uid, //ID
       idm,
       s[0],
       idp,
       idpr
    ] ).draw( false );

    t.column(2).visible(false);
    t.column(3).visible(false);
    t.column(4).visible(false);
    t.column(5).visible(false);
    t.column(6).visible(false);
   
   	check();
    continuar();

}

/**
 $("#menu option:selected").text(),
        $("#submenu option:selected").text(),
        $("#perfil option:selected").text(),
        $("#privilegio option:selected").text(),
        $("#cmbUsuarios option:selected").val(),
        $("#menu option:selected").val(),
        $("#submenu option:selected").val(),
        $("#perfil option:selected").val(),
        $("#privilegio option:selected").val()

        **/