$(document).ready(function(){  
        // Cuando se la empresa cliente cambia la empresa persona
        // Deshabilito la empresa persona
        $(".EmpresaPersonaSelect").attr('disabled',true);
        
        $(".EmpresaClienteSelect").change(function(){
            var idEmpresaCliente=0;
            if(!empty($(".EmpresaClienteSelect").val())){
                idEmpresaCliente=$(".EmpresaClienteSelect").val();
            }
            var idEmpresaPersona=0;
            if(!empty($(".EmpresaPersonaSelect").val())){
                idEmpresaPersona=$(".EmpresaPersonaSelect").val();
            }
           // Ajax para seleccionar el la empresaPersona de la persona
            $.ajax({
                url: Routing.generate('sguempresapersona_findByIdEmpresaCliente', { idempresacliente: idEmpresaCliente, idempresapersona: idEmpresaPersona}),
                data: $(".EmpresaClienteSelect").val(),
                type: "post",
                success: function(json) {                    
                //  $( "#show_form" ).html(json); 
                //console.log(json);
               // alert($(".PaisSelect").val());
                $(".EmpresaPersonaSelect").attr('disabled',false);
                $( ".EmpresaPersonaSelect" ).html(json);

                 // init();
                },
                error:function (xhr, ajaxOptions, thrownError) {
                 console.log(xhr);
                }
            });
        });
        
        if($(".EmpresaClienteSelect").val()){
           // console.log($(".EmpresaClienteSelect").val());
            $( ".EmpresaClienteSelect" ).trigger('change');
            //$(".EmpresaPersonaSelect").attr('disabled',false);
        }
        
        if($(".EmpresaPersonaSelect").val()){
            var idEmpresaPersona=0;
            if(!empty($(".EmpresaPersonaSelect").val())){
                idEmpresaPersona=$(".EmpresaPersonaSelect").val();
            }
            $.ajax({
                url: Routing.generate('sguempresapersona_findEmpresaClienteByIdEmpresaPersona', { idempresapersona: idEmpresaPersona }),
                data: $(".EmpresaPersonaSelect").val(),
                type: "post",
                success: function(json) {                    
                //  $( "#show_form" ).html(json); 
                //console.log(json);
               // alert($(".PaisSelect").val());
                
                $( ".EmpresaClienteSelect" ).html(json);
                $( ".EmpresaClienteSelect" ).trigger('change');
                 // init();
                },
                error:function (xhr, ajaxOptions, thrownError) {
                 console.log(xhr);
                }
            });
           
           // $( ".EmpresaClienteSelect" ).trigger('change');
            //$(".EmpresaPersonaSelect").attr('disabled',false);
        }

});
