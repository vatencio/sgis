$(document).ready(function(){       
    // Funcion para colocar el datepicker a las fechas
function init(){     
        var idSucursal=0;
        var idEmpresaCliente=0;
        var idUsuario=0;   
        var idPrueba=0;
        var bandGenSerial = false;
        var tipoLicencia = "";
        // Cuando se la empresa cliente cambia la empresa persona
        // Deshabilito la empresa persona
        // Deshabilito la sucursal               
        $( ".componente_boton" ).button();
        $( ".boton_gen_serial" ).button( "option", "disabled", true );
        $( ".SucursalSelect" ).attr('disabled',true);
        $( ".UsuarioSelect" ).attr('disabled',true);
        $( ".PruebaSelect" ).attr('disabled',true);        
        if(accionAbrir === "editar"){
            $( "#rht_rhtonlinebundle_sguusuariopruebatype_consecutivo" ).attr('disabled',true);
            $( ".EmpresaClienteSelect" ).attr("disabled",true);
            $( "#rht_rhtonlinebundle_sguusuariopruebatype_factura" ).attr("disabled",true);
            $( "#rht_rhtonlinebundle_sguusuariopruebatype_tipo" ).attr("disabled",true);
        }
        if(accionAbrir === "nuevo"){
            $( "[id*=rht_rhtonlinebundle_sguusuariopruebatype_fechaRenovacion]" ).attr('disabled',true);
        }
        //Se establece que por defecto se asigna fecha de renovacion un anio despues de la fecha inicial de
        //la licencia..
        //cambio en el anio de fecha inicial de la licencia
        $( "#rht_rhtonlinebundle_sguusuariopruebatype_fechaInicial_year" ).change(function(){
            $( "#rht_rhtonlinebundle_sguusuariopruebatype_fechaRenovacion_year" ).val(
                parseInt($( "#rht_rhtonlinebundle_sguusuariopruebatype_fechaInicial_year" ).val()) + 1
            );
        });
        //cambio en el mes de fecha inicial de la licencia
        $( "#rht_rhtonlinebundle_sguusuariopruebatype_fechaInicial_month" ).change(function(){
            $( "#rht_rhtonlinebundle_sguusuariopruebatype_fechaRenovacion_month" ).val(
                $( "#rht_rhtonlinebundle_sguusuariopruebatype_fechaInicial_month" ).val()
            );
        }); 
        //cambio en el dia de fecha inicial de la licencia
        $( "#rht_rhtonlinebundle_sguusuariopruebatype_fechaInicial_day" ).change(function(){
            $( "#rht_rhtonlinebundle_sguusuariopruebatype_fechaRenovacion_day" ).val(
                $( "#rht_rhtonlinebundle_sguusuariopruebatype_fechaInicial_day" ).val()
            );
        }); 
        
        $(".EmpresaClienteSelect").change(function(){
            var idEmpresaCliente=0;
            if($(".EmpresaClienteSelect").val() !== null){
                idEmpresaCliente=$(".EmpresaClienteSelect").val();
            }           
           // ajax para seleccionar la sucursal despues de haber elegido la empresa cliente;
           var idSucursal=0;
            if($(".SucursalSelect").val() !== null){
                idSucursal=$(".SucursalSelect").val();
            }
           // console.log(idEmpresaCliente);
            $.ajax({
                url: Routing.generate('sgusucursal_findByIdEmpresaCliente', { idempresacliente: idEmpresaCliente,idsucursal: idSucursal }),
                data: $(".SucursalSelect").val(),
                type: "post",
                success: function(json) {                                    
                $( ".SucursalSelect" ).html(json);
                $( ".SucursalSelect" ).attr('disabled',false);
                $( ".SucursalSelect" ).trigger('change');
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
        
        // Cargo la empresa cliente apartir de la sucursal
        $(".SucursalSelect").change(function(){
            var idSucursal=0;
            if($(".idSucursal").val() !== null){
                idSucursal=$(".SucursalSelect").val();
            }
            if($(".UsuarioSelect").val() !== null){ 
                idUsuario = $(".UsuarioSelect").val();
            } 
            $.ajax({
                url: Routing.generate('sguusuario_findUsuarioClienteByIdSucursal', { idsucursal: idSucursal, idusuario: idUsuario }),
                data: $(".SucursalSelect").val(),
                type: "post",
                success: function(json) {                                    
                $( ".UsuarioSelect" ).html(json);
                $(".UsuarioSelect").attr('disabled',false);
                    if(accionAbrir === "editar"){                   
                        $( ".UsuarioSelect" ).trigger('change');
                    }                
                },
                error:function (xhr, ajaxOptions, thrownError) {
                 console.log(xhr);
                }
            });            
        });        
        //Se obtienen las licencias del usuario
        $(".UsuarioSelect").change(function(){            
            if($(".UsuarioSelect").val() !== null){ 
                idUsuario = $(".UsuarioSelect").val();
            }                
            $.ajax({
                url: Routing.generate('sguusarioprueba_findPruPruebaNoLicenciaByIdUsuario', { idusuario: idUsuario }),
                data: $( ".UsuarioSelect" ).val(),
                type: "post",
                success: function(response) {      
                    //No permite editar la prueba si es edicion                    
                    if(accionAbrir !== "editar"){                        
                        $( ".PruebaSelect" ).html(response);
                        $( ".PruebaSelect" ).attr('disabled',false);
                        //$( ".PruebaSelect" ).trigger('change');
                    }                                      
                },
                error:function (xhr, ajaxOptions, thrownError) {
                 console.log(xhr);
                }
            });              
        });
        //Se obtienen las licencias del usuario
        $( ".PruebaSelect, .TipoSelect" ).change(function(){            
            idPrueba = $( ".PruebaSelect" ).val();
            tipoLicencia = $( ".TipoSelect" ).val();
            //valida que la prueba haya sido seleccionada
            if(idPrueba > 0){
                $.ajax({
                    url: Routing.generate('sguusuarioprueba_generarconsecutivolicencia', { idprueba: idPrueba, tipolicencia:tipoLicencia }),
                    data: idPrueba + "&" + tipoLicencia,
                    type: "post",
                    success: function(response) {                                            
                        if(accionAbrir !== "editar"){                      
                            $( "#rht_rhtonlinebundle_sguusuariopruebatype_consecutivo" ).val(response);                        
                        }                                      
                    },
                    error:function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr);
                    }
                });     
            }
        });       
        //Si usuario tiene valor significa que se esta editando la licencia
        if($(".UsuarioSelect").val() !== "0" && $(".UsuarioSelect").val() !== null){            
            idUsuario = $( ".UsuarioSelect" ).val();            
            $.ajax({
                url: Routing.generate('sguusuario_findSucursalEmpresaClienteById', { idusuario: idUsuario }),                
                data: $( ".UsuarioSelect" ).val(),
                type: "post",
                success: function(json) {                                                  
                     json = json.split(",");
                     $( ".EmpresaClienteSelect" ).val(json[0]);                     
                     $( ".SucursalSelect" ).val(json[1]);                                           
                     $( ".SucursalSelect" ).attr('disabled',false);                           
                     $( ".EmpresaClienteSelect" ).trigger('change');                                          
                },
                error:function (xhr, ajaxOptions, thrownError) {
                 console.log(xhr);
                }
            });                                    
        }                                       
    }
    init();
});


