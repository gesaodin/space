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
                
        t.row.add( [
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
