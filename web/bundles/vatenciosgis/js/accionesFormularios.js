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
            $(".DepartamentoSelect").change(function(){
                var idDepartamento=0;
                objMsjCarga.dialog('open');
                if($(".DepartamentoSelect").val() !== null){
                    idDepartamento=$(".DepartamentoSelect").val();
                }
                var idCiudad=0;
                if($(".CiudadSelect").val() !== null){
                    idCiudad=$(".CiudadSelect").val();
                }
                $.ajax({
                    url: Routing.generate('sisciudad_findByIdDepartamento', { iddepartamento: idDepartamento,idciudad: idCiudad }),
                    data: $(".DepartamentoSelect").val(),
                    type: "post",
                    success: function(json) {                    
                    //  $( "#show_form" ).html(json); 
                    //console.log(json);
                   // alert($(".PaisSelect").val());
                    $(".CiudadSelect").attr('disabled',false);
                    $( ".CiudadSelect" ).html(json);
                    
                     // init();
                     objMsjCarga.dialog('close');
                    },
                    error:function (xhr, ajaxOptions, thrownError) {
                     console.log(xhr);
                    }
                });   
               // function(){alert($(".PaisSelect").val());}
            });
      
        $(".PaisSelect").change(function(){
            var idDepartamento=0;
            objMsjCarga.dialog('open');
                if($(".DepartamentoSelect").val() !== null){
                    idDepartamento=$(".DepartamentoSelect").val();
                }
            $.ajax({
                url: Routing.generate('sisdepartamento_findByIdPais', { idpais: $(".PaisSelect").val(),iddepartamento: idDepartamento }),
                data: $(".PaisSelect").val(),
                type: "post",
                success: function(json) {                    
                //  $( "#show_form" ).html(json); 
                //console.log(json);
               // alert($(".PaisSelect").val());
                $(".DepartamentoSelect").attr('disabled',false);
                $( ".DepartamentoSelect" ).html(json);
                //console.log($(".DepartamentoSelect").val());
                $( ".DepartamentoSelect" ).trigger('change');
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
        var band_ciudep=0;
        // Si ciudad tiene valor, quiere decir que se está editando
        if($(".CiudadSelect").val()){
            band_ciudep=1;
           // Si no hay valor para departamento lo buscamos para poder llamar a DepertamentoSelect
           if(!$(".DepartamentoSelect").val()){
               $.ajax({
                    url: Routing.generate('sisciudad_findIdDepartamentoByIdCiudad', { idciudad: $(".CiudadSelect").val() }),
                    data: $(".PaisSelect").val(),
                    type: "post",
                    success: function(json) {                    
                        $(".DepartamentoSelect").val(json);
                       // $( ".DepartamentoSelect" ).trigger('change');
                        // Si no hay valor para pais lo buscamos para poder llamar a PaisSelect
                        if(!$(".PaisSelect").val()){
                            $.ajax({
                                 url: Routing.generate('sisdepartamento_findIdPaisByIdDepartamento', { iddepartamento: $(".DepartamentoSelect").val() }),
                                 data: $(".PaisSelect").val(),
                                 type: "post",
                                 success: function(json) {                    
                                     $(".PaisSelect").val(json);
                                     $( ".PaisSelect" ).trigger('change');
                                 },
                                 error:function (xhr, ajaxOptions, thrownError) {
                                  console.log(xhr);
                                 }
                             });
                        }else{
                            $( ".PaisSelect" ).trigger('change');
                        }
                    },
                    error:function (xhr, ajaxOptions, thrownError) {
                     console.log(xhr);
                    }
                });
           }else{
               $( ".PaisSelect" ).trigger('change');
           }
        }
        
        // Si departamento tiene valor, indica que se está editando una ciudad
        if($(".DepartamentoSelect").val() && !band_ciudep){
            if(!$(".PaisSelect").val()){
                $.ajax({
                     url: Routing.generate('sisdepartamento_findIdPaisByIdDepartamento', { iddepartamento: $(".DepartamentoSelect").val() }),
                     data: $(".PaisSelect").val(),
                     type: "post",
                     success: function(json) {                    
                         $(".PaisSelect").val(json);
                         $( ".PaisSelect" ).trigger('change');
                     },
                     error:function (xhr, ajaxOptions, thrownError) {
                      console.log(xhr);
                     }
                 });
            }else{
                $( ".PaisSelect" ).trigger('change');
            } 
        }
        
        
        
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
        
        // Cargo la empresa cliente apartir de la sucursal
        if($(".SucursalSelect").val()){
            var idSucursal=0;
            if($(".idSucursal").val() !== null){
                idSucursal=$(".SucursalSelect").val();
            }
            $.ajax({
                url: Routing.generate('sgusucursal_findEmpresaClienteByIdSucursal', { idsucursal: idSucursal }),
                data: $(".SucursalSelect").val(),
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
        
        // Para cargar la empresa en sgucargo
        if($(".IdForCargoSelect").val()){
              //console.log($(".IdForCargoSelect").val());
            $.ajax({
                url: Routing.generate('sgucargoempresacliente_findEmpresaClienteByIdCargo', { idcargo: $(".IdForCargoSelect").val() }),
                data: $(".IdForCargoSelect").val(),
                type: "post",
                success: function(json) {                    
    
                    $( ".EmpresaClienteForCargoSelect" ).html(json);

                },
                error:function (xhr, ajaxOptions, thrownError) {
                 console.log(xhr);
                }
            }); 
        }
       
    }
    init();
});