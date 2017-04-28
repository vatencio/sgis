$(document).ready(function(){  
        // Desahabilito el campo rht_rhtonlinebundle_sgucargopersonatype_persona, para que lo puedan cambiar
        $("#rht_rhtonlinebundle_sgucargopersonatype_persona").attr('disabled',true);
        // Cuando se la empresa cliente cambia la empresa persona
        // Deshabilito la empresa persona
        $(".AreaSelect").attr('disabled',true);
        // Para que el foco lo obtenga el primer select y se pueda ejecutar el validate
        $("select").focus();
        $(".EmpresaPersonaSelect").change(function(){
            var idEmpresaPersona=0;
            if(!empty($(".EmpresaPersonaSelect").val())){
                idEmpresaPersona=$(".EmpresaPersonaSelect").val();
            }
            var idArea=0;
            if(!empty($(".AreaSelect").val())){
                idArea=$(".AreaSelect").val();
            }
           // Ajax para seleccionar el la empresaPersona de la persona
            $.ajax({
                url: Routing.generate('sgucargopersona_findByIdEmpresaPersona', { idempresapersona: idEmpresaPersona, idarea: idArea}),
                data: $(".EmpresaClienteSelect").val(),
                type: "post",
                success: function(json) {                    
                //  $( "#show_form" ).html(json); 
                //console.log(json);
               // alert($(".PaisSelect").val());
                $(".AreaSelect").attr('disabled',false);
                $( ".AreaSelect" ).html(json);

                 // init();
                },
                error:function (xhr, ajaxOptions, thrownError) {
                 console.log(xhr);
                }
            });
        });
        
        if($(".EmpresaPersonaSelect").val()){
           // console.log($(".EmpresaClienteSelect").val());
            $(".AreaSelect").attr('disabled',false);
            $( ".EmpresaPersonaSelect" ).trigger('change');
            //$(".EmpresaPersonaSelect").attr('disabled',false);
        }
        
       /* if($(".AreaSelect").val()){
            var idArea=0;
            if(!empty($(".AreaSelect").val())){
                idArea=$(".AreaSelect").val();
            }
            $.ajax({
                url: Routing.generate('sguempresapersona_findEmpresaClienteByIdEmpresaPersona', { idarea: idArea }),
                data: $(".AreaSelect").val(),
                type: "post",
                success: function(json) {                    
                //  $( "#show_form" ).html(json); 
                //console.log(json);
               // alert($(".PaisSelect").val());
                
                $( ".EmpresaPersonaSelect" ).html(json);
                $( ".EmpresaPersonaSelect" ).trigger('change');
                 // init();
                },
                error:function (xhr, ajaxOptions, thrownError) {
                 console.log(xhr);
                }
            });
           
           // $( ".EmpresaClienteSelect" ).trigger('change');
            //$(".EmpresaPersonaSelect").attr('disabled',false);
        }*/

});
