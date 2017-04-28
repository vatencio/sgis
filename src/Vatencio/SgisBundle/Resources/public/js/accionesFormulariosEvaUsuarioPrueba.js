$(document).ready(function(){       
    // Funcion para colocar el datepicker a las fechas
function init(){     
        //Si existe el campo empresaCliente
        if($("#rht_rhtonlinebundle_evausuarioprueba_filtro_empresaCliente").attr('id') !== undefined){             
            // Deshabilito los campo de seleccion            
        $(".SucursalSelect").attr('disabled',true);
        $(".UsuarioSelect").attr('disabled',true);
            $(".CargoSelect").attr('disabled',true);     
            $(".EmpresaSelect").attr('disabled',true);     
        }
        //Deshabilita las pruebas que estan para renovacion
        $("input.Renovacion").attr('disabled', true);
        $("input.Renovacion").removeClass('check_evausuarioprueba_prueba');
        
        //Evento change sobre empresa cliente
        $(".EmpresaClienteSelect").change(function(){
            var idEmpresaPersona = 0;
            var idEmpresaCliente = 0;
            var idCargoPersona = 0;
            if($(".EmpresaClienteSelect").val() !== null){
                idEmpresaCliente=$(".EmpresaClienteSelect").val();
            }           
           // ajax para seleccionar la sucursal despues de haber elegido la empresa cliente;
           var idSucursal=0;
            if($(".SucursalSelect").val() !== null){
                idSucursal=$(".SucursalSelect").val();
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
            var idSucursal=0;
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
        
        $(".boton_accion").click(function(){
            var checked_usuario =  $( "input.check_evausuarioprueba_usuario:checked" );
            var checked_prueba =  $( "input.check_evausuarioprueba_prueba:checked" );            
            var n_usuario = checked_usuario.length;
            var n_prueba = checked_prueba.length;
            var arr_usuarios = new Array();
            var arr_pruebas = new Array();            
            //Construye arreglo de usuarios
            for(i=0; i < n_usuario; i++){
                arr_usuarios.push($(checked_usuario[i]).attr("value"));
            }
            //Construye arreglo de pruebas
            for(i=0; i < n_prueba; i++){
                arr_pruebas.push($(checked_prueba[i]).attr("value"));
            }     
            var botones = [{text: "Cerrar",click: function() {$( this ).dialog( "close" );}}];
            if(n_prueba > 0 && n_usuario > 0 ){
                objMsjCarga.dialog('open');
                $.ajax({
                    url: Routing.generate('evausuarioprueba_create', { usuarios: arr_usuarios, pruebas:arr_pruebas }),                
                    type: "post",
                    success: function(json) {                                            
                        $( "#mensaje_popup" ).html(json);                                
                        $( "#mensaje_popup" ).dialog( "option", "title", "Mensaje");
                        $( "#mensaje_popup" ).dialog( "option", "buttons", botones);                
                        $( "#mensaje_popup" ).dialog( 'open' );
                    },
                    complete: function(json) {                                            
                         objMsjCarga.dialog('close');
                    },  
                    error:function (xhr, ajaxOptions, thrownError) {
                     console.log(xhr);
                    }
                });
            }
            else{                
                $( "#mensaje_popup" ).html("Seleccione los usuarios y pruebas");                                
                $( "#mensaje_popup" ).dialog( "option", "title", "Mensaje");
                $( "#mensaje_popup" ).dialog( "option", "buttons", botones);                
                $( "#mensaje_popup" ).dialog( 'open' );
            }                        
        })                
        //Valida si existe el campo de clientes
        if($("#rht_rhtonlinebundle_evausuarioprueba_filtro_empresaCliente").attr('id') !== undefined){            
        //Se agrega filtro personalizado a datatables para cliente y sucursal
        $.fn.dataTableExt.afnFiltering.push(
            function( oSettings, aData, iDataIndex ) {
                    var valEmpresa = $("#rht_rhtonlinebundle_evausuarioprueba_filtro_empresaCliente option:selected").attr('value');
                    var valSucursal = $("#rht_rhtonlinebundle_evausuarioprueba_filtro_sucursal option:selected").attr('value');
                var valEmpresaText= $("#rht_rhtonlinebundle_evausuarioprueba_filtro_empresaCliente option:selected").text();
                var valSucursalText = $("#rht_rhtonlinebundle_evausuarioprueba_filtro_sucursal option:selected").text();                    
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
                var valCargo = $("#rht_rhtonlinebundle_evausuarioprueba_filtro_cargo option:selected").attr('value');
                var valCargoText= $("#rht_rhtonlinebundle_evausuarioprueba_filtro_cargo option:selected").text();              
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
                var valEmpresaPersona = $("#rht_rhtonlinebundle_evausuarioprueba_filtro_empresa_persona option:selected").attr('value');
                var valEmpresaPersonaText= $("#rht_rhtonlinebundle_evausuarioprueba_filtro_empresa_persona option:selected").text();              
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


