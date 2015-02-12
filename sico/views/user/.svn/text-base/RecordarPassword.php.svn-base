<?php
defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');
?>
<form id="passpaciente" action="index.php?controlador=RegistrarUsuario&accion=passwordpaciente" method="POST">
<table style="font-size: 12px" align="center" border="0" width="80%">
    <tr><td style="color: red;text-align: justify" colspan="2"> </td></tr>
    <tr><td colspan="2" width="15%" align="center" bgcolor="#81ACCD" style="color: white">&nbsp;HA OLVIDADO SU CONTRASEÑA?</td></tr>
    
    <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('USERNAME') ?>
        </td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;
            <?php $view->input("alias", "text", "Nombre de Usuario",
                    array("required" => true, "text" => "regular", "minsize" => "5"), 
                    array("size" => "30%", "maxlength" => "20")); ?>       
    <tr>
    <td colspan="2" background="../images/botones2.png" width="182">
        <div style="text-align:center">
            <br></br>
            <p class="nuevo" style="text-align:center">
                <input type="submit" value="Reestablecer Password" style="width: 245px;">
            </p>                             
        </div>
    </td>
    </tr>
</table>
</form>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script language="javascript">
    function message(mensaje,imagen){
        $("#titlemesagge",window.parent.document).html("<strong>"+mensaje+"<strong/>");
        $("#iconmesagge",window.parent.document).html(" <img src='"+imagen+"'/>");       
        $("#barraf",window.parent.document).slideDown(1000).delay(3000).fadeIn(400);
        $("#barraf",window.parent.document).slideUp(1000).fadeOut(400);        
    }
    $(document).ready(function(){
        $("body").css("background", "none");
        $('#passpaciente').ajaxForm({
            dataType: 'json',            
            beforeSubmit: function() {  
                 if(validates('passpaciente')){
                     return true;
                 }else{
                     return false;
                 }
                //$('#loader').css('display', 'block');
            },
            uploadProgress: function(event, position, total, percentComplete) {
            },
            success: function(responseText) { 
                
                //$('#loader').css('display', 'none');
                if(responseText.respuesta=='si'){    
                    parent.message('Se enviado su nueva contraseña al correo asociado al alias','images/iconosalerta/ok.png');
                    parent.$.fancybox.close();
                }else{
                    parent.message('El alias no existe en el sistema','images/iconosalerta/error.png');                    
                }
           //     $('#image').val('');
         //$('#myFormId').clearForm();
            }
        });
    });
</script>
