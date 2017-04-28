$(document).ready(function(){       
        //$( "#mensaje_espera" ).dialog("open");
        // Cuando se la empresa cliente cambia la empresa persona
        // Deshabilito la empresa persona
        // Deshabilito la sucursal
        $(".EmpresaPersonaSelect").attr('disabled',true);
        $(".CargoPersonaSelect").attr('disabled',true);
        $(".SucursalSelect").attr('disabled',true);
        
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
            // Ajax para seleccionar el cargo de la persona
            var idCargoPersona=0;
            if($(".CargoPersonaSelect").val() !== null){
                idCargoPersona=$(".CargoPersonaSelect").val();
            }
            
            $.ajax({
                url: Routing.generate('sgucargoempresacliente_findByIdEmpresaCliente', { idempresacliente: idEmpresaCliente,idcargopersona: idCargoPersona }),
                data: $(".EmpresaClienteSelect").val(),
                type: "post",
                success: function(json) {                    
                //  $( "#show_form" ).html(json); 
                //console.log(json);
               // alert($(".PaisSelect").val());
                $(".CargoPersonaSelect").attr('disabled',false);
                $( ".CargoPersonaSelect" ).html(json);

                 // init();
                },
                error:function (xhr, ajaxOptions, thrownError) {
                 console.log(xhr);
                }
            });   
           //
           // ajax para seleccionar la sucursal despues de haber elegido la empresa cliente;
           var idSucursal=0;
            if($(".SucursalSelect").val() !== null){
                idSucursal=$(".SucursalSelect").val();
            }
            $.ajax({
                url: Routing.generate('sgusucursal_findByIdEmpresaCliente', { idempresacliente: idEmpresaCliente,idsucursal: idSucursal }),
                data: $(".SucursalSelect").val(),
                type: "post",
                success: function(json) {                    
                //  $( "#show_form" ).html(json); 
                //console.log(json);
               // alert($(".PaisSelect").val());
                $(".SucursalSelect").attr('disabled',false);
                $( ".SucursalSelect" ).html(json);
                 
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
        
        //$( "#show_form" ).dialog( 'close' );
       if($( "#valid" ).val() && $( "#accion" ).val()){
            // se elemina los campos propios para cada usuario, esto sólo cuando se le 
            // da clic al boton crear + nuevo

            $( "#rht_rhtonlinebundle_sgupersonausuariotype_usuario_email" ).val("");
            $( "#rht_rhtonlinebundle_sgupersonausuariotype_primerNombre" ).val("");
            $( "#rht_rhtonlinebundle_sgupersonausuariotype_segundoNombre" ).val("");
            $( "#rht_rhtonlinebundle_sgupersonausuariotype_primerApellido" ).val("");
            $( "#rht_rhtonlinebundle_sgupersonausuariotype_segundoApellido" ).val("");
            $( "#rht_rhtonlinebundle_sgupersonausuariotype_numeroIdentificacion" ).val("");
            
            // Se muestra el mansaje de satisfacción
           // setTimeout(function(){$( "#mensaje_espera" ).dialog("destroy");},2400);
           // setTimeout(function(){$( "#mensaje_popup" ).html("Datos almacenados");},2500);
            //setTimeout(function(){$( "#mensaje_espera" ).dialog("destroy");},2500);
           // setTimeout(function(){$( "#mensaje_popup" ).dialog( 'open' );},2500);
           // setTimeout(function(){$( "#mensaje_popup" ).dialog( "destroy" );},4000);
        }
    
});