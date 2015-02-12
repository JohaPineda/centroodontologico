<?php
defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');
?>     
<div style="width: 80%; height: 100%;">    
    <h1 class="titulossecciones">REGISTRO INDIVIDUAL DE PRESTACIONES DE SALUD</h1>   
    <section class="tabs">
        <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
        <label for="tab-1" class="tab-label-1">Consultas</label>
        <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" />
        <label for="tab-2" class="tab-label-2">Procedimientos</label>  
        <div class="clear-shadow"></div> 
        <div class="content">                   
            <div class="content-1">      
                <iframe frameborder="0" scrolling="no" src="index.php?controlador=Rips&accion=consultas" width="880px" height="500px"></iframe>
            </div>  
            <div class="content-2">  
               <iframe frameborder="0" scrolling="no" src="index.php?controlador=Rips&accion=procedimientos" width="880px" height="500px"></iframe>
            </div>   
        </div>
    </section> 
</div> 
