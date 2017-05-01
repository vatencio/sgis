$(document).ready(function(){       
    // Funcion para colocar el datepicker a las fechas
function init(){
        
        $(".boton_accion").click(function(){
            var checked_usuario =  $( "input.check_usuario_filtro:checked" );
            //console.log(checked_usuario.length);
            // Obtenemos el mensaje de la vista anterior
            var mensaje;
            
            $('#tabs_correo').find("div[name=tabs_mensajes]").each(function(i,e){
                //console.log($(e).attr("style"));
                if($(e).attr("style") === "display: block;"){
                    mensaje = $(e).text();
                }
            });
            
            var n_usuario = checked_usuario.length;
            var arr_id_usuarios = new Array();
            var arr_usuarios = new Array();
            var arr_correos = new Array(); 
            //Construye arreglo de usuarios
            for(i=0; i < n_usuario; i++){
                tr = $(checked_usuario[i]).parent().parent();
                email = tr.find(".email_usuario_filtro");
                if(email.text() != ""){
                    nombres = tr.find(".nombres_usuario_filtro").text()+" "+tr.find(".apellidos_usuario_filtro").text();
                    //console.log(email,email.text());
                    arr_correos.push(email.text());
                    arr_usuarios.push(nombres);
                    arr_id_usuarios.push($(checked_usuario[i]).attr("value"));
                }
                
            }     
            var botones = [{text: "Cerrar",click: function() {$( this ).dialog( "close" );}}];
            if( n_usuario > 0 ){
                objMsjCarga.dialog('open');
                $.ajax({
                    url: Routing.generate('default_sendMail', { usuarios: arr_usuarios,correos: arr_correos,id_usu: arr_id_usuarios}),                
                    type: "post",
                    data: {mensaje: mensaje}, 
                    success: function(json1) {
                        var json = JSON.parse(json1);
                        if(json.valid){
                            $( "#mensaje_popup" ).html(json.html);
                            
                        }else{
                            $( "#mensaje_popup" ).html(json.html+" "+json.fail);
                        }
                        $( "#mensaje_popup" ).dialog( "option", "title", "Mensaje");
                        $( "#mensaje_popup" ).dialog( "option", "buttons", botones);                
                        $( "#mensaje_popup" ).dialog( 'open' );
                        //Refresca la pestana actual
                        var current_index = $("#tabs").tabs("option","active"); 
                        $("#tabs").tabs('load',current_index);
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
                $( "#mensaje_popup" ).html("Seleccione los usuarios");                                
                $( "#mensaje_popup" ).dialog( "option", "title", "Mensaje");
                $( "#mensaje_popup" ).dialog( "option", "buttons", botones);                
                $( "#mensaje_popup" ).dialog( 'open' );
            }                     
        });
    }
    init();
});


