$(document).ready(function(){
    $('#rht_rhtonlinebundle_prupruebatype_archivo').fileupload({
        dataType: 'json',
        url: Routing.generate('pruprueba_cargue_masivo_save'),        
        done: function (e, data) {
            $( "#mensaje_popup" ).html(data.result.message); 
            $( "#mensaje_popup" ).dialog( 'open' );
            objMsjCarga.dialog('close');
        }, 
        fail: function (e, res ,data){            
            console.log(data);            
            objMsjCarga.dialog('close');
        }
    }).bind('fileuploadstart', function (e) {        
        objMsjCarga.dialog('open');
    })   
  });
