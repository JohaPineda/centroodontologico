<?php
defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');
?>
   
<div style="width: 80%; margin: 15px auto 0;">   
    <h1 class="titulossecciones">Editar Especialista</h1>             
<?php $view->startForm("index.php?controlador=Usuarios&accion=updateespecialista", "formularioservicios"); ?>     
      <table style="font-size: 12px" align="center" border="0" width="100%">      
        <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4">Nombre</td><td style="padding-left: 10px" align="left" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<?php $view->input("nombre", "text", "nombre", array("required" => true, "text" => "text", "minsize" => 15), array("size" => "30%", "maxlength" => "40", "value" => $especialista['nombre'], "id" => "correo")); ?></td></tr>          
        <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4">Consultorio</td>
            <td style="padding-left: 10px" align="left" width="15%" height="40px" bgcolor="#F0F0F0"> 
                <select name="consultorio" id="consutorio"> 
                <?php foreach ($consultorios as $value) { ?>   
                    <option value="<?php echo $value['id']?>"><?php echo $value['nombre']?></option>                        
                <?php } ?>
                </select>                        
            </td> 
        </tr>
        <tr> 
            <td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4">Servicio</td>
            <td style="padding-left: 10px" align="left" width="15%" height="40px" bgcolor="#F0F0F0">
                 <select name="servicio" id="servicio">
                    <?php foreach ($servicios as $value) { ?>
                    <option value="<?php echo $value['id']?>"><?php echo $value['nombre']?></option>                        
                <?php } ?>                   
                </select>                 
            </td>
        </tr>
      </table>   
        <p class="nuevo" style="text-align: center; margin-top: 20px;">             
            <input type="hidden" name="idespecialista" value="<?php echo $especialista["id"];  ?>"/>  
            <input type="submit" value="Guardar cambios" style="font-size: 22px"/> 
        </p> 
<?php $view->endForm(); ?> 
</div>    
  
<script src="http://malsup.github.com/jquery.form.js"></script>
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
        $("#consutorio").val(<?php echo $especialista['idcons']; ?>); 
        $("#servicio").val(<?php echo $especialista['idserv']; ?>);   
    }); 
 </script>   