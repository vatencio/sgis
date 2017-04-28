$(document).ready(function(){       
    // Funcion para colocar el datepicker a las fechas
function init(){        
        // Cuando se la empresa cliente cambia la empresa persona
        // Deshabilitar la sucursal
        $(".SucursalSelect").attr('disabled',true);    
        
        $(".EmpresaClienteSelect").change(function(){
            var idEmpresaCliente=0;
            if(!empty($(".EmpresaClienteSelect").val())){
                idEmpresaCliente=$(".EmpresaClienteSelect").val();
            }
            // ajax para seleccionar la sucursal despues de haber elegido la empresa cliente;
            var idSucursal=0;
            if(!empty($(".SucursalSelect").val())){
                idSucursal=$(".SucursalSelect").val();
            }
            $.ajax({
                url: Routing.generate('sgusucursal_findByIdEmpresaCliente', { idempresacliente: idEmpresaCliente,idsucursal: idSucursal }),
                data: $(".SucursalSelect").val(),
                type: "post",
                success: function(json) {                    
                    //  $( "#show_form" ).html(json); 
                    //console.log(json);
                    // alert($(".PaisSelect").val());
                    $(".SucursalSelect").attr('disabled',false);
                    $( ".SucursalSelect" ).html(json);

                    // init();
                },
                error:function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
            });   
        });
        
        if($(".EmpresaClienteSelect").val()){
           // console.log($(".EmpresaClienteSelect").val());
            $( ".EmpresaClienteSelect" ).trigger('change');
            //$(".EmpresaPersonaSelect").attr('disabled',false);
        }
        
        // Cargo la empresa cliente apartir de la sucursal
        if($(".SucursalSelect").val()){
            var idSucursal=0;
            if($(".idSucursal").val() !== null){
                idSucursal=$(".SucursalSelect").val();
            }
            $.ajax({
                url: Routing.generate('sgusucursal_findEmpresaClienteByIdSucursal', { idsucursal: idSucursal }),
                data: $(".SucursalSelect").val(),
                type: "post",
                success: function(json) {                    
                //  $( "#show_form" ).html(json); 
                //console.log(json);
               // alert($(".PaisSelect").val());
                
                $( ".EmpresaClienteSelect" ).html(json);
                $( ".EmpresaClienteSelect" ).trigger('change');
                 // init();
                },
                error:function (xhr, ajaxOptions, thrownError) {
                 console.log(xhr);
                }
            });
           
           // $( ".EmpresaClienteSelect" ).trigger('change');
            //$(".EmpresaPersonaSelect").attr('disabled',false);
        }
       
    }
    init();
});