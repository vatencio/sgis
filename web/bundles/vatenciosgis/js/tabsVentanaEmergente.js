function tabsEmergente(){
    //reiniciar filtros datetable
    $.fn.dataTableExt.afnFiltering = new Array();
    //Acciones edicion y detalles de registros
    $(".ventana_show_emergente").click(abrirDialogoFormularioEmeregente);
    //Implementacion de dataTable
    //Implementacion de dataTable
    var id_actual = $("div.ui-tabs-panel[style*='block']").attr("id");  
    ArrObjTable = $("#" + id_actual).find("table");
    //console.log(objTable);   
    //objTable = $("table.records_list");      
    //Implementacion de tablas    
    n_table = ArrObjTable.length;
    for(i=0; i < n_table; i++){   
        if(objTable.attr("class").indexOf("no_datatable") < 0){
            objTable.dataTable({
                "bJQueryUI": false, 
                "sDom": 'T C lfrtip', 
                "sPaginationType": "full_numbers",  

                "oLanguage": { 
                    "oPaginate": { 
                        "sPrevious": "Anterior", 
                        "sNext": "Siguiente", 
                        "sLast": "Ultima", 
                        "sFirst": "Primera" 
                    }, 

                    "sLengthMenu": 'Mostrar <select>'+ 
                    '<option value="10">10</option>'+ 
                    '<option value="20">20</option>'+ 
                    '<option value="30">30</option>'+ 
                    '<option value="40">40</option>'+ 
                    '<option value="50">50</option>'+ 
                    '<option value="-1">Todos</option>'+ 
                    '</select> registros', 

                    "sInfo": "Mostrando del _START_ a _END_ (Total: _TOTAL_ resultados)", 

                    "sInfoFiltered": " - filtrados de _MAX_ registros", 

                    "sInfoEmpty": "No hay resultados de búsqueda", 

                    "sZeroRecords": "No hay registros a mostrar", 

                    "sProcessing": "Espere, por favor...", 

                    "sSearch": "Buscar:"
                },
                "bDestroy": true
            });
        }
    }
    
    $(".componente_boton").button();
    checkMarcarTodos();

};

$(document).ready(function(){    
    tabsEmergente();
});

