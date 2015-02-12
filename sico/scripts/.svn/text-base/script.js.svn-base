function terminarfin(myurl){
    $("#imagen",window.parent.document).html('<img title=""  alt="abc" src="'+myurl+'" />');
    parent.message('Imagen subida con exito','images/iconos_alerta/ok.png');
    parent.$.fancybox.close();
}
$(function(){
	
    var dropbox = $('#dropbox'),
    message = $('.message', dropbox);	
    dropbox.filedrop({		
        paramname:'pic',		
        maxfiles: 1,
        maxfilesize: 2,
        url: 'index.php?controlador=MiPerfil&accion=subirimagenAjax',		
        uploadFinished:function(i,file,response){                        
            $.data(file).addClass('done');
            setTimeout("terminarfin('"+response.newurl+"')",2000)			
        },
		
        error: function(err, file) {
            switch(err) {
                case 'BrowserNotSupported':
                    showMessage('Su navegador de internet no soporta subir archivos');
                    break;
                case 'TooManyFiles':
                    alert('Solo se permite subir un archivo');
                    break;
                case 'FileTooLarge':
                    alert(file.name+' Archivo my grande, maximo 2Mb.');
                    break;
                default:
                    break;
            }
        },
		
        // Called before each upload is started
        beforeEach: function(file){
            if(!file.type.match(/^image\//)){
                alert('Solo se permiten imagenes');
				
                // Returning false will cause the
                // file to be rejected
                return false;
            }
        },
		
        uploadStarted:function(i, file, len){
            createImage(file);
        },
		
        progressUpdated: function(i, file, progress) {
            $.data(file).find('.progress').width(progress);
        }
    	 
    });
	
    var template = '<div class="preview">'+
    '<span class="imageHolder">'+
    '<img />'+
    '<span class="uploaded"></span>'+
    '</span>'+
    '<div class="progressHolder">'+
    '<div class="progress"></div>'+
    '</div>'+
    '</div>'; 
	
	
    function createImage(file){

        var preview = $(template), 
        image = $('img', preview);
			
        var reader = new FileReader();
		
        image.width = 100;
        image.height = 100;
		
        reader.onload = function(e){
			
            // e.target.result holds the DataURL which
            // can be used as a source of the image:
			
            image.attr('src',e.target.result);
        };
		
        // Reading the file as a DataURL. When finished,
        // this will trigger the onload function above:
        reader.readAsDataURL(file);
		
        message.hide();
        preview.appendTo(dropbox);
		
        // Associating a preview container
        // with the file, using jQuery's $.data():
		
        $.data(file,preview);
    }

    function showMessage(msg){
        message.html(msg);
    }

});