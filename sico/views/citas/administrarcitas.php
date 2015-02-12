<?php
defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>');
?>
<h1 class="titulossecciones">Administrar citas</h1>  
<form method="POST" action="index.php?controlador=Admoncitas&accion=administrarCitas">  
<table  border="0" cellpading="10px">   
    <tr> 
        <td><?php $doc->texto('DATEINI') ?>: </td>
        <td>
            <?php $view->input("dateini", "calendar", $doc->t('BORN_DATE'), array(), array('readonly' => 'readonly', "value" => $fechaini)); ?>
        </td> 
        <td><?php $doc->texto('DATEFIN') ?>: </td>
        <td>
            <?php $view->input("datefin", "calendar", $doc->t('BORN_DATE'), array(), array('readonly' => 'readonly', "value" => $fechafin)); ?>
        </td>
        <td> 
            <div> 
                <button class="opcionbutton"><?php $doc->texto('SEE') ?></button>
            </div>
        </td>   
        <td> 
            <div>
                <a class="opcionbutton" id="creatett" href="index.php?controlador=Admoncitas&accion=nuevacita">
                    Nueva Cita
                </a>                   
            </div>
        </td> 
    </tr> 
</table> 
</form>
<div>  
    <table cellspacing="0" cellpadding="0" border="0" id="mytable" class="dataTable" aria-describedby="mytable_info">
        <thead>   
            <tr>   
                <th class="norm" >Nombre paciente</th>
                <th class="norm" >Cedula</th>
                <th class="norm" >Servicio</th>
                <th class="norm" >Medico</th>
                <th class="norm" style="cursor: pointer">Fecha</th> 
                <th class="norm" >Hora</th> 
                <th class="norm" >Estado</th>
                <th class="norm" >Editar</th>  
                <th class="norm" style="width: 65px;text-align: center; padding-left: 6px;">Cancelar</th>
            </tr> 
        </thead> 
        <tbody>    
            <?php 
			if(sizeof($citas)){
			foreach ($citas as $value) { ?>   
                <tr id="<?php echo $value["id"] ?>">     
                    <td class="" id="nombret<?php echo $value["id"] ?>"> 
                        <?php echo $value["nombrepaciente"] ?>
                    </td>  
                    <td class="" id="tiempo<?php echo $value["id"] ?>" align="left">
                        <?php echo $value["cedula"] ?>  
                    </td>   
                    <td class="" id="valor<?php echo $value["id"] ?>" align="center"> 
                        <?php echo $value["servicio"] ?>   
                    </td> 
                    <td class="" align="center" id="descripcion<?php echo $value["id"] ?>">   
                        <?php echo $value["medico"]; ?> 
                    </td>  
                    <td class="" id="fecha<?php echo $value["id"] ?>" align="center">  
                        <?php echo $value["fecha"] ?>  
                    </td>    
                    <td class="" id="hora<?php echo $value["id"] ?>" align="center">  
                        <?php echo $value["hora"] ?>  

                    </td> 
                    <td class="" id="estado<?php echo $value["id"] ?>" align="center">  
                        <?php echo $value["estado"] ?>  
                    </td> 
                    <td class=""  name="cita" id="edit<?php echo $value["id"] ?>" align="center">  
                        <?php if ($value["estado"] == "espera") { ?>
                        <a class="various3" href="index.php?controlador=Admoncitas&accion=editarcita&idcita=<?php echo $value["id"] ?>">
                           <img src="images/list.png" width="15px" height="15px"/> 
                        </a> 
                        <?php } ?>                         
                    </td> 
                    <td class="" align="center">
                        <?php if ($value["estado"] == "espera") { ?>
                            <a id="dell<?php echo sha1($value['id']); ?>" 
                               callback="<?php echo $value['especialista']; ?>"  
                               tar="index.php?controlador=Admoncitas&accion=cancelarcita" 
                               verify="<?php echo strrev(urlencode(base64_encode($value['id']))); ?>"
                               href="#"
                               onclick="confirmfunction($(this).attr('id'))">
                                <img class="delete" src="images/delete.gif" title="Eliminar item"/>                       
                            </a> 
                        <?php } ?> 
                    </td>
                </tr>
            <?php }} ?>      
        </tbody> 
    </table>
</div>
<div style="display: none">
    <div id="contentcall">
        <div style="text-align: center; margin-bottom: 12px;margin-top: 40px;padding-left: 20px;padding-right: 20px; font-size: 12px">
            Esta seguro de cancelar la cita <strong id=""></strong>?
        </div>
        <div style="text-align: center; margin-bottom: 12px;">
            
            <button class="opcionbutton" id="accept">Aceptar</button>    
            <button style="margin-left: 10px" class="opcionbutton" id="cancel">Cancelar</button>
        </div>
    </div>
</div>
<div style="display: none">
    <a href="#contentcall" class="callback">Open Example</a>
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
                        $('#estado'+data.idrow).html('cancelado');
                        $('#dell'+data.idcod).html('');
                        $('#edit'+data.idcod).html('');
                        //oTable.fnDeleteRow(oTable.fnGetPosition($('#attr'+data.idrow).get(0)));
                        $.fancybox.close();
                        parent.message("Se ha cancelado la cita","images/iconosalerta/ok.png");
                    }else{
                        $.fancybox.close();
                        parent.message("No se pudo eliminar la cita","images/iconosalerta/error.png");
                    }
                }               
            });
        });
        $('#cancel').click(function(){
            $.fancybox.close();            
        });
    }
    function updatedata(id,anio,mes,dia,hora){          
         $("#hora"+id).html(hora);       
    }
     
    function createdata(id,paciente,cedula,servicio,especialista,fecha,hora,estado,idcode,idverify){    
        var addId = $('#mytable').dataTable().fnAddData([                           
            paciente,  
            cedula,
            servicio,               
            especialista, 
            fecha, 
            hora,    
            estado,          
            "<a href='#'><img src='images/list.png' width='15px' height='15px'/></a>",  
            "<a id='dell"+idcode+"' callback='"+especialista+"' tar='index.php?controlador=Citas&accion=cancelarcita' href='#' verify='"+idverify+"' onclick='confirmfunction($(this).attr(\"id\"))'><img src='images/delete.gif' class='delete'/></a>"  ] 
    );         var theNode = $('#mytable').dataTable().fnSettings().aoData[addId[0]].nTr;
        theNode.setAttribute('id',"attr"+id);        
             
    }   
  
    $(document).ready(function(){  
        $(".callback").fancybox({      
            'autoDimensions'       : false,
            'width'                : 400,
            'height'               : 130, 
            'autoScale'            : false,
            'overlayOpacity'       : 0.1,
            'transitionIn'         : 'elastic',
            'transitionOut'        : 'fade',
            'speedIn'              :  500,                        
            'hideOnOverlayClick'   : false,
            'overlayColor'         : '#000',
            'showCloseButton'      : false,
            'padding'              : 0, 
            'margin'               : 0
        });
        $(".various3").fancybox({
            'width'                : '50%',
            'height'               : '70%',
            'autoScale'            : false,
            'transitionIn'         : 'elastic',
            'transitionOut'        : 'elastic',
            'speedIn'              :  500,
            'type'                 : 'iframe',
            'hideOnOverlayClick'   : false    
        }); 
        $(".various4").fancybox({
            'width'                : '50%',
            'height'               : '100%',
            'autoScale'            : false,
            'transitionIn'         : 'elastic',
            'transitionOut'        : 'elastic',
            'speedIn'              :  500,
            'type'                 : 'iframe',
            'hideOnOverlayClick'   : false    
        }); 
        $("#creatett").fancybox({
            'width'                : '80%', 
            'height'               : '80%', 
            'autoScale'            : false, 
            'transitionIn'         : 'elastic',
            'transitionOut'        : 'elastic',
            'speedIn'              :  500,
            'type'                 : 'iframe',
            'hideOnOverlayClick'   : false    
        });
        $('img').css("border","0");
        $("#categorias").change(function() {              
            var ajaxOpts = {
                type: "get",
                url: "index.php",
                data: "&controlador=Catalogo&accion=ajaxSubcategorias&catid=" + $("#categorias").val(),
                success: function(data) {							
                    $('#resSub').html(data);
                }
            };
            $.ajax(ajaxOpts); 
        }); 
        $('#categorias').val("<?php echo $categoria; ?>");
        $('#subcategorias').val("<?php echo $subcategoria; ?>");
        $('#mytable').dataTable( {
            "fnCreatedRow": function( nRow, aData, iDataIndex ) {                
                $('td:eq(0)', nRow).addClass('none');
                $('td:eq(1)', nRow).addClass('alt');
                $('td:eq(2)', nRow).addClass('alt');
                $('td:eq(3)', nRow).addClass('alt');  
                $('td:eq(4)', nRow).addClass('alt');                  
                $('td:eq(5)', nRow).addClass('alt');
                $('td:eq(6)', nRow).addClass('alt');
                $('td:eq(7)', nRow).addClass('alt');                 
                $('td:eq(8)', nRow).addClass('alt');
                $('td:eq(8)', nRow).attr('style', 'style="width: 65px;text-align: center; padding-left: 6px;');
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
                { "bSortable": false, "bSearchable": false },
                { "bSortable": false },
                { "bSortable": false },
                { "bSortable": false, "bSearchable": false },
                { "bSearchable": false},
                { "bSortable": false, "bSearchable": false },
                { "bSortable": false },
                { "bSortable": false },
                { "bSortable": false, "bSearchable": false }
            ]
        } );
    });
</script>
