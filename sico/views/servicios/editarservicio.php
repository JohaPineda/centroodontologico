<?php
defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');
?>
 
<div style="width: 80%; margin: 15px auto 0;">   
    <h1 class="titulossecciones">Editar Servicio</h1>            
<?php $view->startForm("index.php?controlador=Servicios&accion=updateservicio", "formularioservicios"); ?>     
      <table style="font-size: 12px" align="center" border="0" width="100%">     
        <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4">Nombre del servicio</td>
            <td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;
                <?php $view->input("nombre", 
                        "text", 
                        "Nombre", 
                        array("required" => true, "text" => "regular", "minsize" => "5"),
                        array("size" => "30%", "maxlength" => "30", "value" => $servicios['nombre'])); 
                ?>
            </td>            
        <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4">Tiempo(Min)</td>
            <td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;
                <?php $view->input("tiempo", 
                        "numeric", 
                        "Tiempo (Min)", 
                        array("required" => true, "text" => "numeric", "minsize" => "1"), 
                        array("size" => "30%", "maxlength" => "5", "value" => $servicios['tiempo']));
                ?>
            </td>
        <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4">Valor</td>
            <td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;
                <?php $view->input("valor",
                        "numeric",
                        "Valor", 
                        array("required" => true, "text" => "numeric", "minsize" => "4"),
                        array("size" => "30%", "maxlength" => "10", "value" => $servicios['valor'])); 
                ?>            
            </td>
        <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4">Descripcion</td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<textarea name="descripcion" cols="23" rows="7"><?php echo $servicios["descripcion"];  ?></textarea></td>           
      </table>  
        <p class="nuevo" style="text-align: center; margin-top: 20px;">           
            <input type="hidden" name="idservicio" value="<?php echo $servicios["id"];  ?>"/>  
            <input type="submit" value="Guardar cambios" style="font-size: 22px"/> 
        </p> 
<?php $view->endForm(); ?>
</div>     
<script language="javascript">
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