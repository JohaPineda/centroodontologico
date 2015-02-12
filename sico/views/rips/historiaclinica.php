<?php defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>'); ?>

<div class="legend2">   
    <h1 class="titulossecciones">Historia Clinica</h1>
    <form id="formulariohistoria" onsubmit="return validates($(this).attr('id'))" action="index.php?controlador=Consulta&accion=procedimiento"  method="POST">    
       <div style="width:100%; float: left; padding: 5px">    
           <fieldset>          
               <legend>Datos filiatorios</legend> 
               <table width="100%" border="0">      
                   <tr>    
                       <td style="padding: 5px" colspan="2">Fecha: <input disabled="disabled"  type="text" size="10" value="<?php echo date("Y-m-d"); ?>" presence="val1"></td>    
                   </tr>   
                   <tr><td>
                        <table border="0">   
                            <tr>           
                                <td style="padding: 5px; background-color: #CAE8EA; font-size: 10px">Nombre y apellido:</td>
                                <td style="background-color: #F5FAFA">
                                    <input disabled="disabled" type="text" size="60" value="<?php echo $detalles[0]['nombrepaciente'] ?>" presence="val1"></td>
                                <td style="padding: 5px; background-color: #CAE8EA">Edad:</td><td style="background-color: #F5FAFA">
                                    <input value="<?php echo $detalles[0]['edad'] ?>" disabled="disabled" type="text" size="10" presence="val1"></td> 
                            <td style="padding: 5px; background-color: #CAE8EA">Sexo:</td><td style="background-color: #F5FAFA"> M <input type="radio" name="sexo" value="Masculino" size="10" > F <input type="radio" name="sexo" value="Femenino" size="10" ></td>
                     
                            <td style="padding: 5px; background-color: #CAE8EA">Identificacion:</td><td style="background-color: #F5FAFA"><input value="<?php echo $detalles[0]['cedula'] ?>" disabled="disabled" type="text" size="20" presence="val1"></td> 
                            </tr>  
                            <tr>      
                                <td style="padding: 5px; background-color: #CAE8EA">Email:</td><td style="background-color: #F5FAFA"><input value="<?php echo $detalles[0]['correo'] ?>" disabled="disabled" type="text" size="60" presence="val1"></td>  
                              <td style="padding: 5px; background-color: #CAE8EA" colspan="3">Fecha de nacimiento:</td>  
                              <td style="padding: 5px ; background-color: #F5FAFA" colspan="5"><input value="<?php echo $detalles[0]['fnacimiento'] ?>" disabled="disabled" type="text" size="20" presence="val1"></td>
                            </tr> 
                            <tr> 
                                <td colspan="2"></td>  
                                <td colspan="3" style="padding: 5px; background-color: #CAE8EA">Telefono:</td><td style="background-color: #F5FAFA"><input value="<?php echo $detalles[0]['telefono'] ?>" disabled="disabled" type="text" size="10" presence="val1"></td>
                                <td style="padding: 5px; background-color: #CAE8EA">Celular:</td><td style="background-color: #F5FAFA"><input value="<?php echo $detalles[0]['celular'] ?>" disabled="disabled" type="text" size="10" presence="val1"></td>
                            </tr>                            
                        </table> 
                       </td>
                   </tr>
               </table>
           </fieldset>
       </div> 
       <div style="width:100%; float: left; padding: 5px">    
           <fieldset>          
               <legend>Datos de la consulta</legend> 
               <table width="100%" border="0">        
                   <tr>        
                       <td style="padding: 5px; background-color: #CAE8EA">Motivo de la consulta: </td><td style="background-color: #F5FAFA"><input  type="text" value="<?php echo $detalles[0]['servicio'] ?>" disabled="disabled" size="20" presence="val1"></td>   
                       <td style="padding: 5px; background-color: #CAE8EA">Especialista: </td><td style="background-color: #F5FAFA"><input value="<?php echo $detalles[0]['especialista'] ?>" disabled="disabled" type="text" size="20" presence="val1"></td>   
                       <td style="padding: 5px; background-color: #CAE8EA">Dolor: </td><td> Si <input name="dolor" value="si" type="radio" size="20"> No <input name="dolor" value="no" type="radio" size="20"></td>   
                       <td style="padding: 5px; background-color: #CAE8EA">Sangrado en las encias: </td><td style="background-color: #F5FAFA"><input name="sangrado"  type="text" size="20" presence="val1"></td>    
                   </tr>   
                   <tr>      
                       <td style="padding: 5px; background-color: #CAE8EA">Diagnostico y plan de tratamiento:</td><td style="padding: 5px;background-color: #F5FAFA" colspan="7"><textarea name="diagnostico" cols="100" rows="7" presence="val1"></textarea></td>
                   </tr> 
                   <tr>      
                       <td style="padding: 5px; background-color: #CAE8EA">Secuencia del tratamiento:</td>
                       <td style="padding: 5px" colspan="7"> 
                           <table border="0" width="100%">
                               <thead>
                                   <tr>  
                                       <td align="center" style="padding: 5px; background-color: #CAE8EA"><strong>FECHA</strong></td>
                                       <td style="padding: 5px; background-color: #CAE8EA"><strong>DESCRIPCION DEL TRATAMIENTO</strong></td>
                                   </tr>
                               </thead>
                               <tbody>
                                  <?php
                                    $estilo = 1; 
                                    foreach ($detalles[1] as $value) {  
                                   ?>  
                                   <tr class="<?php echo $estilo; ?>"> 
                                       <td align="center" class="alt" style="background: #ffffff"> 
                                           <?php echo $value["fecha"] ?>  
                                       </td>     
                                       <td align="left" class="alt" style="background: #ffffff;"> 
                                           <?php echo '<strong>Presenta Sangrado : </strong>'. $value["sangrado"] ?> &nbsp;&nbsp;<?php echo '<strong>Presenta dolor : </strong>'. $value["dolor"] ?>&nbsp;&nbsp;<?php echo "<strong>Diagnostico presentado : </strong>".$value["diagnostico"] ?>
                                           &nbsp;&nbsp;<?php echo "<strong>Atendido por el Dr. </strong>".$value["nombree"] ?> 
                                       </td>
                                   </tr> 
                                   <?php
                                        if ($estilo == 1) {
                                            $estilo = 2;
                                        } else {
                                            $estilo = 1; 
                                        }
                                    }
                                    ?> 
                               </tbody>
                           </table>    
                       </td>
                   </tr>                     
               </table>  
           </fieldset>
        <table border="0"> 
            <tr><td>
        <p class="nuevo" style="text-align: center; margin-top: 0px;">
            <input type="submit" value="Guardar historia" style="width: 190px; margin-left: 354px">  
            <input type="hidden" name="idpaciente" value="<?php echo $detalles[0]['id'] ?>" >    
            <input type="hidden" name="idcita" value="<?php echo $detalles[0]['idcita'] ?>" >    
        </p> </td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>
        <p class="nuevo" style=" margin-top: 0px;margin-bottom: 0px; margin-right: 100px;">  
        <input type="submit" value="Imprimir orden" style="width: 190px;" onclick="window.print();" >                                                          
        </p> </td> </tr>
        </table>            
       </div> 
    </form>
</div>
<script>
    $(document).ready(function(){
       $("body").css('background', 'none'); 
        $("body").css('background-image', 'url(images/bg.png)');
        $("body").css('background-repeat', 'repeat');   
    });        
</script>  