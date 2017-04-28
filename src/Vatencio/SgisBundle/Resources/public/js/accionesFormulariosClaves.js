$(document).ready(function(){           
function init(){     
        var idSucursal=0;
        var idEmpresaCliente=0;
        var idUsuario=0;   
        var idPrueba=0;
        var bandGenSerial = false;
        // Cuando se la empresa cliente cambia la empresa persona
        // Deshabilito la empresa persona
        // Deshabilito la sucursal                
        $( "#form_claves .componente_boton" ).button();
        $( "#form_claves .boton_gen_serial" ).button( "option", "disabled", true );
        $( "#form_claves .SucursalSelect" ).attr("disabled",true);
        $( "#form_claves .UsuarioSelect" ).attr("disabled",true);
        $( "#form_claves .PruebaSelect" ).attr("disabled",true);                                                                    
        $( "#form_claves .PruebaProducto" ).attr("disabled",true);
        //Evento de cambio sobre el select de cliente
        $("#form_claves .EmpresaClienteSelect").change(function(){            
            if($(".EmpresaClienteSelect").val() !== null){
                idEmpresaCliente = $(".EmpresaClienteSelect").val();
            }           
           // ajax para seleccionar la sucursal despues de haber elegido la empresa cliente;
           var idSucursal=0;
            if($(".SucursalSelect").val() !== null){
                idSucursal = $(".SucursalSelect").val();
            }
            //Establer valores iniciales en los selectores dependientes            
            $( ".UsuarioSelect" ).val(0);
            $( ".UsuarioSelect" ).attr('disabled',true);              
            $( ".LicenciaSelect" ).val(0);
            $( ".LicenciaSelect" ).attr('disabled',true);
            //Establece valores iniciales en la tabla validando en valor 0
            $( ".LicenciaSelect" ).trigger('change');
            $.ajax({
                url: Routing.generate('sgusucursal_findByIdEmpresaCliente', { idempresacliente: idEmpresaCliente,idsucursal: idSucursal }),
                data: $(".SucursalSelect").val(),
                type: "post",
                success: function(json) {                    
                    $( ".SucursalSelect" ).html(json);  
                    $( ".SucursalSelect" ).attr('disabled',false);                                                               
                },
                error:function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
            });   
        });
        //Evento de cambio sobre el select de sucursal
        $("#form_claves .SucursalSelect").change(function(){
            var idSucursal=0;
            if($(".idSucursal").val() !== null){
                idSucursal=$(".SucursalSelect").val();
            }
            //Establer valores iniciales en los selectores dependientes                          
            $( ".LicenciaSelect" ).val(0);
            $( ".LicenciaSelect" ).attr('disabled',true);
            //Establece valores iniciales en la tabla validando en valor 0
            $( ".LicenciaSelect" ).trigger('change');
            $.ajax({
                url: Routing.generate('sguusuario_findUsuarioClienteByIdSucursal', { idsucursal: idSucursal, idusuario: idUsuario }),
                data: $(".SucursalSelect").val(),
                type: "post",
                success: function(json) {                    
                    $( ".UsuarioSelect" ).html(json);   
                    $(".UsuarioSelect").attr('disabled',false);                                     
                },
                error:function (xhr, ajaxOptions, thrownError) {
                 console.log(xhr);
                }
            });            
        });
        //Se obtienen las licencias del usuario
        $("#form_claves .UsuarioSelect").change(function(){            
            if($(".UsuarioSelect").val() !== null){ 
                idUsuario = $(".UsuarioSelect").val();
            }
            $.ajax({
                url: Routing.generate('sguusuarioprueba_findUsuarioPruebaByIdUsuario', { idusuario: idUsuario }),
                data: $( ".UsuarioSelect" ).val(),
                type: "post",
                success: function(response) {                     
                    $( ".LicenciaSelect" ).html(response);
                    $( ".LicenciaSelect" ).attr('disabled',false);                    
                    $( ".LicenciaSelect" ).trigger('change');
                },
                error:function (xhr, ajaxOptions, thrownError) {
                 console.log(xhr);
                }
            });                              
        });            
        //Evento change sobre PruebaSelect
        $("#form_claves .LicenciaSelect").change(function(){
            $( "#form_claves div.info_cliente label.error" ).text("");
            $( ".boton_gen_serial" ).button( "option", "disabled", true );
            if($(".LicenciaSelect").val() !== null){ 
                idLicencia = $(".LicenciaSelect").val();
            }
            $.ajax({
                url: Routing.generate('sisclaveseriallicencia_findClaveSerialLicenciaByIdLicencia', { idlicencia: idLicencia }),
                data: $( ".LicenciaSelect" ).val(),
                type: "post",
                success: function(json){
                    if(bandGenSerial === false){                            
                        $( "[id*=clave_campo_]" ).val("");
                        $( "[id*=serial_campo_]" ).val("");
                        $( "#claves_factura" ).val("");
                    }else{//se reinicia la bandera`                            
                        bandGenSerial = false;
                    }                       
                    $( "#claves_lista_claves" ).html(json);
                    $( ".lista_clave_serial_item" ).click(function(){
                        
                        //Muestra la clave del item de la lista seleccionado
                        var clave = $( "#lista_clave_serial_clave_" + $(this).attr("value")).text();
                        var arrClave = clave.split("-");
                        var nClave = arrClave.length;                            
                        for(i = 0; i < nClave; i++){
                            $( "#clave_campo_" + (i+1) ).val(arrClave[i]);
                        }                                                        
                        var serial = $( "#lista_clave_serial_serial_" + $(this).attr("value")).text();
                        //Valida si existe el serial en la lista
                        if(serial !== ""){                               
                           //Muestra el serial del item de la lista seleccionado
                           var arrSerial = serial.split("-");
                           var nSerial = arrSerial.length; 
                           for(i = 0; i < nSerial; i++){
                             $( "#serial_campo_" + (i+1) ).val(arrSerial[i]);
                           }
                           //carga numero de factura y desactiva para edicion
                           var factura = $( "#factura_" + $(this).attr("value")).text();
                           $( "#claves_factura" ).val(factura);
                           $( "#claves_factura" ).attr('disabled',true);   
                        }else{   
                            //habilita campo de factura
                            $( "#claves_factura" ).attr('disabled',false);
                            //habilita boton de generacion de seriales
                            $( ".boton_gen_serial" ).button( "option", "disabled", false );
                            $( ".boton_gen_serial" ).attr("value",$(this).attr("value"));
                        }                        
                    });
                    $( "#claves_lista_claves table" ).dataTable({
                            "bJQueryUI": false, 
                            "sDom": 'T C lfrtip', 
                            "sPaginationType": "full_numbers",  

                            "oLanguage": { 
                                "oPaginate": { 
                                    "sPrevious": "Anterior", 
                                    "sNext": "Siguiente", 
                                    "sLast": "Ultima", 
                                    "sFirst": "Primera" 
                                }, 

                                "sLengthMenu": 'Mostrar <select>'+ 
                                '<option value="10">10</option>'+ 
                                '<option value="20">20</option>'+ 
                                '<option value="30">30</option>'+ 
                                '<option value="40">40</option>'+ 
                                '<option value="50">50</option>'+ 
                                '<option value="-1">Todos</option>'+ 
                                '</select> registros', 

                                "sInfo": "Mostrando del _START_ a _END_ (Total: _TOTAL_ resultados)", 

                                "sInfoFiltered": " - filtrados de _MAX_ registros", 

                                "sInfoEmpty": "No hay resultados de búsqueda", 

                                "sZeroRecords": "No hay registros a mostrar", 

                                "sProcessing": "Espere, por favor...", 

                                "sSearch": "Buscar:"
                            },
                            "bDestroy": true
                        });
                    },
                error:function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
            });
        });
        //Evento click sobre boton generar serial
        $( "#form_claves .boton_gen_serial" ).click( function(){                
            var id = $(this).val(); 
            var factura = $( "#claves_factura" ).val();
            //valida si existe un numero de factura
            if(factura > 0){
                $( "#form_claves div.info_cliente label.error" ).text("");
                $.ajax({
                    url: Routing.generate('sisclaveseriallicencia_generarSerialLicencia', { id: id, factura:factura }),                
                    data: $(this).val(),
                    type: "post",
                    success: function(json) {                                                  
                         var serial = json; 
                         var arrSerial = serial.split("-");
                         var nSerial = arrSerial.length; 
                         for(i = 0; i < nSerial; i++){
                           $( "#serial_campo_" + (i+1) ).val(arrSerial[i]);
                         }
                         bandGenSerial = true;//bandera generacion de seriales
                         //Actualizar lista
                         $( ".LicenciaSelect" ).trigger('change');
                    },
                    error:function (xhr, ajaxOptions, thrownError) {
                     console.log(xhr);
                    }
                });
            }else{//si no existe muestra error                    
                $( "#form_claves div.info_cliente label.error" ).text("Por favor, ingrese el número de factura");
            }                
             
        });                                             
    }
    //Se ejecuta unicamente para generacion de claves
    
    init();
});