function message(mensaje,imagen){
    $("#titlemesagge").html("<strong>"+mensaje+"<strong/>");
    $("#iconmesagge").html(" <img src='"+imagen+"'/>");       
    $("#barraf").slideDown(1000).delay(3000).fadeIn(400);
    $("#barraf").slideUp(1000).fadeOut(400);        
}
    
function validar(e) {         
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true;  
    if (tecla==48) return true;
    if (tecla==49) return true;
    if (tecla==50) return true;
    if (tecla==51) return true;
    if (tecla==52) return true;
    if (tecla==53) return true;
    if (tecla==54) return true;
    if (tecla==55) return true;
    if (tecla==56) return true;
    if (tecla==57) return true;    
    patron = /1/; //ver nota
    te = String.fromCharCode(tecla);
    return patron.test(te);
}
        
function presence(value){        
    var values={};   
    var retorno='';
    values['valor']=value;
    $.ajax({                
        type: "POST",
        dataType: "json",
        url: "index.php?controlador=Validation&accion=validar_presencia",
        data: values,
        async:false,
        success: function( response ) 
        {                            
            respuesta=response.result;
            mensaje=response.mensaje;
            if(respuesta=='true'){                                        
                retorno= 'ok';
            }else{                         
                retorno= mensaje;                  
            }
        },
        error: function( error ){
            alert( error );
        }
    });
    return retorno;
}
    
function patt(value, type, label, minsize){    
    var values={};   
    var retorno='';
    values['valor']=value; //valor a verificar
    values['type']=type; //val1                
    values['label']=label;
    values['minis']=minsize;       
    $.ajax({                
        type: "POST",
        dataType: "json",
        url: "index.php?controlador=Validation&accion=validar_pattern",
        data: values,
        async:false,
        success: function( response ) 
        {                            
            respuesta=response.result;
            mensaje=response.mensaje;            
            if(respuesta=='true'){                                        
                retorno='ok';
            }else{                        
                retorno=mensaje;                  
            }
        },
        error: function( error ){
            alert( error );
        }
    });
    return retorno;
}
    
function unique(value, key, label, name){    
    var values={};   
    var retorno='';
    values['valor']=value; //valor a verificar
    values['key']=key; //val1                
    values['label']=label;
    values['name']=name;
    $.ajax({                
        type: "POST",
        dataType: "json",
        url: "index.php?controlador=Validation&accion=validar_unica",
        data: values,
        async:false,
        success: function( response ) 
        {                            
            respuesta=response.result;
            mensaje=response.mensaje;
            if(respuesta=='true'){                                        
                retorno='ok';
            }else{                        
                retorno=mensaje;                  
            }
        },
        error: function( error ){
            alert( error );
        }
    });
    return retorno;
}
    
function validates(idform){
    $('.error_input').remove();
    var $inputs = $('#'+idform+' :input');         
    var submitAct=true;
    $inputs.each(function() {                                                          
        if($(this).attr('presence')){  
            var res=presence($(this).val());
            if(res=='ok'){
                if($(this).attr('patt')){
                    var res2=null;
                    if($(this).attr('minsize')){                           
                        res2=patt($(this).val(), $(this).attr('patt'), $(this).attr('label'), $(this).attr('minsize'));                       
                    }else{
                        res2=patt($(this).val(), $(this).attr('patt'), $(this).attr('label'),0);  
                    }                    
                    if(res2=='ok'){  
                        if($(this).attr('norepeat')){
                            var res3=unique($(this).val(), $(this).attr('norepeat'), $(this).attr('label'), $(this).attr('name'));
                            if(res3=='ok'){                                   
                                                       
                            }else{
                                submitAct= false;                                                                       
                                $(this).after('<div class="error_input" style="font-size: 12px; color: Red; font-weight: bold;">'+res3+'</div>');                                    
                            }
                        }                        
                    }else{
                        submitAct= false;
                        $(this).after('<div class="error_input" style="font-size: 12px; color: Red; font-weight: bold;">'+res2+'</div>');                                      
                    }
                }else{                            
            }
            }else{
                submitAct= false;
                $(this).after('<div class="error_input" style="margin-top:8px !important;font-size: 12px; color: Red; font-weight: bold;">'+res+'</div>');                                                             
            }                  
        }else{
            if($(this).val()!=''){
                if($(this).attr('patt')){
                    var res2=null;
                    if($(this).attr('minsize')){                           
                        res2=patt($(this).val(), $(this).attr('patt'), $(this).attr('label'), $(this).attr('minsize'));                       
                    }else{
                        res2=patt($(this).val(), $(this).attr('patt'), $(this).attr('label'),0);  
                    }
                    if(res2=='ok'){   
                        if($(this).attr('norepeat')){
                            var res3=unique($(this).val(), $(this).attr('norepeat'), $(this).attr('label'), $(this).attr('name'));
                            if(res3=='ok'){                                   
                                                       
                            }else{
                                submitAct= false;
                                $(this).after('<div class="error_input" style="font-size: 12px; color: Red; font-weight: bold;">'+res3+'</div>');                                        
                            }
                        }                                                             
                    }else{
                        submitAct= false;
                        $(this).after('<div class="error_input" style="font-size: 12px; color: Red; font-weight: bold;">'+res2+'</div>');                                        
                    }  
                }else{ 
                    if($(this).attr('norepeat')){
                        var res3=unique($(this).val(), $(this).attr('norepeat'), $(this).attr('label'), $(this).attr('name'));
                        if(res3=='ok'){                                   
                                                       
                        }else{
                            submitAct= false;
                            $(this).after('<div class="error_input" style="font-size: 12px; color: Red; font-weight: bold;">'+res3+'</div>');                                        
                        }
                    }    
                }    
            }
        }
    });  
    if(submitAct){        
        return true;
    }else{
        message('Verifique los datos ingresados','images/iconosalerta/error.png');
        return false;
    }
}
    
$(document).ready(function() {                            
    $('input.onepic').simpleDatepicker({
        startdate: 1920,    
        enddate: 2014 ,
        x: 20, 
        y: 20
    });
});

function mueveReloj(){
    momentoActual = new Date();
    hora = momentoActual.getHours();
    minuto = momentoActual.getMinutes();
    segundo = momentoActual.getSeconds();

    str_segundo = new String (segundo);
    if (str_segundo.length == 1){
        segundo = "0" + segundo;
    }
    str_minuto = new String (minuto);
    if (str_minuto.length == 1){
        minuto = "0" + minuto;
    }
    str_hora = new String (hora);
    if (str_hora.length == 1){
        hora = "0" + hora;
    }
    horaImprimible = hora + ":" + minuto + ":" + segundo;
    $("#horafecha").html(horaImprimible); 
    setTimeout("mueveReloj()",1000)
}

$(window).ready(function() {                            
    mueveReloj();    
});