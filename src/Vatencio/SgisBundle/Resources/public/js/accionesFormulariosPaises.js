$(document).ready(function(){       
    // Funcion para colocar el datepicker a las fechas
function init(){
    // Desahabilito el campo rht_rhtonlinebundle_sgucargopersonatype_persona, para que lo puedan cambiar
    $("#rht_rhtonlinebundle_sgucargopersonatype_persona").attr('disabled',true);
    // $( "#rht_rhtonlinebundle_sgupersonatype_fechaNacimiento" ).datepicker();
    //console.log($(".PaisSelect"));
       
    $(".DepartamentoSelect").attr('disabled',true);
    $(".CiudadSelect").attr('disabled',true);
    // Cuando se selecciona el departamento cambia la ciudad
    //console.log($(".DepartamentoSelect.boton_nuevo"));
    $(".DepartamentoSelect.boton_nuevo").change(function(){
        // Partiendo del elemento actual obtengo el form al que petenecen
        form = $(this).parent().parent().parent();
        var idDepartamento=0;
        objMsjCarga.dialog('open');
        if($(form).find("select.DepartamentoSelect.boton_nuevo").val() !== null){
            idDepartamento = $(form).find("select.DepartamentoSelect.boton_nuevo").val();
        }
        var idCiudad=0;
        if($(form).find("select.CiudadSelect.boton_nuevo").val() !== null){
            idCiudad = $(form).find("select.CiudadSelect.boton_nuevo").val();
        }
        $.ajax({
            url: Routing.generate('sisciudad_findByIdDepartamento', { iddepartamento: idDepartamento,idciudad: idCiudad }),
            data: $(form).find("select.DepartamentoSelect.boton_nuevo").val(),
            type: "post",
            success: function(json) {                    
                //  $( "#show_form" ).html(json); 
                //console.log(json);
                // alert($(".PaisSelect").val());
                $(form).find("select.CiudadSelect.boton_nuevo").attr('disabled',false);
                $(form).find("select.CiudadSelect.boton_nuevo").html(json);

                 // init();
                 objMsjCarga.dialog('close');
            },
            error:function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });   
       // function(){alert($(".PaisSelect").val());}
    });
      
    $(".PaisSelect.boton_nuevo").change(function(){
        // Partiendo del elemento actual obtengo el form al que petenecen
        form = $(this).parent().parent().parent();
        //console.log($(form).find("select.DepartamentoSelect"));
        var idDepartamento=0;
        objMsjCarga.dialog('open');
        if($(form).find("select.DepartamentoSelect.boton_nuevo").val() !== null){
            idDepartamento = $(form).find("select.DepartamentoSelect.boton_nuevo").val();
        }
        $.ajax({
            url: Routing.generate('sisdepartamento_findByIdPais', { idpais: $(form).find("select.PaisSelect.boton_nuevo").val(),iddepartamento: idDepartamento }),
            data: $(form).find("select.PaisSelect.boton_nuevo").val(),
            type: "post",
            success: function(json) {                    
                //  $( "#show_form" ).html(json); 
                //console.log(json);
                // alert($(".PaisSelect").val());
                $(form).find("select.DepartamentoSelect.boton_nuevo").attr('disabled',false);
                $(form).find("select.DepartamentoSelect.boton_nuevo").html(json);
                //console.log($(".DepartamentoSelect").val());
                $(form).find("select.DepartamentoSelect.boton_nuevo").trigger('change');
                 // init();
                 objMsjCarga.dialog('close');
            },
            error:function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });   
       // function(){alert($(".PaisSelect").val());}
    });
    // Bandera para evitar que entre por los dos if (el de ciudad y el de departamento)
    var band_ciudep = 0;
    // Si ciudad tiene valor, quiere decir que se está editando
    if($(".CiudadSelect.boton_nuevo").val()){
        band_ciudep=1;
        // Si no hay valor para departamento lo buscamos para poder llamar a DepertamentoSelect
        if(!$(".DepartamentoSelect.boton_nuevo").val()){
            $.ajax({
                url: Routing.generate('sisciudad_findIdDepartamentoByIdCiudad', { idciudad: $(".CiudadSelect.boton_nuevo").val() }),
                data: $(".PaisSelect.boton_nuevo").val(),
                type: "post",
                success: function(json) {                    
                    $(".DepartamentoSelect.boton_nuevo").val(json);
                    // $( ".DepartamentoSelect" ).trigger('change');
                    // Si no hay valor para pais lo buscamos para poder llamar a PaisSelect
                    if(!$(".PaisSelect.boton_nuevo").val()){
                        $.ajax({
                             url: Routing.generate('sisdepartamento_findIdPaisByIdDepartamento', { iddepartamento: $(".DepartamentoSelect.boton_nuevo").val() }),
                             data: $(".PaisSelect.boton_nuevo").val(),
                             type: "post",
                             success: function(json) {                    
                                 $(".PaisSelect.boton_nuevo").val(json);
                                 $( ".PaisSelect.boton_nuevo" ).trigger('change');
                             },
                             error:function (xhr, ajaxOptions, thrownError) {
                                console.log(xhr);
                             }
                         });
                    }else{
                        $( ".PaisSelect.boton_nuevo" ).trigger('change');
                    }
                },
                error:function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
            });
        }else{
            $( ".PaisSelect.boton_nuevo" ).trigger('change');
        }
    }

    // Si departamento tiene valor, indica que se está editando una ciudad
    if($(".DepartamentoSelect.boton_nuevo").val() && !band_ciudep){
        if(!$(".PaisSelect.boton_nuevo").val()){
            $.ajax({
                 url: Routing.generate('sisdepartamento_findIdPaisByIdDepartamento', { iddepartamento: $(".DepartamentoSelect.boton_nuevo").val() }),
                 data: $(".PaisSelect.boton_nuevo").val(),
                 type: "post",
                 success: function(json) {                    
                     $(".PaisSelect.boton_nuevo").val(json);
                     $( ".PaisSelect.boton_nuevo" ).trigger('change');
                 },
                 error:function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                 }
             });
        }else{
            $( ".PaisSelect.boton_nuevo" ).trigger('change');
        } 
    }
       
}
    init();
});