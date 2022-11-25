function cargar_objetivos(revision){
    $("#objetivos").html("");
    $.ajax({
        url: "../querys/agregar_objetivos.php?funcion=buscar_objetivos",
        type: "POST",
        data: {"revision":revision},
        beforeSend: function () {
            console.log("Cargando Objetivos, espere por favor...");
        },
        success: function (response) {
            console.log(response);
            $("#objetivos").html(response);
            var id_usuario = $("#id_usuario").val();
            if (id_usuario != "" || id_usuario != 0) {
                cargar_objetivos_acciones(id_usuario,revision);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
    });
}
function cargar_estrategias(id_objetivo){
    $("#estrategias").html("");
    $.ajax({
        url: "../querys/agregar_objetivos.php?funcion=buscar_estrategias",
        type: "POST",
        data: {"id_objetivo":id_objetivo},
        beforeSend: function () {
            console.log("Cargando Estrategias, espere por favor...");
        },
        success: function (response) {
            console.log(response);
            $("#estrategias").html(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
    });
}
function guardar_objetivo() {  
    var frmData = new FormData($("#guardar_objetivos")[0]);
    $.ajax({
        url: "querys/agregar_objetivos.php?funcion=guardar_objetivo",
        type: "POST",
        data: frmData,
        contentType: false,
        processData:false,
        beforeSend: function () {
            console.log("Guardando Objetivo, espere por favor...");
        },
        success: function (response) {
            console.log(response);
            if (response != 0) {
                alert("Objetivo guardado");
                var id_usuario = $("#id_usuario").val();
                var revision = $("#revision").val();
                if (id_usuario != "" || id_usuario != 0) {
                    cargar_objetivos_acciones(id_usuario,revision);
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
function cargar_objetivos_acciones(empleado,revision) {  
    $("#obj_accion").html("");
    $.ajax({
        url: "../querys/agregar_objetivos.php?funcion=buscar_objetivos_acciones",
        type: "POST",
        data: {"revision":revision,"empleado":empleado},
        beforeSend: function () {
            console.log("Cargando Objetivos y Acciones, espere por favor...");
        },
        success: function (response) {
            console.log(response);
            $("#obj_accion").html(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
    });
}
function guardar_acciones() {  
    var frmData = new FormData($("#guardar_objetivos")[0]);
    $.ajax({
        url: "querys/agregar_objetivos.php?funcion=guardar_acciones",
        type: "POST",
        data: frmData,
        contentType: false,
        processData:false,
        beforeSend: function () {
            console.log("Guardando Acciones, espere por favor...");
        },
        success: function (response) {
            console.log(response);
            alert("acciones guardadas");
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}
// $(document).ready(function() {  
    
// });
$("#btn_guardar").click(function() {  
    guardar_objetivo();
});