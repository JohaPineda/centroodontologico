<?php defined('EXECG__') or die('<h1>404 - <strong>Not Found</strong></h1>'); ?>

<script type="text/javascript">
    $(document).ready(function($){	
        $('#mega-menu-4').dcMegaMenu({
            rowItems: '3',
            speed: 'fast',
            effect: 'fade'
        });
        effect: 'slide'	
    });
</script>

<div id="templatemo_wrapper">

    <div id="templatemo_header"><!-- end of site_title -->
        <div style="float: right; font-weight: bold; margin-top: 30px"><?php echo $fechas_template?></div>
        <div style="clear: right"></div>
        <div id="horafecha" style="float: right; font-weight: bold"></div>
    </div> <!-- end of header -->
    <?php include($url_menu);?>
    <div id="templatemo_main"><?php include($url_main);?></div> <!-- end of main -->
    <div id="templatemo_main_bottom"></div> <!-- end of main -->

    <div id="templatemo_footer">


    </div> <!-- end of templatemo_footer -->
</div> <!-- end of wrapper -->