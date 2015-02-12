<?php defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>'); ?>
<style>
    input:not([type="checkbox"]) {
        -moz-box-sizing: content-box;
        -moz-transition: all 0.2s linear 0s;
        border: 1px solid #B2B2B2;
        border-radius: 3px 3px 3px 3px;
        box-shadow: 0 1px 4px 0 rgba(168, 168, 168, 0.6) inset;
        font-size: 14px;
        margin-top: 0;
        padding: 2px;
    }
</style>
<div style="width: 90%; margin: 0 auto;"> 
    <h1 class="titulossecciones">Consultas:</h1>
    <div>
        <table id="mytable" border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="nobg" style="cursor: pointer">Paciente</th>
                    <th class="norm" style="cursor: pointer">Cedula</th>  
                    <th class="norm" style="cursor: pointer">Fecha</th>
                    <th class="norm" style="cursor: pointer">Hora</th>
                    <th class="norm" style="cursor: pointer">Servicio</th>
                    <th class="norm" style="cursor: pointer">Estado</th>
                    <th class="norm" scope="col" style="width: 49px;text-align: center; padding-left: 6px;">
                     Atender cita                 
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (sizeof($citas) != 0) {
                    foreach ($citas as $value) { 
                        ?> 
                        <tr id="esp<?php echo $value['id']; ?>">                             
                            <td class="<?php echo $default2; ?>" id="nome<?php echo $value['id']; ?>">
                                <?php echo $value['nombrepaciente']; ?> 
                            </td>
                            <td class="<?php echo $default2; ?>" id="cons<?php echo $value['id']; ?>">
                                <?php echo $value['cedula']; ?>
                            </td>  
                            <td class="<?php echo $default2; ?>" id="cons<?php echo $value['id']; ?>">
                                <?php echo $value['fecha']; ?>
                            </td> 
                            <td class="<?php echo $default2; ?>" id="serv<?php echo $value['id']; ?>">
                                <?php echo $value['hora']; ?>
                            </td> 
                            <td class="<?php echo $default2; ?>" style="width: 49px;text-align: center; padding-left: 6px;">                               
                                <?php echo $value['servicio']; ?>     
                            </td>     
                            <td id="estado<?php echo $value['id']; ?>" class="alt" style="width: 49px;text-align: center; padding-left: 6px;">                              
                                <?php echo $value['estado']; ?>     
                            </td>                                
                            <td id="imagen<?php echo $value['id'];?>" align="center" class="alt" style="width: 65px;text-align: center; padding-left: 6px;">
                             <?php if($value['estado']=='espera') { ?>   
                                <a id="cita<?php echo $value['id'];?>" class="various3" href="index.php?controlador=Consulta&accion=historiaClinica&idpaciente=<?php echo $value['idpac']; ?>&idcita=<?php echo $value['id']; ?>">
                                <img src="images/cita.png"/>   
                             </a> <?php } ?>  
                            </td>
                        </tr>
                        <?php
                        if ($default2 == "none") {
                            $default2 = "alt";
                        } else if ($default2 == "alt") {
                            $default2 = "none";
                        }
                        if ($default == "spec") {
                            $default = "specalt";
                        } else if ($default == "specalt") {
                            $default = "spec";
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    
function updatedata(id){
    $("#estado"+id).html('realizada');   
    $("#imagen"+id).html(""); 
}    
    var oTable;   
    $(document).ready(function(){  
        $(".various3").fancybox({
            'width'                : '100%',
            'height'               : '100%', 
            'autoScale'            : false,
            'transitionIn'         : 'elastic',
            'transitionOut'        : 'elastic',
            'speedIn'              :  500,
            'type'                 : 'iframe',
            'hideOnOverlayClick'   : false    
        });          
        $('img').css("border","0");       
        oTable=$('#mytable').dataTable( {
            "fnCreatedRow": function( nRow, aData, iDataIndex ) {                
                $('td:eq(0)', nRow).addClass('none');
                $('td:eq(1)', nRow).addClass('alt');
                $('td:eq(2)', nRow).addClass('alt');
                $('td:eq(3)', nRow).addClass('alt');  
                $('td:eq(4)', nRow).addClass('alt');  
                $('td:eq(3)', nRow).attr('style', 'width: 49px;text-align: center; padding-left: 6px;');
                $('td:eq(4)', nRow).attr('style', 'style="width: 65px;text-align: center; padding-left: 6px;');
            },            
            "oLanguage":  {
                "sEmptyTable":     "No existen datos disponibles",
                "sInfo":           "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando desde 0 hasta 0 de 0 registros",
                "sInfoFiltered":   "(filtrado de _MAX_ registros en total)",
                "sInfoPostFix":    "",
                "sInfoThousands":  ",",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sLoadingRecords": "Cargando...",
                "sProcessing":     "Procesando...",
                "sSearch":         "Buscar:",
                "sZeroRecords":    "No se encontraron resultados",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                }, 
                "oAria": {
                    "sSortAscending":  ": activar para Ordenar Ascendentemente",
                    "sSortDescending": ": activar para Ordendar Descendentemente"
                }
            }, 
            "sPaginationType": "full_numbers",
            "aaSorting": [[ 1, "asc" ]],
            "aoColumns": [
                null,
                null,  
                null,
                null,
                 null,
                { "bSortable": false, "bSearchable": false },
                { "bSortable": false, "bSearchable": false },                
            ]
        } );
    });
</script>