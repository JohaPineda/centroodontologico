<?php defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>'); ?>
<div style="width: 90%; margin: 10px auto;">
    <h1 class="titulossecciones">Agregar especialista</h1>
    <?php $view->startForm("index.php?controlador=Usuarios&accion=insertEspecialista", "formContentVideo"); ?> 
    <table style="margin-top: 10px">
        <tr>                       
            <td style="padding-left: 10px; vertical-align: middle; padding-top: 15px">
                <label class="uname" style="vertical-align: middle;"> Nombre: </label> </br>           
                <?php
                $view->input("nombre", "text", "Nombre", array('required' => true, 'text' => 'regular', 'minsize' => '4'), array('size' => '50', 'maxlength' => '50', 'id' => 'inputname', 'value' => $nombre));
                ?>                   
            </td>
        </tr> 
        <tr>                       
            <td style="padding-left: 10px; vertical-align: middle; padding-top: 15px">
                <label class="uname" style="vertical-align: middle;"> Usuario: </label> </br>           
<?php
$view->input("usuario", "text", "Usuario", array("norepeat" => "val1",'required' => true, 'text' => 'regular', 'minsize' => '4'), array('size' => '50', 'maxlength' => '50', 'id' => 'inputname', 'value' => $nombre));
?>                   
            </td>
        </tr>
        <tr> 
            <td style="padding-left: 10px; vertical-align: middle; padding-top: 15px">
                <label class="uname" style="vertical-align: middle;"> Password: </label> </br>           
                <input id="password" size="30%" name="pass" id="pass" type="password" presence="val1" minsize="6" maxlength="18"/>                
            </td>
        </tr>  
        <tr> 
            <td style="padding-left: 10px; vertical-align: middle; padding-top: 15px">
                <label class="uname" style="vertical-align: middle;"> Consultorio: </label> </br>           
                <select name="consultorio"> 
                <?php foreach ($consultorios as $value) { ?>
                        <option value="<?php echo $value['id']?>"><?php echo $value['nombre']?></option>                        
                <?php } ?>
                </select>                  
            </td>
        </tr>
        <tr> 
            <td style="padding-left: 10px; vertical-align: middle; padding-top: 15px">
                <label class="uname" style="vertical-align: middle;"> Servicio: </label> </br>           
                <select name="servicio">
                    <?php foreach ($servicios as $value) { ?>
                    <option value="<?php echo $value['id']?>"><?php echo $value['nombre']?></option>                        
                <?php } ?>                   
                </select>                  
            </td>
        </tr>                 
    </table>                       
    <p class="nuevo" style="text-align: left; margin-top: 15px; padding-left: 10px">                                       
        <input type="submit" value="Aceptar" /> 
    </p>
<?php $view->endForm(); ?>
</div>
<script>     
    function message(mensaje,imagen){   
        $("#titlemesagge",window.parent.document).html("<strong>"+mensaje+"<strong/>");
        $("#iconmesagge",window.parent.document).html(" <img src='"+imagen+"'/>");       
        $("#barraf",window.parent.document).slideDown(1000).delay(3000).fadeIn(400);
        $("#barraf",window.parent.document).slideUp(1000).fadeOut(400);  
    }
    $(document).ready(function(){
        $("body").css('background', 'none'); 
        $("body").css('background-image', 'url(images/bg.png)');
        $("body").css('background-repeat', 'repeat');          
    });
</script>
