$(document).ready(function(){       
    // Funcion para colocar el datepicker a las fechas
function init(){     
        //Si existe el campo empresaCliente
        if($("#usuario_filtro_empresaCliente").attr('id') !== undefined){             
            // Deshabilito los campo de seleccion            
        $(".SucursalSelect").attr('disabled',true);
        $(".UsuarioSelect").attr('disabled',true);
            $(".CargoSelect").attr('disabled',true);     
            $(".EmpresaSelect").attr('disabled',true);     
        }
        
        //Evento change sobre empresa cliente
        $(".EmpresaClienteSelect").change(function(){
            var idEmpresaPersona = 0;
            var idEmpresaCliente = 0;
            var idCargoPersona = 0;
            if($(".EmpresaClienteSelect").val() !== null){
                idEmpresaCliente = $(".EmpresaClienteSelect").val();
            }           
           // ajax para seleccionar la sucursal despues de haber elegido la empresa cliente;
           var idSucursal = 0;
            if($(".SucursalSelect").val() !== null){
                idSucursal = $(".SucursalSelect").val();
            }
            //Consulta sucursales
            $.ajax({
                url: Routing.generate('sgusucursal_findByIdEmpresaCliente', { idempresacliente: idEmpresaCliente,idsucursal: idSucursal }),
                data: $(".SucursalSelect").val(),
                type: "post",
                success: function(json) {                    
                    $(".SucursalSelect").attr('disabled',false);
                    $( ".SucursalSelect" ).html(json);
                    $( ".SucursalSelect" ).trigger('change');
                },
                error:function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
            });
            //Consulta empresas persona
            $.ajax({
                url: Routing.generate('sguempresapersona_findByIdEmpresaCliente', { idempresacliente: idEmpresaCliente,idempresapersona: idEmpresaPersona }),                
                type: "post",
                success: function(json) {                                      
                    $(".EmpresaSelect").attr('disabled',false);
                    $( ".EmpresaSelect" ).html(json);                                
                },
                error:function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
            });
            //consulta cargos
            $.ajax({
                url: Routing.generate('sgucargoempresacliente_findByIdEmpresaCliente', { idempresacliente: idEmpresaCliente,idcargopersona: idCargoPersona }),                
                type: "post",
                success: function(json) {                    
                    $(".CargoSelect").attr('disabled',false);
                    $( ".CargoSelect" ).html(json);                    
                },
                error:function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
            });
        });             

        //Evento change sobre sucursal
        $(".SucursalSelect").change(function(){
            var idSucursal = 0;
            if($(".idSucursal").val() !== null){
                idSucursal=$(".SucursalSelect").val();
            }
            if($(".UsuarioSelect").val() !== null){ 
                idUsuario = $(".UsuarioSelect").val();
            } 
            $.ajax({
                url: Routing.generate('sguusuario_findUsuarioClienteByIdSucursal', { idsucursal: idSucursal, idusuario: idUsuario }),                
                type: "post",
                success: function(json) {                                    
                    $( ".UsuarioSelect" ).attr('disabled',false);
                    $( ".UsuarioSelect" ).html(json);
                    $( ".UsuarioSelect" ).trigger('change');
                    
                },
                error:function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
            });   
        });             
        
        //Evento change sobre usuario
        $(".UsuarioSelect").change(function(){            
            if($(".UsuarioSelect").val() !== undefined){
                idUsuario = $(".UsuarioSelect").val();
            }
            $.ajax({
                url: Routing.generate('sguusuarioprueba_findTablaUsuarioPruebaByIdUsuario', { idusuario: idUsuario }),                
                type: "post",
                success: function(response) {                                    
                    $( "#lista_licencias_asignacion" ).html(response);
                    //Deshabilita las pruebas que estan para renovacion
                    $("input.Renovacion").attr('disabled', true);
                    $("input.Renovacion").removeClass('check_evausuarioprueba_prueba');
                },
                error:function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
            });              
        });
        
        // Cargo la empresa cliente apartir de la sucursal
        $(".FiltroSelect").change(function(){            
            $("table.dataTable").dataTable().fnDraw();                      
        }); 
                        
        //Valida si existe el campo de clientes
        if($("#usuario_filtro_empresaCliente").attr('id') !== undefined){            
        //Se agrega filtro personalizado a datatables para cliente y sucursal
        $.fn.dataTableExt.afnFiltering.push(
            function( oSettings, aData, iDataIndex ) {
                var valEmpresa = $("#usuario_filtro_empresaCliente option:selected").attr('value');
                var valSucursal = $("#usuario_filtro_sucursal option:selected").attr('value');
                var valEmpresaText= $("#usuario_filtro_empresaCliente option:selected").text();
                var valSucursalText = $("#usuario_filtro_sucursal option:selected").text();                    
                var valEmpresaTabla = aData[4];  
                var valSucursalTabla = aData[5];                    
                if ( valEmpresa === undefined){
                    return true;
                }
                if(valSucursal === undefined && valEmpresaText === valEmpresaTabla){
                    return true;
                }
                if(valSucursalText === valSucursalTabla && valEmpresaText === valEmpresaTabla){
                    return true;
                }                                       
                return false;
            }
        );
        }
        //Se agrega filtro personalizado a datatables para cargo
        $.fn.dataTableExt.afnFiltering.push(
            function( oSettings, aData, iDataIndex ) {
                var valCargo = $("#usuario_filtro_cargo option:selected").attr('value');
                var valCargoText= $("#usuario_filtro_cargo option:selected").text();              
                var valCargoTabla = aData[7];                                  
                if ( valCargo === undefined){
                    return true;
                }
                if( valCargoText === valCargoTabla ){
                    return true;
                }                                       
                return false;
            }
        );
        //Se agrega filtro personalizado a datatables para empresaPersona
        $.fn.dataTableExt.afnFiltering.push(
            function( oSettings, aData, iDataIndex ) {
                var valEmpresaPersona = $("#usuario_filtro_empresa_persona option:selected").attr('value');
                var valEmpresaPersonaText= $("#usuario_filtro_empresa_persona option:selected").text();              
                var valEmpresaPersonaTabla = aData[6];                    
                if ( valEmpresaPersona === undefined){
                    return true;
                }
                if( valEmpresaPersonaText === valEmpresaPersonaTabla ){
                    return true;
                }                                       
                return false;
            }
        );
        //Se agrega check de los campos
        checkMarcarTodos();
    }
    init();
});


