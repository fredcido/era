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

    </head>

    <body>
	<form id="hidden-form" method="post" class="noPrint">
	    <input type="hidden" name="path" id="path" />
	    <input type="hidden" name="data" id="data" value='<?php echo serialize( $this->data ); ?>' />
	</form>
        <?php echo $this->content; ?>
	
    </body>
</html>