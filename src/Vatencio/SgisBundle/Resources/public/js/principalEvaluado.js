var objMsjCarga = null;
var seq_visible = 0;
$(document).ready(function(){
    seq_visible = $("#block_visible").val();//establece el proximo bloque visible
    objMsjCarga = $( "#mensaje_espera" );
    //cambio de vista
    $(".seq_visible_0" ).css('display','block');//Hace visible el mensaje de bienvenida
    $(".next_visible").click(nextVisible);
    $(".boton_medicion").click(function(){        
        if($("#block_visible").val() > 0){
            seq_visible = $("#block_visible").val();
            seq_visible ++;    
            $("[class*=seq_visible_]").css('display','none');
            $(".seq_visible_" + seq_visible ).css('display','block');            
        }else{
            nextVisible();
        }            
    });
    // Funcion para salir cuando el evaluado a terminado todas las pruebas
    function salir(link){
        //console.log(link.attr("href"));
        location.href = link.attr("href");
    }
    // var arr_id, array con los ids de las relaciones eva_usuario_prueba
    var arr_id = $("#arr_usuario_prueba_id").val().split(",");
    $(".terminar_prueba").click(function(){
        sv = seq_visible-1;
        data = $(".seq_visible_" + sv + " form").serialize();
        //console.log($("#usuario_prueba_id").val());
        //data = {usuario_prueba_id: arr_id[0]};
        $.ajax({
            url: Routing.generate('evaresultadousuario_save'),                
            type: "post",
            data: data,
            success: function(json) {                                    
                
            },
            error:function (xhr, ajaxOptions, thrownError) {
             console.log(xhr);
            },
            complete: function(){
                arr_id.shift();
            }
        });
    });
    $(".terminar_evaluacion").click(function(){
        salir($("a[href*=logout]"));   
    });
    $(".enviar_datos_demograficos").click(function(){
        if(guardarDemografico()){
            nextVisible();
        }         
    });
    $("input[id*=pregunta]").change(nextVisible);
    $(".prev_visible").click(function(){
        //si la pantalla es difente a la primera pregunta
        if(seq_visible > 0)
            seq_visible --;
        $("[class*=seq_visible_]").css('display','none');
        $(".seq_visible_" + seq_visible ).css('display','block');
    });
    //componentes botones
    $(".componente_boton").button();    
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
      height: 150,
      width: 300,
      modal: true,
      dialogClass: 'no-close',
      close: function() {        
        //Reestablece valores por defecto
        $( "#mensaje_popup" ).empty();
        $( "#mensaje_popup" ).dialog( "option", "height", 150 );
        $( "#mensaje_popup" ).dialog( "option", "width", 300 );
        $( "#mensaje_popup" ).dialog( "option", "position", "center" );
        $( "#mensaje_popup" ).dialog( "option", "buttons", []);    
      }
    });
    $( ".ventana_show").click(function(event){
        console.log($(this).attr("path"));
        $.ajax({
        url: $(this).attr("path"),
        //data: data,
        type: "post",
        success: function(json) {
            $( "#show_form" ).dialog();   
            $( "#show_form" ).html(json);
        },
        complete: function(){
            $( "#show_form" ).dialog( "open" ); 
        },
        error:function (xhr, ajaxOptions, thrownError) {
         console.log(xhr);
        }
      });
        //$( "#show_form" ).dialog( 'close' );
    });
});
function nextVisible(event){
    
    var checkedInput = $(".seq_visible_" + seq_visible + " p.eval_opcion_respuesta").find("input:checked");     
    var preguntas_visibles = $(".seq_visible_" + seq_visible).find("p.pregunta_enunciado");    
    var name = $(".seq_visible_" + seq_visible + " p.eval_opcion_respuesta input").attr("name");       
    if(name === undefined || checkedInput.size() === preguntas_visibles.size()){
        if(checkedInput.size() === preguntas_visibles.size()){
            persistirVisible();
            // Miramos si el boton con clase terminar_prueba, ha sido pintado, 
            // si es asi, nos indica que estamos en la ultima pregunta para esata prueba
            // y procedemos a guardar las respuestas procesadas
            var div_botones = $(".seq_visible_" + seq_visible).find("div.eval_contenedor_botones");
            var boton_terminar = div_botones.find("button.terminar_prueba");
            if(boton_terminar.attr("class") && event.type === "change"){
                //console.log(event.type);
                //$(".terminar_prueba").trigger("click");
                sv = seq_visible-1;
                data = $(".seq_visible_" + sv + " form").serialize();
                //console.log($("#usuario_prueba_id").val());
                //data = {usuario_prueba_id: arr_id[0]};
                setTimeout(function(){
                $.ajax({
                    url: Routing.generate('evaresultadousuario_save'),                
                    type: "post",
                    data: data,
                    success: function(json) {                                    

                    },
                    error:function (xhr, ajaxOptions, thrownError) {
                     console.log(xhr);
                    },
                    complete: function(){
                        //arr_id.shift();
                    }
                });
                }, 2000);
            }
        }
        seq_visible ++;    
        $("[class*=seq_visible_]").css('display','none');
        $(".seq_visible_" + seq_visible ).css('display','block'); 
    }           
}
function persistirVisible(){
    data = $(".seq_visible_" + seq_visible + " form").serialize();
    $.ajax({
        url: Routing.generate('evarespuestausuario_save'),                
        type: "post",
        data: data,
        success: function(json) {                                    
            
        },
        error:function (xhr, ajaxOptions, thrownError) {
         console.log(xhr);
        }
    });
}