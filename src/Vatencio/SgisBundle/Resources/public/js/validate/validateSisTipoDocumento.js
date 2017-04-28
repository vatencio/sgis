$(document).ready(function(){
    $("[name='sis_tipo_documento']").validate({
        messages: {
            rht_rhtonlinebundle_sistipodocumentotype_nombre: {
                required: "Por favor, ingrese el nombre",
                lettersonly: "Por favor, solo ingrese letras"
            }
        },
        submitHandler: function() { return false; }
    });
    // variables para el boton crear y para saber cuando se debe hacer focus o no, para ejecutar el validate
    var boton_crear,hacer_focus;
    $("form[name='sis_tipo_documento'] select").change(function(){
        $("form[name='sis_tipo_documento'] div").find("label.error").each(function(index,element){
            if(($(element).parent().find('li').attr("style") !== "display: inline-block; margin-top: -112px;margin-left: 194px;")){
               // $(element).parent().find('li').attr("style","display: inline-block; margin-top: -112px;margin-left: 194px;");
            }
            else{
                $(element).parent().find('li').attr("style","display: inline-block; margin-bottom: 2px;margin-left: 1px;");
            }
                
        });
    });
    // Cuando se pierda el foco de un elemento del formulario se dispara el validate
    $("form[name='sis_tipo_documento'] input,select,textarea").blur(function(){
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
        $("form[name='sis_tipo_documento'] div").find("label.error").each(function(index,element){
            if($(element).attr("style")!=='display: none;' || empty($(element).attr("style"))){
                visible = false;
                $(element).parent().find('li').attr("style","display: inline-block; margin-top: -112px;margin-left: 194px;");
            }
            else{
               // $(element).parent().find('li').attr("style","display: inline-block; margin-bottom: 2px;margin-left: 1px;");
            }
        });
        // Si hay algún texto de error y visible es falso, se deshabilita el boton o los botones.
        if($("form[name='sis_tipo_documento'] .error").text() && !visible){
            boton_crear.attr('disabled',true);
        }else{
            boton_crear.attr('disabled',false);
        }
        // Se hace foco si se cumplen las siguientes condiciones, el boton tiene la clase emergente y el id del formulario también es emergente
        // o el boton no tiene la clase emergente y el id del formulario tampoco es emergente
        if((boton_crear.hasClass('emergente') && $("form[name='sis_tipo_documento']").parent().attr("id") === "show_form_emergente")
            || (!boton_crear.hasClass('emergente') && $("form[name='sis_tipo_documento']").parent().attr("id") === "show_form")){
            hacer_focus = true;
        }else{
            hacer_focus = false;
        }
        
        boton_crear.focus(function(){
            if(hacer_focus){
                visible = true; 
                $("form[name='sis_tipo_documento'] div").find("label.error").each(function(index,element){
                    if($(element).attr("style")!=='display: none;'){
                        visible = false;
                    }
                });
                $("[name='sis_tipo_documento']").submit();
                if($("form[name='sis_tipo_documento'] .error").text() && !visible){
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
    if($("form[name='sis_tipo_documento']").parent().attr("id") !== "show_form_emergente"){
        boton_nuevo();
    }
});