<?php defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>'); ?>

<div style="width: 80%; margin: 15px auto 0;">  
    <h1 class="titulossecciones">Editar cita</h1> 
    <form action="index.php?controlador=Admoncitas&accion=editarcitaadmin"  method="POST" onsubmit="return verificar($(this).attr('id'))" id="formnuevacita">                   
        <table style="font-size: 12px" align="center" border="0" width="100%" >                               
            <tr><td style="padding: 5px" width="50%" bgcolor="#E4E4E4">Seleccione el consultorio:</td> 
                <td style="padding: 5px" width="50%" bgcolor="#F2F2F2">   
                    <select id="consultorio" name="consultorio">                       
                        <option value="<?php echo $idconsultorio; ?>"><?php echo $consultorio; ?></option>                       
                    </select>                                                       
                </td>
            </tr>  
            <tr><td style="padding: 5px" width="50%" bgcolor="#E4E4E4">Seleccione el servicio:</td>
                <td style="padding: 5px" width="50%" bgcolor="#F2F2F2">                                                        
                    <select id="servicio" name="servicio">
                        <option value="<?php echo $idservicio; ?>"><?php echo $servicio; ?></option>                                                                       
                    </select> 
                </td>
            </tr>                                      
            <tr><td style="padding: 5px" width="30%" bgcolor="#E4E4E4">Seleccione el médico:</td>
                <td style="padding: 5px" width="50%" bgcolor="#F2F2F2"> 
                    <select id="medico" name="especialista">
                        <?php foreach ($medico as $value3) { ?>
                            <option value="<?php echo $value3['idespecialista']; ?>"><?php echo $value3['nombre']; ?></option> 
                        <?php } ?>
                    </select> 
                </td>
            </tr>   
            <tr><td style="padding: 5px" width="30%" bgcolor="#E4E4E4">Seleccione el Mes:</td>
                <td style="padding: 5px" width="50%" bgcolor="#F2F2F2"> 
                    <select id="mes" name="mes">
                        <?php foreach ($mes as $value4) { ?>
                            <option value="<?php echo $value4['valor']; ?>"><?php echo $value4['mes']; ?></option>
                        <?php } ?>
                    </select> 
                </td>
            </tr>   
            <tr><td style="padding: 5px" width="30%" bgcolor="#E4E4E4">Seleccione el Día:</td>
                <td style="padding: 5px" width="50%" bgcolor="#F2F2F2"> 
                    <select id="dia" onselect="selected" name="dia" >
                        <?php foreach ($dias as $value5) { ?>
                            <option value="<?php echo $value5; ?>"><?php echo $value5; ?></option>
                        <?php } ?>
                    </select> 
                </td> 
            </tr> 
            <tr><td style="padding: 5px" width="30%" bgcolor="#E4E4E4">Seleccione la Hora:</td>
                <td style="padding: 5px" width="50%" bgcolor="#F2F2F2"> 
                    <?php if (sizeof($hora) != 0) { ?>
                        <select id="hora" name="hora">
                            <?php foreach ($hora as $key => $value6) { ?>
                                <option value="<?php echo $key; ?>"><?php echo $value6; ?></option>
                            <?php } ?>
                        </select>  
                        <p id="nocita" style="display: none"> No hay citas disponibles para el dia seleccionado</p>
                    <?php } else { ?>
                        <select id="hora" name="hora" style="display: none">
                        </select>  
                        <p id="nocita"> No hay citas disponibles para el dia seleccionado</p>
                    <?php } ?>
                </td>
            </tr>               
        </table>  
        <p class="nuevo" style="text-align: center; margin-top: 20px;"> 
            <input type="hidden" name="idcita" value="<?php echo $idcita; ?>">
            <input type="submit" value="Editar" style="width: 190px; " >           
        </p> 
        <div id="loader" style="margin-left: 20px; display: none;">
            <img src="images/ajax-loader.gif" width="45" height="45"/>
        </div>
    </form>
</div>

<script>
    
    $(document).ready(function(){ 
        $("#mes").val("<?php echo $servicios["mes"] ?>");  
        $("#dia").val("<?php echo $servicios["dia"] ?>");  
        $("body").css('background', 'none'); 
        $("body").css('background-image', 'url(images/bg.png)');
        $("body").css('background-repeat', 'repeat');     
        $('#consultorio').change(function(){
            var values={idconsultorio: $('#consultorio').val(), idservicio: $('#servicio').val(),mes: $('#mes').val(),dia: $('#dia').val()};
            $.ajax({
                type: "POST",               
                dataType: "json",                 
                url: "index.php?controlador=Citas&accion=ajaxespecialistas",
                data: values,
                beforeSend : function(xhr, opts){
                    $('#loader').css("display","block");
                },
                success: function( response )
                {    
                    $('#loader').css("display","none");
                    $('#hora').html('');
                    if(response[1].length==0){
                        $('#hora').hide();
                        $('#nocita').show();
                    }else{
                        for(var b in response[1]){
                            var option = $("<option>").attr({'value': b}).appendTo("#hora");
                            option.html(response[1][""+b+""]);
                        }
                        $('#hora').show();
                        $('#nocita').hide();
                    }                    
                    $('#medico').html('');
                    for(var i = 0; i < response[0].length; i++){
                        var option = $("<option>").attr({'value': response[0][i]['idespecialista']}).appendTo("#medico");
                        option.html(response[0][i]['nombre']);
                    }                            
                },
                error: function( error ){
                    alert( error );
                }
            });                        
        });
        $('#servicio').change(function(){
            var values={idconsultorio: $('#consultorio').val(), idservicio: $('#servicio').val(),mes: $('#mes').val(),dia: $('#dia').val()};
            $.ajax({
                type: "POST",               
                dataType: "json",              
                url: "index.php?controlador=Citas&accion=ajaxespecialistas",
                data: values,
                beforeSend : function(xhr, opts){
                    $('#loader').css("display","block");
                },
                success: function( response )
                {                      
                    $('#loader').css("display","none");                                        
                    $('#hora').html('');
                    if(response[1].length==0){
                        $('#hora').hide();
                        $('#nocita').show();
                    }else{
                        for(var b in response[1]){
                            var option = $("<option>").attr({'value': b}).appendTo("#hora");
                            option.html(response[1][""+b+""]);
                        }    
                        $('#hora').show();
                        $('#nocita').hide();
                    }
                    $('#medico').html('');
                    for(var i = 0; i < response[0].length; i++){
                        var option = $("<option>").attr({'value': response[0][i]['idespecialista']}).appendTo("#medico");
                        option.html(response[0][i]['nombre']);
                    }                          
                },
                error: function( error ){
                    alert( error );
                }
            });       
        });    
        $('#mes').change(function(){
            var values={numeromes: $('#mes').val(),idespecialista: $('#medico').val(),idservicio: $('#servicio').val()};
            $.ajax({
                type: "POST",               
                dataType: "json",              
                url: "index.php?controlador=Citas&accion=ajaxdias",
                data: values,
                beforeSend : function(xhr, opts){
                    $('#loader').css("display","block");
                },
                success: function( response )
                {    
                    $('#loader').css("display","none");                      
                    $('#hora').html('');
                    if(response.horas.length==0){
                        $('#hora').hide();
                        $('#nocita').show();
                    }else{
                        for(var b in response.horas){
                            var option = $("<option>").attr({'value': b}).appendTo("#hora");
                            option.html(response.horas[""+b+""]);
                        }
                        $('#hora').show();
                        $('#nocita').hide();
                    }
                    
                    $('#dia').html('');
                    for(var b in response.dias){
                        var option = $("<option>").attr({'value': response.dias[""+b+""]}).appendTo("#dia");
                        option.html(response.dias[""+b+""]);
                    }                    
                },
                error: function( error ){
                    alert( error );
                }
            });
        });
        $('#medico').change(function(){
            var values={numeromes: $('#mes').val(), dia: $('#dia').val(),idespecialista: $('#medico').val(),idservicio: $('#servicio').val()};
            $.ajax({
                type: "POST",               
                dataType: "json",              
                url: "index.php?controlador=Citas&accion=ajaxhorasmes",
                data: values,
                beforeSend : function(xhr, opts){
                    $('#loader').css("display","block");
                },
                success: function( response )
                {    
                    $('#loader').css("display","none");  
                    $('#hora').html('');
                    if(response[0].length==0){
                        $('#hora').hide();
                        $('#nocita').show();
                    }else{
                        for(var b in response[0]){
                            var option = $("<option>").attr({'value': b}).appendTo("#hora");
                            option.html(response[0][""+b+""]);
                        }       
                        $('#hora').show();
                        $('#nocita').hide();
                    }
                },
                error: function( error ){
                    alert( error );
                }
            });
        });
        $('#dia').change(function(){
            var values={numeromes: $('#mes').val(), dia: $('#dia').val(),idespecialista: $('#medico').val(),idservicio: $('#servicio').val()};
            $.ajax({
                type: "POST",               
                dataType: "json",              
                url: "index.php?controlador=Citas&accion=ajaxhorasmes",
                data: values,
                beforeSend : function(xhr, opts){
                    $('#loader').css("display","block");
                },
                success: function( response )
                {    
                    $('#loader').css("display","none");                      
                    $('#hora').html('');
                    if(response[0].length==0){
                        $('#hora').hide();
                        $('#nocita').show();
                    }else{
                        for(var b in response[0]){
                            var option = $("<option>").attr({'value': b}).appendTo("#hora");
                            option.html(response[0][""+b+""]);
                        }
                        $('#hora').show();
                        $('#nocita').hide();
                    }
                },
                error: function( error ){
                    alert( error );
                }
            });
        });
        
        
    });  
    
    function verificar(id){        
        rta=false;
        if($('#hora > option').length == 0 ||($('#cedula').val()).length==0 ){            
            parent.message("No se puede crear una nueva cita","images/iconosalerta/error.png");
            return false;
        }else{
            $.ajax({
                type: "POST",               
                dataType: "json",              
                url: "index.php?controlador=Admoncitas&accion=ajaxverificarpaciente",
                data: {cedula: $('#cedula').val()},      
                async: false,
                success: function( responseText )
                {    
                    if(responseText.respuesta=='si'){
                        rta=true;
                    }else{
                        parent.message('El paciente no existe','images/iconosalerta/error.png');
                        rta=false;
                        window.location="index.php?controlador=RegistrarUsuario";
                        
                    }
                },
                error: function( error ){
                    alert( error );
                }
            });  
            return rta;
        }        
    }   
    
</script>