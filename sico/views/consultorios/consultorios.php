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
    <h1 class="titulossecciones">Consultorios </h1>
    <div style="margin: 0px 0 5px;">     
        <a class="opcionbutton" id="creatett" style="float: right" href="index.php?controlador=Consultorios&accion=crearconsultorio">
            + Crear Consultorio 
        </a>          
        <div style="clear: both;"></div>
    </div> 
    <div> 
        <table id="mytable" border="0" cellspacing="0" cellpadding="0">
            <thead> 
                <tr>  
                    <th class="norm" style="cursor: pointer">Nombre del consultorio</th>
                    <th class="norm" style="cursor: pointer">Direccion</th>
                    <th class="norm" style="cursor: pointer">Telefono</th> 
                    <th class="norm" style="width: 49px;text-align: center; padding-left: 6px;">Editar</th>
                    <th class="norm" style="width: 65px;text-align: center; padding-left: 6px;">Eliminar</th>
                </tr> 
            </thead> 
            <tbody>   
                <?php 
				if(sizeof($consultorios)){
				foreach ($consultorios as $value) { ?> 
                    <tr id="<?php echo $value["id"] ?>">    
                        <td id="nombre<?php echo $value["id"] ?>"> 
                            <?php echo $value['nombreconsultorio']; ?> 
                        </td>
                        <td id="direccion<?php echo $value["id"] ?>" align="left">
                            <?php echo $value['direccion']; ?>  
                        </td> 
                        <td id="telefono<?php echo $value["id"] ?>">  
                            <?php echo $value['telefono']; ?> 
                        </td>  
                        <td align="center">   
                            <?php if ($value['citas'] == 0) { ?>
                                <a class="various3" href="index.php?controlador=Consultorios&accion=editarconsultorio&idconsultorio=<?php echo $value["id"]; ?>">
                                    <img src="images/list.png" width="15px" height="15px"/>
                                </a>
                            <?php } ?>
                        </td>
                        <td class="" align="center">
                            <?php if ($value['citas'] == 0) { ?>
                                <a id="dell<?php echo sha1($value['id']); ?>" 
                                   callback="<?php echo $value['nombreconsultorio']; ?>"    
                                   tar="index.php?controlador=Consultorios&accion=deleteconsultorio" 
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
                Esta seguro de eliminar el consultorio <strong id="nameofdelete"></strong>?
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
                        oTable.fnDeleteRow(oTable.fnGetPosition($('#'+data.idrow).get(0)));                        
                        $.fancybox.close();
                        parent.message("Se ha eliminado el consultorio","images/iconosalerta/ok.png");
                    }else{
                        $.fancybox.close();
                        parent.message("No se pudo eliminar el consultorio","images/iconosalerta/error.png");
                    }
                }               
            });
        });
        $('#cancel').click(function(){
            $.fancybox.close();            
        });
    }
     
    function createdata(id,nombre,direccion,telefono,idcode,idverify){     
        var addId = $('#mytable').dataTable().fnAddData([                           
            nombre,  
            direccion,
            telefono,                         
            "<a class='various3"+id+"' href='index.php?controlador=Consultorios&accion=editarconsultorio&idconsultorio="+id+"' objectedit='"+id+"'><img src='images/list.png' width='15px' height='15px'/></a>",  
            "<a id='dell"+idcode+"' callback='"+nombre+"' tar='index.php?controlador=Consultorios&accion=deleteconsultorio' href='#' verify='"+idverify+"' onclick='confirmfunction($(this).attr(\"id\"))'><img src='images/delete.gif' class='delete'/></a>"  ] 
    );        
        var theNode = $('#mytable').dataTable().fnSettings().aoData[addId[0]].nTr;
        theNode.setAttribute('id', id);            
        $(".various3"+id).fancybox({
            'width'                : '40%',
            'height'               : '60%', 
            'autoScale'            : false, 
            'transitionIn'         : 'elastic',
            'transitionOut'        : 'elastic',
            'speedIn'              :  500,
            'type'                 : 'iframe',
            'hideOnOverlayClick'   : false    
        }); 
             
    }  
     
    function updatedata(id,nombre,direccion,telefono){        
        $("#nombre"+id).html(nombre); 
        $("#direccion"+id).html(direccion); 
        $("#telefono"+id).html(telefono);  
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
            'width'                : '40%',
            'height'               : '60%', 
            'autoScale'            : false, 
            'transitionIn'         : 'elastic',
            'transitionOut'        : 'elastic',
            'speedIn'              :  500,
            'type'                 : 'iframe',
            'hideOnOverlayClick'   : false    
        }); 
        $("#creatett").fancybox({
            'width'                : '40%', 
            'height'               : '60%',
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
                $('td:eq(4)', nRow).attr('style', 'width: 65px;text-align: center; padding-left: 6px;');
                
                if($('td:eq(3) a', nRow).attr('objectedit')){
                    $('td:eq(0)', nRow).attr('id','nombre'+$('td:eq(3) a', nRow).attr('objectedit'));
                    $('td:eq(1)', nRow).attr('id','direccion'+$('td:eq(3) a', nRow).attr('objectedit'));
                    $('td:eq(2)', nRow).attr('id','telefono'+$('td:eq(3) a', nRow).attr('objectedit'));
                    $('td:eq(3) a', nRow).removeAttr('objectedit');
                }  
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
                null, 
                { "bSortable": false, "bSearchable": false },
                { "bSortable": false, "bSearchable": false },
                { "bSortable": false, "bSearchable": false }
            ]
        } );
    });
</script>
