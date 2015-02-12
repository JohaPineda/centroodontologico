<?php defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>'); ?>
<div style="width: 80%; margin: 15px auto 0;">
    <h1 class="titulossecciones">Mi perfil</h1>         
    <?php $view->startForm("index.php?controlador=Catalogo&accion=finisheditMarca", "formMarca"); ?> 
    <table style="margin-top: 10px">
        <tr>
            <td>
                <label class="uname" style="vertical-align: middle;"> Nombre de Marca: </label>
            </td>
            <td style="padding-left: 10px; vertical-align: middle;">
                <?php
                $view->input("name_marca", "text", "Nombre Marca", array('required' => true, 'text' => 'regular', 'minsize' => '4'), array('size' => '50', 'maxlength' => '50', 'value' => $marcaedit['nombre']));
                ?>                   
            </td>
        </tr>            
    </table>
    <div style="margin: 22px 0 5px;"> 
        <label class="uname" style="vertical-align: middle;padding-left: 10px"> Logo: </label>
        <ul id="secondGallery" class="image-overlay">
            <li>
                <a href="Catalogo_imageMarca_marcaid_<?php echo $marcaedit['id']; ?>">
                    <div id="nonemig">
                        <img title=""  alt="plentiful" src="<?php echo $marcaedit['logo']; ?>" />                        
                    </div>
                    <div style="top: -46px;" class="caption">
                        <h2>
                            <font style="font-size: 14px; color:#fff !important; font-weight: bold !important;">
                            Cambiar imagen
                            </font>
                        </h2>
                    </div>
                </a>
            </li>    
        </ul>
    </div>    
    <p class="nuevo" style="text-align: left; margin-top: 15px; padding-left: 10px">                         
        <input type="hidden" name="marcaid" value="<?php echo $marcaedit['id']; ?>"/>         
        <input type="submit" value="Finalizar" /> 
    </p>
    <?php $view->endForm(); ?>
</div>
<script type="text/javascript">
    $(window).load(function(){
        $("#secondGallery").ImageOverlay({
            border_color: "#005500",
            overlay_color: "#009900", 
            overlay_origin: "top", 
            overlay_text_color: "#FFFFFF"
        });          
    });
    $(document).ready(function(){       
        $('body').css('background','none');
    });
</script> 