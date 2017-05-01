$(document).ready(function(){
    // Fileupload para subir el archivo de las cargas masivas de evaluados
    //console.log($( "#rht_rhtonlinebundle_sisarchivossubidostype_empresaCliente").attr('id'));
    if($( "#rht_rhtonlinebundle_sisarchivossubidostype_empresaCliente").attr('id') !== undefined){
        //console.log($( "#rht_rhtonlinebundle_sisarchivossubidostype_empresaCliente").attr('id'));
        $( "#rht_rhtonlinebundle_sisarchivossubidostype_empresaCliente").change(function(){
             // Solo si existe la empresa cliente
            if(!empty($( "#rht_rhtonlinebundle_sisarchivossubidostype_empresaCliente").val())){  

                $('#rht_rhtonlinebundle_sisarchivossubidostype_nombre').fileupload(
                {
                    dataType: 'json',
                    url: Routing.generate('sgupersona_cargue_masivo_evaluados_save'),        
                    done: function (e, data) {
                    $( "#mensaje_popup" ).html(data.result.message);
                   // $( "#mensaje_popup" ).dialog( "option", "height", 600 );
                   // $( "#mensaje_popup" ).dialog( "option", "width", 600 );
                    $( "#mensaje_popup" ).dialog( 'open' );
                    //console.log(data.result.message);

                       // objMsjCarga.dialog('close');
                    }, 
                    fail: function (e, res ,data){
                        $( "#mensaje_popup" ).html("Hubo un fallo en la carga del archivo, comuniquese con el administrador del sistema");
                        $( "#mensaje_popup" ).dialog( 'open' );
                    }
                }).bind('fileuploadstart', function (e) {        
                    //objMsjCarga.dialog('open');
                });
            }
            else{
                $( "#mensaje_popup" ).html("Empresa Cliente no puede ser vacía");
                $( "#mensaje_popup" ).dialog( 'open' );
            }

        });

        $('#rht_rhtonlinebundle_sisarchivossubidostype_nombre').change(function(){
            if(empty($( "#rht_rhtonlinebundle_sisarchivossubidostype_empresaCliente").val())){  
                $( "#mensaje_popup" ).html("Empresa Cliente no puede ser vacía");
                $( "#mensaje_popup" ).dialog( 'open' );
                $('#rht_rhtonlinebundle_sisarchivossubidostype_nombre').val('');
            }
        });
    }
    else{
      $('#rht_rhtonlinebundle_sisarchivossubidostype_nombre').fileupload(
        {
            dataType: 'json',
            url: Routing.generate('sgupersona_cargue_masivo_evaluados_save'),        
            done: function (e, data) {
            $( "#mensaje_popup" ).html(data.result.message);
           // $( "#mensaje_popup" ).dialog( "option", "height", 600 );
           // $( "#mensaje_popup" ).dialog( "option", "width", 600 );
            $( "#mensaje_popup" ).dialog( 'open' );
            //console.log(data.result.message);

               // objMsjCarga.dialog('close');
            }, 
            fail: function (e, res ,data){
                //alert("fail");
                //$( "#show_form" ).html(data);
                console.log('Falló');            
               // objMsjCarga.dialog('close');
            }
        }).bind('fileuploadstart', function (e) {        
            //objMsjCarga.dialog('open');
        });  
    }
    
    // para colocar el boton nuevo en los selects que se necesite
    if($("form[name='sgu_cargue_masivo_evaluados']").parent().attr("id") !== "show_form_emergente"){
        boton_nuevo();
    }
    
  });

