/**
 * Funcion que abre dialogo 
 * @returns {undefined}
 */

var url_emergente;
function abrirDialogoFormulario(){    
    var path_v = $(this).attr("path");
    var id_v = $(this).attr("id");
    var url = path_v;
    var data = "";
    accionAbrir = $(this).attr("accion");        
    if(accionAbrir !== "perfil"){
        data = "id=" + id_v;
    }
    //url=url.replace('//','/'+id_v+'/');
    //console.log(accionAbrir);
    if(accionAbrir === "emergente"){
       url_emergente = url; 
    }
    $( "#show_form" ).dialog( "close" );                       
    $.ajax({
        url: url,
        data: data,
        type: "post",
        success: function(json) {                    
          $( "#show_form" ).html(json);
          $( "input,select,textarea" ).focus();
          //init();
        },
        complete: function(){
          $( "#show_form" ).dialog( "open" ); 
        },
        error:function (xhr, ajaxOptions, thrownError) {
         console.log(xhr);
         //init();
        }
      });
}
function abrirDialogoFormularioEmeregente(){    
    var path_v = $(this).attr("path");
    var id_v = $(this).attr("id");
    var url = path_v;
   // var label_boton = $(this).parent();
    var div_boton = $(this).parent();
    var select_boton = div_boton.find("select");
    //console.log(select_boton.attr("id"));
    //console.log(div.find("select"));
    var data = "";
    accionAbrir = $(this).attr("accion");        
    if(accionAbrir !== "perfil"){
        data = "id=" + id_v;
    }
    //url=url.replace('//','/'+id_v+'/');
    //console.log(url);
    $( "#show_form_emergente" ).dialog( "close" );
   // $( "#show_form_emergente" ).dialog({ appendTo: select_boton.attr("id") });
    $( "#show_form_emergente" ).dialog( "option", "appendTo", select_boton.attr("id") );
    $.ajax({
        url: url,
        data: data,
        type: "post",
        success: function(json) {                    
          $( "#show_form_emergente" ).html(json);
          $( "input,select,textarea" ).focus();
          //init();
        },
        error:function (xhr, ajaxOptions, thrownError) {
         console.log(xhr);
         //init();
        }
      });
    $( "#show_form_emergente" ).dialog( "open" ); 
}
function accionFormulario(event, accion){    
    event.preventDefault();
    // Para los que tienen ciudad o departamento, esto en caso de que no actualice la ciudad,
    // hay que habilitarlo para que envíe el valor
    $(".CiudadSelect").attr('disabled',false);
    $(".DepartamentoSelect").attr('disabled',false);
    $(".SucursalSelect").attr('disabled',false);
    $(".EmpresaPersonaSelect").attr('disabled',false);
    $(".ui-dialog-buttonset button").attr('disabled',true);
    //
    // Activo el campo rht_rhtonlinebundle_sgucargopersonatype_persona, para que lo pueda enviar
    $("#rht_rhtonlinebundle_sgucargopersonatype_persona").attr('disabled',false);
    var mensajes = {
        "create" : " Datos almacenados ",
        "create_new" : " Datos almacenados ",
        "update" : " Datos actualizados ",
        "delete" : " Datos eliminados ",
        "Save"   : " Cambios almacenados ",
        "register" : "Usuario registrado",
        "change" : "Contraseña actualizada",
        "agregar" : "Campo agregado",
        "enabled" : "Usuario habilitado",
        "disabled" : "Usuario deshabilitado",
        "cargueMasivo" : "Cargue realizado",
        "renovarlicenciacliente": "Licencia renovada",
        "sendMail": "Correo(s) enviando(s)"
    };
    var form = $("form[action*='" + accion + "']");
    var data = form.serialize();
    //console.log(accion,form);return;
    if(accion === "create_new"){
        form = $("form[action*='create']");
        data = form.serialize();
        data = data+"&accion=create_new";
        $( "#mensaje_espera" ).dialog( 'open' );
    }
    //console.log(data);
    var path_url = form.attr("action");
    //console.log(path_url);return;
    $.ajax({
        url: path_url,
        data: data,
        dataType : "json",
        type: "post",
        success: function(response) {
            //console.log(response,response.html);
            //var response = JSON.parse(response1);
            if(accion !== "delete"){
                if(response.valid){
                    if(accion !== "create_new"){
                        $( "#show_form" ).dialog( 'close' );
                    }
                    if(accion === "create_new"){
                        //$( "#mensaje_espera" ).dialog( 'close' );
                        setTimeout(function(){$( "#mensaje_espera" ).dialog( 'close' );},100);
                        $( "#show_form" ).html(response.html); 
                    }
                    $( "#mensaje_popup" ).html(mensajes[accion]);
                    $( "#mensaje_popup" ).dialog( 'open' );
                    setTimeout(function(){$( "#mensaje_popup" ).dialog( 'close' );},1000);
                }
                else{
                    if(accion === "cargueMasivo"){
                        $( "#mensaje_popup" ).html(response.html); 
                        $( "#mensaje_popup" ).dialog( 'open' );
                    }
                    else{
                        if(accion === "create_new"){
                            $( "#mensaje_espera" ).dialog( 'close' );
                        }
                        $( "#show_form" ).html(response.html);
                    }
                    $(".ui-dialog-buttonset button").attr('disabled',false);
                }
            }
            else{
                  $( "#show_form" ).dialog( 'close' );
                  $( "#mensaje_popup" ).html(mensajes[accion]);
                  $( "#mensaje_popup" ).dialog( 'open' );  
                  setTimeout(function(){$( "#mensaje_popup" ).dialog( 'close' );},1000);
            }            
            
                      
        },
        error:function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
            $( "#mensaje_popup" ).html( "Ha ocurrido un error" );
        }
    });
}

function accionFormularioEmergente(event, accion){    
    event.preventDefault();
    // Para los que tienen ciudad o departamento, esto en caso de que no actualice la ciudad,
    // hay que habilitarlo para que envíe el valor
    $(".CiudadSelect").attr('disabled',false);
    $(".DepartamentoSelect").attr('disabled',false);
    $(".SucursalSelect").attr('disabled',false);
    $(".EmpresaPersonaSelect").attr('disabled',false);
    //
    // Activo el campo rht_rhtonlinebundle_sgucargopersonatype_persona, para que lo pueda enviar
    $("#rht_rhtonlinebundle_sgucargopersonatype_persona").attr('disabled',false);
    var mensajes = {
        "create" : " Datos almacenados ",
        "update" : " Datos actualizados ",
        "delete" : " Datos eliminados ",
        "Save"   : " Cambios almacenados ",
        "register" : "Usuario registrado",
        "change" : "Contraseña actualizada",
        "agregar" : "Campo agregado",
        "cargueMasivo" : "Cargue realizado"
    };
    var form = $("#show_form_emergente form");
    //var form = $("form[action*='" + accion + "']");
    var data = form.serialize();
    var path_url = form.attr("action");
    $.ajax({
        url: path_url,
        data: data,
        type: "post",
        success: function(response1) {
            //console.log(accion,response);
            var response = JSON.parse(response1);
            if(accion !== "delete"){
                //console.log(accion,response.valid,response["valid"],response,info,info.valid);
                if(response.valid){
                    $( "#show_form_emergente" ).dialog( 'close' );
                    $( "#mensaje_popup" ).html(mensajes[accion]);
                    $( "#mensaje_popup" ).dialog( 'open' );
                    setTimeout(function(){$( "#mensaje_popup" ).dialog( 'close' );},1000);
                    findReloadselect(response.id);
                }
                else{
                    $( "#show_form_emergente" ).html(response.html); 
                    //$( "#show_form_emergente" ).dialog( 'open' );
                }
            }
            else{
                  $( "#show_form_emergente" ).dialog( 'close' );
                  $( "#mensaje_popup" ).html(mensajes[accion]);
                  $( "#mensaje_popup" ).dialog( 'open' );  
                  setTimeout(function(){$( "#mensaje_popup" ).dialog( 'close' );},1000);
            }            
        },
        error:function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
            $( "#mensaje_popup" ).html( "Ha ocurrido un error" );
        }
    });
}

