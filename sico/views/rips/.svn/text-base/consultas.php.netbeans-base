<?php defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>'); ?>
<div style="width: 100%; margin: 0 auto;"> 
    <div>
        <table id="mytable" border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="nobg" style="cursor: pointer; width: 50px">N. Factura</th>
                    <th class="norm" style="cursor: pointer">C.C Paciente</th>   
                    <th class="norm" style="cursor: pointer; width: 100px">Fecha de consulta</th> 
                    <th class="norm" style="cursor: pointer; width: 300px">Finalidad de la consulta</th> 
                    <th class="norm" style="cursor: pointer; width: 80px">Valor de la consulta</th> 
                    <th class="norm" style="cursor: pointer; width: 80px">Valor neto a pagar</th>   
                </tr>
            </thead>
            <tbody>  
                <?php 
                if (sizeof($consultas) != 0) {  
                    foreach ($consultas as $value) { 
                        ?> 
                <tr id="esp<?php echo $value['id']; ?>">                            
                            <td class="<?php echo $default2; ?>">
                                <?php echo $value['id']; ?>    
                            </td>
                            <td class="<?php echo $default2; ?>">
                              <?php echo $value['cedula']; ?>  
                            </td>
                            <td class="<?php echo $default2; ?>">  
                             <?php echo $value['fecha']; ?>  
                            </td> 
                            <td class="alt">                                
                             <?php echo $value['servicio']; ?>     
                            </td>  
                            <td class="alt">                                 
                             <?php  echo '&#36;' . number_format($value["valor"], 0, ',', '.'); ?>  
                            </td>
                            <td class="alt" align="center">                                 
                             <?php  echo '&#36;' . number_format($value["valor"], 0, ',', '.'); ?> 
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
    var oTable;   
    $(document).ready(function(){  
    $("body").css("background","none");
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
            "aaSorting": [[ 0, "asc" ]],
            "aoColumns": [ 
                null,   
                { "bSortable": false, "bSearchable": false },  
                null,  
                null,  
                { "bSortable": false, "bSearchable": false },
                { "bSortable": false, "bSearchable": false },                
            ]
        } );
    });
</script>