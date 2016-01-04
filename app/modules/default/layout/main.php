<?php $config = ILO_Config::getConfig(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="imagetoolbar" content="no" />
	<title>
	    <?php echo $config->geral->appname; ?>
	</title>
	
	<script type="text/javascript">
	    var baseUrl = '<?php echo BASE; ?>';
	    var config = <?php echo json_encode( ILO_Config::toArray( 'geral' ) ); ?>;
	</script>

	<?php require_once 'includes.php'; ?>
	
	<script type="text/javascript">
            
            window.onbeforeunload = function()
            {
                loading( true );
            }
        </script>
    </head>

    <body>

	<!--[if !IE]>start wrapper<![endif]-->
	<div id="wrapper">

	    <!--[if !IE]>start header main menu<![endif]-->
	    <div id="header_main_menu">

		<?php
		    require_once 'header.php';
		    
		    if ( empty( $this->relatorio_mode  ) )
			echo $this->_helper->menu;
		    else
			require_once 'menu-relatorio.php';
		?>
	    </div>

		<!--[if !IE]>start content<![endif]-->
		<div id="content">
		    <div class="inner">

			<!--[if !IE]>start section<![endif]-->
			<div class="section">
			    <?php echo $this->content; ?>
			</div>
			<!--[if !IE]>end section<![endif]-->

		    </div>
		</div>
		<!--[if !IE]>end content<![endif]-->

	</div>
	<!--[if !IE]>end wrapper<![endif]-->
	    
	
	<?php require_once 'footer.php'; ?>

	<div id="loading" class="white_content"></div>
	<div id="loading_bkg" class="black_overlay"></div>

	<div id="msgDiv" class="messenger" style="display: none;" onclick="animateMsg( false );">
	    <img src="<?php echo BASE; ?>/public/images/exit.png" width="17" height="17" alt="Fechar" title="Fechar" onclick="animateMsg( false );" />
	    <h3 id="msgDivText"></h3>
	</div>
	<div id="back_msg" style="display:none;" ondblclick="animateMsg( false );"></div>
	
	
	<?php 
	    if ( ILO_Util_Message::hasMessage() ) : 
		$msg = ILO_Util_Message::getMessage();
	?>
	    <script type="text/javascript">
		$( document ).ready(
		    function()
		    {
			showMsg( '<?php echo $msg['msg']; ?>', '<?php echo $msg['level']; ?>' );
		    }
		);
	    </script>
	<?php 
	    ILO_Util_Message::clear();
	    endif; 
	?>

    </body>
</html>