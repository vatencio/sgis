$(document).ready(function(){
var tabs = $("#tabs");
var tabcounter = 0;
$("ul.sf-menu").superfish();
$( "#tabs" ).tabs({
    beforeLoad: function( event, ui ) {
    ui.jqXHR.error(function() {
        ui.panel.html(
          "Ha ocurrido un error al cargar." 
        );
        return;
    });      
    //Elimina elementos para evitar conflictos en eventos en otras pestanas
    /*********** Lista Elementos *********/
    $("#form_claves").remove();
    /*********** Fin Lista *********/
    objMsjCarga.dialog('open');
    },
    load: function(){      
      objMsjCarga.dialog('close');      
    }
});
$("a.link_tab").click( function(){                                              
    var path = $(this).attr("path");
    var title = $(this).attr("value");
    var id_title = $(this).attr("value").replace(/\ /g, '_');       
    if($("#tab_" + id_title).attr("id") === undefined){
        var li = "<li id='tab_" + id_title + "'><a href='" + path + "'>" + title + "</a><span class='ui-icon ui-icon-close cerrar_tab'></span></li>";
        tabs.find( ".ui-tabs-nav" ).append( li );                        
        tabs.tabs( "refresh" );                            
        tabcounter ++;
        tabs.tabs( "option", "active",  tabcounter);        
    }else{           
        $("#tab_" + id_title + " a").trigger("click");                
    }
})
// close icon: removing the tab on click
tabs.delegate( "span.ui-icon-close", "click", function() {
    var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
    $( "#" + panelId ).remove();                                
    tabs.tabs( "refresh" );
    tabcounter --;
});

});