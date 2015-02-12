<?php
defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');
?>
<form method="POST" action="index.php?controlador=Admoncitas&accion=insertarpaciente" id="formularioPaciente">
<table style="font-size: 12px" align="center" border="0" width="80%">
    <tr><td style="color: red;text-align: justify" colspan="2">NOTA: Registre sus datos para poder solicitar una cita </td></tr>
    <tr><td colspan="2" width="15%" align="center" bgcolor="#81ACCD" style="color: white">&nbsp;REGISTRO DE DATOS DE USUARIO</td></tr>
    <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('FULL_NAME') ?></td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<?php $view->input("fullname", "text", "Nombre Completo", array("required" => true, "text" => "onlytext", "minsize" => "8"), array("size" => "30%", "maxlength" => "40")); ?>  
    <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('CEDULA') ?>(*)</td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<?php $view->input("cedula", "numeric", "Cedula", array("norepeat" => "val3","required" => true, "text" => "numeric", "minsize" => "6"), array("size" => "30%", "maxlength" => "12", "value"=>$cedula, "id"=>"cedula")); ?>            
    <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('BORN_DATE') ?></td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<?php $view->input("fechanacimiento", "calendar", "Fecha de Nacimiento", array(), array("size" => "30%")); ?>  
    <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('USERNAME') ?>(*)</td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<?php $view->input("alias", "text", "Nombre de Usuario", array("norepeat" => "val1","required" => true, "text" => "regular", "minsize" => "5"), array("size" => "30%", "maxlength" => "20")); ?>       
    <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('MAIL') ?></td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<?php $view->input("correo", "text", "Correo", array("required" => true, "text" => "email", "minsize" => "15"), array("size" => "30%", "maxlength" => "40")); ?>            
    <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4">Direccion</td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<?php $view->input("direccion", "text", "Direccion", array("text" => "address", "minsize" => "10"), array("size" => "30%", "maxlength" => "30")); ?>
    <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('PHONE') ?></td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<?php $view->input("telefono", "numeric", "Telefono", array("text" => "numeric", "minsize" => "7"), array("size" => "30%", "maxlength" => "10")); ?>              
    <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('CELLPHONE') ?></td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<?php $view->input("celular", "numeric", "Celular", array("text" => "numeric", "minsize" => "10"), array("size" => "30%", "maxlength" => "13")); ?>              
    <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('PASSWORD') ?></td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<input id="password" size="30%" name="pass" id="pass" type="password" presence="val1" minsize="6" maxlength="18"/></td></tr>
    <tr><td style="padding-left: 10px" width="30%" bgcolor="#E4E4E4"><?php $doc->texto('CONFIRPASS') ?></td><td align="center" width="15%" height="40px" bgcolor="#F0F0F0">&nbsp;<input id="confirpws"size="30%" name="cpass" id="cpass" type="password" presence="val1" minsize="6" maxlength="18"/></td></tr>
    <td colspan="2" background="../images/botones2.png" width="182">
        <div style="text-align:center">
            <p class="nuevo" style="text-align:center">
                <input type="submit" value="Registrarse">
            </p>

        </div>
    </td>
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
        $('#formularioPaciente').ajaxForm({
            dataType: 'json',            
            beforeSubmit: function() {    
                if(validates('formularioPaciente')){
                    if($("#password").val()==$("#confirpws").val()){
                        return true;
                    }else{
                        parent.message('No coinciden las contraseñas','images/iconosalerta/error.png');
                        return false;
                    }
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
                    parent.message('Registro Existoso','images/iconosalerta/ok.png');
                    window.location="index.php?controlador=Admoncitas&accion=nuevacita&cedula="+$('#cedula').val();
                }else{
                    parent.message('Ha ocurrido un error, intente mas tarde','images/iconosalerta/error.png');
                    parent.$.fancybox.close();
                }
                //     $('#image').val('');
                //$('#myFormId').clearForm();
            }
        });
    });
</script>