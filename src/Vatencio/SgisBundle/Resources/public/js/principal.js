var accionAbrir = "";//Accion recibida en formularios
var objMsjCarga = null;
$(document).ready(function(){
    objMsjCarga = $( "#mensaje_espera" );
    //Inicializacion dialogo de carga
    objMsjCarga.dialog({
      autoOpen: false,
      position: "center",
      height: 150,
      width: 300,
      modal: true,
      dialogClass: 'no-close',
      closeOnEscape: false
    });
    var str_carga_progreso = '<div id="carga_progreso_content"><span>Cargando...<span><div id="carga_progreso"></div></div>';
    objMsjCarga.html(str_carga_progreso);    
    $( "#carga_progreso" ).progressbar({
            value: false           
    }).find( ".ui-progressbar-value" ).css("background" , "#00629B");      
    //Inicializacion ventana emergente    
    $( "#mensaje_popup" ).dialog({
      autoOpen: false,
      position: "center",
      height: 'auto',
      width: 'auto',
      modal: true,
      minheight: 0,
      minWidth: 0,
      dialogClass: 'no-close',
      close: function() {        
        //Reestablece valores por defecto
        $( "#mensaje_popup" ).empty();
        $( "#mensaje_popup" ).dialog( "option", "height", 'auto' );
        $( "#mensaje_popup" ).dialog( "option", "width", 'auto' );
        $( "#mensaje_popup" ).dialog( "option", "position", "center" );
        $( "#mensaje_popup" ).dialog( "option", "buttons", []);    
      }
    });  
    $( "#show_form" ).dialog({
      autoOpen: false,
      position: "center",
      height: 'auto',
      width: 'auto',
      maxHeight: 600,
      modal: true,      
      resizable: false,
      close: function() {
            switch(accionAbrir){
                case "renovar_licencia_cliente":                        
                   actualizarLicenciasRenovacion();
                break;
                default:
                break;
            }
            //Reestablece valores por defecto
            $( "#show_form" ).empty();
            $( "#show_form" ).dialog( "option", "position", "center" );
            $( "#show_form" ).dialog( "option", "title", "");
            accionAbrir = "";
            //Refresca la pestana actual
            var current_index = $("#tabs").tabs("option","active"); 
            $("#tabs").tabs('load',current_index);
            
      },
      open: function(event, ui){            
                var accion = accionAbrir;
                var botones = {};
                var titulo = "";
                switch(accion){
                    case "nuevo":                
                        botones = [{text: "Crear",click: function() {accionFormulario(event,"create");}},
                                   {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];                 
                        titulo = "Nuevo Registro";
                    break;
                    case "nuevo_usuario":                
                        botones = [{text: "Crear + Nuevo",click: function() {accionFormulario(event,"create_new");}},{text: "Crear",click: function() {accionFormulario(event,"create");}},
                                   {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];                 
                        titulo = "Nuevo Registro";
                    break;
                    case "editar":
                        botones = [{text: "Actualizar",click: function() {accionFormulario(event,"update");;}},
                                  {text: "Eliminar",click: function() {accionFormulario(event,"delete");}},
                                  {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];  
                        titulo = "Editar Registro";
                    break;
                    case "ver":
                        botones = [{text: "Cancelar",click: function() {$( this ).dialog( "close" );}}]; 
                        titulo = "Ver Registro";
                        break;
                    case "change":
                        botones = [{text: "Actualizar",click: function() {accionFormulario(event,"change");;}},                                  
                                  {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];
                        titulo = "Cambiar Contraseeña";
                        break;
                    case "create":
                        botones = [{text: "Crear",click: function() {accionFormulario(event,"create");;}},                                  
                                  {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];          
                        titulo = "Nuevo Registro";
                        break;
                    case "update":
                        botones = [{text: "Actualizar",click: function() {accionFormulario(event,"update");;}},                                  
                                  {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];          
                        titulo = "Editar Registro";
                        break;
                    case "register":
                        botones = [{text: "Crear",click: function() {accionFormulario(event,"register");}},                                  
                                  {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];
                        titulo = "Nuevo Usuario";
                        break;
                    case "cargar":
                        botones = [{text: "Cargar",click: function() {cargarArchivo(event);}},                                  
                                  {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];
                        titulo = "Carga de Archivo";
                        break;
                    case "agregar":                
                        botones = [{text: "Agregar",click: function() {accionFormulario(event,"agregar");}},
                                   {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];                 
                    break;
                    case "enabled":                
                        botones = [{text: "Aceptar",click: function() {accionFormulario(event,"enabled");}},
                                   {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];
                        titulo = "Habilitar Usuario";       
                    break;
                    case "disabled":                
                        botones = [{text: "Aceptar",click: function() {accionFormulario(event,"disabled");}},
                                   {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];
                        titulo = "Deshabilitar Usuario";          
                    break;
                    case "renovar_licencia_cliente":                        
                        botones = [{text: "Aceptar",click: function() {accionFormulario(event,"renovarlicenciacliente");}},
                                   {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];
                        titulo = "Renovar Licencia";
                    case "cargueMasivo":                
                        botones = [{text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];
                        titulo = "Cargue masivo evaluados";
                    break;
                    case "cargo":                
                        botones = [{text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];
                        titulo = "Cargos por persona";
                    break;
                    case "enviarCorreo":                
                        botones = [{text: "Aceptar",click: function() {accionFormulario(event,"sendMail");}},
                                   {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];
                        titulo = "Enviar Correo";       
                    break;
                    default:
                        botones = [{text: "Cancelar",click: function() {$( this ).dialog( "close" );}}]; 
                        titulo = "Formulario";
                        break;
                }   
                $( "#show_form" ).dialog( "option", "title", titulo);
                $( "#show_form" ).dialog( "option", "buttons", botones);
            }
            
    });
    // Para las ventanas emergentes
    
    $( "#show_form_emergente" ).dialog({
      autoOpen: false,
      position: "center",
      height: 'auto',
      width: 'auto',
      maxHeight: 600,
      modal: true,      
      resizable: false,  
      close: function() {
            //Reestablece valores por defecto
            $( "#show_form_emergente" ).dialog( "option", "buttons",null);
            $( "#show_form_emergente" ).empty();
            $( "#show_form_emergente" ).dialog( "option", "height", "auto" );
            $( "#show_form_emergente" ).dialog( "option", "width", "auto" );
            $( "#show_form_emergente" ).dialog( "option", "position", "center" );
            accionAbrir = "";
            
            //console.log($( "#show_form_emergente" ).dialog( "option", "appendTo" ));
            //Refresca la pestana actual
           // var current_index = $("#tabs").tabs("option","active"); 
            //$("#tabs").tabs('load',current_index);
            //console.log(url_emergente);
            if(!empty(url_emergente)){
                padre = $("#show_form_emergente").parent();
                posicion = url_emergente.lastIndexOf('/');
                url_nueva = url_emergente.substring(0,posicion);
                posicion1 = url_nueva.lastIndexOf('/');
                id = url_nueva.substring(posicion1+1);
                data = "id="+id;
                //console.log(url_nueva);
                $( "#mensaje_espera" ).dialog( "open" ); 
                $( "#mensaje_espera" ).html("Cargando...");
                $.ajax({
                    url: url_nueva+"/",
                    data: data,
                    type: "post",
                    success: function(json) { 

                      $( "#show_form" ).html(json);
                      $( "#mensaje_espera" ).dialog( "close" ); 
                      //init();
                    },
                    error:function (xhr, ajaxOptions, thrownError) {
                     console.log(xhr);
                     //init();
                    }
                  });
            }else{
                // si no existe url_emergente, indica que el llamado es hecho desde un boton "+" 
                // (nuevo desde un select)
                input = $( "#show_form form div div" ).find("input");
                //console.log(input.length > 0);
                select = $( "#show_form form div div" ).find("select");
                texta = $( "#show_form form div div" ).find("textarea");
                if(input.length > 0){
                    $( "#show_form form div div input" ).focus();
                }
                else{
                    if(select.length > 0){
                        $( "#show_form form div div select" ).focus();
                    }
                    else{
                        if(texta.length > 0){
                            $( "#show_form form div div textarea" ).focus();
                        }
                    }
                }
                 
            }
            
      },
      open: function(event, ui){            
                var accion = accionAbrir;
                var botones = {};
                var titulo = "";
                switch(accion){
                    case "nuevo_emergente":                
                        botones = [{text: "Crear",click: function() {accionFormularioEmergente(event,"create");},class: "emergente"},
                                   {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}]; 
                        titulo = "Nuevo Registro";       
                    break;
                    case "editar_emergente":
                        botones = [{text: "Actualizar",click: function() {accionFormularioEmergente(event,"update");;}},
                                  {text: "Eliminar",click: function() {accionFormularioEmergente(event,"delete");}},
                                  {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];  
                    break;
                    case "ver_emergente":
                        botones = [{text: "Cancelar",click: function() {$( this ).dialog( "close" );}}]; 
                        break;
                    case "change_emergente":
                        botones = [{text: "Actualizar",click: function() {accionFormularioEmergente(event,"change");;}},                                  
                                  {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];
                    case "create_emergente":
                        botones = [{text: "Crear",click: function() {accionFormularioEmergente(event,"create");;}},                                  
                                  {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];          
                        break;
                    case "update_emergente":
                        botones = [{text: "Actualizar",click: function() {accionFormularioEmergente(event,"update");;}},                                  
                                  {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];          
                        break;
                    case "register_emergente":
                        botones = [{text: "Crear",click: function() {accionFormularioEmergente(event,"register");;}},                                  
                                  {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];
                        break;
                    case "cargar_emergente":
                        botones = [{text: "Cargar",click: function() {cargarArchivo(event);;}},                                  
                                  {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];
                        break;
                    case "agregar_emergente":                
                        botones = [{text: "Agregar",click: function() {accionFormularioEmergente(event,"agregar");}},
                                   {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];                 
                    break;
                    default:
                        botones = [{text: "Cancelar",click: function() {$( this ).dialog( "close" );}}]; 
                        break;
                }
                $( "#show_form_emergente" ).dialog( "option", "title", titulo);
                $( "#show_form_emergente" ).dialog( "option", "buttons", botones);
            }
    });
    //Si hay licencias para renovacion
    if($("#show_licencia_renovacion").attr('id') !== undefined){                
        $( "#block_licencia_renovacion" ).click(function(){                                    
            actualizarLicenciasRenovacion();
        });
        //Dialgo para licencias para renovacion
        $("#show_licencia_renovacion").dialog({
            autoOpen: false,
            position: "center",            
            modal: true,
            width: 500,
            title: "Licencias por renovar"
        });
    }
    //Accion sobre el boton salir del menu principal
    $(".salir_tab").click(function(){ 
        var path_v = $(this).attr("path");
        //location.href=path_v;
        $(location).attr('href', path_v);
    });
    //Accion sobre perfil
    $(".editar_perfil").click(abrirDialogoFormulario);
   
});
/**
 * Marca tods los checkbox de la misma clase en una lista
 */
function checkMarcarTodos(){
    //evento change sobre el checkbox de clase check_all
    $(".check_all").change(function(){
        //Obtiene el string de clases
        var clase = $(this).attr("class");
        //Obtiene la clase de checkbox que se va a marcar
        var arrClase = clase.split(" ");
        clase = arrClase[0];
        //Valida si esta marcado para proceder a marcar o desmarcar
        if($(this).is(':checked')){
            $("." + clase).prop("checked",true);            
        }
        else{
            $("." + clase).prop("checked",false);            
        }        
    });
}

/**
 * 
 */
function actualizarLicenciasRenovacion(){
    $.ajax({
        url: Routing.generate('sguusuarioprueba_findUsuarioPruebaRenovacionByIdUsuario', {'idusuario':0}),                
        type: "post",
        success: function(json) {                                    
            $("#show_licencia_renovacion").html(json);
            var cant_renovaciones = $("#cant_licencias_renovacion").val();
            if(cant_renovaciones > 0){
                //Actualizar bloque superior
                if(cant_renovaciones === "1"){
                    str_cant_descr = cant_renovaciones + " licencia";
                }
                else{
                    str_cant_descr = cant_renovaciones + " licencias";
                }
                $(".block_licencia_renovacion_text_cant_descr").html(str_cant_descr)
                $(".ventana_show_index").click(abrirDialogoFormulario);
            }
            else{
                $("#block_licencia_renovacion").css("display", "none");
            }
            $("#show_licencia_renovacion").dialog('open'); 
            //Acciones en lista de licencias pendientes de renovacion            
        },
        error:function (xhr, ajaxOptions, thrownError) {
         console.log(xhr);
        }
    }) 
}
