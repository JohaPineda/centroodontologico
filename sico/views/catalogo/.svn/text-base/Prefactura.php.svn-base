<?php defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>'); ?>

<div style="width: 100%; margin: 15px auto 0;">   
    <h1 class="titulossecciones">Prefactura</h1>     
    <?php $view->startForm("index.php?controlador=Citas&accion=simulador", "prefactura"); ?> 
    <table style="font-size: 12px" align="center" border="0" width="100%" >       
        <tr><td style="padding: 1px; width: 70px" bgcolor="#E4E4E4">Consultorio:</td> 
            <td style="padding: 1px; width: 200px" bgcolor="#F2F2F2">   
                <input type="text" disabled="disabled" name="consultorio" value="<?php echo $consultorio['nombreconsultorio']; ?>">
            </td>  
            <td style="padding: 1px; width: 70px" bgcolor="#E4E4E4">Servicio:</td>
            <td style="padding: 1px;width: 0px" bgcolor="#F2F2F2"> 
                <input disabled="disabled" type="text" name="servicio" value="<?php echo $consultorio['nombreservicio']; ?>">
            </td>                   
        </tr>       
        <tr>    
            <td style="padding: 1px" bgcolor="#E4E4E4" >Fecha de la cita</td>
            <td style="padding: 1px" bgcolor="#F2F2F2"> 
                Dia:&nbsp; <input disabled="disabled" size="3" type="text" name="dia" value="<?php echo $consultorio['dia']; ?>">
                Mes:&nbsp; <input disabled="disabled" size="3" type="text" name="mes" value="<?php echo $consultorio['mes']; ?>" >
                Año:&nbsp; <input disabled="disabled" size="4" type="text" name="anio" value="<?php echo $consultorio['anio']; ?>">
                Hora:&nbsp;<input disabled="disabled" size="4" type="text" name="hora" value="<?php echo $consultorio['horaformato']; ?>">  
            </td> 
            <td style="padding: 1px; margin: 10px" bgcolor="#E4E4E4">Medico:</td>
            <td style="padding: 1px" bgcolor="#F2F2F2"> 
                <input disabled="disabled" type="text" name="medico" value="<?php echo $consultorio['nombre']; ?>">
            </td>                 
        </tr>               
        <tr><td align="right" colspan="3"><strong>Valor Base:&nbsp;</strong></td><td align="left" style="padding: 5px" bgcolor="#F2F2F2"><input disabled="disabled" type="text" name="valorb" value="$<?php echo number_format($consultorio['valor'], 0, ",", "."); ?>"></td></tr>
        <tr><td align="right" colspan="3"><strong>IVA:&nbsp;</strong></td><td align="left" style="padding: 5px" bgcolor="#F2F2F2"><input disabled="disabled" type="text" name="iva" value="$<?php echo number_format(($consultorio['valor'] * 0.16), 0, ",", "."); ?>"></td></tr>
        <tr><td align="right" colspan="3"><strong>Total:&nbsp;</strong></td><td align="left" style="padding: 5px" bgcolor="#F2F2F2"><input disabled="disabled" type="text" name="total" value="$<?php echo number_format(($consultorio['valor'] + ($consultorio['valor'] * 0.16)), 0, ",", "."); ?>"></td></tr>
    </table>   
    <input type="hidden" name="dia" value="<?php echo $consultorio['dia']; ?>">
    <input type="hidden" name="mes" value="<?php echo $consultorio['mes']; ?>">
    <input type="hidden" name="anio" value="<?php echo $consultorio['anio']; ?>">
    <input type="hidden" name="idconsultorio" value="<?php echo $consultorio['idconsultorio']; ?>">
    <input type="hidden" name="idservicio" value="<?php echo $consultorio['idservicio']; ?>">
    <input type="hidden" name="idespecialista" value="<?php echo $consultorio['idespecialista']; ?>">
    <input type="hidden" name="horaoficial" value="<?php echo $consultorio['hora']; ?>">
    <input type="hidden" name="valor" value="<?php echo $consultorio['valor']; ?>">   
    <div class="titulos3" style="background-color:#F0F0F0; padding:5 0 5 10px">Medios de Pago</div>   
    <table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr> 
            <td width="1" rowspan="3" bgcolor="#C3C3C3"></td>
            <td height="1" bgcolor="#C3C3C3"></td>
            <td width="1" rowspan="3" bgcolor="#C3C3C3"></td>
        </tr>  
        <tr> 
            <td>
                <table width="100%">
                    <tr>
                        <td align="left">  
                            <div style="margin:10px 10px 10px 0px; text-align:left; float:left;"> 
                                <input name="tarjeta" type="radio" id="VISA" value="images/visa.gif" checked>   
                                <label for="VISA"><img src="images/visa.gif" align="absmiddle"></label> 
                            </div> 
                            <div style="margin:10px 10px 10px 0px; text-align:left; float:left" >
                                <input name="tarjeta" type="radio" id="MASTER" value="images/master.gif"> 
                                <label for="MASTER"><img src="images/master.gif" align="absmiddle"></label>
                            </div>
                            <div style="margin:10px 10px 10px 0px; text-align:left; float:left" >
                                <input name="tarjeta" type="radio" id="AMEX" value="images/amex.gif"> 
                                <label for="AMEX"><img src="images/amex.gif" align="absmiddle"></label>
                            </div>
                            <div style="margin:10px 10px 10px 0px; text-align:left; float:left" >
                                <input name="tarjeta" type="radio" id="DINERS" value="images/diners.gif"> 
                                <label for="DINERS"><img src="images/diners.gif" align="absmiddle"></label>
                            </div>        
                        </td> 
                    </tr> 
                </table> 
            </td>   
        </tr>
        <tr>  
            <td>
                <table width="15%" style=" clear:both">
                    <tbody>
                        <tr>  
                            <td>Cantidad de cuotas</td>
                            <td>   
                                <select style="width: 50px" name="cuota">         
                                    <?php
                                    $i;
                                    for ($i = 1; $i < 25; $i++) {
                                        ?> 
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>
                                </select>    
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    <p class="nuevo" style=" margin-top: 0px;margin-bottom: -62px; margin-right: 100px;">  
        <input type="submit" value="Continuar" style="width: 190px;"  href="index.php?controlador=Citas&accion=crearcita" >                                                        
    </p>

<?php $view->endForm(); ?>
    <p class="nuevo" style="text-align: center; margin-top: 0px; margin-bottom: -62px;">  
        <input type="submit" value="Cancelar" style="width: 190px;"  onclick="parent.$.fancybox.close();"> 
    </p>
<?php $view->startForm("index.php?controlador=Citas&accion=nuevacita", "ppaciente"); ?> 
    <p  class="nuevo" style=" text-align: left; margin-top: 0px; margin-left: 100px;">        
        <input  type="submit" value="Atras" style="width: 190px;" href="index.php?controlador=Citas&accion=nuevacita"></p>
<?php $view->endForm(); ?>
</div>
<script> 
    $(document).ready(function(){ 
        $("body").css('background', 'none'); 
        $("body").css('background-image', 'url(images/bg.png)');
        $("body").css('background-repeat', 'repeat'); 
    });  
</script>        