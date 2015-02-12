<?php
defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');
?>

<script>
    $(document).ready(function(){                      
<?php if ($message != null) { ?>
            message('<?php echo $message ?>','<?php echo $icon_message ?>');
<?php } ?>
    
    });
</script> 
<style>
    body{
        overflow: hidden;
    }
</style>
<div class="container">
    <!-- Codrops top bar -->                       
    <section>				
        <div id="container_demo" >                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->                    
            <div id="wrapper">
                <div id="login" class="animate form">
                    <?php $view->startForm("index.php", "formlogin"); ?>  
                    <h1>Sistema Integrado de Citas Online</h1> 
                    <p> 
                        <label for="username" class="uname" data-icon="u" > Nombre de usuario: </label>                            
                        <?php $view->input("user", "text", $doc->t('USERNAME'), array('required' => true)); ?>
                    </p>
                    <p> 
                        <label for="password" class="youpasswd" data-icon="p"> Contrase&ntilde;a </label>
                        <?php $view->input("pwd", "password", $doc->t('PASSWORD'), array('required' => true)); ?>  
                        <?php $view->input("cont", "hidden", '', array(), array('value' => 'User')); ?>  
                        <?php $view->input("act", "hidden", '', array(), array('value' => 'validacion')); ?> 
                    </p>
                    <p class="login button"> 
                        <input type="submit" value="Login" /> 
                    </p>
                    <p class="change_link"><a id="various3" href="index.php?controlador=RegistrarUsuario" class="to_register">Registrarse</a>
                        <a id="lll" href="index.php?controlador=RegistrarUsuario&accion=passpaciente" class="to_register">Recordar contrase&ntilde;a</a>
                    </p>
                    <?php $view->endForm(); ?> 
                </div>                        						
            </div>
        </div>  
    </section>
</div>

<script>
 $(document).ready(function(){  
        $(".to_register").fancybox({      
            'autoDimensions'       : false,
            'width'                : 800,
            'height'               : 500, 
            'autoScale'            : false,                    
            'hideOnOverlayClick'   : false,
            'type'                 : 'iframe'
            
        });
        $("#lll").fancybox({      
            'autoDimensions'       : false,
            'width'                : 600,
            'height'               : 200, 
            'autoScale'            : false,                    
            'hideOnOverlayClick'   : false,
            'type'                 : 'iframe'
            
        });
        
        });
</script>
