/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function empty(e) {
                    switch(e) {
                        case "":
                        case 0:
                        case "0":
                        case null:
                        case false:
                        case undefined:
                            return true;
                        default : return false;
                    }
}

function boton_nuevo() {
    var div,nombre,html;
    $(".boton_nuevo").each(function(index,element){
        div = $(element).parent();
        label = div.find("label");
        nombre = $(element).attr("name");
        url =  $(element).attr("link");
        url_real = Routing.generate(url, { id: 1 });
        tabla =  $(element).attr("tabla");
        campo_mostrar =  $(element).attr("campo_mostrar");
        depende_nombre =  $(element).attr("depende_nombre");
        depende_valor =  $(element).attr("depende_valor");
        
        //console.log(tam,$(label).length);
       // html = '<div width="1" class="div_boton_nuevo" style="display: inline-block; margin: 7px;">';
       // html += '<ul class="menu_acciones" width="1" >';
        html = '<li style="display: inline-block; margin-bottom: 2px;margin-left: 1px;" \n\
                    class="componente_boton ventana_show_emergente" path="'+url_real+'" accion="nuevo_emergente" \n\
                    tabla="'+tabla+'" campo_mostrar="'+campo_mostrar+'" depende_nombre="'+depende_nombre+'" depende_valor="'+depende_valor+'">';
        html +=    '<a href="#">';
        html +=        '+';
        html +=    '</a>';
        html += '</li>';
        //html += '</ul>';
        //html += '</div>';
        //console.log(html);

        div.append(html);
    });
    //console.log($(".boton_nuevo"));
    
    tabsEmergente();
}

function findReloadselect(id){
     //Se hace un llamado ajax, para recargar el select
    // En caso de que haya mas de un select debo obtener el que está en el momento
    id_select_actual = $( "#show_form_emergente" ).dialog( "option", "appendTo" );
    //console.log(id_select_actual,$("#"+id_select_actual));
    var tabla_join = 0;
    var admin = true;
    tabla =  $("#"+id_select_actual).attr("tabla");
    campo_mostrar =  $("#"+id_select_actual).attr("campo_mostrar");
    depende_nombre =  $("#"+id_select_actual).attr("depende_nombre");
    depende_valor =  $("#"+id_select_actual).attr("depende_valor");
    
    if(empty(depende_nombre)){
        depende_nombre = 0;
    }else{
        //console.log(!empty($("."+depende_nombre).val()));
        if(!empty($("."+depende_nombre).val())){
            tabla_join = depende_valor;
            depende_valor = $("."+depende_nombre).val();
        }
        else{
            // si entra aquí, indica que lo más probable es que el usuario logueado no sea un admin, y por lo tanto no existe
            // un select para empresa cliente
            depende_valor = 0;
            admin = false;
        }
    }
    if(empty(depende_valor)){
        depende_valor = 0;
    }
    $.ajax({
        url: Routing.generate('default_findReloadselect', { tabla: tabla, campo_mostrar: campo_mostrar, depende_nombre: tabla_join, depende_valor: depende_valor, id: id, admin: admin }),
       // data: $(".DepartamentoSelect").val(),
        type: "post",
        success: function(json) {   
            $("#"+id_select_actual).html(json);
        },
        error:function (xhr, ajaxOptions, thrownError) {
         console.log(xhr);
        }
    });
}
