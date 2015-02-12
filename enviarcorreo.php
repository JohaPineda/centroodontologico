<?php  
//recepcion de datos
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$edad=$_POST['edad'];
$ciudad=$_POST['ciudad'];
$sexo=$_POST['sexo']; 
$mensaje=$_POST['mensaje'];  

//accion de envio de datos
$para='jhonmendex@gmail.com' ;
$asunto='contacto de mi web' ;
$mensajes='LOS DATOS DEL CLIENTE SON LOS SIGUIENTES : 

Nombre:       '.$nombre.'
Apellido:       '.$apellido.'
Edad:       '.$edad.'
Ciudad:       '.$ciudad.'
Sexo:       '.$sexo.'  
Comentarios:  '.$mensaje.'
';                  
$desde='From: MI SITIO WEB <info@sico.com>';
mail($para,$asunto,$mensajes,$desde); ?>
<script>  
alert("MENSAJE ENVIADO CON EXITO");
 location = "contacto.html"; 
</script> 




