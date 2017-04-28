$(document).ready(function(){       
    // Funcion para colocar el datepicker a las fechas
function init(){
   //console.log($("#show_form_emergente .DepartamentoSelect"));
   
    $("#show_form_emergente .DepartamentoSelect").attr('disabled',true);
    $("#show_form_emergente .CiudadSelect").attr('disabled',true);
    // Cuando se selecciona el departamento cambia la ciudad
    $("#show_form_emergente .DepartamentoSelect").change(function(){
        // Partiendo del elemento actual obtengo el form al que petenecen
        form = $(this).parent().parent().parent();
        var idDepartamento=0;
        objMsjCarga.dialog('open');
        if($(form).find("select.DepartamentoSelect").val() !== null){
            idDepartamento = $(form).find("select.DepartamentoSelect").val();
        }
        var idCiudad=0;
        if($(form).find("select.CiudadSelect").val() !== null){
            idCiudad = $(form).find("select.CiudadSelect").val();
        }
        $.ajax({
            url: Routing.generate('sisciudad_findByIdDepartamento', { iddepartamento: idDepartamento,idciudad: idCiudad }),
            data: $(form).find("select.DepartamentoSelect").val(),
            type: "post",
            success: function(json) {                    
                //  $( "#show_form" ).html(json); 
                //console.log(json);
                // alert($(".PaisSelect").val());
                $(form).find("select.CiudadSelect").attr('disabled',false);
                $(form).find("select.CiudadSelect").html(json);

                 // init();
                 objMsjCarga.dialog('close');
            },
            error:function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });   
       // function(){alert($(".PaisSelect").val());}
    });

    $("#show_form_emergente .PaisSelect").change(function(){
        // Partiendo del elemento actual obtengo el form al que petenecen
        form = $(this).parent().parent().parent();
        //console.log($(form).find("select.DepartamentoSelect"));
        var idDepartamento=0;
        objMsjCarga.dialog('open');
        if($(form).find("select.DepartamentoSelect").val() !== null){
            idDepartamento = $(form).find("select.DepartamentoSelect").val();
        }
        $.ajax({
            url: Routing.generate('sisdepartamento_findByIdPais', { idpais: $(form).find("select.PaisSelect").val(),iddepartamento: idDepartamento }),
            data: $(form).find("select.PaisSelect").val(),
            type: "post",
            success: function(json) {                    
                //  $( "#show_form" ).html(json); 
                //console.log(json);
                // alert($(".PaisSelect").val());
                $(form).find("select.DepartamentoSelect").attr('disabled',false);
                $(form).find("select.DepartamentoSelect").html(json);
                //console.log($(".DepartamentoSelect").val());
                $(form).find("select.DepartamentoSelect").trigger('change');
                 // init();
                 objMsjCarga.dialog('close');
            },
            error:function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });   
       // function(){alert($(".PaisSelect").val());}
    });
       
}
    init();
});