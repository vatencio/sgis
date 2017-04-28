$(document).ready(function(){
    
    var id_actual = $("div.ui-tabs-panel[style*='block']").attr("id");
    var objBtn = $("#" + id_actual).find("button");    
    objBtn.button();
    
    
    // Para que no se vaya sin seleccionar almenos un check
    $("#boton_guardar_permisos_rol").click(function(event){
        var j=0;
        $("input[id*='hijo']:checked").each(function(){
            j++;
        });
        $("input[id*='padre']:checked").each(function(){
            j++;
        });
        if(j>0){
            // Si hay algún check seleccionado envia a la función para que guarde
            accionFormulario(event,"Save");
        }else{
            // Si no hay check seleccionado muestra un mensaje
            $( "#mensaje_popup" ).html("Debes seleccionar almenos una opción");
            $( "#mensaje_popup" ).dialog( 'open' );
            $("#form_guardar_permisos_rol").submit(function(){
                return false;
            });
        }
    });
    
    // Pregunta si el boton que se ha obtenido es el de los permisos_rol, ya que si es el mismo
    // no necesitamos enviarlo, ya que eso se definió arriba
    if(objBtn.attr('id')!=='boton_guardar_permisos_rol'){
        objBtn.click(function(event){accionFormulario(event,"Save");});
    }    
    $("input[id*='padre']").click(function(){
        var str_id_padre=$(this).attr("id");
        var str_id_hijo=str_id_padre.replace("padre","hijo");
       // console.log($("input[id="+str_id_padre+"]:checked").attr("id"));
        if($("input[id="+str_id_padre+"]:checked").attr("id")){
            $("input[id="+str_id_hijo+"]").each(function(){
                $(this).prop("checked",true);
            });
        }
        else{
            $("input[id="+str_id_hijo+"]:checked").each(function(){
                $(this).removeProp("checked");
            });
        }
    });
    $("input[id*='hijo']").click(function(){
        var str_id_hijo=$(this).attr("id");
        var str_id_padre=str_id_hijo.replace("hijo","padre");
        var i=0;
        if(!$("input[id="+str_id_padre+"]:checked").attr("id")){
            $("input[id="+str_id_padre+"]").prop("checked",true);
        }
        $("input[id="+str_id_hijo+"]:checked").each(function(){
           i++;
        });
        if(i==0){
            $("input[id="+str_id_padre+"]").removeProp("checked");
        }

    });
    
    
});