$(document).ready(function(){
    $("[name='sgu_usuario']").validate({
        //debug: true,
        /*rules: {
            rht_rhtonlinebundle_sgupersonausuariotype_usuario_email: {
                required: false,
                lettersonly: true
            },
            rht_rhtonlinebundle_sgupersonausuariotype_primerNombre: {
                required: true,
                lettersonly: true
            },
            rht_rhtonlinebundle_sgupersonausuariotype_segundoNombre: {
                lettersonly: true ,
                required: true
            },
            rht_rhtonlinebundle_sgupersonausuariotype_primerApellido: {
                lettersonly: true ,
                required: true
            },
            rht_rhtonlinebundle_sgupersonausuariotype_segundoApellido: {
                lettersonly: true ,
                required: true
            },
            rht_rhtonlinebundle_sgupersonausuariotype_numeroIdentificacion: {
                required: true,
                integer: true
            }
            
        },*/
        messages: {
            rht_rhtonlinebundle_sgupersonausuariotype_primerNombre: {
                required: "Por favor, ingrese el primer nombre",
                lettersonly: "Por favor, solo ingrese letras"
            },
            rht_rhtonlinebundle_sgupersonausuariotype_segundoNombre: {
                //required: "Por favor, ingrese el segundo nombre",
                lettersonly: "Por favor, solo ingrese letras"
            },
            rht_rhtonlinebundle_sgupersonausuariotype_primerApellido: {
                required: "Por favor, ingrese el primer apellido",
                lettersonly: "Por favor, solo ingrese letras"
            },
            rht_rhtonlinebundle_sgupersonausuariotype_segundoApellido: {
                //required: "Por favor, ingrese el segundo nombre",
                lettersonly: "Por favor, solo ingrese letras"
            }
        },
        submitHandler: function() { return false; }
    });
    // variables para el boton crear y para saber cuando se debe hacer focus o no, para ejecutar el validate
    var boton_crear,hacer_focus;
    $("form[name='sgu_usuario'] select").change(function(){
        $("form[name='sgu_usuario'] div").find("label.error").each(function(index,element){
            if(($(element).parent().find('li').attr("style") !== "display: inline-block; margin-top: -112px;margin-left: 194px;")){
               // $(element).parent().find('li').attr("style","display: inline-block; margin-top: -112px;margin-left: 194px;");
            }
            else{
                $(element).parent().find('li').attr("style","display: inline-block; margin-bottom: 2px;margin-left: 1px;");
            }
                
        });
    });
    // Cuando se pierda el foco de un elemento del formulario se dispara el validate
    $("form[name='sgu_usuario'] input,select,textarea").blur(function(){
        // Si existe un boton con la clase emergente, nos indica que hay abierto un "nuevo emergente"
        // Sino, obtenemos todos los botones que hay en el documento, si hay mas de dos botones nos indica
        // que hay abierto un "nuevo emergente", el crear emergente el boton con la clase emergente
        if(!empty($(".ui-dialog-buttonset button.emergente").attr("class"))){
            boton_crear = $($(".ui-dialog-buttonset button.emergente"));
        }
        else{
            // si el número de botones es igual 2, obtenemos el primer boton
            $(".ui-dialog-buttonset button").each(function(index,element){
                if(index === 0){
                    boton_crear = $(element);
                }
            });
        }
        // variable para habilitar o deshabilitar los botones o boton crear
        var visible = true;
        // obtenemos todos lo errores y preguntamos si están o no ocultos, si hay almenos uno y no está oculto
        // la variable visible se hace falsa
        $("form[name='sgu_usuario'] div").find("label.error").each(function(index,element){
            if($(element).attr("style")!=='display: none;' || empty($(element).attr("style"))){
                visible = false;
                $(element).parent().find('li').attr("style","display: inline-block; margin-top: -112px;margin-left: 194px;");
            }
            else{
               // $(element).parent().find('li').attr("style","display: inline-block; margin-bottom: 2px;margin-left: 1px;");
            }
        });
        // Si hay algún texto de error y visible es falso, se deshabilita el boton o los botones.
        if($("form[name='sgu_usuario'] .error").text() && !visible){
            boton_crear.attr('disabled',true);
        }else{
            boton_crear.attr('disabled',false);
        }
        // Se hace foco si se cumplen las siguientes condiciones, el boton tiene la clase emergente y el id del formulario también es emergente
        // o el boton no tiene la clase emergente y el id del formulario tampoco es emergente
        if((boton_crear.hasClass('emergente') && $("form[name='sgu_usuario']").parent().attr("id") === "show_form_emergente")
            || (!boton_crear.hasClass('emergente') && $("form[name='sgu_usuario']").parent().attr("id") === "show_form")){
            hacer_focus = true;
        }else{
            hacer_focus = false;
        }
        
        boton_crear.focus(function(){
            if(hacer_focus){
                visible = true; 
                $("form[name='sgu_usuario'] div").find("label.error").each(function(index,element){
                    if($(element).attr("style")!=='display: none;'){
                        visible = false;
                    }
                });
                $("[name='sgu_usuario']").submit();
                if($("form[name='sgu_usuario'] .error").text() && !visible){
                    boton_crear.attr('disabled',true);
                }else{
                    if(boton_crear.attr('disabled')){
                        boton_crear.attr('disabled',false);
                    }
                }
            }
        });    
       
    });
    // para colocar el boton nuevo en los selects que se necesite
    if($("form[name='sgu_usuario']").parent().attr("id") !== "show_form_emergente"){
        boton_nuevo();
    }
});