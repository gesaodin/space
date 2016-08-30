function consultar() {
    var val = $("#id").val();
    ruta = sUrlP + "consultarBeneficiario/" + val;
    $.getJSON(ruta, function(data) {
            //console.log(data.Componente.Grado);
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
            $("#sueldo_base").val(data.sueldo_base);
            $("#sueldo_global").val(data.sueldo_global);
            $("#sueldo_integral").val(data.sueldo_integral);

            //console.log(data.historial_sueldo);
            /**
            .each(data.historial_sueldo, function(key, val) {

            }
            **/

        }

    ).done(function(msg) {}).fail(function(jqXHR, textStatus) {
        console.log(jqXHR);
    });

}