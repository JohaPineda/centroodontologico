<?php defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>'); ?>

<div style="width: 75%; margin: 15px auto 0;">    
    <h1 class="titulossecciones">Pagos online</h1>    
    <div style="width:740px; background-color:#D8EAFD">  
        <font>Datos de la tarjeta</font> 
    </div>  
    <?php $view->startForm("index.php?controlador=Citas&accion=pagar", "prefactura"); ?>
    <table width="740" border="0" cellspacing="0" cellpadding="0" >
        <tr> 
            <td width="545"> 
                <table width="545" border="0" cellpadding="0" cellspacing="0">  
                    <tr>   
                        <td width="100" valign="middle"><div style="padding-bottom:18"> Tarjeta de crédito</div></td>  
                        <td valign="middle"><div style="padding-bottom:18"><img src="<?php echo $pagoonline["tarjeta"]; ?>" hspace="10" align="absmiddle" />  
                                <span style=" color: #0C3A8E; font-size: 13px;"><strong><?php echo $pagoonline["cuota"] . " cuotas de  $" . number_format(($pagoonline['valor'] / ($pagoonline['cuota'])), 0, ",", "."); ?></strong></span></div>
                        </td>
                    </tr>
                </table>
                <table width="545" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="165" valign="top"><div style="padding-bottom:8px;">Número de Tarjeta</div></td>
                        <td width="380" valign="top"><input  type="text" id="ccnumber" value="" maxlength="16" style="width:150px">
                            <div class="tipblue">Escribe sólo el número de tu tarjeta, sin dejar espacios,<br> ni agregar guiones.</div>
                            <div class="error" style="padding-bottom:2px"></div></td>
                    </tr>
                </table>
            </td>
            <td width="15"> </td> 
            <td valign="top"><div style="background: none repeat scroll 0 0 #FEFDE3; border: 1px solid #FEFA82; color: #000000; padding: 8px 8px 15px;">Todos los campos son obligatorios para solicitar la autorización. </div></td>
        </tr>
    </table>
    <table width="740" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="450">
                <table width="450" border="0" cellpadding="0" cellspacing="0" >
                    <tr>
                        <td valign="top"><div style="padding-bottom:8px">Vencimiento</div></td>
                        <td valign="top">
                            <select name="month" id="month"  style="width:40">  
                                <?php for ($i = 1; $i < 32; $i++) { ?><option><?php echo $i; ?></option><?php } ?>  
                            </select>
                            <select name="year" id="year" style="width:60">  
                                <?php for ($i = 2012; $i < 2020; $i++) { ?><option><?php echo $i; ?></option><?php } ?>   
                            </select>
                        </td>
                    </tr>
                    <tr> 
                        <td width="165" valign="top"><div style="padding-bottom:8px;">Código de Seguridad</div></td>
                        <td width="285" valign="top"><input type="text" id="seccode" value="" maxlength="3" style="width:40px" autocomplete="off">
                        </td>
                    </tr>	
                    <tr> 
                        <td valign="top"><div style="padding-bottom:8px;">Nombre y Apellido</div></td>
                        <td valign="top"><input type="text" id="nomyape" value="" maxlength="50" style="width:240px">
                            <div  style="color: #024EA3">Ingrésalos tal como  figuran en tu tarjeta.</div>  
                            <div style="padding-bottom:2px"></div><br></td>
                    </tr>
                    <tr>
                        <td valign="top"><div style="padding-bottom:13px; padding-top:5px;">Documento</div></td>
                        <td valign="top">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="148" valign="top" style="padding-top:5px;" >
                                        <span>
                                            <select id="dt" name="dt"  title="Tipo Documento">
                                                <option value="C.C." selected>C.C</option><option value="C.E." >C.E.</option>
                                            </select> 
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <table width="140%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="148" valign="top" s>Fecha de Expedición </td>
                                </tr>
                            </table>
                        </td> 
                        <td style="padding-bottom:5px;">
                            <?php $view->input("Fecha inicio", "calendar", "Fecha de Inicio", array(), array("size" => "20%")); ?>  
                        </td>
                    </tr>
                </table>
            </td> 
            <td width="275" valign="top"> 
                <div style="padding-bottom:5px; color: #767870"><strong>Código de Seguridad</strong></div>
                <div style="border: 1px dashed #AFB2B3; padding:5px">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="58" valign="top"><br><img src="images/number_card.gif" width="48" height="30" /></td>
                            <td style="color: #024EA3">Copia los 3 últimos números del código que figura debajo de la banda magnética. </td>
                        </tr> 
                    </table> 
                </div> 
                <div style="padding-bottom:5px; padding-top:6px; color: #767870"><strong>Nombre, Apellido y Vencimiento</strong></div>
                <div style="border:1px dashed #AFB2B3; padding:8"> 
                    <table border="0" cellspacing="0" cellpadding="0"> 
                        <tr> 
                            <td width="58" valign="top"><br><img src="images/name_addres_card.gif" width="48" height="30" /></td>
                            <td style="color: #024EA3">En el frente de tu tarjeta encontrarás el Nombre, Apellido y fecha de Vencimiento.</td>
                        </tr>
                    </table> 
                </div>
            </td>
        </tr>
    </table>
    <table width="740" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="545">
                <table width="545" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td height="60" colspan="3" valign="top"> 
                            <table width="545" border="0" cellpadding="0" cellspacing="0"> 
                                <tr>
                                    <td width="130" height="60" valign="top"><div>Dirección</div>
                                        <input type="text" id="address" value="" maxlength="50" style="width:340">
                                    </td> 
                                    <td width="160" height="60" valign="top"><div>Barrio</div>
                                        <input  type="text" id="comuna" value="" maxlength="50" style="width:160">
                                    </td>
                                    <td width="180" valign="top"><div>Ciudad</div>
                                        <input  type="text" id="ciudad" value="" maxlength="50" style="width:160">
                                    </td>  
                                </tr>
                            </table>
                        </td>
                    </tr>     
                    <tr>
                        <td valign="top"><div>País</div>  
                            <input  type="text" id="ciudad" value="" maxlength="50" style="width:160">
                        </td> 
                        <td height="60" valign="top"><div>Departamento</div>
                            <input type="text" id="ciudad" value="" maxlength="50" style="width:160">
                        </td>
                        <td valign="top"><div>Teléfono</div>
                            <input  type="text" id="tel" value="" maxlength="20" style="width:160">
                        </td>
                    </tr>
                </table>
            </td>
            <td valign="top"> 
                <div style="background: none repeat scroll 0 0 #FEFDE3; border: 1px solid #FEFA82; color: #000000; padding: 8px 8px 15px;">
                    <p>Ingresa los datos de la dirección que figuran en  el <strong>Extracto</strong> <strong>de tu tarjeta</strong>.  Debes <strong>copiarlos en forma exacta.</strong></p>
                </div>
            </td>
        </tr>
    </table>
    <p class="nuevo" style="text-align: center; margin-top: 10px;"> 
        <input type="hidden" value="<?php echo $pagoonline["dia"] ?>" name="dia">
        <input type="hidden" value="<?php echo $pagoonline["idespecialista"] ?>" name="idespecialista">
        <input type="hidden" value="<?php echo $pagoonline["idpaciente"] ?>" name="idpaciente">
        <input type="hidden" value="<?php echo $pagoonline["anio"] ?>" name="anio">
        <input type="hidden" value="<?php echo $pagoonline["mes"] ?>" name="mes">
        <input type="hidden" value="<?php echo $pagoonline["hora"] ?>" name="hora">
        <input type="hidden" value="<?php echo $pagoonline["valor"] ?>" name="valor">
        <input type="hidden" value="<?php echo $pagoonline["idconsultorio"] ?>" name="idconsultorio">

    <p class="nuevo" style=" margin-top: 0px;margin-bottom: -62px; margin-right: 10px;">  
        <input type="submit" value="Realizar pago" style="width: 190px;"  href="index.php?controlador=Citas&accion=pagar" >                                                        
    </p>

    <?php $view->endForm(); ?>
    <p class="nuevo" style="text-align: center; margin-top: 0px; margin-bottom: -62px;">  
        <input type="submit" value="Cancelar" style="width: 190px;"  onclick="parent.$.fancybox.close();"> 
    </p>
    <?php $view->startForm("index.php?controlador=Citas&accion=crearcita", "atras"); ?> 
    <input type="hidden" value="<?php echo $pagoonline["dia"] ?>" name="dia">
    <input type="hidden" value="<?php echo $pagoonline["idespecialista"] ?>" name="especialista">
    <input type="hidden" value="<?php echo $pagoonline["idconsultorio"] ?>" name="consultorio">
    <input type="hidden" value="<?php echo $pagoonline["idservicio"] ?>" name="servicio">
    <input type="hidden" value="<?php echo $pagoonline["anio"] ?>" name="anio">
    <input type="hidden" value="<?php echo $pagoonline["mes"] ?>" name="mes">
    <input type="hidden" value="<?php echo $pagoonline["hora"] ?>" name="hora">       
    <p  class="nuevo" style=" text-align: left; margin-top: 0px; margin-left: 10px;">        
        <input  type="submit" value="Atras" style="width: 190px;"></p>
        <?php $view->endForm(); ?>

</div> 
<script> 
    $(document).ready(function(){ 
        $("body").css('background', 'none'); 
        $("body").css('background-image', 'url(images/bg.png)');
        $("body").css('background-repeat', 'repeat'); 
    });  
</script>         