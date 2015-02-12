<?php
defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');
?>
<div id="hidden_clicker" style="display:none;">
    <a class="overlay-flash" id="hiddenclicker" href="#" >Hidden Clicker</a>
</div>

<h1 class="titulossecciones">Editar el perfil de <?php echo $paciente['alias']; ?></h1>
<?php $view->startForm("index.php?controlador=MiPerfil&accion=modificarMiperfil", "formularioPerfil"); ?>  
<fieldset style="border: solid 1px #000;">    
    <table style="font-size: 12px" align="center" border="0" width="80%">
        <legend>Información personal</legend>
        <tr><td rowspan="5">
                <ul id="secondGallery" class="image-overlay">
                    <li>
                        <a class="otros3" href="index.php?controlador=MiPerfil&accion=imageManager">
                            <div id="imagen">
                                <img  title=""  alt="plentiful" src="<?php echo $paciente['imagen'] ?>" />
                            </div>
                            <div style="top: -46px; background-color: rgb(97, 11, 56); color: rgb(255, 128, 0);" class="caption">
                                <h2><font style="font-size: 14px"><center>Cambiar imagen</center></font></h2>
                            </div>
                        </a> 
                    </li>      
                </ul>                                     </td></tr>   
        <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('FULL_NAME') ?></td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<?php $view->input("fullname", "text", "Nombre Completo", array("required" => true, "text" => "onlytext","minsize" => 8), array("size" => "30%","disabled" => 'disabled', "maxlength" => "40", "value" => $paciente['nombre'])); ?>  
        <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('CEDULA') ?></td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<?php $view->input("cedula", "numeric", "Cedula", array("required" => true, "text" => "numeric", "minsize" => 6), array("size" => "30%", "maxlength" => "12","disabled" => 'disabled', "value" => $paciente['cedula'])); ?>            
        <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('BORN_DATE') ?></td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<?php $view->input("fechanacimiento", "calendar", "fechanacimiento", array(), array("size" => "30%", "value" => $paciente['fechanacimiento'][0])); ?>  
        <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('USERNAME') ?></td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<?php $view->input("alias", "text", "Nombre de Usuario", array("required" => true, "text" => "regular", "minsize" => 5), array("size" => "30%","disabled" => 'disabled', "maxlength" => "20", "value" => $paciente['alias'])); ?>       
    </table>
</fieldset>
<fieldset style="border: solid 1px #000">
    <table style="font-size: 12px" align="center" border="0" width="80%">
        <legend>Información de Contacto</legend> 
        <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('MAIL') ?></td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<?php $view->input("correo", "text", "Correo", array("required" => true, "text" => "email", "minsize" => 15), array("size" => "30%", "maxlength" => "40", "value" => $paciente['correo'], "id" => "correo")); ?>            
        <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('ADDRESS') ?></td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<?php $view->input("direccion", "text", "Direccion", array("text" => "address", "minsize" => 10), array("size" => "30%", "maxlength" => "30", "value" => $paciente['direccion'], "id" => "direccion")); ?>
        <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('PHONE') ?></td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<?php $view->input("telefono", "numeric", "Telefono", array("text" => "numeric", "minsize" => 7), array("size" => "30%", "maxlength" => "10", "value" => $paciente['telefono'], "id" => "telefono")); ?>              
        <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('CELLPHONE') ?></td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<?php $view->input("celular", "numeric", "Celular", array("text" => "numeric", "minsize" => 10), array("size" => "30%", "maxlength" => "13", "value" => $paciente['celular'], "id" => "celular")); ?>                          
    </table>
</fieldset>
<td colspan="2" background="../images/botones2.png" width="182">
    <div style="text-align:center">
        <p class="nuevo" style="text-align:center">
            <input type="submit" value="Guardar Cambios" style="width: 150px">
        </p>

    </div>
</td>
<?php $view->endForm(); ?>
<?php $view->startForm("index.php?controlador=MiPerfil&accion=modificarPassword", "formularioPassword"); ?>
<fieldset style="border: solid 1px #000">
    <table style="font-size: 12px" align="center" border="0" width="80%">
        <legend> Cambio de Contraseña </legend>
        <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('PASSWORD') ?></td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<input id="password" size="30%" name="pass"  type="password" presence="val1" minsize="6" maxlength="18"/></td></tr>
        <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('CONFIRPASS') ?></td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<input id="confirpws"size="30%" name="cpass"  type="password" presence="val1" minsize="6" maxlength="18"/></td></tr>
    </table>
</fieldset>
<table>
    <td colspan="2" background="../images/botones2.png" width="182">
        <div style="text-align:center">
            <p class="nuevo" style="text-align:center; ">
                <input type="submit" value="Cambiar Password" style="width: 190px; margin-left: 354px">
            </p>
        </div>
    </td>
</table>
<?php $view->endForm(); ?>
<script src="http://malsup.github.com/jquery.form.js"></script>

<script language="javascript">
    
    $(document).ready(function(){
        $("#password").val("");
        $("#confirpws").val("");
        $('#formularioPerfil').ajaxForm({
            dataType: 'json',            
            beforeSubmit: function() {       
              
                //$('#loader').css('display', 'block');
            },
            uploadProgress: function(event, position, total, percentComplete) {
            },
            success: function(responseText) { 
                
                //$('#loader').css('display', 'none');
                if(responseText.respuesta=='si'){    
                    message('Se ha actualizado el perfil','images/iconosalerta/ok.png');                 
                    
                }else{
                    message('Ha ocurrido un error, intente mas tarde','images/iconosalerta/error.png');
                    
                }
                //     $('#image').val('');
                //$('#myFormId').clearForm();
            }
        });
        $('#formularioPassword').ajaxForm({
            dataType: 'json',            
            beforeSubmit: function() {                
                if($("#password").val()==$("#confirpws").val()){
                    return true;
                }else{
                    message('No coinciden las contraseñas','images/iconosalerta/error.png');
                    return false;
                }              
                //$('#loader').css('display', 'block');
            },
            uploadProgress: function(event, position, total, percentComplete) {
            },
            success: function(responseText) { 
                
                //$('#loader').css('display', 'none');
                if(responseText.respuesta=='si'){    
                    message('Ha cambiado su contraseña','images/iconosalerta/ok.png');
                    $("#password").val("");
                    $("#confirpws").val("");
                    
                }else{
                    message('Ha ocurrido un error, intente mas tarde','images/iconosalerta/error.png');                    
                }
                //     $('#image').val('');
                //$('#myFormId').clearForm();
            }
        });
        $(".otros3").fancybox({            
            'autoDimensions'       : false,
            'width'                : 560,
            'height'               : 330,
            'autoScale'            : false,
            'overlayOpacity'       : 0.9,
            'transitionIn'         : 'elastic',
            'transitionOut'        : 'fade',
            'speedIn'              :  500,
            'type'                 : 'iframe',            
            'hideOnOverlayClick'   : true,
            'overlayColor'         : '#000',
            'showCloseButton'      : false,
            'padding'              : 0, 
            'margin'               : 0
        });

    });
    
    $(window).load(function(){
        $("#secondGallery").ImageOverlay({ 
            border_color: "#005500",
            overlay_color: "#009900", 
            overlay_origin: "top", 
            overlay_text_color: "#FFFFFF"}); 
    });
</script>