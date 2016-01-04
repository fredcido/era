<?php $config = ILO_Config::getConfig(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="imagetoolbar" content="no" />
	<title><?php echo $config->geral->appname; ?></title>
	<link media="screen" rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/public/layout/css/login.css"  />
	<!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/public/layout/css/login-ie.css" /><![endif]-->
	<!-- aurora-theme is default -->
	
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/public/styles/main.css">
	<!-- CSS -->
	
	<!-- GERAL -->
	<script src="<?php echo BASE; ?>/public/scripts/jquery.js" type="text/javascript"></script>
	<!-- GERAL -->

	<script type="text/javascript">
	    $( document ).ready(
		function()
		{
		    $( 'input, select' ).each(
			function( index, element )
			{
			    if ( !$( element ).attr( 'disabled' ) &&
				 $( element ).attr( 'type' ) != 'hidden' ) {
				 $( element ).focus();
				 return false;
			    }
			}
		    );
		}
	    );
	    
	</script>

	<link media="screen" rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/public/layout/css/login-white.css"  />
    </head>

    <body>
	<!--[if !IE]>start wrapper<![endif]-->
	<div id="wrapper">
	    <div id="wrapper2">
		<div id="wrapper3">
		    <div id="wrapper4">
			<span id="login_wrapper_bg"></span>

			<div id="stripes">

			    <!--[if !IE]>start login wrapper<![endif]-->
			    <div id="login_wrapper">
				
				<?php 
				    if ( ILO_Util_Message::hasMessage() ) : 
					$msg = ILO_Util_Message::getMessage();
				?>
				    <div class="error-login">
					<div class="error_inner">
					    <strong><?php echo $this->t( 'Acesso Restrito', 35 ); ?></strong> | 
					    <span>
						<?php echo $msg['msg']; ?>
					    </span>
					</div>
				    </div>
				<?php 
				    ILO_Util_Message::clear();
				    endif; 
				?>
				
				<!--[if !IE]>start login<![endif]-->
				<form action="<?php echo BASE; ?>/auth/login" method="post">
				    <fieldset>

					<h1><?php echo $this->t( 'Acesso Restrito', 35 ); ?></h1>
					<div class="formular">
					    <span class="formular_top"></span>

					    <div class="formular_inner">

						<label>
						    <strong>
							<?php echo $this->t( 'Usuário', 1 ); ?>:
						    </strong>

						    <span class="input_wrapper">
							<input name="login" type="text" />
						    </span>
						</label>
						<label>
						    <strong>
							<?php echo $this->t( 'Senha', 34 ); ?>:
						    </strong>
						    <span class="input_wrapper">
							<input name="senha" type="password" />

						    </span>
						</label>


						<ul class="form_menu">
						    <li>
							<span class="button">
							    <span>
								<span>
								    <em><?php echo $this->t( 'ENTRAR', 36 ); ?></em>
								</span>
							    </span>
							    <input type="submit" name=""/>
							</span>
						    </li>
						    <li>
							<span class="button">
							    <span>
								<span>
								    <em><?php echo $this->t( 'RELATORIO', 407 ); ?></em>
								</span>
							    </span>
							    <input type="button" name="" onClick="location.href = '<?php echo BASE; ?>/relatorio'"/>
							</span>
						    </li>
						</ul>

					    </div>

					    <span class="formular_bottom"></span>

					</div>
				    </fieldset>
				</form>
				<!--[if !IE]>end login<![endif]-->

				<!--[if !IE]>start reflect<![endif]-->
				<span class="lock"></span>
				<!--[if !IE]>end reflect<![endif]-->

			    </div>

			    <!--[if !IE]>end login wrapper<![endif]-->
			</div>
		    </div>
		</div>
	    </div>	
	</div>
	<!--[if !IE]>end wrapper<![endif]-->
	
	<div id="loading" class="white_content"></div>
	<div id="loading_bkg" class="black_overlay"></div>
	
	<script type="text/javascript">
            
            window.onbeforeunload = function()
            {
                loading( true );
            }
        </script>
    </body>
</html>
