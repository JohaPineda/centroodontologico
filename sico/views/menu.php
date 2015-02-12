<?php defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>'); 
if($prefiljuser==1){ ?>
<div class="blue">    
    <ul id="mega-menu-4" class="mega-menu">  
        <li><a href="index.php">Inicio</a></li>  
        <li><a href="index.php?controlador=Admoncitas&accion=administrarCitas">Administrar Citas</a></li>        
        <li><a href="#">Usuarios</a>
            <ul> 
                <li><a href="index.php?controlador=Usuarios&accion=traerEspecialistas">Administrar Especialistas</a></li>                
                <li><a href="index.php?controlador=Usuarios&accion=traerPacientes">Administrar Pacientes</a></li>                 
            </ul>  
        </li> 
        <li><a href="Consultorios.html">Administrar Consultorios</a></li>
        <li><a href="Servicios.html">Administrar Servicios</a></li> 
        <li><a href="User_salir.html">Salir</a></li>
    </ul>
</div>
<?php
}if($prefiljuser==2){ ?>
<div class="blue">  
    <ul id="mega-menu-4" class="mega-menu">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="Citas.html">Mis citas</a></li>
        <li><a href="MiPerfil.html">Mi perfil</a></li>  
        <li><a href="User_salir.html">Salir</a></li>
    </ul>
</div>
<?php
}if($prefiljuser==3){ ?>
<div class="blue">   
    <ul id="mega-menu-4" class="mega-menu">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="Rips.html">RIPS</a></li>    
        <li><a href="Consulta.html">Consultas</a></li>  
        <li><a href="User_salir.html">Salir</a></li>
    </ul>
</div>
<?php
}?>