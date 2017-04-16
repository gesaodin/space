var t = $('#reportedirectiva').DataTable({
        "paging":   true,
        "ordering": false,
        "info":     false,
        "searching": true
    }
);


var editor; // use a global for the submit and return data rendering in the examples
 
$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax: "../php/staff.php",
        table: "#reportedirectiva",
        fields: [ {
                label: "ID:",
                name: "id"
            }, {
                label: "Unidad Tributaria:",
                name: "udad_tributaria"
            }, {
                label: "Descripcion:",
                name: "descripcion"
            }, {
                label: "Monto:",
                name: "monto"
            }, {
                label: "Año:",
                name: "anio"
            }
        ]
    } );


        // Activate an inline edit on click of a table cell
    $('#reportedirectiva').on( 'click', 'tbody td:not(:first-child)', function (e) {
    	alert(1);
        editor.inline( this );
    } );
 

} );









function ConsultarID(){

	var id = $("#directiva option:selected").val();
	var f_v = '';
	var f_i = '';
	ruta = sUrlP + "ListarEditarDirectiva/" + id;  

    t.clear().draw();
    
	$.getJSON(ruta, function (data){
		$.each(data, function (p,q){
			//console.log(q);
			f_v = q.f_vigencia;
			f_i = q.f_inicio;
			monto = Number(q.sueldo_base);
			t.row.add( [
                    q.id,
                    q.udad_tributaria,                    
                    q.descripcion,                    
                    monto.formatMoney(2, ',', '.'),
                    q.anio                  
                ] ).draw( false );
				
		});
		$("#datepicker1").val(cargarFecha(f_i));
		$("#datepicker2").val(cargarFecha(f_v));

	});

	 $('#reportedirectiva').on( 'click', 'tbody td:not(:first-child)', function (e) {
        editor.inline( this );
    } );
}

function cargarFecha(fecha){
    if(fecha != null){
      var f = fecha.split('-');
      return f[2] + '/' + f[1] + '/' + f[0];
    }
}
