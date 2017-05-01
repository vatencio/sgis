function guardarDemografico(){       
    var form = $("form[action*='updateDemog']");
    var data = form.serialize();
    var path_url = form.attr("action");
    var resp = false;
    $.ajax({
        url: path_url,
        data: data,
        async: false,
        type: "post",        
        success: function(response) {            
            if(response === "true"){                
                $("form div div ul").css("display","none");//oculta los mensajes de error del formulario
                resp = true;
            }
            else{
              $( "#eval_form_demog" ).html(response);//repinta el formulario
              $("form div div ul").css("display","block");//Muestra los mensajes de error del formulario
            }                                                         
        },
        error:function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
            $( "#mensaje_popup" ).html( "Ha ocurrido un error" );
        }
    });    
    return resp;
}
