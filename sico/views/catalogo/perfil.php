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
    <h1 class="titulossecciones">Mi perfil</h1>
    <div style="margin: 10px 0 5px;">        
    </div>
    <div>
        <table id="mytable" border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>  
                    <th class="norm" style="cursor: pointer">Nombre</th>
                    <th class="norm" style="cursor: pointer">Telefono</th>
                    <th class="norm" style="cursor: pointer">Direccion</th>
                    <th class="norm" scope="col" style="width: 49px;text-align: center; padding-left: 6px;">Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (sizeof($marcas) != 0) {
                    foreach ($marcas as $value) {
                        ?>
                        <tr id="attr<?php echo $value['id']; ?>">
                            <td class="<?php echo $default2; ?>" id="<?php echo $value['id']; ?>">
                               jhon mendez

                            </td>
                            <td class="<?php echo $default2; ?>" style="width: 49px;text-align: center; padding-left: 6px;">
dfdf
                            </td>
                            <td class="<?php echo $default2; ?>" style="width: 65px;text-align: center; padding-left: 6px;">
                               dfd
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
                        $('#attr'+data.idrow).remove();
                        $.fancybox.close();
                        parent.message("Se ha eliminado la marca","images/iconosalerta/ok.png");
                    }else{
                        $.fancybox.close();
                        parent.message("No se pudo eliminar la marca","images/iconosalerta/error.png");
                    }
                }               
            });
        });
        $('#cancel').click(function(){
            $.fancybox.close();            
        });
    }
    function createdata(nombre, id){        
        var tr1 = $("<tr>").appendTo("#mytable");
        var th1 = $("<th>").addClass("spec").appendTo(tr1);
        $(th1).html(nombre);            
        var td1 = $("<td>").addClass("none").attr('style','width: 49px;text-align: center; padding-left: 6px;').appendTo(tr1);        
        var link=$("<a>").addClass("various3").appendTo(td1);
        $(link).attr('href','index.php?controlador=Catalogo&accion=editSubCategory&subcatid='+id);
        $('<img>').attr({'src':'images/list.png', 'width':'15', 'height':'15'}).appendTo(link);            
        var td2 = $("<td>").addClass("none").appendTo(tr1);
    }
    
    function updatedata(newnombre, id){        
        $("#"+id+"").html(newnombre);
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
            'width'                : '90%',
            'height'               : '100%',
            'autoScale'            : false,
            'transitionIn'         : 'elastic',
            'transitionOut'        : 'elastic',
            'speedIn'              :  500,
            'type'                 : 'iframe',
            'hideOnOverlayClick'   : false    
        }); 
        $("#createttt").fancybox({
            'width'                : '90%',
            'height'               : '100%',
            'autoScale'            : false,
            'transitionIn'         : 'elastic',
            'transitionOut'        : 'elastic',
            'speedIn'              :  500,
            'type'                 : 'iframe',
            'hideOnOverlayClick'   : false    
        });
        $('img').css("border","0");
        $('#mytable').dataTable( {
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
                { "bSortable": false, "bSearchable": false },
                null,     
                { "bSortable": false, "bSearchable": false },
                { "bSortable": false, "bSearchable": false }
            ]
        } );
    });
</script>