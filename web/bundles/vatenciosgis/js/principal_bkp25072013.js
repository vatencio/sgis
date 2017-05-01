var accionAbrir = "";//Accion recibida en formularios    
$(document).ready(function(){        
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
      }
    });  
    $( "#show_form" ).dialog({
      autoOpen: false,
      position: "center",
      height: 400,
      width: 550,
      modal: true,      
      close: function() {
            //Reestablece valores por defecto
            $( "#show_form" ).empty();
            $( "#show_form" ).dialog( "option", "height", 400 );
            $( "#show_form" ).dialog( "option", "width", 550 );
            $( "#show_form" ).dialog( "option", "position", "center" );
            accionAbrir = "";
      },
      open: function(event, ui){                
                var accion = accionAbrir;
                var botones = {};
                switch(accion){
                    case "nuevo":                
                        botones = [{text: "Crear",click: function() {accionFormulario(event,"create");}},
                                   {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];                 
                    break;
                    case "editar":
                        botones = [{text: "Actualizar",click: function() {accionFormulario(event,"update");;}},
                                  {text: "Eliminar",click: function() {accionFormulario(event,"delete");}},
                                  {text: "Cancelar",click: function() {$( this ).dialog( "close" );}}];  
                    break;
                    case "ver":
                        botones = [{text: "Cancelar",click: function() {$( this ).dialog( "close" );}}]; 
                        break;
                    default:
                        botones = [{text: "Cancelar",click: function() {$( this ).dialog( "close" );}}]; 
                        break;
                }   
                $( "#show_form" ).dialog( "option", "buttons", botones);
            }
            
    });
    /* Para editarPerfiles, para manejar el marcado y desmarcado de los checbox */
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

