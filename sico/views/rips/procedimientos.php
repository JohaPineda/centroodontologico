<?php defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>'); ?>
<div style="width: 100%; margin: 0 auto;"> 
    <div> 
        <table id="mytable" border="0" cellspacing="0" cellpadding="0">
            <thead>  
                <tr> 
                    <th class="nobg" style="cursor: pointer; width: 50px; text-align: center"># Fact</th>
                    <th class="norm" style="cursor: pointer; text-align: center">C.C Paciente</th>   
                    <th class="norm" style="cursor: pointer; text-align: center; width: 100px">Fecha</th>
                    <th class="norm" style="cursor: pointer; text-align: center; width: 50px">Cod.</th>
                    <th class="norm" style="cursor: pointer; text-align: center; width: 100px">Finalidad del procedimiento</th> 
                    <th class="norm" style="cursor: pointer; width: 100px; text-align: center">Personal que atiende</th> 
                    <th class="norm" style="cursor: pointer; width: 300px; text-align: center">Complicacion</th> 
                    <th class="norm" style="cursor: pointer; width: 80px">Valor</th>    
                </tr>
            </thead> 
            <tbody>  
                <?php 
                if (sizeof($procedimientos) != 0) {  
                    foreach ($procedimientos as $value) { 
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
                            <td class="<?php echo $default2; ?>">                               
                            <?php echo $value['codiserv']; ?>  
                            </td> 
                              <td class="<?php echo $default2; ?>">                               
                             <?php echo $value['servicio']; ?>     
                            </td>                          
                            <td class="alt">                                 
                              <?php echo $value['nomesp']; ?>     
                            </td>
                            <td class="alt" align="center">                                 
                              <?php echo $value['diagnostico']; ?> 
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
    
    function confirmfunction(id){                       
        $('.callback').trigger('click');  
        $('#nameofdelete').html($('#'+id).attr('callback'));
        $('#accept').click(function(){                                       
            $.ajax({
                type: "POST",
                url: $('#'+id).attr('tar'),
                dataType: "json",
                data: {verify:$('#'+id).attr('verify')},
                success: function(data) { 
                    if(data.res=='si'){
                        //$('#attr'+data.idrow).remove();
                        oTable.fnDeleteRow(oTable.fnGetPosition($('#esp'+data.idrow).get(0)));
                        $.fancybox.close();
                        parent.message("Se ha eliminado el especialista","images/iconosalerta/ok.png");
                    }else{  
                        $.fancybox.close();
                        parent.message("No se pudo eliminar el especialista","images/iconosalerta/error.png");
                    }
                }               
            }); 
        }); 
        $('#cancel').click(function(){
            $.fancybox.close();            
        });
    }
    function updatedata(id,nombre,consultorio,servicio){         
        $("#nome"+id).html(nombre); 
        $("#cons"+id).html(consultorio); 
        $("#serv"+id).html(servicio);  
    }
    
    function createdata(id,nombre,consultorio,servicio,idcode,idverify){    
        var addId = $('#mytable').dataTable().fnAddData(  [            
            nombre,
            consultorio,  
            servicio,   
            "<a class='various3"+id+"' href='index.php?controlador=Content&accion=ViewContent&idcontent="+id+"'><img src='images/list.png' width='15px' height='15px'/></a>",
            "<a id='dell"+idcode+"' callback='"+nombre+"' tar='index.php?controlador=Content&accion=deletecontent' href='#' verify='"+idverify+"' onclick='confirmfunction($(this).attr(\"id\"))'><img src='images/delete.gif' class='delete'/></a>"  ]
            
    );           
        var theNode = $('#mytable').dataTable().fnSettings().aoData[addId[0]].nTr;
        theNode.setAttribute('id',"attr"+id);        
            
    }
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
                { "bSortable": false, "bSearchable": false },
                null,
                null, 
                { "bSortable": false, "bSearchable": false },
                { "bSortable": false, "bSearchable": false },                
            ]
        } );
    });
</script>